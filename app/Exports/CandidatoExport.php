<?php

namespace App\Exports;

use App\Model\candidato;
use App\Model\inscricao;
use App\Model\totvs;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CandidatoExport implements FromCollection, WithHeadings, ShouldAutoSize
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
        
        /*
        $mensalidades = [
            [
                'esc' => 'ENSINO FUNDAMENTAL I',
                'ano' => '1º ano',
                'mensalidade' => '1780'
            ],
            [
                'esc' => 'ENSINO FUNDAMENTAL I',
                'ano' => '2º ano',
                'mensalidade' => '1520'
            ],
            [
                'esc' => 'ENSINO FUNDAMENTAL I',
                'ano' => '3º ano',
                'mensalidade' => '1520'
            ],
            [
                'esc' => 'ENSINO FUNDAMENTAL I',
                'ano' => '4º ano',
                'mensalidade' => '1520'
            ],
            [
                'esc' => 'ENSINO FUNDAMENTAL I',
                'ano' => '5º ano',
                'mensalidade' => '1520'
            ],
            [
                'esc' => 'ENSINO FUNDAMENTAL I',
                'ano' => '6º ano',
                'mensalidade' => '1520'
            ],
            [
                'esc' => 'ENSINO FUNDAMENTAL I',
                'ano' => '7º ano',
                'mensalidade' => '1520'
            ],
            [
                'esc' => 'ENSINO FUNDAMENTAL I',
                'ano' => '8º ano',
                'mensalidade' => '1520'
            ],
            [
                'esc' => 'ENSINO FUNDAMENTAL I',
                'ano' => '9º ano',
                'mensalidade' => '1520'
            ],
            [
                'esc' => 'ENSINO MÉDIO',
                'ano' => '1ª série',
                'mensalidade' => '1520'
            ],
            [
                'esc' => 'ENSINO MÉDIO',
                'ano' => '2ª série',
                'mensalidade' => '1700'
            ],
            [
                'esc' => 'ENSINO MÉDIO',
                'ano' => '3ª série',
                'mensalidade' => '2150'
            ],
            
        ];
        //dd($this->request->all());
        $relatorio = candidato::select('id_cand', 'nome_cand', 'desc_aut', 'updated_at')
        ->where('status_id', $this->request->id)
        ->whereRaw('updated_at BETWEEN "'.$this->request->dt_ini.'" and "'.$this->request->dt_fim.'"')
        ->orderBy('nome_cand')
        ->get();
        $excel =  null;
        foreach ($relatorio as $r) {            
            $candidato = inscricao::where('id',$r->id_cand)->first();
            if(empty($candidato)){
                $candidato = totvs::where('RA',$r->id_cand)->first();
                foreach ($mensalidades as $i) {
                    //dd($candidato,$r,$i);
                    //dd($i);
                    if(strcasecmp(mb_strtoupper($i['ano']) , $candidato->ANO) == 0){                    
                        $excel.=collect([
                            'id_cand'=>$candidato->RA,
                            'nome_cand'=>$candidato->NOME_ALUNO,
                            'desc_aut'=>$r->desc_aut,
                            'updated_at'=>$r->updated_at,
                            'mensalidade'=>$i['mensalidade']
                        ]);
                    }
                }
                dd($excel);
            }else{
                foreach ($mensalidades as $i) {
                    if(strcasecmp(mb_strtoupper($i['ano']) , $candidato->ANO) == 0){                    
                        $excel .= ([
                            'id_cand'=>$candidato->id_cand,
                            'nome_cand'=>$candidato->nome_cand,
                            'desc_aut'=>$candidato->desc_aut,
                            'updated_at'=>$candidato->updated_at,
                            'mensalidade'=>$i['mensalidade']
                        ]);
                    }
                }
            }        
        }
        dd($candidato);
        //dd($candidato);
        dd($mensalidades, $candidato,$candidato_mensalidade) ;*/
        return candidato::select('id_cand', 'nome_cand', 'desc_aut', 'updated_at')
        ->where('status_id', $this->request->id)
        ->whereRaw('updated_at BETWEEN "'.$this->request->dt_ini.'" and "'.$this->request->dt_fim.'"')
        ->orderBy('nome_cand')
        ->get();
        
    }
}
