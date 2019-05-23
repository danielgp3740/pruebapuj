<?php

$codigo_metapro=$_REQUEST['codigo_metaproducto'];
$codigo_ejecucionvalor=$_REQUEST['codigo_valorejecutado'];

$sql_noveredad=" SELECT med_edad
                   FROM mepro_edad WHERE med_ejecucion=$codigo_ejecucionvalor ";

$meta_productovi = $principal_sql->meproid($cnxn_pag, $codigo_metapro);
$data_valormp=$cnxn_pag->obtener_filas($meta_productovi);
$mpr_descripcion=$data_valormp['mpr_descripcion'];
$mpr_lineabase=$data_valormp['mpr_lineabase'];
$mpr_valorcuatrenio=$data_valormp['mpr_valorcuatrenio'];


$valor_esperadomp_modificar = $principal_sql->valor_esperado($cnxn_pag, $codigo_metapro);



$edad_poblacion = $principal_sql->poblacion_edad($cnxn_pag);


$totalejecutado_edad_modificar= $principal_sql->totalejecutado_edad($cnxn_pag,$codigo_metapro,$codigo_ejecucionvalor);
$edad_no = $principal_sql->edadid($cnxn_pag, $med_genero, $sql_noveredad);

/*
$metafechareporte_periodo = $principal_sql->estadofechareporte_sql($cnxn_pag);
$data_fechareporte=$cnxn_pag->obtener_filas($metafechareporte_periodo);
$fre_fechareporte = $data_fechareporte['fre_codigo'];
$fre_fechaperiodo = $data_fechareporte['fre_fechareporte'];
*/
//echo $fuentes_financiacionid_no;
?>
<!--<script type='text/javascript'>
      function ancho_titulo(){
        var ancho_encimaModal = $(".encimaModal").width()-30;
    //  alert(' ::: ' + ancho_encimaModal);
        $("#titulo.titulo").css({ 'width': +ancho_encimaModal+'px' });
      }
      ancho_titulo();
</script>-->
<script type='text/javascript' src="js/titulo_fijo.js"></script>

<script type="text/javascript">
$(document).ready(function(){
      $(".cerrar-modal").click(function() {
        $(".encimaModal").fadeOut(300, function(){
          $(".encima").fadeOut(300);
        });
      });
});

</script>

