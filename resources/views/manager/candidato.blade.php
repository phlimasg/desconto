@extends('layouts.admin')
@section('content')
    @if(Auth::user()->profile == 'Root' or Auth::user()->profile == 'Financeiro')
        <div class="text-right">
            <button class="btn btn-success btn-desc" data-toggle="modal" data-target="#defdesc">
                <span class="glyphicon glyphicon-usd"></span> Definir de desconto
            </button>
        </div>
        <div class="text-left">
            <button class="btn btn-danger btn-falta" data-toggle="modal" data-target="#indeferido">
                <span class="glyphicon glyphicon-remove"></span> Indeferir
            </button>
        </div>
    @else
        <div class="text-right">
            <button class="btn btn-danger btn-desc" data-toggle="modal" data-target="#desc">
                <span class="glyphicon glyphicon-usd"></span> Sugerir de desconto
            </button>
        </div>
        <div class="text-left">
            <button class="btn btn-primary btn-falta" data-toggle="modal" data-target="#doc">
                <span class="glyphicon glyphicon-file"></span> Falta Documento
            </button>
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading panel-black">
            <div class="row">
                <div class="col-sm-6">
                    <h4><span class="glyphicon glyphicon-user"></span> Dados do Candidato</h4>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <b>Nome: </b> <br>
                    {{$candidato->nome_cand}}
                </div>
                <div class="col-sm-1">
                    <b>Dt. Nasc.: </b> <br>
                    {{date('d/m/Y', strtotime($candidato->dtnasc_cand))}}
                </div>
                <div class="col-sm-2">
                    <b>Tel.: </b> <br>
                    {{$candidato->tel_cand}}
                </div>
                <div class="col-sm-1">
                    <b>Desconto: </b> <br>
                    @if(strstr($candidato->desc_cand,'%')!=false)
                    <span class="text-info">{{$candidato->desc_cand}}</span>
                    @elseif($candidato->desc_cand != null)
                        <span class="text-info">{{$candidato->desc_cand}}%</span>
                    @endif
                    @if($candidato->desc_cand ==null)
                        Não tem
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <b>Aluno Novo?</b><br>
                    @if($candidato->aluno_novo==1)
                            Sim
                    @else
                            Não
                    @endif
                </div>
                @if($candidato->aluno_novo==1)
                    <div class="col-sm-2">
                        <b>Origem:</b> <br>
                        {{$candidato->aluno_novo_origem_cand}}
                    </div>
                @endif
                <div class="col-sm-2">
                    <b>Escolaridade: </b> <br>
                    {{$candidato->escolaridade_cand}}
                </div>
                <div class="col-sm-4">
                    <b>Deficiência: </b> <br>
                    @if($candidato->deficiencia_cand != null)
                        {{$candidato->deficiencia_cand}}
                    @else
                        n/a
                    @endif
                </div>
            </div>
            @if($ir != null)
                <b>Irmãos:</b>
            @endif
            <div class="row">
            @foreach($ir as $i)
                <div class="col-sm-1">
                    <a href="" data-toggle="modal" data-target="#{{$i->RA}}">
                        {{intval($i->RA)}}
                    </a>

                </div>
                    <div id="{{$i->RA}}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{intval($i->RA)}} - {{$i->NOME_ALUNO}}</h4>
                                </div>
                                <div class="modal-body">
                                    <b>Nome:</b> {{$i->NOME_ALUNO}} <br>
                                    <b>Ano:</b> {{$i->ANO}} <br>
                                    <b>Turma:</b> {{$i->TURMA}} <br>
                                    <b>Turno:</b> {{$i->TURNO_ALUNO}} <br>
                                    <b>Endereço:</b> {{strtoupper($i->ENDERECO)}}, {{strtoupper($i->COMPLEMENTO)}} <br>
                                </div>
                            </div>

                        </div>
                    </div>
            @endforeach
            </div>
            <br>
            <b>Endereço</b>
            <div class="row">
                <div class="col-sm-1">
                    <b>Cep:</b><br>
                    {{$candidato->cep_cand}}
                </div>
                <div class="col-sm-3">
                    <b>Endereço: </b><br>
                    {{$candidato->rua_cand}}
                </div>
                <div class="col-sm-1">
                    <b>Bairro: </b><br>
                    {{$candidato->bairro_cand}}
                </div>
                <div class="col-sm-1">
                    <b>Cidade: </b><br>
                    {{$candidato->cidade_cand}}
                </div>
                <div class="col-sm-1">
                    <b>Estado: </b><br>
                    {{$candidato->estado_cand}}
                </div>
                <div class="col-sm-1">
                    <a href="" data-toggle="modal" data-target="#maps">
                        <img src="https://png.icons8.com/color/1600/google-maps.png" alt="" width="25px">
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($fil))
    <div class="panel panel-default">
        <div class="panel-heading panel-default"><h4>Dados das Filiações</h4></div>
        <div class="panel-body">
            <b>Filiação 1</b>
            <div class="row">
                <div class="col-sm-4">
                    <b>Nome:</b><br>
                    {{$fil->nome_t1}}
                </div>
                <div class="col-sm-2">
                    <b>Cpf:</b><br>
                    {{$fil->cpf_t1}}
                </div>
                <div class="col-sm-2">
                    <b>RG:</b><br>
                    {{$fil->rg_t1}}
                </div>
                <div class="col-sm-1">
                    <b>Dt. Nasc.:</b><br>
                    {{date('d/m/Y', strtotime($fil->dtnasc_t))}}
                </div>
            </div>
            <br>
            <b>Filiação 2</b>
            <div class="row">
                <div class="col-sm-4">
                    <b>Nome:</b><br>
                    {{$fil->nome_t2}}
                </div>
                <div class="col-sm-2">
                    <b>Cpf:</b><br>
                    {{$fil->cpf_t2}}
                </div>
                <div class="col-sm-2">
                    <b>RG:</b><br>
                    {{$fil->rg_t2}}
                </div>
                <div class="col-sm-1">
                    <b>Dt. Nasc.:</b><br>
                    {{date('d/m/Y', strtotime($fil->dtnasc_t2))}}
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading panel-default"><h4>Responsável Financeiro</h4></div>
        @if(!empty($resp))
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <b>Nome:</b><br>
                    {{$resp->nome_fin}}
                </div>
                <div class="col-sm-2">
                    <b>Cpf:</b><br>
                    {{$resp->cpf_fin}}
                </div>
                <div class="col-sm-2">
                    <b>Tel:</b><br>
                    {{$resp->tel1_fin}} {{$resp->tel2_fin}}
                </div>
                <div class="col-sm-2">
                    <b>Email</b><br>
                    {{$resp->email_fin}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <b>Vinculo:</b><br>
                    {{$resp->vinculo_fin}}
                </div>
                <div class="col-sm-4 text-justify">
                    <b>Justificativa:</b><br>
                    {{$resp->just_fin}}
                </div>
            </div>
            @endif
        </div>
    </div>


    <div class="panel panel-danger">
        <div class="panel-heading panel-default"><h4>Informações do Grupo Familiar - Despesas</h4></div>
        @if(!empty($candidato->gpofamdesp))
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
                            <div class="col-sm-1">
                                @if(strstr($doc->url_doc,'.pdf') != false)
                                <a href="{{asset('/storage/').'/'.$doc->url_doc}}" target="_blank">
                                    <img src="{{asset('/img/pdf.png')}}" alt="" class="img-responsive">
                                    <span class="text">{{$doc->old_name_doc}}</span>
                                </a>
                                @else
                                <a href="#" data-toggle="modal" data-target="#{{$doc->id}}">
                                    <img src="{{asset('/storage/').'/'.$doc->url_doc}}" alt="" class="img-responsive">
                                    <span class="text">{{$doc->old_name_doc}}</span>
                                </a>
                                <div class="modal fade" id="{{$doc->id}}" role="dialog">
                                    <div class="modal-dialog modal-lg">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{asset('/storage/').'/'.$doc->url_doc}}" alt="" class="img-responsive">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endif                               
                            </div>
                            @empty
                            <div class="alert alert-danger">
                                Nenhum anexo!
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
        @endif
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading panel-default"><h4>Composição Familiar - Receitas</h4></div>
            <div class="panel-body">
                @php($receitas =0)                                            
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
                            <div class="col-sm-1">
                                @if(strstr($doc->url_doc,'.pdf') != false)
                                <a href="{{asset('/storage/').'/'.$doc->url_doc}}" target="_blank">
                                    <img src="{{asset('/img/pdf.png')}}" alt="" class="img-responsive">
                                    <span class="text">{{$doc->old_name_doc}}</span>
                                </a>
                                @else
                                <a href="#" data-toggle="modal" data-target="#{{$doc->id_doc}}">
                                    <img src="{{asset('/storage/').'/'.$doc->url_doc}}" alt="" class="img-responsive">
                                    <span class="text">{{$doc->old_name_doc}}</span>
                                </a>
                                <div class="modal fade" id="{{$doc->id_doc}}" role="dialog">
                                    <div class="modal-dialog modal-lg">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{asset('/storage/').'/'.$doc->url_doc}}" alt="" class="img-responsive">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endif                               
                            </div>
                            @empty
                            <div class="alert alert-danger">
                                Nenhum anexo!
                            </div>
                            @endforelse                    
                        </div>
                        @php($receitas += floatval(str_replace(['.',','],'',$i->salario_comp)))                            
                    </div>
                @endforeach 
        </div>
        <div class="panel-footer">
                @php($tam = strlen($receitas))            
                Valor total de receitas: <b class="text-danger">R$ {{substr($receitas, 0, ($tam-2))}},{{substr($receitas, ($tam-2))}}</b>
            </div>
    </div>
    <br>
    <br>
    <br>
    
        
                
        

    <div class="modal fade" id="desc" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>Insira o valor sugerido:</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('descSugCandidato',['id' => Request::segment(2),'mat' => Request::segment(4)])}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="">Valor:</label>
                                <input type="text" class="form-control" placeholder="10%" name="desconto">
                            </div>
                        </div>
                        * O status será alterado para "Supervisão Administrativa".
                        <div class="row text-right">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-danger text-right">Salvar Sugestão</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="doc" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>Confirmar falta de documento?</h4>
                </div>
                <div class="modal-body">
                    <h4>Corfirmar a alteração de status para "Falta documentação"?</h4> <br>
                    <div class="row text-center">
                        <div class="col-sm-1">
                            <a href="{{route('faltaDoc',['id' => Request::segment(2),'mat' => Request::segment(4)])}}" class="btn btn-success">Sim</a>
                        </div>
                        <div class="col-sm-1">
                            <button data-dismiss="modal" class="btn btn-danger">Não</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="indeferido" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>Indeferir Candidato?</h4>
                </div>
                <div class="modal-body">
                    <h4>Corfirmar a alteração de status para "Indeferido"?</h4> <br>
                    <div class="row text-center">
                        <div class="col-sm-1">
                            <a href="{{route('indeferido',['id' => Request::segment(2),'mat' => Request::segment(4)])}}" class="btn btn-success">Sim</a>
                        </div>
                        <div class="col-sm-1">
                            <button data-dismiss="modal" class="btn btn-danger">Não</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="defdesc" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>Definir valor do desconto?</h4>Desconto que já possui: {{$candidato->desc_cand}}
                </div>
                <div class="modal-body">
                    <form action="{{route('descAutCandidato',['id' => Request::segment(2),'mat' => Request::segment(4)])}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="">Valor a ser autorizado:</label>
                                <input type="text" class="form-control" name="autorizado" value="{{$candidato->desc_aut}}">
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-sm-12">
                                    <label for="">Parecer descritivo:</label>
                                    <textarea rows="5" class="form-control" name="parecer">{{$candidato->parecer}}</textarea>
                                </div>
                            </div>
                        <br>
                        <div class="row text-center">
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-success">Definir</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="maps" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{$candidato->rua_cand}}, {{$candidato->bairro_cand}}, {{$candidato->cidade_cand}} - {{$candidato->estado_cand}}</h4>
                </div>
                <div class="modal-body">
                    <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAKMSC_EIuFZs6wsF820Ek4NRf1czJ9j-8&q={{$candidato->rua_cand}}+{{$candidato->bairro_cand}}+{{$candidato->cidade_cand}}+{{$candidato->estado_cand}}" allowfullscreen>
                    </iframe>
                </div>
            </div>

        </div>
    </div>

    @endsection