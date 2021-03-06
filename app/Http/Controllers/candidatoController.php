<?php

namespace App\Http\Controllers;

use App\Model\candidato;
use App\Model\candidatos_irmao;
use App\Model\inscricao;
use App\Model\totvs;
use Illuminate\Http\Request;

class candidatoController extends Controller
{
    public function index($id){
        session_start();
        $candidato = candidato::where('id_cand',$id)->first();          
        if($candidato)
            return view('public.candidato',compact('candidato'));
            //return redirect()->route('fIndex',['id' => $_SESSION['id']]);
        $dados = totvs::where('RA',$id)->first();
        if($dados){
            $candidato = new candidato();
            $candidato->nome_cand = $dados->NOME_ALUNO;
            if(strlen($dados->RESPACADTEL1)<=8)
                $candidato->tel_cand = '21'.$dados->RESPACADTEL1;
            else
                $candidato->tel_cand = $dados->RESPACADTEL1;
            $candidato->rua_cand = $dados->ENDERECO;
            $candidato->cep_cand = $dados->CEP;
            $candidato->aluno_novo_cand = 0;
        }
        else{
            $dados = inscricao::where('NINSC',$id)->first();
            $candidato = new candidato();
            //dd($dados);
            $candidato->nome_cand = $dados->CNOME;
            $candidato->dtnasc_cand = $dados->CDTNASC;
            $candidato->tel_cand = $dados->ACADTEL;
            $candidato->rua_cand = $dados->CEND;
            $candidato->bairro_cand = $dados->CBAIRRO;
            $candidato->cidade_cand = $dados->CCIDADE;
            $candidato->estado_cand = $dados->CESTADO;
            $candidato->cep_cand = $dados->CCEP;
            $candidato->aluno_novo_cand = 1;
            $candidato->aluno_novo_origem_cand;
            $candidato->escolaridade_cand;
            $candidato->deficiencia_cand = $dados->CNEC_ESP;
        }

        return view('public.candidato',compact('candidato'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session_start();        
        //$request->dtnasc_cand = date('Y-m-d',strtotime(str_replace('/', '-', $request->dtnasc_cand)));
        $request->dtnasc_cand = date('Y-m-d',strtotime(str_replace('/', '-',$request->dtnasc_cand)));
        //dd($request->dtnasc_cand,'1967-12-26');
        $request->validate([
            'nome_cand' => 'required|string|min:10,max:150',
            'dtnasc_cand' => 'required',
            'tel_cand' => 'required|min:13,max:14',
            'cep_cand' => 'required|string|max:9',
            'rua_cand' => 'required|min:1,max:150',
            'bairro_cand' => 'required|min:1,max:150',
            'cidade_cand' => 'required|min:1,max:150',
            'estado_cand' => 'required|min:1,max:3',
            'aluno_novo' => 'required',
            'aluno_novo_origem_cand' => 'nullable|required_if:aluno_novo,1|min:1,max:150',
            'rd_desc' => 'nullable|required_if:aluno_novo,0',
            'desc_cand' => 'nullable|required_if:rd_desc,1|min:2,max:3',
            'escolaridade_cand' => 'required',
            'deficiencia_cand' => 'nullable|min:1,max:150',
            'matricula[]' => 'nullable|numeric|max:15',
        ],[
            'required' => 'Campo Obrigatório',
            'required_if' => 'Campo Obrigatório',
            'min' => 'Mínimo de :min de caracteres',
            'max' => 'Mínimo de :max de caracteres',
            'numeric' => 'Somente números',
        ]);
        //dd($request->all());
        $candidato = candidato::where('id_cand',$_SESSION['id'])->first();
        if($candidato){
            $this->update($request, $_SESSION['id']);
            return redirect()->route('fIndex',['id' => $_SESSION['id']]);
        }
        $candidato = new candidato();
        $candidato->id_cand = $_SESSION['id'];
        $candidato->nome_cand = $request->nome_cand;
        $candidato->dtnasc_cand = $request->dtnasc_cand;
        $candidato->tel_cand = $request->tel_cand;
        $candidato->cep_cand = $request->cep_cand;
        $candidato->rua_cand = $request->rua_cand;
        $candidato->bairro_cand = $request->bairro_cand;
        $candidato->cidade_cand = $request->cidade_cand;
        $candidato->estado_cand = $request->estado_cand;
        $candidato->aluno_novo = $request->aluno_novo;
        $candidato->aluno_novo_origem_cand = $request->aluno_novo_origem_cand;
        $candidato->desc_cand = $request->desc_cand;
        $candidato->escolaridade_cand = $request->escolaridade_cand;
        $candidato->deficiencia_cand = $request->deficiencia_cand;
        $candidato->controle_cand = null;
        $candidato->status_id = null;
        $candidato->status_desc = null;
        $candidato->save();
        if($request->matricula[0] != null){
            foreach ($request->matricula as $mat){
                $irmao = new candidatos_irmao();
                $irmao->candidato_id_cand = $candidato->id_cand;
                $irmao->mat_insc_ci = $mat;
                $irmao->save();
            }
        }

        return redirect()->route('fIndex',['id' => $_SESSION['id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $candidato = candidato::where('id_cand',$id)->update([
            'nome_cand' => $request->nome_cand,
            'dtnasc_cand' => $request->dtnasc_cand,
            'tel_cand' => $request->tel_cand,
            'cep_cand' => $request->cep_cand,
            'rua_cand' =>$request->rua_cand,
            'bairro_cand' => $request->bairro_cand,
            'cidade_cand' => $request->cidade_cand,
            'estado_cand' => $request->estado_cand,
            'aluno_novo' => $request->aluno_novo,
            'aluno_novo_origem_cand' => $request->aluno_novo_origem_cand,
            'desc_cand' => $request->desc_cand,
            'escolaridade_cand' => $request->escolaridade_cand,
            'deficiencia_cand' => $request->deficiencia_cand,
            'controle_cand' => null,
            'status_id' => null,
            'status_desc' => null
        ]);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
