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

        $user = new Accounts();
        $user->password = $password;
        $user->email = $email;
        $user->save();

        return response(201);
    }
}
