<?php

$persona_entidad=$_SESSION['entidad_persona'];
$codigo_metaproductoejecutado=$_REQUEST['codigo_mepro'];


$valores_ejecutadosxvigencia = $principal_sql->valor_ejecutadomp($cnxn_pag, $codigo_metaproductoejecutado, $persona_entidad);

//echo $valores_ejecutadosxvigencia;

?>
<tr>
  <td colspan="6">


    <table id="ordenar" class="grande">
        <tr>
          <th>&nbsp;&nbsp;Nro.</th>
          <th>&nbsp;Vigencia&nbsp;</th>
          <th>&nbsp;Municipio&nbsp;</th>
          <th>&nbsp;Valor Avance MP&nbsp;</th>
          <th>&nbsp;Valor Total Recursos&nbsp;(En Pesos)</th>
          <th>&nbsp;Pobl. por Género&nbsp;</th>
          <th>&nbsp;Pobl. Victima&nbsp;</th>
          <th>&nbsp;Pobl. Discapacidad&nbsp;</th>
          <th>&nbsp;Pobl. Etnica&nbsp;</th>
          <th>&nbsp;</th>
        </tr>

<?php
$numero_registroempe=1;
        while($data_valorejecutadoxvigencia=$cnxn_pag->obtener_filas($valores_ejecutadosxvigencia)){
              $vej_codigo=$data_valorejecutadoxvigencia['vej_codigo'];
              $vej_metaproducto=$data_valorejecutadoxvigencia['vej_metaproducto'];
              $vej_valor=$data_valorejecutadoxvigencia['vej_valor'];
              $vej_vigencia=$data_valorejecutadoxvigencia['vej_vigencia'];
              $vej_personacreo=$data_valorejecutadoxvigencia['vej_personacreo'];
              $vej_personamodifico=$data_valorejecutadoxvigencia['vej_personamodifico'];
              $vej_fechacreo=$data_valorejecutadoxvigencia['vej_fechacreo'];
              $vej_fechamodifico=$data_valorejecutadoxvigencia['vej_fechamodifico'];
              $vej_municipio=$data_valorejecutadoxvigencia['vej_municipio'];
              $vej_descripcionmeru=$data_valorejecutadoxvigencia['vej_descripcionmeru'];
              $vej_descripcionmepro=$data_valorejecutadoxvigencia['vej_descripcionmepro'];
              $vej_impacto=$data_valorejecutadoxvigencia['vej_impacto'];
              $vej_observacion=$data_valorejecutadoxvigencia['vej_observacion'];
              $vej_entidad=$data_valorejecutadoxvigencia['vej_entidad'];
              //$mpr_descripcion=$data_valorejecutadoxvigencia['mpr_descripcion'];
              //$mun_nombre=$data_valorejecutadoxvigencia['mun_nombre'];


              $municipio_id = $principal_sql->municipioid($cnxn_pag, $vej_municipio);
              $data_municipioid=$cnxn_pag->obtener_filas($municipio_id);
              $mun_nombre=$data_municipioid['mun_nombre'];

              $metaproducto_id = $principal_sql->meproid($cnxn_pag, $vej_metaproducto);
              $data_metaproductoid=$cnxn_pag->obtener_filas($metaproducto_id);
              $mpr_descripcion=$data_metaproductoid['mpr_descripcion'];

              //inicio sumatoria total recursos o fuentes de finaciación vigencias
              $total_fufi = $principal_sql->totalejecutado_fufi($cnxn_pag, $vej_metaproducto, $vej_codigo);
              $valortotal_fufi=0;
              while($data_totalfufi=$cnxn_pag->obtener_filas($total_fufi)){
                  $mfu_valor=$data_totalfufi['mfu_valor'];
                  $valortotal_fufi=$valortotal_fufi+$mfu_valor;
              }
              //fin sumatoria total recursos o fuentes de finaciación vigencias

              //inicio sumatoria total genero
              $total_genero = $principal_sql->totalejecutado_genero($cnxn_pag, $vej_metaproducto, $vej_codigo);
              $valortotal_genero=0;
              while($data_totalgenero=$cnxn_pag->obtener_filas($total_genero, $vej_metaproducto)){
                  $mge_valor=$data_totalgenero['mge_valor'];
                  $valortotal_genero=$valortotal_genero+$mge_valor;
              }
              //fin sumatoria total genero

              //inicio sumatoria total victima
              $total_victima = $principal_sql->totalejecutado_victima($cnxn_pag, $vej_metaproducto, $vej_codigo);
              $valortotal_victima=0;
              while($data_totalvictima=$cnxn_pag->obtener_filas($total_victima, $vej_metaproducto)){
                  $mvi_valor=$data_totalvictima['mvi_valor'];
                  $valortotal_victima=$valortotal_victima+$mvi_valor;
              }
              //fin sumatoria total victoma

              //inicio sumatoria total discapacidad
              $total_discapacidad = $principal_sql->totalejecutado_discapacidad($cnxn_pag, $vej_metaproducto, $vej_codigo);
              $valortotal_discapacidad=0;
              while($data_totaldiscapacidad=$cnxn_pag->obtener_filas($total_discapacidad, $vej_metaproducto)){
                  $mdi_valor=$data_totaldiscapacidad['mdi_valor'];
                  $valortotal_discapacidad=$valortotal_discapacidad+$mdi_valor;
              }
              //fin sumatoria total discapacidad

              //inicio sumatoria total etnia
              $total_etnia = $principal_sql->totalejecutado_etnia($cnxn_pag, $vej_metaproducto, $vej_codigo);
              $valortotal_etnia=0;
              while($data_totaletnia=$cnxn_pag->obtener_filas($total_etnia, $vej_metaproducto)){
                  $met_valor=$data_totaletnia['met_valor'];
                  $valortotal_etnia=$valortotal_etnia+$met_valor;
              }
              //fin sumatoria total etnia

              if($numero_registroempe%2==0){

                $color='style="background-color:#F3F3E9;"';

              }
              else{
                $color='';
              }

        ?>
          <tr <?php echo $color; ?> >
            <td data-label="Nro"><?php echo $numero_registroempe; ?></td>
            <!-- <td style="text-align:left;"><?php echo $mpr_descripcion; ?></td> -->
            <td data-label="Vigencia" style="text-align:left;"><?php echo $vej_vigencia; ?></td>
            <td data-label="Municipio" style="text-align:left;"><?php echo $mun_nombre; ?></td>
            <!--
            <td><div class="tooltip"><a href='javascript:void(0);' class="valor_avance__" data-codigometaproducto="<?php echo $vej_metaproducto; ?>" data-codigovalorejecutado='<?php echo $vej_codigo; ?>'><?php echo $vej_valor; ?></a><span class="tooltiptext"><img src='img/ico/editar-v.png' /> </span></div></td>
            <td><div class='tooltip'><a href='javascript:void(0);' class='valor_fufi__' data-codigometaproducto='<?php echo $vej_metaproducto; ?>' data-codigovalorejecutado='<?php echo $vej_codigo; ?>'>$ <?php echo number_format($valortotal_fufi, 2, '.', '.'); ?></a><span class="tooltiptext"><img src='img/ico/editar-v.png' /> </span></div></td>
            <td><div class="tooltip"><a href="javascript:void(0);" class='valor_genero__' data-codigometaproducto='<?php echo $vej_metaproducto; ?>' data-codigovalorejecutado='<?php echo $vej_codigo; ?>'><?php echo $valortotal_genero; ?></a><span class="tooltiptext"><img src="img/ico/editar-v.png" /></span></div></td>
            -->
            <?php
            $fecha_actualll=date('Y')-1;

          if($_SESSION['prsona']=='201604281729001' || $_SESSION['prsona']=='20' || $_SESSION['prsona']=='6' /* || $_SESSION['prsona']=='3' */){
              $rayapiso="";
            }
            else{

              if($vej_vigencia==$fecha_actualll){
                 $rayapiso="";// habilita las vigencias anteriores
              }
              else{
                  $rayapiso="_";// deshabilita las vigencias anteriores
              }

            }
            ?>

            <td data-label="Valor Avance MP"><div data-label="Valor Avance MP" class="tooltip"><a href='javascript:void(0);' class="valor_avance<?php echo $rayapiso; ?>" data-codigometaproducto="<?php echo $vej_metaproducto; ?>" data-codigovalorejecutado='<?php echo $vej_codigo; ?>'><?php echo $vej_valor; ?></a><span class="tooltiptext edi"><img src='img/ico/editar-v.png' /></span></div></td>
            <td data-label="Valor Total Recursos (En Pesos)"><div class='tooltip'><a href='javascript:void(0);' class='valor_fufi<?php echo $rayapiso; ?>' data-codigometaproducto='<?php echo $vej_metaproducto; ?>' data-codigovalorejecutado='<?php echo $vej_codigo; ?>'>$ <?php echo number_format($valortotal_fufi, 2, '.', '.'); ?></a><span class="tooltiptext edi"><img src='img/ico/editar-v.png' /> </span></div></td>
            <td data-label="Pobl. por Género"><div class="tooltip"><a href="javascript:void(0);" class='valor_genero<?php echo $rayapiso; ?>' data-codigometaproducto='<?php echo $vej_metaproducto; ?>' data-codigovalorejecutado='<?php echo $vej_codigo; ?>'><?php echo $valortotal_genero; ?></a><span class="tooltiptext edi"><img src="img/ico/editar-v.png" /></span></div></td>
            <td data-label="Pobl. Victima"><div class="tooltip"><a href="javascript:void(0);" class='valor_victima<?php echo $rayapiso; ?>' data-codigometaproducto='<?php echo $vej_metaproducto; ?>' data-codigovalorejecutado='<?php echo $vej_codigo; ?>'><?php echo $valortotal_victima; ?></a><span class="tooltiptext edi"><img src="img/ico/editar-v.png" /></span></div></td>
            <td data-label="Pobl. Discapacidad"><div class="tooltip"><a href="javascript:void(0);" class='valor_discapacidad<?php echo $rayapiso; ?>' data-codigometaproducto='<?php echo $vej_metaproducto; ?>' data-codigovalorejecutado='<?php echo $vej_codigo; ?>'><?php echo $valortotal_discapacidad; ?></a><span class="tooltiptext edi"><img src="img/ico/editar-v.png" /></span></div></td>
            <td data-label="Pobl. Etnica"><div class="tooltip"><a href="javascript:void(0);" class='valor_etnia<?php echo $rayapiso; ?>' data-codigometaproducto='<?php echo $vej_metaproducto; ?>' data-codigovalorejecutado='<?php echo $vej_codigo; ?>'><?php echo $valortotal_etnia; ?></a><span class="tooltiptext edi"><img src="img/ico/editar-v.png" /></span></div></td>


            <td class="text-left">
              <?php
                  if($vej_vigencia==$fecha_actualll && $dpl_proceso=='1'){
              ?>
                <a href="Javascript:modal_eliminarvalorjecucuionmp('<?php echo $vej_codigo; ?>','<?php echo $vej_metaproducto; ?>')" class ="new-btn dfn-hover" title=""><img src="img/ico/basura.png" /></a>
              <?php
                  }
                  else{
                    echo "";
                  }
               ?>

            </td>
          </tr>
        <?php
          $numero_registroempe++;
        }

      ?>
      </table>

    </td>
