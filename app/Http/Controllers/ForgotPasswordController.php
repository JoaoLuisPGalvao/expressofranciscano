<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm(){

        return view('auth.forgot_password');
    }

    public function sendResetLinkEmail(Request $request){

        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'O campo E-MAIL é obrigatório!',
            'email.email'    => 'Necessário enviar e-mail válido!',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user){

            return back()->withInput()->withErrors(['error' => 'E-mail não encontrado']);
        }        

        try {

            Password::sendResetLink(
                $request->only('email')
            );

            return redirect()->route('index')->with('success', 'Enviado e-mail com as instruções para recuperar a senha.');

        } catch (Exception $e) {
            
            return back()->withInput()->withErrors(['error' => 'Tente mais tarde']);
        }
    }

    public function showRequestForm(Request $request){

        try{            

            $user = User::where('email', $request->email)->first();            

            if(!$user || !Password::tokenExists($user, $request->token)){

                return redirect()->route('index')->withErrors(['error' => 'Token inválido ou expirado!']);
            }

            return view('auth.reset_password', ['token' => $request->token, 'email' => $request->email]);

        } catch(Exception $e){

            return redirect()->route('index')->withErrors(['error' => 'Token inválido ou expirado!']);
        }
    }

    public function reset(Request $request){

        $request->validate(
            [
                'email'    => 'required|email',
                'token'    => 'required',
                'password' => 'required|confirmed|min:6',
            ],[
                'email.required'    => 'O campo E-MAIL é obrigatório!',
                'email.email'       => 'Informe um e-mail válido!',
                'token.required'    => 'Token de redefinição não encontrado!',
                'password.required' => 'O campo SENHA é obrigatório!',
                'password.confirmed'=> 'A senha não confere!',
                'password.min'      => 'A senha deve conter no mínimo 6 caracteres',
            ]);

        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                    ])->save();
                }
            );

            return $status === Password::PASSWORD_RESET
                ? redirect()->route('index')->with('success', 'Senha atualizada com sucesso!')
                : redirect()->route('index')->withErrors(['error' => 'Senha não atualizada!']);

        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Tente mais tarde']);
        }
    }
}
