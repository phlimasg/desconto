<?php

namespace App\Http\Controllers;

use App\Model\candidato;
use App\Model\inscricao;
use App\Model\raAutorizado;
use App\Model\totvs;
use Illuminate\Http\Request;



class acessoController extends Controller
{
    public function index(){
        return view('public.acesso');
    }

    public function acessoValidar(Request $request){
        $request->validate([
            'acesso' => 'required|numeric|digits_between:4,11',
        ]);

        // VERIFICA SE JÁ INICIOU O CADASTRO E REDIRECIONA
        $consulta = candidato::where('id_cand',$request->acesso)->first(); 
        if($consulta){
            if($consulta->controle_cand==1 || $consulta->controle_cand==2)
                return redirect()->route('painel',['id' => $consulta->id_cand]);

        }elseif($consulta){
            session_start();
            if(strlen($consulta->id_cand)<=5)
                $_SESSION['id'] = '00000'.$consulta->id_cand;
            else
                $_SESSION['id'] = $consulta->id_cand;
            return redirect()->route('fIndex',['id' => $_SESSION['id']]);
            //return redirect()->route('painel',['id' => $request->acesso]);
        }
        //FIM
        $consulta = inscricao::where('NINSC','like','%'.$request->acesso)
            ->where('PAGAMENTO',1)
            ->where('ESCOLARIDADE','!=','EDUCACAO INFANTIL')
            ->first();            
        if ($consulta == null){
            if(date('Y-m-d')>= '2019-11-01'){
                $totvs = totvs::where('RA', 'like','%'.$request->acesso)
                    ->whereIn('RA', raAutorizado::select('ra')->where('ra','like','%'.$request->acesso)->get())
                    ->first();
            }
            else{
                $totvs = totvs::where('RA', 'like','%'.$request->acesso)->first();
            }
            if($totvs==null){
                $mat ='Matrícula/Inscrição não encontrada.';
                return view('public.acesso',compact('mat'));// ;
            }
            else{
                session_start();
                $_SESSION['id'] = '00000'.$totvs->RA;                
                return redirect()->route('cIndex',['id' => '00000'.$totvs->RA]);
            }
        }else{
            session_start();
            $_SESSION['id'] = $request->acesso;
            return redirect()->route('cIndex',['id' => $request->acesso]);
        }

    }
    public function painel($id){
        $candidato = candidato::where('id_cand', $id)        
        ->first();
            if($candidato->controle_cand != 1){
                candidato::where('id_cand', $id)
                    ->update(['controle_cand' => 1, 'status_id' => null, 'status_desc' => null]);
            } 
            //dd($controle,$controle->gpofamdesp,$controle->irmaos,$controle->compFam,$controle->respFin,$controle->desconto);
        return view('public.painel', compact('candidato'));
    }
}
