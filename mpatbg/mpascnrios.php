<?php

		$mapa_escenariofufi = $mapa_sql->escenariofufi_mapaespe($cnxn_pag, $escenario, $municipio, $entidad);
		$mapa_escenarioimpacto = $mapa_sql->escenarioimpacto_mapaespe($cnxn_pag, $escenario, $municipio, $entidad);
		$muni_codigo=1;
 		$mapa_poblacionnumero = $principal_sql->municipioid($cnxn_pag, $muni_codigo);
		$data_poblacion=$cnxn_pag->obtener_filas($mapa_poblacionnumero);
		$mun_poblacion=$data_poblacion['mun_poblacion'];
		// listas los dato por el total inversion por escenario
		$data_numfufi=1;
		while($data_escenariofufi=$cnxn_pag->obtener_filas($mapa_escenariofufi)){
				$eac_codigo[$data_numfufi]=$data_escenariofufi['eac_codigo'];
				$eac_nombre[$data_numfufi]=$data_escenariofufi['eac_nombre'];
				$total_fufi[$data_numfufi]=$data_escenariofufi['total_fifu'];

				$data_numfufi++;

		}

		$data_numimpacto=1;
		while($data_escenarioimpacto=$cnxn_pag->obtener_filas($mapa_escenarioimpacto)){

				$total_impacto[$data_numimpacto]=$data_escenarioimpacto['total_impacto'];

				$data_numimpacto++;

		}

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
<!--<![endif]-->

<head>
	<?php include('prncpal/hdtbg.php'); ?>
  <link href="css/jqvmap.css" media="screen" rel="stylesheet" type="text/css"/>

</head>

<!--<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo"> MENU ABIERTO -->
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-sidebar-closed">

<!-- BEGIN HEADER -->
<div class="page-header -i navbar navbar-fixed-top">
	<?php include('prncpal/hdrtbg.php'); ?>
</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->



<div class="clearfix"></div>



<!-- BEGIN CONTAINER -->
<div class="page-container">

	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<?php include('prncpal/mntbg.php'); ?>
	</div>
	<!-- END SIDEBAR -->



	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">

			<?php include('prncpal/titulomigatbg.php'); ?>


			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">

                	<!-- ---------------------------------------------------------------------------- INTERNA RECUADRO ---------------------------------------------------------------------------- -->
                    <div class="recuadro">
                    	<div class="titulo">
                        	  <img src="<?php echo $imagen_procemodulo; ?>" /> <?php echo $nombre_modulosytem; ?>
                        </div>

                        <div class="dentro">

                        	 <div id="verDestacado">
                            	<!-- FOTO -->
                          	</div>

                            <!-- ESCENARIOS -->

															<div id="escenarios" class="escenarios">
																		<!-- Datos de los escenarios de cada municipio -->
															</div>


                            <!-- fin ESCENARIOS -->

                            <!-- SECTORES -->
                             <div id="sectores" class="escenarios sectores">
                                <!-- Datos de los sectores de cada municipio -->
                            </div>
                            <!-- fin SECTORES -->

                            <!-- PROGRAMAS -->
                            <div id="programas" class="escenarios sectores programas">
															<!-- Datos de los sectores de cada programas -->
                            </div>
                            <!-- fin PROGRAMAS -->

                            <!-- ENTIDADES -->
                            <div id="entidades" class="escenarios sectores">
															<!-- Datos de los sectores de cada entidades -->
                            </div>
                            <!-- fin ENTIDADES -->


                            <!-- MAPA HUILA -->
                        	<div class="bloqIzq">
	                        	<div id="mapaHuila" class="mapaEscenarios"></div>
														<div class="tooltip ">
														 <a href="javascript:void(0)" class="new-btn"><img src="img/ico/flecha_derecha.png"><img src="img/ico/territorial.png"></a>
														 <span class="tooltiptext mphover">
															 Listar metas de proucto del departamento
														 </span>
													 </div>
                            </div>
                        	<div id="sectGral" class="bloqDer">
                                <table>
                                	<tr>
                                    		<th>Escenario</th>
                                    		<th>Total Invertido</th>
                                    		<th>Población Beneficiada</th>
                                  </tr>
																	<?php
																	/*
																	foreach ($lisact as $data_lisact){
																		$act_codigo=$data_lisact['act_codigo'];
																	*/
																		for($dataescenario=1; $dataescenario<$data_numfufi; $dataescenario++){
																				$codigo_escenario=$eac_codigo[$dataescenario];
																				$nombre_escenario=$eac_nombre[$dataescenario];
																				$fufi_escenario=$total_fufi[$dataescenario];
																				$impacto_escenario=$total_impacto[$dataescenario];

																				if($mun_poblacion > $total_impacto[$dataescenario]){
																					$impacto_escenario=$total_impacto[$dataescenario];
																				}
																				else {
																					$impacto_escenario=$mun_poblacion;
																				}

																	?>
																			<tr>
		                                    <td class="titul verVentana" data-escenario="<?php echo $codigo_escenario; ?>"  data-nameescenario="<?php echo $nombre_escenario; ?>" > <?php echo $nombre_escenario; ?> </td>
		                                    <td> <img src="img/ico/inf-ejecutado.png" /> $<?php echo  number_format($fufi_escenario, 0, '.', '.'); ?> </td>
		                                    <td> <img src="img/ico/inf-genero.png" /> <?php echo  number_format($impacto_escenario, 0, '.', '.'); ; ?> </td>
		                                  </tr>
																<?php

																		}

																	?>

                                </table>
                            </div>
                            <!-- fin MAPA HUILA -->

                            <link rel="stylesheet" href="css/mapa-escenarios.css" type="text/css" />
							  						<script type="text/javascript" src="js/jquery.vmap.js"></script>
                            <script type="text/javascript" src="js/huila.js"></script>
                            <script type="text/javascript" src="js/mapa-escenarios.js"></script>
                        </div>
                    </div>
                	<!-- ---------------------------------------------------------------------------- fin INTERNA RECUADRO ---------------------------------------------------------------------------- -->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->

	<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->



<!-- BEGIN FOOTER -->
<div class="page-footer">
	<?php include('prncpal/ftrtbg.php'); ?>
</div>
<!-- END FOOTER -->


</body>
</html>
