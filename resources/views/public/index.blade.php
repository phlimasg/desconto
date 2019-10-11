@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="title">
             Processo de Desconto Comercial {{date('Y')+1}}
        </div>
    </div>
    <div class="container-fluid">
        <div class="title2">
                <span class="glyphicon glyphicon-list-alt icon-16"></span>  DOCUMENTOS EXIGIDOS DO GRUPO FAMILIAR - DOS DOCUMENTOS DE RENDA
        </div>
        <div class="title3">
            <span class="glyphicon glyphicon-chevron-right"></span> IMPOSTO DE RENDA PESSOA FÍSICA
        </div>
        <div class="container2">
            <div class="row">
                <li class="text-danger">Obrigatório para todos os membros do grupo familiar que declararem</li>
                <li>	Declaração IRPF completa acompanhada do Recibo de Entrega</li>
                <li>Se isento de declaração, apresentar a cópia da consulta eletrônica, campo RESTITUIÇÃO DO IR no site da Receita Federal: <a href="https://servicos.receita.fazenda.gov.br/Servicos/ConsRest/Atual.app/paginas/index.asp">https://servicos.receita.fazenda.gov.br/Servicos/ConsRest/Atual.app/paginas/index.asp</a></li>
            </div>
        </div>

        <div class="title3">
            <span class="glyphicon glyphicon-chevron-right"></span> CARTEIRA DE TRABALHO - CTPS
        </div>
        <div class="container2">
            <div class="row">
                <span class="text-danger"><li>Obrigatório para todos os membros do grupo familiar maiores de 18 anos.</li></span>
                <li>Folha de rosto, dados pessoais, último contrato de trabalho e página seguinte em branco, últimas anotações gerais e página seguinte em branco.</li>
                <li>Caso não possuía CTPS, deverá providenciar a confecção ou o CAGED - emitido pelo Ministério do Trabalho, através do agendamento (Anexar o Agendamento):
                    <a href="http://saaweb.mte.gov.br/inter/saa/pages/agendamento/main.seam">http://saaweb.mte.gov.br/inter/saa/pages/agendamento/main.seam</a> </li>

            </div>
        </div>

        <div class="title3">
            <span class="glyphicon glyphicon-chevron-right"></span> Assalariados
        </div>
        <div class="container2">
            <div class="row">
                <li>Contracheques dos 03 (três) últimos meses, ou no caso de recebimento de variável os 06 (seis) últimos contracheques; Cópia da (CTPS) carteira de trabalho.</li>
            </div>
        </div>

        <div class="title3">
            <span class="glyphicon glyphicon-chevron-right"></span> Desempregado Recebendo Seguro Desemprego
        </div>
        <div class="container2">
            <div class="row">
                Último extrato da parcela de seguro-desemprego; Rescisão contratual e comprovante do saque do FGTS; Cópia da (CTPS) carteira de trabalho.
            </div>
        </div>

        <div class="title3">
            <span class="glyphicon glyphicon-chevron-right"></span> Desempregados ou trabalhadora do Lar sem ter nenhum tipo de renda

        </div>
        <div class="container2">
            <div class="row">
                <li>Declaração de próprio punho com testemunha, informando não possuir renda; e Cópia da (CTPS) carteira de trabalho.</li>
            </div>
        </div>

        <div class="title3">
            <span class="glyphicon glyphicon-chevron-right"></span> Funcionário Público
        </div>
        <div class="container2">
            <div class="row">
                <li>Comprovante de renda 03 (três) últimos ou no caso de comissão/hora extra os (06) últimos contracheques; Página do Diário Oficial de exoneração de cargo público, quando for o caso; Cópia da (CTPS) carteira de trabalho.</li>
            </div>
        </div>

        <div class="title3">
            <span class="glyphicon glyphicon-chevron-right"></span> Proprietário de Empresa (sócio-cotista) ou de Firma Individual ou Empregador titular
        </div>
        <div class="container2">
            <div class="row">
                <li>Resumo/Recibo de entrega da Escrituração Contábil Fiscal (ECF) ou a Declaração Anual do Simples Nacional.</li>
                <li>DECORE, assinada por Contador inscrito no CRC, contendo as informações do Pró-Labore dos últimos 3 meses, e o contrato social evidenciando a participação dos Resultados da Empresa; Caso a empresa não tenha movimentação, apresentar também o comprovante de inatividade expedido pela receita Federal; Cópia da (CTPS) carteira de trabalho.</li>

            </div>
        </div>

        <div class="title3">
            <span class="glyphicon glyphicon-chevron-right"></span> Microempreendedor individual
        </div>
        <div class="container2">
            <div class="row">
                <li>Certificado de condição de Microempreendedor Individual; Declaração Anual do Simples, Relatório Mensal das Receitas brutas dos últimos 3 meses; Cópia da (CTPS) carteira de trabalho</li>
            </div>
        </div>
        <div class="title3">
            <span class="glyphicon glyphicon-chevron-right"></span> Trabalhador Informal e Autônomo
        </div>
        <div class="container2">
            <div class="row">
                <li>Declaração de próprio punho com testemunha; Cópia da (CTPS) carteira de trabalho.</li>
            </div>
        </div>
        <div class="title3">
            <span class="glyphicon glyphicon-chevron-right"></span> Estagiário/Menor Aprendiz
        </div>
        <div class="container2">
            <div class="row">
                <li>Contrato e/ou termo de compromisso de estágio em vigência indicando o valor recebido e os 03 últimos comprovantes de pagamento; Cópia da (CTPS) carteira de trabalho.</li>
            </div>
        </div>
        <div class="title3">
            <span class="glyphicon glyphicon-chevron-right"></span> Aposentado, Pensionista ou Auxílio Doença do INSS
        </div>
        <div class="container2">
            <div class="row">
                <li>Extrato de pagamento constando valor bruto do benefício. Fornecido pelo INSS através do link: <a
                            href="http://www.previdencia.gov.br/servicos-ao-cidadao/todos-os-servicos/extrato-de-pagamento-de-beneficio/">http://www.previdencia.gov.br/servicos-ao-cidadao/todos-os-servicos/extrato-de-pagamento-de-beneficio/</a>; Cópia da carteira de trabalho.</li>
            </div>
        </div>
        <div class="title3">
            <span class="glyphicon glyphicon-chevron-right"></span> Trabalhador Cooperado
        </div>
        <div class="container2">
            <div class="row">
                <li>Declaração original em papel timbrado da cooperativa, assinada pelo responsável legal, constando atividade desenvolvida e média de rendimento bruto dos últimos 03 (três) meses, com carimbo do CNPJ da cooperativa; Cópia da (CTPS) carteira de trabalho.</li>
            </div>
        </div>
        <div class="title3">
            <span class="glyphicon glyphicon-chevron-right"></span> Pagamento de pensão alimentícia
        </div>
        <div class="container2">
            <div class="row">
                <li>Comprovante da decisão judicial homologado e os três últimos comprovantes pagos atuais. Nos casos que, o acordo é verbal, apresentar declaração com as devidas assinaturas.</li>
            </div>
        </div>
        <div class="title3">
            <span class="glyphicon glyphicon-chevron-right"></span> Recebendo Rendimentos de aluguel
        </div>
        <div class="container2">
            <div class="row">
                <li>Contrato de aluguel e os últimos 3 (três) comprovantes de recebimentos.</li>
            </div>
        </div>
    </div>

    <div class="well container-fluid">
        <div class="container2">
            <div class="row">
                <input type="checkbox" id="chk_confirm" onclick="f()"> Declaro que lí e estou com todos os documentos necessários em mãos.
            </div>
            <div class="row">
                <a href="{{route('acesso')}}" id="next">
                    <button  class="btn btn-danger" hidden>Avançar</button>
                </a>
            </div>
        </div>

    </div>

    <div id="aviso" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <div align="center">
                        <h3>Colégio La Salle Abel Informa:</h3>
                    </div>
                    <br>
                    <p>Antes de iniciar, leia atentamente as instruções e só inicie o processo estando com todos os documentos devidamente escaneados.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ler Instruções</button>
                </div>
            </div>

        </div>
    </div>
    <script>
        $("#aviso").modal('show');
        $("#next").hide();
        function f() {
            if($("#chk_confirm").prop("checked")){
                $("#next").show(500);
            }
            else{
                $("#next").hide(500);
            }
        }


    </script>

@endsection