<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UserCreateController extends Controller
{
    public function index(Request $request)
    {
        $email = $request->input('email');
        $user = DB::table('users')
            ->where('email', '=', $email)
            ->exists();

      if($user === true){
          return response(status: 400);
      } else {
          return true;
      }
    }
    public function store(Request $request){

        $users = new User();
        $users -> email = $request->input('email');
        $users -> password = $request->input('password');
        $users -> name = '';
        $users->api_token = Str::random(60);
        return $users->save();
    }
}
