
<?php
    $entidad_codigo=$_REQUEST['codigo_entidad'];
    $codigo_metapro=$_REQUEST['codigo_metaproducto'];
    $vigencia=$_REQUEST['vvigencia'];
    $municipio=$_REQUEST['idmunicipio'];


    $fuentes_financiacion = $principal_sql->fuentefinanciacion($cnxn_pag);
    $poblacion_genero = $principal_sql->poblacion_genero($cnxn_pag);
    $poblacion_victima = $principal_sql->poblacion_victima($cnxn_pag);
    $poblacion_discapacidad = $principal_sql->poblacion_discapacidad($cnxn_pag);
    $poblacion_etnia = $principal_sql->poblacion_etnia($cnxn_pag);
    $poblacion_edad = $principal_sql->poblacion_edad($cnxn_pag);

    $fechaperiodo = $principal_sql->ejecucionfechareporte_sql($cnxn_pag,$codigofere);
    $data_fechaperiodo=$cnxn_pag->obtener_filas($fechaperiodo);
    $fre_vigencia=$data_fechaperiodo['fre_vigencia'];
    $fre_fechareporte=$data_fechaperiodo['fre_fechareporte'];
    $fre_codigo=$data_fechaperiodo['fre_codigo'];

    $list_municipio=$principal_sql->municipioid($cnxn_pag,$municipio);
    $data_municipioid=$cnxn_pag->obtener_filas($list_municipio);
    $mun_nombre=$data_municipioid['mun_nombre'];

    $list_mepro=$principal_sql->meproid($cnxn_pag,$codigo_metapro);
    $data_meproid=$cnxn_pag->obtener_filas($list_mepro);
    $descripcion_mepro=$data_meproid['mpr_descripcion'];
    $mpr_lineabase=$data_meproid['mpr_lineabase'];
    $mpr_valorcuatrenio=$data_meproid['mpr_valorcuatrenio'];
    $mpr_indicador=$data_meproid['mpr_indicador'];
    $mpr_odsproducto=$data_meproid['mpr_odsproducto'];
    $mpr_indicadorsgi=$data_meproid['mpr_indicadorsgi'];
    $mpr_formulaindsgi=$data_meproid['mpr_formulaindsgi'];

    if($mpr_formulaindsgi!=''){
      $activarcajassgi=1;
    }
    else{
      $activarcajassgi=0;
    }

    $list_odsmepro=$principal_sql->ods_mepro($cnxn_pag, $codigo_metapro, $mpr_odsproducto);
    $data_odsmepro=$cnxn_pag->obtener_filas($list_odsmepro);
    $descripcion_odsmepro=$data_odsmepro['ods_descripcion'];
    //$mpr_ods=$data_odsmepro['mpr_indicador'];

$valor_esperadomp_modificar = $principal_sql->valor_esperado($cnxn_pag, $codigo_metapro);

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



