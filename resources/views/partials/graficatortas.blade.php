
<script>
    window.onload = function() {
    
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "Ganancias netas"
        },
        data: [{
            type: "pie",
            startAngle: 240, 
         
            	indexLabel: "{label} - #percent%",
		   toolTipContent: "<b>{label}:</b> {y} (#percent%)",
            dataPoints: [
                @for($a=0;$a<count($input['consultores']); $a++)  
                @php
                $datos=App\Models\Usuario::where('co_usuario',$input['consultores'][$a])->first();
                @endphp   
                @for($x=0;$x<count($costototal);$x++)
                @if($input['consultores'][$a]==$costototal[$x]['usuario'])
                {y: {{number_format($costototal[$x]['recita'],2,'.','')}} , label: "{{$datos->no_usuario}}"},
                @endif
                @endfor
                @endfor
            ]
        }]
    });
    chart.render();
    
    }
    </script>