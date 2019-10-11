<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <!--Scripts-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/manager/abel')}}"><span class="glyphicon glyphicon-home"></span></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Candidatos <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('status',['id' => Request::segment(2),'id_status' => '1'])}}">Supervisão Administrativa</a></li>
                        <li><a href="{{route('status',['id' => Request::segment(2),'id_status' => '2'])}}">Falta Documentação</a></li>
                        <li><a href="{{route('status',['id' => Request::segment(2),'id_status' => '3'])}}">Deferidos</a></li>
                        <li><a href="{{route('status',['id' => Request::segment(2),'id_status' => '4'])}}">Indeferidos</a></li>
                        <li><a href="{{route('liberar',['id' => Request::segment(2)])}}">Liberar RA</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-console"></span> Configurações <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('user',['id' => Request::segment(2)])}}">Usuários</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('relatorio',['id' => Request::segment(2)])}}">
                        <span class="glyphicon glyphicon-export"></span> Gerar Relatório
                    </a>
                </li>
                <li>
                    <a href="{{route('estatistica')}}">
                        <span class="glyphicon glyphicon-export"></span> Estatistica
                    </a>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <form class="navbar-form navbar-left" action="{{route('search',['id' => Request::segment(2)])}}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="busca" placeholder="Matricula ou Nome">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <li><a href="{{route('logout')}}"><span class="glyphicon glyphicon-off text-danger"></span></a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    @yield('content')
</div>




</body>
</html>
