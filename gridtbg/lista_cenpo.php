<?php

$codigo_municipio=$_POST['id_municipio'];

$centro_poblado = $principal_sql->centro_poblado($cnxn_pag, $codigo_municipio);

?>

<select id="sel_cenpro" name="sel_cenpro" title="Seleccione un Centro Poblado" required="" aria-required="true" class="valid" aria-invalid="false" >
    <option value="">Seleccione:</option>
    <?php
      while($list_cenpo=$cnxn_pag->obtener_filas($centro_poblado)){
          $cpo_codigo=$list_cenpo['cpo_codigo'];
          $cpo_nombre=$list_cenpo['cpo_nombre'];
    ?>
        <option value="<?php echo $cpo_codigo; ?>"><?php echo $cpo_nombre; ?></option>
    <?php

      }

    ?>

</select>
