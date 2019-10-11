@extends('layouts.admin')
@section('content')
<form action="" method="post">
    @csrf
    <div class="row">
        <div class="col-sm-3">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="col-sm-2">
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email">
        </div>
        <div class="col-sm-2">
            <label for="unidade">Unidade:</label>
            <select name="unidade" id="" class="form-control">
                <option value="abel">La Salle Abel</option>
            </select>
        </div>
        <div class="col-sm-2">
            <label for="profile">Perfil:</label>
            <select name="profile" id="" class="form-control">
                <option value=""></option>
                <option value="Root">Root</option>
                <option value="Admin">Admin</option>
                <option value="Comissão">Comissão</option>
                <option value="Financeiro">Financeiro</option>
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-2">
            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span> Adicionar</button>
        </div>

    </div>
</form>
    @endsection