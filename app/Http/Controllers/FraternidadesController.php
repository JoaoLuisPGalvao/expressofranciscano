<?php

namespace App\Http\Controllers;

use App\Enums\Fraternidades;
use App\Models\Encontrista;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FraternidadesController extends Controller
{
    public function index(){
           
        $request       = request();
        $ano           = $request->input('ano', Carbon::now()->format('Y'));    
        $fraternidade  = $request->input('fraternidade');  
        $fraternidades = Fraternidades::lista();
        $encontristas  = Encontrista::where('ano_expresso', $ano)->where('fraternidade', $fraternidade)->get();

        return view('fraternidades.index', compact('encontristas', 'ano', 'fraternidade', 'fraternidades'));
    } 

    public function edit(Encontrista $encontrista){

        $fraternidades = Fraternidades::lista();      

        return view('fraternidades.edit', compact('encontrista', 'fraternidades')); 
    }

    public function update(Encontrista $encontrista, Request $request){
        
        $ano           = $encontrista->ano_expresso;    
        $fraternidade  = $request->fraternidade;  

        $encontrista->fill([            
            'fraternidade' => ($request->fraternidade),
        ]);

        $encontrista->save();

        return redirect(route('fraternidades.index', compact('ano', 'fraternidade')))->with('msg', 'Fraternidade atualizada com sucesso!');
    }    

    public function gerarPdf(){    
        
        $request            = request();
        $ano                = $request->input('ano', Carbon::now()->format('Y')); 
        $fraternidade       = $request->input('fraternidade'); 
        $fraternidades      = Fraternidades::lista();
        $nomeFraternidade   = $fraternidades[$request->input('fraternidade')];
        $encontristas       = Encontrista::where('ano_expresso', $ano)->where('fraternidade', $fraternidade)->get();

        $pdf = Pdf::loadView('fraternidades.gerarPdf', compact('encontristas', 'ano', 'nomeFraternidade'))->setPaper('a4', 'portrait');

        return response($pdf->output())->header('Content-Type', 'application/pdf');
    }
}