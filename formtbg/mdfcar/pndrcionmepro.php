<?php

$mepro_codigo=$_REQUEST['codigo_metaproducto'];

$meta_productovi = $principal_sql->meproid($cnxn_pag, $mepro_codigo);
$data_valormp=$cnxn_pag->obtener_filas($meta_productovi);
$mpr_descripcion=$data_valormp['mpr_descripcion'];
$mpr_lineabase=$data_valormp['mpr_lineabase'];
$mpr_valorcuatrenio=$data_valormp['mpr_valorcuatrenio'];
$mpr_tendenciapositiva=$data_valormp['mpr_tendenciapositiva'];
$mpr_ponderacion=$data_valormp['mpr_ponderacion'];
$mpr_metaresultado=$data_valormp['mpr_metaresultado'];

?>
<div class="recuadro" id="frmponderacion">


	<div class="titulo" id="titulo">
		Ponderación
	</div>
  <div style="width:100%" class="mp">
     <p> <img src="img/ico/meta_producto.png"> <?php echo $mpr_descripcion; ?></p>
  </div>
  <div style="width:100%" class="bg-title">
    <strong>Linea Base: <?php echo $mpr_lineabase; ?></strong> | <strong>Valor Cuatrenio: <?php echo $mpr_valorcuatrenio; ?></strong>
  </div>

  <div class="espacio al40"></div>
	<form class="frm_ponderacionmp">
  	<button type="button" class="guardar-modal2 proceso_ponderacion"></button>

    <div class="col-md-5">
      <label>Ponderación</label>
        <input type="number" name="txt_ponderacion" id="txt_ponderacion" value="<?php echo $mpr_ponderacion; ?>">
				<input type="hidden" name="txt_proceponderacion" id="txt_proceponderacion" value="ponderacion">
				<input type="hidden" name="id_mepro" id="id_mepro" value="<?php echo $mepro_codigo; ?>">
				<input type="hidden" name="id_meresul" id="id_meresul" value="<?php echo $mpr_metaresultado; ?>">
    </div>
  </form>

</div>

<script type="text/javascript">
$(document).ready(function(){
	$(".proceso_ponderacion").click(function(){
		var modalnombre = $('.proceso_ponderacion').parents('div').attr('id');
    var modalaleatorio = $('#'+modalnombre).parents('div').data('codigoalemodal');//.attr('id');//
		//alert('ponderacion:'+ modalaleatorio);

    var txt_ponderacion=$('#txt_ponderacion').val();
		var id_mepro=$('#id_mepro').val();
		var txt_proceponderacion=$('#txt_proceponderacion').val();
		var id_meresul=$('#id_meresul').val();
    //alert(rd_jornada);
		//var id_mepro=$('input[name=rd_jornada]:checked').val()

    $.post("procesovigenciamepro",
    {
        txt_ponderacion: txt_ponderacion,
        id_mepro: id_mepro,
        txt_proceponderacion: txt_proceponderacion
    },
    function(data, status){
        //alert("Data: " + data + "\nStatus: " + status);
				$(".ponderacionmp"+id_mepro).load("infoponderacion?"+id_mepro);
				$(".totalponderacion"+id_meresul).load("sumaponderacion?"+id_meresul);

    });

		/********************* CERRAR MODAL **************************************/

				$("#sobreModal"+modalaleatorio).fadeOut(200, function(){
					$("#sobrep"+modalaleatorio).fadeOut(200, function(){
						$("#sobrep"+modalaleatorio+", #sobreModal"+modalaleatorio).remove();
					});
					$("#"+ide).attr("disabled", false);
				});
		/***************** FIN CERRAR MODAL **************************************/

	});
});


</script>
