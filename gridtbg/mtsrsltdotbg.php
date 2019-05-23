<?php

  $codigo_programa=$codigo_elemento1;

  $meta_resultado = $principal_sql->meta_resultado($cnxn_pag, $codigo_programa);



  $programa= $principal_sql->programa_bid($cnxn_pag, $codigo_programa);
  $data_programa=$cnxn_pag->obtener_filas($programa);
  $nombre_programa=$data_programa['pro_nombre'];
  $nombre_sectoradmin=$data_programa['sad_nombre'];
  $codigo_sectoradmin=$data_programa['pro_sectoradministrativo'];
  $eac_nombre=$data_programa['eac_nombre'];

  $espacio_capa=64;
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
  //**************************************************************************************************
  // función ajax para el envio de datos, creacón de la tabla de programas del sector administrativo**
  //**************************************************************************************************

  function modal_programa(codigo_sectoradmin,nombre_sectorAdmin,nombre_escenario){
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

  function modal_vigencia(codigo_metaproducto,codigo_programa){
    var codigo_metaproducto=codigo_metaproducto;
    var codigo_programa=codigo_programa;
  //  alert(codigo_sectoradmin);
    $("#myModalVigencia").modal({backdrop: true});

    $.ajax({
      url:"vigenciavalor",
      type:"POST",
      data:"codigo_metaproducto="+codigo_metaproducto+"&codigo_programa="+codigo_programa,
      async:true,

      success: function(message){
        $(".modal-body").empty().append(message);
      }
    });
  }

    </script>

<script src="js/jquery.fixedtableheader.js" type="text/javascript"> </script>

<script type="text/javascript">
$(function(){
  //$(".tbl1").fixedtableheader();
  $(".tbl1").fixedtableheader({ espacio: <?php echo $espacio_capa ?> });

 /* $(".tbl2").fixedtableheader({ highlightrow: true, headerrowsize: 3 });

  $(".tbl3").fixedtableheader({ highlightrow: true, highlightclass: "highlight2", headerrowsize: 3 });*/
})
</script>

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

      #myModalVigencia .modal-dialog, #myModalPonderacion .modal-dialog{
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
                    	<ul class="miga">
                        <li><span> Escenario:</span>  <?php echo $eac_nombre; ?>
                            <img src="img/ico/escenario.png" />&nbsp;<img src="img/miga.png"></li>
                        <li><span> Sector:</span> <!-- Escenario --> <?php echo $nombre_sectoradmin; ?>
                            <img src="img/ico/usuario.png" />&nbsp;<img src="img/miga.png"></li>
                            <li><span>Programa:</span><?php echo $nombre_programa; ?> <img src="img/ico/planeacion.png" />&nbsp;<img src="img/miga.png"></li>
                            <li class="programa"><a href="Javascript:modal_programa('<?php echo $codigo_sectoradmin; ?>','<?php echo $nombre_sectoradmin; ?>','<?php echo $eac_nombre; ?>');" title="Listar Programas" id="myBtn_"><img src="img/ico/programas.png"></a></li>
                        </ul>


                          <div class="bloDr">
                            <a href="Javascript:modal_programa('<?php echo $codigo_sectoradmin; ?>','<?php echo $nombre_sectoradmin; ?>','<?php echo $eac_nombre; ?>');" title="Programa"  id="myBtn_<?php echo  $sad_codigo; ?>"></a>
                          </div>

                          <script src="js/jquery.fixedtableheader.js" type="text/javascript"> </script>

                    <!--  <table class="conv">
                          <tr >
                            <th colspan="2"> <h4>Convenciones</h4></th>
                          </tr>
                          <tr>
                          <td> Ponderación</td>
                          <td> P </td>
                          </tr>
                          <tr>
                          <td> Linea Base</td>
                          <td> LB</td>
                          </tr>
                          <tr>
                          <td> Meta Cuatrenio</td>
                          <td> MC</td>
                          </tr>
                          <tr>
                          <td>Orientación</td>
                          <td> O </td>
                          </tr>
                          <tr>
                          <td> Incremento</td>
                          <td> <img src="img/ico/incremento.png"></td>

                          </tr>
                           <tr>
                           <td> Mantenimiento</td>
                          <td> <img src="img/ico/mantiene.png"></td>

                          </tr>
                           <tr>
                           <td> Disminución</td>
                           <td> <img src="img/ico/diminuye.png"></td>
                          </tr>

                          <tr>
                          <td>Vigencia</td>
                          <td> V</td>
                          </tr>

                          <tr>
                          <td>Tendencia Positiva</td>
                          <td> TP </td>
                          </tr>


                        </table>-->


                        <div class="dentro">

                          <?php

                          //echo $programa;
                          //Lista Meta de Resultado
                            $numero_programaadmin=1;
                            while($data_metaresultado=$cnxn_pag->obtener_filas($meta_resultado)){
                              $mre_codigo=$data_metaresultado['mre_codigo'];
                              $mre_descripcion=$data_metaresultado['mre_descripcion'];
                              $mre_lineabase=$data_metaresultado['mre_lineabase'];
                              $mre_valorcuatrenio=$data_metaresultado['mre_valorcuatrenio'];


                              $meta_producto=$principal_sql->meta_producto($cnxn_pag, $mre_codigo);

                              if($mre_lineabase > $mre_valorcuatrenio){
                                $imgtipomr="diminuye.png";
                                $tipometaresul='Reducción';

                              }
                              elseif($mre_lineabase==$mre_valorcuatrenio){
                                $imgtipomr="mantiene.png";
                                $tipometaresul='Mantiene';
                              }
                              else{
                                $imgtipomr="incremento.png";
                                $tipometaresul='Aumenta';
                              }

                              if($mre_lineabase==0 && $mre_valorcuatrenio==0){
                                $color_rojo='#FFF;';
                              }
                              else{
                                $color_rojo='#FFF;';
                              }


                          ?>

                            <h4 class="acor_btn">
                                <span style="font-size:75%"> Meta de Resultado:</span><br>
                                <?php echo $mre_descripcion; ?>
                            </h4>
                             <div class="acor_conte">
<!--
                                <div class="busca">
                                    <input id="Text1" class="txtSearch" type="text" onkeyup="CheckSearchText(this)" />
                                    <input id="Button1" type="button" onclick="FixedSearchTest(this)" value="Buscar" class="no-margin" />
                                 </div>
-->
                               <strong> Linea Base: <?php echo $mre_lineabase; ?> | Meta Cuatrenio: <?php echo $mre_valorcuatrenio; ?> </strong> | <img src="img/ico/<?php echo $imgtipomr; ?>" />


                            <div class="tbl-header">
                               <table id="ordenar" class="tablaFijaCss">
                                   <thead>
                                   <tr>
                                       <th width="3%">&nbsp;&nbsp;Nro.</th>
                                       <th width="40%">Metas de Producto </th>
                                       <th>P</th>
                                       <th>LB</th>
                                       <th>MC</th>
                                       <th>O</th>
                                       <th>TP</th>
                                       <th>V 2016 </th>
                                       <th>V 2017 </th>
                                       <th>V 2018 </th>
                                       <th>V 2019 </th>
                                       <th width="6.7%">&nbsp;</th>
                                   </tr>
                                   </thead>
                              </table>
                            </div>


                            <div class="tbl-content">
                            <table class="tablaFijaCss">


                                   <?php
                                   //Lista Meta de Procuto
                                   $numeroregistro=1;
                                    while($data_metaproducto=$cnxn_pag->obtener_filas($meta_producto)){

                                        $mpr_codigo=$data_metaproducto['mpr_codigo'];
                                        $mpr_descripcion=$data_metaproducto['mpr_descripcion'];
                                        $mpr_lineabase=$data_metaproducto['mpr_lineabase'];
                                        $mpr_valorcuatrenio=$data_metaproducto['mpr_valorcuatrenio'];
                                        $mpr_codificacion=$data_metaproducto['mpr_codificacion'];
                                        $mpr_indicador=$data_metaproducto['mpr_indicador'];
                                        $mpr_entidadresponsable=$data_metaproducto['mpr_entidadresponsable'];
                                        $mpr_personaresponsable=$data_metaproducto['mpr_personaresponsable'];
                                        $mpr_sectornn=$data_metaproducto['mpr_sectornn'];
                                        $mpr_odsproducto=$data_metaproducto['mpr_odsproducto'];
                                        $mpr_ponderacion=$data_metaproducto['mpr_ponderacion'];
                                        $mpr_tendenciapositiva=$data_metaproducto['mpr_tendenciapositiva'];

                                        // INICIO MOSTAR TODOS LOS VALORES DE LA VIGENCIAS POR META DE PRODUCTO

                                        $valor_allesperadomp = $principal_sql->valor_esperadoall($cnxn_pag, $mpr_codigo);


                                        $todas_vigencias="";
                                          while($data_allvaloresperadomp=$cnxn_pag->obtener_filas($valor_allesperadomp)){
                                              $ves_vigencia=$data_allvaloresperadomp['ves_vigencia'];
                                              $ves_valorall[$ves_vigencia]=$data_allvaloresperadomp['ves_valor'];
                                              $todas_vigencias.=$ves_valorall[$ves_vigencia]." ";
                                          }

                                        // FIN MOSTAR TODOS LOS VALORES DE LA VIGENCIAS POR META DE PRODUCTO

                                        $total_ponderacion=$total_ponderacion+$mpr_ponderacion;

                                        if($mpr_tendenciapositiva=='1'){
                                          $tendenciap='Incremento';
                                        }
                                        elseif($mpr_tendenciapositiva=='2') {
                                          $tendenciap='Reducción';
                                        }
                                        else {
                                          $tendenciap='';
                                        }

                                        if($mpr_ponderacion==''){
                                          $mpr_ponderacion=0;
                                        }
                                        else{
                                          $mpr_ponderacion=$data_metaproducto['mpr_ponderacion'];
                                        }

                                        if($mpr_lineabase > $mpr_valorcuatrenio){
                                          $imgtipo="diminuye.png";
                                          $tipometa='Reducción';
                                          $orientacion='R';
                                        }
                                        elseif($mpr_lineabase==$mpr_valorcuatrenio){
                                          $imgtipo="mantiene.png";
                                          $tipometa='Mantiene';
                                          $orientacion='M';
                                        }
                                        else{
                                          $imgtipo="incremento.png";
                                          $tipometa='Aumenta';
                                          $orientacion='A';
                                        }


                                        $valor_esperadomp = $principal_sql->valor_esperadoall($cnxn_pag, $mpr_codigo);





                                    ?>

                                    <tr>
                                      <td width="3%" class="text-left"><?php echo $numeroregistro; ?></td>
                                      <td width="40.1%" style=" text-align: left"><?php echo $mpr_descripcion; ?></td>
                                      <td class="text-center">
                                          <div class="tooltip ponderacionmp<?php echo $mpr_codigo; ?> ponderacionmepro" data-codigometaproducto='<?php echo $mpr_codigo; ?>'>
                                              <a href="javascript:void(0);" class="edit" title="">

                                                  <?php echo $mpr_ponderacion; ?>
                                              </a>

                                              <span class="tooltiptext">
                                                         <img src="img/ico/editar-v.png" />
                                              </span>

                                      </div>



                                      </td>

                                      <td style='text-align:center; background:<?php echo $color_rojo; ?>'><?php echo $mpr_lineabase; ?></td>
                                      <td style='text-align:center; background:<?php echo $color_rojo; ?>'><?php echo $mpr_valorcuatrenio; ?></td>
                                      <td cstyle='text-align:center;'><img src="img/ico/<?php echo $imgtipo; ?>" /></td>
                                      <td cstyle='text-align:center;'><?php echo $tendenciap;  ?></td>
                                      <?php
                                        while($data_valoresperado=$cnxn_pag->obtener_filas($valor_esperadomp)){
                                          $ves_codigo=$data_valoresperado['ves_codigo'];
                                          $ves_metaproducto=$data_valoresperado['ves_metaproducto'];
                                          $ves_tipovalor=$data_valoresperado['ves_tipovalor'];
                                          $ves_valor=$data_valoresperado['ves_valor'];
                                          $ves_vigencia=$data_valoresperado['ves_vigencia'];

                                          $acumulado_ejecutadomp = $principal_sql->valor_ejecutadovigenciamp($cnxn_pag, $mpr_codigo, $ves_vigencia);


                                          $datavalor_ejecutadomp= $cnxn_pag->obtener_filas($acumulado_ejecutadomp);
                                          $valorejecutadomp=$datavalor_ejecutadomp['total_vigenciamp'];
                                          $valorporvigencia[$ves_vigencia]=$ves_valor;


                                      ?>
                                          <td><?php echo $ves_valor; ?> | <?php echo $valorejecutadomp; ?></td>
                                      <?php

                                        }
                                      ?>
                                      <td width="6.7%">
                                        <!--  <input type='button' class='valor_vigencias' data-codigometaproducto='<?php echo $mpr_codigo; ?>' onClick='modal_vigencia("<?php echo $mpr_codigo; ?>","<?php echo $codigo_programa; ?>");' />
                                          <input type='button' class='valor_vigencias' data-codigometaproducto='<?php echo $mpr_codigo; ?>' /> -->
                                        <div class="tooltip" data-codigometaproducto='<?php echo $mpr_codigo; ?>'>
                                           <a class="edit new-btn" title="" href="Javascript:valor_vigencia('<?php echo $mpr_codigo; ?>','<?php echo $codigo_programa; ?>','<?php echo $orientacion; ?>');" class="new-btn" ><img src="img/ico/editar.png" /></a>
                                           <span class="tooltiptext nw">Editar</span>
                                           </div>

                                      </td>
                                    </tr>

                                    <?php
                                    $numeroregistro++;

                                    }
                                    // fin lista de meta de producto
                                    //$total_ponderacion=100;
                                      if($total_ponderacion!=100){
                                        $color_ponderacion=" style='color:red;' ";
                                      }
                                      else {
                                        $color_ponderacion="";
                                      }
                                    ?>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td style=" text-align: right"><strong>Total Ponderación </strong></td>
                                      <td class="totalponderacion<?php echo $mre_codigo; ?>">
                                        <span <?php echo $color_ponderacion; ?>><strong><?php echo $total_ponderacion; ?></strong></span>
                                      </td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>


                               </table>

                                </div>


                             </div>


                          <?php

                            }
                            // Fin Lista Meta de Resultado
                          ?>

                          <script type="text/javascript">
                              $(".ponderacionmepro").click(function(){
                                var codigo_metaproducto = $(this).data("codigometaproducto");
                                //alert('Codigo MP: '+codigo_metaproducto);
                                armarModal($(this).attr("id"),1,true,"","ponderacionmepro","codigo_metaproducto="+codigo_metaproducto);
                              });
                          </script>

                          <!-- INICIO MODAL -->
                          <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                </div>
                                <div class="modal-body">
                                  <p>   .</p>
                                </div>
                                <div class="modal-footer">
                                  <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> -->
                                </div>
                              </div>

                            </div>
                          </div>
                          <!-- FIN MODAL -->

                          <!-- INICIO MODAL vigencias-->
                          <div class="modal fade" id="myModalVigencia" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                </div>
                                <div class="modal-body">
                                  <p>Vigencias</p>
                                </div>
                                <div class="modal-footer">
                                 <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> -->
                                </div>
                              </div>

                            </div>
                          </div>
                          <!-- FIN MODAL vigencias-->

                          <script type="text/javascript">
                                $(document).ready(function(){
                        							$(".cerrar-modal").click(function() {
                        								$(".encimaModal").fadeOut(300, function(){
                        									$(".encima").fadeOut(300);
                        								});
                        							});
                                });

                              function valor_vigencia(codigo_metaproducto, codigo_programa, orientacion){

                                    var codigo_metaproducto = codigo_metaproducto;
                                    var codigo_programa = codigo_programa;
                                    var orientacion = orientacion;
                                    //var codigo_valorejecutado = $(this).data("codigovalorejecutado");
                                    //alert(codigo_metaproducto + ' :: ' + codigo_metaproducto);

                                    $.ajax({
                                      url:"vigenciavalor",
                                      type:"POST",
                                      data:"codigo_metaproducto="+codigo_metaproducto+"&codigo_programa="+codigo_programa+"&orientacion="+orientacion,
                                      async:true,

                                      success: function(message){
                                        $("#modalContenido").empty().append(message);
                                        //$("#modalContenido").html("<h2>El M/pio seleccionado es: " + code + "</h2>");

                        								$(".encima").fadeIn(300, function(){
                        									$(".encimaModal").fadeIn(300);
                        								});
                                      }
                                    });


                        				}
                          </script>






                           <script type="text/javascript" src="js/acordeon.js"></script>





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
