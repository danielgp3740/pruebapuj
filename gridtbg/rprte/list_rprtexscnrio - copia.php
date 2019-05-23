<?php


if($_REQUEST['codigo_sectroAdmin']){
  $codigo_escenarioadmin=$_REQUEST['codigo_sectroAdmin'];

  $espacio_capa="40";
}
else{
  $codigo_escenarioadmin=$eac_codigo;
   $espacio_capa="64";
}

$codigoentidad=$_SESSION['entidad_persona'];


$reporte_escenarioadmin = $reportes_sql->metaproducto_escenario($cnxn_pag, $codigo_metapro, $codigo_escenarioadmin, $codigoentidad);


//echo $codigoentidad;
  //echo "Entro a ver listado: ".$codigo_escenarioadmin;


?>
<div class="box">

      <div class="busca">
            <input id="Text1" class="txtSearch" type="text" onkeyup="CheckSearchText(this)" />
            <input id="Button1" type="button" onclick="FixedSearchTest(this)" value="Buscar" />
     </div>

<!--Descargar:

<a href='excelreportexescenario?<?php echo $codigo_escenarioadmin."-2016"; ?>'><img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel"> <strong> 2016</strong></a>
<a href='excelreportexescenario?<?php echo $codigo_escenarioadmin."-2017"; ?>'><img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel"> <strong> 2017</strong></a>

<a href='excelreportexescenario?<?php echo $codigo_escenarioadmin."-2016"; ?>'><img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel"> <strong> 2016</strong></a>
<a href='excelreportexescenario?<?php echo $codigo_escenarioadmin."-2017"; ?>'><img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel"> <strong> 2017</strong></a>
&nbsp;&nbsp;-->
</div>

<script src="js/jquery.fixedtableheader.js" type="text/javascript"> </script>

<script type="text/javascript">
$(function(){
  //$(".tbl1").fixedtableheader();
  $(".tbl1").fixedtableheader({ espacio: <?php echo $espacio_capa ?> });

 /* $(".tbl2").fixedtableheader({ highlightrow: true, headerrowsize: 3 });

  $(".tbl3").fixedtableheader({ highlightrow: true, highlightclass: "highlight2", headerrowsize: 3 });*/
})
</script>

                <div class="box-conv">
                     <table class="conv" id="conv2">
                          <tr >
                            <th colspan="2"> <h4>Convenciones</h4></th>
                          </tr>
                          <tr>
                          <td> Entidad</td>
                          <td> E </td>
                          </tr>
                          <tr>
                          <td> Meta Producto</td>
                          <td> MP </td>
                          </tr>
                          <tr>
                          <td> Meta Cuatrenio </td>
                          <td> MC</td>
                          </tr>
                          <tr>
                          <td> Vigencia</td>
                          <td> V </td>
                          </tr>
                          <tr>
                          <td>Crítico < 40%</td>
                          <td> <a href="#" class ="new-btn dfn-hover"> <span class="red"></span></a> </td>
                          </tr>
                          <tr>
                          <td> Bajo >=40% y < 60% </td>
                          <td> <a href="#" class ="new-btn dfn-hover"> <span class="orange"></span></a> </td>
                          </tr>
                          <tr>
                          <td> Medio | >=60% y < 80% </td>
                          <td> <a href="#" class ="new-btn dfn-hover"> <span class="yellow"></span></a> </td>
                          </tr>
                          <tr>
                          <td> Cumplido | >=80% y <=100% </td>
                          <td> <a href="#" class ="new-btn dfn-hover"> <span class="green"></span></a> </td>
                          </tr>
                           <tr>
                          <td> Superó meta cuatrenio </td>
                          <td> <a href="#" class ="new-btn dfn-hover"> <span class="viol"></span></a> </td>
                          </tr>
                          <tr>
                          <td>No se planeó/No se ejecutó </td>
                          <td> <a href="#" class ="new-btn dfn-hover"> <span class="gray"></span></a> </td>
                          </tr>
                          <tr>
                          <td>Ejecutada sin planeación </td>
                          <td> <a href="#" class ="new-btn dfn-hover"> <span class="blue"></span></a> </td>
                          </tr>
                          <tr>
                          <td>Descargar Excel </td>
                          <td> <img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel"></td>
                          </tr>

                          </table>
                       </div>
