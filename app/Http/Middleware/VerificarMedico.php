<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificarMedico
{
    public function handle(Request $request, Closure $next)
    {
        if (!session("medico_logado")) {
            return redirect()->route("page_login")->with("erro", "Faça o login primeiro");
        }

        return $next($request);
    }
}