<?php
namespace app\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;

class ValidateEmailController
{
    public function mailVerify(Request $request){
        $email = $request->input('email');

        $validateMail = Accounts::where('email', $email)->exists();

        if($validateMail){
            return response(404);
        } else {
            return response(200);
        }
    }
}