<div class="box-tabla">
<div class="tbl-header">
<table class="tablaFijaCss">
 <thead>
    <tr>
      <th>&nbsp;&nbsp;Nro. </th>
      <th width="12%">&nbsp;&nbsp;E  </th>
      <th width="33%">&nbsp;M P&nbsp;</th>
      <th>&nbsp;M C&nbsp;</th>
      <th>&nbsp;V 2016&nbsp;</th>
      <th>&nbsp;V 2017&nbsp;</th>
      <th>&nbsp;V 2018&nbsp;</th>
      <th>&nbsp;V 2019&nbsp;</th>

   </tr>

 </thead>
</table>
</div>
  <div class="tbl-content">
  <table class="tablaFijaCss">

    <?php
      $numero_eaclista=1;

      $numero_gris=0;
      $numero_rojo=0;
      $numero_naranja=0;
      $numero_amarillo=0;
      $numero_verde=0;
      $numero_azul=0;
      $numero_violeta=0;

      while($data_listampxescenario=$cnxn_pag->obtener_filas($reporte_escenarioadmin)){

      $mpr_codigo=$data_listampxescenario['mpr_codigo'];
      $mpr_descripcion=$data_listampxescenario['mpr_descripcion'];
      $mpr_lineabase=$data_listampxescenario['mpr_lineabase'];
      $mpr_valorcuatrenio=$data_listampxescenario['mpr_valorcuatrenio'];
      $mpr_personacreo=$data_listampxescenario['mpr_personacreo'];
      $mpr_personamodifico=$data_listampxescenario['mpr_personamodifico'];
      $mpr_fechacreo=$data_listampxescenario['mpr_fechacreo'];
      $mpr_fechamodifico=$data_listampxescenario['mpr_fechamodifico'];
      $mpr_metaresultado=$data_listampxescenario['mpr_metaresultado'];
      $mpr_codificacion=$data_listampxescenario['mpr_codificacion'];
      $mpr_indicador=$data_listampxescenario['mpr_indicador'];
      $mpr_entidadresponsable=$data_listampxescenario['mpr_entidadresponsable'];
      $mpr_personaresponsable=$data_listampxescenario['mpr_personaresponsable'];
      $mpr_sectornn=$data_listampxescenario['mpr_sectornn'];
      $mpr_odsproducto=$data_listampxescenario['mpr_odsproducto'];
      $mpr_tipovalor=$data_listampxescenario['mpr_tipovalor'];
      $mpr_codificacionmp=$data_listampxescenario['mpr_codificacionmp'];
      $mpr_codificacionmr=$data_listampxescenario['mpr_codificacionmr'];
      $mpr_ponderacion=$data_listampxescenario['mpr_ponderacion'];
      $ent_nombre=$data_listampxescenario['ent_nombre'];

      $valor_esperadomp = $principal_sql->valor_esperado($cnxn_pag, $mpr_codigo);
  

    ?>
      <tr>
        <td><?php echo $numero_eaclista; ?></td>
        <td><strong><?php echo $ent_nombre ?></strong></td>
        <td width="18%" class="text-left"><?php echo $mpr_descripcion; ?></td>
        <td class="text-center"><?php echo $mpr_valorcuatrenio; ?></td>

        <?php

        $vigencia_numero=1;

          while($data_valoresperado=$cnxn_pag->obtener_filas($valor_esperadomp)){
            $ves_codigo=$data_valoresperado['ves_codigo'];
            $ves_metaproducto=$data_valoresperado['ves_metaproducto'];
            $ves_tipovalor=$data_valoresperado['ves_tipovalor'];
            $ves_valor=$data_valoresperado['ves_valor'];
            $ves_vigencia=$data_valoresperado['ves_vigencia'];

            $acumulado_ejecutadomp = $principal_sql->valor_ejecutadovigenciamp($cnxn_pag, $mpr_codigo, $ves_vigencia);


            $datavalor_ejecutadomp= $cnxn_pag->obtener_filas($acumulado_ejecutadomp);
            $valorejecutadomp=$datavalor_ejecutadomp['total_vigenciamp'];

            if($datavalor_ejecutadomp['total_vigenciamp']){
              $valorejecutadomp=$datavalor_ejecutadomp['total_vigenciamp'];
            }
            else{
              $valorejecutadomp=0;
            }

            $valor_esperadomepro[$vigencia_numero]=$ves_valor;





        ?>
            <td width="15%" class="tdEspe">
              <div>
                <span class="colEspe">Esperado:</span><span><?php echo $ves_valor; ?></span>
                <span class="colEspe">Ejecutado:</span><span><?php echo $valorejecutadomp; ?></span>
              </div>
              <div class="drc">
                <a class="brillo"><span class="red"><p><?php echo $valor_semaforomp; ?> 0.558%<p></span></a>
              </div>
            </td>
        <?php
        /*<td><span class="conEspe"><?php echo $ves_valor; ?></span> | <span class="conEjec"><?php echo $valorejecutadomp; ?></span></td>*/
           $vigencia_numero++;
          }


            $vigencia_actual='2016';
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
              /*
              $brillo_rojo="brillo";
              $brillo_naranja="off";
              $brillo_amarillo="off";
              $brillo_verde="off";
              $brillo_gris="off";
              $brillo_azul="off";
              $brillo_violeta="off";
              */
                $numero_gris=$numero_gris+1;

            }
            elseif($valor_esperado == 0 && $valor_ejecutado != 0){
              $circulo_semaforo='<li class="brillo"><dfn data-info="Ejecutada sin planeación"><span class="blue"></span></li>';
              /*
              $brillo_rojo="brillo";
              $brillo_naranja="off";
              $brillo_amarillo="off";
              $brillo_verde="off";
              $brillo_gris="off";
              $brillo_azul="off";
              $brillo_violeta="off";
              */
              $numero_azul=$numero_azul+1;
            }
            else{
                if($valorpromedio_semaforo >= 0 && $valorpromedio_semaforo <= 40){
                      $circulo_semaforo='<li class="brillo"><dfn data-info="Crítico | < 40%"><span class="red"></span></li>';
                      /*
                      $brillo_rojo="brillo";
                      $brillo_naranja="off";
                      $brillo_amarillo="off";
                      $brillo_verde="off";
                      $brillo_gris="off";
                      $brillo_azul="off";
                      $brillo_violeta="off";
                      */
                      $numero_rojo=$numero_rojo+1;
                }
                elseif($valorpromedio_semaforo > 40 && $valorpromedio_semaforo <= 60){
                       $circulo_semaforo='<li class="brillo"><dfn data-info="Bajo | >=40% y <60%"><span class="orange"></span></li>';
                       /*
                      $brillo_rojo="off";
                      $brillo_naranja="brillo";
                      $brillo_amarillo="off";
                      $brillo_verde="off";
                      $brillo_gris="off";
                      $brillo_azul="off";
                      $brillo_violeta="off";
                      */
                      $numero_naranja=$numero_naranja+1;
                }
                elseif($valorpromedio_semaforo > 60 && $valorpromedio_semaforo <= 80){
                      $circulo_semaforo='<li class="brillo"><dfn data-info="Medio | >=60% y <80% "><span class="yellow"></span></li>';
                      /*
                      $brillo_rojo="off";
                      $brillo_naranja="off";
                      $brillo_amarillo="brillo";
                      $brillo_verde="off";
                      $brillo_gris="off";
                      $brillo_azul="off";
                      $brillo_violeta="off"
                      */
                      $numero_amarillo=$numero_amarillo+1;
                }
                elseif($valorpromedio_semaforo > 80 && $valorpromedio_semaforo <= 100 ){
                     $circulo_semaforo='<li class="brillo"><dfn data-info="Cumplido | >=80% y <=100% "><span class="green"></span></li>';
                      /*
                      $brillo_rojo="off";
                      $brillo_naranja="off";
                      $brillo_amarillo="brillo";
                      $brillo_verde="off";
                      $brillo_gris="off";
                      $brillo_azul="off";
                      $brillo_violeta="off"
                      */
                       $numero_verde=$numero_verde+1;
                }
                elseif($valorpromedio_semaforo > 100){
                     $circulo_semaforo='<li class="brillo"><dfn data-info="Superó meta cuatrenio"><span class="viol"></span></li>';
                      /*
                      $brillo_rojo="off";
                      $brillo_naranja="off";
                      $brillo_amarillo="brillo";
                      $brillo_verde="off";
                      $brillo_gris="off";
                      $brillo_azul="off";
                      $brillo_violeta="off"
                      */
                   $numero_violeta=$numero_violeta+1;

                }

            }

        ?>
        <!--
          1. rojo: 0-30
          2. naranja: 31-71
          3. amarillo: 71-99
          4. verde: 100

        -->


    <!--     <td>
          <ul class="traffic  bg-n">
          <?php
            echo $circulo_semaforo;
          ?>

            	 	<li class="<?php echo $brillo_rojo; ?>"><span class="red"></span></li>

            	 	<li class="<?php echo $brillo_naranja; ?>"><span class="orange"></span></li>
            	 	<li class="<?php echo $brillo_amarillo; ?>"><span class="yellow"></span></li>
            	 	<li class="<?php echo $brillo_verde; ?>"><span class="green"></span></li>
                <li class="<?php echo $brillo_violeta; ?>"><span class="viol"></span></li>
            	 	<li class="<?php echo $brillo_gris; ?>"><span class="gray"></span></li>
                <li class="<?php echo $brillo_azul; ?>"><span class="blue"></span></li>

                <li class="valor"><span class="nwind verModal"><?php echo $valorpromedio_semaforo.$signoPorciento; ?> </span> <?php echo $letro_logro; ?> <?php //echo $mpr_codigo." - ".$valor_esperadomepro[1]; ?></li>
      	 </ul>

        </td>
    </tr>-->

    <?php

      $numero_eaclista++;
      }

    ?>
