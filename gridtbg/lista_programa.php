<?php

if($_POST['id_sectoradmin']){
  $codigo_sector=$_POST['id_sectoradmin'];
  $programa = $principal_sql->programas($cnxn_pag, $codigo_sector);
}
elseif($_POST['id_entidad']){

  $codigo_entidad=$_POST['id_entidad'];
  $programa = $principal_sql->programa_ejecucion($cnxn_pag, $codigo_entidad);

}





?>

      <select id="sel_programa" name="sel_programa" title="Seleccione un Programa" required="" aria-required="true" class="valid" aria-invalid="false" onchange="traer_meru();">
          <option value="">Seleccione:</option>
          <?php
            while($list_programa=$cnxn_pag->obtener_filas($programa)){
                $pro_codigo=$list_programa['pro_codigo'];
                $pro_nombre=$list_programa['pro_nombre'];
          ?>
              <option value="<?php echo $pro_codigo; ?>"><?php echo $pro_nombre; ?></option>
          <?php

            }

          ?>

      </select>
