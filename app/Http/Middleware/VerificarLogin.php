<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificarLogin
{
    public function handle(Request $request, Closure $next)
    {
        $usuario = session("usuario_logado");

        if (!$usuario) {
            return redirect()->route("page_login")->with("erro", "Faça o login primeiro");
        }

        return $next($request);
    }
}