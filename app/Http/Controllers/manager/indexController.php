<?php

namespace App\Http\Controllers\manager;

use App\Model\candidato;
use App\Model\status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{

    public function index(){
        $candidato = candidato::join('grupo_familiars','candidatos.id_cand','=','grupo_familiars.candidato_id_cand')
            //->join('statuses','status_id','=','statuses.id')
            ->selectRaw('*,candidatos.created_at as date')
            ->where('status_desc','')
            //->whereRaw('status_desc IS NULL')
            ->orderBy('candidatos.created_at','asc')
            ->paginate(20);
        return view('manager.index', compact('candidato'));
    }

    public function search(Request $request){
        $candidato = candidato::join('grupo_familiars','candidatos.id_cand','=','grupo_familiars.candidato_id_cand')
            ->selectRaw('*,candidatos.created_at as date')
            ->where('candidatos.nome_cand','like','%'.$request->busca.'%')
            ->orWhere('candidatos.id_cand','like','%'.$request->busca)
            ->orderBy('candidatos.created_at','asc')
            //->toSql();
            ->paginate(20);
        //dd($candidato);
        return view('manager.index', compact('candidato'));
    }
    public function status($id,$id_status){
        $st = status::where('id', $id_status)->first();
        $candidato = candidato::join('grupo_familiars','candidatos.id_cand','=','grupo_familiars.candidato_id_cand')
            ->selectRaw('*,candidatos.created_at as date')
            ->where('status_id',$id_status)
            ->orderBy('candidatos.created_at','asc')
            ->paginate(20);
        return view('manager.index', compact(['candidato','st']));
    }
}
