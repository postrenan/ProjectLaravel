<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;




class UserController extends Controller
{
    public function index(Request $request)
    {
        User::query()
            ->where('email', '=', $email = $request->input('email'))
            ->first();

        if (Auth::attempt(['email' => $email, 'password' =>   $request->input('password')])) {
            return response(['emailUser' => $email]);
        };
    }



}
//    public function destroy(string $email)
//    {
//        $user = User::where('email', '=', $email)
//            ->first();
//        $user->delete();
//        return $user;
//    }
//
//
//    }

