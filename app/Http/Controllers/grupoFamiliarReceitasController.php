<?php

namespace App\Http\Controllers;


//use App\Model\grupoFamiliar;
use App\Model\grupoFamiliarNew;
use App\Model\grupoFamiliarNewDocumentos;
use App\Model\grupoFamiliarReceita;
use App\Model\grupoFamiliarReceitasDocumentos;
use Illuminate\Http\Request;

class grupoFamiliarReceitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        session_start();
        /*$comp = grupoFamiliarNew::where('candidato_id',$id)->first();
        if($comp){
            return redirect()->route('compIndex',['id' => $_SESSION['id']]);
        }*/
        $comp = grupoFamiliarReceita::where('candidato_id',$id)->get();        
        return view('public.gporeceita',compact('comp'));
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
    public function store(Request $request, $id)
    {
        session_start();
        
        $request->validate([
            'receita' => 'required|string',
            'tipo' => 'required|string',
            'descricao' => 'nullable|string',
            ],
            [
            'required' => 'Campo Obrigatório',
            'required_if' => 'Campo Obrigatório',
            'min' => 'Mínimo de :min de caracteres',
            'max' => 'Máximo de :max de caracteres',
            'numeric' => 'Somente números',
        ]);
        $q = new grupoFamiliarReceita();
        $q->receita = $request->receita;
        $q->tipo = $request->tipo;
        $q->descricao = $request->descricao;        
        $q->candidato_id = $id;
        $q->save();
        //dd($q);
        return redirect()->back();
        //return redirect()->route('compIndex',['id' => $_SESSION['id']]);
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
        grupoFamiliarNew::where('id',$id)->delete();
        return redirect()->back();
    }

    public function despesasUpload(Request $request,$id)
    {
        //dd($request->all(),$id);
        $request->validate([
            'upload.*' => 'required|mimes:jpeg,jpg,pdf|max:1000000',
        ],
            [
                'required' => 'Campo Obrigatório',
                'required_if' => 'Campo Obrigatório',
                'digits_between' => 'Min. de :min e max. :max digitos',
                'min' => 'Mínimo de :min de caracteres',
                'max' => 'Limite de :max caracteres',
                'numeric' => 'Somente números',
            ]);
        
        $count=1;
        foreach ($request->upload as $i){
            $doc = new grupoFamiliarReceitasDocumentos();
            $namefile = date('d-m-Y_H-m-s').'_'.$count.'.'.$i->extension();
            $up = $i->storeAs('/'.'upload/receitas/'.$id,$namefile);
            chmod(storage_path('/app/public/upload/receitas/'),0777);
            chmod(storage_path('/app/public/upload/receitas/'.$id),0777);
            chmod(storage_path('app/public/'.$up),0777);
            $doc->old_name_doc = $i->getClientOriginalName();
            $doc->url_doc = $up;
            $doc->gpo_receitas_id = $id;
            $doc->save();
            //dd($up,$namefile,$doc);
            if (!$up )
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            $count++;
        }
        return redirect()->back();
    }
}
