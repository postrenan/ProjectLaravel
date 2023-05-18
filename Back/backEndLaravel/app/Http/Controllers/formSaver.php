<?php

namespace App\Http\Controllers;

use App\Models\forms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class formSaver extends Controller
{
    public function dataUpload(Request $request){
        $email = $request->input('email');
        $msg = $request->input('msg');
        $phone = $request->input('phone');
        $name = $request->input('name');

        $insert = DB::insert('insert into form (name, phone, email, msg) values (?,?,?,?)', [$name, $phone, $email, $msg]);

        if($insert){
           return response(status:200);
        }else{
            return response(status:500);
        }
    }
}
