<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dados;
use Excel;
use App\Imports\DadosImport;

class DadosController extends Controller
{
    public function importForm()
    {
        return view('import-form');
    }

    public function import(Request $request)
    {
        Excel::import(new DadosImport, $request->file);
        return "Importação bem sucedida!";
    }
}
