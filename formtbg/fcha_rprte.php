<?php
  $codigo_fechareporte=$_REQUEST['codigo_fechareporte'];
  //echo $codigo_fechareporte;
  if($codigo_fechareporte !='undefined'){
    $modificar_fechareporte = $principal_sql->modificarfechareporte_sql($cnxn_pag, $codigo_fechareporte);
    $list_modificarfechareporte=$cnxn_pag->obtener_filas($modificar_fechareporte);

    $fechareporte_periodo = $list_modificarfechareporte['fre_fechareporte'];
    $fechareporte_vigencia = $list_modificarfechareporte['fre_vigencia'];
    $fechareporte_estado = $list_modificarfechareporte['fre_estado'];
  }
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
<form id="formulario" class='frm_agregarfechareporte' name="frm_agregarfechareporte" action="modificarfechareporte" method="post" >

  <div class="recuadro">
        <div id="titulo" class="titulo">
            Agregar Fecha Reporte
            <div class="bloDr">
 								<input type="button" value='' class="guardar-modal" alt="Guardar" title="Guardar">
                <input type="button" class='cerrar-modal x-mediano' value='' alt="Cerrar" title="Cerrar">
               </div>
           </div>
					 <div class="espacio al60"></div>
           <div class="col-md-6">
             <label>Fecha Periodo:</label>
             <input type="text" name="txt_fechaperiodo" id="txt_fechaperiodo" value="<?php echo $fechareporte_periodo; ?>" />
           </div>
          <div class="col-md-6">
            <label>Vigencia:</label>
            <div class="combo" id="fecha_vigencia">
              <select name="sel_fechavigencia" id="sel_fechavigencia" title:"Seleccione una Fecha de Vigencia" class="valid">
                <?php
                  if($fechareporte_vigencia == '2019'){
                    echo "<option value='2019'>2019</option>
                          <option value='2018'>2018</option>";
                  }
                  else{
                    echo "<option value='2018'>2018</option>
                          <option value='2019'>2019</option>";
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <!--
            <label>Estado:</label>
            <div class="combo" id="fecha_estado">
              <select name="sel_fechaestado" id="sel_fechaestado" title:"Seleccione un estado" class="valid">
                <?php
                  if($fechareporte_estado == '0'){
                    echo "<option value='0'>Inactivo</option>
                          <option value='1'>Activo</option>";
                  }
                  else{
                    echo "<option value='1'>Activo</option>
                          <option value='0'>Inactivo</option>";
                  }
                ?>
              </select>
            </div>

          -->
          </div>
          <input type="hidden" name="txt_codigofechareporte" id="txt_codigofechareporte" value="<?php echo $codigo_fechareporte; ?>" />
        </div>
</form>
<script type='text/javascript'>
  $(".guardar-modal").click(function(){
  var txt_fechaperiodo=$('#txt_fechaperiodo').val();
    if(txt_fechaperiodo==''){
      //alert('asda');
        $("#ModalErrorFP").modal({backdrop: true});
        $('#txt_fechaperiodo').focus();

        return false;
    }
      var data_enviar=$('.frm_agregarfechareporte').serialize();
      $.post("modificarfechareporte",data_enviar,
          function(data_enviar, status){
             //alert("Data: " + data + "\nStatus: " + status);

              $(".dentro").load('datafechareporte');

              $(".encimaModal").fadeOut(300, function(){
                  $(".encima").fadeOut(300);
              });

        });
  });



    /*$(".valor_fechareporte").click(function(){
      //alert('modal fecha reporte');
        //var txt_fechaperiodo=$('#txt_fechaperiodo').val();
        var codigo_fechareporte = $(this).data("codigofechareporte");

      /*  if(txt_fechaperiodo==''){
          alert('asda');
            $("#ModalErrorFP").modal({backdrop: true});
            $('#txt_fechaperiodo').focus();

            return false;
        }//*

        $.ajax({
          url:"ejecucionfechareporte",
          type:"POST",
          data:"codigo_fechareporte="+codigo_fechareporte,
          async:true,

          success: function(message){
            $("#modalContenido").empty().append(message);
            //$("#modalContenido").html("<h2>El M/pio seleccionado es: " + code + "</h2>");

            $(".encima").fadeIn(300, function(){
              $(".encimaModal").fadeIn(300);
            });
          }
        });

    });*/
</script>
