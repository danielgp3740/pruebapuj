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
$data->read('../docexcel/metas_producto_territorial.xls');

$data->sheets[x][y];

// Numero de columnas de la hoja
$columnas=$data->sheets[0]['numCols']; 
$filas=$data->sheets[0]['numRows']; 

$data->sheets[0]['cellsInfo'][3][4]['raw']; 
$data->sheets[0]['cellsInfo'][3][4]['type'];

	$aleatorio=1;
	for($d_filas=2;$d_filas<=$filas;$d_filas++){
		
  			//$dep_codigo=$data->sheets[0]['cells'][$d_filas][1];
			$meta_resultado=utf8_encode($data->sheets[0]['cells'][$d_filas][1]);
			$descripcion_metaproducto=utf8_encode($data->sheets[0]['cells'][$d_filas][2]);
			$linea_base=$data->sheets[0]['cells'][$d_filas][3];
			$meta_cuatrenio=$data->sheets[0]['cells'][$d_filas][4];
  			$persona_ingreso='201604271746001';
			
			
			//$aleatorio=rand(100, 900);
			$codigo=date('YmdHis');
			$codigo_metaproducto=$codigo.$aleatorio;
			
			//echo mb_detect_encoding($nombre_sector)."<br>";
			
			
			
			$sql_mresultadocodigo=" SELECT mre_codigo
								FROM meta_resultado
								WHERE mre_descripcion LIKE '%".mb_convert_encoding($meta_resultado, 'UTF-8', mb_detect_encoding($meta_resultado))."%';";
			$query_mresultadocodigo=$cnxn_pag->ejecutar($sql_mresultadocodigo);
			
			//echo $sql_mresultadocodigo."<br>";				
				
			
			$data_mresultadocodigo=$cnxn_pag->obtener_filas($query_mresultadocodigo);
			$codigo_mresultado=$data_mresultadocodigo['mre_codigo'];
			
				$sql_insertar="	INSERT INTO meta_producto(mpr_codigo, mpr_descripcion, mpr_lineabase, mpr_valorcuatrenio, mpr_personacreo, mpr_personamodifico, mpr_fechacreo, mpr_fechamodifico, mpr_metaresultado)
								VALUES ('".$codigo_metaproducto."', '".$descripcion_metaproducto."', ".$linea_base.", ".$meta_cuatrenio.", '".$persona_ingreso."', '".$persona_ingreso."', NOW(), NOW(), '".$codigo_mresultado."'); ";
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
<form action="subir_metasproducto_territorial.php" method="post">
<input type="text" name="variable" id="variable" />
<input type="submit" value="insertar" />
</form>
</body>
</html>


