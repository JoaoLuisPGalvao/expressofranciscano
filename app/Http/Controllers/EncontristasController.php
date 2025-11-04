<?php

namespace App\Http\Controllers;

use App\Enums\Contatos; 
use App\Enums\Generos;
use App\Enums\Irmaos;
use App\Enums\Series;
use App\Enums\SimNao;
use App\Enums\Transportes;
use App\Enums\Turnos;
use App\Enums\Fraternidades;
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

        $generos        = Generos::generos();
        $simNao         = SimNao::lista();   
        $irmaos         = Irmaos::lista();
        $series         = Series::lista();
        $turnos         = Turnos::lista();
        $contatos       = Contatos::lista();
        $transportes    = Transportes::lista();
        $ano            = Carbon::now()->format('Y');              

        return view('encontristas.create', compact('generos', 'simNao', 'ano', 'irmaos', 'series', 'turnos', 'contatos', 'transportes')); 
    }

    public function store(EncontristaRequest $request){
        
        $arquivoPath = null;

        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            // Pasta onde será salva (em storage/app/public/fotos/)
            $pasta = 'fotos';

            // Nome do arquivo com slug + timestamp + extensão correta
            $nomeArquivo = strtolower(Str::slug($request->nome)) . '.' . $file->getClientOriginalExtension();

            // salva em storage/app/public/fotos/
            $arquivoPath = $file->storeAs($pasta, $nomeArquivo, 'public');
        }

        //calcular a idade do jovem e incluir ele numa fraternidade
        $fraternidade = calcularFraternidade($request->data_nasc);        

        Encontrista::create([     
            'nome'                          => mb_strtoupper($request->nome, 'UTF-8'),          
            'data_nasc'                     => $request->data_nasc,
            'genero'                        => $request->genero,
            'ano_expresso'                  => $request->ano_expresso,
            'endereco_cep'                  => $request->endereco_cep,
            'endereco_rua'                  => mb_strtoupper($request->endereco_rua, 'UTF-8'),
            'endereco_numero'               => $request->endereco_numero,
            'endereco_bairro'               => mb_strtoupper($request->endereco_bairro, 'UTF-8'),
            'endereco_cidade'               => mb_strtoupper($request->endereco_cidade, 'UTF-8'),
            'endereco_estado'               => $request->endereco_estado,
            'endereco_complemento'          => mb_strtoupper($request->endereco_complemento, 'UTF-8'),
            'estuda'                        => $request->estuda,
            'escola'                        => mb_strtoupper($request->escola, 'UTF-8'), 
            'serie'                         => $request->serie,
            'turno'                         => $request->turno,
            'tem_irmaos'                    => $request->tem_irmaos,
            'pais_casados'                  => $request->pais_casados,            
            'pai_nome'                      => mb_strtoupper($request->pai_nome, 'UTF-8'),
            'pai_contato'                   => $request->pai_contato,
            'mae_nome'                      => mb_strtoupper($request->mae_nome, 'UTF-8'),
            'mae_contato'                   => $request->mae_contato,
            'outro_responsavel_nome'        => mb_strtoupper($request->outro_responsavel_nome, 'UTF-8'),
            'outro_responsavel_contato'     => $request->outro_responsavel_contato,
            'outro_responsavel_parentesco'  => mb_strtoupper($request->outro_responsavel_parentesco, 'UTF-8'),
            'contato_principal'             => $request->contato_principal,
            'possui_transporte'             => $request->possui_transporte,
            'mora_com'                      => mb_strtoupper($request->mora_com, 'UTF-8'),
            'familiar_participa'            => $request->familiar_participa,
            'familiar_quem'                 => mb_strtoupper($request->familiar_quem, 'UTF-8'),
            'familiar_grupo'                => mb_strtoupper($request->familiar_grupo, 'UTF-8'),
            'tem_parente_inscrito'          => $request->tem_parente_inscrito,
            'parente_inscrito_nome'         => mb_strtoupper($request->parente_inscrito_nome, 'UTF-8'),
            'uso_medicamento'               => $request->uso_medicamento,
            'uso_medicamento_descricao'     => mb_strtoupper($request->uso_medicamento_descricao, 'UTF-8'),
            'tratamento_saude'              => $request->tratamento_saude,
            'tratamento_saude_descricao'    => mb_strtoupper($request->tratamento_saude_descricao, 'UTF-8'),
            'restricao_alimentar'           => $request->restricao_alimentar,
            'restricao_alimentar_descricao' => mb_strtoupper($request->restricao_alimentar_descricao, 'UTF-8'),
            'alergia'                       => $request->alergia,
            'alergia_descricao'             => mb_strtoupper($request->alergia_descricao, 'UTF-8'),
            'espectro_autista'              => $request->espectro_autista,
            'espectro_autista_descricao'    => mb_strtoupper($request->espectro_autista_descricao, 'UTF-8'),            
            'foto'                          => $arquivoPath,           
            'fraternidade'                  => $fraternidade,       
        ]);
        
        return redirect(route('encontristas.index'))->with('msg', 'Encontrista ' . mb_strtoupper($request->nome) . ' cadastrado com sucesso!');
    }

    public function edit(Encontrista $encontrista){

        $generos        = Generos::generos();
        $simNao         = SimNao::lista();   
        $irmaos         = Irmaos::lista();
        $series         = Series::lista();
        $turnos         = Turnos::lista();
        $contatos       = Contatos::lista();
        $transportes    = Transportes::lista();        

        return view('encontristas.edit', compact('encontrista', 'generos', 'simNao', 'irmaos', 'series', 'turnos', 'contatos', 'transportes')); 
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
            'nome'                          => mb_strtoupper($request->nome, 'UTF-8'),                  
            'data_nasc'                     => $request->data_nasc,
            'genero'                        => $request->genero,
            'ano_expresso'                  => $request->ano_expresso,
            'endereco_cep'                  => $request->endereco_cep,
            'endereco_rua'                  => mb_strtoupper($request->endereco_rua, 'UTF-8'),
            'endereco_numero'               => $request->endereco_numero,
            'endereco_bairro'               => mb_strtoupper($request->endereco_bairro, 'UTF-8'),
            'endereco_cidade'               => mb_strtoupper($request->endereco_cidade, 'UTF-8'),
            'endereco_estado'               => $request->endereco_estado,
            'endereco_complemento'          => mb_strtoupper($request->endereco_complemento, 'UTF-8'),
            'estuda'                        => $request->estuda,
            'escola'                        => mb_strtoupper($request->escola, 'UTF-8'), 
            'serie'                         => $request->serie,
            'turno'                         => $request->turno,
            'tem_irmaos'                    => $request->tem_irmaos,
            'pais_casados'                  => $request->pais_casados,            
            'pai_nome'                      => mb_strtoupper($request->pai_nome, 'UTF-8'),
            'pai_contato'                   => $request->pai_contato,
            'mae_nome'                      => mb_strtoupper($request->mae_nome, 'UTF-8'),
            'mae_contato'                   => $request->mae_contato,
            'outro_responsavel_nome'        => mb_strtoupper($request->outro_responsavel_nome, 'UTF-8'),
            'outro_responsavel_contato'     => $request->outro_responsavel_contato,
            'outro_responsavel_parentesco'  => mb_strtoupper($request->outro_responsavel_parentesco, 'UTF-8'),
            'contato_principal'             => $request->contato_principal,
            'possui_transporte'             => $request->possui_transporte,
            'mora_com'                      => mb_strtoupper($request->mora_com, 'UTF-8'),
            'familiar_participa'            => $request->familiar_participa,
            'familiar_quem'                 => mb_strtoupper($request->familiar_quem, 'UTF-8'),
            'familiar_grupo'                => mb_strtoupper($request->familiar_grupo, 'UTF-8'),
            'tem_parente_inscrito'          => $request->tem_parente_inscrito,
            'parente_inscrito_nome'         => mb_strtoupper($request->parente_inscrito_nome, 'UTF-8'),
            'uso_medicamento'               => $request->uso_medicamento,
            'uso_medicamento_descricao'     => mb_strtoupper($request->uso_medicamento_descricao, 'UTF-8'),
            'tratamento_saude'              => $request->tratamento_saude,
            'tratamento_saude_descricao'    => mb_strtoupper($request->tratamento_saude_descricao, 'UTF-8'),
            'restricao_alimentar'           => $request->restricao_alimentar,
            'restricao_alimentar_descricao' => mb_strtoupper($request->restricao_alimentar_descricao, 'UTF-8'),
            'alergia'                       => $request->alergia,
            'alergia_descricao'             => mb_strtoupper($request->alergia_descricao, 'UTF-8'),
            'espectro_autista'              => $request->espectro_autista,
            'espectro_autista_descricao'    => mb_strtoupper($request->espectro_autista_descricao, 'UTF-8'),
        ]);

        $encontrista->save();

        return redirect(route('encontristas.index'))->with('msg', 'Encontrista atualizado com sucesso!');
    }

    public function destroy(Encontrista $encontrista){

        $encontrista->delete();

        return redirect(route('encontristas.index'))->with('msg', 'Encontrista excluído com sucesso!');
    }

    public function ficha(Encontrista $encontrista){    
        
        $generos        = Generos::generos();
        $simNao         = SimNao::lista();   
        $irmaos         = Irmaos::lista();
        $series         = Series::lista();
        $turnos         = Turnos::lista();
        $contatos       = Contatos::lista();
        $transportes    = Transportes::lista();   

        $pdf = Pdf::loadView('encontristas.ficha', compact('encontrista', 'generos', 'simNao', 'irmaos', 'series', 'turnos', 'contatos', 'transportes'))->setPaper('a4', 'portrait');

        return response($pdf->output())->header('Content-Type', 'application/pdf');
    }

    public function gerarAllFichas(){    
        
        $generos        = Generos::generos();
        $simNao         = SimNao::lista();   
        $irmaos         = Irmaos::lista();
        $series         = Series::lista();
        $turnos         = Turnos::lista();
        $contatos       = Contatos::lista();
        $transportes    = Transportes::lista();   
        $request        = request();
        $ano            = $request->input('ano', Carbon::now()->format('Y'));     

        $encontristas = Encontrista::where('ano_expresso', $ano)->get();  

        $pdf = Pdf::loadView('encontristas.allFichas', compact('encontristas', 'generos', 'simNao', 'ano', 'irmaos', 'series', 'turnos', 'contatos', 'transportes'))->setPaper('a4', 'portrait');

        return response($pdf->output())->header('Content-Type', 'application/pdf');
    }

    public function gerarCsv(){

        $generos        = Generos::generos();
        $simNao         = SimNao::lista();   
        $irmaos         = Irmaos::lista();
        $series         = Series::lista();
        $turnos         = Turnos::lista();
        $contatos       = Contatos::lista();
        $transportes    = Transportes::lista(); 
        $fraternidades  = Fraternidades::lista();
        $request        = request();
        $ano            = $request->input('ano', Carbon::now()->format('Y'));     

        $encontristas = Encontrista::where('ano_expresso', $ano)->get();          
        
        $csvNomeArquivo = tempnam(sys_get_temp_dir(), 'csv_' . Str::uuid());       
        $arquivoAberto  = fopen($csvNomeArquivo, 'w');

        // BOM UTF-8 para Excel
        fwrite($arquivoAberto, chr(0xEF).chr(0xBB).chr(0xBF));

        $topo = ['Relação de Encontristas - '.$ano, '', '', '', '','', '', '', '', ''];
        fputcsv($arquivoAberto, $topo, ';');        
        
        $cabecalho = ['NOME','DATA NASC','GÊNERO','ENDEREÇO','ESTUDA?','ESCOLA/SÉRIE/TURNO','TEM IRMÃOS?','PAIS CASADOS?','PAI/CONTATO','MÃE/CONTATO','OUTRO RESPONSÁVEL/CONTATO','CONTATO PRINCIPAL','POSSUI TRANSPORTE?','MORA COM?','ALGUM FAMILIAR PARTICIPA DA IGREJA?/QUEM/GRUPO','TEM PARENTE INSCRITO?/SE SIM, QUEM?','FAZ USO DE MEDICAMENTO?','FAZ TRATAMENTO SAÚDE?','TEM RESTRIÇÃO ALIMENTAR?','TEM ALERGIA?','ESTA DENTRO DO ESPECTRO AUTISTA?', 'FRATERNIDADE'];

        fputcsv($arquivoAberto, $cabecalho, ';');

        foreach($encontristas as $encontrista){
            $encontristaArray = [
                'NOME' => $encontrista->nome,
                'DATA NASC' => $encontrista->data_nasc,
                'GÊNERO' => $generos[$encontrista->genero] ?? '',
                'ENDEREÇO' => $encontrista->endereco_rua . ', Nr ' . $encontrista->endereco_numero . ' - ' . $encontrista->endereco_bairro . ', ' . $encontrista->endereco_cidade . '/' . $encontrista->endereco_estado . ' - ' . $encontrista->endereco_complemento . ' - ' . $encontrista->endereco_cep,
                'ESTUDA?' => $simNao[$encontrista->estuda] ?? '',
                'ESCOLA/SÉRIE/TURNO' => ($encontrista->escola ? $encontrista->escola . ' - ' . $series[$encontrista->serie] . ' - ' . $turnos[$encontrista->turno] : ''),
                'TEM IRMÃOS?' => $irmaos[$encontrista->tem_irmaos] ?? '',
                'PAIS CASADOS?' => $simNao[$encontrista->pais_casados] ?? '',
                'PAI/CONTATO' => $encontrista->pai_nome . ' - ' . $encontrista->pai_contato,
                'MÃE/CONTATO' => $encontrista->mae_nome . ' - ' . $encontrista->mae_contato,
                'OUTRO RESP/CONTATO' => ($encontrista->outro_responsavel_nome ? $encontrista->outro_responsavel_nome . ' - ' . $encontrista->outro_responsavel_parentesco . ' - ' . $encontrista->outro_responsavel_contato : ''),
                'CONTATO PRINCIPAL' => $contatos[$encontrista->contato_principal],
                'POSSUI TRANSPORTE?' => $transportes[$encontrista->possui_transporte] ?? '',
                'MORA COM?' => $encontrista->mora_com,
                'ALGUM FAMILIAR PARTICIPA DA IGREJA?/QUEM/GRUPO' => ($simNao[$encontrista->familiar_participa] ?? '') .
                    ($encontrista->familiar_quem ? ', ' . $encontrista->familiar_quem . ' - ' . $encontrista->familiar_grupo : ''),
                'TEM PARENTE INSCRITO?/SE SIM, QUEM?' => ($simNao[$encontrista->tem_parente_inscrito] ?? '') . 
                    ($encontrista->parente_inscrito_nome ? ', ' . $encontrista->parente_inscrito_nome : ''),
                'FAZ USO DE MEDICAMENTO?' => ($simNao[$encontrista->uso_medicamento] ?? '') . 
                    ($encontrista->uso_medicamento_descricao ? ', ' . $encontrista->uso_medicamento_descricao : ''),
                'FAZ TRATAMENTO SAÚDE?' => ($simNao[$encontrista->tratamento_saude] ?? '') . 
                    ($encontrista->tratamento_saude_descricao ? ', ' . $encontrista->tratamento_saude_descricao : ''),
                'TEM RESTRIÇÃO ALIMENTAR?' => ($simNao[$encontrista->restricao_alimentar] ?? '') .  
                    ($encontrista->restricao_alimentar_descricao ? ', ' . $encontrista->restricao_alimentar_descricao : ''),
                'TEM ALERGIA?' => ($simNao[$encontrista->alergia] ?? '') . 
                    ($encontrista->alergia_descricao ? ', ' . $encontrista->alergia_descricao : ''),
                'ESTA DENTRO DO ESPECTRO AUTISTA?' => ($simNao[$encontrista->espectro_autista] ?? '') . 
                    ($encontrista->espectro_autista_descricao ? ', ' . $encontrista->espectro_autista_descricao : ''),
                'FRATERNIDADE' => ($fraternidades[$encontrista->fraternidade] ?? ''),
            ];
            
            fputcsv($arquivoAberto, $encontristaArray, ';');
        }
        
        fclose($arquivoAberto);
        
        return response()->download($csvNomeArquivo, 'Relacao_encontristas.csv')->deleteFileAfterSend(true);
    }
}