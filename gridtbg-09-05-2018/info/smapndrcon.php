<?php

  $meresultado_codigo=$codigo_elemento1;
  $meta_productoponderacion=$principal_sql->meta_producto($cnxn_pag, $meresultado_codigo);

  while($data_metaproductoponderacion=$cnxn_pag->obtener_filas($meta_productoponderacion)){
      $mpr_ponderaciont=$data_metaproductoponderacion['mpr_ponderacion'];
      $totalponderacion=$totalponderacion+$mpr_ponderaciont;
  }
  if($totalponderacion!=100){
    $color_ponderacion=" style='color:red;' ";
  }
  else {
    $color_ponderacion="";
  }



?>
<span <?php echo $color_ponderacion; ?>><strong><?php echo $totalponderacion; ?></strong></span>
