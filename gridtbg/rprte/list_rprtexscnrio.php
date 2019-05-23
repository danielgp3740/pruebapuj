<?php

include('brrsmfro.php');
$barrassemaro=new BarrasSemaforo();

if($_REQUEST['codigo_sectroAdmin']){
  $codigo_escenarioadmin=$_REQUEST['codigo_sectroAdmin'];

  $espacio_capa="40";
}
else{
  $codigo_escenarioadmin=$eac_codigo;
   $espacio_capa="64";
}

$codigoentidad=$_SESSION['entidad_persona'];


$reporte_escenarioadmin = $reportes_sql->metaproducto_escenario($cnxn_pag, $codigo_metapro, $codigo_escenarioadmin, $codigoentidad, $codigo_programatbg);


//echo $codigoentidad;
  //echo "Entro a ver listado: ".$codigo_escenarioadmin;


?>
<div class="box">
<!--
      <div class="busca">
            <input id="Text1" class="txtSearch" type="text" onkeyup="CheckSearchText(this)" />
            <input id="Button1" type="button" onclick="FixedSearchTest(this)" value="Buscar" />
     </div>



-->
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

<div class="page-container">

<div class="box-tabla">
<div class="tbl-header">
<table class="tablaFijaCss">
 <thead>
    <tr>
      <th class="wd-3">&nbsp;&nbsp;Nro. </th>
      <th class="wd-15">&nbsp;&nbsp;Entidad </th>
      <th class="wd-20">&nbsp;MP&nbsp;</th>
      <th class="wd-5">&nbsp;LB&nbsp;</th>
      <th class="wd-5">&nbsp;MC&nbsp;</th>
      <th class="wd-15">&nbsp;V 2016&nbsp; <a href='excelreportexescenario?<?php echo $codigo_escenarioadmin."-2016"; ?>'><img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel"> </a></th>
      <th class="wd-15">&nbsp;V 2017&nbsp;<a href='excelreportexescenario?<?php echo $codigo_escenarioadmin."-2017"; ?>'><img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel"> </a></th>
      <th class="wd-15">&nbsp;V 2018&nbsp;<a href='excelreportexescenario?<?php echo $codigo_escenarioadmin."-2018"; ?>'><img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel"> </a></th>
      <!-- <th>&nbsp;V 2018&nbsp;</th>
      <th>&nbsp;V 2019&nbsp;</th> -->
      <th class="wd-15">&nbsp;Acu&nbsp;</th>
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
      $mpr_tendenciapositiva=$data_listampxescenario['mpr_tendenciapositiva'];
      $mre_descripcion=$data_listampxescenario['mre_descripcion'];
      $eac_nombre=$data_listampxescenario['eac_nombre'];
      $pro_nombre=$data_listampxescenario['pro_nombre'];


      $valor_esperadomp = $principal_sql->valor_esperado($cnxn_pag, $mpr_codigo);


      $valorultimo_esperado=$principal_sql->valor_esperadoultimo($cnxn_pag, $mpr_codigo);
      $data_valorultimoesperado=$cnxn_pag->obtener_filas($valorultimo_esperado);
      $ultimovaloresperado=$data_valorultimoesperado['ves_valor'];


  // INICIO MOSTAR TODOS LOS VALORES DE LA VIGENCIAS POR META DE PRODUCTO

  $valor_allesperadomp = $principal_sql->valor_esperadoall($cnxn_pag, $mpr_codigo);


  $todas_vigencias="";
    $numerovigenciaesperado=1;
    while($data_allvaloresperadomp=$cnxn_pag->obtener_filas($valor_allesperadomp)){
        $ves_vigencia=$data_allvaloresperadomp['ves_vigencia'];
        $ves_valorall[$ves_vigencia]=$data_allvaloresperadomp['ves_valor'];
        $todas_vigencias.=$ves_valorall[$ves_vigencia]." ";
        $valorporvigencia[$ves_vigencia]=$data_allvaloresperadomp['ves_valor'];
        $valorvigenciaesperado[$numerovigenciaesperado]=$data_allvaloresperadomp['ves_valor'];
        $numerovigenciaesperado++;
    }

  // FIN MOSTAR TODOS LOS VALORES DE LA VIGENCIAS POR META DE PRODUCTO

  $baselinea=$mpr_lineabase;
  $valorcuatro=$mpr_valorcuatrenio;

  $totalesperadometa=abs($mpr_valorcuatrenio-$mpr_lineabase);

  $diferencia_valores=abs($mpr_lineabase-$mpr_valorcuatrenio);
  $vigencia_sumatoria=$valorporvigencia[2016]+$valorporvigencia[2017]+$valorporvigencia[2018]+$valorporvigencia[2019];

        // *************** INICIO TIPO DE ORIENTACION ********************* //
        // 1. MANTENIMIENTO
        if($mpr_lineabase==$mpr_valorcuatrenio && $mpr_valorcuatrenio==$valorvigenciaesperado[4]){
              $tipometaproducto='Ma';
              $tipometaresul='M';
              $tipoorientacion='LBMV4';//MetaCuatrenio=LineaBase=vigencia4

              if($mpr_tendenciapositiva=='1'){
                $tipometaproducto='Au';
                $tipometaresul='A';
              }
              elseif($mpr_tendenciapositiva=='2'){
                $tipometaproducto='Re';
                $tipometaresul='R';
              }
        }
        elseif($mpr_valorcuatrenio==$valorvigenciaesperado[1] && $mpr_valorcuatrenio==$valorvigenciaesperado[2] && $mpr_valorcuatrenio==$valorvigenciaesperado[3] && $mpr_valorcuatrenio==$valorvigenciaesperado[4]){
              $tipometaproducto='Ma';
              $tipometaresul='M';
              $tipoorientacion='MV1V2V3V4';//MetaCuatreni=vigencia1=vigencia2=vigencia3=vigencia4

              if($mpr_tendenciapositiva=='1'){
                $tipometaproducto='Au';
                $tipometaresul='A';
              }
              elseif($mpr_tendenciapositiva=='2'){
                $tipometaproducto='Re';
                $tipometaresul='R';
              }
        }
        elseif ($mpr_lineabase==$mpr_valorcuatrenio && $mpr_valorcuatrenio==$vigencia_sumatoria) {
              $tipometaproducto='Ma';
              $tipometaresul='M';
              $tipoorientacion='LMS';//lineaBase=MetaCuatrenio=sumavigencias

              if($mpr_tendenciapositiva=='1'){
                $tipometaproducto='Au';
                $tipometaresul='A';
              }
              elseif($mpr_tendenciapositiva=='2'){
                $tipometaproducto='Re';
                $tipometaresul='R';
              }

        }
        // 2. INCREMENTO
        elseif($mpr_lineabase < $mpr_valorcuatrenio ){
            if($mpr_valorcuatrenio!=$valorvigenciaesperado[1] && $mpr_valorcuatrenio!=$valorvigenciaesperado[2] && $mpr_valorcuatrenio!=$valorvigenciaesperado[3] && $mpr_valorcuatrenio!=$valorvigenciaesperado[4]){
              $imgtipo="incremento.png";
              $tipometa='Aumenta';
              $orientacion='A';
              $tipometaproducto='Au';
              $tipoorientacion='MCDIFERENTE';
            }
            elseif($mpr_valorcuatrenio==$valorvigenciaesperado[4]){
              $imgtipo="incremento.png";
              $tipometa='Aumenta';
              $orientacion='A';
              $tipometaproducto='Au';
              $tipoorientacion='MCV4';
            }
            elseif($mpr_valorcuatrenio==$vigencia_sumatoria){
              $imgtipo="incremento.png";
              $tipometa='Aumenta';
              $orientacion='A';
              $tipometaproducto='Au';
              $tipoorientacion='MCSUMATORIA';
            }
            elseif($diferencia_valores==$vigencia_sumatoria){
              $imgtipo="incremento.png";
              $tipometa='Aumenta';
              $orientacion='A';
              $tipometaproducto='Au';
              $tipoorientacion='DIFERENCIASUMATORIA';
            }
            elseif($diferencia_valores==$valorvigenciaesperado[4]){
              $imgtipo="incremento.png";
              $tipometa='Aumenta';
              $orientacion='A';
              $tipometaproducto='Au';
              $tipoorientacion='DIFERENCIAV4';
            }
            else{
              $imgtipo="incremento.png";
              $tipometa='Aumenta';
              $orientacion='A';
              $tipometaproducto='Au';
              $tipoorientacion='LBMCINCREMENTO';
            }
        }
        // 3. REDUCCION
        elseif($mpr_lineabase > $mpr_valorcuatrenio ){
            if($mpr_valorcuatrenio!=$valorvigenciaesperado[1] && $mpr_valorcuatrenio!=$valorvigenciaesperado[2] && $mpr_valorcuatrenio!=$valorvigenciaesperado[3] && $mpr_valorcuatrenio!=$valorvigenciaesperado[4]){
              $imgtipo="diminuye.png";
              $tipometa='Reducción';
              $orientacion='R';
              $tipometaproducto='Re';
              $tipoorientacion='LBDIFERENTE';
            }
            elseif($mpr_valorcuatrenio==$valorvigenciaesperado[4]){
              $imgtipo="diminuye.png";
              $tipometa='Reducción';
              $orientacion='R';
              $tipometaproducto='Re';
              $tipoorientacion='LBV4';
            }
            elseif($mpr_valorcuatrenio==$vigencia_sumatoria){
              $imgtipo="diminuye.png";
              $tipometa='Reducción';
              $orientacion='R';
              $tipometaproducto='Re';
              $tipoorientacion='LBSUMATORIA';
            }
            elseif($diferencia_valores==$vigencia_sumatoria){
              $imgtipo="diminuye.png";
              $tipometa='Reducción';
              $orientacion='R';
              $tipometaproducto='Re';
              $tipoorientacion='LBDIFERENCIAVIGENCIA';
            }
            elseif($diferencia_valores==$valorvigenciaesperado[4]){
              $imgtipo="diminuye.png";
              $tipometa='Reducción';
              $orientacion='R';
              $tipometaproducto='Re';
              $tipoorientacion='LBDIFERENCIAV4';
            }
            else{
              $imgtipo="diminuye.png";
              $tipometa='Reducción';
              $orientacion='R';
              $tipometaproducto='Re';
              $tipoorientacion='LBMCDISMINUYE';
            }
        }


          // *************** FIN TIPO DE ORIENTACION ********************* //


      if($mpr_codigo=='20161113060927475' || $mpr_codigo=='20161129060927502'){
          $tipometaproducto='Re';
          $tipometaresul='R';
      }

      if($mpr_codigo=='2016111306092518'){
        $orientacion='A';
        $tipometaproducto='Au';

      }
  /*
  Hacienda 20161113060927475 40.5 - 80
          20161129060927502 7.25 - 40
  20161113060927476 acumulado es rojo 88.91 - 89
  */

    ?>
      <tr>
        <td class="wd-3" data-label="Nro"><?php echo $numero_eaclista; ?></td>
        <td class="wd-15" data-label="Escenario"><strong><?php echo $ent_nombre ?></strong></td>
        <td class="wd-20" data-label="MP"><?php echo $mpr_descripcion; ?></td>
        <td class="wd-5" data-label="LB"><?php echo $mpr_lineabase; ?></td>
        <td class="wd-5" data-label="MC"><?php echo $mpr_valorcuatrenio; ?></td>

        <?php

        if($mpr_descripcion=='Indicador de endeudamiento "Sostenibilidad", dentro de los límites de viabilidad fiscal' || $mpr_descripcion=='Inidicador de solvencia dentro de los límites de la viabilidad fiscal'){
          $mpr_valorcuatrenio=$baselinea;
        }
        else{
          $mpr_valorcuatrenio=$valorcuatro;
        }

        $vigencia_numero=1;
        $colorvigencia=0;

        $valoracumuladoejecutado=0;
        $valoracumuladoesperado=0;
        $valoracumuladovigencias=0;

          while($data_valoresperado=$cnxn_pag->obtener_filas($valor_esperadomp)){
            $ves_codigo=$data_valoresperado['ves_codigo'];
            $ves_metaproducto=$data_valoresperado['ves_metaproducto'];
            $ves_tipovalor=$data_valoresperado['ves_tipovalor'];
            $ves_valor=$data_valoresperado['ves_valor'];
            $ves_vigencia=$data_valoresperado['ves_vigencia'];

            //$acumulado_ejecutadomp = $principal_sql->valor_ejecutadovigenciamp($cnxn_pag, $mpr_codigo, $ves_vigencia);
            if($ent_codigo==12){
              $acumulado_ejecutadomp = $principal_sql->valor_ejecutadovigenciampsalud($cnxn_pag, $mpr_codigo, $ves_vigencia);
            }
            else{
              $acumulado_ejecutadomp = $principal_sql->valor_ejecutadovigenciamp($cnxn_pag, $mpr_codigo, $ves_vigencia);
            }


            $datavalor_ejecutadomp= $cnxn_pag->obtener_filas($acumulado_ejecutadomp);
            $valorejecutadomp=$datavalor_ejecutadomp['total_vigenciamp'];

            if($datavalor_ejecutadomp['total_vigenciamp']){
              $valorejecutadomp=$datavalor_ejecutadomp['total_vigenciamp'];
            }
            else{
              $valorejecutadomp=0;
            }

            $valor_esperadomepro[$vigencia_numero]=$ves_valor;
            $valor_esperado=$valor_esperadomepro[1];
            //$color_semaforomp = $semaforomepro->semaforomp($cnxn_pag, $ves_vigencia, $codigoentidad, $ves_metaproducto, $valor_esperado);
            list($valorpromedio_semaforo, $letro_logro, $colorcirculo_semaforo, $colorvigencia, $entrovalore)=$semaforomepro->semaforomp($cnxn_pag, $ves_vigencia, $codigoentidad, $ves_metaproducto, $ves_valor,$mpr_valorcuatrenio, $mpr_tendenciapositiva, $mpr_lineabase, $tipometaproducto);


            if($colorvigencia=='rojo'.$ves_vigencia){
                $numerorojo[$ves_vigencia]=$numerorojo[$ves_vigencia]+1;
            }
            elseif($colorvigencia=='naranja'.$ves_vigencia){
                $numeronaranja[$ves_vigencia]=$numeronaranja[$ves_vigencia]+1;
            }
            elseif($colorvigencia=='amarillo'.$ves_vigencia){
                $numeroamarillo[$ves_vigencia]=$numeroamarillo[$ves_vigencia]+1;
            }
            elseif($colorvigencia=='verde'.$ves_vigencia){
                $numeroverde[$ves_vigencia]=$numeroverde[$ves_vigencia]+1;
            }
            elseif($colorvigencia=='violeta'.$ves_vigencia){
                $numerovioleta[$ves_vigencia]=$numerovioleta[$ves_vigencia]+1;
            }
            elseif($colorvigencia=='azul'.$ves_vigencia){
                $numeroazul[$ves_vigencia]=$numeroazul[$ves_vigencia]+1;
            }
            elseif($colorvigencia=='gris'.$ves_vigencia){
                $numerogris[$ves_vigencia]=$numerogris[$ves_vigencia]+1;
            }



            if($ves_valor==$mpr_valorcuatrenio){
              $valoracumuladoesperado=$ves_valor;
              $valoracumuladoejecutado=$valorejecutadomp;
            }
            else {
              $valoracumuladoesperado=$valoracumuladoesperado+$ves_valor;
              $valoracumuladoejecutado=$valoracumuladoejecutado+$valorejecutadomp;
            }

            $valoracumuladovigencias=$valoracumuladovigencias+$valorejecutadomp;
            
            if($mpr_descripcion=='Magnitud de la inversión Pública/Gasto Total' || $mpr_descripcion=='Porcentaje de Evaluación MECI'){
              if ($mpr_lineabase > $valorejecutadomp) {
                $colorcirculo_semaforo="red";
                $valorpromedio_semaforo=abs($valorpromedio_semaforo);
              }
              else {
                $colorcirculo_semaforo="green";
                $valorpromedio_semaforo=abs($valorpromedio_semaforo);
              }

            }


            if($mpr_descripcion=="Transferencias Nacionales+SGR/Gasto Total" && $colorcirculo_semaforo=="green"){
              $valorpromedio_semaforo=($valorpromedio_semaforo+100);
              //$positivosigno="+";
            }
            elseif($mpr_descripcion=="Transferencias Nacionales+SGR/Gasto Total" && $colorcirculo_semaforo=="red"){
              $valorpromedio_semaforo=($valorpromedio_semaforo+100);
            }


            if($mpr_descripcion=='Asistencia funeraria para la población víctima, en apoyo a municipios'){
              if($valorejecutadomp < $mpr_lineabase){
                $colorcirculo_semaforo="green";
              }
            }

        ?>
            <td class="tdEspe wd-15" data-label="V<?php echo $ves_vigencia; ?>">
              <span class="colEspe">Esperado:</span><span><?php echo $ves_valor; ?></span><span class="colEspe">Ejecutado:</span><span><?php echo $valorejecutadomp; ?></span>
              <a class="brillo"><span class="<?php echo $colorcirculo_semaforo; ?>"><p><?php echo $valorpromedio_semaforo; ?>% <p></span> </a>
            </td>


        <?php

           $vigencia_numero++;
          }

          $positivosigno="";
          // Inicio Operacion de acumulados
          switch ($tipoorientacion) {
            // INICIO MATENIMIENTO
            case 'LBMV4':
                $totalesperadometa=$valorvigenciaesperado[4];
                $valoracumuladoejecutado=$valorejecutadomp;

                if($mpr_valorcuatrenio==0 && $valoracumuladoejecutado==0){
                  $cumplimientovigencias=100;
                }
                else{
                  if($mpr_tendenciapositiva=='1'){
                    $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
                  }
                  elseif($mpr_tendenciapositiva=='2') {
                    if($valoracumuladoejecutado==0){
                      $cumplimientovigencias=0;
                    }
                    else {
                      $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado)*100 , 2, '.', '');
                    }
                  }
                }

            break;

            case 'MV1V2V3V4':
                $totalesperadometa=$mpr_valorcuatrenio;
                $valoracumuladoejecutado=$valorejecutadomp;
                //$cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
                if($mpr_tendenciapositiva=='1'){
                  $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
                }
                elseif($mpr_tendenciapositiva=='2') {
                  if($valoracumuladoejecutado==0){
                    $cumplimientovigencias=0;
                  }
                  else {
                    $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado)*100 , 2, '.', '');
                  }            }
            break;


            case 'LMS':
                $totalesperadometa=$mpr_valorcuatrenio;
                $valoracumuladoejecutado=$valoracumuladovigencias;
                //$cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
                if($mpr_tendenciapositiva=='1'){
                    $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
                }
                elseif($mpr_tendenciapositiva=='2') {
                  $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado)*100 , 2, '.', '');
                }
            break;
            // FIN MATENIMIENTO

            //INICIO INCREMENTO
            case 'MCDIFERENTE':
                $totalesperadometa=$diferencia_valores;
                $valoracumuladoejecutado=$valoracumuladovigencias;
                if($mpr_codigo=='20161113060927475' || $mpr_codigo=='20161129060927502'){
                    $valoracumuladoejecutado=$valorejecutadomp;
                    $totalesperadometa=$mpr_lineabase;
                    $positivosigno="+";
                }
                else {
                    $positivosigno="";
                }
                $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            break;

            case 'MCV4':
                $totalesperadometa=$valorvigenciaesperado[4];
                $valoracumuladoejecutado=$valorejecutadomp;
                $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            break;

            case 'MCSUMATORIA':
                $totalesperadometa=$vigencia_sumatoria;
                $valoracumuladoejecutado=$valoracumuladovigencias;
                $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            break;

            case 'DIFERENCIASUMATORIA':
                $totalesperadometa=$diferencia_valores;
                $valoracumuladoejecutado=$valoracumuladovigencias;
                $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            break;

            case 'DIFERENCIAV4':
                $totalesperadometa=$valorvigenciaesperado[4];
                $valoracumuladoejecutado=$valoracumuladovigencias;
                $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            break;

            case 'LBMCINCREMENTO':
                $totalesperadometa=$diferencia_valores;
                $valoracumuladoejecutado=$valoracumuladovigencias;
                $vigenciaigual = array_search($mpr_valorcuatrenio, $valorvigenciaesperado); // buscar valor igua en el array

                if($valorvigenciaesperado[$vigenciaigual]==$mpr_valorcuatrenio){
                  $caso=1;
                  $totalesperadometa=$mpr_valorcuatrenio;
                }
                else{
                  $totalesperadometa=$diferencia_valores;
                  $valoracumuladoejecutado=$valoracumuladovigencias;
                }

                $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            break;

            //FIN INCREMENTO

            //INICIO REDUCCION
            case 'LBDIFERENTE':
                $totalesperadometa=$diferencia_valores;
                $valoracumuladoejecutado=$valoracumuladovigencias;
                if($mpr_descripcion=='ESEs con Proyectos elaborados de Infraestructura'){
                  $totalesperadometa=$mpr_valorcuatrenio;
                }
                else{
                  $totalesperadometa=$diferencia_valores;
                }
                $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            break;

            case 'LBV4':
                $totalesperadometa=$valorvigenciaesperado[4];
                $valoracumuladoejecutado=$valorejecutadomp;
                if($valoracumuladoejecutado==0){
                  $cumplimientovigencias=0;
                }
                else{
                  $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado)*100 , 2, '.', '');
                }

                if($cumplimientovigencias>50){
                  $cumplimientovigencias=$cumplimientovigencias-100;
                }
                //$cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            break;

            case 'LBSUMATORIA':
                $totalesperadometa=$vigencia_sumatoria;
                $valoracumuladoejecutado=$valoracumuladovigencias;
                //$cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
                  $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado)*100 , 2, '.', '');
            break;

            case 'LBDIFERENCIAVIGENCIA':
                $totalesperadometa=$diferencia_valores;
                $valoracumuladoejecutado=$valoracumuladovigencias;
                //$cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
                  $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado)*100 , 2, '.', '');
            break;

            case 'LBDIFERENCIAV4':
                $totalesperadometa=$valorvigenciaesperado[4];
                $valoracumuladoejecutado=$valoracumuladovigencias;
                //$cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
                  $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado)*100 , 2, '.', '');
            break;

            case 'LBMCDISMINUYE':
                $totalesperadometa=$diferencia_valores;
                $valoracumuladoejecutado=$valoracumuladovigencias;
                //$cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
                  $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado)*100 , 2, '.', '');
            break;

            //FIN

          }
          // Fin Operacion de acumulados


        if($tipometaproducto=='Re'){
            if($totalesperadometa < $valoracumuladoejecutado  ){
                $colorcirculoacu_semaforo="red";
                $positivosigno="";
            }
            else{
              $colorcirculoacu_semaforo="green";

              if($cumplimientovigencias==0){
                $cumplimientovigencias=100;
              }
              elseif($cumplimientovigencias<100){
                $cumplimientovigencias=$cumplimientovigencias+100;
              }
              elseif($cumplimientovigencias>200){
                $cumplimientovigencias=100;
              }

              if($cumplimientovigencias > 0 && $cumplimientovigencias < 100){
                $positivosigno="+";
              }
              else {
                $positivosigno="";
              }

              //$entreee='verrrr';
            }
        }
        elseif($tipometaproducto=='Au') {
          if($cumplimientovigencias < 0 ){
              $colorcirculoacu_semaforo="red";
          }
          elseif($cumplimientovigencias >= 0 && $cumplimientovigencias <= 40){
                $colorcirculoacu_semaforo="red";
          }
          elseif($cumplimientovigencias > 40 && $cumplimientovigencias <= 60){
                $colorcirculoacu_semaforo="orange";
          }
          elseif($cumplimientovigencias > 60 && $cumplimientovigencias < 80){
                $colorcirculoacu_semaforo="yellow";
          }
          elseif($cumplimientovigencias >= 80 && $cumplimientovigencias <= 100 ){
              $colorcirculoacu_semaforo="green";
          }
          else {
              $colorcirculoacu_semaforo="viol";
          }
        }

        if($mpr_descripcion=='Magnitud de la inversión Pública/Gasto Total'){
          if($mpr_lineabase > $valoracumuladoejecutado){
            $colorcirculoacu_semaforo="red";
            $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado), 2, '.', '');
            $positivosigno="";
          }
          elseif($mpr_lineabase < $valoracumuladoejecutado){
              $colorcirculoacu_semaforo="green";
              $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado), 2, '.', '');
              $cumplimientovigencias=$cumplimientovigencias+100;
              $positivosigno="";
          }


        }

        if($mpr_descripcion=="Transferencias Nacionales+SGR/Gasto Total" && $colorcirculoacu_semaforo=="green"){
          $cumplimientovigencias=($cumplimientovigencias+100)-100;
          //$positivosigno="+";
        }

        if($mpr_descripcion=='Asistencia funeraria para la población víctima, en apoyo a municipios'){
          if($valoracumuladoejecutado < $mpr_lineabase){
            $colorcirculoacu_semaforo="green";
          }
        }

        ?>

        <td class="tdEspe acumulado-v wd-15">

            <!-- <span class="colEspe">Esperado: </span><span>&nbsp;<?php echo $valoracumuladoesperado; ?> </span> -->
            <span class="colEspe">Esperado: <?php //echo $tipoorientacion."|".$vigenciaigual;  ?></span><span> <?php echo $totalesperadometa; ?></span>
            <span class="colEspe">Acumulado: </span><span>&nbsp;<?php echo $valoracumuladoejecutado; ?></span>
            <!-- <span class="colEspe">Cumplimiento: </span> <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $cumplimientovigencias; ?>%</span> -->
            <a class="brillo"><span class="<?php echo $colorcirculoacu_semaforo; ?>"><p><?php echo $positivosigno.abs($cumplimientovigencias); ?>% </p></span> </a>
        </td>
    </tr>

    <?php

      $numero_eaclista++;
      }

    ?>

