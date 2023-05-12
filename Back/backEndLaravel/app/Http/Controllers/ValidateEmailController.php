<?php
namespace app\Http\Controllers;

class ValidateEmailController extends Controller
{
    public function dataVerifi(Request $request){
        dd($request);
        $email = $request->input('email');

        // Verifique se já existe um usuário com o mesmo email no banco de dados
        $usuario = User::where('email', $email)->first();

        // Se o usuário existir, retorne uma resposta de erro com o status 422
        if ($usuario) {
            throw ValidationException::withMessages([
                'email' => 'Este email já está sendo usado por outro usuário'
            ]);
        }

        // Se o usuário não existir, retorne uma resposta de sucesso com o status 200
        return response()->json(['mensagem' => 'Email disponível']);
    }
}
