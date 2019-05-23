<?php


if($_REQUEST['codigo_meproejecutado']){
  $codigo_metapro=$_REQUEST['codigo_meproejecutado'];
  $persona_entidad=$_SESSION['entidad_persona'];
}
else{
  $codigo_metapro=$codigo_elemento1;
  $persona_entidad=$_SESSION['entidad_persona'];
}

//echo $codigo_metapro;

//$valores_ejecutadosxvigencia = $principal_sql->valor_ejecutadomp($cnxn_pag, $codigo_metapro, $persona_entidad);
$metas_producto_entidad = $principal_sql->metaproducto_entidad($cnxn_pag, $persona_entidad);
$migamepro = $principal_sql->miga_mepro($cnxn_pag, $metapro_codigo);

//echo $metas_producto_entidad;
//echo $valores_ejecutadosxvigencia;

?>


<!-- INICIO MODAL vigencias-->
<div class="modal fade" id="myModalBorrarvalorEjecuacion" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <h4>Desea Elimnar el registro</h4>
        <input value="" type="hidden" id="txt_eliminardatove" name="txt_eliminardatove">
        <input value="" type="hidden" id="txt_codigomepro" name="txt_codigomepro">
      </div>
      <div class="modal-footer">
        <button type="button" onclick="borrar_eliminarvalorjecucuionmp();"  class="btn btn-default">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>
<!-- FIN MODAL vigencias-->

<script src="js/jquery.fixedtableheader.js" type="text/javascript"> </script>

<script type="text/javascript">
$(function(){
  $(".tbl1").fixedtableheader();

 /* $(".tbl2").fixedtableheader({ highlightrow: true, headerrowsize: 3 });

  $(".tbl3").fixedtableheader({ highlightrow: true, highlightclass: "highlight2", headerrowsize: 3 });*/
})
</script>

    <table id="ordenar" class="tbl1 tablaRecoge grande">
      <thead>
        <tr>
          <th>&nbsp;&nbsp;Nro. </th>
          <th>&nbsp;Meta de Producto&nbsp;</th>
          <th>&nbsp;Linea Base </th>
          <th>&nbsp;Valor Cuatrenio </th>

          <!-- <th>&nbsp;Vigencia&nbsp;</th>
          <th>&nbsp;Municipio&nbsp;</th>
          <th>&nbsp;Valor Avance MP&nbsp;</th>
          <th>&nbsp;Valor Total Recursos&nbsp;</th>
          <th>&nbsp;Pobl. por Género&nbsp;</th>
          <th>&nbsp;Pobl. Victima&nbsp;</th>
          <th>&nbsp;Pobl. Discapacitada&nbsp;</th>
          <th>&nbsp;Pobl. Etnica&nbsp;</th>
          <th>&nbsp;</th> -->
        </tr>
      </thead>

        <?php
        $numero_registroemp=1;

          while($data_metaproductoxentidad=$cnxn_pag->obtener_filas($metas_producto_entidad)){
              $mpr_codigo=$data_metaproductoxentidad['mpr_codigo'];
              $mpr_descripcion=$data_metaproductoxentidad['mpr_descripcion'];
              $mpr_lineabase=$data_metaproductoxentidad['mpr_lineabase'];
              $mpr_valorcuatrenio=$data_metaproductoxentidad['mpr_valorcuatrenio'];

              $migamepro = $principal_sql->miga_mepro($cnxn_pag, $mpr_codigo);
              $data_migamepro=$cnxn_pag->obtener_filas($migamepro);

              $eac_nombre=$data_migamepro['eac_nombre'];

              $sad_nombre=$data_migamepro['sad_nombre'];

              $pro_nombre=$data_migamepro['pro_nombre'];

              $mre_descripcion=$data_migamepro['mre_descripcion'];


              if($numero_registroemp%2==0){

                $color=' style="background-color:#F3F3E9; "';

              }
              else{
                $color='';
              }

        ?>
        <thead data-codigomp="<?php echo $mpr_codigo; ?>">
          <tr class="trdato"  <?php echo $color; ?>  >

              <td data-label="Nro"><?php echo $numero_registroemp; ?></td>
              <td data-label="Meta de Producto" style="text-align:left;font-weight:bold;"> <br><?php echo $mpr_descripcion; ?>
                <div class="tooltip ">
                  <a href="Javascript:void(0);" title="">
                        <img class="media-object" src="img/ico/ayuda.png" />
                  </a>
                 <span class="tooltiptext lw">
                   <?php echo "$eac_nombre / $sad_nombre / $pro_nombre / $mre_descripcion"; ?>
                  </span>

                          </div></td>
              <td data-label="Linea Base"><?php echo $mpr_lineabase; ?></td>
              <td data-label="Valor Cuatrenio" class="noB"><?php echo $mpr_valorcuatrenio; ?></td>

          </tr>
        </thead>

          <tbody id="datos_mepro<?php echo $mpr_codigo; ?>" >
            <tr>
              <td colspan="4">Cargando...<td>
            </tr>
          </tbody>

        <?php
            $numero_registroemp++;
          }

        ?>

  </table>
  <script type="text/javascript">
      $(".tablaRecoge thead .trdato").click(function(){
        var codigo_tabla = $(this).parent().data("codigomp");
        //alert(codigo_tabla);
        //$(".recuadro").animate({ scrollTop: ($(this).offset().top)-20 }, 500);
        //$(this).siblings("tbody").slideToggle(500);
        //$(this).parent().siblings("tbody").slideToggle(500);
        $(this).parent().siblings("tbody#datos_mepro"+codigo_tabla).slideToggle(500);
        /*
        $(this).siblings('tbody').slideToggle(1500, function(){
          $("html, body").animate({ scrollTop: ($(this).offset().top)-20 }, 500);
        });
        */


        $.ajax({
          url:"reportexvigenciamepro",
          type:"POST",
          data:"codigo_mepro="+codigo_tabla,
          async:true,

          success: function(message){
            //$("#datos_mepro"+codigo_tabla).empty().append(message);
            $("tbody#datos_mepro"+codigo_tabla).html(message);
          }
        });

      });
  </script>

<script type='text/javascript'>

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






        /**************************Iniicio eliminar registro ejecución *************************************/
        function modal_eliminarvalorjecucuionmp(codigo_valorejecutado,txt_codigomepro){
             var codigo_valorejecutado=codigo_valorejecutado;
             var txt_codigomepro=txt_codigomepro;
             $('#txt_eliminardatove').val(codigo_valorejecutado);
             $('#txt_codigomepro').val(txt_codigomepro);


              $("#myModalBorrarvalorEjecuacion").modal({backdrop: true});


        }

        function borrar_eliminarvalorjecucuionmp(){
          var codigo_valorejecutado=$('#txt_eliminardatove').val();
          var codigo_metapro=$('#txt_codigomepro').val();
          //alert(codigo_valorejecutado);




          $.ajax({
              type: 'POST',
              url: 'eliminarvaloresejecutado',
              data: 'codigo_valorejecutado='+codigo_valorejecutado+'&txt_codigomepro='+codigo_metapro,
              // Mostramos un mensaje con la respuesta de PHP
              success: function(message) {
                  $("#resultado_consulta").empty().append(message);
              }
          });

          $('#myModalBorrarvalorEjecuacion').modal('toggle');

        }

/**************************Iniicio eliminar registro ejecución *************************************/


</script>
