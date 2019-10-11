@extends('layouts.app')

@section('content')
    @php(session_start())
    <div class="container-fluid">
        <div class="title">
             Processo de Desconto Comercial {{date('Y')+1}}
        </div>
        {{storage_path()}}
    </div>
    <div class="container-fluid">
    <div class="title2">
        Enviar arquivos
    </div>
        <form action="{{route('uploadSave',['id'=>$_SESSION['id'], 'id_comp' => $id_comp])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="title3">
                        NOME DO FULANO
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <input type="file" name="upload[]" multiple> <button type="submit"> enviar</button>
                    <span class="msg-error">{{$errors->first('upload.*')}}</span>
                </div>
            </div>
            <div class="container-fluid well">
                <div class="title3">
                    Arquivos enviados:
                </div>
                @php($count = 0)
                @foreach($files as $f)
                    @if($count == 0)
                        <div class="row">
                        @endif
                    @if(strpos($f->url_doc,'.pdf'))
                            <div class="col-sm-2">
                                <div class="thumbnail">
                                    <a download href="{{asset('/storage/').'/'.$f->url_doc}}">
                                        <img src="{{asset('/img/pdf.png')}}" alt="" class="img-responsive">
                                        <div class="caption">
                                            {{$f->old_name_doc}}
                                        </div>
                                    </a>
                                </div>
                            </div>
                    @else
                            <div class="col-sm-2">
                                <div class="thumbnail">
                                    <a download href="{{asset('/storage/').'/'.$f->url_doc}}">
                                        <img src="{{asset('/storage/').'/'.$f->url_doc}}" alt="" class="img-responsive img-thumbnail">
                                        <div class="caption">
                                            {{$f->old_name_doc}}
                                        </div>

                                    </a>
                                </div>
                            </div>

                    @endif
                        @if($count == 5)
                            </div>
                            @php($count==0)
                        @endif
                    @php($count++)
                    @endforeach
            </div>
        </form>
    </div>
@endsection