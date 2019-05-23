<?php
$codigo_mepro=$codigo_elemento1;
$meta_productoponderacion=$principal_sql->meproid($cnxn_pag, $codigo_mepro);
$data_metaproductoponderacion=$cnxn_pag->obtener_filas($meta_productoponderacion);
$mpr_ponderacion=$data_metaproductoponderacion['mpr_ponderacion'];


//echo "prueba hecha";

?>
<div class="tooltip ponderacionmp<?php echo $mpr_codigo; ?> ponderacionmepro" data-codigometaproducto='<?php echo $mpr_codigo; ?>'>
    <a href="javascript:void(0);" >
        <?php echo $mpr_ponderacion; ?>
    </a>
  <span class="tooltiptext">&nbsp;<img src="img/ico/editar-v.png" /></span>

</div>
