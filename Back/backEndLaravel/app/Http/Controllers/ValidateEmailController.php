<?php
namespace app\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ValidateEmailController
{
    public function mailVerify(Request $request){
        $email = $request->input('email');

        $validateMail = User::where('email', $email)->exists();

        if($validateMail){
            return response(status:409);
        } else {
            return response(status:201);
        }
    }
}
