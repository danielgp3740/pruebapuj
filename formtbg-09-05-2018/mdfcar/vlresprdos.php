<?php


$codigo_metapro=$_REQUEST['codigo_metaproducto'];
$codigo_ejecucionvalor=$_REQUEST['codigo_valorejecutado'];



$meta_productovi = $principal_sql->meproid($cnxn_pag, $codigo_metapro);
$data_valormp=$cnxn_pag->obtener_filas($meta_productovi);
$mpr_descripcion=$data_valormp['mpr_descripcion'];
$mpr_lineabase=$data_valormp['mpr_lineabase'];
$mpr_valorcuatrenio=$data_valormp['mpr_valorcuatrenio'];
$mpr_indicador=$data_valormp['mpr_indicador'];
$mpr_odsproducto=$data_valormp['mpr_odsproducto'];

$list_odsmepro=$principal_sql->ods_mepro($cnxn_pag, $codigo_metapro, $mpr_odsproducto);
$data_odsmepro=$cnxn_pag->obtener_filas($list_odsmepro);
$descripcion_odsmepro=$data_odsmepro['ods_descripcion'];

$datos_modificarvaloresejecucion=$principal_sql->valor_ejecutadoid($cnxn_pag, $codigo_metapro, $codigo_ejecucionvalor);

$data_modificarvaloresejecucion=$cnxn_pag->obtener_filas($datos_modificarvaloresejecucion);

    $vej_codigo=$data_modificarvaloresejecucion['vej_codigo'];
    $vej_metaproducto=$data_modificarvaloresejecucion['vej_metaproducto'];
    $vej_valor=$data_modificarvaloresejecucion['vej_valor'];
    $vej_vigencia=$data_modificarvaloresejecucion['vej_vigencia'];
    $vej_personacreo=$data_modificarvaloresejecucion['vej_personacreo'];
    $vej_descripcionmeru=$data_modificarvaloresejecucion['vej_descripcionmeru'];
    $vej_descripcionmepro=$data_modificarvaloresejecucion['vej_descripcionmepro'];
    $vej_impacto=$data_modificarvaloresejecucion['vej_impacto'];
    $vej_observacion=$data_modificarvaloresejecucion['vej_observacion'];


$valor_esperadomp_modificar = $principal_sql->valor_esperado($cnxn_pag, $codigo_metapro);


?>
<script type='text/javascript'>
      function ancho_titulo(){
        var ancho_encimaModal = $(".encimaModal").width()-30;
    //  alert(' ::: ' + ancho_encimaModal);
        $("#titulo.titulo").css({ 'width': +ancho_encimaModal+'px' });
      }
      ancho_titulo();


</script>


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


   $(".meprocaracteres").html("Total de <strong>"+  caracteres+"</strong> caracteres.");
   $("#txt_avancemepro").keyup(function(){
       if($(this).val().length > caracteres){
         $(this).val($(this).val().substr(0, caracteres));
       }
   var quedan = caracteres -  $(this).val().length;
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

   caracteres = 60;
   $(".observacioncaracteres").html("Total de <strong>"+  caracteres+"</strong> caracteres.");
   $("#txt_observaciones").keyup(function(){
       if($(this).val().length > caracteres){
         $(this).val($(this).val().substr(0, caracteres));
       }
   var quedan = caracteres -  $(this).val().length;
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


<form id="formulario" class='frm_vejecutadomodificar' name="frm_vejecutadomodificar" action="prcs_modificarvalorejecucion" method="post" >
    <div class="recuadro">
      <div id="titulo" class="titulo">
           Modificar Valores Avance Ejecución
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
      <div class="espacio al80"></div>

      <div class="col-md-12 mp no-padding">
           <p> <img src="img/ico/meta_producto.png"> <?php echo $mpr_descripcion; ?> | ODS: <?php echo $descripcion_odsmepro; ?></p>
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
                 <input value='<?php echo $vej_valor; ?>' type="number" step="0.001" id="txt_valorejecutado" name="txt_valorejecutado" data-rule-required="true" data-rule-number="true" data-msg-required="Por favor ingrese el dato." data-msg-number="Por favor ingrese un número." required />
                 <span class="ball">Este valor es acumulable para la vigencia</span>
           </div>
                 <p class="proy"> <?php echo $mpr_indicador; ?></p>
         </div>


         <div class="col-md-12">

               <p> &nbsp;</p>
         </div>

       <div class="col-md-6">
           <label>Describa el Avance de la Meta de Resultado</label>
              <textarea id="txt_avancemeru" style="height:80px;" name="txt_avancemeru" data-msg-required="Por favor ingrese la información de la descripción." class='required'><?php echo $vej_descripcionmeru; ?></textarea>
              <div class="counter avancecaracteres"> </div>
        </div>

        <div class="col-md-6">
           <span class="ball3">Reporte de manera cuantitativa el dato del avance de la MP (Numerador/Denominador) e indique los soportes relevantes</span>
            <label>Describa el Avance de la Meta de Producto</label>
               <textarea id="txt_avancemepro" style="height:80px;" name="txt_avancemepro"  data-msg-required="Por favor ingrese la información del avance de la Meta de Resultado." class='required'><?php echo $vej_descripcionmepro; ?></textarea>
               <div class="counter meprocaracteres"> </div>
         </div>


           <div class="col-md-6">
               <label>Impacto</label>
                  <textarea id="txt_impacto" style="height:80px;" name="txt_impacto" data-msg-required="Por favor ingrese la información del Impacto." class='required'><?php echo $vej_impacto; ?></textarea>
                  <div class="counter impactocaracteres"> </div>
            </div>

            <div class="col-md-6">

                <label>Observaciones</label>
                   <textarea disabled id="txt_observaciones" style="height:80px;" name="txt_observaciones" data-msg-required="Por favor ingrese la información de las observaciones." class='required'><?php echo $vej_observacion; ?></textarea>
                   <div class="counter observacioncaracteres"> </div>
             </div>

             <div class="col-md-12">
                   <p> &nbsp;</p>
             </div>
             <input value='<?php echo $vej_codigo; ?>' type="hidden"  id="txt_codigoejecucion" name="txt_codigoejecucion"  />
             <input value='<?php echo $codigo_metapro; ?>' type="hidden"  id="txt_codigomepro" name="txt_codigomepro"  />
    </div>

</form>

<script type='text/javascript'>

    $(document).ready(function() {
        $(".frm_vejecutadomodificar").submit(function() {
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
