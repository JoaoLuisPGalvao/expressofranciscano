<?php

namespace App\Providers;

use App\Enums\NivelUser;
use App\Enums\SimNao;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('administrador', function(User $user){
            return $user->nivel === NivelUser::ADMINISTRADOR;
        });

        Gate::define('maquinista', function(User $user){
            return $user->nivel === NivelUser::MAQUINISTA;
        });

        Gate::define('locomotor', function(User $user){
            return $user->nivel === NivelUser::LOCOMOTOR;
        });

        Gate::define('excluir-registro', function (User $user) {
            return $user->can('administrador') || $user->can('maquinista');
        });
    }
}
