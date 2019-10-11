@extends('layouts.app')
@section('content')
    
    <div class="container-fluid">
        <div class="title">
             Processo de Desconto Comercial {{date('Y')+1}}
        </div>
    </div>
    <div class="container-fluid">
    <div class="title2">
        Identificação do Aluno/Candidato
    </div>    
        <form action="{{route('cSave',['id'=>$_SESSION['id']])}}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <label for="">Nome Completo do Aluno:</label>
                    <input type="text" class="form-control" @if(!empty($candidato)) value="{{$candidato->nome_cand}}" @endif name="nome_cand">
                    <span class="msg-error">{{$errors->first('nome_cand')}}</span>
                </div>
                <div class="col-sm-3">
                    <label for="">Data de Nascimento:</label>
                    <input type="text" class="form-control" name="dtnasc_cand" id="dtnasc" @if(!empty($candidato)) value="{{$candidato->dtnasc_cand}}" @endif>
                    <span class="msg-error">{{$errors->first('dtnasc_cand')}}</span>
                </div>
                <div class="col-sm-3">
                    <label for="">Telefone:</label>
                    <input type="text" class="form-control" id="tel" name="tel_cand" @if(!empty($candidato)) value="{{$candidato->tel_cand}}" @endif>
                    <span class="msg-error">{{$errors->first('tel_cand')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <label for="">CEP:</label>
                    <input type="text" id="cep" name="cep_cand" class="form-control" @if(!empty($candidato)) value="{{strtoupper($candidato->cep_cand)}}" @endif>
                    <span class="msg-error">{{$errors->first('cep_cand')}}</span>
                </div>
                <div class="col-sm-6">
                    <label for="">Endereço:</label>
                    <input type="text" class="form-control" name="rua_cand" id="rua" @if(!empty($candidato)) value="{{strtoupper($candidato->rua_cand)}}" @endif>
                    <span class="msg-error">{{$errors->first('rua_cand')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="">Bairro:</label>
                    <input type="text" class="form-control" id="bairro" name="bairro_cand">
                    <span class="msg-error">{{$errors->first('bairro_cand')}}</span>
                </div>
                <div class="col-sm-3">
                    <label for="">Cidade:</label>
                    <input type="text" class="form-control" id="cidade" name="cidade_cand">
                    <span class="msg-error">{{$errors->first('cidade_cand')}}</span>
                </div>

                <div class="col-sm-3">
                    <label for="">Estado:</label>
                    <input type="text" class="form-control" id="uf" name="estado_cand">
                    <span class="msg-error">{{$errors->first('estado_cand')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="title3">
                        Instituição de ensino de Origem:
                    </div>
                </div>
            </div>
                @if(!empty($candidato))
                    @if($candidato->aluno_novo_cand == 0)
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="radio" name="aluno_novo" onclick="$('#dv_alu_true').show(500);$('#dv_esc_ori').hide(500);" checked value="0">Aluno do La Salle Abel
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="radio" name="aluno_novo" onclick="$('#dv_esc_ori').show(500);$('#dv_alu_true').hide(500);" value="1">Aluno novo
                        </div>
                        <span class="msg-error">{{$errors->first('aluno_novo')}}</span>
                    </div>
                    <script>
                        $(document).ready(function (){
                            $('#dv_alu_true').show(500);
                        });
                    </script>
                        @else
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="radio" name="aluno_novo" onclick="$('#dv_alu_true').show(500);$('#dv_esc_ori').hide(500);" value="0">Aluno do La Salle Abel
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="radio" name="aluno_novo" onclick="$('#dv_esc_ori').show(500);$('#dv_alu_true').hide(500);" checked value="1">Aluno novo
                        </div>
                        <span class="msg-error">{{$errors->first('aluno_novo')}}</span>
                    </div>
                    <script>
                        $(document).ready(function (){
                            $('#dv_esc_ori').show(500);
                        });

                    </script>
                    @endif
                @endif
            <div class="row" hidden id="dv_esc_ori">
                <div class="col-sm-4">
                    <label for=""> Nome da Escola de Origem:</label>
                    <input type="text" class="form-control" name="aluno_novo_origem_cand">
                    <span class="msg-error">{{$errors->first('aluno_novo_origem_cand')}}</span>
                </div>
            </div>
            <div class="row" hidden id="dv_alu_true">
                <div class="col-sm-2">
                    <label>Possui desconto comercial?</label><br>
                    <div class="radio">
                        <label><input type="radio" name="rd_desc" onclick="$('#dv_alu_perc').show(500)" value="1"> Sim</label>
                        <label><input type="radio" name="rd_desc" onclick="$('#dv_alu_perc').hide(500)" value="0"> Não</label>
                    </div>
                    <span class="msg-error">{{$errors->first('rd_desc')}}</span>
                </div>
                <div class="col-sm-2" id="dv_alu_perc" hidden>
                    <label for="">Qual percentual?</label>
                    <input type="text" class="form-control" placeholder="10%" name="desc_cand">
                    <span class="msg-error">{{$errors->first('desc_cand')}}</span>
                </div>
                <div class="col-sm-3"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-2">
                    <label for="">Ensino Pretendido:</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="escolaridade_cand" value="Ensino Fundamental I">Ensino Fundamental I
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="escolaridade_cand" value="Ensino Fundamental II">Ensino Fundamental II
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="escolaridade_cand" value="Ensino Médio">Ensino Médio
                        </label>
                    </div>
                    <span class="msg-error">{{$errors->first('escolaridade_cand')}}</span>
                </div>
                    @if(!empty($candidato))
                        @if($candidato->deficiencia_cand != null)
                        <div class="col-sm-2">
                            <label for="">Possui deficiência física?</label>
                            <div class="radio">
                                <label><input type="radio" name="deficiencia_cand_rd" onclick="$('#dv_def_ql').show(500)" checked>Sim</label>
                                <label><input type="radio" name="deficiencia_cand_rd" onclick="$('#dv_def_ql').hide(500)">Não</label>
                            </div>
                            <span class="msg-error">{{$errors->first('deficiencia_cand_rd')}}</span>
                        </div>
                        <div class="col-sm-4" id="dv_def_ql">
                            <label>Qual?</label>
                            <textarea name="deficiencia_cand" id="" rows="5"  class="form-control" placeholder="Descreva a defiência do Aluno/Candidato"> {{$candidato->deficiencia_cand}}</textarea>
                            <span class="msg-error">{{$errors->first('deficiencia_cand')}}</span>
                        </div>
                            @else
                        <div class="col-sm-2">
                            <label for="">Possui deficiência física?</label>
                            <div class="radio">
                                <label><input type="radio" name="deficiencia_cand_rd" onclick="$('#dv_def_ql').show(500)" >Sim</label>
                                <label><input type="radio" name="deficiencia_cand_rd" onclick="$('#dv_def_ql').hide(500)" checked>Não</label>
                            </div>
                            <span class="msg-error">{{$errors->first('deficiencia_cand')}}</span>
                        </div>
                        <div class="col-sm-4" id="dv_def_ql" hidden>
                            <label>Qual?</label>
                            <textarea id="" name="deficiencia_cand" rows="5" class="form-control" placeholder="Descreva a defiência do Aluno/Candidato"></textarea>
                            <span class="msg-error">{{$errors->first('deficiencia_cand')}}</span>
                        </div>
                        @endif
                    @endif
                </div>

            <div class="row">
                <div class="col-sm-4">
                    <label for="">Possui irmão na estudando no La Salle Abel?</label>
                    <div class="radio">
                        <label><input type="radio" name="rd_irmao" onclick="$('#dv_irmao').show(500)" value="1">Sim</label>
                        <label><input type="radio" name="rd_irmao" onclick="$('#dv_irmao').hide(500)" value="0">Não</label>
                    </div>
                    <span class="msg-error">{{$errors->first('rd_irmao')}}</span>
                </div>
                <div class="col-sm-3" id="dv_irmao" hidden>
                    <div class="row">
                        <label for="">Informe a matrícula do irmão:</label>
                    </div>
                    <div class="row" >
                        <input type="text" class="form-inline" placeholder="12345" name="matricula[]">
                        <a class="btn btn-sm btn-primary" id="add_irm" name="add_irm"><span class="glyphicon glyphicon-plus"></span></a>
                        <div class="row">
                            <span class="msg-error">{{$errors->first('matricula[]')}}</span>
                        </div>
                    </div>
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
        function removeElement(elementId) {
            var element = document.getElementById(elementId);
            element.parentNode.removeChild(element);
        }
        $("#dtnasc").mask('00/00/0000');
        
        $("#add_irm").click(function(){
            var rand = Math.floor((Math.random() * 100) + 1);
            var mat = "#mat_" + rand;
            var mat_ = "'#mat_" + rand+"'";
            $("#dv_irmao").append('<div class="row" id="' + mat + '">' +
                '<input type="text" class="form-inline" placeholder="12345" name="matricula[]">\n' +
                '<a class="btn btn-sm btn-danger" onclick="removeElement('+ mat_ +')"><span class="glyphicon glyphicon-minus"></span></a>\n' +
                '</div>');
        });
        $(function($){
            var SPMaskBehavior = function (val) {
                    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                },
                spOptions = {
                    onKeyPress: function (val, e, field, options) {
                        field.mask(SPMaskBehavior.apply({}, arguments), options);
                    }
                };

            $('#tel').mask(SPMaskBehavior, spOptions);
            $("#cep").mask("99999-999");
            //$("#dtnasc").mask("99/99/9999");


            var cep = $("#cep").val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#uf").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    alert("Formato de CEP inválido.");
                }
            } //end if.
        });

        $("#cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#uf").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });

    </script>
@endsection