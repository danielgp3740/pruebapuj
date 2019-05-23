<?php

$codigo_metapro=$_REQUEST['codigo_metaproducto'];
$codigo_ejecucionvalor=$_REQUEST['codigo_valorejecutado'];

$sql_noverfufi="SELECT  mfu_fuentefinanciacion
		            FROM mepro_fufi WHERE mfu_ejecucion=$codigo_ejecucionvalor ";

$meta_productovi = $principal_sql->meproid($cnxn_pag, $codigo_metapro);
$data_valormp=$cnxn_pag->obtener_filas($meta_productovi);
$mpr_descripcion=$data_valormp['mpr_descripcion'];
$mpr_lineabase=$data_valormp['mpr_lineabase'];
$mpr_valorcuatrenio=$data_valormp['mpr_valorcuatrenio'];


$valor_esperadomp_modificar = $principal_sql->valor_esperado($cnxn_pag, $codigo_metapro);



$fuentes_financiacion = $principal_sql->fuentefinanciacion($cnxn_pag);


$totalejecutado_fufi_modificar= $principal_sql->totalejecutado_fufi($cnxn_pag,$codigo_metapro,$codigo_ejecucionvalor);
$fuentes_financiacionid_no = $principal_sql->fuentefinanciacionid($cnxn_pag, $mfu_fuentefinanciacion, $sql_noverfufi);
/*
$metafechareporte_periodo = $principal_sql->estadofechareporte_sql($cnxn_pag);
$data_fechareporte=$cnxn_pag->obtener_filas($metafechareporte_periodo);
$fre_fechareporte = $data_fechareporte['fre_codigo'];
$fre_fechaperiodo = $data_fechareporte['fre_fechareporte'];
*/
//echo $fuentes_financiacionid_no;
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

<script type="text/javascript">
$(document).ready(function(){
      $(".cerrar-modal").click(function() {
        $(".encimaModal").fadeOut(300, function(){
          $(".encima").fadeOut(300);
        });
      });
});

</script>

