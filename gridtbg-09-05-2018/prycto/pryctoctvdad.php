
<?php

$codigo_proyecto=$_REQUEST['codigo_proyecto'];
//$codigo_entidadtbg=$_REQUEST['codigo_entidad'];
$lista_actividadproyecto=$proyecto_sql->actividadproyecto($cnxn_pag, $codigo_proyecto, $codigoentidad, $codigoactividad);
//echo $lista_actividadproyecto;
?>



<div class="box-tabla">


<div class="tbl-header">
<table class="tablaFijaCss">
<thead>
<tr class="bg-v">
  <th class="wd-3">&nbsp;<strong>Nro.</strong> </th>
  <th >&nbsp;<strong>Meta de Producto</strong>&nbsp;</th>
  <th >&nbsp;<strong>Actividad</strong>&nbsp;</th>
  <th >&nbsp;<strong>Recursos</strong>&nbsp;</th>

<!--
  <th>&nbsp;<strong>V 2018</strong>&nbsp;</th>
  <th>&nbsp;<strong>V 2019</strong>&nbsp;</th>
-->
</tr>
</thead>
</table>

</div>

  <div class="tbl-content">
  <table class="tablaFijaCss">

<?php
$numero_entidad=1;
  while($data_actividadproyecto=$cnxn_pag->obtener_filas($lista_actividadproyecto)){
      $apr_descripcion=$data_actividadproyecto['apr_descripcion'];
      $apr_descripcionproducto=$data_actividadproyecto['apr_descripcionproducto'];
      $apr_recurso=$data_actividadproyecto['apr_recurso'];
echo "<tr>";
      echo "<td data-label='Nro' class='wd-3'>$numero_entidad</td>";
      echo "<td data-label='Meta de Producto'>$apr_descripcionproducto</td>";
      echo "<td data-label='Actividad'>$apr_descripcion</td>";
      echo "<td data-label='Recursos'>$apr_recurso</td>";
echo "</tr>";

      $numero_entidad++;
}
?>


  </table>

  </div>

</div>
