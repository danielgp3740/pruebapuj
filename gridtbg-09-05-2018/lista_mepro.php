<?php

$codigo_meru=$_POST['id_meru'];

$meta_producto = $principal_sql->meta_producto($cnxn_pag, $codigo_meru);

?>
<select id="sel_mepro"  name="sel_mepro" title="Seleccione una Meta Producto" required="" aria-required="true" class="valid" aria-invalid="false" onchange='traer_valormp(); traer_datosejecutadosmp(); municipio_reportado();' >
    <option value="">Seleccione:--</option>
    <?php
      while($list_meru=$cnxn_pag->obtener_filas($meta_producto)){
          $mpr_codigo=$list_meru['mpr_codigo'];
          $mpr_nombre=$list_meru['mpr_descripcion'];
    ?>
        <option value="<?php echo $mpr_codigo; ?>"><?php echo $mpr_nombre; ?></option>
    <?php

      }

    ?>

</select>

<script type="text/javascript">

    function municipio_reportado(){
      var munmepro=$('#sel_mepro').val();
      //alert(munmepro);

      $.ajax({
        url:"municipiosreportar",
        type:"POST",
        data:"munmepro="+munmepro,
        async:true,

        success: function(message){
          //$(".modal-body").empty().append(message);
          $("#idlist_municipio").empty().append(message);
        }
      });

    }
</script>
