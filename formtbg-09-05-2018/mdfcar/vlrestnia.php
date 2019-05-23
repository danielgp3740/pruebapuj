<?php

$codigo_metapro=$_REQUEST['codigo_metaproducto'];
$codigo_ejecucionvalor=$_REQUEST['codigo_valorejecutado'];

$sql_noveretnia=" SELECT met_etnia
                   FROM mepro_etnia WHERE met_ejecucion=$codigo_ejecucionvalor ";

$meta_productovi = $principal_sql->meproid($cnxn_pag, $codigo_metapro);
$data_valormp=$cnxn_pag->obtener_filas($meta_productovi);
$mpr_descripcion=$data_valormp['mpr_descripcion'];
$mpr_lineabase=$data_valormp['mpr_lineabase'];
$mpr_valorcuatrenio=$data_valormp['mpr_valorcuatrenio'];


$valor_esperadomp_modificar = $principal_sql->valor_esperado($cnxn_pag, $codigo_metapro);



$etnia_poblacion = $principal_sql->poblacion_etnia($cnxn_pag);


$totalejecutado_etnia_modificar= $principal_sql->totalejecutado_etnia($cnxn_pag,$codigo_metapro,$codigo_ejecucionvalor);
$etnia_no = $principal_sql->etniaid($cnxn_pag, $met_etnia, $sql_noveretnia);

//echo $victima_no;
?>
<!--
<script type='text/javascript'>
      function ancho_titulo(){
        var ancho_encimaModal = $(".encimaModal").width()-30;
    //  alert(' ::: ' + ancho_encimaModal);
        $("#titulo.titulo").css({ 'width': +ancho_encimaModal+'px' });
      }
      ancho_titulo();
</script>
-->
<script type='text/javascript' src="js/titulo_fijo.js"></script>
<script type='text/javascript'>

      $(document).ready(function(){
      $(".cerrar-modal").click(function() {
        $(".encimaModal").fadeOut(300, function(){
          $(".encima").fadeOut(300);
        });
      });
});
</script>

<form id="formulario" class='frm_vejecutadoetnia' name="frm_vejecutadoetnia" action="modificarvaloresetnia" method="post" >

  <div class="recuadro">
        <div id="titulo" class="titulo">
             Valores Población Etnica
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
                $numero_etnia=1;
                while($data_etniavalor=$cnxn_pag->obtener_filas($totalejecutado_etnia_modificar)){
                    $met_codigo=$data_etniavalor['met_codigo'];
                    $met_mepro=$data_etniavalor['met_mepro'];
                    $met_etnia=$data_etniavalor['met_etnia'];
                    $met_valor=$data_etniavalor['met_valor'];

                    $poblacion_etniaid = $principal_sql->etniaid($cnxn_pag, $met_etnia, $sqlno_etnia);
                    //echo $poblacion_victimaid."<br>";
                    $data_etniaid=$cnxn_pag->obtener_filas($poblacion_etniaid);

                    $pet_codigoid=$data_etniaid['pet_codigo'];
                    $pet_nombreid=$data_etniaid['pet_nombre'];


                ?>
                <div class="col-md-4">
                  <label>
                      <input checked type="checkbox" class="checkbox" name="chk_etnia<?php echo $numero_etnia; ?>" id="chk_etnia<?php echo $numero_etnia; ?>" onclick='checkear_poblacionetnia("<?php echo $numero_etnia; ?>");' value="1" name="chk_etnia<?php echo $numero_etnia; ?>" />
                      <?php echo $pet_nombreid; ?>
                  </label>

                     <input value='<?php echo $met_valor; ?>' type="number" step="0.001" id="txt_etnia<?php echo $numero_etnia; ?>" name="txt_etnia<?php echo $numero_etnia; ?>"  data-rule-required="true" autocomplete="on" data-msg-required="Digite <?php echo $pet_nombreid; ?>" data-msg-minlength="Dato muy corto." />
                     <input type="hidden" name="txt_codigoetnia<?php echo $numero_etnia; ?>" id="txt_codigoetnia<?php echo $numero_etnia; ?>" value="<?php echo $pet_codigoid; ?>" />
                </div>

                <?php
                $numero_etnia++;
                }
               ?>


                 <?php

                     while($data_etnia=$cnxn_pag->obtener_filas($etnia_no)){

                         $pet_codigo=$data_etnia['pet_codigo'];
                         $pet_nombre=$data_etnia['pet_nombre'];


                 ?>
                     <div class="col-md-4">
                       <label>
                           <input type="checkbox" class="checkbox" name="chk_etnia<?php echo $numero_etnia; ?>" id="chk_etnia<?php echo $numero_etnia; ?>" onclick='checkear_poblacionetnia("<?php echo $numero_etnia; ?>");' value="1" name="chk_etnia<?php echo $numero_etnia; ?>" />
                           <?php echo $pet_nombre; ?>
                       </label>

                          <input type="number" step="0.001" style='display:none;' id="txt_etnia<?php echo $numero_etnia; ?>" name="txt_etnia<?php echo $numero_etnia; ?>"  data-rule-required="true" autocomplete="on" data-msg-required="Digite <?php echo $pet_nombre; ?>" data-msg-minlength="Dato muy corto." />
                          <input type="hidden" name="txt_codigoetnia<?php echo $numero_etnia; ?>" id="txt_codigoetnia<?php echo $numero_etnia; ?>" value="<?php echo $pet_codigo; ?>" />
                     </div>

                 <?php
                     $numero_etnia++;
                     }

                  ?>
          </div>
          <input type="hidden" name="txt_numeroetnia" id="txt_numeroetnia" value="<?php echo $numero_etnia; ?>" />
          <input type="hidden" name="txt_codigoejecucion" id="txt_codigoejecucion" value="<?php echo $codigo_ejecucionvalor; ?>" />
          <input type="hidden" name="txt_codigomepro" id="txt_codigomepro" value="<?php echo $codigo_metapro; ?>" />
        </div>
</form>
<script type='text/javascript'>

      function checkear_poblacionetnia(numero_etnia){
        var id_etnia=numero_etnia;
         var respuesta_etnia=$('input:checkbox[name=chk_etnia'+id_etnia+']:checked').val();
         if(respuesta_etnia==1){
           $('#txt_etnia'+id_etnia).fadeIn(600);
           $('#txt_etnia'+id_etnia).focus();
         }
         else{
           $('#txt_etnia'+id_etnia).fadeOut(600);
         }

      }

      $(document).ready(function() {
          $(".frm_vejecutadoetnia").submit(function() {
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
