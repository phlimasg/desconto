<?php

namespace App\Http\Controllers;

use App\Model\candidato;
use App\Model\composicaoFamiliar;
use App\Model\documentos;
use App\Model\inscricao;
use App\Model\totvs;
use Illuminate\Http\Request;

class compFamiliarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
        $dados = composicaoFamiliar::where('candidato_id_cand',$id)
            ->orderBy('id_comp')
            ->get();
        $files = documentos::join('composicao_familiars','documentos.composicaofamiliar_id_comp','=','composicao_familiars.id_comp')
            ->join('candidatos','composicao_familiars.candidato_id_cand','=','candidatos.id_cand')
            ->where('candidatos.id_cand',$id)
            ->get();
        //dd($files);
        return view('public.compfam', compact(['dados','files']));
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
        $request->validate([
            'nome_comp' => 'required|string|max:250',
            'parentesco_comp' => 'required|string',
            'idade_comp' => 'required|numeric|max:130',
            'escolaridade_comp' => 'required|string|max:250',
            'profissao_comp' => 'required|string|max:250',
            'salario_comp' => 'required|string',
        ],
            [
                'required' => 'Campo Obrigatório',
                'required_if' => 'Campo Obrigatório',
                'digits_between' => 'Min. de :min e max. :max digitos',
                'min' => 'Mínimo de :min de caracteres',
                'max' => 'Limite de :max caracteres',
                'numeric' => 'Somente números',
            ]);
        $comp = new composicaoFamiliar();
        $comp->nome_comp = $request->nome_comp;
        $comp->parentesco_comp = $request->parentesco_comp;
        $comp->idade_comp = $request->idade_comp;
        $comp->escolaridade_comp = $request->escolaridade_comp;
        $comp->profissao_comp = $request->profissao_comp;
        $comp->salario_comp = $request->salario_comp;
        $comp->candidato_id_cand = $id;
        $comp->save();
        //$dados = composicaoFamiliar::where('candidato_id_cand',$id)->orderBy('id_comp')->get();
        return redirect()->back();
        //return view('public.compfam', compact('dados'));
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
    public function destroy($id,$id_comp)
    {

        $files = documentos::where('composicaofamiliar_id_comp',$id_comp)->get();
        foreach ($files as $f){
            unlink(storage_path('/app/public/'.$f->url_doc));
        }
        //dd($files);
        documentos::where('composicaofamiliar_id_comp',$id_comp)
            ->delete();
        composicaoFamiliar::where('id_comp',$id_comp)
            ->where('candidato_id_cand', $id)
            ->delete();
        return redirect()->back();
    }

    public function uploadIndex($id,$id_comp){

        $files = documentos::where('composicaofamiliar_id_cand',$id_comp)->get();
        return view('public.compfamupload',compact(['id_comp','files']));
    }
    public function uploadSave(Request $request,$id,$id_comp){
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
            $doc = new documentos();
            $namefile = date('d-m-Y_H-m-s').'_'.$count.'.'.$i->extension();
            $up = $i->storeAs('/'.'upload/'.$id,$namefile);
            chmod(storage_path('/app/public/upload/'),0777);
            chmod(storage_path('/app/public/upload/'.$id),0777);
            chmod(storage_path('app/public/'.$up),0777);
            $doc->old_name_doc = $i->getClientOriginalName();
            $doc->url_doc = $up;
            $doc->composicaofamiliar_id_comp = $id_comp;
            $doc->save();
            //dd($up,$namefile,$doc);
            if (!$up )
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            $count++;
        }
        //$files = documentos::where('composicaofamiliar_id_cand',$id_comp)->get();
        //return view('public.compfamupload',compact(['id_comp','files']));
        return redirect()->back();
    }
}
