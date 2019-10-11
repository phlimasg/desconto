@extends('layouts.app')

@section('content')
    <!--php(session_start())-->
    <div class="container-fluid">
        <div class="title">
             Processo de Desconto Comercial {{date('Y')+1}}
        </div>
    </div>
    <div class="container-fluid">
    <div class="title2">
        Informações do Grupo Familiar - Receitas
    </div>
        <form action="" method="post">
            @csrf
            <div class="row">
                    <div class="col-sm-2">
                        <label for="">Valor</label>
                    <input class="form-control" name="receita" id="receita" type="text" placeholder="EX: 1900,00" autofocus value="{{old('receita')}}">
                        <span class="msg-error">{{$errors->first('receita')}}</span>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Tipo</label>
                        <select name="tipo" id="" class="form-control">
                            <option value=""></option>
                            <option value="Pensão Alimentícia Recebida">Pensão Alimentícia Recebida</option>
                            <option value="Recebimento de Aluguéis">Recebimento de Aluguéis</option>
                            <option value="Outros">Outros</option>
                        </select>
                        <span class="msg-error">{{$errors->first('tipo')}}</span>
                    </div>
                    <div class="col-sm-2">
                        <label for="">Observação</label>
                        <input class="form-control" name="descricao" id="descricao" type="text" placeholder="" value="{{old('descricao')}}">  
                        <span class="msg-error">{{$errors->first('descricao')}}</span>                  
                    </div>                
                    <div class="col-sm-1">
                            <label for="" class="label-white">a</label>
                        <button type="submit" class="btn btn-danger">+ Adicionar receita</button>
                    </div>
                </div>
            </form>
            <div class="title2">
                    Receitas adicionadas:
                </div>
                @forelse ($comp as $i)
                <div class="well">
                    <div class="row">
                        <div class="col-sm-2">
                            <span class="glyphicon glyphicon-money "></span> <strong>R$:</strong> {{$i->receita}}
                        </div>
                        <div class="col-sm-2">
                            <span class="glyphicon glyphicon-home hidden icn-show"></span> {{$i->tipo}}
                        </div>
                        <div class="col-sm-3">
                            <span class="glyphicon glyphicon-calendar hidden icn-show"></span> {{$i->descricao}}
                        </div>
                        <div class="col-sm-3">
                            <div class="btn-group">                            
                                <a href="" data-toggle="modal" data-target="#{{$i->id}}" class="btn  btn-primary"><span class="glyphicon glyphicon-upload"></span> Enviar Comprovantes</a>
                                <a href="" data-toggle="modal" data-target="#excluir_{{$i->id}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="" data-original-title="Excluir"></span></a>
                            </div>
                        </div>
                        <div id="{{$i->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">            
                                <!-- Modal content-->
                                <div class="modal-content" style="background-color: white; color: #004f9f;">
                                    <div class="modal-header title2"><strong>Enviar Comprovantes</strong></div>
                                    <div class="modal-body">
                                        <form action="{{ route('gpoReceitasUpload', ['id'=>$i->id]) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="">Selecione os comprovantes de {{$i->tipo}}</label>
                                                    <input type="file" name="upload[]" id="upload" class="forom-control" multiple>
                                                    <small>extensões .jpg, .jpeg e .pdf</small>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                    <div class="col-sm-12">
                                                        <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#save">Enviar</button>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="excluir_{{$i->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">            
                                <!-- Modal content-->
                                <div class="modal-content" style="background-color: white; color: #004f9f;">
                                <div class="modal-header title2"><strong>Confirma a exclusão do {{$i->tipo}}?</strong></div>
                                    <div class="modal-body">                                                                                                                                                                                        
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <a href="{{ route('gpoDestroy', ['id'=>$i->id]) }}" class="btn btn-danger">Sim</a>
                                            </div>
                                            <div class="col-sm-6">
                                                <button data-dimiss="" class="btn btn-success">Não</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="background-color: #d6d6d6">
                        <div class="col-sm-12">
                            <div class="title2">
                                Comprovantes anexados:
                            </div>
                            @forelse ($i->documentos as $doc)
                                @if ($doc->gpo_receitas_id == $i->id)                                    
                                    <div class="col-sm-1">
                                            <div class="thumbnail">
                                                <a download="" href="{{url('/').$doc->url_doc}}">
                                                    <img src="{{url('/').$doc->url_doc}}" alt="" class="img-responsive img-thumbnail">
                                                    <div class="caption">
                                                        <span class="text">{{$doc->old_name_doc}}</span>
                                                    </div>
        
                                                </a>
                                            </div>
                                        </div>
                                @endif                             
                            @empty
                                <div class="alert alert-danger">
                                    Nenhum documento adicionado
                                </div>
                            @endforelse
                           
                        </div>
                    </div>
                </div>
                        @empty
                            <div class="alert alert-danger">
                               <strong> Nenhuma despesa adicionada</strong>
                            </div>
                        @endforelse
                    <br>
            
           
            
            <br>
            <div class="row text-center">
                <a class="btn btn-block btn-lg btn-danger" href="{{ route('gpoRecIndex', ['id'=>$_SESSION['id']]) }}">
                    <span class="glyphicon glyphicon-floppy-save"></span> Salvar dados
                </a>
            </div>
            <div id="save" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content" style="background-color: white; color: #004f9f;">
                        <div class="modal-body" align="center">
                            <h3>Salvando dados. Aguarde...</h3>
                            <img src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/585d0331234507.564a1d239ac5e.gif" alt="" width="100px">
                        </div>
                    </div>
                </div>
            </div>
            <br>
        <!--</form>-->
    </div>
    <script>
    $('#receita').mask('000.000.000.000.000,00', {reverse: true});
    </script>
@endsection