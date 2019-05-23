
<?php

include('brrsmfro.php');
$barrassemaro=new BarrasSemaforo();

if ($_REQUEST['codigo_entidad']) {
  $codigo_entidadtbg=$_REQUEST['codigo_entidad'];
}

if ($_REQUEST['codigo_programa']) {
  $codigo_programatbg=$_REQUEST['codigo_programa'];
}

//$codigo_entidadtbg=$_REQUEST['codigo_entidad'];

$reporte_escenarioadmin = $reportes_sql->metaproducto_escenario($cnxn_pag, $codigo_metapro, $codigo_escenarioadmin, $codigo_entidadtbg, $codigo_programatbg);

$reportefechamax_entidad=$reportes_sql->fecha_ultimoaccesoEntidad($cnxn_pag, $codigo_entidadtbg);
$data_fechamaxima=$cnxn_pag->obtener_filas($reportefechamax_entidad);
$ultimo_ingreso=$data_fechamaxima['ultimo_ingreso'];

if($codigo_escenarioadmin==''){

  $codigo_escenarioadmin=0;

}
else{
   $codigo_escenarioadmin=$codigo_escenarioadmin;
}

//echo $codigoentidad;
  //echo "Entro a ver listado: ".$codigo_escenarioadmin;


?>

<!--
                     <table class="conv" id="conv2">
                          <tr >
                            <th colspan="2"> <h4>Convenciones</h4></th>
                          </tr>
                          <tr>
                            <td> Meta Resultado</td>
                            <td> MR </td>
                          </tr>
                          <tr>
                            <td> Meta Producto</td>
                            <td> MP </td>
                          </tr>
                          <tr>
                            <td> Linea Base </td>
                            <td> LB </td>
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
                            <td>Crítico  < 40%</td>
                            <td> <a href="#" class ="new-btn dfn-hover"> <span class="red"></span></a> </td>
                          </tr>
                          <tr>
                            <td> Bajo  >= 40% y < 60% </td>
                            <td> <a href="#" class ="new-btn dfn-hover"> <span class="orange"></span></a> </td>
                          </tr>
                          <tr>
                            <td> Medio  >= 60% y < 80% </td>
                            <td> <a href="#" class ="new-btn dfn-hover"> <span class="yellow"></span></a> </td>
                          </tr>
                          <tr>
                            <td> Cumplido >= 80% y <=100% </td>
                            <td> <a href="#" class ="new-btn dfn-hover"> <span class="green"></span></a> </td>
                          </tr>
                          <tr>
                            <td> Superó meta de la vigencia </td>
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
-->

<div class="box-tabla">
<div class="tbl-header">
  <table class="tablaFijaCss">
    <thead>
      <tr>
        <th>
            <br>
            <div class="fec">último ingreso: <?php echo substr($ultimo_ingreso,0,16); ?>
              <!--


              <div class="busca">
                  <input id="Text1" class="txtSearch" type="text" onkeyup="CheckSearchText(this)" />
                  <input id="Button1" type="button" onclick="FixedSearchTest(this)" value="Buscar" />
              </div>

              <a href='excelreportexescenario?<?php echo $codigo_escenarioadmin; ?>-<?php echo $codigo_entidadtbg; ?>-<?php echo 2016; ?>'> <img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel">Reporte Por Entidad-2016</a>
              <a href='excelreportexescenario?<?php echo $codigo_escenarioadmin; ?>-<?php echo $codigo_entidadtbg; ?>-<?php echo 2017; ?>'><img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel">Reporte Por Entidad-2017</a>
              <a href='excelsemaforo?<?php echo $codigo_escenarioadmin; ?>-<?php echo $codigo_entidadtbg; ?>'> Descargar: Semaforo Por Entidad</a>
            -->

            </div>
        </th>
      </tr>
    </thead>
  </table>
</div>

<div class="tbl-header">
<table class="tablaFijaCss">
<thead>
<tr class="bg-v">
  <th class="wd-3">&nbsp;<strong>No.</strong> </th>
  <th class="wd-8">&nbsp;<strong>Escenario</strong>&nbsp;</th>
  <th class="wd-10">&nbsp;<strong>Programa</strong>&nbsp;</th>
  <th class="wd-15">&nbsp;<strong>MR</strong>&nbsp;</th>
  <th class="wd-20">&nbsp;<strong>MP</strong>&nbsp;</th>
  <th class="wd-5">&nbsp;<strong>LB</strong>&nbsp;</th>
  <th class="wd-5">&nbsp;<strong>MC</strong>&nbsp;</th>
  <th class="wd-20">&nbsp;<strong>V 2016 <a href='excelreportexescenario?<?php echo $codigo_escenarioadmin; ?>-<?php echo $codigo_entidadtbg; ?>-<?php echo 2016; ?>'> <img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel"></a></strong></th>
  <th class="wd-20">&nbsp;<strong>V 2017 <a href='excelreportexescenario?<?php echo $codigo_escenarioadmin; ?>-<?php echo $codigo_entidadtbg; ?>-<?php echo 2017; ?>'><img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel"></a></strong>&nbsp;</th>
  <th class="wd-15">&nbsp;<strong>Acu</strong>&nbsp;</th>
