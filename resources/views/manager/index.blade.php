@extends('layouts.admin')
@section('content')
    @if(!empty($st))
        <h2>{{$st->status}}</h2>
        @else
        <h2>Candidatos não analizados</h2>
        @endif
    {{ $candidato->links() }}
    <div class="container-fluid">
        @foreach ($candidato as $c)
            <div class="well well-lg" style="border: 1px;">
                <div class="row">
                    <div class="col-sm-1">
                        <label for="">Id</label><br>
                        {{ strtoupper( $c->id_cand)}}
                    </div>
                    <div class="col-sm-4">
                        <label for="">Candidato</label><br>
                        {{ strtoupper( $c->nome_cand)}}
                    </div>
                    <div class="col-sm-1">
                        <label for="">Solicitação</label><br>                        
                        {{date('d/m/Y', strtotime($c->created_at))}}
                    </div>
                    <div class="col-sm-1">
                        <label for="">Percentual</label><br>
                        @if(stripos($c->desc_cand,'%'))
                            {{$c->desc_cand}}
                        @elseif($c->desc_cand != null)
                            {{$c->desc_cand}}%
                        @else
                        @endif
                    </div>
                    <div class="col-sm-1">
                        <label for="">Sugerido</label><br>
                        @if(!empty($c->desc_sug))
                            @if(stripos($c->desc_sug,'%'))
                                {{$c->desc_sug}}
                            @else
                                {{$c->desc_sug}}%
                            @endif

                        @endif
                    </div>
                    <div class="col-sm-1">
                        <label for="">Aprovado</label><br>
                        @if(!empty($c->desc_aut))
                            @if(stripos($c->desc_aut,'%'))
                                {{$c->desc_aut}}
                            @else
                                {{$c->desc_aut}}%
                            @endif

                        @endif
                    </div>
                    <div class="col-sm-1">
                        <label for="">Status</label><br>
                        {{$c->status_desc}}
                    </div>
                    <div class="col-sm-1">
                    </div>
                </div>
                <div class="row text-right">
                    <div class="col-sm-12">
                        <a href="{{route('mCandidato',['id' => Request::segment(2),'mat' => $c->id_cand])}}" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> Analisar</a>
                    </div>

                </div>
            </div>
            <hr>
        @endforeach
    </div>

    {{ $candidato->links() }}
    @endsection