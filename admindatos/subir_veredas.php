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
$data->read('../docexcel/veredas_huila.xls');

$data->sheets[x][y];

// Numero de columnas de la hoja
$columnas=$data->sheets[0]['numCols']; 
$filas=$data->sheets[0]['numRows']; 

$data->sheets[0]['cellsInfo'][3][4]['raw']; 
$data->sheets[0]['cellsInfo'][3][4]['type'];

	$aleatorio=1;
	for($d_filas=4;$d_filas<=$filas;$d_filas++){
		
  			//$dep_codigo=$data->sheets[0]['cells'][$d_filas][1];
			//$cod_programa=$data->sheets[0]['cells'][$d_filas][9];
			$nombre=utf8_encode($data->sheets[0]['cells'][$d_filas][4]);
			$codigo_dane=$data->sheets[0]['cells'][$d_filas][2];
			
			
  			$persona_ingreso='201604271746001';
			
			//echo "<br>".$nombre_programa ."<br><br>";
			
			//$aleatorio=rand(100, 900);
			$codigo=date('YmdHis');
			$codigo_metaresultado=$codigo.$aleatorio;
			
			//echo mb_detect_encoding($nombre_sector)."<br>"; '%".strtolower(mb_convert_encoding($nombre_programa, 'UTF-8', mb_detect_encoding($nombre_programa)))."%'
			
			
			
			$sql_municipio=" SELECT mun_nombre, dep_codigo, mun_dane, mun_codigo
								  FROM municipio
								  WHERE mun_dane='$codigo_dane';";
			$query_municipio=$cnxn_pag->ejecutar($sql_municipio);
			
			//echo $sql_programacodigo."<br><br>";				
				
			
			$data_municipio=$cnxn_pag->obtener_filas($query_municipio);
			$codigo_municipio=$data_municipio['mun_codigo'];
			
				$sql_insertar="INSERT INTO centro_poblado(cpo_codigo, cpo_municipio, cpo_nombre)
								VALUES (".$codigo_metaresultado.", '".$codigo_municipio."', '".$nombre."'); ";
						
				echo $sql_insertar."<br>";				
				
				
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
<form action="subir_veredas.php" method="post">
<input type="text" name="variable" id="variable" />
<input type="submit" value="insertar" />
</form>
</body>
</html>