$(document).ready(function()  {
   var caracteres = 350;

   $(".avancecaracteres").html("Total de <strong>"+  caracteres+"</strong> caracteres.");
   $("#txt_avancemeru").keyup(function(){
       if($(this).val().length > caracteres){
         $(this).val($(this).val().substr(0, caracteres));
       }
   var quedan = caracteres -  $(this).val().length;
   $(".avancecaracteres").html("Quedan <strong>"+quedan+"</strong> caracteres.");
   if(quedan <= 10)
   {
       $(".avancecaracteres").css("color","red");
   }
   else
   {
       $(".avancecaracteres").css("color","black");
   }
   });

   var caracteres_mepro=600;
   $(".meprocaracteres").html("Total de <strong>"+  caracteres_mepro+"</strong> caracteres.");
   $("#txt_avancemepro").keyup(function(){
       if($(this).val().length > caracteres_mepro){
         $(this).val($(this).val().substr(0, caracteres_mepro));
       }
   var quedan = caracteres_mepro -  $(this).val().length;
   $(".meprocaracteres").html("Quedan <strong>"+quedan+"</strong> caracteres.");
   if(quedan <= 10)
   {
       $(".meprocaracteres").css("color","red");
   }
   else
   {
       $(".meprocaracteres").css("color","black");
   }
   });


   $(".impactocaracteres").html("Total de <strong>"+  caracteres+"</strong> caracteres.");
   $("#txt_impacto").keyup(function(){
       if($(this).val().length > caracteres){
         $(this).val($(this).val().substr(0, caracteres));
       }
   var quedan = caracteres -  $(this).val().length;
   $(".impactocaracteres").html("Quedan <strong>"+quedan+"</strong> caracteres.");
   if(quedan <= 10)
   {
       $(".impactocaracteres").css("color","red");
   }
   else
   {
       $(".impactocaracteres").css("color","black");
   }
   });

   caracteres_observacion = 350;
   $(".observacioncaracteres").html("Total de <strong>"+  caracteres_observacion+"</strong> caracteres.");
   $("#txt_observaciones").keyup(function(){
       if($(this).val().length > caracteres_observacion){
         $(this).val($(this).val().substr(0, caracteres_observacion));
       }
   var quedan = caracteres_observacion -  $(this).val().length;
   $(".observacioncaracteres").html("Quedan <strong>"+quedan+"</strong> caracteres.");
   if(quedan <= 10)
   {
       $(".observacioncaracteres").css("color","red");
   }
   else
   {
       $(".observacioncaracteres").css("color","black");
   }
   });




});
</script>


<!-- INICIO MODAL erroFIFU-->
<div class="modal fade" id="ModalErrorFifu" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p><h2>Faltan Datos Financiero por Digitar </h2></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ACEPTAR</button>
      </div>
    </div>
  </div>
</div>
<!-- FIN MODAL erroFIFU-->

<!-- INICIO MODAL erroGENERO-->
<div class="modal fade" id="ModalErrorGenero" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p><h2>Faltan Datos Poblacion Genero por Digitar </h2></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ACEPTAR</button>
      </div>
    </div>
  </div>
</div>
<!-- FIN MODAL erroGENERO-->

<!-- INICIO MODAL erroGENERO-->
<div class="modal fade" id="ModalErrorVeje" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p><h2>Digite el valor de la Ejecución</h2></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ACEPTAR</button>
      </div>
    </div>
  </div>
</div>
<!-- FIN MODAL erroGENERO-->


