<?php

$persona_entidad=$_SESSION['entidad_persona'];

$lista_entidad=$principal_sql->entidad($cnxn_pag, $persona_entidad);



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

  <script type="text/javascript">
        $(document).ready(function(){

            function altura_encimaModal(){
                var alto_encimaModal = $(".encimaModal").height();
                //alert(alto_encimaModal);
                $("#modalContenido").css({ 'height': alto_encimaModal+'px' });
            }

            $(window).resize(function(e){
                altura_encimaModal();
            });


            $(".verModal").click(function(){
                $(".encima").fadeIn(300, function(){
                    $(".encimaModal").fadeIn(300);
                    altura_encimaModal();
                });
            });


            $(".cerrar-modal").click(function(){
                $(".encimaModal").fadeOut(300, function(){
                    $(".encima").fadeOut(300);
                });
            });

            $(".encima").click(function(){
                $(".encimaModal").fadeOut(300, function(){
                    $(".encima").fadeOut(300);
                });
            });
        });
  </script>
</head>

<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-sidebar-closed">

<!-- BEGIN HEADER -->
<div class="page-header -i navbar navbar-fixed-top">

  <?php include('prncpal/hdrtbg.php'); ?>

</div>
<!-- END HEADER -->

<div class="clearfix"></div>


<div class="encima"></div>
   <div class="encimaModal mediano">
       <!-- <a href="javascript:void(0);" class="cerrar-modal">CERRAR</a> -->
       <div id="modalContenido">
           <div class="recuadro">
           </div>
       </div>
   </div>
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


                            <?php
                            $numero_entidad=1;
                              while($data_entidad=$cnxn_pag->obtener_filas($lista_entidad)){
                                  $ent_codigo=$data_entidad['ent_codigo'];
                                  $ent_nombre=$data_entidad['ent_nombre'];
                                  $ent_descripcion=$data_entidad['ent_descripcion'];

                            ?>
                          <table class="tablaRecoge" data-codigo="<?php echo $ent_codigo; ?>">
                            <thead>
                                <tr>
                                <td colspan="8" style="text-align:left; "><strong><?php echo $numero_entidad; ?>. <?php echo $ent_nombre; ?></strong></td>
                                </tr>
                            <thead>
                              <tbody id="cuerpo_tabla<?php echo $ent_codigo; ?>" >

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
                                  url:"dataentidadppd",
                                  type:"POST",
                                  data:"codigo_entidad="+codigo_tabla,
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
