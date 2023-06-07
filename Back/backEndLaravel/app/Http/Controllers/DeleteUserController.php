<?php

namespace App\Http\Controllers;

use App\Models\User;


class DeleteUserController extends Controller
{
    public function UserDrop(string $email)
    {
        $user = User::where('email', '=', $email)
            ->first();
        $user->delete();
        return $user;
    }
}
