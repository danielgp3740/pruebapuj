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
$data->read('../docexcel/metasresultado.xls');

$data->sheets[x][y];

// Numero de columnas de la hoja
$columnas=$data->sheets[0]['numCols']; 
$filas=$data->sheets[0]['numRows']; 

$data->sheets[0]['cellsInfo'][3][4]['raw']; 
$data->sheets[0]['cellsInfo'][3][4]['type'];

	$aleatorio=1;
	for($d_filas=2;$d_filas<=$filas;$d_filas++){
		
  			//$dep_codigo=$data->sheets[0]['cells'][$d_filas][1];
			//$cod_programa=$data->sheets[0]['cells'][$d_filas][9];
			$nombre_programa=utf8_encode(strtolower($data->sheets[0]['cells'][$d_filas][1]));
			$descripcion_metaresultado=utf8_encode($data->sheets[0]['cells'][$d_filas][2]);
			$indicador_metaresultado=utf8_encode($data->sheets[0]['cells'][$d_filas][3]);
			$linea_base=$data->sheets[0]['cells'][$d_filas][4];
			$meta_cuatrenio=$data->sheets[0]['cells'][$d_filas][5];
  			$persona_ingreso='201604271746001';
			
			//echo "<br>".$nombre_programa ."<br><br>";
			
			//$aleatorio=rand(100, 900);
			$codigo=date('YmdHis');
			$codigo_metaresultado=$codigo.$aleatorio;
			
			//echo mb_detect_encoding($nombre_sector)."<br>"; '%".strtolower(mb_convert_encoding($nombre_programa, 'UTF-8', mb_detect_encoding($nombre_programa)))."%'
			
			
			
			$sql_programacodigo=" SELECT pro_codigo
								FROM programa
								WHERE lower(pro_nombre) LIKE '%".$nombre_programa."%';";
			$query_programacodigo=$cnxn_pag->ejecutar($sql_programacodigo);
			
			//echo $sql_programacodigo."<br><br>";				
				
			
			$data_programacodigo=$cnxn_pag->obtener_filas($query_programacodigo);
			$codigo_programa=$data_programacodigo['pro_codigo'];
			
				$sql_insertar="INSERT INTO meta_resultado(mre_codigo, mre_descripcion, mre_lineabase, mre_valorcuatrenio, mre_personacreo, mre_personamodifico, mre_fechamodifico, mre_fechacreo, mre_programa, mre_codificacion, mre_indicador, mre_dmri1, mre_dmri2)
								VALUES ('".$codigo_metaresultado."', '".$descripcion_metaresultado."', ".$linea_base.", ".$meta_cuatrenio.", '".$persona_ingreso."', '".$persona_ingreso."', NOW(), NOW(), '".$codigo_programa."','NA', '".$indicador_metaresultado."', 'NA', 'NA'); ";
						
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
<form action="subir_metasresultado.php" method="post">
<input type="text" name="variable" id="variable" />
<input type="submit" value="insertar" />
</form>
</body>
</html>


