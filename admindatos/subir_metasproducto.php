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
$data->read('../docexcel/plan_indicativo_editable.xls');

$data->sheets[x][y];

// Numero de columnas de la hoja
$columnas=$data->sheets[0]['numCols']; 
$filas=$data->sheets[0]['numRows']; 

$data->sheets[0]['cellsInfo'][3][4]['raw']; 
$data->sheets[0]['cellsInfo'][3][4]['type'];

	$aleatorio=1;
	for($d_filas=2;$d_filas<=$filas;$d_filas++){
		
  			//$dep_codigo=$data->sheets[0]['cells'][$d_filas][1];
			$meta_codificacion=utf8_encode($data->sheets[0]['cells'][$d_filas][6]);
			$meta_resultado=utf8_encode(strtolower($data->sheets[0]['cells'][$d_filas][11]));
			$descripcion_metaproducto=utf8_encode($data->sheets[0]['cells'][$d_filas][17]);
			$indicador_metaproducto=utf8_encode($data->sheets[0]['cells'][$d_filas][18]);
			$linea_base=$data->sheets[0]['cells'][$d_filas][19];
			$meta_cuatrenio=$data->sheets[0]['cells'][$d_filas][20];
			$secto_fut=utf8_encode(strtolower($data->sheets[0]['cells'][$d_filas][22]));
  			$ods_producto=utf8_encode(strtolower($data->sheets[0]['cells'][$d_filas][24]));

			$vigencia_2016=$data->sheets[0]['cells'][$d_filas][26];
			$vigencia_2017=$data->sheets[0]['cells'][$d_filas][27];
			$vigencia_2018=$data->sheets[0]['cells'][$d_filas][28];
			$vigencia_2019=$data->sheets[0]['cells'][$d_filas][29];
			
  			$persona_ingreso='201604271746001';
			
			
			//$aleatorio=rand(100, 900);
			$codigo=date('YmdHis');
			$codigo_metaproducto=$codigo.$aleatorio;
			
			//echo mb_detect_encoding($nombre_sector)."<br>";
			
			
			
			$sql_mresultadocodigo=" SELECT mre_codigo
								FROM meta_resultado
								WHERE lower(mre_descripcion) LIKE '%".$meta_resultado."%';";
			$query_mresultadocodigo=$cnxn_pag->ejecutar($sql_mresultadocodigo);
			
			//echo $sql_mresultadocodigo."<br>";	 WHERE mre_descripcion LIKE '%".mb_convert_encoding($meta_resultado, 'UTF-8', mb_detect_encoding($meta_resultado))."%';";			
			$data_mresultadocodigo=$cnxn_pag->obtener_filas($query_mresultadocodigo);
			$codigo_mresultado=$data_mresultadocodigo['mre_codigo'];
			
			
			//echo $sql_mresultadocodigo."<br>";
			
			
			$sql_odsproducto=" SELECT ods_codigo, ods_descripcion, ods_personacreo, ods_personamodifico, ods_fechacreo, ods_fechamodifico
							   FROM ods_producto
							   WHERE lower(ods_descripcion) LIKE '%".$ods_producto."%' ;";
			
			$query_odsproducto=$cnxn_pag->ejecutar($sql_odsproducto);
			$data_odsproducto=$cnxn_pag->obtener_filas($query_odsproducto);
			$codigo_odsproducto=$data_odsproducto['ods_codigo'];
			
			//echo $sql_odsproducto."<br>";
			
			
			
			$sql_sectorfut=" SELECT snn_codigo, snn_codificacion, snn_descripcion, snn_personacreo, snn_personamodifico, snn_fechacreo, snn_fechamodifico  
							 FROM sector_nn
							 WHERE lower(snn_descripcion) LIKE '%".$secto_fut."%'; ";
			$query_sectorfut=$cnxn_pag->ejecutar($sql_sectorfut);
			$data_sectorfut=$cnxn_pag->obtener_filas($query_sectorfut);
			$codigo_sectorfut=$data_sectorfut['snn_codigo'];
							 
			//echo $sql_sectorfut."<br><br>";
			
			
				$sql_insertar="	INSERT INTO meta_producto(mpr_codigo, mpr_descripcion, mpr_lineabase, mpr_valorcuatrenio, mpr_personacreo, mpr_personamodifico, mpr_fechacreo, mpr_fechamodifico, mpr_metaresultado,mpr_codificacion, mpr_indicador, mpr_entidadresponsable, mpr_personaresponsable, mpr_sectornn, mpr_odsproducto)
								VALUES ('".$codigo_metaproducto."', '".$descripcion_metaproducto."', ".$linea_base.", ".$meta_cuatrenio.", '".$persona_ingreso."', '".$persona_ingreso."', NOW(), NOW(), '".$codigo_mresultado."', '".$meta_codificacion."', '".$indicador_metaproducto."', 0, 0, ".$codigo_sectorfut.", ".$codigo_odsproducto."); ";
				//echo ord($apellidos)." $apellidos"."<br>";
				
				//echo  mb_detect_encoding($apellido ). "<br />";
		
				echo $sql_insertar."<br><br>";				
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
<form action="subir_metasproducto.php" method="post">
<input type="text" name="variable" id="variable" />
<input type="submit" value="insertar" />
</form>
</body>
</html>


