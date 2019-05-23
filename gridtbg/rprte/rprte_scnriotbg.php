<?php
$persona_entidad=$_SESSION['entidad_persona'];
    $escenario_administrativo = $principal_sql->escenarioAdmin($cnxn_pag, $codigo_escenarioadministrivoo);


?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
<!--<![endif]-->

<head>
  <!-- HEAD -->
  <?php include('prncpal/hdtbg.php'); ?>
  <script type="text/javascript" src="js/orden_tabla.js"></script>
</head>

<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-sidebar-closed">

<!-- BEGIN HEADER -->
<div class="page-header -i navbar navbar-fixed-top">

  <?php include('prncpal/hdrtbg.php'); ?>

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

          <div class="help">
             <div id="men-help" data-toggle="tooltip" title="Convenciones"></div>
                  <ul>
                          <div class="box-conv">
                               <table class="conv" id="conv2">
                                    <tr >
                                      <th colspan="2"> <h4>Convenciones </h4></th>
                                    </tr>
                                    <tr>
                                    <td> Entidad</td>
                                    <td> E </td>
                                    </tr>
                                    <tr>
                                    <td> Meta Producto</td>
                                    <td> MP </td>
                                    </tr>
                                    <tr>
                                    <td> Meta Cuatrenio </td>
                                    <td> MC</td>
                                    </tr>
                                    <tr>
                                    <td> Vigencia</td>
                                    <td> V </td>
                                    </tr>
                                    <tr>
                                    <td>Crítico < 40%</td>
                                    <td> <a href="#" class ="new-btn dfn-hover"> <span class="red"></span></a> </td>
                                    </tr>
                                    <tr>
                                    <td> Bajo >=40% y < 60% </td>
                                    <td> <a href="#" class ="new-btn dfn-hover"> <span class="orange"></span></a> </td>
                                    </tr>
                                    <tr>
                                    <td> Medio | >=60% y < 80% </td>
                                    <td> <a href="#" class ="new-btn dfn-hover"> <span class="yellow"></span></a> </td>
                                    </tr>
                                    <tr>
                                    <td> Cumplido | >=80% y <=100% </td>
                                    <td> <a href="#" class ="new-btn dfn-hover"> <span class="green"></span></a> </td>
                                    </tr>
                                     <tr>
                                    <td> Superó meta cuatrenio </td>
                                    <td> <a href="#" class ="new-btn dfn-hover"> <span class="viol"></span></a> </td>
                                    </tr>
                                    <tr>
                                    <td>No se planeó/No se ejecutó </td>
                                    <td> <a href="#" class ="new-btn dfn-hover"> <span class="gray"></span></a> </td>
                                    </tr>
                                    <tr>
                                    <td>Ejecutada sin planeación </td>
                                    <td> <a href="#" class ="new-btn dfn-hover"> <span class="blue"></span></a> </td>
                                    </tr>
                                    <tr>
                                    <td>Descargar Excel </td>
                                    <td> <img src='img/excel_icono.png' alt='Generar Excel' title="Generar Excel"></td>
                                    </tr>

                                    </table>
                                 </div>
                               </ul>
                          </div>


                	<!-- ---------------------------------------------------------------------------- INTERNA RECUADRO ---------------------------------------------------------------------------- -->
                    <div class="recuadro">
                    	<div class="titulo">




                          <img src="<?php echo $imagen_procemodulo; ?>" /> <?php echo $nombre_modulosytem; ?>
                          <?php // echo "Entidad:".$persona_entidad;  ?>
                        </div>
                        <div class="dentro scrol-no">
                          <a class="exc" href='reportesemaforoescenario'><img src='img/excel_icono.png' alt='Generar Excel - Semaforo' title="Generar Excel - Semaforo"> Generar Excel - Semaforo</a>

                          <div class="responsive-tabs fijo">
                            <?php
                              $numero_escenario=1;
                              while($data_escenarioadmin=$cnxn_pag->obtener_filas($escenario_administrativo)){

                                  $eac_codigo=$data_escenarioadmin['eac_codigo'];
                                  $eac_nombre=$data_escenarioadmin['eac_nombre'];
                                  $eac_descripcion=$data_escenarioadmin['eac_descripcion'];

                                  $codigo_escenario[$numero_escenario]=$eac_codigo;


                              ?>
                              <h2>  <div ><?php echo $eac_nombre;  ?></div> </h2>
                              <div>

                                <?php
                                  if($numero_escenario==1){

                                      include('list_rprtexscnrio.php');
                                  }
                                  else{
                                    echo "";
                                  }
                                ?>

                              </div>



                            <?php
                              $numero_escenario++;
                            }
                            ?>

                                <script type="text/javascript" src="js/responsiveTabs.min.js"></script>
                                <script type="text/javascript">
                                  $(document).ready(function(){
                                      RESPONSIVEUI.responsiveTabs();
                                    });
                                </script>

                                <script type="text/javascript">
                                  $(document).ready(function(){

                                    <?php
                                    for($numtab=1; $numtab<$numero_escenario; $numtab++){
                                    ?>
                                      $("#tablist1-tab<?php echo $numtab; ?>").click(function(){
                                          //alert('hola<?php echo $numtab; ?>');

                                          $.ajax({
                                    				url:"listareportexescenario",
                                    				type:"POST",
                                    				data:"codigo_sectroAdmin=<?php echo $codigo_escenario[$numtab]; ?>",
                                    				async:true,

                                    				success: function(message){
                                    					$("#tablist1-panel<?php echo $numtab; ?>").empty().append(message);
                                    				}
                                    			});

                                          // listareportexescenario $("#tablist1-panel1").html("Hola Andresito");
                                      });

                                      <?php
                                        }
                                       ?>
                                  });
                                </script>

                          </div>


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
