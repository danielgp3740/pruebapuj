<?php


$entidad=$principal_sql->entidad($cnxn_pag);
$escenario=$principal_sql->escenarioAdmin($cnxn_pag);
$municipio=$principal_sql->municipio($cnxn_pag);

/*
$sector=$principal_sql->sectorAdmin($cnxn_pag, $codigo_programa);
$programa=$principal_sql->programas($cnxn_pag, $codigo_programa);
$meta_resultado=$principal_sql->meta_resultado($cnxn_pag, $codigo_programa);
$meta_producto=$principal_sql->meta_producto($cnxn_pag, $codigo_programa);
*/



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

<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo">

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
                  <form id="formulario">
                    <div class="recuadro">
                    	<div class="titulo">

                          <img src="<?php echo $imagen_procemodulo; ?>" /> <?php echo $nombre_modulosytem; ?>
                          <div class="bloDr">
                            <!--
                              <a href="#"><img src="img/ico/new.png" alt="Agregar" title="Agregar" /></a>
	                            <a href="#"><img src="img/ico/editar.png" alt="Editar" title="Editar" /></a>
                            -->

	                           <a href="#"><input title="Guardar" alt=" Guardar " src="img/ico/guardar.png" type="image" /></a>
                          </div>


                        </div>
                        <div class="dentro">
                          <div class="responsive-tabs">
                            <h2>Tab primero</h2>
                            <div>
                              <label>Entidad</label>
                                <div class="combo" id="identidad" >
                                <select id="sel_entidad" name="sel_entidad" title="Seleccione un Entidad" required="" aria-required="true" class="valid" aria-invalid="false">
                                    <option value="">Seleccione:</option>
                                    <?php
                                      while($list_entidad=$cnxn_pag->obtener_filas($entidad)){
                                          $ent_codigo=$list_entidad['ent_codigo'];
                                          $ent_nombre=$list_entidad['ent_nombre'];
                                    ?>
                                        <option value="<?php echo $ent_codigo; ?>"><?php echo $ent_nombre; ?></option>
                                    <?php
                                      }
                                    ?>
                                </select>
                                </div>



                                <label>Escenario Administrativo</label>
                                <div class="combo">
                                <select id="sel_escenario" name="sel_escenario" title="Seleccione un Sector Administrativo" required="" aria-required="true" class="valid" aria-invalid="false" onchange="traer_sector();">
                                    <option value="">Seleccione:</option>
                                    <?php
                                      while($list_escenario=$cnxn_pag->obtener_filas($escenario)){
                                          $eac_codigo=$list_escenario['eac_codigo'];
                                          $eac_nombre=$list_escenario['eac_nombre'];
                                    ?>
                                        <option value="<?php echo $eac_codigo; ?>"><?php echo $eac_nombre; ?></option>
                                    <?php
                                      }
                                    ?>
                                </select>
                                </div>

                                <label>Sector Administrativo</label>
                                <div class="combo" id='idsector_admin'>
                                <select id="sel_sectoradmin" name="sel_sectoradmin" title="Seleccione un Sector Administrativo" required="" aria-required="true" class="valid" aria-invalid="false" onchange="traer_sector();">
                                    <option value="">Seleccione:</option>

                                </select>
                                </div>

                                <label>Programa</label>
                                <div class="combo" id="idlist_programa">
                                <select id="sel_programa" name="sel_programa" title="Seleccione un Programa" required="" aria-required="true" class="valid" aria-invalid="false">
                                    <option value="">Seleccione:</option>

                                </select>
                                </div>

                                <label>Meta de Resultado</label>
                                <div class="combo" id="idlist_meru">
                                <select id="sel_meru" name="sel_meru" title="Seleccione una Meta de Resultado" required="" aria-required="true" class="valid" aria-invalid="false">
                                    <option value="">Seleccione:</option>

                                </select>
                                </div>

                                <label>Meta de Producto</label>
                                <div class="combo" id="idlist_mepro">
                                <select id="sel_mepro" name="sel_mepro" title="Seleccione una Meta de Producto" required="" aria-required="true" class="valid" aria-invalid="false">
                                    <option value="">Seleccione:</option>


                                </select>
                                </div>

                                <label>Municipio</label>
                                <div class="combo" id="idlist_municipio">
                                <select id="sel_municipio" name="sel_municipio" title="Seleccione un Municipio" required="" aria-required="true" class="valid" aria-invalid="false" onchange="traer_cenpo();">
                                    <option value="">Seleccione:</option>
                                    <?php
                                      while($lista_municipio=$cnxn_pag->obtener_filas($municipio)){
                                          $mun_nombre=$lista_municipio['mun_nombre'];
                                          $mun_codigo=$lista_municipio['mun_codigo'];
                                    ?>
                                      <option value="<?php echo $mun_codigo; ?>"><?php echo $mun_nombre; ?></option>
                                    <?php

                                      }
                                    ?>


                                </select>
                                </div>

                                <label>Centro Poblado</label>
                                <div class="combo" id="idlist_cenpo">
                                <select id="sel_cenpo" name="sel_cenpo" title="Seleccione un Centro Poblado" required="" aria-required="true" class="valid" aria-invalid="false">
                                    <option value="">Seleccione:</option>


                                </select>
                                </div>


                                <label>Observación</label>
                                <textarea style="width:60%; height:120px;" name="txt_observacion" id="txt_observacion" data-rule-required="true" autocomplete="on" data-msg-required="Por favor ingrese el dato." data-msg-minlength="Dato muy corto." required ></textarea>


                                <fieldset>
                                         <legend>Origen de los Recurso</legend>
                                         <label>Cofinanciación Departamento</label>
                                         <input type="text" id="txt_cofinanciaciondpto" name="txt_cofinanciaciondpto"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />

                                         <label>Cofinanciación Nación</label>
                                         <input type="text" id="txt_cofinanciacionnacion" name="txt_cofinanciacionnacion"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />

                                         <label>Créditos</label>
                                         <input type="text" id="txt_creditos" name="txt_creditos"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />

                                         <label>Recursos Propios</label>
                                         <input type="text" id="txt_repro" name="txt_repro"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />

                                         <label>SGP APSB</label>
                                         <input type="text" id="txt_sgpapsb" name="txt_sgpapsb"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />

                                         <label>SGP Educación</label>
                                         <input type="text" id="txt_sgpeducacion" name="txt_sgpeducacion"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />

                                         <label>SGP Salud</label>
                                         <input type="text" id="txt_sgpsalud" name="txt_sgpsalud"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />

                                         <label>Regalías</label>
                                         <input type="text" id="txt_regalias" name="txt_regalias"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />

                                         <label>Otros</label>
                                         <input type="text" id="txt_regalias" name="txt_regalias"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />

                                </fieldset>
                            </div>


                            <h2>Tab primero</h2>
                             <div>
                               <fieldset>
                                 <legend>Población</legend>
                                 <legend>Población</legend>

                               </fieldset>
                           </div>




                          </div>




                          <script src="js/jquery.validate.min.js" type="text/javascript"></script>
              							<script type="text/javascript">
                                $(document).ready(function() {
                                    $("#formulario").validate();
                            });
                            </script>

                            <script type="text/javascript" src="js/responsiveTabs.min.js"></script>
                           							<script type="text/javascript">
                           							$(document).ready(function(){
                           								RESPONSIVEUI.responsiveTabs();
                           							});
                           </script>

                          <script type="text/javascript" src="js/orden_tabla.js"></script>
             							<script type="text/javascript">
                                         var sorter=new table.sorter("sorter");
                                         sorter.init("ordenar",0);

             							$(".borrar").click(function(){
             								usu_delete($(this).data("codpersona"));
             							});
                         </script>


                            <script type='text/javascript'>

                            function traer_sector(){
                              var id_escenarioadmin=$('#sel_escenario').val();
                              //alert(id_sectoradmin);
                              $.ajax({
                                url:"listSector",
                                type:"POST",
                                data:"id_escenarioadmin="+id_escenarioadmin,
                                async:true,
                                success: function(message){
                                  $("#idsector_admin").empty().append(message);
                                }
                              });
                            }

                            function traer_programa(){
                              var id_sectoradmin=$('#sel_sectoradmin').val();
                              //alert(id_sectoradmin);
                              $.ajax({
                                url:"listPrograma",
                                type:"POST",
                                data:"id_sectoradmin="+id_sectoradmin,
                                async:true,
                                success: function(message){
                                  $("#idlist_programa").empty().append(message);
                                }
                              });
                            }

                            function traer_meru(){
                              var id_programa=$('#sel_programa').val();
                              //alert(id_programa);
                              $.ajax({
                                url:"listMeru",
                                type:"POST",
                                data:"id_programa="+id_programa,
                                async:true,
                                success: function(message){
                                  $("#idlist_meru").empty().append(message);
                                }
                              });
                            }

                            function traer_mepro(){
                              var id_meru=$('#sel_meru').val();
                              //alert(id_meru);
                              $.ajax({
                                url:"listMepro",
                                type:"POST",
                                data:"id_meru="+id_meru,
                                async:true,
                                success: function(message){
                                  $("#idlist_mepro").empty().append(message);
                                }
                              });
                            }

                            function traer_cenpo(){
                              var id_municipio=$('#sel_municipio').val();
                              //alert(id_meru);
                              $.ajax({
                                url:"listCenpo",
                                type:"POST",
                                data:"id_municipio="+id_municipio,
                                async:true,
                                success: function(message){
                                  $("#idlist_cenpo").empty().append(message);
                                }
                              });
                            }


                            </script>

                        </div>
                    </div>
                	<!-- ---------------------------------------------------------------------------- fin INTERNA RECUADRO ---------------------------------------------------------------------------- -->
                </form>
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
