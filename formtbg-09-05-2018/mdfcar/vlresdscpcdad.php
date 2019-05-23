<?php

$codigo_metapro=$_REQUEST['codigo_metaproducto'];
$codigo_ejecucionvalor=$_REQUEST['codigo_valorejecutado'];

$sql_noverdiscapacidad=" SELECT mdi_discapacidad
                   FROM mepro_discapacidad WHERE mdi_ejecucion=$codigo_ejecucionvalor ";

$meta_productovi = $principal_sql->meproid($cnxn_pag, $codigo_metapro);
$data_valormp=$cnxn_pag->obtener_filas($meta_productovi);
$mpr_descripcion=$data_valormp['mpr_descripcion'];
$mpr_lineabase=$data_valormp['mpr_lineabase'];
$mpr_valorcuatrenio=$data_valormp['mpr_valorcuatrenio'];


$valor_esperadomp_modificar = $principal_sql->valor_esperado($cnxn_pag, $codigo_metapro);



$discapacidad_poblacion = $principal_sql->poblacion_discapacidad($cnxn_pag);


$totalejecutado_discapacidad_modificar= $principal_sql->totalejecutado_discapacidad($cnxn_pag,$codigo_metapro,$codigo_ejecucionvalor);
$discapacidad_no = $principal_sql->discapacidadid($cnxn_pag, $mdi_discapacidad, $sql_noverdiscapacidad);

//echo $victima_no;
?>

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

<form id="formulario" class='frm_vejecutadodiscapacidad' name="frm_vejecutadodiscapacidad" action="modificarvaloresdiscapacidad" method="post" >

  <div class="recuadro">
        <div id="titulo" class="titulo">
             Valores Población Discapacitada
             <div class="bloDr">
               <?php
                  if ($dpl_proceso=='0') {
                   echo "";
                  }
                  else {
               ?>
                 <input type="submit" value='' class="guardar-modal" alt="Guardar" title="Guardar">
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
                $numero_discapacidad=1;
                while($data_discapacidadvalor=$cnxn_pag->obtener_filas($totalejecutado_discapacidad_modificar)){
                    $mdi_codigo=$data_discapacidadvalor['mdi_codigo'];
                    $mdi_mepro=$data_discapacidadvalor['mdi_mepro'];
                    $mdi_discapacidad=$data_discapacidadvalor['mdi_discapacidad'];
                    $mdi_valor=$data_discapacidadvalor['mdi_valor'];

                    $poblacion_discapacidadid = $principal_sql->discapacidadid($cnxn_pag, $mdi_discapacidad, $sqlno_discapacidad);
                    //echo $poblacion_victimaid."<br>";
                    $data_discapacidadid=$cnxn_pag->obtener_filas($poblacion_discapacidadid);

                    $pdi_codigoid=$data_discapacidadid['tdi_codigo'];
                    $pdi_nombreid=$data_discapacidadid['tdi_nombre'];


                ?>
                <div class="col-md-4">
                  <label>
                      <input checked type="checkbox" class="checkbox" name="chk_discapacidad<?php echo $numero_discapacidad; ?>" id="chk_discapacidad<?php echo $numero_discapacidad; ?>" onclick='checkear_poblaciondiscapacidad("<?php echo $numero_discapacidad; ?>");' value="1" name="chk_discapacidad<?php echo $numero_discapacidad; ?>" />
                      <?php echo $pdi_nombreid; ?>
                  </label>

                     <input value='<?php echo $mdi_valor; ?>' type="number" step="0.001" id="txt_discapacidad<?php echo $numero_discapacidad; ?>" name="txt_discapacidad<?php echo $numero_discapacidad; ?>"  data-rule-required="true" autocomplete="on" data-msg-required="Digite <?php echo $pdi_nombreid; ?>" data-msg-minlength="Dato muy corto." />
                     <input type="hidden" name="txt_codigodiscapacidad<?php echo $numero_discapacidad; ?>" id="txt_codigodiscapacidad<?php echo $numero_discapacidad; ?>" value="<?php echo $pdi_codigoid; ?>" />
                </div>

                <?php
                $numero_discapacidad++;
                }
               ?>


                 <?php

                     while($data_discapacidad=$cnxn_pag->obtener_filas($discapacidad_no)){

                         $pdi_codigo=$data_discapacidad['tdi_codigo'];
                         $pdi_nombre=$data_discapacidad['tdi_nombre'];


                 ?>
                     <div class="col-md-4">
                       <label>
                           <input type="checkbox" class="checkbox" name="chk_discapacidad<?php echo $numero_discapacidad; ?>" id="chk_discapacidad<?php echo $numero_discapacidad; ?>" onclick='checkear_poblaciondiscapacidad("<?php echo $numero_discapacidad; ?>");' value="1" name="chk_discapacidad<?php echo $numero_discapacidad; ?>" />
                           <?php echo $pdi_nombre; ?>
                       </label>

                          <input type="number" step="0.001" style='display:none;' id="txt_discapacidad<?php echo $numero_discapacidad; ?>" name="txt_discapacidad<?php echo $numero_discapacidad; ?>"  data-rule-required="true" autocomplete="on" data-msg-required="Digite <?php echo $pdi_nombre; ?>" data-msg-minlength="Dato muy corto." />
                          <input type="hidden" name="txt_codigodiscapacidad<?php echo $numero_discapacidad; ?>" id="txt_codigodiscapacidad<?php echo $numero_discapacidad; ?>" value="<?php echo $pdi_codigo; ?>" />
                     </div>

                 <?php
                     $numero_discapacidad++;
                     }

                  ?>
          </div>
          <input type="hidden" name="txt_numerodiscapacidad" id="txt_numerodiscapacidad" value="<?php echo $numero_discapacidad; ?>" />
          <input type="hidden" name="txt_codigoejecucion" id="txt_codigoejecucion" value="<?php echo $codigo_ejecucionvalor; ?>" />
          <input type="hidden" name="txt_codigomepro" id="txt_codigomepro" value="<?php echo $codigo_metapro; ?>" />
        </div>
</form>
<script type='text/javascript'>

      function checkear_poblaciondiscapacidad(numero_discapacidad){
        var id_discapacidad=numero_discapacidad;
         var respuesta_discapacidad=$('input:checkbox[name=chk_discapacidad'+id_discapacidad+']:checked').val();
         if(respuesta_discapacidad==1){
           $('#txt_discapacidad'+id_discapacidad).fadeIn(600);
           $('#txt_discapacidad'+id_discapacidad).focus();
         }
         else{
           $('#txt_discapacidad'+id_discapacidad).fadeOut(600);
         }

      }

      $(document).ready(function() {
          $(".frm_vejecutadodiscapacidad").submit(function() {
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



</script>
