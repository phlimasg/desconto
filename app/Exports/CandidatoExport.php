<?php

namespace App\Exports;

use App\Model\candidato;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CandidatoExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(Request $request)    
    {
        $this->request = $request;
    }
    public function headings(): array
    {
        return [
            '#',
            'Nome',
            'Desconto em %',
            'Dt. Autorização'            
        ];
    }
    public function collection()
    {        
        return candidato::select('id_cand', 'nome_cand', 'desc_aut', 'updated_at')
        ->where('status_id', $this->request->id)
        ->whereRaw('updated_at BETWEEN "'.$this->request->dt_ini.'" and "'.$this->request->dt_fim.'"')
        ->orderBy('nome_cand')
        ->get();
    }
}
