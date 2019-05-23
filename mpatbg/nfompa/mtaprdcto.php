<?php

    $ent_codigo=$_SESSION['entidad_persona'];



    $codigo_municipio=$_REQUEST['codigo_municipio'];

    //echo "---".$codigo_municipio."---";
    $mun_nombre="Departamento del Huila";
    $muncodigo=0;
    if ($codigo_municipio) {
        $muncodigo=$codigo_municipio;
        /*
        $municipio_array = explode('_',$codigo_municipio);
        $muncodigo=$municipio_array[1];
        */
        $municipio_mapa=$principal_sql->municipioid($cnxn_pag, $muncodigo);
        $data_municipio=$cnxn_pag->obtener_filas($municipio_mapa);
        $mun_nombre="Municipio: ".$data_municipio['mun_nombre'];
    }

    $mepromapa= $mapa_sql->mapa_mepro($cnxn_pag, $muncodigo, $mepro_codigo, $ent_codigo);
?>
<h4 style="font-weight:bold; text-align:center;">
    <!-- <img style="width: 40px" src="img/municipios/acevedo_id.png"> -->
  <?php echo $mun_nombre; ?>
</h4>
<div class="tbl-header">
    <table class="tablaFijaCss grande">
      <thead>
        <tr>
            <th width="50px">Nro.</th>
            <th>Descripción</th>
            <th width="74px">Ver más</th>
        </tr>
      </thead>
    </table>
</div>
<div class="tbl-content">

    <table id="ordenar" class="tablaFijaCss grande">
      <?php
          $numero_registro=1;
          while($data_mepro=$cnxn_pag->obtener_filas($mepromapa)){

              $mpr_codigo=$data_mepro['mpr_codigo'];
              $mpr_descripcion=$data_mepro['mpr_descripcion'];
              $mpr_lineabase=$data_mepro['mpr_lineabase'];
              $mpr_valorcuatrenio=$data_mepro['mpr_valorcuatrenio'];

      ?>
          <tr>
              <td class="text-center" width="50px"><strong><?php echo $numero_registro;  ?></strong></td>
              <td class="text-left"><p><?php echo $mpr_descripcion; ?></p></td>
              <td width="70px"><a href="javascript:void(0)" class="new-btn infMpio" data-codmpio="<?php echo $muncodigo; ?>" data-meproid="<?php echo $mpr_codigo;  ?>" title="Ver más info"><img src="img/ico/info.png" /></a></td>
          </tr>

      <?php
            $numero_registro++;
          }

      ?>
      <!--
        <tr>
            <td class="text-left" width="50px">001</td>
            <td class="text-left"><p>a. Vestibulum quam nisi, pretium a nibh sit amet, consectetur hendrerit mi. Aenean imperdiet lacus sit amet elit porta, et malesuada erat bibendum.</p></td>
            <td width="70px"><a href="javascript:void(0)" class="new-btn infMpio" data-codmpio="1" title="Ver más info"><img src="img/ico/info.png" /></a></td>
        </tr>
        <tr>
            <td class="text-left">002</td>
            <td class="text-left"><p>b. Vestibulum quam nisi, pretium a nibh sit amet, consectetur hendrerit mi. Aenean imperdiet lacus sit amet elit porta, et malesuada erat bibendum.</p></td>
            <td><a href="javascript:void(0)" class="new-btn infMpio" data-codmpio="1" title="Ver más info"><img src="img/ico/info.png" /></a></td>
        </tr>
        <tr>
            <td class="text-left">003</td>
            <td class="text-left"><p>c. Vestibulum quam nisi, pretium a nibh sit amet, consectetur hendrerit mi. Aenean imperdiet lacus sit amet elit porta, et malesuada erat bibendum.</p></td>
            <td><a href="javascript:void(0)" class="new-btn" title="Ver más info"><img src="img/ico/info.png" /></a></td>
        </tr>
      -->
    </table>
</div>
<script type="text/javascript">
    $(".infMpio").click(function(){
      var codigo_metaproducto = $(this).data("meproid");
      var codigo_municipio = $(this).data("codmpio");
      //alert("Municipio:"+codigo_municipio+"-Mepro: "+codigo_metaproducto);
			armarModal($(this).attr("id"),0,true,"","infomapamunicipio","codigo_metaproducto="+codigo_metaproducto+"&codigo_municipio="+codigo_municipio);
		});

</script>