</tr>

<script>
$(document).ready(function(){
      $(".cerrar-modal").click(function() {
        $(".encimaModal").fadeOut(300, function(){
          $(".encima").fadeOut(300);
        });
      });
});

$(".valor_avance").click(function(){

    var codigo_metaproducto = $(this).data("codigometaproducto");
    var codigo_valorejecutado = $(this).data("codigovalorejecutado");
    //alert(codigo_metaproducto + ' :: ' + codigo_valorejecutado);

    $.ajax({
      url:"modificarvalorejecucion",
      type:"POST",
      data:"codigo_metaproducto="+codigo_metaproducto+"&codigo_valorejecutado="+codigo_valorejecutado,
      async:true,

      success: function(message){
        $("#modalContenido").empty().append(message);
        //$("#modalContenido").html("<h2>El M/pio seleccionado es: " + code + "</h2>");

        $(".encima").fadeIn(300, function(){
          $(".encimaModal").fadeIn(300);
        });
      }
    });

});

$(".valor_fufi").click(function(){

    var codigo_metaproducto = $(this).data("codigometaproducto");
    var codigo_valorejecutado = $(this).data("codigovalorejecutado");
    //alert(codigo_metaproducto + ' :: ' + codigo_valorejecutado);

    $.ajax({
      url:"modificarvalorfufi",
      type:"POST",
      data:"codigo_metaproducto="+codigo_metaproducto+"&codigo_valorejecutado="+codigo_valorejecutado,
      async:true,

      success: function(message){
        $("#modalContenido").empty().append(message);
        //$("#modalContenido").html("<h2>El M/pio seleccionado es: " + code + "</h2>");

        $(".encima").fadeIn(300, function(){
          $(".encimaModal").fadeIn(300);
        });
      }
    });

});



