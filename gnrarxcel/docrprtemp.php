<?php
/*
@session_start();

*/
$fecha_generar=date('YmdHis');

if($codigo_elemento1==0){
  $codigo_escenarioadministrivoo="";
}
else{
  $codigo_escenarioadministrivoo=$codigo_elemento1;
}




if($codigo_elemento2){
  $codigoentidad=$codigo_elemento2;
}
else{
  $codigoentidad=$_SESSION['entidad_persona'];
}

if($codigo_elemento3){
  $vigencia_genrar=$codigo_elemento3;
}
else{
  $vigencia_genrar=$codigo_elemento2;
  $codigoentidad=$_SESSION['entidad_persona'];
}


$escenarioadministrativo=$principal_sql->escenarioAdmin($cnxn_pag,$codigo_escenarioadministrivoo);
$entidadadmin=$principal_sql->entidad($cnxn_pag,$codigoentidad);

$reporte_escenarioadmin = $reportes_sql->reporte_escenario($cnxn_pag, $codigo_escenarioadministrivoo, $codigoentidad, $vigencia_genrar);

$fuentes_finaciacion=$principal_sql->fuentefinanciacion($cnxn_pag);
$genero=$principal_sql->poblacion_genero($cnxn_pag);
$victima=$principal_sql->poblacion_victima($cnxn_pag);
$discapacitado=$principal_sql->poblacion_discapacidad($cnxn_pag);
$etnica=$principal_sql->poblacion_etnia($cnxn_pag);

$data_escenarioadministrativo=$cnxn_pag->obtener_filas($escenarioadministrativo);
$eac_codigo=$data_escenarioadministrativo['eac_codigo'];
$eac_nombre=$data_escenarioadministrativo['eac_nombre'];

$data_entidadreporte=$cnxn_pag->obtener_filas($entidadadmin);
$entidad_nombre=$data_entidadreporte['ent_nombre'];

if($codigo_elemento1==0){
  $nombre_documento=$entidad_nombre;
}
else{
    $nombre_documento=$eac_nombre;
}

//echo $reporte_escenarioadmin;

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=reporte_metasproductoxescenario_".str_replace(',', '', $nombre_documento)."_".$fecha_generar.".xls");
header("Pragma: no-cache");
header("Expires: 0");
/*
exportar a word
header('Content-type: application/vnd.ms-word');
header("Content-Disposition: attachment; filename=archivo.doc");
header("Pragma: no-cache");
header("Expires: 0");
*/
//validar si se logueo


set_time_limit(180000);

//$reporte_escenarioadmin = $reportes_sql->metaproducto_escenario($cnxn_pag, $codigo_metapro, $codigo_escenarioadmin, $codigo_entidadtbg);

