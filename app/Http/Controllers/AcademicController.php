<?php

namespace App\Http\Controllers;

use App\Models\AcademicDocument;
use App\Models\User;
use Atymic\Twitter\Facade\Twitter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AcademicController extends Controller
{

    public function index(Request $request)
    {
        $userId = $request->id;
        $user = User::where('id', $userId)->get();
        if ($user[0]->role_id === 1) {
            return AcademicDocument::all();
        }
        return AcademicDocument::where('user_id', $userId)->get();
    }


    public function save(Request $request)
    {
        $fileName = $request->document_name;
        $fileType = $request->document_type;
        $file = $request->file;
        $userId = $request->user_id;

        $fileModel = new File;
        $newFileName = '';
        if ($file) {
            $fileModel->name = time() . '_' . $file->getClientOriginalName();
            $imagePath = '/clients';
            Storage::disk('public')->put($imagePath . '/', $file);
            $newFileName = $fileModel->name;
            Log::info(print_r($fileModel->name, true));

            $doc = new AcademicDocument();
            $doc->document_name = $fileName;
            $doc->document_type = $fileType;
            $doc->document_url = $newFileName;
            $doc->user_id = $userId;
            $doc->save();
        }

        /*$imagePath = '/clients';
        try {
            $imageName = 'random_' . random_int(1, 1000) . '.jpeg';
            //\File::put(base64_decode($image), public_path($imagePath). '/' . $imageName);
            Storage::disk('public')->put($imagePath.'/'. $imageName, base64_decode($image));

            //$picName = $file->getClientOriginalName();
            $filePath = storage_path('app/public/clients');
            //$file->move(public_path($imagePath), $imageName);
            $file_location = $filePath.'/'.$imageName;

            $file = Storage::disk('public')->get('clients/'.$imageName);;
            if ($file != null) {
                $doc = new AcademicDocument();
                $doc->document_name = $fileName;
                $doc->document_type = $fileType;
                $doc->document_url = 'url';
                $doc->user_id = $userId;
                $doc->save();
            }
        } catch (\Exception $e) {

        }


        return response()->json([
            'data' => 'Successfully save'
        ], 201);*/
    }

    public function uploadImage($image, $text, $name)
    {
        $file = Storage::disk('public')->get('clients/' . $name);
        $uploaded_media = Twitter::uploadMedia(['media' => $file]);
        Log::info(print_r($uploaded_media, true));
        $tweet = Twitter::postTweet(['status' => $text, 'media_ids' => $uploaded_media->media_id_string]);
        return $tweet;
    }

}
