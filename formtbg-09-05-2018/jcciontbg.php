 <?php

$persona_entidad=$_SESSION['entidad_persona'];

$entidad=$principal_sql->entidad($cnxn_pag,$persona_entidad);
$escenario=$principal_sql->escenarioAdmin($cnxn_pag, $codigoescenarioAdmin);
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


<script type='text/javascript'>


      function altura_encimaModal(){
        var alto_encimaModal = $(".encimaModal").height();
        var ancho_encimaModal = $(".encimaModal").width()-20;
        //alert(alto_encimaModal + ' ::: ' + ancho_encimaModal);
        $("#modalContenido").css({ 'height': alto_encimaModal+'px' });
        //$("#titulo.titulo").css({ 'width': '300px' });
      }


      function modal_valorxvigencia(){

        var codigo_entidad=$('#sel_entidad').val();
        var codigo_metaproducto=$('#sel_mepro').val();
        var vigencia=$('#sel_vigencia').val();
        var municipio=$('#sel_municipio').val();

        //alert('Codigo Entidad: '+codigo_entidad+' - Codigo Mepro: '+codigo_metaproducto);

        //$("#myModalValorVigencia").modal({backdrop: true});

        //var id_mepro=$('#sel_mepro').val();
        if(codigo_metaproducto==''){
            $("#ModalErrorMP").modal({backdrop: true});
            $('#sel_mepro').focus();

            return false;
        }

        if(municipio==''){
            $("#ModalErrorMunicipio").modal({backdrop: true});
            $('#sel_vigencia').focus();

            return false;
        }

        if(vigencia==''){
            $("#ModalErrorVigencia").modal({backdrop: true});
            $('#sel_vigencia').focus();

            return false;
        }



        $(".encima").fadeIn(300, function(){
          $(".encimaModal").fadeIn(300);
        });



        $.ajax({
          url:"valorxvigencia",
          type:"POST",
          data:"codigo_metaproducto="+codigo_metaproducto+"&codigo_entidad="+codigo_entidad+"&vvigencia="+vigencia+"&idmunicipio="+municipio,
          async:true,

          success: function(message){
            //$(".modal-body").empty().append(message);
            $("#modalContenido").empty().append(message);
          }
        });

      }



      $(document).ready(function(){

        $(window).resize(function(e){
          altura_encimaModal();
        });

        $("#newvalores").click(function() {
            modal_valorxvigencia();
            altura_encimaModal();
        });

        $(".cerrar-modal").click(function() {
          $(".encimaModal").fadeOut(300, function(){
            $(".encima").fadeOut(300);
          });
        });

        $("#modificarvaloresejecuacion").click(function() {
            modal_valormodificarxvigencia();
            altura_encimaModal();
        });

      });



    

</script>

