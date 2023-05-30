<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class DeleteUserController extends Controller
{
   public function UserDrop(string $email){
       $user = User::where('email', '=', $email)
                ->first();
       $user->delete();
       return $user;
       }
}
