<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request, string $email){
        $email = $request->input('email');

        $validateMail = User::where('email', $email)->exists();

        if($validateMail){
            return response(status:409);
        } else {
            return response(status:201);
        }
//
//        return User::query()
//            ->where('email', '=', $email)
//            ->first();

        $email = $request->input('email');
        $password = $request->input('password');
        User::query()
            ->where('email', '=', $email)
            ->first();

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return response(['emailUser' => $email], status: 200);
        } else {
            return response(status: 401);
        }

    }

    public function destroy(string $email){
        $user = User::where('email', '=', $email)
            ->first();
        $user->delete();
        return $user;
    }

    public function store(Request $request)
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
        }
        else {
            return response(status: 404);
        }

    }
}