<form id="formulario" class='frm_vejecutado' name="frm_vejecutado" action="procesoejcucionmp" method="post" >

  <input type="hidden" id="txt_codigoentidad" name="txt_codigoentidad" value="<?php echo $entidad_codigo; ?>"/>
  <input type="hidden" id="txt_codigomepro" name="txt_codigomepro" value="<?php echo $codigo_metapro; ?>"/>
  <input type="hidden" id="txt_vviegencia" name="txt_vviegencia" value="<?php echo $vigencia; ?>"/>
  <input type="hidden" id="txt_municipio" name="txt_municipio" value="<?php echo $municipio; ?>"/>
  <input type="hidden" id="txt_fechareporte" name="txt_fechareporte" value="<?php echo $fre_codigo; ?>"/>



               <div class="recuadro">
                     <div id="titulo" class="titulo">
                          Avance Meta de Producto - Impacto
                            <div class="bloDr">
                              <!--  <input type="submit" value='Guardar' style='background-image:url(img/ico/guardar.png);'>
                              <input title="Guardar" alt=" Guardar " src="img/ico/guardar.png" type="image" />
                              <a href="Javascript:guardar_valorejecutado();"><img src="img/ico/guardar.png" alt="Guardar" title="Guardar" /></a> -->
                              <?php
                 								 if ($dpl_proceso=='0') {
                 								 	echo "";
                 								 }
                 								 else {
             								 	?>
             										<input type="button" value='' onclick="validar_ejecucion();" class="guardar-modal" alt="Guardar" title="Guardar">
             									<?php
             								 		}
             								 ?>
                              <input type="button" class='cerrar-modal' value='' alt="Cerrar" title="Cerrar">
                            </div>
                        </div>

                        <div class="espacio al80"></div>

                        <div style="width:100%; font-size:120%; " class="bg-title" class="titulo">
                          <strong>Meta de Producto: <?php echo $descripcion_mepro; ?></strong> | <strong>Municipio: <?php echo $mun_nombre; ?></strong>
                          <br>
                          <strong>ODS: <?php echo $descripcion_odsmepro; ?></strong>
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


                        <div class="col-md-12">
                            <br><br>
                          <div class="col-md-3">
                                  <label>Valor Avance Meta de Producto</label>
                                  <input type="number" step="0.001" id="txt_valorejecutado" name="txt_valorejecutado" data-rule-required="true" data-rule-number="true" data-msg-required="Por favor ingrese el dato." data-msg-number="Por favor ingrese un número." required />
                                  <span class="ball">Este valor es acumulable para la vigencia </span>

                          </div>
                            <p class="proy"><?php echo $mpr_indicador; ?></p>
                        </div>
                        <?php if($activarcajassgi==1){

                        ?>
                        <div class="col-md-12">
                          <div class="col-md-4">
                            <label>Indicador</label>
                              <p class=""><?php echo $mpr_indicadorsgi; ?></p>
                              <p class=""><?php echo   $mpr_formulaindsgi; ?></p>
                          </div>
                          <div class="col-md-4">
                            <label>Numerador</label>
                            <input type="number" step="0.001" id="txt_numerador" name="txt_numerador" data-rule-required="true" data-rule-number="true" data-msg-required="Por favor ingrese el dato." data-msg-number="Por favor ingrese un número." required />
                          </div>
                          <div class="col-md-4">
                            <label>Denominador</label>
                            <input type="number" step="0.001" id="txt_denominador" name="txt_denominador" data-rule-required="true" data-rule-number="true" data-msg-required="Por favor ingrese el dato." data-msg-number="Por favor ingrese un número." required />
                          </div>
                        </div>
                        <?php
                          }
                          else{
                            echo " ";
                          }
                        ?>


                        <div class="col-md-12">
                              <p> &nbsp;</p>
                        </div>
                        <div class="col-md-12">
                              <p> &nbsp;</p>
                        </div>

                        <div class="col-md-12">
                              <p> &nbsp;</p>
                        </div>

                      <div class="col-md-6">
                          <label>Describa el Avance de la Meta de Resultado </label>
                             <textarea id="txt_avancemeru" style="height:80px;" name="txt_avancemeru" data-msg-required="Por favor ingrese la información de la descripción." class='required'></textarea>
                             <div class="counter avancecaracteres"> </div>
                       </div>

                       <div class="col-md-6">
                        <span class="ball3">Reporte de manera cuantitativa el dato del avance de la MP (Numerador/Denominador) e indique los soportes relevantes</span>
                           <label>Describa el Avance de la Meta de Producto</label>
                              <textarea id="txt_avancemepro" style="height:80px;" name="txt_avancemepro"  data-msg-required="Por favor ingrese la información del avance de la Meta de Resultado." class='required'></textarea>
                              <div class="counter meprocaracteres"> </div>
                        </div>


                          <div class="col-md-6">
                              <label>Impacto</label>
                                 <textarea id="txt_impacto" style="height:80px;" name="txt_impacto" data-msg-required="Por favor ingrese la información del Impacto." class='required'></textarea>
                                 <div class="counter impactocaracteres"> </div>
                           </div>

                           <div class="col-md-6">

                               <label>Contrato / Convenio / Acta / Fecha</label>
                                  <textarea id="txt_observaciones" style="height:80px;" name="txt_observaciones" data-msg-required="Por favor ingrese la información de las observaciones." class='required'></textarea>
                                  <div class="counter observacioncaracteres"> </div>
                            </div>

                          <!-- inicio Contrato -->
