<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        $logged = Auth::attempt($credentials);

        if(!$logged){
            return response()->json([], 401);
        }

        /** @var $user User */
        $user = auth()->user();

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
            ],
        ]);
    }

    public function show( $email)
    {
        $user = User::where('email', '=', $email)
                ->first();

        $userName = $user['name'];
        return (['name' => $userName]);
    }
    public function destroy(string $email)
    {
        $user = User::where('email', '=', $email)
            ->first();
        $user->delete();
        return $user;
    }

}

