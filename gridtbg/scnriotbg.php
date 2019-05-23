<?php
/********************************************************
**  LISTA DE ESCENARIOS ADMINISTRATIVOS                 **
**  AndresMC - 01 nov 2016                              **
*********************************************************/

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

    <script type="text/javascript">
    //**************************************************************************************************
    // función ajax para el envio de datos, creacón de la tabla de programas del sector administrativo**
    //**************************************************************************************************

    function modal_programa(codigo_sectoradmin,nombre_sectorAdmin, nombre_escenario){
      var codigo_sectoradmin=codigo_sectoradmin;
    //  alert(codigo_sectoradmin);
      $("#myModal").modal({backdrop: true});

      $.ajax({
				url:"programa",
				type:"POST",
				data:"codigo_sectroAdmin="+codigo_sectoradmin+"&nombre_sectAdmin="+nombre_sectorAdmin+"&nombre_escenario="+nombre_escenario,
				async:true,

				success: function(message){
					$(".modal-body").empty().append(message);
				}
			});
    }

      </script>
      <style>
      /*****************************************************************
      **Estilos del modal para los programas del sectro administrativo**
      ******************************************************************/
      .modal-dialog{
          position:absolute;
          top: 120px;
          bottom:0;
          left:0;
          right:0;
          width: 90%;
        }

      </style>
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
		<?php
        include('prncpal/mntbg.php');

        // Query del escenario administrativo clase se encuentra en donde esta el menu izquierdo
        $escenario_administrativo = $principal_sql->escenarioAdmin($cnxn_pag, $codigoescenariooo);
        $sector_administrativo = $principal_sql->sectorAdmin($cnxn_pag, $codigo_esceadmin);


    ?>
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

                          <img src="<?php echo $imagen_procemodulo; ?>" /> <?php echo $nombre_modulosytem; ?>  | Escenarios de Actuación

                          <div class="bloDr">
                              <!--
                               <a href="#"><img src="img/ico/new.png" alt="Agregar" title="Agregar" /></a>
	                             <a href="#"><img src="img/ico/editar.png" alt="Editar" title="Editar" /></a>

	                           <a href="#"><input title="Guardar" alt=" Guardar " src="img/ico/guardar.png" type="image" /></a>
                           -->
                          </div>

                        </div>
                        <div class="dentro">

                          <div class="responsive-tabs">


                              <?php
                                while($data_escenarioadmin=$cnxn_pag->obtener_filas($escenario_administrativo)){

                                    $eac_codigo=$data_escenarioadmin['eac_codigo'];
                                    $eac_nombre=$data_escenarioadmin['eac_nombre'];
                                    $eac_descripcion=$data_escenarioadmin['eac_descripcion'];

                                    $sector_administrativo = $principal_sql->sectorAdmin($cnxn_pag, $eac_codigo);
                                ?>
                                      <h2><?php echo $eac_nombre;  ?></h2>
                                      <div>
                                          <table id="ordenar<?php echo $eac_codigo; ?>" class="grande">
                                            <tr>
                                                <th>&nbsp;&nbsp;Nro.</th>
                                                <th>Sector Administrativo</th>
                                                <th class="nosort">Programa</th>

                                        <?php
                                            $numero_sectoadmin=1;
                                            while($data_sectoradmin=$cnxn_pag->obtener_filas($sector_administrativo)){

                                              $sad_codigo=$data_sectoradmin['sad_codigo'];
                                              $sad_nombre=$data_sectoradmin['sad_nombre'];
                                              $sad_descripcion=$data_sectoradmin['sad_descripcion'];
                                              $sad_objetivo=$data_sectoradmin['sad_objetivo'];
                                              ?>

                                              <tr>
                                                  <td class="text-left wd-3"> <?php echo $numero_sectoadmin; ?></td>
                                                  <td class="text-left">
                                                    <a href="Javascript:modal_programa('<?php echo $sad_codigo; ?>','<?php echo $sad_nombre; ?>','<?php echo $eac_nombre; ?>');" title="Programa"  id="myBtn_<?php echo  $sad_codigo; ?>">
                                                    <p><?php echo $sad_nombre; ?></p>
                                                  </a>
                                                  </td>
                                                  <td class="wd-5">
                                                    <a href="Javascript:modal_programa('<?php echo $sad_codigo; ?>','<?php echo $sad_nombre; ?>','<?php echo $eac_nombre; ?>');" title="Programa"  id="myBtn_<?php echo  $sad_codigo; ?>"><img src="img/ico/programas.png" /></a>
                                                  </td>

                                              </tr>

                                              <?php


                                              $numero_sectoadmin++;
                                            }


                                         ?>
                                          </table>
                                      </div>


                                      <script type="text/javascript">
                                                      var sorter=new table.sorter("sorter");
                                                      sorter.init("ordenar<?php echo $eac_codigo; ?>",0);

                                        $(".borrar").click(function(){
                                          usu_delete($(this).data("codpersona"));
                                        });
                                     </script>

                                <?php

                                }

                               ?>
                               <!-- INICIO MODAL -->
                               <div class="modal fade" id="myModal" role="dialog">
                                 <div class="modal-dialog">

                                   <!-- Modal content-->
                                   <div class="modal-content">
                                     <div class="modal-header">
                                       <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                     </div>
                                     <div class="modal-body">
                                       <p>Cargando</p>
                                     </div>
                                     <div class="modal-footer">
                                      <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> -->
                                     </div>
                                   </div>

                                 </div>
                               </div>
                               <!-- FIN MODAL -->
                            </div>

                            <script type="text/javascript" src="js/responsiveTabs.min.js"></script>
              							<script type="text/javascript">
                							$(document).ready(function(){
                								RESPONSIVEUI.responsiveTabs();
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
