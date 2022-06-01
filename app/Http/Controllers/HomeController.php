<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dados;
use Excel;
use App\Imports\DadosImport;

class HomeController extends Controller
{
    public function home()
    {
        $data = [];
        return view('site.home', ['titulo' => 'Home (teste)'], compact('data'));
    }
    public function import(Request $request)
    {
        Excel::import(new DadosImport, $request->file);
        return redirect()->route('site.index');
    }
    public function filtragem(Request $request)
    {

        $curso = $request->input('select_curso');
        $disciplina = $request->input('select_disc');
        $polo = $request->input('select_polo');
        $media = $request->input('media');

        $data = [];

       

        if (!empty($curso) && empty($disciplina) && empty($polo)){
            $data = Dados::where('codigo_curso', $curso)->get();
            
        } 
        elseif (!empty($curso) && !empty($disciplina) && empty($polo)){
            $data = Dados::where('codigo_curso', $curso)
                            ->where('codigo_disciplina', $disciplina)->get();

        } 
        elseif (!empty($curso) && !empty($disciplina) && !empty($polo)){
            $data = Dados::where('codigo_curso', $curso)
                            ->where('codigo_disciplina', $disciplina)
                            ->where('polo', $polo)
                            ->get();

        } 
        elseif (empty($curso) && !empty($disciplina) && empty($polo)){
            $data = Dados::where('codigo_disciplina', $disciplina)->get();
            
        } 
        elseif (empty($curso) && !empty($disciplina) && !empty($polo)){
            $data = Dados::where('codigo_disciplina', $disciplina)
                            ->where('polo', $polo)->get();

        }
        elseif (empty($curso) && empty($disciplina) && !empty($polo)){
            $data = Dados::where('polo', $polo)->get();
            
        } 
        elseif (!empty($curso) && empty($disciplina) && !empty($polo)){
            $data = Dados::where('codigo_curso', $curso)
                            ->where('polo', $polo)->get();

        } 
        

        // if ($media == 1) {
            
        // }

        // $data = Dados::where(function($query) use($curso, $disciplina, $polo){
        //     $query->orWhere('codigo_curso', $curso)->
        //             orWhere('codigo_disciplina', $disciplina)->   
        //             orwhere('polo', $polo);

        // })->get();


        // if (empty($curso) == false) {
        //     $data = Dados::where('codigo_curso', $curso)->get();
        // }

        // if (empty($disciplina) == false) {
        //     $data = Dados::where('codigo_disciplina', $disciplina)->get();
        // }

        // if (empty($polo) == false) {
        //     $data = Dados::where('polo', $polo)->get();
        // }


        // $data = Dados::where('codigo_curso', $curso)->orWhere('codigo_disciplina', $disciplina)->orWhere('polo', $polo)->get();

        // print_r($disciplina);
        return view('site.home', ['titulo' => 'Home (teste)'], compact('data'));
    }
}
