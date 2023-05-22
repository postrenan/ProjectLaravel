<?php
namespace app\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;

class ValidateEmailController
{
    public function mailVerify(Request $request){
        $email = $request->input('email');

        $validateMail = Accounts::where('email', $email)->exists();
        //TODO mudar para status e não resposta chumbada
        if($validateMail){
            return response(200);
        } else {
            return response(404);
        }
    }
}
