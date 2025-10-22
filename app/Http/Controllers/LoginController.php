<?php

namespace App\Http\Controllers;

use App\Enums\AtivoInativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function index(){
        
        return view('index');
    }

    public function store(LoginRequest $request){

        $request->validated();

        $credentials = $request->only('email', 'password');    

        if (!Auth::attempt($credentials)) {
            return redirect('/')->withErrors(['error' => 'E-MAIL ou SENHA inválidos']);
        }

        $request->session()->regenerate();

        $usuario = Auth::user();

        if ($usuario->status != AtivoInativo::ATIVO) {
            
            Auth::logout();
            return redirect('/')->withErrors(['error' => 'Usuário sem acesso. Contate o suporte para regularização.']);
        }

        return redirect()->intended(route('home.index'));
    }

    public function destroy(){

        Auth::logout();

        return redirect('/');

    }
}