<form id="formulario" class='frm_vejecutadofifu' name="frm_vejecutadofifu" action="modificarfifuejecucion" method="post" >

  <div class="recuadro">
        <div id="titulo" class="titulo">
					<?php //echo $dpl_proceso; ?>
             Valores Fuentes de Financiación - (En Pesos $)
               <div class="bloDr">
								 <?php
								 if ($dpl_proceso=='0') {
								 	echo "";
								 }
								 else {
								 	?>


										<input type="button" onclick="modificar_fufi();" value='' class="guardar-modal" alt="Guardar" title="Guardar">

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
              <div class="col-md-12 no-padding">
                <?php
                $numero_fuentes=1;
                while($data_fufivalor=$cnxn_pag->obtener_filas($totalejecutado_fufi_modificar)){
                    $mfu_codigo=$data_fufivalor['mfu_codigo'];
                    $mfu_mepro=$data_fufivalor['mfu_mepro'];
                    $mfu_fuentefinanciacion=$data_fufivalor['mfu_fuentefinanciacion'];
                    $mfu_valor=$data_fufivalor['mfu_valor'];

                    $fuentes_financiacionid = $principal_sql->fuentefinanciacionid($cnxn_pag,$mfu_fuentefinanciacion, $sqlno_fifu);
                    //echo $fuentes_financiacionid."<br>";
                    $data_fufiid=$cnxn_pag->obtener_filas($fuentes_financiacionid);

                    $ffi_codigoid=$data_fufiid['ffi_codigo'];
                    $ffi_descripcionid=$data_fufiid['ffi_descripcion'];
                    $ffi_padreid=$data_fufiid['ffi_padre'];

										if($ffi_codigoid==4){
												$ayudafufi='<div class="tooltip "><a href="Javascript:void(0);" class ="">
																			<img class="media-object" src="img/ico/ayuda.png"  /> </a>
																			<span class="tooltiptext nw">
																						Corresponde a:
																						•	Ingresos corrientes de libre destino<br>
																						•	Licores<br>
																						•	Sobretasa a la gasolina<br>
																			</span>
																		</div>';

										}
										elseif($ffi_codigoid==10){
											$ayudafufi='<div class="tooltip "><a href="Javascript:void(0);" class ="">
											<img class="media-object" src="img/ico/ayuda.png" alt="Alerta" /> </a>
											<span class="tooltiptext nw">
											Corresponde:<br>
												•	Fondo seguridad<br>
												•	Iva licores<br>
												•	Cigarrillos deportes<br>
												•	Iva vinos y aperitivos deporte<br>
												•	Estampilla  pro cultura<br>
												•	Estampilla prodesarrollo <br>
												•	Estampilla pro electrificacion <br>
												•	Juegos de azar<br>
												•	Sobretasa cigarrillos <br>
												•	Sgp pensionados nacionalizados <br>
												•	Tranf. Coljuegos<br>
												•	Recursos esfuerzo propio finc regimen sub<br>
												•	Loterias<br>
												•	Juegos apuetas permanentes<br>
												•	Premios de suerte y azar no reclamado<br>
												</span>

												</div>
												';

										}
										else{
												$ayudafufi='';
										}





                ?>
                <div class="col-md-4">
                  <label>
                      <input checked type="checkbox" class="checkbox" name="chk_fuentes<?php echo $numero_fuentes; ?>" id="chk_fuentes<?php echo $numero_fuentes; ?>" onclick='validar_fuentefinaciacion("<?php echo $numero_fuentes;?>");' value="1" name="chk_fuentes<?php echo $numero_fuentes; ?>" />
                      <?php echo $ffi_descripcionid; ?> <?php echo $ayudafufi; ?>
                  </label>

                     <input value='<?php echo $mfu_valor; ?>' type="number" step="0.001" id="txt_fuentes<?php echo $numero_fuentes; ?>" name="txt_fuentes<?php echo $numero_fuentes; ?>"  data-rule-required="true" autocomplete="on" data-msg-required="Digite <?php echo $ffi_descripcionid; ?>" data-msg-minlength="Dato muy corto."  placeholder="Cifras en Pesos" />
                     <input type="hidden" name="txt_codigofuentes<?php echo $numero_fuentes; ?>" id="txt_codigofuentes<?php echo $numero_fuentes; ?>" value="<?php echo $ffi_codigoid; ?>" />
                     <input type="hidden" name="txt_codigofufi<?php echo $numero_fuentes; ?>" id="txt_codigofufi<?php echo $numero_fuentes; ?>" value="<?php echo $mfu_codigo; ?>" />
                </div>

                <?php
                $numero_fuentes++;
                }
               ?>


                 <?php

                     while($data_fuentefinanciacion=$cnxn_pag->obtener_filas($fuentes_financiacionid_no)){

                         $ffi_codigo=$data_fuentefinanciacion['ffi_codigo'];
                         $ffi_descripcion=$data_fuentefinanciacion['ffi_descripcion'];
                         $ffi_padre=$data_fuentefinanciacion['ffi_padre'];


												 if($ffi_codigo==4){
												 		$ayudafufi='<div class="tooltip "><a href="Javascript:void(0);" class ="">
												 									<img class="media-object" src="img/ico/ayuda.png" /> </a>
												 									<span class="tooltiptext nw">
												 												Corresponde a:
												 												•	Ingresos corrientes de libre destino<br>
												 												•	Licores<br>
												 												•	Sobretasa a la gasolina<br>
												 									</span>
												 								</div>';

												 }
												 elseif($ffi_codigo==10){
												 	$ayudafufi='<div class="tooltip "><a href="Javascript:void(0);" class ="">
												 	<img class="media-object" src="img/ico/ayuda.png" /> </a>
												 	<span class="tooltiptext nw">
												 	Corresponde:<br>
												 		•	Fondo seguridad<br>
												 		•	Iva licores<br>
												 		•	Cigarrillos deportes<br>
												 		•	Iva vinos y aperitivos deporte<br>
												 		•	Estampilla  pro cultura<br>
												 		•	Estampilla prodesarrollo <br>
												 		•	Estampilla pro electrificacion <br>
												 		•	Juegos de azar<br>
												 		•	Sobretasa cigarrillos <br>
												 		•	Sgp pensionados nacionalizados <br>
												 		•	Tranf. Coljuegos<br>
												 		•	Recursos esfuerzo propio finc regimen sub<br>
												 		•	Loterias<br>
												 		•	Juegos apuetas permanentes<br>
												 		•	Premios de suerte y azar no reclamado<br>
												 		</span>

												 		</div>
												 		';

												 }
												 else{
												 		$ayudafufi='';
												 }


                 ?>
                     <div class="col-md-4">
                       <label>
                           <input type="checkbox" class="checkbox" name="chk_fuentes<?php echo $numero_fuentes; ?>" id="chk_fuentes<?php echo $numero_fuentes; ?>" onclick='validar_fuentefinaciacion("<?php echo $numero_fuentes;?>");' value="1" name="chk_fuentes<?php echo $numero_fuentes; ?>" />
                           <?php echo $ffi_descripcion; ?> <?php echo $ayudafufi; ?>
                       </label>

                          <input type="number" step="0.001" style='display:none;' id="txt_fuentes<?php echo $numero_fuentes; ?>" name="txt_fuentes<?php echo $numero_fuentes; ?>"  data-rule-required="true" autocomplete="on" data-msg-required="Digite <?php echo $ffi_descripcion; ?>" data-msg-minlength="Dato muy corto." placeholder="Cifra en Pesos"/>
                          <input type="hidden" name="txt_codigofuentes<?php echo $numero_fuentes; ?>" id="txt_codigofuentes<?php echo $numero_fuentes; ?>" value="<?php echo $ffi_codigo; ?>" />
                     </div>
                      <!-- <div class="col-md-2">
                        sdfasdfasdf
                     </div>
                     <div class="col-md-2">
                    asdfasdfasd
                     </div>-->

                 <?php
                     $numero_fuentes++;
                     }

                  ?>
          </div>

          <input type="hidden" name="txt_numerofuentes" id="txt_numerofuentes" value="<?php echo $numero_fuentes; ?>" />
          <input type="hidden" name="txt_codigoejecucion" id="txt_codigoejecucion" value="<?php echo $codigo_ejecucionvalor; ?>" />
          <input type="hidden" name="txt_codigomepro" id="txt_codigomepro" value="<?php echo $codigo_metapro; ?>" />
					<input type="hidden" name="txt_fechareporte" id="txt_fechareporte" value="<?php echo $fre_fechareporte; ?>" />

<div class="espacio al80"> </div>
<div class="espacio al80"> </div>
<div class="espacio al80"> </div>
<div class="espacio al80"> </div>
<div class="espacio al80"> </div>


        </div>
</form>
<script type='text/javascript'>

      function validar_fuentefinaciacion(numero_fuentefinanciacion){
         var id_fuentefinanciacion=numero_fuentefinanciacion;
          var respuesta=$('input:checkbox[name=chk_fuentes'+id_fuentefinanciacion+']:checked').val();
          if(respuesta==1){
            $('#txt_fuentes'+id_fuentefinanciacion).fadeIn(600);
            $('#txt_fuentes'+id_fuentefinanciacion).focus();
          }
          else{
            $('#txt_fuentes'+id_fuentefinanciacion).fadeOut(600);
          }
      }


			function modificar_fufi(){
					var data_enviar=$('.frm_vejecutadofifu').serialize();
						$.post("modificarfifuejecucion",data_enviar,
								function(data_enviar, status){
									 //alert("Data: " + data + "\nStatus: " + status);

										$("tbody#datos_mepro<?php echo $codigo_metapro; ?>").load('reportexvigenciamepro?codigo_mepro=<?php echo $codigo_metapro; ?>');

										$(".encimaModal").fadeOut(300, function(){
												$(".encima").fadeOut(300);
										});

							});
			}

</script>