<style>
/*****************************************************************
**Estilos del modal para los programas del sectro administrativo**
******************************************************************/
.modal-dialog{
    position:absolute;
    top: 30px;
    bottom:0;
    left:0;
    right:0;
    width: 90%;

  }
  #ModalErrorMP .modal-dialog , #ModalErrorMunicipio .modal-dialog, #ModalErrorVigencia .modal-dialog{
    width: 30%;

  }

  #myModalvalorEjecuacion .modal-dialog, #myModalBorrarvalorEjecuacion .modal-dialog{
    width: 40%;
    height: 550px;
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

    <!-- INICIO MODAL vigencias-->
    <div class="encima"></div>
    <div class="encimaModal">
        <!-- <a href="javascript:void(0);" class="cerrar-modal">CERRAR vvvv</a> -->
        <div id="modalContenido">
        </div>
    </div>
    <!-- FIN MODAL vigencias-->



    <!-- INICIO MODAL erroMP-->
    <div class="modal fade" id="ModalErrorMP" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
            <p><h2>Debe seleccionar una meta de producto </h2></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ACEPTAR</button>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN MODAL erroMP-->

    <!-- INICIO MODAL erroMunicipio-->
    <div class="modal fade" id="ModalErrorMunicipio" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
            <p><h2>Debe seleccionar un Municipio</h2></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ACEPTAR</button>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN MODAL erroMunicipio-->

    <!-- INICIO MODAL erroSelVigencia-->
    <div class="modal fade" id="ModalErrorVigencia" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
            <p><h2>Debe seleccionar la Vigencia</h2></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ACEPTAR</button>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN MODAL erroSelVigencia-->





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
	                           <!-- <a href="#"><input title="Guardar" alt=" Guardar " src="img/ico/guardar.png" type="image" /></a> -->
                          </div>


                      </div>
                      <!--************** Fin Titulo ********************-->
                      <div class='tabladedatos'></div>

                        <div class="dentro">
                           <a class="video " href="Javascript:vervideo();"><img src="img/ico/video.png" alt="Ver video tutorial" title="Ver video tutorial"> Ver video tutorial</a>

                          <div class="clearfix"></div>
                          <a class="exc" href="planddbasico"><img src="img/excel_icono.png" alt="Generar Excel - Semaforo" title="Generar Excel - Semaforo">&nbsp;&nbsp;&nbsp;&nbsp; Descargar PDD&nbsp;&nbsp;&nbsp;</a>

                          <form id="formulario">

                          <div class="col-md-4">
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
                            </div>


                            <div class="col-md-12"> &nbsp;</div>

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

                                    <div class="col-md-6">
                                      <label>Meta de Resultado</label>
                                      <div class="combo" id="idlist_meru">
                                      <select id="sel_meru" name="sel_meru" title="Seleccione una Meta de Resultado" required="" aria-required="true" class="valid" aria-invalid="false">
                                          <option value="">Seleccione:</option>

                                      </select>
                                      </div>
                                    </div>
                                    <!--**************Fin Meta Resultado*************-->

                            </div>


                            <div class="col-md-6">
                              <label>Meta de Producto</label>
                              <div class="combo" id="idlist_mepro">
                              <select id="sel_mepro" name="sel_mepro" title="Seleccione una Meta de Producto" required="" aria-required="true" class="valid" aria-invalid="false">
                                  <option value="">Seleccione:</option>


                              </select>
                              </div>
                            </div>

                            <!--****************Inicio valor de la meta de producto **********************-->

                            <div class="col-md-12">&nbsp;</div>


                            <div class="col-md-6 box-vigencia">

                                <div id='listvalor_mepro'>
                                  <legend> <br> Valores Esperados</legend>
                                    <div class="col-md-3">
                                      <label>Linea Base</label>
                                      <p>0</p>
                                    </div>
                                    <div class="col-md-3">
                                      <label>Valor Cuatrenio</label>
                                      <p>0</p>
                                    </div>
                                    <div class="col-md-3">
                                      <label>Orientación</label>
                                      <p>0</p>
                                    </div>
                                  <!--  <div class="col-md-2">
                                      <label>Acumulado Cuatrenio</label>
                                      <p>0</p>
                                    </div>-->

                                    <div class="col-md-12"> </div>

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
                                    <!--
                                    <div class="col-md-2">
                                      <label>Acumulado Vigencia</label>
                                      <p>0</p>
                                    </div>
                                  -->
                                  </div>


                              </div>

                              <div class="col-md-12"><legend>&nbsp;</legend>&nbsp;</div>

                            <!--****************Fin valor de la meta de producto **********************-->





                            <div class="col-md-12">
                                <div class="col-md-4">
                                  <label>Municipio</label>
                                  <div class="combo" id="idlist_municipio">
                                  <select id="sel_municipio" name="sel_municipio" title="Seleccione un Municipio" required="" aria-required="true" class="valid" aria-invalid="false" >
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
                                </div>

                                <div class="col-md-4">
                                  <label>Vigencia</label>
                                  <div class="combo">
                                  <select id="sel_vigencia" name="sel_vigencia" title="Seleccione la vigencia" required="" aria-required="true" class="valid" aria-invalid="false">
                                      <option value="">Seleccione:</option>
                                      <!-- <option value="2016">2016</option> -->
                                      <option value="2017">2017 hasta 20 de Noviembre</option>
                                  </select>

                                  </div>
                                </div>



                                <div class="col-md-4">
                                  <label>&nbsp;</label><!-- desactivo -->
                                  <!-- ************************DEsactivación de agregar vigencias ************************************ -->

                                  <?php
                                if($_SESSION['prsona']=='201604281729001' || $_SESSION['prsona']=='20' /* || $_SESSION['prsona']=='6' || $_SESSION['prsona']=='3'*/){
                                      echo '<a href="javascript:void(0);" title="Agregar Valores" id="newvalores" class="new-btn"><img src="img/ico/new.png" /></a>';
                                  }
                                  else{
                                    //echo "";

                                    if ($dpl_proceso=='0') {
                                      $rayahabilita="_";
                                    }
                                    else {
                                      $rayahabilita="";
                                    }
                                    echo '<a href="javascript:void(0);" title="Agregar Valores" id="newvalores'.$rayahabilita.'" class="new-btn"><img src="img/ico/new.png" /></a>';

                                  }
                                  ?>
                                  <!--   -->

                                </div>

                                <!--
                                <div class="col-md-1">
                                  <table style="margin:20px 0 0 -30px;">
                                    <tr>
                                      <td style="border:none;"><a href="javascript:void(0);" title="Agregar Valores" id="newvalores"><img src="img/ico/new.png" style="margin-top:5px" /></a></td>
                                    </tr>
                                  </table>

                                </div>
                              -->

                            </div>
                            <div class="col-md-12">
                              <br><br>
                              <div id='resultado_consulta'>

                                  <?php
                                    include('gridtbg/list_mtajccion.php');
                                  ?>
                              </div>
                            </div>
                            <!--**************Fin Grilla escenario, sector, programa *******************-->




                          <script src="js/jquery.validate.min.js" type="text/javascript"></script>
              							<script type="text/javascript">
                            /*
                                $(document).ready(function() {
                                    $("#formulario").validate();
                                    document.formulario.submit
                            });
                            */
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


                            function traer_datosejecutadosmp(){
                                  var id_mepro=$('#sel_mepro').val();
                                //listValorMetaProducto


                                    //alert('Meta Producto: '+id_mepro);

                                    $.ajax({
                                      url:"listValorMetaProducto",
                                      type:"POST",
                                      data:"codigo_meproejecutado="+id_mepro,
                                      async:true,
                                      success: function(message){
                                        $("#resultado_consulta").empty().append(message);
                                      }
                                    });

                              }





                          </script>
                          <script type="text/javascript">
                              //$(".vervideo").click(function(){
                              function vervideo(){
                                armarModal($(this).attr("id"),0,false,"<span><iframe width='100%' height='100%' src='https://www.youtube.com/embed/XXjzfs70-gA' frameborder='0' allowfullscreen></iframe></span>","","");
                              }
                                //var codigo_metaproducto = $(this).data("codigometaproducto");
                                //alert('Codigo MP: '+codigo_metaproducto);

                              //});
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
