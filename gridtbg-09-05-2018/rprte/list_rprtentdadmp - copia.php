
<?php

include('brrsmfro.php');
$barrassemaro=new BarrasSemaforo();

$codigo_entidadtbg=$_REQUEST['codigo_entidad'];

$reporte_escenarioadmin = $reportes_sql->metaproducto_escenario($cnxn_pag, $codigo_metapro, $codigo_escenarioadmin, $codigo_entidadtbg);

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


                     <table class="conv" id="conv2">
                          <tr >
                            <th colspan="2"> <h4>Convenciones</h4></th>
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
  <th width="3%">&nbsp;<strong>Nro.</strong> </th>
  <th width="30%">&nbsp;<strong>MP</strong>&nbsp;</th>
  <th width="5%">&nbsp;<strong>LB</strong>&nbsp;</th>
  <th width="5%">&nbsp;<strong>MC</strong>&nbsp;</th>
  <th>&nbsp;<strong>V 2016  <a href='excelreportexescenario?<?php echo $codigo_escenarioadmin; ?>-<?php echo $codigo_entidadtbg; ?>-<?php echo 2016; ?>'> <img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel"></a></strong></th>
  <th>&nbsp;<strong>V 2017   <a href='excelreportexescenario?<?php echo $codigo_escenarioadmin; ?>-<?php echo $codigo_entidadtbg; ?>-<?php echo 2017; ?>'><img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel"></a></strong>&nbsp;</th>
  <th>&nbsp;<strong>V 2018</strong>&nbsp;</th>
  <th>&nbsp;<strong>V 2019</strong>&nbsp;</th>
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


?>
  <tr>
    <td width="3%"><?php echo $numero_eaclista; ?></td>
    <td width="30%" class="text-left"><?php echo $mpr_descripcion; ?></td>
    <td width="5%" class="text-center"><?php echo $mpr_lineabase; ?></td>
    <td width="5%" class="text-center"><?php echo $mpr_valorcuatrenio; ?></td>

    <?php

    $vigencia_numero=1;
    $colorvigencia=0;
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
            $numeroazul[$ves_vigencia]=$numeroazul[$ves_vigencia]+1;
        }


    ?>
        <td class="tdEspe">

          <span class="colEspe">Esperado:</span><span><?php echo $ves_valor; ?></span><span class="colEspe">Ejecutado:</span><span><?php echo $valorejecutadomp; ?></span>
          <a class="brillo"><span class="<?php echo $colorcirculo_semaforo; ?>"><p><?php echo $valorpromedio_semaforo; ?>% <p></span> </a>
        </td>


    <?php

       $vigencia_numero++;
      }


    ?>
    <!--
      1. rojo: 0-30
      2. naranja: 31-71
      3. amarillo: 71-99
      4. verde: 100

    -->

</tr>

<?php

  $numero_eaclista++;
  }

?>
<tr>
<td colspan="8">
  <div class="barras">
    <?php
      $barrassemaro_rojas=$barrassemaro->barrasrojas($numerorojo,$numero_eaclista);
      echo $barrassemaro_rojas;
    ?>
  </div>

  <div class="barras">
    <?php
      $barrassemaro_naranja=$barrassemaro->barrasnaranja($numeronaranja,$numero_eaclista);
      echo $barrassemaro_naranja;
    ?>
  </div>

  <div class="barras">
    <?php
      $barrassemaro_amarillo=$barrassemaro->barrasamarillo($numeroamarillo,$numero_eaclista);
      echo $barrassemaro_amarillo;
    ?>
  </div>

  <div class="barras">
    <?php
      $barrassemaro_verde=$barrassemaro->barrasverde($numeroverde,$numero_eaclista);
      echo $barrassemaro_verde;
    ?>
  </div>

  <div class="barras">
    <?php
      $barrassemaro_violeta=$barrassemaro->barrasvioleta($numerovioleta,$numero_eaclista);
      echo $barrassemaro_violeta;
    ?>
  </div>

  <div class="barras">
    <?php
      $barrassemaro_azul=$barrassemaro->barrasazul($numeroazul,$numero_eaclista);
      echo $barrassemaro_azul;
    ?>
  </div>



<!--

<div class="barras">
    <div class="colu rojo">
      <h6>2016</h6>
      <div style="height:<?php echo $resta_rojo; ?>%"></div>
      <div class="color" style="height:<?php echo $porcentaje_rojo; ?>%"></div>
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

-->
</td>

</tr>
<!--<tr>
  <td colspan="8">

    <?php //echo "Rojo 2016:". $numerorojo[2016]; ?>
    <?php //echo "Rojo 2017:".$numerorojo[2017]; ?>


          <div class="barras">
              <div class="colu rojo">
                <div style="height:<?php echo $resta_rojo; ?>%"></div>
                <div class="color" style="height:<?php echo $porcentaje_rojo; ?>%"></div>
                <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_rojo,2); ?>% = <?php echo $numero_rojo; ?></span>
              </div>
              <div class="colu naranja">
                <div style="height:<?php echo $resta_naranja; ?>%"></div>
                <div class="color" style="height:<?php echo $porcentaje_naranja; ?>%"></div>
                <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_naranja,2); ?>% = <?php echo $numero_naranja; ?></span>
              </div>
              <div class="colu amarillo">
                <div style="height:<?php echo $resta_amarillo; ?>%"></div>
                <div class="color" style="height:<?php echo $porcentaje_amarillo; ?>%"></div>
                <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_amarillo,2); ?>% = <?php echo $numero_amarillo; ?></span>
              </div>
              <div class="colu verde">
                <div style="height:<?php echo $resta_verde; ?>%"></div>
                <div class="color" style="height:<?php echo $porcentaje_verde; ?>%"></div>
                <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_verde,2); ?>% = <?php echo $numero_verde; ?></span>
              </div>
              <div class="colu violeta">
                <div style="height:<?php echo $resta_violeta; ?>%"></div>
                <div class="color" style="height:<?php echo $porcentaje_violeta; ?>%"></div>
                <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_violeta,2); ?>% = <?php echo $numero_violeta; ?></span>
              </div>
              <div class="colu gris">
                <div style="height:<?php echo $resta_gris; ?>%"></div>
                <div class="color" style="height:<?php echo $porcentaje_gris; ?>%"></div>
                <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_gris,2); ?>% = <?php echo $numero_gris; ?></span>
              </div>
              <div class="colu azul">
                <div style="height:<?php echo $resta_azul; ?>%"></div>
                <div class="color" style="height:<?php echo $porcentaje_azul; ?>%"></div>
                <span style="font-weight:bold; margin-top:10px; font-size:120%"><?php echo round($porcentaje_azul,2); ?>% = <?php echo $numero_azul; ?></span>
              </div>
          </div>
          <div class="col-md-12">&nbsp;</div>
          <div class="col-md-12">&nbsp;</div>
          <div class="col-md-12">
            <fieldset>
                <legend>&nbsp;</legend>
            </fieldset>
          </div>
          <div class="col-md-12">
            &nbsp;
          </div>

</td>
</tr>-->

</table>

</div>

</div>
