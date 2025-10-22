<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\NivelUser;
use App\Enums\AtivoInativo;
use App\Enums\Equipes;
use App\Http\Requests\UserRequest;
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

    public function store(UserRequest $request){      

        User::create([            
        'name'      => strtoupper($request->name),            
        'email'     => strtolower($request->email),
        'password'  => bcrypt($request->password),
        'nivel'     => $request->nivel,                        
        'equipe'    => $request->equipe,            
        'status'    => 1,
        ]);
        
        return redirect(route('users.index'))->with('success', 'Usuário ' . strtoupper($request->name) . ' cadastrado com sucesso!');
    }

    public function edit(User $user){

        $nivel          = NivelUser::nivelUser();             
        $ativoInativo   = AtivoInativo::lista();
        $equipes        = Equipes::equipes();                         

        return view('users.edit', compact('user', 'nivel', 'ativoInativo', 'equipes')); 
    }

    public function update(UserRequest $request, User $user){  
        
        $user->fill([
            'name'      => strtoupper($request->name),            
            'email'     => strtolower($request->email),
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

    public function alterarSenha(User $user, UserRequest $request){

        if (!Hash::check($request->password_reset, $user->password)){

            return back()->with('msgErro', 'Senha atual incorrera!');
        }

        $user->name     = strtoupper($request->name_reset);
        $user->password = Hash::make($request->password_new);

        $user->save();

        return back()->with('msg', 'Senha aletarada com sucesso!');
    }
}