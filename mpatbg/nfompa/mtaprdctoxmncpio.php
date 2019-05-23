<?php
// https://youtu.be/XXjzfs70-gA video tbg

$municipioId=$_REQUEST['codigo_municipio'];
$meproId=$_REQUEST['codigo_metaproducto'];
$persona_entidad=$_SESSION['entidad_persona'];
//echo $meproId;
if ($municipioId==0) {
	$nombre_formamapa="Departamento del Huila";
}
else {
	$munmepro=$principal_sql->municipioid($cnxn_pag, $municipioId);
	$data_munmepro=$cnxn_pag->obtener_filas($munmepro);
	$mun_nombre=$data_munmepro['mun_nombre'];

	if($municipioId==1){
		$nombre_formamapa="Departamento: ".$mun_nombre;
	}
	else {
		$nombre_formamapa="Municipio: ".$mun_nombre;
	}
}

$mepro=$principal_sql->meproid($cnxn_pag, $meproId);
$data_mepro=$cnxn_pag->obtener_filas($mepro);
$mpr_descripcion=$data_mepro['mpr_descripcion'];

?>
<div class="recuadro">

<div class="titulo" id="titulo">
	<?php echo $nombre_formamapa;  ?>
</div>
<div class="espacio al80"></div>
<div style="width:100%; font-size:120%; " class="bg-title">
	<strong>Meta de Producto: <?php echo $mpr_descripcion; ?></strong>
</div>


<h3><img src="img/ico/inf-fuentes.png" /> Valor Ejecutado</h3>
<?php
	$year_actual=date('Y');
	for ($year_valor=2016; $year_valor <= $year_actual; $year_valor++) {

			//echo ""

			$mepromunicipio= $mapa_sql->mapamepro_municipiovijencia($cnxn_pag, $municipioId, $meproId, $persona_entidad, $year_valor);
			$total_videncia[$year_valor]=0;
			while($data_mepromunicipio=$cnxn_pag->obtener_filas($mepromunicipio)){
					$valor_ejecutado=$data_mepromunicipio['vej_valor'];
					//echo $valor_ejecutado." <br> ";
					$total_videncia[$year_valor]=$valor_ejecutado+$total_videncia[$year_valor];
			}

			echo "<p style='margin-left:20px;'><strong>Vigencia ".$year_valor.": </strong>".$total_videncia[$year_valor]."</p>";

	}
?>
<hr />
<h3><img src="img/ico/inf-ejecutado.png" /> Fuentes de Financión</h3>
<ul class="triVerde">
	<?php

	$fuentefinanciacion=$mapa_sql->fuentefinanciacionmun($cnxn_pag, $municipioId, $meproId, $persona_entidad, $year_valor);

		while($data_fuentefinanciacion=$cnxn_pag->obtener_filas($fuentefinanciacion)){
			$ffi_codigo=$data_fuentefinanciacion['ffi_codigo'];
			$ffi_descripcion=$data_fuentefinanciacion['ffi_descripcion'];
			$year_actual=date('Y');

	?>

			<li>
		      <h4  style='margin-left:10px;'><?php echo $ffi_descripcion;  ?></h4>
					<?php
						for($year_valor=2016; $year_valor <= $year_actual; $year_valor++) {
							$valor_fuentefinanciacion=$mapa_sql->mapa_munfifu($cnxn_pag, $municipioId, $meproId, $ent_codigo, $year_valor, $ffi_codigo);
							//echo $valor_fuentefinanciacion;
							$totalvalor_fifu=0;
								while ($data_vfifu=$cnxn_pag->obtener_filas($valor_fuentefinanciacion)){
										$valor_fifu=$data_vfifu['mfu_valor'];
										$totalvalor_fifu=$totalvalor_fifu+$valor_fifu;
										//echo $valor_fifu."<br>";
					?>
					<?php
							}
					?>
						<p style='margin-left:20px;'><strong>Vigencia <?php echo $year_valor ?>: </strong>$<?php echo number_format($totalvalor_fifu, 2, ',', '.'); ?></p>

					<?php
						}
					?>
		  <li>

	<?php

		}

	?>
<!--
  <li>
      <h4>Recursos Propios</h4>
      <p>$000.000</p>
  <li>
      <h4>Recursos Nacionales</h4>
      <p>$000.000</p>
  </li>
-->
</ul>
<hr />
<h3><img src="img/ico/inf-genero.png" /> Población por Género</h3>
<ul class="triVerde">

	<?php

			$genero=$mapa_sql->genero_municipio($cnxn_pag,  $municipioId, $meproId, $ent_codigo, $vigencia, $genero);
			while($data_genero=$cnxn_pag->obtener_filas($genero)){
				$plg_codigo=$data_genero['plg_codigo'];
				$plg_nombre=$data_genero['plg_nombre'];
				$year_actual=date('Y');

	?>
	<li>
	<h4  style='margin-left:10px;'><?php echo $plg_nombre;  ?></h4>
	<?php
				for($year_valor=2016; $year_valor <= $year_actual; $year_valor++) {
					$generovigencia=$mapa_sql->mapa_genero($cnxn_pag, $municipioId, $meproId, $ent_codigo, $year_valor, $plg_codigo);
					$totalvalor_genero=0;
					//echo $generovigencia;
					while($data_generovigencia=$cnxn_pag->obtener_filas($generovigencia)){
						$mge_valor=$data_generovigencia['mge_valor'];
						$totalvalor_genero=$totalvalor_genero+$mge_valor;
	?>


	<?php
					}
	?>
						<p style='margin-left:20px;'>
								<strong>Vigencia <?php echo $year_valor ?>: </strong>
								<?php echo  number_format($totalvalor_genero, 0, ',', '.'); ?>
						</p>
	<?php
				}
	?>
	</li>
	<?php
			}

	?>
