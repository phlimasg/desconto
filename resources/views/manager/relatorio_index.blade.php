@extends('layouts.admin')
@section('content')
<form action="" method="post">
    @csrf
    <div class="row">
        <div class="col-sm-2">
            <label for="dt_ini">Data inicial:</label>
            <input type="date" class="form-control" name="dt_ini" required value="{{date('Y-m-').'05'}}">
        </div>
        <div class="col-sm-2">
            <label for="dt_fim">Data Final:</label>
            <input type="date" class="form-control" name="dt_fim" required value="{{date('Y-m-d')}}">
        </div>
        <div class="col-sm-2">
            <label for="unidade">Status:</label>
            <select name="id" id="" class="form-control">
            @foreach($st as $s)
                    <option value="{{$s->id}}">{{$s->status}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> Gerar</button>
        </div>
    </div>
</form>
    @endsection