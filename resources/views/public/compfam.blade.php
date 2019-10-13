@extends('layouts.app')

@section('content')
    @php(session_start())
    <div class="container-fluid">
        <div class="title">
             Processo de Desconto Comercial {{date('Y')+1}}
        </div>
    </div>
    <div class="container-fluid">
    <div class="title2">
        Composição Familiar
    </div>
        <form action="{{route('compSave',['id'=>$_SESSION['id']])}}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="title3">
                        Listar todos os membros da família que residem na mesma residência
                    </div>
                </div>
            </div>
            @if(count($dados)==0)
                <div class="row">
                    <div class="col-sm-4">
                        <label for="focusedInput">Nome:</label>
                        <input class="form-control" id="focusedInput" type="text" name="nome_comp" autofocus value="{{old('nome_comp')}}" >
                        <span class="msg-error">{{$errors->first('nome_comp')}}</span>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Parentesco:</label>
                        <select name="parentesco_comp" id="" class="form-control disabled" >
                            <option value="Candidato" selected >Candidato</option>
                        </select>
                        <span class="msg-error">{{$errors->first('parentesco_comp')}}</span>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Idade:</label>
                        <input class="form-control" id="" type="text" name="idade_comp" value="{{old('idade_comp')}}">
                        <span class="msg-error">{{$errors->first('idade_comp')}}</span>
                    </div>

                    <div class="col-sm-2">
                        <label for="">Escolaridade:</label>
                        <select name="escolaridade_comp" id="" class="form-control" >
                            <option value="" selected ></option>
                            <option value="Analfabeto">Analfabeto</option>
                            <option value="Ensino Fundamental Completo"  >Ensino Fundamental Completo</option>
                            <option value="Ensino Fundamental Incompleto"  >Ensino Fundamental Incompleto</option>
                            <option value="Ensino Médio Completo"  >Ensino Médio Completo</option>
                            <option value="Ensino Médio Incompleto"  >Ensino Médio Incompleto</option>
                            <option value="Ensino Superior Completo"  >Ensino Superior Completo</option>
                            <option value="Ensino Superior Incompleto">Ensino Superior Incompleto</option>
                            <option value="Pós-graduação ">Pós-graduação</option>
                            <option value="Mestrado">Mestrado</option>
                            <option value="Doutorado">Doutorado</option>
                            @if(old('escolaridade_comp'))
                                <option value="{{old('escolaridade_comp')}}" selected >{{old('escolaridade_comp')}}</option>
                            @endif
                        </select>
                        <span class="msg-error">{{$errors->first('escolaridade_comp')}}</span>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Profissão:</label>
                        <input class="form-control" id="" type="text" name="profissao_comp" value="{{old('profissao_comp')}}">
                        <span class="msg-error">{{$errors->first('profissao_comp')}}</span>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Salário bruto:</label>
                        <input class="form-control" id="sal" type="text" name="salario_comp" value="{{old('salario_comp')}}">
                        <span class="msg-error">{{$errors->first('salario_comp')}}</span>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-sm-4">
                        <label for="focusedInput">Nome:</label>
                        <input class="form-control" id="focusedInput" type="text" name="nome_comp" autofocus value="{{old('nome_comp')}}" >
                        <span class="msg-error">{{$errors->first('nome_comp')}}</span>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Parentesco:</label>
                        <select name="parentesco_comp" id="" class="form-control">
                            <option value="" selected></option>
                            <option value="Pai">Pai</option>
                            <option value="Mãe">Mãe</option>
                            <option value="Tio/Tia">Tio/Tia</option>
                            <option value="Avô/Avó">Avô/Avó</option>
                            <option value="Irmão/Irmã">Irmão/Irmã</option>
                            <option value="Primo/Prima">Primo/Prima</option>
                            <option value="Outros">Outros</option>
                            @if(old('parentesco_comp'))
                                <option value="{{old('parentesco_comp')}}" selected >{{old('parentesco_comp')}}</option>
                            @endif
                        </select>
                        <span class="msg-error">{{$errors->first('parentesco_comp')}}</span>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Idade:</label>
                        <input class="form-control" id="" type="text" name="idade_comp" value="{{old('idade_comp')}}">
                        <span class="msg-error">{{$errors->first('idade_comp')}}</span>
                    </div>

                    <div class="col-sm-2">
                        <label for="">Escolaridade:</label>
                        <select name="escolaridade_comp" id="" class="form-control" >
                            <option value="" selected ></option>
                            <option value="Analfabeto">Analfabeto</option>
                            <option value="Ensino Fundamental Completo"  >Ensino Fundamental Completo</option>
                            <option value="Ensino Fundamental Incompleto"  >Ensino Fundamental Incompleto</option>
                            <option value="Ensino Médio Completo"  >Ensino Médio Completo</option>
                            <option value="Ensino Médio Incompleto"  >Ensino Médio Incompleto</option>
                            <option value="Ensino Superior Completo"  >Ensino Superior Completo</option>
                            <option value="Ensino Superior Incompleto">Ensino Superior Incompleto</option>
                            <option value="Pós-graduação ">Pós-graduação</option>
                            <option value="Mestrado">Mestrado</option>
                            <option value="Doutorado">Doutorado</option>
                            @if(old('escolaridade_comp'))
                                <option value="{{old('escolaridade_comp')}}" selected >{{old('escolaridade_comp')}}</option>
                            @endif
                        </select>
                        <span class="msg-error">{{$errors->first('escolaridade_comp')}}</span>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Profissão:</label>
                        <input class="form-control" id="" type="text" name="profissao_comp" value="{{old('profissao_comp')}}">
                        <span class="msg-error">{{$errors->first('profissao_comp')}}</span>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Salário bruto:</label>
                        <input class="form-control" id="sal" type="text" name="salario_comp" value="{{old('salario_comp')}}">
                        <span class="msg-error">{{$errors->first('salario_comp')}}</span>
                    </div>
                </div>
            @endif

            <br>
            <div class="row">
                <div class="col-sm-2">
                    <button class="btn  btn-lg btn-danger" type="submit">
                        <span class="glyphicon glyphicon-plus"></span> Adicionar Membro
                    </button>
                </div>
            </div>
            <br>
        </form>
        @if(count($dados)>0)

            <div class="title2">
                Membros inseridos:
            </div>
            <div class="row icn">
                <div class="col-sm-2">
                    <span class="glyphicon glyphicon-user"></span>
                </div>
                <div class="col-sm-1">
                    <span class="glyphicon glyphicon-home"></span>
                </div>
                <div class="col-sm-1">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
                <div class="col-sm-2">
                    <span class="glyphicon glyphicon-education"></span>
                </div>
                <div class="col-sm-2">
                    <span class="glyphicon glyphicon-wrench"></span>
                </div>
                <div class="col-sm-1">
                    <span class="glyphicon glyphicon-usd"></span>
                </div>
                <div class="col-sm-1">

                </div>
            </div>
            @foreach($dados as $d)
                <div class="well">
                <div class="row">
                    <div class="col-sm-2">
                        <span class="glyphicon glyphicon-user hidden icn-show"></span> {{$d->nome_comp}}
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-home hidden icn-show"></span> {{$d->parentesco_comp}}
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-calendar hidden icn-show"></span> {{$d->idade_comp}} anos
                    </div>
                    <div class="col-sm-2">
                        <span class="glyphicon glyphicon-education hidden icn-show"></span> {{$d->escolaridade_comp}}
                    </div>

                    <div class="col-sm-2">
                        <span class="glyphicon glyphicon-wrench hidden icn-show"></span> {{$d->profissao_comp}}
                    </div>
                    <div class="col-sm-1">
                        <span class="glyphicon glyphicon-usd hidden icn-show"></span> R$: {{$d->salario_comp}}
                    </div>
                    <div class="col-sm-3">
                        <div class="btn-group">
                        <!--{{url('/ficha/compfamiliar/'.$_SESSION['id'].'/upload/'.$d->id_comp)}}-->
                            <a href="" data-toggle="modal" data-target="#{{$d->id_comp}}" class="btn  btn-primary"><span class="glyphicon glyphicon-upload"></span> Enviar documentação</a>
                            <a href="" data-toggle="modal" data-target="#excluir_{{$d->id_comp}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Excluir"></span></a>
                        </div>
                    </div>
                    <div id="excluir_{{$d->id_comp}}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content " style="background-color: white; color: #004f9f;">
                                <div class="modal-body">
                                    <h3>Deseja realmente excluir o membro: {{$d->nome_comp}}</h3>
                                    <div align="center">
                                        <a href="{{route('compDestroy',['id'=>$_SESSION['id'], 'id_comp'=>$d->id_comp])}}" class="btn btn-success btn-lg">Sim</a> <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Não</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @if(!empty($files))
                        <br>
                    <div class="row" style="background-color: #d6d6d6">
                        <div class="title2 ">
                            Arquivos anexados:
                        </div>
                        @foreach($files as $f)
                            @if($d->id_comp == $f->composicaofamiliar_id_comp)
                                @if(strpos($f->url_doc,'.pdf'))
                                    <div class="col-sm-1">
                                        <div class="thumbnail">
                                            <a download href="{{asset('/storage/').'/'.$f->url_doc}}">
                                                <img src="{{asset('/img/pdf.png')}}" alt="" class="img-responsive">
                                                <div class="caption">
                                                    <span class="text">{{$f->old_name_doc}}</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm-1">
                                        <div class="thumbnail">
                                            <a download href="{{asset('/storage/').'/'.$f->url_doc}}">
                                                <img src="{{asset('/storage/').'/'.$f->url_doc}}" alt="" class="img-responsive img-thumbnail">
                                                <div class="caption">
                                                    <span class="text">{{$f->old_name_doc}}</span>
                                                </div>

                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                @endif
                </div>
                <div id="{{$d->id_comp}}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content ">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Enviar documentação</h4>
                            </div>
                            <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                        Anexar os documentos de: <b> {{$d->nome_comp}}</b>
                                </div>
                            </div>
                                <form action="{{route('uploadSave',['id'=>$_SESSION['id'], 'id_comp' => $d->id_comp])}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="file" name="upload[]" multiple required>
                                            <span class="msg-error">{{$errors->first('upload.*')}}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <span>Permitido apenas arquivos com as extensões: .jpg, jpeg, pdf com tamanho máximo de 10 mb.</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modal_up"><span class="glyphicon glyphicon-save"></span> Enviar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        @endif
    </div>
    @if(count($files)>0)
        <div class="container-fluid">
            <div class="row text-center">
                <a class="btn btn-block btn-lg btn-danger" data-toggle="modal" data-target="#end">
                    <span class="glyphicon glyphicon-floppy-save"></span> Finalizar Candidatura
                </a>
            </div>
        </div>
        <br> <br>
    @endif
    <div id="end" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content " style="background-color: white; color: #004f9f;">
                <div class="modal-body">
                    <h3>Deseja realmente finalizar o processo de solicitação de desconto?</h3>
                    Após finalizado o precesso, não será possivel fazer uma nova. <br><br>
                    <div align="center">
                        <a href="{{route('painel',['id'=>$_SESSION['id']])}}" class="btn btn-success btn-lg">Sim</a> <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Não</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="modal_up" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="background-color: white; color: #004f9f;">
                <div class="modal-body" align="center">
                    <h3>Enviando arquivos. Aguarde...</h3>
                    <img src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/585d0331234507.564a1d239ac5e.gif" alt="" width="100px">
                </div>
            </div>

        </div>
    </div>
    <script>
        $('#sal').mask('000.000.000.000.000,00', {reverse: true});
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

@endsection