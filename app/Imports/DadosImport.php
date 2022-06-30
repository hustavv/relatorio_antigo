<?php

namespace App\Imports;

use App\Models\Dados;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class DadosImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ";"
        ];
    }

    // public function model(array $row)
    // {
    //     return new Dados([
    //         'nome_aluno' => $row['nome_aluno'],
    //         'cpf_aluno' => $row['cpf_aluno'],
    //         'matricula_aluno' => $row['matricula_aluno'],
    //         'nome_curso' => $row['nome_curso'],
    //         'nome_disciplina'=> $row['nome_disciplina'],
    //         'codigo_curso' => $row['codigo_curso'],
    //         'codigo_disciplina' => $row['codigo_disciplina'],
    //         'polo' => $row['polo'],
    //         'ad1' => $row['ad1'],
    //         'ap1' => $row['ap1'],
    //         'ad2' => $row['ad2'],
    //         'ap2' => $row['ap2'],
    //         'ap3' => $row['ap3'],
    //         'data_importacao' => date('Y-m-d'),
    //         'data_geracao_arquivo' => $row['data_geracao_arquivo'],
    //         'responsavel_id' =>  $_SESSION['idusuario']
    //     ]);
    // }
    public function collection(Collection $rows)
    {   
        $idsemestre = DB::table('semestre')->select('idsemestre')->where('inicio', '<=', date('Y-m-d'))
        ->where('fim', '>=', date('Y-m-d'))->get()->first();
        // dd($teste);


        foreach ($rows as $row) {
            Dados::updateOrCreate(
                [
                    'nome_aluno' => $row['nome_aluno'],
                    'cpf_aluno' => $row['cpf_aluno'],
                    'matricula_aluno' => $row['matricula_aluno'],
                    'nome_curso' => $row['nome_curso'],
                    'nome_disciplina' => $row['nome_disciplina'],
                    'codigo_curso' => $row['codigo_curso'],
                    'codigo_disciplina' => $row['codigo_disciplina'],
                    'polo' => $row['polo'],
                    'idsemestre' => $idsemestre->idsemestre


                ],
                [
                    'ad1' => $row['ad1'],
                    'ap1' => $row['ap1'],
                    'ad2' => $row['ad2'],
                    'ap2' => $row['ap2'],
                    'ap3' => $row['ap3'],
                    'data_importacao' => date('Y-m-d'),
                    'data_geracao_arquivo' => $row['data_geracao_arquivo'],
                    'responsavel_id' =>  $_SESSION['idusuario']
                ]
            );
        }
    }
}
