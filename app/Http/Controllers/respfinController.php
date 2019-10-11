<?php

namespace App\Http\Controllers;

use App\Model\inscricao;
use App\Model\respfin;
use App\Model\totvs;
use Illuminate\Http\Request;

class respfinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        session_start();
        $fin = respfin::where('candidato_id_cand',$id)->first();
        if($fin){
        return redirect()->route('gpoIndex',['id' => $_SESSION['id']]);
        }

        $q = inscricao::where('NINSC',$id)->first();
        if ($q == null){
            $q= totvs::where('RA', $id)->first();
            $dados = new respfin();
            $dados->nome_fin = $q->RESPFIN;
            $dados->cpf_fin = $q->RESPFINCPF;
            $dados->tel1_fin = $q->RESPFINTEL1;
            $dados->tel2_fin = $q->RESPFINCEL;
            $dados->email_fin = $q->RESPFINEMAIL;
            return view('public.respfin', compact('dados'));
        }else{
            $dados = new respfin();
            $dados->nome_fin = $q->FINNOME;
            $dados->cpf_fin = $q->CPF;
            $dados->tel1_fin = $q->FINTEL;
            $dados->email_fin = $q->FINMAIL;
            return view('public.respfin', compact('dados'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request,$id)
    {
        session_start();
        $request->validate([
            'nome_fin' => 'required|string|min:10,max:150',
            'tel1_fin' => 'required|string|min:10,max:13',
            'tel2_fin' => 'required|string|min:10,max:13',
            'email_fin' => 'required|email|min:8,max:13',
            'vinculo_fin' => 'required',
            'txt_vinc_fin' => 'required_if:vinculo_fin,0',
            'just_fin' => 'max:250',
            'cpf_fin' => ['required','string','min:9','max:14',
                function ($attribute, $value, $fail){
                    if(empty($value)) {
                        $fail('CPF INVÁLIDO');
                    }
                    $value = preg_replace("/[^0-9]/", "", $value);
                    $value = str_pad($value, 11, '0', STR_PAD_LEFT);
                    if (strlen($value) != 11) {
                        $fail('CPF INVÁLIDO');
                    }
                    else if ($value == '00000000000' ||
                        $value == '11111111111' ||
                        $value == '22222222222' ||
                        $value == '33333333333' ||
                        $value == '44444444444' ||
                        $value == '55555555555' ||
                        $value == '66666666666' ||
                        $value == '77777777777' ||
                        $value == '88888888888' ||
                        $value == '99999999999') {
                        $fail('CPF INVÁLIDO');
                    } else {
                        for ($t = 9; $t < 11; $t++) {
                            for ($d = 0, $c = 0; $c < $t; $c++) {
                                $d += $value{$c} * (($t + 1) - $c);
                            }
                            $d = ((10 * $d) % 11) % 10;
                            if ($value{$c} != $d) {
                                $fail('CPF INVÁLIDO');
                            }
                        }
                    }
                }
            ],
            ],[
            'required' => 'Campo Obrigatório',
            'required_if' => 'Campo Obrigatório',
            'min' => 'Mínimo de :min de caracteres',
            'max' => 'Mínimo de :max de caracteres',
            'numeric' => 'Somente números',
        ]);

        $resp = new respfin();
        $resp->candidato_id_cand = $id;
        $resp->nome_fin = $request->nome_fin;
        $resp->cpf_fin = $request->cpf_fin;
        $resp->tel1_fin = $request->tel1_fin;
        $resp->tel2_fin = $request->tel2_fin;
        $resp->email_fin = $request->email_fin;
        $resp->just_fin = $request->just_fin;
        if(strcasecmp($request->vinculo_fin,"0")==0)
            $resp->vinculo_fin = $request->txt_vinc_fin;
        else
            $resp->vinculo_fin = $request->vinculo_fin;
        $resp->save();

        return redirect()->route('gpoIndex',['id' => $_SESSION['id']]);
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
