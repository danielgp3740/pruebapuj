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

                          <a class="exc" href='reportesemaforoentidad'> <img src='img/excel_icono.png' alt='Generar Excel - Semaforo' title="Generar Excel - Semaforo"> Generar Excel - Semaforo</a>
                          <?php
                            if($_SESSION['prsona']=='201604281729001' || $_SESSION['prsona']=='20'){
                          ?>
                            <a class="exc" href='excelsimpleentidades'><img src='img/excel_icono.png' alt='Generar Excel - Semaforo Simple' title="Generar Excel - Semaforo"> Generar Excel - Semaforo Simple</a>
                          <?php
                            }
                            else{
                              echo "";
                            }
                          ?>


                         <div class="help">
                              <div id="men-help" data-toggle="tooltip" title="Convenciones"></div>
                                  <ul>
                                          <div class="box-conv">
                                               <table class="conv" id="conv2">
                                                    <tr >
                                                      <th colspan="2"> <h4>Convenciones</h4></th>
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
                                  url:"listareportexentidad",
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
