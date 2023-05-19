<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;
use Illuminate\Support\Facades\DB;

class validateLogin extends Controller
{
   public function dbValidate (Request $request){

       $email = $request->input('email');
       $password = $request->input('password');

       // TODO Fazer o hash da password

       // Auth
       $validateMail = DB::table('account')
           ->where('email', '=', $email)
           ->where('password', '=', $password)
           ->get()
           ->first();

       if($validateMail){
           return response([],200);
       }else {
           return response([],401);
       }
   }
}
