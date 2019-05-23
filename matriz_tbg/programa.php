<?php
include('../lbr/sgltn.php');

include ('../lbr/dtos_srvdor.php');

$codigo_sector=$_REQUEST['codigo_sectoradmin'];

$sql_sectoradmin=" SELECT sad_codigo, sad_nombre, sad_descripcion, sad_objetivo, sad_fechacreo, 
						  sad_fechamodifico, sad_personacreo, sad_personamodifico, sad_escenarioactuacion
				   FROM sector_administrativo
				   WHERE sad_codigo='".$codigo_sector."'; ";
				   
$query_sectoradmin=$cnxn_pag->ejecutar($sql_sectoradmin);

$data_sectoradmin=$cnxn_pag->obtener_filas($query_sectoradmin);
$sad_nombre=$data_sectoradmin['sad_nombre'];



$sql_programa="SELECT pro_codigo, pro_nombre, pro_descripcion, pro_objetivo, pro_fechacreo, 
       pro_fechamodifico, pro_personacreo, pro_sectoradministrativo, 
       pro_fechapersonamodifico
  FROM programa
  WHERE pro_sectoradministrativo='".$codigo_sector."' ;";

$query_programa=$cnxn_pag->ejecutar($sql_programa);


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Programas <?php echo $sad_nombre; ?></title>
</head>

<body>

<h2>Programas <?php echo $sad_nombre;?></h2>
	<?php
		
		$item=1;
		while($data_programa=$cnxn_pag->obtener_filas($query_programa)){
		
			$sad_codigo=$data_programa['pro_codigo'];
			$sad_nombre=$data_programa['pro_nombre'];
			$sad_descripcion=$data_programa['pro_descripcion'];
			$sad_objetivo=$data_programa['pro_objetivo'];
			
			
			echo $item.". <a href='meta_resultado.php?codigo_programa=".$sad_codigo."' target='_blank'>".$sad_nombre."</a><br>";
			//echo $item.". ".$sad_nombre."<br>";
		
			$item++;
		
		}
?>

</body>
</html>