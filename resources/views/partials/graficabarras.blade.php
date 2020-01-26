<script>
    
    window.onload = function () {
    
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title:{
            text: "Desempeño de Consultor"
        },	
        axisY: {
            maximum: 30000,
            prefix: "R$" ,
            titleFontColor: "#4F81BC",
            lineColor: "#4F81BC",
            labelFontColor: "#4F81BC",
            tickColor: "#4F81BC"
        },
        axisY2: {
            maximum: 30000,
            prefix: "R$" ,
            titleFontColor: "#4F81BC",
            lineColor: "#4F81BC",
            labelFontColor: "#4F81BC",
            tickColor: "#4F81BC"
        },	
        toolTip: {
            shared: true
        },
        legend: {
            cursor:"pointer",
            itemclick: toggleDataSeries
        },
        data: [
            @for($a=0;$a<count($input['consultores']); $a++)  
            @php
                          
            $datos=App\Models\Usuario::where('co_usuario',$input['consultores'][$a])->first();
            
            @endphp     
        {
            type: "column",
            name: "{{$datos->no_usuario}}",
            legendText: "{{$datos->no_usuario}}",
            showInLegend: true, 
            dataPoints:[

                @for($x=0;$x<count($relatorio);$x++)
           
                @if($input['consultores'][$a]==$relatorio[$x]['usuario'])
                { label: "{{$relatorio[$x]['mes']}}", y:{{number_format($relatorio[$x]['recita'],2,'.','')}}},

                @endif
                @php
                $mes=array($relatorio[$x]['mes']);
                if (!in_array($relatorio[$x]['mes'], $mes)) {
                    array_push($mes,$relatorio[$x]['mes']);
                }
                @endphp
                @endfor
            ]
        },
        @endfor
       
        {
            type: "line",
            showInLegend: true,
            name: "Costo fixed",
            axisYType: "secondary", 
            dataPoints: [
                @for($a=0; $a<=count($mes);$a++)
                { x: "{{$a}}", y: {{$costofixofinal}} },
                @endfor 
            ]
        }

         ]
    });
    chart.render();
    
    function toggleDataSeries(e) {
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        }
        else {
            e.dataSeries.visible = true;
        }
        chart.render();
    }
    
    }
    </script>