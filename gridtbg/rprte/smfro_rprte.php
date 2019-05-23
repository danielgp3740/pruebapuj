<?php

class SmfroMP{

    function semaforomp(){
      $semaforo_mp = $reportes_sql->valor_totalsemaforo($cnxn_pag, $mpr_codigo, $vigencia_actual, $codigoentidad);
      $datavalor_semaforo= $cnxn_pag->obtener_filas($semaforo_mp);
      $valor_ejecutado=$datavalor_semaforo['valor_ejecutado'];
      //$valor_esperado=$datavalor_semaforo['ves_valor'];

      if(isset($datavalor_semaforo['valor_ejecutado'])){
        $valor_ejecutado=abs($datavalor_semaforo['valor_ejecutado']);
      }
      else{
        $valor_ejecutado=0;
      }

      $valor_esperado=$valor_esperadomepro[1];




      if($valor_ejecutado==0 && $valor_esperado!=0){
          $valorpromedio_semaforo=0.00;
          $signoPorciento='%';
          $letro_logro="";
      }

      elseif($valor_ejecutado!=0 && $valor_esperado==0){
            $valorpromedio_semaforo=number_format(($valor_ejecutado/$mpr_valorcuatrenio)*100 , 2, '.', '');
            $signoPorciento='%';
            $letro_logro="MP Cuatrenio";
      }
      elseif($valor_ejecutado==0 && $valor_esperado==0){
            $valorpromedio_semaforo=0.00;
            $signoPorciento='%';
            $letro_logro="";
      }
      elseif($valor_ejecutado!=0 && $valor_esperado!=0){
          $valorpromedio_semaforo=number_format(($valor_ejecutado/$valor_esperado)*100 , 2, '.', '');
          $signoPorciento='%';
          $letro_logro="";
      }



          if($valor_esperado == 0 && $valor_ejecutado==0){
            $circulo_semaforo='<li class="brillo"><dfn data-info="No se planeó/No se ejecutó"><span class="gray"></span></li>';
            $numero_gris=$numero_gris+1;

          }
          elseif($valor_esperado == 0 && $valor_ejecutado != 0){
            $circulo_semaforo='<li class="brillo"><dfn data-info="Ejecutada sin planeación"><span class="blue"></span></li>';
            $numero_azul=$numero_azul+1;
          }
          else{
              if($valorpromedio_semaforo >= 0 && $valorpromedio_semaforo <= 40){
                    $circulo_semaforo='<li class="brillo"><dfn data-info="Crítico | < 40%"><span class="red"></span></li>';
                    $numero_rojo=$numero_rojo+1;
              }
              elseif($valorpromedio_semaforo > 40 && $valorpromedio_semaforo <= 60){
                     $circulo_semaforo='<li class="brillo"><dfn data-info="Bajo | >=40% y <60%"><span class="orange"></span></li>';
                    $numero_naranja=$numero_naranja+1;
              }
              elseif($valorpromedio_semaforo > 60 && $valorpromedio_semaforo <= 80){
                    $circulo_semaforo='<li class="brillo"><dfn data-info="Medio | >=60% y <80%"><span class="yellow"></span></li>';
                    $numero_amarillo=$numero_amarillo+1;
              }
              elseif($valorpromedio_semaforo > 80 && $valorpromedio_semaforo <= 100 ){
                   $circulo_semaforo='<li class="brillo"> <dfn data-info="Cumplido | >=80% y <=100%"><span class="green"></span></li>';
                   $numero_verde=$numero_verde+1;
              }
              elseif($valorpromedio_semaforo > 100){
                   $circulo_semaforo='<li class="brillo"><dfn data-info="Superó meta cuatrenio"><span class="viol"></span></li>';
                   $numero_violeta=$numero_violeta+1;

              }

          }

          return $valorpromedio_semaforo;

    }


}
//$vigencia_actual='2016';





?>