$(".valor_genero").click(function(){

    var codigo_metaproducto = $(this).data("codigometaproducto");
    var codigo_valorejecutado = $(this).data("codigovalorejecutado");
    //alert(codigo_metaproducto + ' :: ' + codigo_valorejecutado);

    $.ajax({
      url:"modificarvalorgenero",
      type:"POST",
      data:"codigo_metaproducto="+codigo_metaproducto+"&codigo_valorejecutado="+codigo_valorejecutado,
      async:true,

      success: function(message){
        $("#modalContenido").empty().append(message);
        //$("#modalContenido").html("<h2>El M/pio seleccionado es: " + code + "</h2>");

        $(".encima").fadeIn(300, function(){
          $(".encimaModal").fadeIn(300);
        });
      }
    });

});

$(".valor_victima").click(function(){

    var codigo_metaproducto = $(this).data("codigometaproducto");
    var codigo_valorejecutado = $(this).data("codigovalorejecutado");
    //alert(codigo_metaproducto + ' :: ' + codigo_valorejecutado);

    $.ajax({
      url:"modificarvictimaejecucion",
      type:"POST",
      data:"codigo_metaproducto="+codigo_metaproducto+"&codigo_valorejecutado="+codigo_valorejecutado,
      async:true,

      success: function(message){
        $("#modalContenido").empty().append(message);
        //$("#modalContenido").html("<h2>El M/pio seleccionado es: " + code + "</h2>");

        $(".encima").fadeIn(300, function(){
          $(".encimaModal").fadeIn(300);
        });
      }
    });

});

