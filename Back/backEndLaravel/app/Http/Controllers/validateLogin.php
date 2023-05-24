<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class validateLogin extends Controller
{
   public function dbValidate (Request $request){

       $email = $request->input('email');
       $password = $request->input('password');

       $user = User::query()
           ->where('email', '=', $email)
           ->first();

       if (Auth::attempt(['email' => $email, 'password' => $password])) {
           return response ( ['api_token' => Auth::user()->api_token , 'emailUser' => $email],200);
       } else {
           return response(status:401);
       }
   }
}
