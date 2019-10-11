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
        Responsável Financeiro
    </div>
        <form action="{{route('finSave',['id'=>$_SESSION['id']])}}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-4">
                    <label for="">Nome Completo:</label>
                    <input type="text" class="form-control" name="nome_fin" value="@if(old('nome_fin') == null){{$dados->nome_fin}} @else{{old('nome_fin')}}@endif">
                    <span class="msg-error">{{$errors->first('nome_fin')}}</span>
                </div>
                <div class="col-sm-2">
                    <label for="">CPF:</label>
                    <input type="input" class="form-control" name="cpf_fin" value="@if(old('cpf_fin') == null){{$dados->cpf_fin}} @else{{old('cpf_fin')}}@endif" id="cpf">
                    <span class="msg-error">{{$errors->first('cpf_fin')}}</span>
                </div>
                <div class="col-sm-2">
                    <label for="">Telefone:</label>
                    <input type="input" class="form-control" name="tel1_fin" value="@if(old('tel1_fin') == null){{$dados->tel1_fin}} @else{{old('tel1_fin')}}@endif" id="tel1_fin">
                    <span class="msg-error">{{$errors->first('tel1_fin')}}</span>
                </div>
                <div class="col-sm-2">
                    <label for="">Telefone de Recado:</label>
                    <input type="input" class="form-control" name="tel2_fin" id="tel2_fin" value="@if(old('tel2_fin') == null){{$dados->tel2_fin}} @else{{old('tel2_fin')}}@endif">
                    <span class="msg-error">{{$errors->first('tel2_fin')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="">Email:</label>
                    <input type="email" class="form-control" name="email_fin" value="@if(old('email_fin') == null){{$dados->email_fin}} @else{{old('email_fin')}}@endif">
                    <span class="msg-error">{{$errors->first('email_fin')}}</span>
                </div>
                <div class="col-sm-2">
                    <label for=""> Vínculo com o candidato</label>
                    <div class="col-sm-16">
                        <label class="radio-inline"><input type="radio" name="vinculo_fin" onclick="$('#txt_outro').hide(500);" value="Pai">Pai</label>
                        <label class="radio-inline"><input type="radio" name="vinculo_fin" onclick="$('#txt_outro').hide(500);" value="Mãe">Mãe</label>
                        <label class="radio-inline"><input type="radio" name="vinculo_fin" onclick="$('#txt_outro').show(500);" value="0">Outro</label>
                    </div>
                    <span class="msg-error">{{$errors->first('vinculo_fin')}}</span>
                </div>
                <div class="col-sm-2" hidden id="txt_outro">
                    <label for="">Especifique:</label>
                    <input type="text" class="form-control" name="txt_vinc_fin">
                    <span class="msg-error">{{$errors->first('txt_vinc_fin')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label for="">Justificativa do pedido:</label>
                    <textarea name="just_fin" id="" cols="30" rows="5" maxlength="250" class="form-control">{{old('just_fin')}}</textarea>
                    <span class="msg-error">{{$errors->first('just_fin')}}</span>
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
        var SPMaskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

        $('#tel1_fin').mask(SPMaskBehavior, spOptions);
        $('#tel2_fin').mask(SPMaskBehavior, spOptions);
        $('#cpf').mask('999.999.999-99');

    </script>
@endsection