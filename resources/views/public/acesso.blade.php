@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="title">
             Processo de Desconto Comercial {{date('Y')+1}}
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 text-justify">
                <div class="title3">
                    Para iniciar o processo, insira o nº da matrícula, caso já seja aluno ou o nº da inscrição, caso seja aluno novo.
                </div>

            </div>
        </div>
        <form action="{{route('acessoValidar')}}" method="post">
            @csrf

            <div class="row">
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Apenas números" id="acesso" name="acesso" autofocus>
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit" data-toggle="modal" data-target="#myModal">
                                <i class="glyphicon glyphicon-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($mat))
                <div class="">
                    <li class="msg-error">{{$mat}}</li>
                    Caso seja aluno novo, a inscrição só é valida após o pagamento da taxa.
                </div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <li class="msg-error">
                        {{$error}}
                    </li>
                @endforeach
            @endif
        </form>
    </div>
    <script>
        $(document).ready(function () {
            $('#acesso').mask('99999999999');
        });
    </script>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="background-color: white; color: #004f9f;">
                <div class="modal-body" align="center">
                    <h3>Procurando dados. Aguarde...</h3>
                    <img src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/585d0331234507.564a1d239ac5e.gif" alt="" width="100px">
                </div>
            </div>

        </div>
    </div>
@endsection