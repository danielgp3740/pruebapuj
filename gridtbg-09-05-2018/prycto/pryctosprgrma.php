<?php

$persona_entidad=$_SESSION['entidad_persona'];

$lista_proyectosprograma=$proyecto_sql->proyectoprograma_sql($cnxn_pag, $codigoproyecto, $persona_entidad, $codigoprograma);



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
                          <!--
                          <a class="exc" href='reportesemaforoentidad'><img src='img/excel_icono.png' alt='Generar Excel - Semaforo' title="Generar Excel - Semaforo"> Generar Excel - Semaforo</a>
                          -->


                            <?php
                            $numero_entidad=1;
                              while($data_proyectosprograma=$cnxn_pag->obtener_filas($lista_proyectosprograma)){
                                  $ppr_codigo=$data_proyectosprograma['ppr_codigo'];
                                  $pro_nombre=$data_proyectosprograma['pro_nombre'];
                                  $ppr_nombre=$data_proyectosprograma['ppr_nombre'];
                                  $ppr_vigencia=$data_proyectosprograma['ppr_vigencia'];
                                  $ppr_numeropersonaobjetiva=$data_proyectosprograma['ppr_numeropersonaobjetiva'];

                            ?>
                              <table class="tablaRecoge" data-codigo="<?php echo $ppr_codigo; ?>">
                            <thead>
                                <tr>
                                <td colspan="8" style="text-align:left; ">
                                  <?php echo $numero_entidad; ?>. <strong> Programa:</strong> <?php echo $pro_nombre; ?> | <strong> Proyecto:</strong> <?php echo $ppr_nombre; ?> | <strong> No Personas Objetivo:</strong><?php echo $ppr_numeropersonaobjetiva ?>
                                </td>
                                </tr>
                            <thead>
                              <tbody id="cuerpo_tabla<?php echo $ppr_codigo; ?>" >

                                  <tr>
                                    <td colspan="8">Cargando...</td>
                                  </tr>

                              </tbody>
                            </table>
                            <?php
                            $numero_entidad++;
                              }
                            ?>


                          <script type="text/javascript">
                              $(".tablaRecoge thead").click(function(){
                                var codigo_tabla = $(this).parent().data("codigo");
                                //alert(codigo_tabla);
                                //$(".recuadro").animate({ scrollTop: ($(this).offset().top)-20 }, 500);
                                $(this).siblings('tbody').slideToggle(500);
                                /*
                                $(this).siblings('tbody').slideToggle(1500, function(){
                                  $("html, body").animate({ scrollTop: ($(this).offset().top)-20 }, 500);
                                });
                                */


                                $.ajax({
                                  url:"actividadproyecto",
                                  type:"POST",
                                  data:"codigo_proyecto="+codigo_tabla,
                                  async:true,

                                  success: function(message){
                                    $("#cuerpo_tabla"+codigo_tabla).empty().append(message);
                                  }
                                });

                              });
                          </script>

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
