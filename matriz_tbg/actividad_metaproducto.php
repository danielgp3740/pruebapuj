<?php
include('../lbr/sgltn.php');

include ('../lbr/dtos_srvdor.php');

$codigo_metaproducto=$_REQUEST['codigo_metaproducto'];





$sql_metaproducto="SELECT mpr_codigo, mpr_descripcion, mpr_lineabase, mpr_valorcuatrenio, 
				   mpr_personacreo, mpr_personamodifico, mpr_fechacreo, mpr_fechamodifico, 
				   mpr_metaresultado
			  FROM meta_producto
			  WHERE mpr_codigo='".$codigo_metaproducto."';";

			$query_metaproducto=$cnxn_pag->ejecutar($sql_metaproducto);

$data_metaproducto=$cnxn_pag->obtener_filas($query_metaproducto);
		
				$mpr_codigo=$data_metaproducto['mpr_codigo'];
				$mpr_descripcion=$data_metaproducto['mpr_descripcion'];
				$mpr_lineabase=$data_metaproducto['mpr_lineabase'];
				$mpr_valorcuatrenio=$data_metaproducto['mpr_valorcuatrenio'];
				
				$valor_esperado=abs($mpr_valorcuatrenio-$mpr_lineabase);
				



$sql_tipofrecuencia=" SELECT tfr_codigo, tfr_descripcion
						FROM tipo_frecuencia
						WHERE tfr_codigo IN (3,4,5); ";

$query_tipofrecuencia=$cnxn_pag->ejecutar($sql_tipofrecuencia);				
				

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Actidades de Meta de Producto</title>
</head>

<body>

<h3>Meta del Producto: <?php echo $mpr_descripcion; ?></h3>
<h3>Valor Esperado: <?php echo $valor_esperado; ?></h3>

	<form>
	
		<label>Actividad</label><br>
		<textarea name='txt_descripcion' id='txt_descripcion' cols='60' rows='10'></textarea>
		
		<p></p>
		
		
		<label>Tipo de Frecuencia</label>
		<select>
			<option value='0'>Seleccione...</option>
			
			<?php
				
				while($data_tipofrecuencia=$cnxn_pag->obtener_filas($query_tipofrecuencia)){
					
					$tfr_codigo=$data_tipofrecuencia['tfr_codigo'];
					$tfr_descripcion=$data_tipofrecuencia['tfr_descripcion'];
					
					echo "<option value='$tfr_codigo'>$tfr_descripcion</option>";
					
				}
		
				
			?>
		</select>		
		<p></p>
		
		<label>Fecha Inicio</label><br>
		<input type='date' name='txt_fechainicio' id='txt_fechainicio'/>
		<p></p>
		
		<label>Fecha Final</label><br>
		<input type='date' name='txt_fechafinal' id='txt_fechafinal'/>
		<p></p>				
			<input type='submit' value='Guardar' />
	
	
	</form>


</body>
</html>