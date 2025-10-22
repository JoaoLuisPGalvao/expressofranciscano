<?php

namespace App\Http\Controllers;

class EncontristasController extends Controller
{
    public function index(){
        
        return view('encontristas.index');
    }
}