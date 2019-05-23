<?
set_time_limit(36000000);
header('Content-Type: text/html; charset=utf-8');




include('../lbr/sgltn.php');
include ('../lbr/dtos_srvdor.php');

require_once '../excel/reader.php';  

//echo "salir algo";

$sql_sectores=" SELECT sad_codigo, sad_nombre, sad_descripcion, sad_objetivo, sad_fechacreo, sad_fechamodifico, sad_personacreo, sad_personamodifico, sad_escenarioactuacion
				FROM sector_administrativo;";
$query_sectores=$cnxn_pag->ejecutar($sql_sectores);
$numerosectores=$cnxn_pag->numero_filas($query_sectores);

//echo $numerosectores;



if($_REQUEST['variable']){

$data = new Spreadsheet_Excel_Reader();

$data->setOutputEncoding('CP1251'); 
$data->read('../docexcel/programas.xls');

$data->sheets[x][y];

// Numero de columnas de la hoja
$columnas=$data->sheets[0]['numCols']; 
$filas=$data->sheets[0]['numRows']; 

$data->sheets[0]['cellsInfo'][3][4]['raw']; 
$data->sheets[0]['cellsInfo'][3][4]['type'];

	$aleatorio=1;
	for($d_filas=1;$d_filas<=$filas;$d_filas++){
		
  			//$dep_codigo=$data->sheets[0]['cells'][$d_filas][1];
			$nombre_programa=utf8_encode($data->sheets[0]['cells'][$d_filas][2]);
			$nombre_sector=utf8_encode($data->sheets[0]['cells'][$d_filas][1]);
  			$persona_ingreso='201604271746001';
			
			
			//$aleatorio=rand(100, 900);
			$codigo=date('YmdHis');
			$codigo_programas=$codigo.$aleatorio;
			
			//echo mb_detect_encoding($nombre_sector)."<br>";
			
			
			
			$sql_sectorcodigo=" SELECT sad_codigo
								FROM sector_administrativo
								WHERE sad_nombre LIKE '%".mb_convert_encoding($nombre_sector, 'UTF-8', mb_detect_encoding($nombre_sector))."%';";
			$query_sectorcodigo=$cnxn_pag->ejecutar($sql_sectorcodigo);
			
			//echo $sql_sectorcodigo."<br>";				
				
			
			$data_sectorcodigo=$cnxn_pag->obtener_filas($query_sectorcodigo);
			$codigo_sector=$data_sectorcodigo['sad_codigo'];
			
				$sql_insertar="INSERT INTO programa(pro_codigo, pro_nombre, pro_descripcion, pro_objetivo, pro_fechacreo, pro_fechamodifico, pro_personacreo, pro_fechapersonamodifico, pro_sectoradministrativo)
								VALUES ('".$codigo_programas."', '".$nombre_programa."', 'NA', 'NA', NOW(), NOW(), '".$persona_ingreso."', '".$persona_ingreso."', '".$codigo_sector."');";
				//echo ord($apellidos)." $apellidos"."<br>";
				
				//echo  mb_detect_encoding($apellido ). "<br />";
		
				echo $sql_insertar."<br>";				
				//pg_query($conexion,$sql_insertar);
				
		$aleatorio++;
	}
		echo "<br><br>OK";
}


?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<form action="subir_programas.php" method="post">
<input type="text" name="variable" id="variable" />
<input type="submit" value="insertar" />
</form>
</body>
</html>
