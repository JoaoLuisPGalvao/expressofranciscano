<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Tratar casos de usuário não autenticado (sessão expirada).
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // Se for requisição AJAX ou API, retorna JSON
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Sessão expirada. Faça login novamente.'], 401);
        }

        // Caso contrário, redireciona para login
        return redirect()->guest(route('login'))->with('error', 'Sua sessão expirou. Faça login novamente.');
    }
}
