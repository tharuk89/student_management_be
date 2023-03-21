<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    public function loadPermission(Request $request){
        $user = Auth::hasUser();
        if(Auth::hasUser()){
            Log::info(" LOGGED USER ");
        }
        Log::info(print_r($request->user(),true));
    }
}
