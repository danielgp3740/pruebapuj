<?php

$codigo_programa=$_POST['id_programa'];

$meta_resultado = $principal_sql->meta_resultado($cnxn_pag, $codigo_programa);

$programas_dato = $principal_sql->programa_bid($cnxn_pag, $codigo_programa);

$list_escsec = $cnxn_pag->obtener_filas($programas_dato);
$sad_codigo=$list_escsec['sad_codigo'];
$sad_nombre=$list_escsec['sad_nombre'];
$eac_codigo=$list_escsec['eac_codigo'];
$eac_nombre=$list_escsec['eac_nombre'];

?>
<!--**************Inicio Escenario administrativo***************-->
  <div class="col-md-4">
    <label>Escenario Administrativo</label>
      <div class="combo">
      <select id="sel_escenario" name="sel_escenario" title="Seleccione un Sector Administrativo" required="" aria-required="true" class="valid" aria-invalid="false" onchange="traer_sector();">
          <!--<option value="">Seleccione:</option>-->
          <option value="<?php echo $eac_codigo; ?>"><?php echo $eac_nombre; ?></option>
      </select>
      </div>
  </div>
  <!--**************Fin Escenario administrativo***************-->

  <!--************Inicio Sector Admin***************-->
  <div class="col-md-4">
      <label>Sector Administrativo</label>
      <div class="combo" id='idsector_admin'>
      <select id="sel_sectoradmin" name="sel_sectoradmin" title="Seleccione un Sector Administrativo" required="" aria-required="true" class="valid" aria-invalid="false" onchange="traer_sector();">
          <!--<option value="">Seleccione:</option>-->
          <option value="<?php echo $sad_codigo; ?>"><?php echo $sad_nombre; ?></option>
      </select>
      </div>
  </div>
  <!--************Fin Sector Admin***************-->

  <div class="col-md-6">
    <label>Meta de Resultado</label>
    <div class="combo" id="idlist_meru">
      <select id="sel_meru" name="sel_meru" title="Seleccione una Meta Resultado" required="" aria-required="true" class="valid" aria-invalid="false" onchange='traer_mepro();' >
          <option value="">Seleccione:</option>
          <?php
            while($list_meru=$cnxn_pag->obtener_filas($meta_resultado)){
                $mre_codigo=$list_meru['mre_codigo'];
                $mre_nombre=$list_meru['mre_descripcion'];
          ?>
              <option value="<?php echo $mre_codigo; ?>"><?php echo $mre_nombre; ?></option>
          <?php

            }

          ?>

      </select>
    </div>
  </div>
