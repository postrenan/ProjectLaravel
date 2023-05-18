<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dataSaverController extends Controller
{
    public function dataUpload(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $insert = DB::insert('insert into user (email,password) values (?,?)', [$email, $password]);
//        $user = new Accounts();
//        $user-> $password;
//        $user-> $email;
//        $user->save();
//         não está funcionando a ORM

        if ($insert){
            return response(status: 200);
        } else {
            return response(status: 500);
        }
    }
}
