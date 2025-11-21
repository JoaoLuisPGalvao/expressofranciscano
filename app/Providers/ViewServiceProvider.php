<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Adolecente;
use App\Enums\StatusInscricao;
use App\Models\Adulto;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Compartilha o contador de pendentes com todas as views
        View::composer('*', function ($view) {
            
            $adolecentesPendentes = Adolecente::where('status', StatusInscricao::PENDENTE)->count();
            $adultosPendentes     = Adulto::where('status', StatusInscricao::PENDENTE)->count();

            $view->with([
                'pendentesAdolecentes' => $adolecentesPendentes,
                'pendentesAdultos'     => $adultosPendentes,
            ]);
        });
    }

    public function register(): void
    {
        //
    }
}
