<?php

namespace App\Http\Controllers;


//use App\Model\grupoFamiliar;
use App\Model\grupoFamiliarNew;
use App\Model\grupoFamiliarNewDocumentos;
use Illuminate\Http\Request;

class grupoFamiliarController extends Controller
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
        $comp = grupoFamiliarNew::where('candidato_id',$id)->get();        
        return view('public.gpo',compact('comp'));
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
            'despesas' => 'required|string',
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
        $q = new grupoFamiliarNew();
        $q->despesas = $request->despesas;
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
        //dd($request->all(),$id);
        $count=1;
        foreach ($request->upload as $i){
            $doc = new grupoFamiliarNewDocumentos();
            $namefile = date('d-m-Y_H-m-s').'_'.$count.'.'.$i->extension();
            $up = $i->storeAs('/'.'upload/despesas/'.$id,$namefile);
            dd(storage_path(),$up);
            chmod(storage_path('/app/public/upload/despesas/'),0777);
            chmod(storage_path('/app/public/upload/despesas/'.$id),0777);
            chmod(storage_path('app/public/'.$up),0777);
            $doc->old_name_doc = $i->getClientOriginalName();
            $doc->url_doc = $up;
            $doc->grupo_familiar_id = $id;
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
