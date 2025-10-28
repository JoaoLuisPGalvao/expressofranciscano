<?php

namespace App\Http\Controllers;

use App\Enums\Generos;
use App\Models\Encontrista;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){

        $request = request();
        $ano     = $request->input('ano', Carbon::now()->format('Y'));   
        $generos = Generos::generos();         

        // Conta quantos encontristas há por gênero
         $porGenero = Encontrista::select('genero', DB::raw('COUNT(*) as total'))
            ->where('ano_expresso', $ano)
            ->groupBy('genero')
            ->pluck('total', 'genero');
        
        $contagem = [];

        foreach ($generos as $key => $label) {
            $contagem[$label] = $porGenero[$key] ?? 0;
        }       

        return view('home.index', compact('contagem'));
    }
}