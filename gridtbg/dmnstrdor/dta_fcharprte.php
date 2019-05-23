<?php
$fechareporte_sistema=$principal_sql->fechareporte_sql($cnxn_pag);
//echo $disponibilidad_sistema;
?>
<div class="col-md-12">
  <strong>Fecha reporte:</strong>
</div>
  <a href="javascript:void(0);" title="Agregar Valores" id="newvalores" class="new-btn valor_fechareporte"><img src="img/ico/new.png" /></a>
<div class="col-md-6">
<table>
  <tr>
    <th>No</th>
    <th>Fecha periodo</th>
    <th>Vigencia</th>
    <th>Estado</th>
    <th>Editar</th>
  </tr>
  <?php
    $numerofechareporte=1;
    while($list_fechareporte=$cnxn_pag->obtener_filas($fechareporte_sistema)){
        $fre_codigo = $list_fechareporte['fre_codigo'];
        $fre_fechareporte=$list_fechareporte['fre_fechareporte'];
        $fre_vigencia=$list_fechareporte['fre_vigencia'];
        $fre_estado=$list_fechareporte['fre_estado'];
  ?>
  <tr>

      <td>
        <?php echo $numerofechareporte; ?>
      </td>
      <td style="text-align:left;">
        <?php echo $fre_fechareporte; ?>
      </td>
      <td style="text-align:center;">
        <?php echo $fre_vigencia; ?>
      </td>
      <td style="text-align:center;">
        <?php
          if ($fre_estado == 1){
            echo "Activo";
          }
          else{
            echo "Inactivo";
          }
        ?>
      </td>
      <td>
        <div class="tooltip">
          <?php
              if ($numerofechareporte == 1){
          ?>
          <a class="edit new-btn valor_fechareporte" title="" href="Javascript:void(0);" data-codigofechareporte='<?php echo $fre_codigo; ?>'><img src="img/ico/editar.png" /></a>
          <?php
              }
              else{
          ?>
              ---
          <?php
              }
          ?>
        </div>
      </td>
  </tr>
  <?php
    $numerofechareporte++;
    }
  ?>
</table>
</div>
<script type="text/javascript">
    $(".valor_fechareporte").click(function(){
      //alert('modal fecha reporte');
        //var txt_fechaperiodo=$('#txt_fechaperiodo').val();
        var codigo_fechareporte = $(this).data("codigofechareporte");

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

    });
</script>
