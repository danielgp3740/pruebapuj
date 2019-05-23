<?php
include('../lbr/sgltn.php');

include ('../lbr/dtos_srvdor.php');


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
		
		<label>Valor Programado</label><br>
		<input type='text' name='txt_valor' id='txt_valor'/>
		<p></p>
		
		
		
	
	
	</form>


</body>
</html>