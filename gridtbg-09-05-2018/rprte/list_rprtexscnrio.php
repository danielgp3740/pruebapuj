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
      <th width="3%">&nbsp;&nbsp;Nro. </th>
      <th width="8%">&nbsp;&nbsp;Escenario </th>
      <th width="18%">&nbsp;MP&nbsp;</th>
      <th width="5%">&nbsp;LB&nbsp;</th>
      <th width="5%">&nbsp;MC&nbsp;</th>
      <th>&nbsp;V 2016&nbsp; <a href='excelreportexescenario?<?php echo $codigo_escenarioadmin."-2016"; ?>'><img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel"> </a></th>
      <th>&nbsp;V 2017&nbsp;<a href='excelreportexescenario?<?php echo $codigo_escenarioadmin."-2017"; ?>'><img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel"> </a></th>
      <!-- <th>&nbsp;V 2018&nbsp;</th>
      <th>&nbsp;V 2019&nbsp;</th> -->
      <th width="10%">&nbsp;Acu&nbsp;</th>
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

      $valor_esperadomp = $principal_sql->valor_esperado($cnxn_pag, $mpr_codigo);

      if($mre_lineabase > $mre_valorcuatrenio){

        $tipometaresul='R';

      }
      elseif($mre_lineabase==$mre_valorcuatrenio){

        $tipometaresul='M';
      }
      else{

        $tipometaresul='A';
      }
    ?>
      <tr>
        <td width="3%" data-label="Nro"><?php echo $numero_eaclista; ?></td>
        <td width="8%" data-label="Escenario"><strong><?php echo $ent_nombre ?></strong></td>
        <td width="18%" data-label="MP"><?php echo $mpr_descripcion; ?></td>
        <td width="5%" data-label="LB"><?php echo $mpr_lineabase; ?></td>
        <td width="5%" data-label="MC"><?php echo $mpr_valorcuatrenio; ?></td>

        <?php

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
            <td class="tdEspe" data-label="v <?php echo $ves_vigencia; ?>">
              <span class="colEspe">Esperado:</span><span><?php echo $ves_valor; ?></span><span class="colEspe">Ejecutado:</span><span><?php echo $valorejecutadomp; ?></span>
              <a class="brillo"><span class="<?php echo $colorcirculo_semaforo; ?>"><p><?php echo $valorpromedio_semaforo; ?>% <p></span> </a>
            </td>


        <?php

           $vigencia_numero++;
          }


        ?>

        <td class="tdEspe" width="10%">
          <span class="colEspe">Esperado: </span><span>&nbsp;<?php echo $valoracumuladoesperado; ?></span>
          <span class="colEspe">Acumulado: </span><span>&nbsp;<?php echo $valoracumuladoejecutado; ?></span>
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
