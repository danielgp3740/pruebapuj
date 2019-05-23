<?php

$persona_entidad=$_SESSION['entidad_persona'];

if(isset($_POST['codigo_programa']) || isset($_POST['vigencia'])){
  $codigo_programa=$_POST['codigo_programa'];
  $vigencia=$_POST['vigencia'];
}
else{
  $codigo_programa=0;
  $vigencia=0;
}


$lista_proyectosprograma=$proyecto_sql->proyectoprograma_sql($cnxn_pag, $codigoproyecto, $persona_entidad, $codigo_programa, $vigencia);


?>

<table class="tbl1 tablaRecoge grande" >
  <thead>
      <tr>
        <th>No</th>
        <th>Programa</th>
        <th>Proyecto</th>
        <th>No Personas Objetivo</th>
        <th>Año</th>
      </tr>
  </thead>
  <?php
  $numero_entidad=1;
    while($data_proyectosprograma=$cnxn_pag->obtener_filas($lista_proyectosprograma)){
        $ppr_codigo=$data_proyectosprograma['ppr_codigo'];
        $pro_nombre=$data_proyectosprograma['pro_nombre'];
        $ppr_nombre=$data_proyectosprograma['ppr_nombre'];
        $ppr_vigencia=$data_proyectosprograma['ppr_vigencia'];
        $ppr_numeropersonaobjetiva=$data_proyectosprograma['ppr_numeropersonaobjetiva'];

  ?>

    <thead data-codigo="<?php echo $ppr_codigo; ?>">
      <tr  class="trdato">
      <td style="text-align:center;" >
        <?php echo $numero_entidad; ?>
      </td>
      <td style="text-align:left;" >
         <?php echo $pro_nombre; ?>
      </td>
      <td style="text-align:left;" >
         <?php echo $ppr_nombre; ?>
      </td>
      <td style="text-align:right;" >
        <?php echo $ppr_numeropersonaobjetiva ?>
      </td>
      <td style="text-align:right;" >
        <?php echo $ppr_vigencia ?>
      </td>
      </tr>
    </thead>
    <tbody id="datos_proyecto<?php echo $ppr_codigo; ?>" >

        <tr>
          <td colspan="8">Cargando...</td>
        </tr>

    </tbody>

  <?php
  $numero_entidad++;
    }
  ?>
</table>

<script type="text/javascript">
    $(".tablaRecoge thead .trdato").click(function(){
      var codigo_tabla = $(this).parent().data("codigo");
      //alert(codigo_tabla);
      //$(".recuadro").animate({ scrollTop: ($(this).offset().top)-20 }, 500);
      $(this).parent().siblings("tbody#datos_proyecto"+codigo_tabla).slideToggle(500);
      /*
      $(this).siblings('tbody').slideToggle(1500, function(){
        $("html, body").animate({ scrollTop: ($(this).offset().top)-20 }, 500);
      });
      */


      $.ajax({
        url:"actividadproyecto",
        type:"POST",
        data:"codigo_proyecto="+codigo_tabla,
        async:true,

        success: function(message){
          $("#datos_proyecto"+codigo_tabla+" tr td").empty().append(message);
        }
      });

    });
</script>
