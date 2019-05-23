<?php

$codigo_escenario=$_REQUEST['codigo_sector'];


include('../lbr/sgltn.php');

include ('../lbr/dtos_srvdor.php');

$sql_escenario=" SELECT eac_codigo, eac_nombre, eac_descripcion, eac_fechacreo, eac_fechamodifico, 
						  eac_objetivo, eac_personacreo, eac_personamodifico
				   FROM escenario_actuacion
				   WHERE  eac_codigo='".$codigo_escenario."'; ";
				   
$query_escenario=$cnxn_pag->ejecutar($sql_escenario);
$data_escenario=$cnxn_pag->obtener_filas($query_escenario);

$eac_nombre=$data_escenario['eac_nombre'];

				   
				   
$sql_sectoradmin=" SELECT sad_codigo, sad_nombre, sad_descripcion, sad_objetivo, sad_fechacreo, 
						  sad_fechamodifico, sad_personacreo, sad_personamodifico, sad_escenarioactuacion
				   FROM sector_administrativo
				   WHERE sad_escenarioactuacion='".$codigo_escenario."'; ";
				   
$query_sectoradmin=$cnxn_pag->ejecutar($sql_sectoradmin);


	
	
	
	



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SECTORES ADMINISTRATIVOS</title>
</head>

<body>

<h2>SECTORES ADMINISTRATIVOS <?php echo strtoupper($eac_nombre); ?></h2>


<?php
	
	
	$item=1;
	while($data_sectoradmin=$cnxn_pag->obtener_filas($query_sectoradmin)){
	
		$sad_codigo=$data_sectoradmin['sad_codigo'];
		$sad_nombre=$data_sectoradmin['sad_nombre'];
		$sad_descripcion=$data_sectoradmin['sad_descripcion'];
		$sad_objetivo=$data_sectoradmin['sad_objetivo'];
		
		
		echo $item.". <a href='programa.php?codigo_sectoradmin=".$sad_codigo."' target='_blank'>".$sad_nombre."</a><br>";
		
		
		$item++;
	}

?>

</body>
</html>