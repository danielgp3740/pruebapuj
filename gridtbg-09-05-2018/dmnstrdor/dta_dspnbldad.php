<?php

$disponibilidad_sistema=$principal_sql->disponibilidad_sql($cnxn_pag, $codigo_disponibilidad, $codigo_entidadpersona);
//echo $disponibilidad_sistema;
$check_disponibilidad=$cnxn_pag->obtener_filas($disponibilidad_sistema);
$dpl_proceso=$check_disponibilidad['dpl_proceso'];
$dpl_entidades_disponible=$check_disponibilidad['dpl_entidades_disponible'];
?>
<div class="col-md-12">
  <strong>Disponibilidad:</strong>
</div>
<div class="col-md-6">
<table>
  <tr>
    <th>No</th>
    <th>Entidad</th>
    <th style="text-align:left;">&nbsp;&nbsp;Disponible</th>
  </tr>
  <tr>
    <td>-</td>
    <td style="text-align:left;"><strong>Todos</strong></td>
    <td style="text-align:center;">
      <?php
      //$dpl_proceso='0';
          if($dpl_proceso=='1'){
            $checked_disponible="checked";
            $checked_entidades="checked";
          }
          else {
            $checked_disponible="";
            $checked_entidades="";
          }
      ?>

      <input type="checkbox" class="checktodo" name="chk_diponibilidad_all" id="chk_diponibilidad_all" value="todo" <?php echo $checked_disponible; ?> >
    </td>

  </tr>
  <?php
  $entidad_disponibilidad=$principal_sql->entidad($cnxn_pag, $persona_entidad);
    $numeroentidad=1;
    while($list_entidad=$cnxn_pag->obtener_filas($entidad_disponibilidad)){
        $ent_codigo=$list_entidad['ent_codigo'];
        $ent_nombre=$list_entidad['ent_nombre'];

        if (eregi($ent_codigo.$ent_nombre,$dpl_entidades_disponible)) {
          $checked_disponible="checked";
          $checked_entidades="checked";
        }
        else {
          $checked_disponible="";
          $checked_entidades="";
        }
  ?>
  <tr>

      <td>
        <?php echo $numeroentidad; ?>
      </td>
      <td style="text-align:left;">
        <?php echo $ent_nombre; ?>
      </td>
      <td style="text-align:center;" class="wd-3">
        <input type="checkbox" class="micheckbox" name="chk_diponibilidad[]" id="chk_diponibilidad<?php echo $ent_codigo; ?>" value="<?php echo $ent_codigo.$ent_nombre; ?>" <?php echo $checked_entidades; ?>>
      </td>
  </tr>
  <?php
    $numeroentidad++;
    }
  ?>
</table>

</div>
<script type="text/javascript">

  $(".checktodo").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
      var todo='';
      var disponible='';

      if( $(this).is(':checked') ) {
          // Hacer algo si el checkbox ha sido seleccionado
          //alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
          todo='activo';
          disponible='1';

      } else {
          // Hacer algo si el checkbox ha sido deseleccionado
          //alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
          todo='desactivo';
          disponible='0';
      }

      var datachek={ 'chk_diponibilidad[]' : []};
      $(":checked").each(function() {
        datachek['chk_diponibilidad[]'].push($(this).val());
      });
      //alert(datachek);
      $.post("insertardisponobilidad",datachek,
        function(datachek, status){
            //alert("Data: " + datachek + "\n Status: " + status);
            $('.dentro').load();
        }
      );

  });



$(".micheckbox").on( 'change', function() {

    todo='desactivo';
    disponible='0';

    if( $(this).is(':checked') ) {
        // Hacer algo si el checkbox ha sido seleccionado
        alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");

    } else {
        // Hacer algo si el checkbox ha sido deseleccionado
        alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
    }


    var datachek={ 'chk_diponibilidad[]' : []};
    $(":checked").each(function() {
      datachek['chk_diponibilidad[]'].push($(this).val());
    });

    $.post("insertardisponobilidad",datachek,
      function(datachek, status){
          //alert("Data: " + datachek + "\n Status: " + status);
          $('.dentro').load();
      }
    );


  });
</script>
