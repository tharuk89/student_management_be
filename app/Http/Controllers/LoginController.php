<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;

class LoginController extends Controller
{

    public function loginWithGithub(Request $request)
    {
        $code = $request->query('code');
        $response = $this->getGitHubToken($code);

        $tokenData = explode('&', $response->body());
        $tokenDataSplit = explode('=', $tokenData[0]);

        $token = $tokenDataSplit[1];
        Log::info(print_r($token, true));
        $user = $this->getUser($token);
        $user = json_decode($user->body());
        try {
            $loggedUser = User::where('email', '=', $user->email)->first();
            if ($loggedUser != null) {
                //Log::info($loggedUser);
                Auth::setUser($loggedUser);
                $token = $loggedUser->createToken('api-token')->plainTextToken;
                $data = DB::table('User')->select('permission.*')
                    ->join('Role', 'User.Role_IDrole', '=', 'Role.roleID')
                    ->join('role_permission', 'Role.roleID', '=', 'role_permission.role_id')
                    ->join('permission', 'role_permission.permission_id', '=', 'permission.id')
                    ->where('User.userID', $loggedUser->userID)->get();
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'permissions' => $data->pluck('code')->toArray(),
                    'user' => $loggedUser
                ], 201);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function loginWithGoogle(Request $request)
    {
        $request->all();
        try {
            $loggedUser = User::where('email', '=', $request->id)->first();
            Log::info(print_r($loggedUser, true));
            if ($loggedUser != null) {
                //Log::info($loggedUser);
                Auth::setUser($loggedUser);
                $token = $loggedUser->createToken('api-token')->plainTextToken;
                $data = DB::table('User')->select('permission.*')
                    ->join('Role', 'User.Role_IDrole', '=', 'Role.roleID')
                    ->join('role_permission', 'Role.roleID', '=', 'role_permission.role_id')
                    ->join('permission', 'role_permission.permission_id', '=', 'permission.id')
                    ->where('User.userID', $loggedUser->userID)->get();
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'permissions' => $data->pluck('code')->toArray(),
                    'user' => $loggedUser
                ], 201);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function loginWithFacebook(Request $request)
    {
        $accessToken = $request->accessToken;
        return response()->json([
            'fbToken' => $accessToken
        ], 201);
    }


    private function getFbToken($code)
    {
        $fbAppId = env('FACEBOOK_CLIENT_ID');
        $fbRedirectUrl = 'http://localhost:4200/login/facebook';
        $fbSecret = env('FACEBOOK_CLIENT_SECRET');
        $response = Http::get('https://graph.facebook.com/v15.0/oauth/access_token?client_id=' . $fbAppId . '&redirect_uri=' . $fbRedirectUrl . '&client_secret=' . $fbSecret . '&code=' . $code . '');
        return $response;
    }

    private function getGitHubToken($code)
    {
        $gitAppId = env('GITHUB_CLIENT_ID');
        $gitRedirectUrl = 'http://localhost:4200/login/github';
        $gitSecret = env('GITHUB_CLIENT_SECRET');
        $response = Http::get('https://github.com/login/oauth/access_token?client_id=' . $gitAppId . '&redirect_uri=' . $gitRedirectUrl . '&client_secret=' . $gitSecret . '&code=' . $code . '');
        return $response;
    }

    private function getFbAppToken()
    {
        $fbAppId = env('FACEBOOK_CLIENT_ID');
        $fbRedirectUrl = 'http://localhost:4200/login/facebook';
        $fbSecret = env('FACEBOOK_CLIENT_SECRET');
        $response = Http::get('https://graph.facebook.com/v15.0/oauth/access_token?client_id=' . $fbAppId . '&client_secret=' . $fbSecret . '&grant_type=client_credentials');
        return $response;
    }

    private function getDecodeFBtoken($appToken, $accessToken)
    {
        $fbAppId = env('FACEBOOK_CLIENT_ID');
        $fbSecret = env('FACEBOOK_CLIENT_SECRET');
        $response = Http::get('https://graph.facebook.com/debug_token?input_token=' . $accessToken . '&access_token=' . $appToken . '');
        return $response;
    }

    private function getUser($accessToken)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.github+json',
            'Authorization' => 'Bearer ' . $accessToken
        ])->get('https://api.github.com/user');

        return $response;
    }

    public function twitterCallBack(Request $request)
    {
        Log::info(print_r($request->oauth_token,true));
        Log::info(print_r($request->oauth_token_secret,true));
        Log::info(print_r($request->oauth_callback_confirmed,true));
    }

    /**
     * @throws \OAuthException
     */
    public function getSignature($url, $consumer_key, $consumer_secret, $method = 'POST', $params = false ) {

        $nonce     = mt_rand();
        $timestamp = time();
        $oauth     = new OAuth( $consumer_key, $consumer_secret,"HMAC-SHA1",1);
        $oauth->setTimestamp( $timestamp );
        $oauth->setNonce( $nonce );
        $sig = $oauth->generateSignature( $method, $url, $params );

        $header = 'OAuth ' .
            'oauth_consumer_key=' . $consumer_key .
            ',oauth_signature_method="HMAC-SHA1"' .
            ',oauth_nonce="'. $nonce . '"' .
            ',oauth_timestamp="' . $timestamp . '"'.
            ',oauth_version="1.0"'.
            ',oauth_signature="' . urlencode( $sig ) . '"'
        ;
        return $header;
    }

}