<?php

    $porcentaje_rojo=($numero_rojo/$numero_eaclista)*100;
    $resta_rojo=100-$porcentaje_rojo;

    $porcentaje_naranja=($numero_naranja/$numero_eaclista)*100;
    $resta_naranja=100-$porcentaje_naranja;

    $porcentaje_amarillo=($numero_amarillo/$numero_eaclista)*100;
    $resta_amarillo=100-$porcentaje_amarillo;

    $porcentaje_verde=($numero_verde/$numero_eaclista)*100;
    $resta_verde=100-$porcentaje_verde;

    $porcentaje_violeta=($numero_violeta/$numero_eaclista)*100;
    $resta_violeta=100-$porcentaje_violeta;

    $porcentaje_gris=($numero_gris/$numero_eaclista)*100;
    $resta_gris=100-$porcentaje_gris;

    $porcentaje_azul=($numero_azul/$numero_eaclista)*100;
    $resta_azul=100-$porcentaje_azul;

?>

<tr>
<td colspan="8">
 <div class="barras">
    <div class="colu rojo">
      <h6>2016</h6>
      <div style="height:0%"></div> <!-- EJEMPLO OJO MIRA ANDRES OJO -->
      <div class="color" style="height:100%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_rojo,2); ?>% = <?php echo $numero_rojo; ?></span>
    </div>
    <div class="colu rojo">
      <h6>2017</h6>
      <div style="height:<?php echo $resta_naranja; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_naranja; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_naranja,2); ?>% = <?php echo $numero_naranja; ?></span>
    </div>
    <div class="colu rojo ">
      <h6>2018</h6>
      <div style="height:<?php echo $resta_amarillo; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_amarillo; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_amarillo,2); ?>% = <?php echo $numero_amarillo; ?></span>
    </div>
    <div class="colu rojo">
      <h6>2019</h6>
      <div style="height:<?php echo $resta_verde; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_verde; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_verde,2); ?>% = <?php echo $numero_verde; ?></span>
    </div>