<!--
                          <div id="main">
                              <input type="button" id="btAdd" value="Añadir Elemento" class="bt" />
                              <input type="button" id="btRemove" value="Eliminar Elemento" class="bt" />
                              <input type="button" id="btRemoveAll" value="Eliminar Todo" class="bt" /><br />
                          </div>
                            -->
                          <div class="col-md-12" id='contratos' style="margin:15px;">
                            <fieldset id="buildyourform">
                                <legend>Contratos - Convenio</legend>
                                <input type="hidden" id="numero_contratoconvenio" name="numero_contratoconvenio" value="">
                            </fieldset>
                            <!-- <input type="button" value="Preview form" class="add" id="preview" /> -->
                            <input type="button" value="Agregar Contrato o Convenio" class="add" id="add" style="margin:15px;" />

                          </div>



                             <!-- fin contrato -->
                             <div class="col-md-12">
                                   <p> &nbsp;</p>
                             </div>


                        <!--***********************Inicio Origen de los recursos *********************************-->
                       <div class="col-md-12">
                         <fieldset>

                            <legend>
                              <!-- <input type="checkbox" class="checkbox" id="chk_origenrecursos" value="1" name="chk_origenrecursos"> -->
                               Origen de los Recursos <strong>(En Pesos $) </strong> <span class="ball2">Este valor es acumulable para la vigencia</span>
                            </legend>

                          </fieldset>


                          <?php
                              $numero_fuentes=1;
                              while($data_fuentefinanciacion=$cnxn_pag->obtener_filas($fuentes_financiacion)){

                                  $ffi_codigo=$data_fuentefinanciacion['ffi_codigo'];
                                  $ffi_descripcion=$data_fuentefinanciacion['ffi_descripcion'];
                                  $ffi_padre=$data_fuentefinanciacion['ffi_padre'];

                                  if($ffi_codigo==4){
                                      $ayudafufi='<div class="tooltip "><a href="Javascript:void(0);"class ="" >
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
                                    $ayudafufi='<div class="tooltip "><a href="Javascript:void(0);" class ="" title="">
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


                              <div class="col-md-2">



                                <label>
                                    <input type="checkbox" data-valorfufi='<?php echo $numero_fuentes; ?>' class="checkbox chkfufi" name="chk_fuentes<?php echo $numero_fuentes; ?>" id="chk_fuentes<?php echo $numero_fuentes; ?>" onclick='validar_fuentefinaciacion("<?php echo $numero_fuentes;?>");' value="1" name="chk_fuentes<?php echo $numero_fuentes; ?>" />
                                    <?php echo $ffi_descripcion; ?> <?php echo $ayudafufi; ?>
                                </label>


                                   <input type="number" step="0.001" style='display:none;' id="txt_fuentes<?php echo $numero_fuentes; ?>" name="txt_fuentes<?php echo $numero_fuentes; ?>"  data-rule-required="true" autocomplete="on" data-msg-required="Digite <?php echo $ffi_descripcion; ?>" data-msg-minlength="Dato muy corto."  placeholder="Cifras en Pesos"/>
                                   <input type="hidden" name="txt_codigofuentes<?php echo $numero_fuentes; ?>" id="txt_codigofuentes<?php echo $numero_fuentes; ?>" value="<?php echo $ffi_codigo; ?>" />
                              </div>

                          <?php
                              $numero_fuentes++;
                              }

                           ?>
                           <div class="validarfifu col-md-12 ball2" style="color:#a22830; font-size:140%; background-color:#d79b9b; display:none;">
                             DIGITE VALOR DE LA FUENTE DE FINANCIACIÓN
                           </div>
                       </div>
                       <!--***********************Fin Origen de los recursos *********************************-->

                       <!--***********************Inicio Impacto Género *********************************-->
                       <div class="col-md-12">

                         <br>

                        <fieldset>
                           <legend>
                            <h2>Población Beneficiada</h2>
                          </legend>
                       </fieldset>

                        <fieldset>

                           <legend>
                             <!-- <input type="checkbox" class="checkbox" id="chk_origenrecursos" value="1" name="chk_origenrecursos"> -->
                              Género <span class="ball2">Este valor es acumulable para la vigencia</span>
                           </legend>

                         </fieldset>

                         <?php
                             $numero_genero=1;
                             while($data_genero=$cnxn_pag->obtener_filas($poblacion_genero)){

                                 $plg_codigo=$data_genero['plg_codigo'];
                                 $plg_nombre=$data_genero['plg_nombre'];


                         ?>
                             <div class="col-md-2">
                               <label>
                                   <input type="checkbox" data-valorgenero='<?php echo $numero_genero; ?>' class="checkbox chkgenero" name="chk_genero<?php echo $numero_genero; ?>" id="chk_genero<?php echo $numero_genero; ?>" onclick='checkear_poblaciongenero("<?php echo $numero_genero;?>");' value="1" name="chk_genero<?php echo $numero_genero; ?>" />
                                   <?php echo $plg_nombre; ?>
                               </label>

                                  <input type="number" step="0.001" style='display:none;' id="txt_genero<?php echo $numero_genero; ?>" name="txt_genero<?php echo $numero_genero; ?>"  data-rule-required="true" autocomplete="on" data-msg-required="Digite <?php echo $plg_nombre; ?>" data-msg-minlength="Dato muy corto." value='' />
                                  <input type="hidden" name="txt_codigogenero<?php echo $numero_genero; ?>" id="txt_codigogenero<?php echo $numero_genero; ?>" value="<?php echo $plg_codigo; ?>" />
                             </div>

                         <?php
                             $numero_genero++;
                             }

                          ?>
                          <div class="validargenero col-md-12 ball2" style="color:#a22830; font-size:140%; background-color:#d79b9b; display:none;">
                            DIGITAR NÚMERO POBLACIÓN GENERO
                          </div>
                         </div>

                       <!--***********************Fin Impacto Genero *********************************-->


                         <!--***********************Inicio Población Edad *********************************-->
                      <div class="col-md-12">
                        <br>
                        <fieldset>

                           <legend>
                             <!-- <input type="checkbox" class="checkbox" id="chk_origenrecursos" value="1" name="chk_origenrecursos"> -->
                              Población Edad <span class="ball2">Este valor es acumulable para la vigencia</span>
                           </legend>

                         </fieldset>

                         <?php
                             $numero_edad=1;
                             while($data_edad=$cnxn_pag->obtener_filas($poblacion_edad)){

                                 $ped_codigo=$data_edad['ped_codigo'];
                                 $ped_descripcion=$data_edad['ped_descripcion'];


                         ?>

                         <div class="col-md-2">
                           <label>
                               <input type="checkbox" class="checkbox" name="chk_edad<?php echo $numero_edad; ?>" id="chk_edad<?php echo $numero_edad; ?>" onclick='checkear_poblacionedad("<?php echo $numero_edad;?>");' value="1" name="chk_edad<?php echo $numero_edad; ?>" />
                               <?php echo $ped_descripcion; ?>
                           </label>

                              <input type="number" step="0.001" style='display:none;' id="txt_edad<?php echo $numero_edad; ?>" name="txt_edad<?php echo $numero_edad; ?>"  data-rule-required="true" autocomplete="on" data-msg-required="Digite <?php echo $ped_descripcion; ?>" data-msg-minlength="Dato muy corto." />
                              <input type="hidden" name="txt_codigoedad<?php echo $numero_edad; ?>" id="txt_codigoedad<?php echo $numero_edad; ?>" value="<?php echo $ped_codigo; ?>" />
                         </div>

                     <?php
                         $numero_edad++;
                         }

                      ?>

                      </div>
                      <!--***********************Fin Población Edad *********************************-->



                      <!--***********************Inicio Población Víctima *********************************-->
                     <div class="col-md-12">
                       <br>
                       <fieldset>

                          <legend>
                            <!-- <input type="checkbox" class="checkbox" id="chk_origenrecursos" value="1" name="chk_origenrecursos"> -->
                             Población Víctima - Hecho Victimizante <span class="ball2">Este valor es acumulable para la vigencia</span>
                          </legend>

                        </fieldset>

                          <?php
                          $numero_victima=1;
                          while($data_victima=$cnxn_pag->obtener_filas($poblacion_victima)){
                              $pvi_codigo=$data_victima['pvi_codigo'];
                              $pvi_nombre=$data_victima['pvi_nombre'];
                          ?>

                          <div class="col-md-4">
                               <label>
                                 <input type="checkbox" class="checkbox" name="chk_victima<?php echo $numero_victima; ?>" id="chk_victima<?php echo $numero_victima; ?>" onclick='checkear_poblacionvictima("<?php echo $numero_victima;?>");' value="1"  />
                                  <?php echo $pvi_nombre; ?>
                               </label>
                               <input type="number" step="0.001"  style='display:none;' id="txt_victima<?php echo $numero_victima; ?>" name="txt_victima<?php echo $numero_victima; ?>"  data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de <?php echo $pvi_nombre; ?>" data-msg-minlength="Dato muy corto." />
                               <input type="hidden" name="txt_codigovictima<?php echo $numero_victima; ?>" id="txt_codigovictima<?php echo $numero_victima; ?>" value="<?php echo $pvi_codigo; ?>" />
                          </div>

                          <?php
                          $numero_victima++;
                          }

                          ?>
                     </div>
                     <!--***********************Fin Población Víctima *********************************-->

                     <!--***********************Inicio Discapacidad *********************************-->
                    <div class="col-md-12">
                      <br>
                      <fieldset>

                         <legend>
                           <!-- <input type="checkbox" class="checkbox" id="chk_origenrecursos" value="1" name="chk_origenrecursos"> -->
                          Tipo de Discapacidad <span class="ball2">Este valor es acumulable para la vigencia</span>
                         </legend>

                       </fieldset>


                       <?php
                          $numero_discapacidad=1;
                          while($data_discapacidad=$cnxn_pag->obtener_filas($poblacion_discapacidad)){
                              $tdi_codigo=$data_discapacidad['tdi_codigo'];
                              $tdi_nombre=$data_discapacidad['tdi_nombre'];


                        ?>

                            <div class="col-md-3">
                                 <label>
                                   <input type="checkbox" class="checkbox" id="chk_discapacidad<?php echo $numero_discapacidad; ?>" value="1" name="chk_discapacidad<?php echo $numero_discapacidad; ?>" onclick="checkear_poblaciondiscapacidad('<?php echo $numero_discapacidad; ?>');">
                                   <?php echo $tdi_nombre; ?>
                                 </label>
                                 <input type="number" step="0.001" style="display:none;" id="txt_discapacidad<?php echo $numero_discapacidad; ?>" name="txt_discapacidad<?php echo $numero_discapacidad; ?>" data-rule-required="true" autocomplete="on" data-msg-required="Ingresar Valor de <?php echo $tdi_nombre; ?>" data-msg-minlength="Dato muy corto." />
                                 <input type="hidden" name="txt_codigodiscapacidad<?php echo $numero_discapacidad; ?>" id="txt_codigodiscapacidad<?php echo $numero_discapacidad; ?>" value="<?php echo $tdi_codigo; ?>" />
                            </div>

                        <?php
                          $numero_discapacidad++;
                          }

                       ?>

                    </div>

                    <!--***********************Fin Discapacidad *********************************-->


                    <!--***********************Inicio étnico *********************************-->
                   <div class="col-md-12">
                     <br>
                     <fieldset>

                        <legend>
                          <!-- <input type="checkbox" class="checkbox" id="chk_origenrecursos" value="1" name="chk_origenrecursos"> -->
                         Población Étnica <span class="ball2">Este valor es acumulable para la vigencia</span>
                        </legend>

                      </fieldset>

                        <?php
                            $numero_etnia=1;
                            while($data_etnia=$cnxn_pag->obtener_filas($poblacion_etnia)){
                                $pet_codigo=$data_etnia['pet_codigo'];
                                $pet_nombre=$data_etnia['pet_nombre'];


                              ?>
                                  <div class="col-md-4">
                                       <label>
                                         <input type="checkbox" class="checkbox" id="chk_etnia<?php echo $numero_etnia; ?>" value="1" name="chk_etnia<?php echo $numero_etnia; ?>" onclick="checkear_poblacionetnia('<?php echo $numero_etnia; ?>');" />
                                          <?php echo $pet_nombre; ?>
                                        </label>
                                       <input type="number" step="0.001"  style="display:none" id="txt_etnia<?php echo $numero_etnia; ?>" name="txt_etnia<?php echo $numero_etnia; ?>"  data-rule-required="true" autocomplete="on" data-msg-required="<?php echo $pet_nombre; ?>" data-msg-minlength="Dato muy corto." />
                                      <input type="hidden" name="txt_codigoetnia<?php echo $numero_etnia; ?>" id="txt_codigoetnia<?php echo $numero_etnia; ?>" value="<?php echo $pet_codigo; ?>" />
                                  </div>
                              <?php

                                $numero_etnia++;
                            }

                        ?>

                   </div>

                   <div class="col-md-4">
                     <p>&nbsp;</p>
                   </div>
                   <!--***********************Fin étnico *********************************-->

                   <input type="hidden" name="txt_numerofuentes" id="txt_numerofuentes" value="<?php echo $numero_fuentes; ?>" />
                   <input type="hidden" name="txt_numerogenero" id="txt_numerogenero" value="<?php echo $numero_genero; ?>" />
                   <input type="hidden" name="txt_numerovictima" id="txt_numerovictima" value="<?php echo $numero_victima; ?>" />
                   <input type="hidden" name="txt_numeroetnia" id="txt_numeroetnia" value="<?php echo $numero_etnia; ?>" />
                   <input type="hidden" name="txt_numerodiscapacidad" id="txt_numerodiscapacidad" value="<?php echo $numero_discapacidad; ?>" />
                   <input type="hidden" name="txt_numeroedad" id="txt_numeroedad" value="<?php echo $numero_edad; ?>" />

               </div>
</form>


<script type="text/javascript">
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

    function checkear_poblacionedad(numero_edad){
      var id_edad=numero_edad;
       var respuesta_edad=$('input:checkbox[name=chk_edad'+id_edad+']:checked').val();
       if(respuesta_edad==1){
         $('#txt_edad'+id_edad).fadeIn(600);
         $('#txt_edad'+id_edad).focus();
       }
       else{
         $('#txt_edad'+id_edad).fadeOut(600);
       }

    }




    $(document).ready(function() {
        $(".frm_vejecutado").submit(function() {
      // Enviamos el formulario usando AJAX
          $.ajax({
              type: 'POST',
              url: $(this).attr('action'),
              data: $(this).serialize(),
              // Mostramos un mensaje con la respuesta de PHP
              success: function(message) {
                  //$('#resultado_consulta').html(data);
                  $("#resultado_consulta").empty().append(message);

              }
          });

          $(".encimaModal").fadeOut(300, function(){
            $(".encima").fadeOut(300);
          });

          return false;

        });
    });

    function modalerror(selectedItemsFufi){
      $("#ModalErrorFufi"+selectedItemsFufi).modal({backdrop: true});
    }


    function validar_ejecucion(){
      var ejecucionvalor=$('#txt_valorejecutado').val();
      var selectedFifu='';
      var selectedGenero='';
      $valido_dato=0;

      var selectedItemsFufi = new Array();
      var selectedItemsGenero = new Array();

      //ModalErrorVeje
      if(ejecucionvalor==''){
        $("#ModalErrorVeje").modal({backdrop: true});
        $("#txt_valorejecutado").css('background','#edc7ce');
        return 0;
      }
      else {
        $validarnumeroeje=1;
      }

      $(".chkfufi:checked").each(function(){
        selectedItemsFufi.push($(this).data('valorfufi'));
        if (this.checked) {
                selectedFifu += $(this).val()+', ';
        }
      });

      $(".chkgenero:checked").each(function(){
        selectedItemsGenero.push($(this).data('valorgenero'));
        if (this.checked) {
                selectedGenero += $(this).val()+', ';
        }
      });


      if (selectedFifu == ''){
        $("#ModalErrorFifu").modal({backdrop: true});
        $(".validarfifu").fadeIn(100);
        return 0;
      }
      else {
        $(".validarfifu").fadeOut(100);
        $validarnumeroeje+=1;
      }



      selectedItemsFufi.forEach(function(item, index, arr) {
        arr[index] = item;
        if($('#txt_fuentes'+arr[index]).val()==''){
          $("#ModalErrorFifu").modal({backdrop: true});
          $('#txt_fuentes'+arr[index]).css('background','#edc7ce');
          $('#txt_fuentes'+arr[index]).focus();
          $valido_dato=0;
          return 0;
        }
        else {
          $valido_dato=1;
        }
        //alert(arr[index]);
      });
    		//alert(selectedItems);

        if (selectedGenero == ''){
          $("#ModalErrorGenero").modal({backdrop: true});
          $(".validargenero").fadeIn(100);
          return 0;
        }
        else {
            $(".validargenero").fadeOut(100);
        }

        selectedItemsGenero.forEach(function(itemg, indexa, arreglo) {
          arreglo[indexa] = itemg;
          if($('#txt_genero'+arreglo[indexa]).val()==''){
            $("#ModalErrorGenero").modal({backdrop: true});
            $('#txt_genero'+arreglo[indexa]).css('background','#edc7ce');
            //$('#txt_genero'+arreglo[indexa]).focus();
            $valido_dato=0;
            return 0;
          }
          else {
            $valido_dato=1;
          }


        });


      		//alert(selectedItems);

          if($valido_dato==1){
            $( ".frm_vejecutado" ).submit();
          }
          else{
            return 0;
          }



    }
// crear input contrato

$(document).ready(function() {
    $("#add").click(function() {
        var intId = $("#buildyourform div.fieldwrapper").length + 1;
        var fieldWrapper = $("<div class='fieldwrapper col-md-4' id='field"+intId+"' />");
        var ftipo = $("<div class='col-md-2' style='padding:0;'><div class='combo'><select alt='Tipo Contrato' name='selTipo[]' title='Tipo Contrato' class='fieldtype medida2'><option value='1'>Contrato</option><option value='2'>Convenio</option></select></div></div>");
        var fName = $("<div class='col-md-1' style='padding:0;margin-rigth:200px'><input name='txtnumeroContrato[]' alt='Número de Contrato o Convenio' title='Número de Contrato o Convenio' type='number' step='0.001' class='fieldname' style='width:10px;' /></div>");
        var fType = $("<div class='col-md-2' style='padding:0;margin-left:125px;'><div class='combo' style='margin-left:20px; margin-rigth:100px'><select  name='selYear[]' alt='Año del Contrato o Convenio' title='Año del Contrato o Convenio' class='fieldtype medida2'><option value='2015'>2015</option><option value='2016'>2016</option><option value='2017'>2017</option><option value='2018'>2018</option></select></div></div>");
        var removeButton = $("<div class='col-md-1' style='padding:0;margin-left:18px'><input type='button' class='remove cerrar-modal' value='' alt='Cerrar' title='Cerrar' style='padding:0;margin:5px 0 0 5px; position:static'/></div>");
        $("#numero_contratoconvenio").val(intId);
        removeButton.click(function() {
            $(this).parent().remove();
        });
        fieldWrapper.append(ftipo);
        fieldWrapper.append(fName);
        fieldWrapper.append(fType);
        fieldWrapper.append(removeButton);
        $("#buildyourform").append(fieldWrapper);
    });

    /*
    $("#preview").click(function() {
        $("#yourform").remove();
        var fieldSet = $("<fieldset id='yourform'><legend>Your Form</legend></fieldset>");
        $("#buildyourform div").each(function() {
            var id = "input" + $(this).attr("id").replace("field","");
            var label = $("<label for='"+id+"'>" + $(this).find("input.fieldname").first().val() + "</label>");
            var input;
            switch ($(this).find("select.fieldtype").first().val()) {
                case "checkbox":
                    input = $("<input type='checkbox' id='"+id+"' name='"+id+"' />");
                    break;
                case "textbox":
                    input = $("<input type='text' id='"+id+"' name='"+id+"' />");
                    break;
                case "textarea":
                    input = $("<textarea id='"+id+"'  name='"+id+"'></textarea>");
                    break;
            }
            fieldSet.append(label);
            fieldSet.append(input);
        });
        $("body").append(fieldSet);
    });
    */

});

</script>
