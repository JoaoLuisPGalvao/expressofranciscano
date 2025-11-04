<?php

namespace App\Http\Controllers;

use App\Enums\Fraternidades;
use App\Enums\Generos;
use App\Models\Encontrista;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){

        $request       = request();
        $ano           = $request->input('ano', Carbon::now()->format('Y'));   
        $generos       = Generos::generos();      
        $fraternidades = Fraternidades::lista();   

        // Conta quantos encontristas há por gênero
        $porGenero = Encontrista::select('genero', DB::raw('COUNT(*) as total'))
            ->where('ano_expresso', $ano)
            ->groupBy('genero')
            ->pluck('total', 'genero');

        $contagemGenero = [];

        foreach ($generos as $key => $label) {
            $contagemGenero[$label] = $porGenero[$key] ?? 0;
        }       

        // Conta quantos encontristas há por fraternidade
        $porFraternidade = Encontrista::select('fraternidade', DB::raw('COUNT(*) as total'))
            ->where('ano_expresso', $ano)
            ->groupBy('fraternidade')
            ->pluck('total', 'fraternidade');

        $contagemFraternidade = [];

        foreach ($fraternidades as $key => $label) {
            $contagemFraternidade[$label] = $porFraternidade[$key] ?? 0;
        }               

        return view('home.index', compact('contagemGenero', 'contagemFraternidade'));
    }
}