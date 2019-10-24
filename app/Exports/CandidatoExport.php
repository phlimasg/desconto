<?php

namespace App\Exports;

use App\Model\candidato;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class CandidatoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(Request $request)    
    {
        $this->request = $request;
    }
    public function collection()
    {
        
        return candidato::select('id_cand', 'nome_cand', 'desc_aut', 'updated_at')
        ->where('status_id', $this->request->id)
        ->whereRaw('updated_at BETWEEN "'.$this->request->dt_ini.'" and "'.$this->request->dt_fim.'"')
        ->orderBy('updated_at')
        ->get();
    }
}
