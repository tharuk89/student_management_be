<?php

namespace App\Http\Controllers;

use App\Models\AcademicDocument;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function userSave(Request $request)
    {
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
            'role_id' => 2
        ];
        $data['password'] = bcrypt($request->password);
        Log::info(print_r($data,true));
        $user = User::create($data);
        $token = $user->createToken('Access Token')->accessToken;

        return response()->json([
            'token' => $token
        ], 201);
    }

    public function getUserById(Request $request)
    {
        return User::where('id',$request->id)->first();
    }

    public function uploadProfilePic(Request $request)
    {
        $file = $request->file;
        $userId = $request->user_id;

        $user = User::where('id',$userId)->first();

        $fileModel = new File;
        $newFileName = '';
        if ($file) {
            $fileModel->name = time() . '_' . $file->getClientOriginalName();
            $imagePath = '/clients/profile';
            Storage::disk('public')->put($imagePath . '/', $file);
            $newFileName = $fileModel->name;
            $user->document_url = $imagePath.$newFileName;
            $user->user_id = $userId;
            $user->save();
        }
    }

}
