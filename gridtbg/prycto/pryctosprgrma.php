<?php

$persona_entidad=$_SESSION['entidad_persona'];

//$lista_proyectosprograma=$proyecto_sql->proyectoprograma_sql($cnxn_pag, $codigoproyecto, $persona_entidad, $codigoprograma);
$lista_programas=$proyecto_sql->programaentidadproyecto($cnxn_pag, $codigoentidad, $codigoprograma);


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

                	<!-- ---------------------------------------------------------------------------- INTERNA RECUADRO ---------------------------------------------------------------------------- -->
                    <div class="recuadro">
                    	<div class="titulo">

                          <img src="<?php echo $imagen_procemodulo; ?>" /> <?php echo $nombre_modulosytem; ?>

                        </div>
                        <div class="dentro">
                        <div class="col-md-12">

                          <div class="col-md-4">
                            <label>Programa</label>
                            <div class="combo" id="idlist_municipio">
                            <select id="sel_programa" name="sel_programa" title="Seleccione el Programa" required="" aria-required="true" class="valid" aria-invalid="false" onchange="buscarprograma();" >
                              <option value="">Seleccione:</option>
                              <?php
                                $numeroPrograma=1;
                                while($data_programa=$cnxn_pag->obtener_filas($lista_programas)){
                                    $pro_codigo=$data_programa['pro_codigo'];
                                    $pro_nombre=$data_programa['pro_nombre'];

                                    ?>

                                      <option value="<?php echo $pro_codigo ?>"><?php echo $numeroPrograma.". ".$pro_nombre  ?></option>
                                    <?php

                                    $numeroPrograma++;

                                }

                              ?>
                            </select>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <label>Vigencia</label>
                            <div class="combo" id="idlist_municipio">
                            <select id="sel_vigencia" name="sel_vigencia" onchange="buscarprograma();" title="Seleccione la vigencia" required="" aria-required="true" class="valid" aria-invalid="false" >
                              <option value="">Seleccione:</option>
                              <option value="2017">2017</option>
                              <option value="2018">2018</option>
                            </select>
                            </div>
                          </div>

                        </div>

                          <!--
                          <a class="exc" href='reportesemaforoentidad'><img src='img/excel_icono.png' alt='Generar Excel - Semaforo' title="Generar Excel - Semaforo"> Generar Excel - Semaforo</a>
                          -->
                          <div class="dataprogramas">
                              <?php
                                include('gridtbg/prycto/listpryctos.php');
                              ?>
                          </div>

                        </div>

                        <script type="text/javascript">

                            function buscarprograma(){
                              var codigo_programa=$('#sel_programa').val();
                              var vigencia=$('#sel_vigencia').val();

                              //alert(codigo_programa);


                              $.ajax({
                                url:"listaprogramaproyectos",
                                type:"POST",
                                data:"codigo_programa="+codigo_programa+"&vigencia="+vigencia,
                                async:true,

                                success: function(message){
                                  $(".dataprogramas").empty().append(message);
                                }
                              });

                            }

                        </script>
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
