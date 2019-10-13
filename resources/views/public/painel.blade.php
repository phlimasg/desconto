@extends('layouts.app')
@section('content')
<style>
.panel-danger,.panel-primary,.panel-heading,.alert{
    border-radius: 0px;
}
</style>
<div class="container-fluid">
    <h1 class="title">Descontos Comerciais {{date('Y')+1}}</h1>
    <div class="alert alert-danger" >
        <h4 style="font-size: 36px;"><span class="glyphicon glyphicon-flag"></span> AVISO</h4>        
        Solicitação nº {{$candidato->id_cand}} efetuada com sucesso. <br>
        Agradecemos a inscrição e assim que estiver liberado, o desconto estará disponível nessa página. <br>
        
    </div>
    <div class="title2">
        Resumo da solicitação
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Dados do Aluno</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4"><b>Nome:</b> {{$candidato->nome_cand}}</div>
                <div class="col-sm-3"><b>Esc.:</b> {{$candidato->escolaridade_cand}}</div>                
                <div class="col-sm-3"><b>Nascimento:</b> {{date('d/m/Y',strtotime($candidato->dtnasc_cand))}}</div>
                <div class="col-sm-2"><b>Tel.:</b> {{$candidato->tel_cand}}</div> 
            </div> 
            <br>
            <b>Endereço</b>
            <div class="row">
                <div class="col-sm-3"><b>Rua:</b> {{$candidato->rua_cand}}</div>
                <div class="col-sm-3"><b>Bairro:</b> {{$candidato->bairro_cand}}</div>
                <div class="col-sm-3"><b>Cidade:</b> {{$candidato->cidade_cand}}</div>
                <div class="col-sm-1"><b>Estado:</b> {{$candidato->estado_cand}}</div>
                <div class="col-sm-2"><b>CEP:</b> {{$candidato->cep_cand}}</div>
            </div>
            <br>
            <div class="row">
            @if ($candidato->deficiencia_cand) <div class="col-sm-4"><b>Deficiência:</b> {{$candidato->deficiencia_cand}} </div>@endif                                    
            @if ($candidato->desc_cand) <div class="col-sm-3"><b>Desconto que já possui:</b> {{$candidato->desc_cand}}</div>@endif
            <div class="col-sm-4"><b>Aluno novo:</b> @if ($candidato->aluno_novo != 0) Sim @else Não                  @endif</div>
            @if ($candidato->aluno_novo_origem_cand) <div class="col-sm-4"><b>Aluno novo:</b>  {{$candidato->aluno_novo_origem_cand}} </div>@endif
            </div>             
            <br>
            @foreach ($candidato->irmaos as $i)
                <div class="row">
                    <div class="col-sm-2"><b>Irmão RA:</b> {{$i->mat_insc_ci}}</div>
                                     
                </div>
            @endforeach           
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Dados do Responsável Financeiro</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4"><b>Nome:</b> {{$candidato->respfin->nome_fin}}</div>
                <div class="col-sm-3"><b>CPF:</b> {{$candidato->respfin->cpf_fin}}</div>                
                <div class="col-sm-3"><b>Tel.:</b> {{$candidato->respfin->tel1_fin}}</div>
                <div class="col-sm-2"><b>Tel.:</b> {{$candidato->respfin->tel2_fin}}</div> 
            </div> 
            <div class="row">
                <div class="col-sm-3"><b>Email:</b> {{$candidato->respfin->email_fin}}</div>
                <div class="col-sm-3"><b>Vinculo:</b> {{$candidato->respfin->vinculo_fin}}</div>                               
            </div>                           
            <div class="row">
                <div class="col-sm-6"><b>Justificativa:</b> {{$candidato->respfin->just_fin}}</div>     
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">Dados da Composição Familiar</div>
        <div class="panel-body">
                @php($receitas =0)
            <div class="" >
                     
            @foreach ($candidato->compFam as $i)
            <div class="row">
                <div class="col-sm-3"><b>Nome:</b> {{$i->nome_comp}}</div>
                <div class="col-sm-3"><b>Parentesco:</b> {{$i->parentesco_comp}}</div>                
                <div class="col-sm-2"><b>Idade:</b> {{$i->idade_comp}}</div>
                <div class="col-sm-2"><b>Escol.:</b> {{$i->escolaridade_comp}}</div> 
                <div class="col-sm-2"><b>Profissão.:</b> {{$i->profissao_comp}}</div>                     
            </div>
            <div class="row">
                <div class="col-sm-2"><b>Salário:</b> {{$i->salario_comp}}</div> 
            </div>
            <div class="well">
                <b>Anexos:</b><br>
                <div class="row">
                    @forelse ($i->documentos as $doc)
                        <div class="col-sm-2">
                        <a href="{{url('storage/'.$doc->url_doc)}}" download>{{$doc->old_name_doc}}</a>
                        </div>
                    @empty
                        <div class="alert alert-danger">
                            Nenhum anexo!
                        </div>
                    @endforelse
                </div>
            </div>
            @php($receitas += floatval(str_replace(['.',','],'',$i->salario_comp)))
            <hr>
            @endforeach 
        </div>                                         
        </div>
        <div class="panel-footer">
            @php($tam = strlen($receitas)) 
            Valor total de receitas: <b class="text-danger">R$ {{substr($receitas, 0, ($tam-2))}},{{substr($receitas, ($tam-2))}}</b>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Despesas do Grupo Familiar</div>
        <div class="panel-body">
            @php($despesas =0)                    
            @foreach ($candidato->gpofamdesp as $i)
                <div class="row">
                    <div class="col-sm-2"><b>Valor:</b> R${{$i->despesas}}</div>
                    <div class="col-sm-4"><b>Tipo:</b> {{$i->tipo}}</div>                
                    <div class="col-sm-6"><b>Descrição:</b> {{$i->descricao}}</div>                
                </div>
                <div class="well">
                    Anexos: <br>
                    <div class="row">
                        @forelse ($i->documentos as $doc)
                        <div class="col-sm-2">
                            <a href="{{url('storage/'.$doc->url_doc)}}" download>{{substr($doc->old_name_doc,0,10)}}...</a>
                        </div>
                        @empty
                            <div class="alert">
                                Nenhum arquivo em anexo.
                            </div>
                        @endforelse
                    </div>
                </div>
            @php($despesas += floatval(str_replace(['.',','],'',$i->despesas)))                    
            @endforeach                                          
        </div>
        <div class="panel-footer">
            @php($tam = strlen($despesas))            
            Valor total de despesas: <b class="text-danger">R$ {{substr($despesas, 0, ($tam-2))}},{{substr($despesas, ($tam-2))}}</b>
        </div>
    </div>
</div>

    @php(session_start())
    @php(session_destroy())
@endsection