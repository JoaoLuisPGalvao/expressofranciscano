<?php

namespace App\Http\Controllers;

use App\Enums\Contatos; 
use App\Enums\Generos;
use App\Enums\Irmaos;
use App\Enums\Series;
use App\Enums\SimNao;
use App\Enums\Transportes;
use App\Enums\Turnos;
use App\Enums\StatusInscricao;
use App\Http\Requests\EncontristaRequest;
use App\Models\Adolecente;
use App\Models\Encontrista;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdolecentesController extends Controller
{
    public function index(){

        $generos      = Generos::generos();   
        $listaStatus  = StatusInscricao::lista();    
        $request      = request();
        $ano          = $request->input('ano', Carbon::now()->format('Y'));   
        $status       = $request->input('status');    
        
        $statusClasses = [
            1 => 'text-bg-danger',   // Pendente
            2 => 'text-bg-primary',      // Visualizado
            3 => 'text-bg-success',   // Selecionado
        ];

        $query = Adolecente::where('ano_expresso', $ano);

        if($status){
            $query->where('status', $status);
        }

        $adolecentes = $query->get();

        return view('adolecentes.index', compact('adolecentes', 'generos', 'status', 'listaStatus', 'statusClasses', 'ano'));
    }    

    public function inscricao(){       

        $generos        = Generos::generos();
        $simNao         = SimNao::lista();   
        $irmaos         = Irmaos::lista();
        $series         = Series::lista();
        $turnos         = Turnos::lista();
        $contatos       = Contatos::lista();
        $transportes    = Transportes::lista();
        $ano            = Carbon::now()->format('Y');              

        return view('adolecentes.inscricao', compact('generos', 'simNao', 'ano', 'irmaos', 'series', 'turnos', 'contatos', 'transportes')); 
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

        Adolecente::create([     
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
            'status'                        => 1,       
        ]);
        
        return redirect(route('adolecentes.inscricao'))->with('msg', 'Inscrição de  ' . mb_strtoupper($request->nome) . ' realizada com sucesso!');
    }

    public function edit(Adolecente $adolecente){

        $generos        = Generos::generos();
        $simNao         = SimNao::lista();   
        $irmaos         = Irmaos::lista();
        $series         = Series::lista();
        $turnos         = Turnos::lista();
        $contatos       = Contatos::lista();
        $transportes    = Transportes::lista();
        
        //Atualiza o status para visualizado
        if($adolecente->status == StatusInscricao::PENDENTE){
            $adolecente->fill([
                'status' => 2,
            ]);

            $adolecente->save();
        }                

        return view('adolecentes.edit', compact('adolecente', 'generos', 'simNao', 'irmaos', 'series', 'turnos', 'contatos', 'transportes')); 
    }

    public function update(Adolecente $adolecente, EncontristaRequest $request){

        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            // Pasta onde será salva (em storage/app/public/fotos/)
            $pasta = 'fotos';

            // Nome do arquivo com slug + timestamp + extensão correta
            $nomeArquivo = strtolower(Str::slug($request->nome)) . '.' . $file->getClientOriginalExtension();

            // Remove a foto antiga se existir
            if ($adolecente->foto && Storage::disk('public')->exists($adolecente->foto)) {
                Storage::disk('public')->delete($adolecente->foto);
            }

            // salva em storage/app/public/fotos/
            $arquivoPath = $file->storeAs($pasta, $nomeArquivo, 'public');
            $adolecente->foto = $arquivoPath; // atualiza o campo da foto
        }

        $adolecente->fill([
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

        $adolecente->save();

        return redirect(route('adolecente.index'))->with('msg', 'Inscrição atualizada com sucesso!');
    }

    public function destroy(Adolecente $adolecente){

        $adolecente->delete();

        return redirect(route('adolecentes.index'))->with('msg', 'Registro excluído com sucesso!');
    }

    public function ficha(Adolecente $adolecente){    

        //Atualiza o status para visualizado
        if($adolecente->status == StatusInscricao::PENDENTE){
            $adolecente->fill([
                'status' => 2,
            ]);

            $adolecente->save();
        }     
        
        $generos        = Generos::generos();
        $simNao         = SimNao::lista();   
        $irmaos         = Irmaos::lista();
        $series         = Series::lista();
        $turnos         = Turnos::lista();
        $contatos       = Contatos::lista();
        $transportes    = Transportes::lista();   

        $pdf = Pdf::loadView('adolecentes.ficha', compact('adolecente', 'generos', 'simNao', 'irmaos', 'series', 'turnos', 'contatos', 'transportes'))->setPaper('a4', 'portrait');

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
        $listaStatus    = StatusInscricao::lista();    
        $request        = request();
        $ano            = $request->input('ano', Carbon::now()->format('Y'));     
        $status         = $request->input('status'); 

        $query = Adolecente::where('ano_expresso', $ano);

        if($status){
            $query->where('status', $status);
        }

        $adolecentes = $query->get(); 
        
        $csvNomeArquivo = tempnam(sys_get_temp_dir(), 'csv_' . Str::uuid());       
        $arquivoAberto  = fopen($csvNomeArquivo, 'w');

        // BOM UTF-8 para Excel
        fwrite($arquivoAberto, chr(0xEF).chr(0xBB).chr(0xBF));

        $topo = ['Relação de Inscrições - '.$ano, '', '', '', '','', '', '', '', ''];
        fputcsv($arquivoAberto, $topo, ';');        
        
        $cabecalho = ['NOME','DATA NASC','GÊNERO','ENDEREÇO','ESTUDA?','ESCOLA/SÉRIE/TURNO','TEM IRMÃOS?','PAIS CASADOS?','PAI/CONTATO','MÃE/CONTATO','OUTRO RESPONSÁVEL/CONTATO','CONTATO PRINCIPAL','POSSUI TRANSPORTE?','MORA COM?','ALGUM FAMILIAR PARTICIPA DA IGREJA?/QUEM/GRUPO','TEM PARENTE INSCRITO?/SE SIM, QUEM?','FAZ USO DE MEDICAMENTO?','FAZ TRATAMENTO SAÚDE?','TEM RESTRIÇÃO ALIMENTAR?','TEM ALERGIA?','ESTA DENTRO DO ESPECTRO AUTISTA?', 'STATUS'];

        fputcsv($arquivoAberto, $cabecalho, ';');

        foreach($adolecentes as $adolecente){
            $adolecenteArray = [
                'NOME' => $adolecente->nome,
                'DATA NASC' => $adolecente->data_nasc,
                'GÊNERO' => $generos[$adolecente->genero] ?? '',
                'ENDEREÇO' => $adolecente->endereco_rua . ', Nr ' . $adolecente->endereco_numero . ' - ' . $adolecente->endereco_bairro . ', ' . $adolecente->endereco_cidade . '/' . $adolecente->endereco_estado . ' - ' . $adolecente->endereco_complemento . ' - ' . $adolecente->endereco_cep,
                'ESTUDA?' => $simNao[$adolecente->estuda] ?? '',
                'ESCOLA/SÉRIE/TURNO' => ($adolecente->escola ? $adolecente->escola . ' - ' . $series[$adolecente->serie] . ' - ' . $turnos[$adolecente->turno] : ''),
                'TEM IRMÃOS?' => $irmaos[$adolecente->tem_irmaos] ?? '',
                'PAIS CASADOS?' => $simNao[$adolecente->pais_casados] ?? '',
                'PAI/CONTATO' => $adolecente->pai_nome . ' - ' . $adolecente->pai_contato,
                'MÃE/CONTATO' => $adolecente->mae_nome . ' - ' . $adolecente->mae_contato,
                'OUTRO RESP/CONTATO' => ($adolecente->outro_responsavel_nome ? $adolecente->outro_responsavel_nome . ' - ' . $adolecente->outro_responsavel_parentesco . ' - ' . $adolecente->outro_responsavel_contato : ''),
                'CONTATO PRINCIPAL' => $contatos[$adolecente->contato_principal],
                'POSSUI TRANSPORTE?' => $transportes[$adolecente->possui_transporte] ?? '',
                'MORA COM?' => $adolecente->mora_com,
                'ALGUM FAMILIAR PARTICIPA DA IGREJA?/QUEM/GRUPO' => ($simNao[$adolecente->familiar_participa] ?? '') .
                    ($adolecente->familiar_quem ? ', ' . $adolecente->familiar_quem . ' - ' . $adolecente->familiar_grupo : ''),
                'TEM PARENTE INSCRITO?/SE SIM, QUEM?' => ($simNao[$adolecente->tem_parente_inscrito] ?? '') . 
                    ($adolecente->parente_inscrito_nome ? ', ' . $adolecente->parente_inscrito_nome : ''),
                'FAZ USO DE MEDICAMENTO?' => ($simNao[$adolecente->uso_medicamento] ?? '') . 
                    ($adolecente->uso_medicamento_descricao ? ', ' . $adolecente->uso_medicamento_descricao : ''),
                'FAZ TRATAMENTO SAÚDE?' => ($simNao[$adolecente->tratamento_saude] ?? '') . 
                    ($adolecente->tratamento_saude_descricao ? ', ' . $adolecente->tratamento_saude_descricao : ''),
                'TEM RESTRIÇÃO ALIMENTAR?' => ($simNao[$adolecente->restricao_alimentar] ?? '') .  
                    ($adolecente->restricao_alimentar_descricao ? ', ' . $adolecente->restricao_alimentar_descricao : ''),
                'TEM ALERGIA?' => ($simNao[$adolecente->alergia] ?? '') . 
                    ($adolecente->alergia_descricao ? ', ' . $adolecente->alergia_descricao : ''),
                'ESTA DENTRO DO ESPECTRO AUTISTA?' => ($simNao[$adolecente->espectro_autista] ?? '') . 
                    ($adolecente->espectro_autista_descricao ? ', ' . $adolecente->espectro_autista_descricao : ''),   
                'STATUS' => ($listaStatus[$adolecente->status] ?? ''),             
            ];
            
            fputcsv($arquivoAberto, $adolecenteArray, ';');
        }
        
        fclose($arquivoAberto);
        
        return response()->download($csvNomeArquivo, 'Relacao_adolecentes.csv')->deleteFileAfterSend(true);
    }

    public function aprovar(Adolecente $adolecente){ 

        //calcular a idade do jovem e incluir ele numa fraternidade
        $fraternidade = calcularFraternidade($adolecente->data_nasc);        

        Encontrista::create([     
            'nome'                          => mb_strtoupper($adolecente->nome, 'UTF-8'),          
            'data_nasc'                     => $adolecente->data_nasc,
            'genero'                        => $adolecente->genero,
            'ano_expresso'                  => $adolecente->ano_expresso,
            'endereco_cep'                  => $adolecente->endereco_cep,
            'endereco_rua'                  => mb_strtoupper($adolecente->endereco_rua, 'UTF-8'),
            'endereco_numero'               => $adolecente->endereco_numero,
            'endereco_bairro'               => mb_strtoupper($adolecente->endereco_bairro, 'UTF-8'),
            'endereco_cidade'               => mb_strtoupper($adolecente->endereco_cidade, 'UTF-8'),
            'endereco_estado'               => $adolecente->endereco_estado,
            'endereco_complemento'          => mb_strtoupper($adolecente->endereco_complemento, 'UTF-8'),
            'estuda'                        => $adolecente->estuda,
            'escola'                        => mb_strtoupper($adolecente->escola, 'UTF-8'), 
            'serie'                         => $adolecente->serie,
            'turno'                         => $adolecente->turno,
            'tem_irmaos'                    => $adolecente->tem_irmaos,
            'pais_casados'                  => $adolecente->pais_casados,            
            'pai_nome'                      => mb_strtoupper($adolecente->pai_nome, 'UTF-8'),
            'pai_contato'                   => $adolecente->pai_contato,
            'mae_nome'                      => mb_strtoupper($adolecente->mae_nome, 'UTF-8'),
            'mae_contato'                   => $adolecente->mae_contato,
            'outro_responsavel_nome'        => mb_strtoupper($adolecente->outro_responsavel_nome, 'UTF-8'),
            'outro_responsavel_contato'     => $adolecente->outro_responsavel_contato,
            'outro_responsavel_parentesco'  => mb_strtoupper($adolecente->outro_responsavel_parentesco, 'UTF-8'),
            'contato_principal'             => $adolecente->contato_principal,
            'possui_transporte'             => $adolecente->possui_transporte,
            'mora_com'                      => mb_strtoupper($adolecente->mora_com, 'UTF-8'),
            'familiar_participa'            => $adolecente->familiar_participa,
            'familiar_quem'                 => mb_strtoupper($adolecente->familiar_quem, 'UTF-8'),
            'familiar_grupo'                => mb_strtoupper($adolecente->familiar_grupo, 'UTF-8'),
            'tem_parente_inscrito'          => $adolecente->tem_parente_inscrito,
            'parente_inscrito_nome'         => mb_strtoupper($adolecente->parente_inscrito_nome, 'UTF-8'),
            'uso_medicamento'               => $adolecente->uso_medicamento,
            'uso_medicamento_descricao'     => mb_strtoupper($adolecente->uso_medicamento_descricao, 'UTF-8'),
            'tratamento_saude'              => $adolecente->tratamento_saude,
            'tratamento_saude_descricao'    => mb_strtoupper($adolecente->tratamento_saude_descricao, 'UTF-8'),
            'restricao_alimentar'           => $adolecente->restricao_alimentar,
            'restricao_alimentar_descricao' => mb_strtoupper($adolecente->restricao_alimentar_descricao, 'UTF-8'),
            'alergia'                       => $adolecente->alergia,
            'alergia_descricao'             => mb_strtoupper($adolecente->alergia_descricao, 'UTF-8'),
            'espectro_autista'              => $adolecente->espectro_autista,
            'espectro_autista_descricao'    => mb_strtoupper($adolecente->espectro_autista_descricao, 'UTF-8'),            
            'foto'                          => $adolecente->foto,           
            'fraternidade'                  => $fraternidade,       
        ]);

        //Atualiza o status para visualizado
        $adolecente->fill([
            'status' => 3,
        ]);

        $adolecente->save();
        
        return redirect(route('adolecentes.index'))->with('msg', 'A inscrição de ' . mb_strtoupper($adolecente->nome) . ' foi aprovada!');
    }
}