</div>
<!-- ------------ROJO ---------------------->
<div class="barras">
    <div class="colu naranja">
      <h6>2016</h6>
      <div style="height:<?php echo $resta_rojo; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_rojo; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_rojo,2); ?>% = <?php echo $numero_rojo; ?></span>
    </div>
    <div class="colu naranja">
      <h6>2017</h6>
      <div style="height:<?php echo $resta_naranja; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_naranja; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_naranja,2); ?>% = <?php echo $numero_naranja; ?></span>
    </div>
    <div class="colu naranja">
      <h6>2018</h6>
      <div style="height:<?php echo $resta_amarillo; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_amarillo; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_amarillo,2); ?>% = <?php echo $numero_amarillo; ?></span>
    </div>
    <div class="colu naranja">
      <h6>2019</h6>
      <div style="height:<?php echo $resta_verde; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_verde; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_verde,2); ?>% = <?php echo $numero_verde; ?></span>
    </div>

</div>
<!-- ------------ NARANJA ---------------------->
<div class="barras">
    <div class="colu amarillo">
      <h6>2016</h6>
      <div style="height:<?php echo $resta_rojo; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_rojo; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_rojo,2); ?>% = <?php echo $numero_rojo; ?></span>
    </div>
    <div class="colu amarillo">
      <h6>2017</h6>
      <div style="height:<?php echo $resta_naranja; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_naranja; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_naranja,2); ?>% = <?php echo $numero_naranja; ?></span>
    </div>
    <div class="colu amarillo">
      <h6>2018</h6>
      <div style="height:<?php echo $resta_amarillo; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_amarillo; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_amarillo,2); ?>% = <?php echo $numero_amarillo; ?></span>
    </div>
    <div class="colu amarillo">
      <h6>2019</h6>
      <div style="height:<?php echo $resta_verde; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_verde; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_verde,2); ?>% = <?php echo $numero_verde; ?></span>
    </div>

