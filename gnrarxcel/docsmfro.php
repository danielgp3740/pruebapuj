<?php

$fecha_generar=date('YmdHis');


if($codigo_elemento1==0){
  $codigo_escenarioadministrivoo="";
}
else{
  $codigo_escenarioadministrivoo=$codigo_elemento1;
}


/*

if($codigo_elemento2){
  $codigoentidad=$codigo_elemento2;
}
else{
  $codigoentidad=$_SESSION['entidad_persona'];
}
*/

$escenarioadministrativo=$principal_sql->escenarioAdmin($cnxn_pag,$codigo_escenarioadministrivoo);
$entidadadmin=$principal_sql->entidad($cnxn_pag, $codigoentidad);




$data_escenarioadministrativo=$cnxn_pag->obtener_filas($escenarioadministrativo);
$eac_codigo=$data_escenarioadministrativo['eac_codigo'];
$eac_nombre=$data_escenarioadministrativo['eac_nombre'];

$data_entidadreporte=$cnxn_pag->obtener_filas($entidadadmin);
$entidad_nombre=$data_entidadreporte['ent_nombre'];

/*
if($codigo_elemento1==0){
  $nombre_documento=$entidad_nombre;
}
else{
    $nombre_documento=$eac_nombre;
}
*/
$nombre_documento='semaforo_MP';
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=reporte_semaforo_".str_replace(',', '', $nombre_documento)."_".$fecha_generar.".xls");
header("Pragma: no-cache");
header("Expires: 0");




set_time_limit(180000);


$reporte_escenarioadmin = $reportes_sql->metaproducto_escenario($cnxn_pag, $codigo_metapro, $codigo_escenarioadministrivoo, $codigoentidad, $codigoprograma);


$tabla = "
  <table border='1'>

    <tr>
      <td>&nbsp;&nbsp;<strong>Nro.</strong> </td>
      <td width='33%'>&nbsp;<strong>Entidad</strong>&nbsp;</td>
      <td width='33%'>&nbsp;<strong>Meta de Producto</strong>&nbsp;</td>
      <td>&nbsp;<strong>Linea Base</strong>&nbsp;</td>
      <td>&nbsp;<strong>Meta Cuatrenio</strong>&nbsp;</td>
      <td>&nbsp;<strong>Vigencia 2016</strong>&nbsp;</td>
      <td>&nbsp;<strong>Ejecutado 2016</strong>&nbsp;</td>
      <td>&nbsp;<strong>Semáforo 2016</strong>&nbsp;</td>
      <td>&nbsp;<strong>Vigencia 2017</strong>&nbsp;</td>
      <td>&nbsp;<strong>Ejecutado 2017</strong>&nbsp;</td>
      <td>&nbsp;<strong>Semáforo 2017</strong>&nbsp;</td>

    </tr>



";

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



      $tabla.="<tr>
                  <td>".$numero_eaclista."</td>
                  <td>".$ent_nombre."</td>
                  <td>".$mpr_descripcion."</td>
                  <td>".number_format($mpr_lineabase, 2, ',', '')."</td>
                  <td>".number_format($mpr_valorcuatrenio, 2, ',', '')."</td>";

            if($mpr_descripcion=='Indicador de endeudamiento "Sostenibilidad", dentro de los límites de viabilidad fiscal' || $mpr_descripcion=='Inidicador de solvencia dentro de los límites de la viabilidad fiscal'){
              $mpr_valorcuatrenio=$baselinea;
            }
            else{
              $mpr_valorcuatrenio=$valorcuatro;
            }



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
            //list($valorpromedio_semaforo, $letro_logro, $colorcirculo_semaforo, $colorvigencia, $entrovalore)=$semaforomepro->semaforomp($cnxn_pag, $ves_vigencia, $codigoentidad, $ves_metaproducto, $ves_valor,$mpr_valorcuatrenio, $mpr_tendenciapositiva, $mpr_lineabase);
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


            // inicio nuevo mayo 3 de 2018
            if($ves_valor==$mpr_valorcuatrenio){
              $valoracumuladoesperado=$ves_valor;
              $valoracumuladoejecutado=$valorejecutadomp;
              $totalesperadometa=0;
            }
            else {
              $valoracumuladoesperado=$valoracumuladoesperado+$ves_valor;
              $valoracumuladoejecutado=$valoracumuladoejecutado+$valorejecutadomp;
            }

            $valoracumuladovigencias=$valoracumuladovigencias+$valorejecutadomp;

            if($mpr_descripcion=='Magnitud de la inversión Pública/Gasto Total'){
              if($mpr_lineabase > $valor_ejecutado){
                $colorcirculo_semaforo="red";
              }
            }
            // fin nuevo mayo 3 de 2018

            //$imagensemaforo=$enlace."img/".$colorcirculo_semaforo."_semaforo.png";

            if ($colorcirculo_semaforo=="red") {
              $estilofondo="background: red";
            }
            elseif ($colorcirculo_semaforo=="orange") {
              $estilofondo="background: orange";
            }
            elseif ($colorcirculo_semaforo=="yellow") {
              $estilofondo="background: yellow";
            }
            elseif ($colorcirculo_semaforo=="green") {
              $estilofondo="background: green";
            }
            elseif ($colorcirculo_semaforo=="blue") {
              $estilofondo="background: blue";
            }
            elseif ($colorcirculo_semaforo=="viol") {
              $estilofondo="background: #b914d6";
            }
            elseif ($colorcirculo_semaforo=="gray") {
              $estilofondo="background: gray;";
            }



            $tabla.=" <td>".str_replace('.', ',', $ves_valor)."</td>
                      <td>".number_format($valorejecutadomp, 4, ',', '')."</td>
                      <td style='$estilofondo'>".number_format($valorpromedio_semaforo, 2, ',', '')."%</td>";

            $vigencia_numero++;
          }

          $tabla.="</tr>";

          $numero_eaclista++;
}

$tabla.="<tr>";
$tabla.="<th>Vigencia 2016</th>";
$tabla.="</tr>";

$tabla.="<tr><td>Rojo: </td><td> $numerorojo[2016]</td></tr>";
$tabla.="<tr><td>Naranja: </td><td>$numeronaranja[2016]</td></tr>";
$tabla.="<tr><td>Amarillo:  </td><td>$numeroamarillo[2016]</td></tr>";
$tabla.="<tr><td>Verde: </td><td>$numeroverde[2016]</td></tr>";
$tabla.="<tr><td>Violeta: </td><td>$numerovioleta[2016]</td></tr>";
$tabla.="<tr><td>Azul: </td><td>$numeroazul[2016]</td></tr>";
$tabla.="<tr><td>Gris:</td><td>$numerogris[2016]</td></tr>";


$tabla.="<tr>";
$tabla.="<th>Vigencia 2017</th>";
$tabla.="</tr>";


$tabla.="<tr><td>Rojo:  </td><td>$numerorojo[2017]</td></tr>";
$tabla.="<tr><td>Naranja: </td><td>$numeronaranja[2017]</td></tr>";
$tabla.="<tr><td>Amarillo:  </td><td>$numeroamarillo[2017]</td></tr>";
$tabla.="<tr><td>Verde:</td><td> $numeroverde[2017]</td></tr>";
$tabla.="<tr><td>Violeta:</td><td>$numerovioleta[2017]</td></tr>";
$tabla.="<tr><td>Azul:</td><td> $numeroazul[2017]</td></tr>";
$tabla.="<tr><td>Gris:</td><td>$numerogris[2017]</td></tr>";



$tabla.="</table>";

$tabla=utf8_decode($tabla);
echo $tabla;

?>
