<?php

namespace App\Http\Controllers;

use App\Model\filiacao;
use App\Model\inscricao;
use App\Model\totvs;
use Illuminate\Http\Request;

class filiacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        session_start();
        $cons = filiacao::where('candidato_id_cand',$id)->first();
        if($cons){
            return redirect()->route('finIndex',['id' => $_SESSION['id']]);
        }
        $q = inscricao::where('NINSC',$id)->first();
        //dd($q);
        $fil = new filiacao();
        if($q == null){
            $q = totvs::where('RA', $id)->first();
            //dd($q);
            $fil->nome_t1 = $q->RESPACAD;
            $fil->cpf_t1 = $q->RESPACADCPF;
            $fil->nome_t2 = $q->RESPFIN;
            $fil->cpf_t2 = $q->RESPFINCPF;
        }else{
            $fil->nome_t1 = $q->FIL1NOME;
            $fil->dtnasc_t1 = $q->FIL1DTNASC;
            $fil->nome_t2 = $q->FIL2NOME;
            $fil->dtnasc_t2 = $q->FIL2DTNASC;
        }
        return view('public.filiacao', compact('fil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return redirect()->route('finIndex');
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
        $request->dtnasc_t1 = date('Y-m-d',strtotime(str_replace('/', '-',$request->dtnasc_t1)));
        if(!empty($request->dtnasc_t2))
        $request->dtnasc_t2 = date('Y-m-d',strtotime(str_replace('/', '-',$request->dtnasc_t2)));
        $request->validate([
            'nome_t1' => 'required|string|min:10,max:150',
            'dtnasc_t1' => 'required',
            'cpf_t1' => ['required','string','min:9','max:14',
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
            'rg_t1' => 'required|min:8,max:14',
            'rd_t1' => 'required',
            'nome_t2' => 'nullable|string|min:10,max:150',
            'dtnasc_t2' => 'nullable',
            'cpf_t2' => ['nullable','string','min:9','max:14',
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
            'rg_t2' => 'nullable|min:8,max:14',
        ],[
            'required' => 'Campo Obrigatório',
            'required_if' => 'Campo Obrigatório',
            'min' => 'Mínimo de :min de caracteres',
            'max' => 'Mínimo de :max de caracteres',
            'numeric' => 'Somente números',
        ]);


        $filiacao = new filiacao();
        $filiacao->candidato_id_cand = $_SESSION['id'];
        $filiacao->nome_t1 = $request->nome_t1;
        $filiacao->cpf_t1 = $request->cpf_t1;
        $filiacao->rg_t1 = $request->rg_t1;
        $filiacao->dtnasc_t1 = $request->dtnasc_t1;
        $filiacao->rd_t1 = $request->rd_t1;
        $filiacao->nome_t2 = $request->nome_t2;
        $filiacao->cpf_t2 = $request->cpf_t2;
        $filiacao->rg_t2 = $request->rg_t2;
        $filiacao->dtnasc_t2 = $request->dtnasc_t2;
        $filiacao->rd_t2 = $request->rd_t2;
        //dd($request->all());
        $filiacao->save();

        return redirect()->route('finIndex',['id' => $_SESSION['id']]);
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
        //
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
