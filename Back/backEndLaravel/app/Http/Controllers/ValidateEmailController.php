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
            // TODO Alterar para ele mudar o status da response, está apenas mandando uma string escrita 404
            return response(404);
        } else {
            return response(200);
        }
    }
}
