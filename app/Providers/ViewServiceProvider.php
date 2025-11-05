<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Adolecente;
use App\Enums\StatusInscricao;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Compartilha o contador de pendentes com todas as views
        View::composer('*', function ($view) {
            $pendentesCount = Adolecente::where('status', StatusInscricao::PENDENTE)->count();
            $view->with('pendentesCount', $pendentesCount);
        });
    }

    public function register(): void
    {
        //
    }
}