<form id="formulario" class='frm_vejecutadogenero' name="frm_vejecutadogenero" action="procesomodificaredad" method="post" >

  <div class="recuadro">
        <div id="titulo" class="titulo">
             Valores Población por Edad
                <div class="bloDr">
                  <?php
     								 if ($dpl_proceso=='0') {
     								 	echo "";
     								 }
     								 else {
 								 	?>

                    <input type="button" onclick="modificar_edad();" value='' class="guardar-modal" alt="Guardar" title="Guardar">
 									<?php
 								 		}
 								 ?>
                 <input type="button" class='cerrar-modal' value='' alt="Cerrar" title="Cerrar">

               </div>
           </div>
					 <div class="espacio al60"></div>

           <div class="col-md-12 mp no-padding">
                <p> <img src="img/ico/meta_producto.png"> <?php echo $mpr_descripcion; ?></p>
           </div>

           <div class="col-md-12 bg-title">
                 <strong>Linea Base: <?php echo $mpr_lineabase; ?></strong> | <strong>Valor Cuatrenio: <?php echo $mpr_valorcuatrenio; ?></strong>
           </div>

           <div class="col-md-12 bg-g">
             <br>
                 <?php
                 while($data_valoresperado=$cnxn_pag->obtener_filas($valor_esperadomp_modificar)){
                   $ves_codigo=$data_valoresperado['ves_codigo'];
                   $ves_metaproducto=$data_valoresperado['ves_metaproducto'];
                   $ves_tipovalor=$data_valoresperado['ves_tipovalor'];
                   $ves_valor=$data_valoresperado['ves_valor'];
                   $ves_vigencia=$data_valoresperado['ves_vigencia'];
                   ?>
                     | &nbsp;<strong> Vigencia <?php echo $ves_vigencia; ?>:</strong> <?php echo $ves_valor; ?> &nbsp;|

                   <?php
                   }
                    ?>
              </div>
              <span class="balls __web-inspector-hide-shortcut__">Este valor es acumulable para la vigencia</span>
              <div class="col-md-12">
                <?php
                $numero_genero=1;
                while($data_edadvalor=$cnxn_pag->obtener_filas($totalejecutado_edad_modificar)){

                    $med_codigo=$data_edadvalor['med_codigo'];
                    $med_mepro=$data_edadvalor['med_mepro'];
                    $med_edad=$data_edadvalor['med_edad'];
                    $med_valor=$data_edadvalor['med_valor'];

                    $poblacion_edadid = $principal_sql->edadid($cnxn_pag,$med_edad, $sqlno_edad);
                    //echo $fuentes_financiacionid."<br>";
                    $data_edadid=$cnxn_pag->obtener_filas($poblacion_edadid);

                    $ped_codigoid=$data_edadid['ped_codigo'];
                    $ped_descripcionid=$data_edadid['ped_descripcion'];


                ?>
                <div class="col-md-4">
                  <label>
                      <input checked type="checkbox" class="checkbox" name="chk_genero<?php echo $numero_genero; ?>" id="chk_genero<?php echo $numero_genero; ?>" onclick='checkear_poblaciongenero("<?php echo $numero_genero;?>");' value="1" name="chk_genero<?php echo $numero_genero; ?>" />
                      <?php echo $ped_descripcionid; ?>
                  </label>

                     <input value='<?php echo $med_valor; ?>' type="number" step="0.001" id="txt_genero<?php echo $numero_genero; ?>" name="txt_genero<?php echo $numero_genero; ?>"  data-rule-required="true" autocomplete="on" data-msg-required="Digite <?php echo $ped_descripcionid; ?>" data-msg-minlength="Dato muy corto." />
                     <input type="hidden" name="txt_codigogenero<?php echo $numero_genero; ?>" id="txt_codigogenero<?php echo $numero_genero; ?>" value="<?php echo $ped_codigoid; ?>" />
                </div>

                <?php
                $numero_genero++;
                }
               ?>


                 <?php

                     while($data_edad=$cnxn_pag->obtener_filas($edad_no)){

                         $ped_codigo=$data_edad['ped_codigo'];
                         $ped_descripcion=$data_edad['ped_descripcion'];


                 ?>
                     <div class="col-md-4">
                       <label>
                           <input type="checkbox" class="checkbox" name="chk_genero<?php echo $numero_genero; ?>" id="chk_genero<?php echo $numero_genero; ?>" onclick='checkear_poblaciongenero("<?php echo $numero_genero;?>");' value="1" name="chk_genero<?php echo $numero_genero; ?>" />
                           <?php echo $ped_descripcion; ?>
                       </label>

                          <input type="number" step="0.001" style='display:none;' id="txt_genero<?php echo $numero_genero; ?>" name="txt_genero<?php echo $numero_genero; ?>"  data-rule-required="true" autocomplete="on" data-msg-required="Digite <?php echo $plg_nombre; ?>" data-msg-minlength="Dato muy corto." />
                          <input type="hidden" name="txt_codigogenero<?php echo $numero_genero; ?>" id="txt_codigogenero<?php echo $numero_genero; ?>" value="<?php echo $ped_codigo; ?>" />
                     </div>

                 <?php
                     $numero_genero++;
                     }

                  ?>
          </div>
          <input type="hidden" name="txt_numerogenero" id="txt_numerogenero" value="<?php echo $numero_genero; ?>" />
          <input type="hidden" name="txt_codigoejecucion" id="txt_codigoejecucion" value="<?php echo $codigo_ejecucionvalor; ?>" />
          <input type="hidden" name="txt_codigomepro" id="txt_codigomepro" value="<?php echo $codigo_metapro; ?>" />
          <input type="hidden" name="txt_fechareporte" id="txt_fechareporte" value="<?php echo $fre_fechareporte; ?>" />
        </div>
</form>
<script type='text/javascript'>

      function checkear_poblaciongenero(numero_genero){
        var id_genero=numero_genero;
         var respuesta_genero=$('input:checkbox[name=chk_genero'+id_genero+']:checked').val();
         if(respuesta_genero==1){
           $('#txt_genero'+id_genero).fadeIn(600);
           $('#txt_genero'+id_genero).focus();
         }
         else{
           $('#txt_genero'+id_genero).fadeOut(600);
         }

      }
/*
      $(document).ready(function() {
          $(".frm_vejecutadogenero").submit(function() {
            // Enviamos el formulario usando AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                // Mostramos un mensaje con la respuesta de PHP
                success: function(message) {
                    $("#resultado_consulta").empty().append(message);
                }
            });

            $(".encimaModal").fadeOut(300, function(){
              $(".encima").fadeOut(300);
            });

            return false;

          });
      });

*/

			function modificar_edad(){
					var data_enviar=$('.frm_vejecutadogenero').serialize();
						$.post("procesomodificaredad",data_enviar,
								function(data_enviar, status){
									 //alert("Data: " + data + "\nStatus: " + status);

										$("tbody#datos_mepro<?php echo $codigo_metapro; ?>").load('reportexvigenciamepro?codigo_mepro=<?php echo $codigo_metapro; ?>');

										$(".encimaModal").fadeOut(300, function(){
												$(".encima").fadeOut(300);
										});

							});
			}


</script>