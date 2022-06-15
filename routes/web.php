<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/{cpf}', function (string $cpf) {

    $tabela = DB::table('usuario');

    $usuario = $tabela->where('cpf', $cpf)->get()->first();

    if (isset($usuario->nome)) {
        //dd($usuario);
        session_start();
        $_SESSION['idusuario'] = $usuario->idusuario;
        $_SESSION['iddepartamento'] = $usuario->iddepartamento;
        $_SESSION['idperfil'] = $usuario->idperfil;
        $_SESSION['idusuariotipo'] = $usuario->idusuariotipo;
        $_SESSION['senha'] = $usuario->senha;
        $_SESSION['nome'] = $usuario->nome;
        $_SESSION['email'] = $usuario->email;
        $_SESSION['cpf'] = $usuario->cpf;
        $_SESSION['ativo'] = $usuario->ativo;
        $_SESSION['municipio'] = $usuario->municipio;
        $_SESSION['telefone'] = $usuario->telefone;
        $_SESSION['cep'] = $usuario->cep;
        $_SESSION['endereco'] = $usuario->enderecao;
        $_SESSION['alt'] = $usuario->alt;
        $_SESSION['onoff'] = $usuario->onoff;
        $_SESSION['idauth'] = $usuario->idauth;

        // dd($_SESSION);

        if ($_SESSION['idusuariotipo'] == 4) {
            return redirect()->route('site.index');
        } else {
            dd($_SESSION);
        }
    } else {
        return Redirect::away('https://cesad.ufs.br/ORBI/acesso');
    }

    // return redirect()->route('site.index');
});
Route::middleware('AuthMd')->prefix('/relatorio_antigo')->group(function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'home'])->name('site.index');

    Route::post('/home/filtro', [\App\Http\Controllers\HomeController::class, 'filtragem'])->name('site.filtro');

    Route::get('home/filtro-disciplina', [\App\Http\Controllers\HomeController::class, 'loadDisc'])->name('load.disc');
    Route::get('home/filtro-curso', [\App\Http\Controllers\HomeController::class, 'loadCurso'])->name('load.curso');
    Route::post('/import', [App\Http\Controllers\HomeController::class, 'import'])->name('dados.import');
});



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/import-form', [App\Http\Controllers\DadosController::class, 'importForm']);

// Route::post('/import', [App\Http\Controllers\HomeController::class, 'import'])->name('dados.import');
