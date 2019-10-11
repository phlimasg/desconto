<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\candidato;
use App\Model\candidatos_irmao;
use App\Model\descontoAutorizado;
use App\Model\documentos;
use App\Model\grupoFamiliar;

class estatisticasController extends Controller
{
    public function index()
    {
        $candidatos = candidato::count();
        $cand_irmaos = candidatos_irmao::count();
        $desc_aut = descontoAutorizado::selectRaw('valor_aut, count(*) as total')->groupBy('valor_aut')->orderBy('total','desc')->get();
        $status = candidato::selectRaw('status_id,status_desc, count(*) as tt')
        ->whereRaw('status_id IS NOT NULL')
        ->whereRaw('status_desc IS NOT NULL')
        ->groupBy('status_id')
        ->groupBy('status_desc')->get();
        $documentos = documentos::count();
        $gp_fam = grupoFamiliar::count();
       // dd($candidatos, $cand_irmaos,$desc_aut, $documentos,$status,$gp_fam);
        return view('manager.estatisticas', compact('candidatos', 'cand_irmaos','desc_aut', 'documentos','status','gp_fam'));
    }
}
