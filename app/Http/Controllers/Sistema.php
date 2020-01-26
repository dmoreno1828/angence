<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Usuario;
Use App\Models\Osusuario;
Use App\Models\Factura;
use Carbon\Carbon;

class Sistema extends Controller
{

    public function index(){
        $consultores=$this->consultausuario();
        return view('index')
            ->with('consultores',$consultores);

   }

   public function datos(Request $request){
        $consultores=$this->consultausuario();
        $input=$request->all();
         $arrayconsultores=$request->consultores;
         
        $os=Osusuario::where(function ($query) use($arrayconsultores){
            for($a=0;$a<count($arrayconsultores);$a++){
                $query->orwhere('cao_os.co_usuario', 'like', "%".$arrayconsultores[$a]."%");
            }
        }) ->join('cao_sistema', function ($join) {
            $join->on('cao_os.co_usuario', '=', 'cao_sistema.co_usuario')
            ->On('cao_os.co_sistema', '=', 'cao_sistema.co_sistema');
        })
        
        ->select(
            'cao_sistema.co_cliente as codigo_cliente',
            'cao_sistema.co_usuario as nombre_usuario',
            'cao_sistema.co_sistema as co_sistema',
            'cao_os.co_os as co_os'
            )
        ->get();  
        $inicio= Carbon::createFromFormat('d/m/Y',$request->inicio);
        $final=Carbon::createFromFormat('d/m/Y',$request->final);
         
        $cantidadmes = $final->DiffInMonths($inicio)+1;
        $meses=[];
 

     
        for($a=1;$a<=$cantidadmes;$a++){
            if($a==1 && $cantidadmes>1){
                $cinicio=$inicio->format('Y-m-d');
                $cfinal=$inicio->format('Y-m').'-31';
            }
            elseif($a==1 && $cantidadmes==1){
                $cinicio=$inicio->format('Y-m-d');
                $cfinal=$final->format('Y-m-d');
            }
            else{
                $inicio=$inicio->addMonth(); 
                $cinicio=$inicio->format('Y-m').'-01';
                $cfinal=$inicio->format('Y-m').'-31'; 
            }
            $montofinal=0;
            foreach($os as $nuevadata){
             
            $factura=Factura::where('data_emissao','>=',$cinicio)
            ->where('data_emissao','<=',$cfinal)
            ->where('co_os','=',$nuevadata->co_os)
            ->where('co_sistema','=',$nuevadata->co_sistema)
            ->where('co_cliente','=',$nuevadata->codigo_cliente)
            //->select(\DB::raw('SUM(valor) as valor'),\DB::raw('valor*total_imp_inc as tvalor'))
            ->get();
               if($factura->count()>0){ 

          
                 $comision=$this->comision($factura);
                 $recita=$this->receta($factura);
                 $ganancia=$recita-$comision;
                $newmess=array('mes'=>$this->meses($inicio->format('m'))."-".$inicio->format('Y'), 'recita'=>$recita, 'comision'=>$comision, 'ganacia'=>$ganancia,'usuario'=>$nuevadata->nombre_usuario);
               
               
            }else{
                $newmess=array('mes'=>$this->meses($inicio->format('m'))."-".$inicio->format('Y'), 'recita'=>0, 'comision'=>0, 'ganacia'=>0,'usuario'=>$nuevadata->nombre_usuario);
            }
            array_push($meses,$newmess);

        }

    }

        return view('index')
           ->with('consultores',$consultores)
           ->with('input',$input)
           ->with('inicio',Carbon::createFromFormat('d/m/Y',$request->inicio)->adddays(1)->format('Y-m-d'))
           ->with('final',Carbon::createFromFormat('d/m/Y',$request->final)->adddays(1)->format('Y-m-d'))

           
           ->with('relatorio',$this->resultados($meses));

  }


