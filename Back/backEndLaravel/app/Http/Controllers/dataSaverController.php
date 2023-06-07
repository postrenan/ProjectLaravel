<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class dataSaverController extends Controller
{
    public function dataUpload(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $users = new User();
        $users->password = Hash::make($password);
        $users->email = $email;
        $users->name = '';
        $users->api_token = Str::random(60);
        $successUp = $users->save();


        if ($successUp) {
            return response(status: 201);
        } else {
            return response(status: 404);
        }

    }
}
