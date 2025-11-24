<?php

namespace App\Http\Controllers;

use App\Enums\Equipes;
use App\Enums\PerfilAdultos;
use App\Enums\SimNao;
use App\Enums\StatusInscricao;
use App\Http\Requests\AdultoRequest;
use App\Models\Adulto;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdultosController extends Controller
{
    public function index(){
        
        $listaStatus  = StatusInscricao::lista();    
        $request      = request();
        $ano          = $request->input('ano', Carbon::now()->format('Y'));   
        $status       = $request->input('status');   
        $perfis       = PerfilAdultos::lista();
        
        $statusClasses = [
            1 => 'text-bg-danger',      // Pendente
            2 => 'text-bg-primary',     // Visualizado
            3 => 'text-bg-success',     // Selecionado
        ];

        $query = Adulto::where('ano_expresso', $ano);

        if($status){
            $query->where('status', $status);
        }

        $adultos = $query->get();

        return view('adultos.index', compact('adultos', 'status', 'listaStatus', 'statusClasses', 'ano', 'perfis'));
    }    

    public function inscricao(){       
        
        $ano     = Carbon::now()->format('Y');   
        $perfis  = PerfilAdultos::lista();     
        $simNao  = SimNao::lista();  
        $equipes = Equipes::equipes();    

        return view('adultos.inscricao', compact('simNao', 'ano', 'perfis', 'equipes')); 
    }

    public function store(AdultoRequest $request){   
        
        //dd($request);
        
        $arquivoPath = null;

        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            // Pasta onde será salva (em storage/app/public/fotos/adultos)
            $pasta = 'fotos/adultos';

            // Nome do arquivo com slug + timestamp + extensão correta
            $nomeArquivo = strtolower(Str::slug($request->nome)) . '.' . $file->getClientOriginalExtension();

            // salva em storage/app/public/fotos/adultos
            $arquivoPath = $file->storeAs($pasta, $nomeArquivo, 'public');
        }          

        Adulto::create([     
            'nome'                          => mb_strtoupper($request->nome, 'UTF-8'),          
            'perfil'                        => $request->perfil,
            'idade'                         => $request->idade,
            'ano_expresso'                  => $request->ano_expresso,
            'endereco_cep'                  => $request->endereco_cep,
            'endereco_rua'                  => mb_strtoupper($request->endereco_rua, 'UTF-8'),
            'endereco_numero'               => $request->endereco_numero,
            'endereco_bairro'               => mb_strtoupper($request->endereco_bairro, 'UTF-8'),
            'endereco_cidade'               => mb_strtoupper($request->endereco_cidade, 'UTF-8'),
            'endereco_estado'               => $request->endereco_estado,
            'endereco_complemento'          => mb_strtoupper($request->endereco_complemento, 'UTF-8'),
            'contato'                       => $request->contato,
            'instagram'                     => $request->instagram,
            'frequenta_paroquia'            => $request->frequenta_paroquia,
            'qual_paroquia'                 => $request->qual_paroquia,
            'participou_expresso'           => $request->participou_expresso,
            'ano_participacao'              => $request->ano_participacao, 
            'serviu_expresso'               => $request->serviu_expresso,            
            'experiencias_servico'          => mb_strtoupper($request->experiencias_servico, 'UTF-8'),            
            'vagao_1'                       => $request->vagao_1,
            'vagao_2'                       => $request->vagao_2,
            'vagao_3'                       => $request->vagao_3,
            'participa_pastoral'            => $request->participa_pastoral,
            'qual_pastoral'                 => mb_strtoupper($request->qual_pastoral, 'UTF-8'),
            'serviu_ejc_ecc'                => $request->serviu_ejc_ecc,
            'foto'                          => $arquivoPath,           
            'status'                        => 1,       
        ]);
        
        return redirect(route('adultos.inscricao'))->with('msg', 'Inscrição de  ' . mb_strtoupper($request->nome) . ' realizada com sucesso!');
    }

    public function destroy(Adulto $adulto){

        // Se existir foto, deleta o arquivo
        if ($adulto->foto && Storage::disk('public')->exists($adulto->foto)) {
            Storage::disk('public')->delete($adulto->foto);
        }

        $adulto->delete();

        return redirect(route('adultos.index'))->with('msg', 'Registro excluído com sucesso!');
    }

    public function ficha(Adulto $adulto){    

        //Atualiza o status para visualizado
        if($adulto->status == StatusInscricao::PENDENTE){
            $adulto->fill([
                'status' => 2,
            ]);

            $adulto->save();
        }     
        
        $perfis  = PerfilAdultos::lista();     
        $simNao  = SimNao::lista();  
        $equipes = Equipes::equipes(); 

        $pdf = Pdf::loadView('adultos.ficha', compact('adulto', 'simNao', 'perfis', 'equipes'))->setPaper('a4', 'portrait');

        return response($pdf->output())->header('Content-Type', 'application/pdf');
    }

    public function gerarCsv(){

        $perfis         = PerfilAdultos::lista();     
        $simNao         = SimNao::lista();  
        $equipes        = Equipes::equipes(); 
        $listaStatus    = StatusInscricao::lista(); 
        $request        = request();
        $ano            = $request->input('ano', Carbon::now()->format('Y'));   
        $status         = $request->input('status'); 

        $query = Adulto::where('ano_expresso', $ano);

        if($status){
            $query->where('status', $status);
        }

        $adultos = $query->get(); 
        
        $csvNomeArquivo = tempnam(sys_get_temp_dir(), 'csv_' . Str::uuid());       
        $arquivoAberto  = fopen($csvNomeArquivo, 'w');

        // BOM UTF-8 para Excel
        fwrite($arquivoAberto, chr(0xEF).chr(0xBB).chr(0xBF));

        $topo = ['Relação de Inscrições - '.$ano, '', '', '', '','', '', '', '', ''];
        fputcsv($arquivoAberto, $topo, ';');        
        
        $cabecalho = ['NOME','PERFIL','IDADE','ENDEREÇO','CONTATO','INSTAGRAM','FREQUENTA PARÓQUIA?','QUAL PARÓQUIA','JÁ PARTICIPOU DO EXPRESSO?','ANO PARTICIPAÇÃO','JÁ SERVIU NO EXPRESSO?','EXPERIÊNCIAS DE SERVIÇO','VAGÕES QUE SE IDENTIFICA','PARTICIPA DE PASTORAL?','QUAL PASTORAL','JÁ SERVIU NO EJC/ECC?','STATUS'];

        fputcsv($arquivoAberto, $cabecalho, ';');

        foreach($adultos as $adulto){
            $adultoArray = [
                'NOME'                      => $adulto->nome ?? '',
                'PERFIL'                    => $perfis[$adulto->perfil] ?? '',
                'IDADE'                     => $adulto->idade ?? '',
                'ENDEREÇO'                  => $adulto->endereco_rua . ', Nr ' . $adulto->endereco_numero . ' - ' . $adulto->endereco_bairro . ', ' . $adulto->endereco_cidade . '/' . $adulto->endereco_estado . ' - ' . $adulto->endereco_complemento . ' - ' . $adulto->endereco_cep,
                'CONTATO'                   => $adulto->contato ?? '',
                'INSTAGRAM'                 => $adulto->instagram ?? '',
                'FREQUENTA PARÓQUIA?'       => $simNao[$adulto->frequenta_paroquia] ?? '',
                'QUAL PARÓQUIA'             => $adulto->qual_paroquia ?? '',
                'JÁ PARTICIPOU DO EXPRESSO?'=> $simNao[$adulto->participou_expresso] ?? '',
                'ANO PARTICIPAÇÃO'          => $adulto->ano_participacao ?? '',
                'JÁ SERVIU NO EXPRESSO?'    => $simNao[$adulto->serviu_expresso] ?? '',
                'EXPERIÊNCIAS DE SERVIÇO'   => $adulto->experiencias_servico ?? '',
                'VAGÕES QUE SE IDENTIFICA'  => ($equipes[$adulto->vagao_1] ?? '') . ', ' . ($equipes[$adulto->vagao_2] ?? '') . ', ' . ($equipes[$adulto->vagao_3] ?? ''),
                'PARTICIPA DE PASTORAL?'    => $simNao[$adulto->participa_pastoral] ?? '',
                'QUAL PASTORAL'             => $adulto->qual_pastoral ?? '',
                'JÁ SERVIU NO EJC/ECC?'     => $simNao[$adulto->serviu_ejc_ecc] ?? '',
                'STATUS'                    => $listaStatus[$adulto->status] ?? '',             
            ];
            
            fputcsv($arquivoAberto, $adultoArray, ';');
        }
        
        fclose($arquivoAberto);
        
        return response()->download($csvNomeArquivo, 'Relacao_adultos.csv')->deleteFileAfterSend(true);
    }

    public function aprovar(Adulto $adulto){

    }
}