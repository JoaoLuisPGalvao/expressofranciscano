<?php

namespace App\Http\Controllers;

use App\Enums\Generos;
use App\Enums\SimNao;
use App\Http\Requests\EncontristaRequest;
use App\Models\Encontrista;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class EncontristasController extends Controller
{
    public function index(){

        $generos = Generos::generos();
        $request = request();
        $ano     = $request->input('ano', Carbon::now()->format('Y'));

        $encontristas = Encontrista::where('ano_expresso', $ano)->get();

        return view('encontristas.index', compact('encontristas', 'generos', 'ano'));
    }    

    public function create(){

        $generos = Generos::generos();
        $simNao  = SimNao::lista();   
        $ano     = Carbon::now()->format('Y');              

        return view('encontristas.create', compact('generos', 'simNao', 'ano')); 
    }

    public function store(EncontristaRequest $request){

        $arquivoPath = null;

        $cpf = validarCPF($request->cpf);

        if(!$cpf){

            return back()->withInput()->with('msgErro', 'Inscrição Federal inválida!');
        }

        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            // Pasta onde será salva (em storage/app/public/fotos/)
            $pasta = 'fotos';

            // Nome do arquivo com slug + timestamp + extensão correta
            $nomeArquivo = strtolower(Str::slug($request->nome)) . '.' . $file->getClientOriginalExtension();

            // salva em storage/app/public/fotos/
            $arquivoPath = $file->storeAs($pasta, $nomeArquivo, 'public');
        }

        Encontrista::create([     
            'nome'              => strtoupper($request->nome),
            'cpf'               => $request->cpf,
            'data_nasc'         => $request->data_nasc,
            'genero'            => $request->genero,
            'ano_expresso'      => $request->ano_expresso,
            'pai_nome'          => $request->pai_nome,
            'pai_contato'       => $request->pai_contato,
            'mae_nome'          => $request->mae_nome,
            'mae_contato'       => $request->mae_contato,
            'pais_casados'      => $request->pais_casados,
            'endereco_rua'      => $request->endereco_rua,
            'endereco_numero'   => $request->endereco_numero,
            'endereco_bairro'   => $request->endereco_bairro,
            'endereco_cidade'   => $request->endereco_cidade,
            'endereco_estado'   => $request->endereco_estado,
            'endereco_cep'      => $request->endereco_cep,
            'foto'              => $arquivoPath,
            'status'            => 1,        
        ]);
        
        return redirect(route('encontristas.index'))->with('msg', 'Encontrista ' . strtoupper($request->nome) . ' cadastrado com sucesso!');
    }

    public function edit(Encontrista $encontrista){

        $generos = Generos::generos();
        $simNao  = SimNao::lista();          

        return view('encontristas.edit', compact('encontrista', 'generos', 'simNao')); 
    }

    public function update(Encontrista $encontrista, EncontristaRequest $request){

        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            // Pasta onde será salva (em storage/app/public/fotos/)
            $pasta = 'fotos';

            // Nome do arquivo com slug + timestamp + extensão correta
            $nomeArquivo = strtolower(Str::slug($request->nome)) . '.' . $file->getClientOriginalExtension();

            // Remove a foto antiga se existir
            if ($encontrista->foto && Storage::disk('public')->exists($encontrista->foto)) {
                Storage::disk('public')->delete($encontrista->foto);
            }

            // salva em storage/app/public/fotos/
            $arquivoPath = $file->storeAs($pasta, $nomeArquivo, 'public');
            $encontrista->foto = $arquivoPath; // atualiza o campo da foto
        }

        $encontrista->fill([
            'nome'              => strtoupper($request->nome),
            'cpf'               => $request->cpf,
            'data_nasc'         => $request->data_nasc,
            'genero'            => $request->genero,
            'ano_expresso'      => $request->ano_expresso,
            'pai_nome'          => $request->pai_nome,
            'pai_contato'       => $request->pai_contato,
            'mae_nome'          => $request->mae_nome,
            'mae_contato'       => $request->mae_contato,
            'pais_casados'      => $request->pais_casados,
            'endereco_rua'      => $request->endereco_rua,
            'endereco_numero'   => $request->endereco_numero,
            'endereco_bairro'   => $request->endereco_bairro,
            'endereco_cidade'   => $request->endereco_cidade,
            'endereco_estado'   => $request->endereco_estado,
            'endereco_cep'      => $request->endereco_cep,
        ]);

        $encontrista->save();

        return redirect(route('encontristas.index'))->with('msg', 'Encontrista atualizado com sucesso!');
    }

    public function destroy(Encontrista $encontrista){

        $encontrista->delete();

        return redirect(route('encontristas.index'))->with('msg', 'Encontrista excluído com sucesso!');
    }

    public function ficha(Encontrista $encontrista){    
        
        $generos = Generos::generos();
        $simNao  = SimNao::lista(); 

        $pdf = Pdf::loadView('encontristas.ficha', compact('encontrista', 'generos', 'simNao'))->setPaper('a4', 'portrait');

        return response($pdf->output())->header('Content-Type', 'application/pdf');
    }
}