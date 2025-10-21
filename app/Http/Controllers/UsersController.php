<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\NivelUser;
use App\Enums\AtivoInativo;
use App\Enums\Equipes;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(){

        $nivel          = NivelUser::nivelUser();             
        $ativoInativo   = AtivoInativo::lista();
        $equipes        = Equipes::equipes();
        $users          = User::all();       

        return view('users.index', compact('users', 'nivel', 'ativoInativo', 'equipes')); 
    }

    public function create(){

        $nivel   = NivelUser::nivelUser(); 
        $equipes = Equipes::equipes();                  

        return view('users.create', compact('nivel', 'equipes')); 
    }

    public function store(Request $request){

        if (md5($request->password) != md5($request->password2)){
            return redirect(route('users.index'))->with('msgErro', 'Senha não confere!');
        } 

        $verifica = User::where('email', $request->email)->count();

        if ($verifica > 0){            
            return redirect(route('users.index'))->with('msgErro', 'e-mail já cadastrado!');
        } 
        
        User::create([            
            'name'      => strtoupper($request->name),            
            'email'     => strtolower($request->email),
            'password'  => bcrypt($request->password),
            'nivel'     => $request->nivel,                        
            'equipe'    => $request->equipe,            
            'status'    => 1,
        ]);
         
        return redirect(route('users.index'))->with('msg', 'Usuário '.strtoupper($request->name).' cadastrado com sucesso!'); 
    }

    public function edit(User $user){

        $nivel          = NivelUser::nivelUser();             
        $ativoInativo   = AtivoInativo::lista();
        $equipes        = Equipes::equipes();                         

        return view('users.edit', compact('user', 'nivel', 'ativoInativo', 'equipes')); 
    }

    public function update(Request $request, User $user){  
        
        $user->fill([
            'name'      => strtoupper($request->name),            
            'email'     => strtolower($request->email),
            'password'  => bcrypt($request->password),
            'nivel'     => $request->nivel,                        
            'equipe'    => $request->equipe,            
            'status'    => $request->status,
        ]);
        $user->save();

        return redirect(route('users.index'))->with('msg', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user){

        $user->delete();

        return redirect(route('users.index'))->with('msg', 'Usuário excluído com sucesso!');
    }

    public function alterarSenha(User $user, Request $request){

        if (!Hash::check($request->password, $user->password)){

            return back()->with('msgErro', 'Senha atual incorrera!');
        }

        $user->name     = strtoupper($request->name);
        $user->password = Hash::make($request->password2);
        $user->save();

        return back()->with('msg', 'Senha aletarada com sucesso!');
    }
}