<!--
  <th>&nbsp;<strong>V 2018</strong>&nbsp;</th>
  <th>&nbsp;<strong>V 2019</strong>&nbsp;</th>
-->
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

  $baselinea=$mpr_lineabase;
  $valorcuatro=$mpr_valorcuatrenio;

  if($mpr_lineabase > $mpr_valorcuatrenio){

    $tipometaresul='R';

  }
  elseif($mpr_lineabase==$mpr_valorcuatrenio){

    $tipometaresul='M';
  }
  else{

    $tipometaresul='A';
  }

?>
  <tr>
    <td class="wd-3" data-label="Nro"><?php echo $numero_eaclista; ?></td>
    <td class="wd-8" data-label="Escenario" class="text-left"><?php echo $eac_nombre; ?></td>
    <td class="wd-10" data-label="Programa" class="text-left"><?php echo $pro_nombre; ?></td>
    <td class="wd-15" data-label="MR" class="text-left"><?php echo $mre_descripcion; ?></td>
    <td class="wd-20" data-label="MP" class="text-left"><?php echo $mpr_descripcion; ?></td>
    <td class="wd-5" data-label="LB" class="text-center"><?php echo $mpr_lineabase; ?></td>
    <td class="wd-5" data-label="MC" class="text-center"><?php echo $mpr_valorcuatrenio; ?></td>

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
        $valor_esperado=$valor_esperadomepro[1];
        //$color_semaforomp = $semaforomepro->semaforomp($cnxn_pag, $ves_vigencia, $codigoentidad, $ves_metaproducto, $valor_esperado);
        list($valorpromedio_semaforo, $letro_logro, $colorcirculo_semaforo, $colorvigencia, $entrovalore)=$semaforomepro->semaforomp($cnxn_pag, $ves_vigencia, $codigoentidad, $ves_metaproducto, $ves_valor,$mpr_valorcuatrenio, $mpr_tendenciapositiva, $mpr_lineabase);


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

    ?>

        <td class="tdEspe wd-20" data-label="V<?php echo $ves_vigencia; ?>" >

          <span class="colEspe">Esperado:</span><span><?php echo $ves_valor; ?></span><br><span class="colEspe">Ejecutado:</span><span><?php echo $valorejecutadomp; ?></span>
          <a class="brillo"><span class="<?php echo $colorcirculo_semaforo; ?>"><p><?php echo $valorpromedio_semaforo; ?>% </p></span> </a>
        </td>


    <?php

       $vigencia_numero++;
      }

      if($valoracumuladoesperado==0 && $valoracumuladoejecutado==0){
          $cumplimientovigencias=0;
      }
      elseif($valoracumuladoesperado==0 && $valoracumuladoejecutado!=0){
          $cumplimientovigencias=number_format(($valoracumuladoejecutado/$mpr_valorcuatrenio )*100 , 2, '.', '');
      }
      else{
            $cumplimientovigencias=0;
            if($tipometaresul=='A'){
              // AUMENTO
              $totalcuatrenio=$mre_valorcuatrenio-$mre_lineabase;
              $tipometaresul='A';
              $cumplimientovigencias=number_format(($valoracumuladoejecutado/$valoracumuladoesperado)*100 , 2, '.', '');
            }
            elseif($tipometaresul=='M'){
              //MANTENIMIENTO
              $tipometaresul='M';
              $cumplimientovigencias=100;
              $cumplimientovigencias=number_format(($valoracumuladoejecutado/$mpr_valorcuatrenio)*100 , 2, '.', '');
            }
            else{
              //REDUCCION
              $tipometaresul='R';
              $totalcuatrenio=$mre_lineabase-$mre_valorcuatrenio;
              $cumplimientovigencias=number_format(($valoracumuladoejecutado/$valoracumuladoesperado)*100 , 2, '.', '');
            }
      }
    //  $cumplimientovigencias=number_format(($valoracumuladoesperado/$valoracumuladoejecutado)*100 , 2, '.', '');

    ?>
    <td class="tdEspe wd-15">
      <?php //echo $tipometaresul ?>
        <span class="colEspe">Esperado: </span><span>&nbsp;<?php echo $valoracumuladoesperado; ?></span>
        <span class="colEspe">Acumulado: </span><span>&nbsp;<?php echo $valoracumuladoejecutado; ?></span>
        <span class="colEspe">Cumplimiento: </span> <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $cumplimientovigencias; ?>%</span>
    </td>
</tr>

<?php

  $numero_eaclista++;
  }

?>
<tr>
  <td colspan="9" class="m-barra wd-20"  >
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
          </ul>
          <ul>
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
