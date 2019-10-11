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
                    {{$c->nome_cand}}
                </div>
                <div class="col-sm-1">
                    <b>Dt. Nasc.: </b> <br>
                    {{date('d/m/Y', strtotime($c->dtnasc_cand))}}
                </div>
                <div class="col-sm-2">
                    <b>Tel.: </b> <br>
                    {{$c->tel_cand}}
                </div>
                <div class="col-sm-1">
                    <b>Desconto: </b> <br>
                    @if(strstr($c->desc_cand,'%')!=false)
                    <span class="text-info">{{$c->desc_cand}}</span>
                    @elseif($c->desc_cand != null)
                        <span class="text-info">{{$c->desc_cand}}%</span>
                    @endif
                    @if($c->desc_cand ==null)
                        Não tem
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <b>Aluno Novo?</b><br>
                    @if($c->aluno_novo==1)
                            Sim
                    @else
                            Não
                    @endif
                </div>
                @if($c->aluno_novo==1)
                    <div class="col-sm-2">
                        <b>Origem:</b> <br>
                        {{$c->aluno_novo_origem_cand}}
                    </div>
                @endif
                <div class="col-sm-2">
                    <b>Escolaridade: </b> <br>
                    {{$c->escolaridade_cand}}
                </div>
                <div class="col-sm-4">
                    <b>Deficiência: </b> <br>
                    @if($c->deficiencia_cand != null)
                        {{$c->deficiencia_cand}}
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
                    {{$c->cep_cand}}
                </div>
                <div class="col-sm-3">
                    <b>Endereço: </b><br>
                    {{$c->rua_cand}}
                </div>
                <div class="col-sm-1">
                    <b>Bairro: </b><br>
                    {{$c->bairro_cand}}
                </div>
                <div class="col-sm-1">
                    <b>Cidade: </b><br>
                    {{$c->cidade_cand}}
                </div>
                <div class="col-sm-1">
                    <b>Estado: </b><br>
                    {{$c->estado_cand}}
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


    <div class="panel panel-default">
        <div class="panel-heading panel-default"><h4>Informações do Grupo Familiar</h4></div>
        @if(!empty($gpo))
        <div class="panel-body">
            <b>DESPESAS NO ÚLTIMO MÊS</b>
            <div class="row">
                    @if($gpo->aluguel_desp != null)
                    <div class="col-sm-2">
                        <b>Aluguel:</b><br>
                    R$ {{$gpo->aluguel_desp}},00
                    </div>
                    @endif
                    @if($gpo->casa_desp != null)
                        <div class="col-sm-2">
                            <b>Casa:</b><br>
                            R$ {{$gpo->casa_desp}},00
                        </div>
                    @endif
                    @if($gpo->cond_desp != null)
                        <div class="col-sm-2">
                            <b>Condomínio:</b><br>
                            R$ {{$gpo->cond_desp}},00
                        </div>
                    @endif
                    @if($gpo->cart_desp != null)
                        <div class="col-sm-2">
                            <b>Cartão:</b><br>
                            R$ {{$gpo->cart_desp}},00
                        </div>
                    @endif
                    @if($gpo->conv_desp != null)
                        <div class="col-sm-2">
                            <b>Convênio:</b><br>
                            R$ {{$gpo->conv_desp}},00
                        </div>
                    @endif
                    @if($gpo->ensino_desp != null)
                        <div class="col-sm-2">
                            <b>Ensino:</b><br>
                            R$ {{$gpo->ensino_desp}},00
                        </div>
                    @endif
                        @if($gpo->auto_fin_desp != null)
                            <div class="col-sm-2">
                                <b>Fin. Auto:</b><br>
                                R$ {{$gpo->auto_fin_desp}},00
                            </div>
                        @endif
                        @if($gpo->imovel_fin_desp != null)
                            <div class="col-sm-2">
                                <b>Fin. Imovel:</b><br>
                                R$ {{$gpo->imovel_fin_desp}},00
                            </div>
                        @endif
                        @if($gpo->despesas_outros_desp != null)
                            <div class="col-sm-2">
                                <b>Outros:</b><br>
                                R$ {{$gpo->despesas_outros_desp}},00
                            </div>
                        @endif
            </div>
            <br>
            <b>RENDA AGREGADA NO ÚLTIMO MÊS</b>
            <div class="row">
                @if($gpo->pensao_desp != null)
                    <div class="col-sm-1">
                        <b>Pensão:</b><br>
                        R$ {{$gpo->pensao_desp}},00
                    </div>
                @endif
                    @if($gpo->alug_receb_desp != null)
                        <div class="col-sm-2">
                            <b>Rec. Alugel:</b><br>
                            R$ {{$gpo->alug_receb_desp}},00
                        </div>
                    @endif
                    @if($gpo->renda_outros_desp != null)
                        <div class="col-sm-1">
                            <b>Outros:</b><br>
                            R$ {{$gpo->renda_outros_desp}},00
                        </div>
                    @endif
            </div>
            @endif
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading panel-default"><h4>Composição Familiar</h4></div>
        <div class="panel-body">
                @foreach($comp as $cm)
                <div class="row">
                <div class="col-sm-4">
                    <b>Nome:</b><br>
                    {{$cm->nome_comp}}
                </div>
                    <div class="col-sm-1">
                        <b>Idade:</b><br>
                        {{$cm->idade_comp}}
                    </div>
                    <div class="col-sm-1">
                        <b>Idade:</b><br>
                        {{$cm->parentesco_comp}}
                    </div>
                    <div class="col-sm-2">
                        <b>Escolaridade:</b><br>
                        {{$cm->escolaridade_comp}}
                    </div><div class="col-sm-1">
                        <b>Profissão:</b><br>
                        {{$cm->profissao_comp}}
                    </div><div class="col-sm-1">
                        <b>Salario:</b><br>
                        R$ {{$cm->salario_comp}},00
                    </div>
                </div>
                <div class="well">
                <b>Anexos:</b>
                <div class="row">
                    @foreach($doc as $d)
                        @if($d->composicaofamiliar_id_comp == $cm->id_comp)
                            <div class="col-sm-1 ">
                                @if(strstr($d->url_doc,'.pdf') != false)
                                    <a href="{{asset('/storage/').'/'.$d->url_doc}}" target="_blank">
                                        <img src="{{asset('/img/pdf.png')}}" alt="" class="img-responsive">
                                        <span class="text">{{$d->old_name_doc}}</span>
                                    </a>
                                    @else
                                    <a href="#" data-toggle="modal" data-target="#{{$d->id_doc}}">
                                        <img src="{{asset('/storage/').'/'.$d->url_doc}}" alt="" class="img-responsive">
                                        <span class="text">{{$d->old_name_doc}}</span>
                                    </a>
                                    <div class="modal fade" id="{{$d->id_doc}}" role="dialog">
                                        <div class="modal-dialog modal-lg">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{asset('/storage/').'/'.$d->url_doc}}" alt="" class="img-responsive">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
                </div>
                @endforeach
        </div>
    </div>

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
                    <h4>Definir valor do desconto?</h4>Valor Sugerido: {{$c->desc_cand}}
                </div>
                <div class="modal-body">
                    <form action="{{route('descAutCandidato',['id' => Request::segment(2),'mat' => Request::segment(4)])}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="">Valor a ser definido:</label>
                                <input type="text" class="form-control" name="autorizado">
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
                    <h4 class="modal-title">{{$c->rua_cand}}, {{$c->bairro_cand}}, {{$c->cidade_cand}} - {{$c->estado_cand}}</h4>
                </div>
                <div class="modal-body">
                    <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAKMSC_EIuFZs6wsF820Ek4NRf1czJ9j-8&q={{$c->rua_cand}}+{{$c->bairro_cand}}+{{$c->cidade_cand}}+{{$c->estado_cand}}" allowfullscreen>
                    </iframe>
                </div>
            </div>

        </div>
    </div>

    @endsection