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

        $select_curso = $request->input('select_select_curso');
        $select_disciplina = $request->input('select_disc');
        $select_polo = $request->input('select_polo');
        $radio_media = $request->input('media');

        $data = [];

       

        if (!empty($select_curso) && empty($select_disciplina) && empty($select_polo)){
            $data = Dados::where('codigo_select_curso', $select_curso)->get();
            
        } 
        elseif (!empty($select_curso) && !empty($select_disciplina) && empty($polo)){
            $data = Dados::where('codigo_select_curso', $select_curso)
                            ->where('codigo_disciplina', $select_disciplina)->get();

        } 
        elseif (!empty($select_curso) && !empty($select_disciplina) && !empty($polo)){
            $data = Dados::where('codigo_select_curso', $select_curso)
                            ->where('codigo_disciplina', $select_disciplina)
                            ->where('polo', $polo)
                            ->get();

        } 
        elseif (empty($select_curso) && !empty($select_disciplina) && empty($polo)){
            $data = Dados::where('codigo_disciplina', $select_disciplina)->get();
            
        } 
        elseif (empty($select_curso) && !empty($select_disciplina) && !empty($polo)){
            $data = Dados::where('codigo_disciplina', $select_disciplina)
                            ->where('polo', $polo)->get();

        }
        elseif (empty($select_curso) && empty($select_disciplina) && !empty($polo)){
            $data = Dados::where('polo', $polo)->get();
            
        } 
        elseif (!empty($select_curso) && empty($select_disciplina) && !empty($polo)){
            $data = Dados::where('codigo_select_curso', $select_curso)
                            ->where('polo', $polo)->get();

        } 
        

        if ($radio_media == 1) {
            $data = Dados::where('codigo_select_curso', $select_curso)->get();
        }

        // $data = Dados::where(function($query) use($select_curso, $select_disciplina, $polo){
        //     $query->orWhere('codigo_select_curso', $select_curso)->
        //             orWhere('codigo_disciplina', $select_disciplina)->   
        //             orwhere('polo', $polo);

        // })->get();


        // if (empty($select_curso) == false) {
        //     $data = Dados::where('codigo_select_curso', $select_curso)->get();
        // }

        // if (empty($select_disciplina) == false) {
        //     $data = Dados::where('codigo_disciplina', $select_disciplina)->get();
        // }

        // if (empty($polo) == false) {
        //     $data = Dados::where('polo', $polo)->get();
        // }


        // $data = Dados::where('codigo_select_curso', $select_curso)->orWhere('codigo_disciplina', $select_disciplina)->orWhere('polo', $polo)->get();

        // print_r($select_disciplina);
        return view('site.home', ['titulo' => 'Home (teste)'], compact('data'));
    }
}
