@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <h1 class="title">Descontos Comerciais {{date('Y')+1}}</h1>
    <div class="panel panel-primary" style="border-radius: 0px">
        <div class="panel-heading" style="border-radius: 0px"><h4>AVISO</h4></div>
        <div class="panel-body">
            Solicitação efetuada para essa(e) matricula/nº de inscrição. <br>
            Agradecemos a inscrição e em breve entraremos em contato.
        </div>
    </div>
</div>
    @php(session_start())
    @php(session_destroy())
@endsection