</ul>
<hr />
<h3><img src="img/ico/inf-victima.png" /> Población por Víctima</h3>
<ul class="triVerde">

	<?php

			$victimas=$mapa_sql->munvictimas($cnxn_pag,  $municipioId, $meproId, $ent_codigo, $vigencia, $victima);
			while($data_victimas=$cnxn_pag->obtener_filas($victimas)){
				$pvi_codigo=$data_victimas['pvi_codigo'];
				$pvi_nombre=$data_victimas['pvi_nombre'];
				$year_actual=date('Y');

	?>
	<li>
	<h4  style='margin-left:10px;'><?php echo $pvi_nombre;  ?></h4>
	<?php
				for($year_valor=2016; $year_valor <= $year_actual; $year_valor++) {
					$victimavigencia=$mapa_sql->valor_victimasmun($cnxn_pag, $municipioId, $meproId, $ent_codigo, $year_valor, $pvi_codigo);
					$totalvalor_victima=0;
					//echo $generovigencia;
					while($data_victimavigencia=$cnxn_pag->obtener_filas($victimavigencia)){
						$mvi_valor=$data_victimavigencia['mvi_valor'];
						$totalvalor_victima=$totalvalor_victima+$mvi_valor;
	?>


	<?php
					}
	?>
						<p style='margin-left:20px;'>
								<strong>Vigencia <?php echo $year_valor ?>: </strong>
								<?php echo  number_format($totalvalor_victima, 0, ',', '.'); ?>
						</p>
	<?php
				}
	?>
	</li>
	<?php
			}

	?>
</ul>
<hr />
<h3><img src="img/ico/inf-discapacidad.png" /> Población por Discapacidad</h3>
<ul class="triVerde">
	<?php

			$discapacidad=$mapa_sql->mundiscapacidad($cnxn_pag,  $municipioId, $meproId, $ent_codigo, $vigencia, $discapacidad);
			//echo $discapacidad;
			while($data_discapacidad=$cnxn_pag->obtener_filas($discapacidad)){
				$tdi_codigo=$data_discapacidad['tdi_codigo'];
				$tdi_nombre=$data_discapacidad['tdi_nombre'];
				$year_actual=date('Y');

	?>
	<li>
	<h4  style='margin-left:10px;'><?php echo $tdi_nombre;  ?></h4>
	<?php
				for($year_valor=2016; $year_valor <= $year_actual; $year_valor++) {
					$discapacidadvigencia=$mapa_sql->valormun_discapacidad($cnxn_pag, $municipioId, $meproId, $ent_codigo, $year_valor, $tdi_codigo);
					$totalvalor_discapacidad=0;
					//echo $discapacidadvigencia;
					while($data_discapacidadvigencia=$cnxn_pag->obtener_filas($discapacidadvigencia)){
						$mdi_valor=$data_discapacidadvigencia['mdi_valor'];
						$totalvalor_discapacidad=$totalvalor_discapacidad+$mdi_valor;
	?>


	<?php
					}
	?>
						<p style='margin-left:20px;'>
								<strong>Vigencia <?php echo $year_valor ?>: </strong>
								<?php echo  number_format($totalvalor_discapacidad, 0, ',', '.'); ?>
						</p>
	<?php
				}
	?>
	</li>
	<?php
			}

	?>

</ul>
<hr />
<h3><img src="img/ico/inf-etnica.png" /> Población por Etnica</h3>
<ul class="triVerde">

	<?php

			$etnia=$mapa_sql->munetnia($cnxn_pag,  $municipioId, $meproId, $ent_codigo, $vigencia, $etnia);
			//echo $discapacidad;
			while($data_etnia=$cnxn_pag->obtener_filas($etnia)){
				$pet_codigo=$data_etnia['pet_codigo'];
				$pet_nombre=$data_etnia['pet_nombre'];
				$year_actual=date('Y');

	?>
	<li>
	<h4  style='margin-left:10px;'><?php echo $pet_nombre;  ?></h4>
	<?php
				for($year_valor=2016; $year_valor <= $year_actual; $year_valor++) {
					$etniavigencia=$mapa_sql->valormun_etnia($cnxn_pag, $municipioId, $meproId, $ent_codigo, $year_valor, $pet_codigo);
					$totalvalor_etnia=0;
					//echo $discapacidadvigencia;
					while($data_etniavigencia=$cnxn_pag->obtener_filas($etniavigencia)){
						$met_valor=$data_etniavigencia['met_valor'];
						$totalvalor_etnia=$totalvalor_etnia+$met_valor;
	?>


	<?php
					}
	?>
						<p style='margin-left:20px;'>
								<strong>Vigencia <?php echo $year_valor ?>: </strong>
								<?php echo  number_format($totalvalor_etnia, 0, ',', '.'); ?>
						</p>
	<?php
				}
	?>
	</li>
	<?php
			}

	?>


</ul>
</div>
