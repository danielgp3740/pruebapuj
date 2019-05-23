<?php

include('../lbr/sgltn.php');
include ('../lbr/dtos_srvdor.php');


$sql_metaresultado_codigoficacion="SELECT mre_codigo, mre_descripcion, mre_lineabase, mre_valorcuatrenio, 
       mre_personacreo, mre_personamodifico, mre_fechamodifico, mre_fechacreo, 
       mre_programa, mre_codificacion, mre_indicador, mre_dmri1, mre_dmri2, 
       mre_tipovalor
  FROM meta_resultado;";
  
  
$sql_metaproducto="SELECT mpr_codigo, mpr_descripcion, mpr_lineabase, mpr_valorcuatrenio, 
       mpr_personacreo, mpr_personamodifico, mpr_fechacreo, mpr_fechamodifico, 
       mpr_metaresultado, mpr_codificacion, mpr_indicador, mpr_entidadresponsable, 
       mpr_personaresponsable, mpr_sectornn, mpr_odsproducto, mpr_tipovalor, 
       mpr_codificacionmp
  FROM meta_producto;";  
$query_metaproducto=$cnxn_pag->ejecutar($sql_metaproducto);
//$numerosectores=$cnxn_pag->numero_filas($sql_metaproducto);

$numero=1;

while($data_metaproducto=$cnxn_pag->obtener_filas($query_metaproducto)){
	
	$mpr_codigo=$data_metaproducto['mpr_codigo'];
	$mpr_codificacionmr=$data_metaproducto['mpr_codificacionmr'];
	$mpr_metaresultado=$data_metaproducto['mpr_metaresultado'];
	$mpr_codificacion=$data_metaproducto['mpr_codificacion'];
	
	$sql_metaresultado_codigoficacion="SELECT mre_codigo, mre_descripcion, mre_lineabase, mre_valorcuatrenio, 
       mre_personacreo, mre_personamodifico, mre_fechamodifico, mre_fechacreo, 
       mre_programa, mre_codificacion, mre_indicador, mre_dmri1, mre_dmri2, 
       mre_tipovalor
		FROM meta_resultado
		WHERE mre_codigo='$mpr_metaresultado';";
	
	$mpr_codificacion_array = explode('.',$mpr_codificacion);	
  
	$query_metaresultado=$cnxn_pag->ejecutar($sql_metaresultado_codigoficacion);
	$data_metaresultado=$cnxn_pag->obtener_filas($query_metaresultado);
	$mre_codificacion=$data_metaresultado['mre_codificacion'];
  
	echo "UPDATE meta_producto 
		  SET mpr_codificacionmp=".$mpr_codificacion_array[3].", mpr_codificacionmr=".$mre_codificacion."
		  WHERE mpr_codigo='".$mpr_codigo."'; ";
	echo "<br>";
$numero++;	
	
}

?>