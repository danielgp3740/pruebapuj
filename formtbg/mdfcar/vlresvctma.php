<?php

$codigo_metapro=$_REQUEST['codigo_metaproducto'];
$codigo_ejecucionvalor=$_REQUEST['codigo_valorejecutado'];

$sql_novervictima=" SELECT mvi_victima
                   FROM mepro_victima WHERE mvi_ejecucion=$codigo_ejecucionvalor ";

$meta_productovi = $principal_sql->meproid($cnxn_pag, $codigo_metapro);
$data_valormp=$cnxn_pag->obtener_filas($meta_productovi);
$mpr_descripcion=$data_valormp['mpr_descripcion'];
$mpr_lineabase=$data_valormp['mpr_lineabase'];
$mpr_valorcuatrenio=$data_valormp['mpr_valorcuatrenio'];


$valor_esperadomp_modificar = $principal_sql->valor_esperado($cnxn_pag, $codigo_metapro);



$victima_poblacion = $principal_sql->poblacion_victima($cnxn_pag);


$totalejecutado_victima_modificar= $principal_sql->totalejecutado_victima($cnxn_pag,$codigo_metapro,$codigo_ejecucionvalor);
$victima_no = $principal_sql->victimaid($cnxn_pag, $mvi_victima, $sql_novervictima);



//echo $victima_no;
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

<form id="formulario" class='frm_vejecutadovictima' name="frm_vejecutadovictima" action="modificarvaloresvictima" method="post" >

  <div class="recuadro">
        <div id="titulo" class="titulo">
             Valores Población Victima
                <div class="bloDr">
                  <?php
                     if ($dpl_proceso=='0') {
                      echo "";
                     }
                     else {
                  ?>

                    <input type="button" onclick="modificar_victima();" value='' class="guardar-modal" alt="Guardar" title="Guardar">
                  <?php
                    }
                 ?>
                 <input type="button" class='cerrar-modal' value='' alt="Cerrar" title="Cerrar">

               </div>
           </div>
					 <div class="espacio al60"></div>

           <div class="col-md-12  mp no-padding">
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
                $numero_victima=1;
                while($data_victimavalor=$cnxn_pag->obtener_filas($totalejecutado_victima_modificar)){
                    $mvi_codigo=$data_victimavalor['mvi_codigo'];
                    $mvi_mepro=$data_victimavalor['mvi_mepro'];
                    $mvi_victima=$data_victimavalor['mvi_victima'];
                    $mvi_valor=$data_victimavalor['mvi_valor'];

                    $poblacion_victimaid = $principal_sql->victimaid($cnxn_pag, $mvi_victima, $sqlno_victima);
                    //echo $poblacion_victimaid."<br>";
                    $data_victimaid=$cnxn_pag->obtener_filas($poblacion_victimaid);

                    $pvi_codigoid=$data_victimaid['pvi_codigo'];
                    $pvi_nombreid=$data_victimaid['pvi_nombre'];


                ?>
                <div class="col-md-4">
                  <label>
                      <input checked type="checkbox" class="checkbox" name="chk_victima<?php echo $numero_victima; ?>" id="chk_victima<?php echo $numero_victima; ?>" onclick='checkear_poblacionvictima("<?php echo $numero_victima;?>");' value="1" name="chk_victima<?php echo $numero_victima; ?>" />
                      <?php echo $pvi_nombreid; ?>
                  </label>

                     <input value='<?php echo $mvi_valor; ?>' type="number" step="0.001" id="txt_victima<?php echo $numero_victima; ?>" name="txt_victima<?php echo $numero_victima; ?>"  data-rule-required="true" autocomplete="on" data-msg-required="Digite <?php echo $pvi_nombreid; ?>" data-msg-minlength="Dato muy corto." />
                     <input type="hidden" name="txt_codigovictima<?php echo $numero_victima; ?>" id="txt_codigovictima<?php echo $numero_victima; ?>" value="<?php echo $pvi_codigoid; ?>" />
                </div>

                <?php
                $numero_victima++;
                }
               ?>


                 <?php

                     while($data_victima=$cnxn_pag->obtener_filas($victima_no)){

                         $pvi_codigo=$data_victima['pvi_codigo'];
                         $pvi_nombre=$data_victima['pvi_nombre'];


                 ?>
                     <div class="col-md-4">
                       <label>
                           <input type="checkbox" class="checkbox" name="chk_victima<?php echo $numero_victima; ?>" id="chk_victima<?php echo $numero_victima; ?>" onclick='checkear_poblacionvictima("<?php echo $numero_victima; ?>");' value="1" name="chk_victima<?php echo $numero_victima; ?>" />
                           <?php echo $pvi_nombre; ?>
                       </label>

                          <input type="number" step="0.001" style='display:none;' id="txt_victima<?php echo $numero_victima; ?>" name="txt_victima<?php echo $numero_victima; ?>"  data-rule-required="true" autocomplete="on" data-msg-required="Digite <?php echo $pvi_nombre; ?>" data-msg-minlength="Dato muy corto." />
                          <input type="hidden" name="txt_codigovictima<?php echo $numero_victima; ?>" id="txt_codigovictima<?php echo $numero_victima; ?>" value="<?php echo $pvi_codigo; ?>" />
                     </div>

                 <?php
                     $numero_victima++;
                     }

                  ?>
          </div>
          <input type="hidden" name="txt_numerovictima" id="txt_numerovictima" value="<?php echo $numero_victima; ?>" />
          <input type="hidden" name="txt_codigoejecucion" id="txt_codigoejecucion" value="<?php echo $codigo_ejecucionvalor; ?>" />
          <input type="hidden" name="txt_codigomepro" id="txt_codigomepro" value="<?php echo $codigo_metapro; ?>" />
          <input type="hidden" name="txt_fechareporte" id="txt_fechareporte" value="<?php echo $fre_fechareporte; ?>" />
        </div>
</form>
<script type='text/javascript'>

      function checkear_poblacionvictima(numero_victima){
        var id_victima=numero_victima;
         var respuesta_victima=$('input:checkbox[name=chk_victima'+id_victima+']:checked').val();
         if(respuesta_victima==1){
           $('#txt_victima'+id_victima).fadeIn(600);
           $('#txt_victima'+id_victima).focus();
         }
         else{
           $('#txt_victima'+id_victima).fadeOut(600);
         }

      }


      function modificar_victima(){
					var data_enviar=$('.frm_vejecutadovictima').serialize();
						$.post("modificarvaloresvictima",data_enviar,
								function(data_enviar, status){
									 //alert("Data: " + data + "\nStatus: " + status);

										$("tbody#datos_mepro<?php echo $codigo_metapro; ?>").load('reportexvigenciamepro?codigo_mepro=<?php echo $codigo_metapro; ?>');

										$(".encimaModal").fadeOut(300, function(){
												$(".encima").fadeOut(300);
										});

							});
			}

</script>
