<?php

namespace App\Exports;

use App\Models\Dados;
use Maatwebsite\Excel\Concerns\FromCollection;

class DadosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Dados::all();
    }
}