$tabla = "
    <table border='1'>


			<tr>
          <th>Programa </th>
          <th>Entidad </th>
          <th>Meta Producto </th>
          <th>Meta Resultado </th>
          <th>Municipio </th>
          <th>Valor Avance </th>
          <th>Descripción MR </th>
          <th>Descripción MP </th>
          <th>Impacto </th>
          <th>Contrato/convenio/acta/fecha </th>";//observación
          $numero_fuentes=1;
      while($data_fuentesfinanciacion=$cnxn_pag->obtener_filas($fuentes_finaciacion)){
          $ffi_codigo=$data_fuentesfinanciacion['ffi_codigo'];
          $ffi_descripcion=$data_fuentesfinanciacion['ffi_descripcion'];
          $fficodigo[$numero_fuentes]=$ffi_codigo;

          $tabla.="<th bgcolor='#F3F3E9'>".$ffi_descripcion."</th>";
          $numero_fuentes++;
      }
      $tabla.="<th bgcolor='#F3F3E9'>Total Fuentes Financiación</th>";

      $numero_genero=1;
      /*
      while($data_genero=$cnxn_pag->obtener_filas($genero)){
           $plg_codigo=$data_genero['plg_codigo'];
           $plg_nombre=$data_genero['plg_nombre'];

           $tabla.="<th bgcolor='#E5E5E5'>".$plg_nombre."</th>";
           $plgcodigo[$numero_genero]=$plg_codigo;

           $numero_genero++;
      }
      */
      $tabla.="<th bgcolor='#E5E5E5'>Total Población</th>";

      $numero_victima=1;
      /*
      while($data_victima=$cnxn_pag->obtener_filas($victima)){
           $pvi_codigo=$data_victima['pvi_codigo'];
           $pvi_nombre=$data_victima['pvi_nombre'];

           $tabla.="<th bgcolor='#FFCCCC'>".$pvi_nombre."</th>";
           $pvicodigo[$numero_victima]=$pvi_codigo;

           $numero_victima++;
      }
      $tabla.="<th bgcolor='#FFCCCC'>Total P. Victima</th>";


      $numero_discapacitado=1;
      while($data_discapacitado=$cnxn_pag->obtener_filas($discapacitado)){
           $tdi_codigo=$data_discapacitado['tdi_codigo'];
           $tdi_nombre=$data_discapacitado['tdi_nombre'];

           $tabla.="<th bgcolor='#A6D2FF'>".$tdi_nombre."</th>";
           $tdicodigo[$numero_discapacitado]=$tdi_codigo;

           $numero_discapacitado++;
      }
      $tabla.="<th bgcolor='#A6D2FF'>Total P. Discapacidad</th>";

      $numero_etnica=1;
      while($data_etnica=$cnxn_pag->obtener_filas($etnica)){
           $pet_codigo=$data_etnica['pet_codigo'];
           $pet_nombre=$data_etnica['pet_nombre'];

           $tabla.="<th bgcolor='#99FFB3'>".$pet_nombre."</th>";
           $petcodigo[$numero_etnica]=$pet_codigo;

           $numero_etnica++;
      }
      $tabla.="<th bgcolor='#99FFB3'>Total P. Etnica</th>";
*/
$tabla.="<th>Indicador</th>";
$tabla.="<th>Numerador</th>";
$tabla.="<th>Denominador</th>";

			$tabla.="</tr>";

      while($data_listampxescenario=$cnxn_pag->obtener_filas($reporte_escenarioadmin)){

        $vej_codigo=$data_listampxescenario['vej_codigo'];
        $vej_metaproducto=$data_listampxescenario['vej_metaproducto'];
        $vej_nombre=$data_listampxescenario['eac_nombre'];
        $eac_nombre=$data_listampxescenario['eac_nombre'];
        $sad_nombre=$data_listampxescenario['sad_nombre'];
        $mpr_descripcion=$data_listampxescenario['mpr_descripcion'];
        $vej_valor=$data_listampxescenario['vej_valor'];
        $vej_vigencia=$data_listampxescenario['vej_vigencia'];
        $mun_nombre=$data_listampxescenario['mun_nombre'];
        $vej_descripcionmeru=$data_listampxescenario['vej_descripcionmeru'];
        $vej_descripcionmepro=$data_listampxescenario['vej_descripcionmepro'];
        $vej_impacto=$data_listampxescenario['vej_impacto'];
        $vej_observacion=$data_listampxescenario['vej_observacion'];
        $ent_nombre=$data_listampxescenario['ent_nombre'];
        $mre_descripcion=$data_listampxescenario['mre_descripcion'];
        $vej_entidad=$data_listampxescenario['vej_entidad'];
        $pro_nombre=$data_listampxescenario['pro_nombre'];
        $mpr_lineabase=$data_listampxescenario['mpr_lineabase'];
        $mpr_valorcuatrenio=$data_listampxescenario['mpr_valorcuatrenio'];
        $mpr_codificacion=$data_listampxescenario['mpr_codificacion'];
        $mpr_indicadorsgi=$data_listampxescenario['mpr_indicadorsgi'];
        $vej_numerador=$data_listampxescenario['vej_numerador'];
        $vej_denominador=$data_listampxescenario['vej_denominador'];

        $valor_esperado=$reportes_sql->valor_esperadoreporte($cnxn_pag, $vej_metaproducto, $vigencia_genrar);


        $tabla.=" <tr>


                    <td>".$pro_nombre."</td>
                    <td>".$ent_nombre."</td>

                    <td>".$mpr_descripcion."</td>
                    <td>".$mre_descripcion."</td>";

                  $data_valormp=$cnxn_pag->obtener_filas($valor_esperado);
                  $ves_valor=$data_valormp['ves_valor'];
                  $ves_vigencia=$data_valormp['ves_vigencia'];
                  $tabla.="";



        $tabla.=    "<td>".$mun_nombre."</td>
                    <td>".$vej_valor."</td>
                    <td>".$vej_descripcionmeru."</td>
                    <td>".$vej_descripcionmepro."</td>
                    <td>".$vej_impacto."</td>
                    <td>".$vej_observacion."</td>";

                $totalsumafifu=0;
                for($numeroff=1;$numeroff<$numero_fuentes;$numeroff++){

                    $mepro_fufi=$reportes_sql->totalejecutadoresultado_fufi($cnxn_pag, $vej_metaproducto, $vej_codigo, $fficodigo[$numeroff]);
                    $data_fifuresultado=$cnxn_pag->obtener_filas($mepro_fufi);
                    $mfu_fuentefinanciacion=$data_fifuresultado['mfu_fuentefinanciacion'];
                    $mfu_valor=$data_fifuresultado['mfu_valor'];

                    if($mfu_valor){

                        if($vej_entidad=='3' || $vej_entidad=='14' /* || $vej_entidad=='17' */){
                          $valormostrar=$mfu_valor;
                        }
                        else{
                          //$valormostrar=round($mfu_valor/1000,2);
                          $valormostrar=$valormostrar=$mfu_valor;//number_format($valormostrar, 2, ',', '');
                        }
                    }
                    else{
                      $valormostrar=0;
                    }

                    $totalsumafifu=$totalsumafifu+$valormostrar;

                    $tabla.="<td bgcolor='#F3F3E9'>".$valormostrar."</td>";
                }
                    $totalsumafifu=number_format($totalsumafifu, 2, ',', '');
                    $tabla.="<td bgcolor='#F3F3E9'>".$totalsumafifu."</td>";

                    $sumatotalgenero=0;
                for($numerogenero=1;$numerogenero<$numero_genero;$numerogenero++){

                    $mepro_genero=$reportes_sql->totalejecutadoresultado_genero($cnxn_pag, $vej_metaproducto, $vej_codigo,  $plgcodigo[$numerogenero]);
                    $data_generoresultado=$cnxn_pag->obtener_filas($mepro_genero);
                    $mge_genero=$data_generoresultado['mge_genero'];
                    $mge_valor=$data_generoresultado['mge_valor'];
                    if($mge_valor){
                      $valormgenero=$mge_valor;
                    }
                    else{
                      $valormgenero=0;
                    }

                    $sumatotalgenero=$sumatotalgenero+$valormgenero;
                    //$tabla.="<td bgcolor='#E5E5E5'>".$valormgenero."</td>";

                }
                  $tabla.="<td bgcolor='#E5E5E5'>".$sumatotalgenero."</td>";

/*
                $sumatotalvictima=0;
                for($numerovictima=1;$numerovictima<$numero_victima;$numerovictima++){

                    $mepro_victima=$reportes_sql->totalejecutadoresultado_victima($cnxn_pag, $vej_metaproducto, $vej_codigo, $pvicodigo[$numerovictima]);
                    $data_victimaresultado=$cnxn_pag->obtener_filas($mepro_victima);
                    $mvi_victima=$data_victimaresultado['mvi_victima'];
                    $mvi_valor=$data_victimaresultado['mvi_valor'];
                    if($mvi_valor){
                      $valormvictima=$mvi_valor;
                    }
                    else{
                      $valormvictima=0;
                    }

                    $tabla.="<td bgcolor='#FFCCCC'>".$valormvictima."</td>";
                    $sumatotalvictima=$sumatotalvictima+$valormvictima;
                }
                $tabla.="<td bgcolor='#FFCCCC'>".$sumatotalvictima."</td>";

                $sumatotaldiscapacitado=0;
                for($numerodiscapacitado=1;$numerodiscapacitado<$numero_discapacitado;$numerodiscapacitado++){

                    $mepro_discapacitado=$reportes_sql->totalejecutadoresultado_discapacidad($cnxn_pag, $vej_metaproducto, $vej_codigo, $tdicodigo[$numerodiscapacitado]);
                    $data_discapacitadoresultado=$cnxn_pag->obtener_filas($mepro_discapacitado);
                    $mdi_discapacidad=$data_discapacitadoresultado['mdi_discapacidad'];
                    $mdi_valor=$data_discapacitadoresultado['mdi_valor'];
                    if($mdi_valor){
                      $valormdiscapacitado=$mdi_valor;
                    }
                    else{
                      $valormdiscapacitado=0;
                    }

                    $tabla.="<td bgcolor='#A6D2FF'>".$valormdiscapacitado."</td>";
                    $sumatotaldiscapacitado=$sumatotaldiscapacitado+$valormdiscapacitado;
                }
                $tabla.="<td bgcolor='#A6D2FF'>".$sumatotaldiscapacitado."</td>";


                $sumatotaletnica=0;
                for($numeroetnica=1;$numeroetnica<$numero_etnica;$numeroetnica++){

                    $mepro_etnica=$reportes_sql->totalejecutadoresultado_etnia($cnxn_pag, $vej_metaproducto, $vej_codigo, $petcodigo[$numeroetnica]);
                    $data_etnicaresultado=$cnxn_pag->obtener_filas($mepro_etnica);
                    $met_etnia=$data_etnicaresultado['met_etnia'];
                    $met_valor=$data_etnicaresultado['met_valor'];
                    if($met_valor){
                      $valormetnica=$met_valor;
                    }
                    else{
                      $valormetnica=0;
                    }

                    $tabla.="<td bgcolor='#99FFB3'>".$valormetnica."</td>";
                    $sumatotaletnica=$sumatotaletnica+$valormetnica;
                }

                $tabla.="<td bgcolor='#99FFB3'>".$sumatotaletnica."</td>";


*/


          $tabla.="<td>".$mpr_indicadorsgi."</td>";
          $tabla.="<td>".$vej_numerador."</td>";
          $tabla.="<td>".$vej_denominador."</td>";



      }

$tabla.="</table>";


$tabla = $tabla." </table>";
$tabla=utf8_decode($tabla);
echo $tabla;

?>