  public function barras(Request $request){
    $consultores=$this->consultausuario();
    $input=$request->all();
     $arrayconsultores=$request->consultores;
     
    $os=Osusuario::where(function ($query) use($arrayconsultores){
        for($a=0;$a<count($arrayconsultores);$a++){
            $query->orwhere('cao_os.co_usuario', 'like', "%".$arrayconsultores[$a]."%");
        }
    }) ->join('cao_sistema', function ($join) {
        $join->on('cao_os.co_usuario', '=', 'cao_sistema.co_usuario')
        ->On('cao_os.co_sistema', '=', 'cao_sistema.co_sistema');
    })
    


    ->select(
        'cao_sistema.co_cliente as codigo_cliente',
        'cao_sistema.co_usuario as nombre_usuario',
        'cao_sistema.co_sistema as co_sistema',
        'cao_os.co_os as co_os'
        )
    ->get();  
    $inicio= Carbon::createFromFormat('d/m/Y',$request->inicio);
    $final=Carbon::createFromFormat('d/m/Y',$request->final);
     
    $cantidadmes = $final->DiffInMonths($inicio)+1;
    $meses=[];


 
    for($a=1;$a<=$cantidadmes;$a++){
        if($a==1 && $cantidadmes>1){
            $cinicio=$inicio->format('Y-m-d');
            $cfinal=$inicio->format('Y-m').'-31';
        }
        elseif($a==1 && $cantidadmes==1){
            $cinicio=$inicio->format('Y-m-d');
            $cfinal=$final->format('Y-m-d');
        }
        else{
            $inicio=$inicio->addMonth(); 
            $cinicio=$inicio->format('Y-m').'-01';
            $cfinal=$inicio->format('Y-m').'-31'; 
        }
        $montofinal=0;
        foreach($os as $nuevadata){
         
        $factura=Factura::where('data_emissao','>=',$cinicio)
        ->where('data_emissao','<=',$cfinal)
        ->where('co_os','=',$nuevadata->co_os)
        ->where('co_sistema','=',$nuevadata->co_sistema)
        ->where('co_cliente','=',$nuevadata->codigo_cliente)
        //->select(\DB::raw('SUM(valor) as valor'),\DB::raw('valor*total_imp_inc as tvalor'))
        ->get();
           if($factura->count()>0){ 
             $comision=$this->comision($factura);
             $recita=$this->receta($factura);
             $ganancia=$recita-$comision;
            $newmess=array('mes'=>$this->meses($inicio->format('m'))."-".$inicio->format('Y'), 'recita'=>$recita, 'comision'=>$comision, 'ganacia'=>$ganancia,'usuario'=>$nuevadata->nombre_usuario);
        } else{
            $newmess=array('mes'=>$this->meses($inicio->format('m'))."-".$inicio->format('Y'), 'recita'=>0, 'comision'=>0, 'ganacia'=>0,'usuario'=>$nuevadata->nombre_usuario);
        }
        array_push($meses,$newmess);

    }

}
    $costofixofinal=$this->costofixomedio($arrayconsultores);

    return view('index')
       ->with('consultores',$consultores)
       ->with('input',$input)
       ->with('inicio',Carbon::createFromFormat('d/m/Y',$request->inicio)->adddays(1)->format('Y-m-d'))
       ->with('final',Carbon::createFromFormat('d/m/Y',$request->final)->adddays(1)->format('Y-m-d'))
      ->with("costofixofinal",$costofixofinal)
       ->with('relatorio',$this->resultados($meses));

}


public function tortas(Request $request){
    $consultores=$this->consultausuario();
    $input=$request->all();
     $arrayconsultores=$request->consultores;
     
    $os=Osusuario::where(function ($query) use($arrayconsultores){
        for($a=0;$a<count($arrayconsultores);$a++){
            $query->orwhere('cao_os.co_usuario', 'like', "%".$arrayconsultores[$a]."%");
        }
    }) ->join('cao_sistema', function ($join) {
        $join->on('cao_os.co_usuario', '=', 'cao_sistema.co_usuario')
        ->On('cao_os.co_sistema', '=', 'cao_sistema.co_sistema');
    })
    


    ->select(
        'cao_sistema.co_cliente as codigo_cliente',
        'cao_sistema.co_usuario as nombre_usuario',
        'cao_sistema.co_sistema as co_sistema',
        'cao_os.co_os as co_os'
        )
    ->get();  
    $inicio= Carbon::createFromFormat('d/m/Y',$request->inicio);
    $final=Carbon::createFromFormat('d/m/Y',$request->final);
     
    $cantidadmes = $final->DiffInMonths($inicio)+1;
    $meses=[];


 
    for($a=1;$a<=$cantidadmes;$a++){
        if($a==1 && $cantidadmes>1){
            $cinicio=$inicio->format('Y-m-d');
            $cfinal=$inicio->format('Y-m').'-31';
        }
        elseif($a==1 && $cantidadmes==1){
            $cinicio=$inicio->format('Y-m-d');
            $cfinal=$final->format('Y-m-d');
        }
        else{
            $inicio=$inicio->addMonth(); 
            $cinicio=$inicio->format('Y-m').'-01';
            $cfinal=$inicio->format('Y-m').'-31'; 
        }
        $montofinal=0;
        foreach($os as $nuevadata){
         
        $factura=Factura::where('data_emissao','>=',$cinicio)
        ->where('data_emissao','<=',$cfinal)
        ->where('co_os','=',$nuevadata->co_os)
        ->where('co_sistema','=',$nuevadata->co_sistema)
        ->where('co_cliente','=',$nuevadata->codigo_cliente)
        //->select(\DB::raw('SUM(valor) as valor'),\DB::raw('valor*total_imp_inc as tvalor'))
        ->get();
           if($factura->count()>0){ 
             $comision=$this->comision($factura);
             $recita=$this->receta($factura);
             $ganancia=$recita-$comision;
            $newmess=array('mes'=>$this->meses($inicio->format('m'))."-".$inicio->format('Y'), 'recita'=>$recita, 'comision'=>$comision, 'ganacia'=>$ganancia,'usuario'=>$nuevadata->nombre_usuario);
        } else{
            $newmess=array('mes'=>$this->meses($inicio->format('m'))."-".$inicio->format('Y'), 'recita'=>0, 'comision'=>0, 'ganacia'=>0,'usuario'=>$nuevadata->nombre_usuario);
        }
        array_push($meses,$newmess);

    }

}
    $costototal=$this->costototal($meses);

    return view('index')
       ->with('consultores',$consultores)
       ->with('input',$input)
       ->with('inicio',Carbon::createFromFormat('d/m/Y',$request->inicio)->adddays(1)->format('Y-m-d'))
       ->with('final',Carbon::createFromFormat('d/m/Y',$request->final)->adddays(1)->format('Y-m-d'))
      ->with("costototal",$costototal);

}