<tr>
  <td colspan="7" class="m-barra">



      <?php
      for ($yearvigencia=2016; $yearvigencia <= 2017; $yearvigencia++) {
      ?>
        <div class="barras">


          <?php
            $barrassemaro_rojas=$barrassemaro->barrasrojas($numerorojo, $numero_eaclista, $yearvigencia);
            echo $barrassemaro_rojas;
          ?>

          <?php
            $barrassemaro_naranja=$barrassemaro->barrasnaranja($numeronaranja,$numeroamarillo,$numero_eaclista, $yearvigencia);
            echo $barrassemaro_naranja;
          ?>

          <?php
            $barrassemaro_verde=$barrassemaro->barrasverde($numeroverde,$numerovioleta,$numeroazul,$numero_eaclista, $yearvigencia);
            echo $barrassemaro_verde;
          ?>

          <?php
            $barrassemaro_gris=$barrassemaro->barrasgris($numerogris,$numero_eaclista, $yearvigencia);
            echo $barrassemaro_gris;
          ?>
          <div class="estadis">
            <?php
            $porcentaje_rojo=($numerorojo[$yearvigencia]/$numero_eaclista)*100;
            $porcentaje_naranja=($numeronaranja[$yearvigencia]/$numero_eaclista)*100;
            $porcentaje_amarillo=($numeroamarillo[$yearvigencia]/$numero_eaclista)*100;
            $porcentaje_verde=($numeroverde[$yearvigencia]/$numero_eaclista)*100;
            $porcentaje_violeta=($numerovioleta[$yearvigencia]/$numero_eaclista)*100;
            $porcentaje_azul=($numeroazul[$yearvigencia]/$numero_eaclista)*100;
            $porcentaje_gris=($numerogris[$yearvigencia]/$numero_eaclista)*100;

            ?>
            <ul>
              <li><span class="red"></span> <?php echo round($porcentaje_rojo,0)."%=".$numerorojo[$yearvigencia]; ?></li>
              <li><span class="orange"></span> <?php echo round($porcentaje_naranja,0)."%=".$numeronaranja[$yearvigencia]; ?></li>
              <li><span class="yellow"></span> <?php echo round($porcentaje_amarillo,0)."%=".$numeroamarillo[$yearvigencia]; ?></li>
              <li><span class="green"></span> <?php echo round($porcentaje_verde,0)."%=".$numeroverde[$yearvigencia]; ?></li>
              <li><span class="viol"></span> <?php echo round($porcentaje_violeta,0)."%=".$numerovioleta[$yearvigencia]; ?></li>
              <li><span class="blue"></span> <?php echo round($porcentaje_azul,0)."%=".$numeroazul[$yearvigencia]; ?></li>
              <li><span class="gray"></span> <?php echo round($porcentaje_gris,0)."%=".$numerogris[$yearvigencia]; ?></li>
            </ul>

          </div>

        </div>
      <?php
      }

      ?>
    </td>

</tr>



</table>


</div>
</div>
</div>
