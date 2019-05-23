<?php

include('../lbr/sgltn.php');

include ('../lbr/dtos_srvdor.php');


$sql_escenario=" SELECT eac_codigo, eac_nombre, eac_descripcion, eac_fechacreo, eac_fechamodifico, 
						  eac_objetivo, eac_personacreo, eac_personamodifico
				   FROM escenario_actuacion; ";
				   
$query_escenario=$cnxn_pag->ejecutar($sql_escenario);






?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>

<h2>ESCENARIOS DE ACTUACIÓN PRIORITARIA</h2>


<?php
	$item=1;
	while($data_escenario=$cnxn_pag->obtener_filas($query_escenario)){
	
		$eac_codigo=$data_escenario['eac_codigo'];
		$eac_nombre=$data_escenario['eac_nombre'];
		$eac_descripcion=$data_escenario['eac_descripcion'];
		
		
		echo $item.". <a href='sector_administrativo.php?codigo_sector=".$eac_codigo."' target='_blank'>".$eac_nombre."</a><br>";
	
	
	
	$item++;
	
}



?>

</body>
</html>