</div>
<!-- ------------AMARILLO ---------------------->
<div class="barras">
    <div class="colu verde">
      <h6>2016</h6>
      <div style="height:<?php echo $resta_rojo; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_rojo; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_rojo,2); ?>% = <?php echo $numero_rojo; ?></span>
    </div>
    <div class="colu verde">
      <h6>2017</h6>
      <div style="height:<?php echo $resta_naranja; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_naranja; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_naranja,2); ?>% = <?php echo $numero_naranja; ?></span>
    </div>
    <div class="colu verde">
      <h6>2018</h6>
      <div style="height:<?php echo $resta_amarillo; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_amarillo; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_amarillo,2); ?>% = <?php echo $numero_amarillo; ?></span>
    </div>
    <div class="colu verde">
      <h6>2019</h6>
      <div style="height:<?php echo $resta_verde; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_verde; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_verde,2); ?>% = <?php echo $numero_verde; ?></span>
    </div>

</div>
<div class="barras">
    <div class="colu violeta">
      <h6>2016</h6>
      <div style="height:<?php echo $resta_rojo; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_rojo; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_rojo,2); ?>% = <?php echo $numero_rojo; ?></span>
    </div>
    <div class="colu violeta">
      <h6>2017</h6>
      <div style="height:<?php echo $resta_naranja; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_naranja; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_naranja,2); ?>% = <?php echo $numero_naranja; ?></span>
    </div>
    <div class="colu violeta">
      <h6>2018</h6>
      <div style="height:<?php echo $resta_amarillo; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_amarillo; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_amarillo,2); ?>% = <?php echo $numero_amarillo; ?></span>
    </div>
    <div class="colu violeta">
      <h6>2019</h6>
      <div style="height:<?php echo $resta_verde; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_verde; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_verde,2); ?>% = <?php echo $numero_verde; ?></span>
    </div>

</div>
<div class="barras">
    <div class="colu gris">
      <h6>2016</h6>
      <div style="height:<?php echo $resta_rojo; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_rojo; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_rojo,2); ?>% = <?php echo $numero_rojo; ?></span>
    </div>
    <div class="colu gris">
      <h6>2017</h6>
      <div style="height:<?php echo $resta_naranja; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_naranja; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_naranja,2); ?>% = <?php echo $numero_naranja; ?></span>
    </div>
    <div class="colu gris">
      <h6>2018</h6>
      <div style="height:<?php echo $resta_amarillo; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_amarillo; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_amarillo,2); ?>% = <?php echo $numero_amarillo; ?></span>
    </div>
    <div class="colu gris">
      <h6>2019</h6>
      <div style="height:<?php echo $resta_verde; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_verde; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_verde,2); ?>% = <?php echo $numero_verde; ?></span>
    </div>

</div>
<div class="barras">

    <div class="colu azul">
      <h6>2016</h6>
      <div style="height:<?php echo $resta_rojo; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_rojo; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_rojo,2); ?>% = <?php echo $numero_rojo; ?></span>
    </div>
    <div class="colu azul">
      <h6>2017</h6>
      <div style="height:<?php echo $resta_naranja; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_naranja; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_naranja,2); ?>% = <?php echo $numero_naranja; ?></span>
    </div>
    <div class="colu azul">
      <h6>2018</h6>
      <div style="height:<?php echo $resta_amarillo; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_amarillo; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_amarillo,2); ?>% = <?php echo $numero_amarillo; ?></span>
    </div>
    <div class="colu azul">
      <h6>2019</h6>
      <div style="height:<?php echo $resta_verde; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_verde; ?>%"></div>
      <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_verde,2); ?>% = <?php echo $numero_verde; ?></span>
    </div>

</div>
</td>

</tr>
</table>
</div>
</div>
