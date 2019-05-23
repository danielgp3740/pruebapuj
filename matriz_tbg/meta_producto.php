<?php
include('../lbr/sgltn.php');

include ('../lbr/dtos_srvdor.php');



$sql_metaproducto="SELECT mpr_codigo, mpr_descripcion, mpr_lineabase, mpr_valorcuatrenio, 
       mpr_personacreo, mpr_personamodifico, mpr_fechacreo, mpr_fechamodifico, 
       mpr_metaresultado
  FROM meta_producto;";

$query_metaproducto=$cnxn_pag->ejecutar($sql_metaproducto);


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>


	<?php
		
		$item=1;
		while($data_metaproducto=$cnxn_pag->obtener_filas($query_metaproducto)){
		
			$sad_codigo=$data_metaproducto['mpr_codigo'];
			$sad_nombre=$data_metaproducto['mpr_descripcion'];
			
			
			
			echo $item.". ".$sad_nombre."<br>";
		
			$item++;
		
		}
?>

</body>
</html>