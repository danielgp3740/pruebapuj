<?php
$codigo_municipio=$_REQUEST['codigo_municipio'];
$codigo_foto=$_REQUEST['codigo_foto'];

$mapa_foto = $mapa_sql->fotosmapa($cnxn_pag, $escenario, $codigo_municipio, $sector, $codigo_foto);
$data_fotos=$cnxn_pag->obtener_filas($mapa_foto);
    $mfo_codigo=$data_fotos['mfo_codigo'];
    $mfo_mepro=$data_fotos['mfo_mepro'];
    $mfo_url=$data_fotos['mfo_url'];
    $pfo_municipio=$data_fotos['pfo_municipio'];
    $pfo_descripcion=$data_fotos['pfo_descripcion'];
?>



<input type="button" class="cerrar-modal" value="" alt="Cerrar" title="Cerrar">
<h3>Proyecto Destacado</h3>
<img src="<?php echo $enlace."img/fotos/".$mfo_url; ?>">
  <p><?php echo $pfo_descripcion;  ?></p>

<script type="text/javascript">
    $("#verDestacado .cerrar-modal").click(function(){
      ocultarDestacado();
    });
</script>
