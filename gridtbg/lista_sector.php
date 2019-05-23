<?php

$codigo_escenario=$_POST['id_escenarioadmin'];

$sector_administrativo = $principal_sql->sectorAdmin($cnxn_pag, $codigo_escenario);



?>

<select id="sel_sectoradmin" name="sel_sectoradmin" title="Seleccione un Sector Administrativo" required="" aria-required="true" class="valid" aria-invalid="false"  onchange="traer_programa();" >
    <option value="">Seleccione:</option>
    <?php
      while($list_sectoradmin=$cnxn_pag->obtener_filas($sector_administrativo)){
          $sad_codigo=$list_sectoradmin['sad_codigo'];
          $sad_nombre=$list_sectoradmin['sad_nombre'];
    ?>
        <option value="<?php echo $sad_codigo; ?>"><?php echo $sad_nombre; ?></option>
    <?php

      }

    ?>

</select>
