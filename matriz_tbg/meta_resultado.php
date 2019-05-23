<?php
include('../lbr/sgltn.php');

include ('../lbr/dtos_srvdor.php');

$codigo_programa=$_REQUEST['codigo_programa'];

$sql_programa="SELECT pro_codigo, pro_nombre, pro_descripcion, pro_objetivo, pro_fechacreo, 
       pro_fechamodifico, pro_personacreo, pro_sectoradministrativo, 
       pro_fechapersonamodifico, sad_nombre, eac_nombre
  FROM programa,sector_administrativo, escenario_actuacion
  WHERE  pro_codigo='".$codigo_programa."' 
  AND  pro_sectoradministrativo=sad_codigo
  AND sad_escenarioactuacion=eac_codigo ;";

$query_programa=$cnxn_pag->ejecutar($sql_programa);

$data_programa=$cnxn_pag->obtener_filas($query_programa);
$pro_nombre=$data_programa['pro_nombre'];
$sad_nombre=$data_programa['sad_nombre']; 
$eac_nombre=$data_programa['eac_nombre'];

$sql_metaresultado="SELECT mre_codigo, mre_descripcion, mre_lineabase, mre_valorcuatrenio, 
       mre_personacreo, mre_personamodifico, mre_fechamodifico, mre_fechacreo, 
       mre_programa
  FROM meta_resultado
  WHERE mre_programa='".$codigo_programa."'; ";

$query_metaresultado=$cnxn_pag->ejecutar($sql_metaresultado);


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Meta Resultado <?php echo $pro_nombre; ?></title>
</head>

<body>


<h2>Escenario de Actuación Prioritaria: <?php echo $eac_nombre; ?></h2>
<h2>Sector Administrativo: <?php echo $sad_nombre; ?></h2>
<h2>Programa: <?php echo $pro_nombre; ?></h2>
<h2>Metas de Resultados</h2>


	<?php
		
		$item=1;
		while($data_metaresultado=$cnxn_pag->obtener_filas($query_metaresultado)){
		
			$sad_codigo=$data_metaresultado['mre_codigo'];
			$sad_nombre=$data_metaresultado['mre_descripcion'];
			$mre_lineabase=$data_metaresultado['mre_lineabase'];
			$mre_valorcuatrenio=$data_metaresultado['mre_valorcuatrenio'];
			
			
			
			
			
			$sql_metaproducto="SELECT mpr_codigo, mpr_descripcion, mpr_lineabase, mpr_valorcuatrenio, 
				   mpr_personacreo, mpr_personamodifico, mpr_fechacreo, mpr_fechamodifico, 
				   mpr_metaresultado
			  FROM meta_producto
			  WHERE mpr_metaresultado='".$sad_codigo."';";

			$query_metaproducto=$cnxn_pag->ejecutar($sql_metaproducto);

			
			if($mre_lineabase<$mre_valorcuatrenio){
				
				$comportamiento_imagen="incremento.png";
				
				
			}
			elseif($mre_lineabase>$mre_valorcuatrenio){
				
				$comportamiento_imagen="reduccion.png";
			}
			else{
				
				$comportamiento_imagen="mantener.png";
				
			}
			
			//echo $item.". ".$sad_nombre."<br>";
			echo $item.". <a href='meta_producto.php?codigo_programa=".$sad_codigo."' target='_blank'>".$sad_nombre."</a> | Linea Base: ".$mre_lineabase." | Valor Cuatrenio: ".$mre_valorcuatrenio." <img src='images/".$comportamiento_imagen."' border='0'><br>";
			
			echo "<h3>Metas de Producto</h3>";
			
			echo "<table border='1'>";
				
				echo "<tr>";
				echo "<th>No</th>";
				echo "<th>Descripción</th>";
				echo "<th>Linia Base</th>";
				echo "<th>Valor Cuatrenio</th>";
				echo "<th>Comporamiento</th>";
				echo "<th>Actividad</th>";
				echo "</tr>";
				
				
			$item_mp=1;
			while($data_metaproducto=$cnxn_pag->obtener_filas($query_metaproducto)){
		
				$mpr_codigo=$data_metaproducto['mpr_codigo'];
				$mpr_descripcion=$data_metaproducto['mpr_descripcion'];
				$mpr_lineabase=$data_metaproducto['mpr_lineabase'];
				$mpr_valorcuatrenio=$data_metaproducto['mpr_valorcuatrenio'];
				
				if($mpr_lineabase<$mpr_valorcuatrenio){
				
					$comportamiento_imagen="incremento.png";
				
				
				}
				elseif($mpr_lineabase>$mpr_valorcuatrenio){
				
					$comportamiento_imagen="reduccion.png";
				}
				else{
				
					$comportamiento_imagen="mantener.png";
				
				}
				
			
				echo "<tr>";
				
				echo "<td>".$item_mp."</td><td>".$mpr_descripcion."</td><td>".$mpr_lineabase."</td><td>".$mpr_valorcuatrenio."</td><td><img src='images/".$comportamiento_imagen."' border='0'></td>";
				
				echo "<td><a href='actividad_metaproducto.php?codigo_metaproducto=$mpr_codigo' >Agregar</a></td>";
				
				echo "</tr>";
				$item_mp++;
		
			}
			echo "</table>";
				
			
			
			$item++;
		
		}
?>

</body>
</html>