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



$contratoconvenio = $principal_sql->contratoconvenio_listar($cnxn_pag, $codigo_ejecucionvalor, $vigencia);

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

<form id="formulario" class='frm_vejecutadoconcov' name="frm_vejecutadoconcov" action="procesomodificarconcov" method="post" >

  <div class="recuadro">
        <div id="titulo" class="titulo">
             Contratos - Convenios
               <div class="bloDr">
                 <?php
                    if ($dpl_proceso=='0') {
                     echo "";
                    }
                    else {
                 ?>

                   <input type="button" value='' onclick="modificar_concov()" class="guardar-modal" alt="Guardar" title="Guardar">
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
                <legend>Contratos - Convenio</legend>
                <?php
                $numero_concov=1;
                while($data_concov=$cnxn_pag->obtener_filas($contratoconvenio)){



                    $cej_numero=$data_concov['cej_numero'];
                    $cej_tipo=$data_concov['cej_tipo'];
                    $cej_year=$data_concov['cej_year'];

                    if($cej_tipo==1){
                      $selected_con="selected";
                      $selected_cov="";
                    }
                    elseif($cej_tipo==2){
                      $selected_con="";
                      $selected_cov="selected";
                    }


                    if($cej_year==2015){
                      $selected_2015="selected";
                      $selected_2016="";
                      $selected_2017="";
                      $selected_2018="";
                      $selected_2019="";
                    }
                    elseif($cej_year==2016){
                      $selected_2015="";
                      $selected_2016="selected";
                      $selected_2017="";
                      $selected_2018="";
                      $selected_2019="";
                    }
                    elseif($cej_year==2017){
                      $selected_2015="";
                      $selected_2016="";
                      $selected_2017="selected";
                      $selected_2018="";
                      $selected_2019="";
                    }
                    elseif($cej_year==2018){
                      $selected_2015="";
                      $selected_2016="";
                      $selected_2017="";
                      $selected_2018="selected";
                      $selected_2019="";
                    }
                    elseif($cej_year==2019){
                      $selected_2015="";
                      $selected_2016="";
                      $selected_2017="";
                      $selected_2018="";
                      $selected_2019="selected";
                    }




                ?>
                <div class="col-md-4 datavalor">
                  <div class='col-md-2' style='padding:0'><div class='combo'>
                    <select alt='Tipo Contrato' name='selTipo[]' title='Tipo Contrato' class='fieldtype medida2'><option value='1' <?php echo $selected_con; ?>>Contrato</option><option value='2' <?php echo $selected_cov; ?>>Convenio</option></select></div>
                  </div>
                  <div class='col-md-1' style='padding:0;margin-rigth:200px'>
                    <input name='txtnumeroContrato[]' alt='Número de Contrato o Convenio' title='Número de Contrato o Convenio' type='number' step='0.001' class='fieldname' style='width:10px;' value='<?php echo $cej_numero; ?>' />
                  </div>
                  <div class='col-md-2' style='padding:0;margin-left:125px;'>
                    <div class='combo' style='margin-left:20px; margin-rigth:100px'>
                      <select  name='selYear[]' alt='Año del Contrato o Convenio' title='Año del Contrato o Convenio' class='fieldtype medida2'>
                        <option value='2015' <?php echo $selected_2015; ?> >2015</option>
                        <option value='2016' <?php echo $selected_2016; ?> >2016</option>
                        <option value='2017' <?php echo $selected_2017; ?> >2017</option>
                        <option value='2018' <?php echo $selected_2018; ?> >2018</option>
                      </select>
                    </div>
                  </div>
                  <div class='col-md-1' style='padding:0;margin-left:18px'>
                    <input type='button' class='removevalores' value='' alt='Eliminar' title='Eliminar' style='padding:0;margin:5px 0 0 5px; position:static'/>
                  </div>
                </div>

                <?php
                $numero_concov++;
                }
               ?>

               <div class="col-md-12" id='contratos' style="margin:15px;">
                 <fieldset id="buildyourform">

                     <input type="hidden" id="numero_contratoconvenio" name="numero_contratoconvenio" value="">
                 </fieldset>
                 <!-- <input type="button" value="Preview form" class="add" id="preview" /> -->
                 <input type="button" value="Agregar Contrato o Convenio" class="add" id="add" style="margin:15px;" />

               </div>

          <input type="hidden" name="txt_codigoejecucion" id="txt_codigoejecucion" value="<?php echo $codigo_ejecucionvalor; ?>" />
          <input type="hidden" name="txt_codigomepro" id="txt_codigomepro" value="<?php echo $codigo_metapro; ?>" />
          <input type="hidden" name="txt_vviegencia" id="txt_vviegencia" value="<?php echo $ves_vigencia; ?>" />



        </div>
      </div>
</form>
<script type='text/javascript'>

$(document).ready(function() {
  $('.removevalores').click(function() {
      $(this).closest('.datavalor').remove();
  });

    $("#add").click(function() {
        var intId = $("#buildyourform div.fieldwrapper").length + 1;
        var fieldWrapper = $("<div class='fieldwrapper col-md-4' id='field"+intId+"' />");
        var ftipo = $("<div class='col-md-2' style='padding:0;;margin-bottom:20px'><div class='combo'><select alt='Tipo Contrato' name='selTipo[]' title='Tipo Contrato' class='fieldtype medida2'><option value='1'>Contrato</option><option value='2'>Convenio</option></select></div></div>");
        var fName = $("<div class='col-md-1' style='padding:0;margin-rigth:200px'><input name='txtnumeroContrato[]' alt='Número de Contrato o Convenio' title='Número de Contrato o Convenio' type='number' step='0.001' class='fieldname' style='width:10px;' /></div>");
        var fType = $("<div class='col-md-2' style='padding:0;margin-left:125px;'><div class='combo' style='margin-left:20px; margin-rigth:100px'><select  name='selYear[]' alt='Año del Contrato o Convenio' title='Año del Contrato o Convenio' class='fieldtype medida2'><option value='2015'>2015</option><option value='2016'>2016</option><option value='2017'>2017</option><option value='2018'>2018</option></select></div></div>");
        var removeButton = $("<div class='col-md-1' style='padding:0;margin-left:18px'><input type='button' class='remove cerrar-modal' value='' alt='Eliminar' title='Eliminar' style='padding:0;margin:5px 0 0 5px; position:static'/></div>");
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


});



  function modificar_concov(){
      var data_enviar=$('.frm_vejecutadoconcov').serialize();
        $.post("procesomodificarconcov",data_enviar,
            function(data_enviar, status){
               //alert("Data: " + data + "\nStatus: " + status);

                $("tbody#datos_mepro<?php echo $codigo_metapro; ?>").load('reportexvigenciamepro?codigo_mepro=<?php echo $codigo_metapro; ?>');

                $(".encimaModal").fadeOut(300, function(){
                    $(".encima").fadeOut(300);
                });

          });
  }
</script>
