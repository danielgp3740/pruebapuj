<?php


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
$data->read('../docexcel/ods_producto.xls');

$data->sheets[x][y];

// Numero de columnas de la hoja
$columnas=$data->sheets[0]['numCols']; 
$filas=$data->sheets[0]['numRows']; 

$data->sheets[0]['cellsInfo'][3][4]['raw']; 
$data->sheets[0]['cellsInfo'][3][4]['type'];

	$aleatorio=1;
	for($d_filas=4;$d_filas<=$filas;$d_filas++){
		
  			//$dep_codigo=$data->sheets[0]['cells'][$d_filas][1];
			$codigo_odsproducto=$data->sheets[0]['cells'][$d_filas][1];//utf8_encode($data->sheets[0]['cells'][$d_filas][1]);
			$descripcion_odsproducto=utf8_encode($data->sheets[0]['cells'][$d_filas][2]);
			//$linea_base=$data->sheets[0]['cells'][$d_filas][4];
			//$meta_cuatrenio=$data->sheets[0]['cells'][$d_filas][5];
  			//$persona_ingreso='201604271746001';
			
			
			//$aleatorio=rand(100, 900);
			$codigo=date('YmdHis');
			$codigo_metaresultado=$codigo.$aleatorio;
			
			//echo mb_detect_encoding($nombre_sector)."<br>";
			
			
			
			$sql_programacodigo=" SELECT pro_codigo
								FROM programa
								WHERE pro_nombre LIKE '%".mb_convert_encoding($nombre_programa, 'UTF-8', mb_detect_encoding($nombre_programa))."%';";
			$query_programacodigo=$cnxn_pag->ejecutar($sql_programacodigo);
			
			//echo $sql_programacodigo."<br>";				
				
			
			$data_programacodigo=$cnxn_pag->obtener_filas($query_programacodigo);
			$codigo_programa=$data_programacodigo['pro_codigo'];
			
				$sql_insertar="INSERT INTO ods_producto(ods_codigo, ods_descripcion, ods_personacreo, ods_personamodifico, ods_fechacreo, ods_fechamodifico)
								VALUES (".$codigo_odsproducto.", '".$descripcion_odsproducto."', '201604281729001', '201604281729001', NOW(), NOW()); ";
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
<form action="subir_odsproducto.php" method="post">
<input type="text" name="variable" id="variable" />
<input type="submit" value="insertar" />
</form>
</body>
</html>




