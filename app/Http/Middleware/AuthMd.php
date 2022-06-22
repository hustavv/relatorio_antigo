<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthMd
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       
        session_start();

        if(isset($_SESSION['cpf']) && $_SESSION['cpf'] != ''){
            return $next($request);
            session_destroy();
        }else{
            return Redirect::away("https://cesad.ufs.br/ORBI/acesso");

           
        }
    
    }
}
