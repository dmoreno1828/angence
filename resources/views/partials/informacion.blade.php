
<div class="row" id="informacion">
    <div class="col-lg-12">
        <div class="card">
            <h4 class="card-header mt-0">Relatorio por Consultor</h4>
            <div class="card-body">
                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0 b-0" data-pattern="priority-columns">
                      
@for($a=0;$a<count($input['consultores']); $a++)

                <table  id="tech-companies-1" class="table table-striped">
                    <thead>
                        <tr style="background-color: #fefe">
                            @php
                          
                            $datos=App\Models\Usuario::where('co_usuario',$input['consultores'][$a])->first();
                            
                            @endphp
                            <th colspan="5">{{$datos->no_usuario}} </th>
                        </tr>
                        <tr>
                            <th>Periodo</th>
                            <th>Receita Líquida</th>
                            <th>Custo Fixo</th>
                            <th>Comissão</th>
                            <th>Lucro</th>
                        </tr>
                    </thead>
                    <tbody>
                    @for($x=0;$x<count($relatorio);$x++)
           
                    @if($input['consultores'][$a]==$relatorio[$x]['usuario'])

                        <tr>
                            <td>{{$relatorio[$x]['mes']}}</td>
                            <td>R$ {{number_format($relatorio[$x]['recita'],2,',','.')}}</td>
                            <td>R$ {{number_format(@$datos->salario->brut_salario,2,',','.')}}</td>
                            <td>R$ {{number_format($relatorio[$x]['comision'],2,',','.')}}</td>
                            <td>R$ {{number_format($relatorio[$x]['ganacia'],2,',','.')}}</td>
                        </tr>
                        @endif

                     
                        @endfor
                    </tbody>
                </table>
@endfor 
                </div>
            </div>
            </div>
        </div>
    </div>
</div>