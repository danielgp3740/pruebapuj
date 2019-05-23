<?php
$metapro_codigo=$_REQUEST['munmepro'];
?>

<select id="sel_municipio" name="sel_municipio" title="Seleccione un Municipio" required="" aria-required="true" class="valid" aria-invalid="false" >
  <option value="">Seleccione:</option>

    <?php
    $municipio=$principal_sql->municipio_reportar($cnxn_pag, $metapro_codigo);


      while($lista_municipio=$cnxn_pag->obtener_filas($municipio)){
          $mun_nombre=$lista_municipio['mun_nombre'];
          $mun_codigo=$lista_municipio['mun_codigo'];
    ?>
      <option value="<?php echo $mun_codigo; ?>"><?php echo $mun_nombre; ?></option>
    <?php

      }
    //  echo "<option> $municipio</option>";
    ?>

</select>
