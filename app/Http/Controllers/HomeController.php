<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Select;
use Illuminate\Http\Request;
use App\Models\Dados;
use Excel;
use App\Imports\DadosImport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{   

    public function __construct()
{

    $this->middleware("AuthMd");

}
    public function home()
    {
        $lista_semestres = DB::table('semestre')->select('idsemestre','ano','semestre')->orderBy('idsemestre','desc')->get();

        $lista_polos = DB::table('polo')->select('nome')->orderBy('nome')->get();

        $data_atual = date('Y-m-d');

        $lista_cursos = DB::table('curso')->select('curso.idcurso', 'curso.nome', 'curso.codigo_curso_sigaa')
            ->join(
                'ofertacurso',
                'curso.idcurso',
                '=',
                'ofertacurso.idcurso'
            )->join('semestre', 'ofertacurso.idsemestre', '=', 'semestre.idsemestre')
                ->where('semestre.inicio', '<=', $data_atual)
                ->where('semestre.fim','>=', $data_atual)->orderBy('curso.nome')
                ->get();

        $lista_disc = DB::table('disciplina')->select('disciplina.iddisciplina','disciplina.codigodisciplina','disciplina.nome')
            ->join(
                'disciplinacurso',
                'disciplina.iddisciplina',
                '=',
                'disciplinacurso.iddisciplina'
            )->join(
                'ofertacurso',
                'disciplinacurso.idofertacurso',
                '=',
                'ofertacurso.idofertacurso'
            )->join('semestre', 'ofertacurso.idsemestre', '=', 'semestre.idsemestre')
            ->where('semestre.inicio', '<=', $data_atual)
            ->where('semestre.fim','>=', $data_atual)->orderBy('disciplina.nome')
            ->get();

        $data = [];
        return view('site.home', ['titulo' => 'Home (teste)'], compact('data', 'lista_cursos', 'lista_polos', 'lista_disc', 'lista_semestres'));
    }
    public function import(Request $request)
    {   
        $request->validate(['file'=>'required|mimes:csv,txt']);

        
        Excel::import(new DadosImport, $request->file);
        return redirect()->route('site.index');
    }

    
    public function filtragem(Request $request)
    {
        $data = [];
        $lista_polos = DB::table('polo')->select('nome')->orderBy('nome')->get();
        $lista_semestres = DB::table('semestre')->select('idsemestre','ano','semestre')->orderBy('idsemestre','desc')->get();

        $data_atual = date('Y-m-d');


        $lista_cursos = DB::table('curso')->select('curso.idcurso', 'curso.nome','curso.codigo_curso_sigaa')
            ->join(
                'ofertacurso',
                'curso.idcurso',
                '=',
                'ofertacurso.idcurso'
            )->join(
                'semestre', 
                'ofertacurso.idsemestre', 
                '=', 
                'semestre.idsemestre')
                ->where('semestre.inicio', '<=', $data_atual)
                ->where('semestre.fim','>=', $data_atual)->orderBy('curso.nome')
                ->get();

        $lista_disc = DB::table('disciplina')->select('disciplina.iddisciplina','disciplina.codigodisciplina','disciplina.nome')
            ->join(
                'disciplinacurso',
                'disciplina.iddisciplina',
                '=',
                'disciplinacurso.iddisciplina'
            )->join(
                'ofertacurso',
                'disciplinacurso.idofertacurso',
                '=',
                'ofertacurso.idofertacurso'
            )->join('semestre', 'ofertacurso.idsemestre', '=', 'semestre.idsemestre')
            ->where('semestre.inicio', '<=', $data_atual)
            ->where('semestre.fim','>=', $data_atual)->orderBy('disciplina.nome')
            ->get();

        
        $query = Dados::query();
               
                
        if ($request->select_semestre_request) {
            $query->where('idsemestre', $request->select_semestre_request);
        }
        if ($request->select_curso) {
            $query->where('codigo_curso', $request->select_curso);
        }

        if ($request->select_disc) {
            $query->where('codigo_disciplina', $request->select_disc);
        }

        if ($request->select_polo) {
            $query->where('polo', $request->select_polo);
        }

        if ($request->media == 1) {

            if ($request->ad1) {
                $query->where('ad1', '>=', 5);
            }
            if ($request->ap1) {
                $query->where('ap1', '>=', 5);
            }
            if ($request->ad2) {
                $query->where('ad2', '>=', 5);
            }
            if ($request->ap2) {
                $query->where('ap2', '>=', 5);
            }
            if ($request->ap3) {
                $query->where('ap3', '>=', 5);
            }
            if ($request->n1) {
                $query->whereRaw('(ad1*0.2)+(ap1*0.8) >= 5');
            }
            if ($request->n2) {
                $query->whereRaw('(ad2*0.2)+(ap2*0.8) >= 5');
            }
            if ($request->mf){
                $query->whereRaw('((ad1*0.2)+(ap1*0.8))+((ad2*0.2)+(ap2*0.8))/2 >= 5');
            }
            if (empty($request->ad1) && empty($request->ap1) && empty($request->ad2) && empty($request->ap2) && empty($request->ap3) && 
            empty($request->n1) && empty($request->n2) && empty($request->mf)) {
                $query->where(function ($query) {
                    $query->where('ad1', '>=', 5)
                        ->orWhere('ap1', '>=', 5)
                        ->orWhere('ad2', '>=', 5)
                        ->orWhere('ap2', '>=', 5)
                        ->orWhere('ap3', '>=', 5);
                });
            }
        }

        if ($request->media == 2) {

            if ($request->ad1) {
                $query->where('ad1', '<', 5);
            }
            if ($request->ap1) {
                $query->where('ap1', '<', 5);
            }
            if ($request->ad2) {
                $query->where('ad2', '<', 5);
            }
            if ($request->ap2) {
                $query->where('ap2', '<', 5);
            }
            if ($request->ap3) {
                $query->where('ap3', '<', 5);
            }
            if ($request->n1) {
                $query->whereRaw('(ad1*0.2)+(ap1*0.8) < 5');
            }
            if ($request->n2) {
                $query->whereRaw('(ad2*0.2)+(ap2*0.8) < 5');
            }
            if ($request->mf){
                $query->whereRaw('((ad1*0.2)+(ap1*0.8))+((ad2*0.2)+(ap2*0.8))/2 < 5');
            }
            if (empty($request->ad1) && empty($request->ap1) && empty($request->ad2) && empty($request->ap2) && empty($request->ap3) && 
            empty($request->n1) && empty($request->n2) && empty($request->mf)) {
                $query->where(function ($query) {
                    $query->where('ad1', '<', 5)
                        ->orWhere('ap1', '<', 5)
                        ->orWhere('ad2', '<', 5)
                        ->orWhere('ap2', '<', 5)
                        ->orWhere('ap3', '<', 5);
                });
            }
        }

        if ($request->media == 3) {


            if ($request->ad1) {
                $query->where('ad1', 0);
            }
            if ($request->ap1) {
                $query->where('ap1', 0);
            }
            if ($request->ad2) {
                $query->where('ad2', 0);
            }
            if ($request->ap2) {
                $query->where('ap2', 0);
            }
            if ($request->ap3) {
                $query->where('ap3', 0);
            }
            if ($request->n1) {
                $query->whereRaw('(ad1*0.2)+(ap1*0.8) = 0');
            }
            if ($request->n2) {
                $query->whereRaw('(ad2*0.2)+(ap2*0.8) = 0');
            }
            if ($request->mf){
                $query->whereRaw('((ad1*0.2)+(ap1*0.8))+((ad2*0.2)+(ap2*0.8))/2 = 0');
            }
            if (empty($request->ad1) && empty($request->ap1) && empty($request->ad2) && empty($request->ap2) && empty($request->ap3) && 
            empty($request->n1) && empty($request->n2) && empty($request->mf)) {
                $query->where(function ($query) {
                    $query->where('ad1', 0)
                        ->orWhere('ap1', 0)
                        ->orWhere('ad2', 0)
                        ->orWhere('ap2', 0)
                        ->orWhere('ap3', 0);
                });
            }
        }


        
        $data = $query->get();

        

       
       
        

        // print_r($teste);
       

        return view('site.home', ['titulo' => 'Home (teste)'], compact('data', 'lista_cursos', 'lista_polos', 'lista_disc', 'lista_cursos','lista_semestres'));
    }

    public function loadDisc(Request $request){
        $data_atual = date('Y-m-d');
        
        $dataForm = $request->all();
        $select_curso = $dataForm['select_curso'];  

    if (!empty($select_curso)){
        $lista_disc = DB::table('disciplina')->select('disciplina.iddisciplina','disciplina.codigodisciplina','disciplina.nome')->join(
            'disciplinacurso',
            'disciplina.iddisciplina',
                '=',
            'disciplinacurso.iddisciplina'
        )->join(
            'ofertacurso',
            'disciplinacurso.idofertacurso',
            '=',
            'ofertacurso.idofertacurso'
        )->join(
            'curso',
            'curso.idcurso',
            '=',
            'ofertacurso.idcurso'
        )->where('curso.codigo_curso_sigaa', $select_curso)
        ->join('semestre', 'ofertacurso.idsemestre', '=', 'semestre.idsemestre')
            ->where('semestre.inicio', '<=', $data_atual)
            ->where('semestre.fim','>=', $data_atual)
            ->orderBy('disciplina.nome')
            
        ->get();

    } else {
        $lista_disc = DB::table('disciplina')->select('disciplina.iddisciplina','disciplina.codigodisciplina','disciplina.nome')
        ->join(
            'disciplinacurso',
            'disciplina.iddisciplina',
            '=',
            'disciplinacurso.iddisciplina'
        )->join(
            'ofertacurso',
            'disciplinacurso.idofertacurso',
            '=',
            'ofertacurso.idofertacurso'
        )->join('semestre', 'ofertacurso.idsemestre', '=', 'semestre.idsemestre')
        ->where('semestre.inicio', '<=', $data_atual)
        ->where('semestre.fim','>=', $data_atual)->orderBy('disciplina.nome')
        ->get();
        
    }


        return view('site.layouts.select_disc_ajax', compact('lista_disc'));
    }

    public function loadCurso(Request $request){
        $data_atual = date('Y-m-d');

        $dataForm = $request->all();
        $select_disc = $dataForm['select_disc'];
       

        if (!empty($select_disc)) {
            $lista_cursos = DB::table('curso')->select('curso.idcurso','curso.nome','curso.codigo_curso_sigaa')
            ->join(
                'ofertacurso',
                'curso.idcurso',
                '=',
                'ofertacurso.idcurso'
            )->join(
                'disciplinacurso',
                'ofertacurso.idofertacurso',
                '=',
                'disciplinacurso.idofertacurso'
            )->join(
                'disciplina',
                'disciplinacurso.iddisciplina',
                '=',
                'disciplina.iddisciplina'
            )->where('disciplina.codigodisciplina', $select_disc) 
            ->join('semestre', 'ofertacurso.idsemestre', '=', 'semestre.idsemestre')
            ->where('semestre.inicio', '<=', $data_atual)
            ->where('semestre.fim','>=', $data_atual)
            ->orderBy('curso.nome')
            ->get();

        } else {
            $lista_cursos = DB::table('curso')->select('curso.idcurso', 'curso.nome')
            ->join(
                'ofertacurso',
                'curso.idcurso',
                '=',
                'ofertacurso.idcurso'
            )->join(
                'semestre', 
                'ofertacurso.idsemestre', 
                '=', 
                'semestre.idsemestre')
                ->where('semestre.inicio', '<=', $data_atual)
                ->where('semestre.fim','>=', $data_atual)->orderBy('curso.nome')
                ->get();
        }

    
        return view('site.layouts.select_curso_ajax', compact('lista_cursos'));

    }
}
