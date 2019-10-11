@extends('layouts.admin')
@section('content')
<form action="" method="post">
    @csrf
    <div class="row">
        <div class="col-sm-3">
            <label for="name">Matrícula para liberação:</label>
            <input type="text" class="form-control" name="ra">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-2">
            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> Liberar RA</button>
        </div>

    </div>
</form>
    <h4>Matrículas Liberadas:</h4>
    @foreach($ra as $r)
        <hr>
        <div class="row">
            <div class="col-sm-1">
                {{$r->ra}}
            </div>
            <div class="col-sm-3">
                Usuário: {{$r->user}}
            </div>
            <div class="col-sm-3">
                Dia: {{$r->created_at}}
            </div>
            <div class="col-sm-3">
                <a href="{{url('/manager/abel/excluir')}}/{{$r->id_ra}}" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
        </div>
    @endforeach
    @endsection