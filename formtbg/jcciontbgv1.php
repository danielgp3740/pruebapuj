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

                    <div class="recuadro">
                      <!--************* Inicio Titulo *****************-->
                      <div class="titulo">

                          <img src="<?php echo $imagen_procemodulo; ?>" /> <?php echo $nombre_modulosytem; ?>
                          <div class="bloDr">
	                           <a href="#"><input title="Guardar" alt=" Guardar " src="img/ico/guardar.png" type="image" /></a>
                          </div>


                      </div>
                      <!--************** Fin Titulo ********************-->


                        <div class="dentro">
                          <form id="formulario">

                          <label>Entidad</label>
                            <div class="combo" id="identidad" >
                            <select id="sel_entidad" name="sel_entidad" title="Seleccione un Entidad" required="" aria-required="true" class="valid" aria-invalid="false" onchange="traer_programaentidad();">
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

                            <!--**************Inicio Grilla escenario, sector, programa *******************-->


                            <!--**************Inicio Programa ***************-->
                            <div class="col-md-4">
                                <label>Programa</label>
                                <div class="combo" id="idlist_programa">
                                <select id="sel_programa" name="sel_programa" title="Seleccione un Programa" required="" aria-required="true" class="valid" aria-invalid="false">
                                    <option value="">Seleccione:</option>

                                </select>
                                </div>
                            </div>
                            <!--**************Fin Programa ***************-->
                            <div id='list_datos_essecmr'>

                                    <!--**************Inicio Escenario administrativo***************-->
                                      <div class="col-md-4">
                                        <label>Escenario Administrativo</label>
                                          <div class="combo">
                                          <select id="sel_escenario" name="sel_escenario" title="Seleccione un Sector Administrativo" required="" aria-required="true" class="valid" aria-invalid="false" onchange="traer_sector();" disabled="disabled">
                                              <option value="">Seleccione:</option>
                                              <?php
                                              /*
                                                while($list_escenario=$cnxn_pag->obtener_filas($escenario)){
                                                    $eac_codigo=$list_escenario['eac_codigo'];
                                                    $eac_nombre=$list_escenario['eac_nombre'];
                                                    */
                                              ?>
                                                  <!-- <option value="<?php echo $eac_codigo; ?>"><?php echo $eac_nombre; ?></option> -->
                                              <?php
                                                //}
                                              ?>
                                          </select>
                                          </div>
                                      </div>
                                      <!--**************Fin Escenario administrativo***************-->

                                      <!--************Inicio Sector Admin***************-->
                                      <div class="col-md-4">
                                          <label>Sector Administrativo</label>
                                          <div class="combo" id='idsector_admin'>
                                          <select id="sel_sectoradmin" name="sel_sectoradmin" title="Seleccione un Sector Administrativo" required="" aria-required="true" class="valid" aria-invalid="false" onchange="traer_sector();" disabled="disabled">
                                              <option value="">Seleccione:</option>

                                          </select>
                                          </div>
                                      </div>
                                      <!--************Fin Sector Admin***************-->



                                      <!--**************Inicio Meta Resultado*************-->

                                    <div class="col-md-8">
                                      <label>Meta de Resultado</label>
                                      <div class="combo" id="idlist_meru">
                                      <select id="sel_meru" name="sel_meru" title="Seleccione una Meta de Resultado" required="" aria-required="true" class="valid" aria-invalid="false">
                                          <option value="">Seleccione:</option>

                                      </select>
                                      </div>
                                    </div>
                                    <!--**************Fin Meta Resultado*************-->

                            </div>

                            <div class="col-md-4">
                              <label>Meta de Producto</label>
                              <div class="combo" id="idlist_mepro">
                              <select id="sel_mepro" name="sel_mepro" title="Seleccione una Meta de Producto" required="" aria-required="true" class="valid" aria-invalid="false">
                                  <option value="">Seleccione:</option>


                              </select>
                              </div>
                            </div>
                            <!--****************Inicio valor de la meta de producto **********************-->
                            <div id='listvalor_mepro'>
                              <legend> <br> Valores Esperados</legend>
                              <div class="col-md-4">
                                <div class="col-md-3">
                                  <label>L. Base</label>
                                  <p>0</p>
                                </div>
                                <div class="col-md-3">
                                  <label>V. Cautre</label>
                                  <p>0</p>
                                </div>
                              </div>

                              <div class="col-md-8">
                                <div class="col-md-3">
                                  <label>Vigencia 2016</label>
                                  <p>0</p>
                                </div>
                                <div class="col-md-3">
                                  <label>Vigencia 2017</label>
                                  <p>0</p>
                                </div>
                                <div class="col-md-3">
                                  <label>Vigencia 2018</label>
                                  <p>0</p>
                                </div>
                                <div class="col-md-3">
                                  <label>Vigencia 2019</label>
                                  <p>0</p>
                                </div>
                              </div>
                              <legend>&nbsp;</legend>
                            </div>
                            <!--****************Fin valor de la meta de producto **********************-->




                          <div class="col-md-8">

                          <div class="col-md-4">
                                <label>Municipio</label>
                                <div class="combo" id="idlist_municipio">
                                <select id="sel_municipio" name="sel_municipio" title="Seleccione un Municipio" required="" aria-required="true" class="valid" aria-invalid="false" >
                                  <option value="">Seleccione:</option>
                                  <option value="">Departamento</option>
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
                          </div>
                            <div class="col-md-4">
                                <label>Vigencia</label>
                                <div class="combo">
                                <select id="sel_vigencia" name="sel_vigencia" title="Seleccione la vigencia" required="" aria-required="true" class="valid" aria-invalid="false">
                                    <option value="">Seleccione:</option>
                                    <option value="2016">2016</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                              <label>Valor Ejecutado</label>
                                <input type="text" id="txt_valorejecutado" name="txt_valorejecutado" data-rule-required="true" data-rule-number="true" data-msg-required="Por favor ingrese el dato." data-msg-number="Por favor ingrese un número." required />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                              <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p>
                          </div>

                            <!--**************Fin Grilla escenario, sector, programa *******************-->
                            <div class="col-md-8">
                              <label>Descripción</label>
                                 <textarea data-msg-required="Por favor ingrese la información de la descripción." class='required'></textarea>
                           </div>
                           <div class="col-md-4">
                             <p>&nbsp;</p>
                           </div>

                           <!--***********************Inicio Origen de los recursos *********************************-->
                          <div class="col-md-8">
                            <fieldset>

                               <legend>
                                 <!-- <input type="checkbox" class="checkbox" id="chk_origenrecursos" value="1" name="chk_origenrecursos"> -->
                                  Origen de los Recursos
                               </legend>

                             </fieldset>
                              <div class="col-md-3">
                                   <label>Cofinanciación Municipio</label>
                                   <input type="text" id="txt_cofinanciacionmncpio" name="txt_cofinanciaciondpto"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />
                              </div>

                              <div class="col-md-3">
                                   <label>Cofinanciación Nación</label>
                                   <input type="text" id="txt_cofinanciacionnacion" name="txt_cofinanciacionnacion"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />
                              </div>
                              <div class="col-md-3">
                                   <label>Créditos</label>
                                   <input type="text" id="txt_creditos" name="txt_creditos"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />
                              </div>
                              <div class="col-md-3">
                                   <label>Recursos Propios</label>
                                   <input type="text" id="txt_repro" name="txt_repro"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />
                              </div>
                              <div class="col-md-3">
                                   <label>SGP APSB</label>
                                   <input type="text" id="txt_sgpapsb" name="txt_sgpapsb"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />
                              </div>
                              <div class="col-md-3">
                                    <label>SGP Educación</label>
                                   <input type="text" id="txt_sgpeducacion" name="txt_sgpeducacion"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />
                              </div>

                              <div class="col-md-3">
                                   <label>SGP Salud</label>
                                   <input type="text" id="txt_sgpsalud" name="txt_sgpsalud"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />
                             </div>

                             <div class="col-md-3">
                               <label>Regalías</label>
                               <input type="text" id="txt_regalias" name="txt_regalias"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />
                             </div>

                             <div class="col-md-3">
                                 <label>Otros</label>
                                 <input type="text" id="txt_otros" name="txt_otros"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de Cofinanciación Dpto" data-msg-minlength="Dato muy corto." required />
                             </div>
                          </div>
                          <div class="col-md-4">
                            <p>&nbsp;</p>
                          </div>
                          <!--***********************Fin Origen de los recursos *********************************-->

                          <!--***********************Inicio Población *********************************
                         <div class="col-md-8">
                           <br>
                           <fieldset>

                              <legend>
                              </legend>
                              <input type="checkbox" class="checkbox" id="chk_origenrecursos" value="1" name="chk_origenrecursos">
                              Población

                            </fieldset>


                            <div class="col-md-8">
                                <h3>
                                  <input type="checkbox" class="checkbox" id="chk_origenrecursos" value="1" name="chk_origenrecursos">
                                   Víctima-Hecho Victimizante
                                </h3>
                            </div>

                         </div>
                         <div class="col-md-4">
                           <p>&nbsp;</p>
                         </div>
                         ***********************Fin Población de los recursos *********************************-->








                          <script src="js/jquery.validate.min.js" type="text/javascript"></script>
              							<script type="text/javascript">
                                $(document).ready(function() {
                                    $("#formulario").validate();
                                    document.formulario.submit
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
                            // Trae el program por la entidad seleccionada
                            function traer_programaentidad(){
                              var id_entidad=$('#sel_entidad').val();
                              //alert(id_sectoradmin);
                              $.ajax({
                                url:"listPrograma",
                                type:"POST",
                                data:"id_entidad="+id_entidad,
                                async:true,
                                success: function(message){
                                   $("#idlist_programa").empty().append(message);
                                  //  $("#list_datos_essecmr").empty().append(message);
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
                                  $("#list_datos_essecmr").empty().append(message);
                                  //$("#idlist_meru").empty().append(message);
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

                            function traer_valormp(){
                              var id_mepro=$('#sel_mepro').val();
                              //alert(id_meru);
                              $.ajax({
                                url:"listCenpoValor",
                                type:"POST",
                                data:"id_mepro="+id_mepro,
                                async:true,
                                success: function(message){
                                  $("#listvalor_mepro").empty().append(message);
                                }
                              });
                            }


                            </script>
                            </form>
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
