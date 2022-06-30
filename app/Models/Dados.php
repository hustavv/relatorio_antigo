<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dados extends Model
{
    use HasFactory;


    public $timestamps = false;

    protected $table = 'dadosnotasimportadas';
    protected $primaryKey = 'id_relatorio';


    protected $fillable = [
        'id_relatorio',
        'nome_aluno',
        'cpf_aluno',
        'matricula_aluno',
        'codigo_curso',
        'codigo_disciplina',
        'polo',
        'ad1',
        'ap1',
        'ad2',
        'ap2',
        'ap3',
        'nome_curso',
        'nome_disciplina',
        'data_importacao',
        'data_geracao_arquivo',
        'responsavel_id',
        'idsemestre'
    ];

    public static function getDados(){
        $records = DB::table('dadosnotasimportadas')->select('id_relatorio','nome_aluno','cpf_aluno','matricula_aluno','codigo_curso','codigo_disciplina','polo','ad1','ap1','ad2','ap2','ap3');
        return $records;
    }

}
