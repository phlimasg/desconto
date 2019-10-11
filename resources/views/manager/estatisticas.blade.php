@extends('layouts.admin')
@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {
        google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Status", "Quantidade", { role: "style" } ],
    @foreach ($status as $i)["{{$i->status_desc}}",{{$i->tt}},"silver"],
    @endforeach       
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "",
        width: 500,
        height: 500,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("chart_div"));
      chart.draw(view, options);
  }
    }
</script>
<h2>Estatisticas</h2>
<hr>
<div class="row">
    <div class="col-sm-4">
        <p>Total de candidatos cadastrados <b>{{$candidatos}}</b>. <br>
        Desses candidatos, <b>{{$cand_irmaos}}</b> possuem irmãos estudando no colégio. <br>
        <b>{{$documentos}}</b> documentos foram enviados. <br>
        <b>{{$gp_fam}}</b> pessoas foram cadastradas nos grupos familiares desses candidatos. <br>
        
    </p>
    </div>
    <div class="col-sm-6" id="chart_div" style="min-height: 500px">


    </div>
<div class="col-sm-2">
        <div class="table-responsive">          
                <table class="table">
                  <thead>
                    <tr>                      
                      <th>Desconto</th>
                      <th>Qtd.</th>                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    @forelse ($desc_aut as $i)
                    <td>{{$i->valor_aut}}</td>
                    <td>{{$i->total}}</td>
                </tr>
                    @empty
                    Vazio
                    @endforelse                      
                  </tbody>
                </table>
                </div>

    
</div>
@endsection