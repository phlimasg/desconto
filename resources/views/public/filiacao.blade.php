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
        Filiação (Identificação dos responsáveis legais/tutores)
    </div>
        <form action="{{route('fSave',['id'=>$_SESSION['id']])}}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-3">
                    <div class="title3">
                        Tutor 1:
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label for="">Nome Completo:</label>
                    <input type="text" class="form-control" name="nome_t1" value="@if(!old('nome_t1')){{$fil->nome_t1}}@else {{old('nome_t1')}}@endif">
                    <span class="msg-error">{{$errors->first('nome_t1')}}</span>
                </div>
                <div class="col-sm-2">
                    <label for="">CPF:</label>
                    <input type="input" class="form-control" id="cpf_t1" name="cpf_t1" value="{{old('cpf_t1')}}{{$fil->cpf_t1}}">
                    <span class="msg-error">{{$errors->first('cpf_t1')}}</span>
                </div>
                <div class="col-sm-2">
                    <label for="">RG:</label>
                    <input type="input" class="form-control" name="rg_t1" value="{{old('rg_t1')}}" id="rg_t1">
                    <span class="msg-error">{{$errors->first('rg_t1')}}</span>
                </div>
                <div class="col-sm-2">
                    <label for="">Data de Nasc.:</label>
                    <input type="text" id="dtnasc_t1" class="form-control" name="dtnasc_t1" value="{{$fil->dtnasc_t1}}">
                    <span class="msg-error">{{$errors->first('dtnasc_t1')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label class="radio-inline"><input type="radio" name="rd_t1" checked value="Reside com o candidato"> Reside com o candidato</label>
                    <label class="radio-inline"><input type="radio" name="rd_t1" value="Falecido(a)">Falecido(a)</label>
                    <label class="radio-inline"><input type="radio" name="rd_t1" value="Separado(a) do Genitor(a)">Separado(a) do Genitor(a)</label>
                    <label class="radio-inline"><input type="radio" name="rd_t1" value="Guarda compartilhada">Guarda compartilhada</label>
                    <label class="radio-inline"><input type="radio" name="rd_t1" value="Outro">Outro</label>
                </div>
                <span class="msg-error">{{$errors->first('rd_irmao')}}</span>
            </div>


            <div class="row">
                <div class="col-sm-3">
                    <div class="title3">
                        Tutor 2:
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label for="">Nome Completo:</label>
                    <input type="text" class="form-control" name="nome_t2" value="@if(!old('nome_t2')){{$fil->nome_t2}}@else {{old('nome_t2')}}@endif">
                    <span class="msg-error">{{$errors->first('nome_t2')}}</span>

                </div>
                <div class="col-sm-2">
                    <label for="">CPF:</label>
                    <input type="input" class="form-control" name="cpf_t2" id="cpf_t2" value="{{old('cpf_t2')}}{{$fil->cpf_t2}}">
                    <span class="msg-error">{{$errors->first('cpf_t2')}}</span>
                </div>
                <div class="col-sm-2">
                    <label for="">RG:</label>
                    <input type="input" class="form-control" name="rg_t2" id="rg_t2" value="{{old('rg_t2')}}">
                    <span class="msg-error">{{$errors->first('rg_t2')}}</span>
                </div>
                <div class="col-sm-2">
                    <label for="">Data de Nasc.:</label>
                    <input type="text" id="dtnasc_t2" class="form-control" name="dtnasc_t2" value="{{old('dtnasc_t2')}}{{$fil->dtnasc_t2}}">
                    <span class="msg-error">{{$errors->first('dtnasc_t2')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label class="radio-inline"><input type="radio" name="rd_t2" value="Reside com o candidato"> Reside com o candidato</label>
                    <label class="radio-inline"><input type="radio" name="rd_t2" value="Falecido(a)">Falecido(a)</label>
                    <label class="radio-inline"><input type="radio" name="rd_t2" value="Separado(a) do Genitor(a)">Separado(a) do Genitor(a)</label>
                    <label class="radio-inline"><input type="radio" name="rd_t2" value="Guarda compartilhada">Guarda compartilhada</label>
                    <label class="radio-inline"><input type="radio" name="rd_t2" value="Outro">Outro</label>
                </div>
            </div>

            <br>
            <div class="row text-center">
                <button class="btn btn-block btn-lg btn-danger" type="submit" data-toggle="modal" data-target="#save">
                    <span class="glyphicon glyphicon-floppy-save"></span> Salvar dados
                </button>
            </div>
            <br>
        </form>
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
    <script>
        $("#dtnasc_t1").mask('00/00/0000');
        $("#dtnasc_t2").mask('00/00/0000');
        $('#cpf_t1').mask('999.999.999-99');
        $('#cpf_t2').mask('999.999.999-99');
        $('#rg_t1').mask('99.999.999-9');
        $('#rg_t2').mask('99.999.999-9');
    </script>
@endsection