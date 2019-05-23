<?php
$codigo_mepro=$_POST['id_mepro'];



$lista_valormp=$principal_sql->meproid($cnxn_pag, $codigo_mepro);
$data_valormp=$list_cenpo=$cnxn_pag->obtener_filas($lista_valormp);
$mpr_lineabase=$data_valormp['mpr_lineabase'];
$mpr_valorcuatrenio=$data_valormp['mpr_valorcuatrenio'];


$lista_vigenciamp=$principal_sql->valor_esperadoall($cnxn_pag, $codigo_mepro);

if($mpr_lineabase > $mpr_valorcuatrenio){
  $imgtipo="diminuye.png";
  $tipometa='Reducción';
}
elseif($mpr_lineabase==$mpr_valorcuatrenio){
  $imgtipo="mantiene.png";
  $tipometa='Mantiene';
}
else{
  $imgtipo="incremento.png";
  $tipometa='Aumenta';
}

?>

<legend> <br> Valores Esperados</legend>


  <div class="col-md-2">
    <label>Linea Base</label>
    <p><?php echo $mpr_lineabase; ?></p>
  </div>
  <div class="col-md-2">
    <label>Valor Cuatrenio</label>
    <p><?php echo $mpr_valorcuatrenio; ?></p>

  </div>
  <div class="col-md-2">
    <label>Orientación</label>
    <p><img src="img/ico/<?php echo $imgtipo; ?>" /></p>
  </div>

  <div class="col-md-2">
    <label>Acumulado Cuatrenio</label>
    <p> </p>
  </div>

  <div class="col-md-12">  </div>



  <?php
    while($data_valormp=$cnxn_pag->obtener_filas($lista_vigenciamp)){
        $ves_valor=$data_valormp['ves_valor'];
        $ves_vigencia=$data_valormp['ves_vigencia'];
  ?>

  <div class="col-md-2">
    <label>Vigencia <?php echo $ves_vigencia; ?></label>
    <p><?php echo $ves_valor; ?></p>
  </div>


  <?php

    }
  ?>
<!--
  <div class="col-md-2">
    <label>Acumulado Vigencia</label>
    <p> </p>
  </div>
-->
