<?php

namespace App\Http\Controllers\manager;

use App\Model\candidato;
use App\Model\candidatos_irmao;
use App\Model\composicaoFamiliar;
use App\Model\descontoAutorizado;
use App\Model\descontoSugerido;
use App\Model\documentos;
use App\Model\filiacao;
use App\Model\grupoFamiliar;
use App\Model\respfin;
use App\Model\status;
use App\Model\totvs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\grupoFamiliarNew;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Mpdf\Mpdf;

class candidatoController extends Controller
{
    public function index($id,$mat){
        $candidato = candidato::where('id_cand',$mat)
            ->first();
        $ir = totvs::whereIn(DB::raw('CAST(RA AS INT)'),candidatos_irmao::select('mat_insc_ci')->where('candidato_id_cand',$mat)->get())
            ->get();
        $comp = composicaoFamiliar::where('candidato_id_cand',$mat)->get();
        $doc = documentos::whereIn('composicaofamiliar_id_comp',composicaoFamiliar::select('id_comp')->where('candidato_id_cand',$mat)->get())->get();
        $fil = filiacao::where('candidato_id_cand',$mat)->first();
        $gpo = grupoFamiliarNew::where('candidato_id',$mat)->first();
        $resp = respfin::where('candidato_id_cand',$mat)->first();
        $desc_sug= descontoSugerido::where('candidato_id_cand',$mat)->orderBy('created_at')->first();
        return view('manager.candidato', compact(['candidato','ir','comp','doc','fil','gpo','resp','desc_sug']));
    }
    public function descontoSugerido($id,$mat, Request $request){
        $request->validate([
            'desconto' => 'required'
        ]);
        candidato::where('id_cand',$mat)
            ->update(['desc_sug' => $request->desconto, 'status_id' => '1', 'status_desc' => 'Supervisão Administrativa']);
        $desc = new descontoSugerido();
        $desc->valor_desc = $request->desconto;
        $desc->usuario_desc = auth()->user()->email;
        $desc->candidato_id_cand = $mat;
        $desc->save();
        return redirect()->back();
    }
    public function faltaDocumento($id, $mat){
        candidato::where('id_cand',$mat)
            ->update(['status_id' => '2','status_desc'=>'Falta documentação','controle_cand' => null]);
        return redirect()->back();
    }
    public function descontoAutorizado($id,$mat, Request $request){
        $request->validate([
            'autorizado' => 'required'
        ]);
        candidato::where('id_cand',$mat)
            ->update([
                'desc_aut' => $request->autorizado, 
                'status_id' => '3', 
                'status_desc' => 'Deferido',
                'parecer'=> $request->parecer
                ]);
        $desc = new descontoAutorizado();
        $desc->valor_aut = $request->autorizado;        
        $desc->usuario_aut = auth()->user()->email;
        $desc->candidato_id_cand = $mat;
        $desc->save();
        return redirect()->back();
    }
    public function descontoIndeferido($id,$mat){
        candidato::where('id_cand',$mat)
            ->update(['desc_aut' => '0', 'status_id' => '4', 'status_desc' => 'Indeferido']);
        return redirect()->back();
    }
    public function relatorio(){
        $st = status::select('id','status')->get() ;
        return view('manager.relatorio_index',compact('st'));
    }
    public function relatorioSave(Request $request){
            $cand = candidato::select('id_cand','nome_cand','desc_aut','updated_at')->where('status_id',$request->id)
                ->whereBetween('updated_at',[$request->dt_ini,$request->dt_fim])
                ->orderBy('updated_at')
                ->get();
            $pdf = new Mpdf();
            $html= '<table border="1" style="border: 1px solid black; border-collapse: collapse;" width="100%"><tr><th>RA</th><th>Nome</th><th>Desconto Autorizado</th><th>Dia da Autorização</th></tr>';
            foreach ($cand as $c){
                $html.="<tr><td >$c->id_cand</td><td>$c->nome_cand</td><td>$c->desc_aut</td><td>$c->updated_at</td></tr>";
            }
            $html.= "</table>";
            $pdf->WriteHTML($html);
            return response()->download($pdf->Output());
    }
}