  private function consultausuario()
  {
      return  
      $consultores=Usuario::join("permissao_sistema","cao_usuario.co_usuario","=","permissao_sistema.co_usuario")
          ->whereIn('permissao_sistema.co_tipo_usuario',[0,1,2])
          ->where('permissao_sistema.in_ativo','=','s')
          ->where('permissao_sistema.co_sistema','=','1')
          ->select(
                      'cao_usuario.co_usuario as identificacion',
                      'cao_usuario.no_usuario as nombre'
                      )
              ->get();
  }

  private function meses($mes){
        switch($mes){
            case '01': return "Enero"; break;
            case '02': return "Febrero"; break;
            case '03': return "Marzo"; break;
            case '04': return "Abril"; break;
            case '05': return "Mayo"; break;
            case '06': return "Junio"; break;
            case '07': return "Julio"; break;
            case '08': return "Agosto"; break;
            case '09': return "Septiembre"; break;
            case '10': return "Octubre"; break;
            case '11': return "Noviembre"; break;
            case '12': return "Diciembre"; break;
        }
  }

  private function receta($objetoresult){
        $total=0;
        foreach($objetoresult as $valores){
            $neto=$valores->valor;
            $porcentaje=($valores->total_imp_inc/100);
            $result=$neto - ($neto*$porcentaje);	
            $total=$total+$result;
        }
        return $total;

  }

  private function comision($objetoresult){
    $total=0;
    foreach($objetoresult as $valores){
        $neto=$valores->valor;
        $importe=($valores->total_imp_inc/100);
        $comision=($valores->comissao_cn/100);
        $result= ( $neto - ($neto*$importe) ) * $comision;	
        $total=$total+$result;
    }
    return $total;

}

    private function resultados($original){

        $result = array();
        foreach($original as $t) {
            $repeat=false;
            for($i=0;$i<count($result);$i++)
            {
                if($result[$i]['mes']==$t['mes'] && $result[$i]['usuario']==$t['usuario'])
                {
                    $result[$i]['recita']+=$t['recita'];
                    $result[$i]['comision']+=$t['comision'];
                    $result[$i]['ganacia']+=$t['ganacia'];
                    $repeat=true;
                    break;
                }
            }
            if($repeat==false)
                $result[] = array('mes' => $t['mes'], 'usuario' => $t['usuario'],'recita' => $t['recita'], 'comision' => $t['comision'], 'ganacia' => $t['ganacia']);
        }

        return $result;
    }


    private function costototal($original){
 
        $result = array();
        foreach($original as $t) {
            $repeat=false;
            for($i=0;$i<count($result);$i++)
            {
                if($result[$i]['usuario']==$t['usuario'])
                {
                    $result[$i]['recita']+=$t['recita'];
                    $repeat=true;
                    break;
                }
            }
            if($repeat==false)
                $result[] = array( 'usuario' => $t['usuario'],'recita' => $t['recita']);
        }

        return $result;
    }
 
    private function costofixomedio($arrayconsultores){
        $monto=0;
        for($a=0;$a<count($arrayconsultores);$a++){
        
        $datos=Usuario::where('co_usuario',$arrayconsultores[$a])->first();
            $monto=$monto+@$datos->salario->brut_salario;
        }
        $total=$monto/count($arrayconsultores);
        return $total;
    }
}