$(".valor_discapacidad").click(function(){

    var codigo_metaproducto = $(this).data("codigometaproducto");
    var codigo_valorejecutado = $(this).data("codigovalorejecutado");
    //alert(codigo_metaproducto + ' :: ' + codigo_valorejecutado);

    $.ajax({
      url:"modificardiscapacidadejecucion",
      type:"POST",
      data:"codigo_metaproducto="+codigo_metaproducto+"&codigo_valorejecutado="+codigo_valorejecutado,
      async:true,

      success: function(message){
        $("#modalContenido").empty().append(message);
        //$("#modalContenido").html("<h2>El M/pio seleccionado es: " + code + "</h2>");

        $(".encima").fadeIn(300, function(){
          $(".encimaModal").fadeIn(300);
        });
      }
    });

});

$(".valor_etnia").click(function(){

    var codigo_metaproducto = $(this).data("codigometaproducto");
    var codigo_valorejecutado = $(this).data("codigovalorejecutado");
    //alert(codigo_metaproducto + ' :: ' + codigo_valorejecutado);

    $.ajax({
      url:"modificaretniaejecucion",
      type:"POST",
      data:"codigo_metaproducto="+codigo_metaproducto+"&codigo_valorejecutado="+codigo_valorejecutado,
      async:true,

      success: function(message){
        $("#modalContenido").empty().append(message);
        //$("#modalContenido").html("<h2>El M/pio seleccionado es: " + code + "</h2>");

        $(".encima").fadeIn(300, function(){
          $(".encimaModal").fadeIn(300);
        });
      }
    });

});





</script>
