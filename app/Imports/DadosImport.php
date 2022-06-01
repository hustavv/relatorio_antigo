<?php

namespace App\Imports;

use App\Models\Dados;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DadosImport implements ToModel, WithHeadingRow
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
    public function model(array $row)
    {
        return new Dados([
            'nome_aluno' => $row['nome_aluno'],
            'cpf_aluno' => $row['cpf_aluno'],
            'matricula_aluno' => $row['matricula_aluno'],
            'codigo_curso' => $row['codigo_curso'],
            'codigo_disciplina' => $row['codigo_disciplina'],
            'polo' => $row['polo'],
            'ad1' => $row['ad1'],
            'ap1' => $row['ap1'],
            'ad2' => $row['ad2'],
            'ap2' => $row['ap2'],
            'ap3' => $row['ap3']
        ]);
    }
}
