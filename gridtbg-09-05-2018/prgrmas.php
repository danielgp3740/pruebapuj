<?php

/********************************************************
**  LISTA DE PROGRAMAS ADMINISTRATIVOS                 **
**  AndresMC - 01 nov 2016                              **
*********************************************************/

    $codigo_sectoradmin=$_POST['codigo_sectroAdmin'];
    $nombre_sectAdmin=$_POST['nombre_sectAdmin'];
    $nombre_escenario=$_POST['nombre_escenario'];

    $programa_administrativo = $principal_sql->programas($cnxn_pag, $codigo_sectoradmin);
//echo $programa_administrativo;
?>

 <script type='text/javascript' src="js/titulo_fijo.js"></script>

<script type="text/javascript">
$(document).ready(function(){
      $(".cerrar-modal").click(function() {
        $(".encimaModal").fadeOut(300, function(){
          $(".encima").fadeOut(300);
        });
      });
});

</script>

<div class="titulo">

    <!----> Escenario <?php echo $nombre_escenario; ?> / Sector Administrativo <?php echo $nombre_sectAdmin; ?>

    <div class="bloDr">
         <a href="#"><img src="img/ico/new.png" alt="Agregar" title="Agregar" /></a>
         <a href="#"><img src="img/ico/editar.png" alt="Editar" title="Editar" /></a>&nbsp;

          <input type="submit" value='' class="guardar-modal" title="Guardar">
          <input type="button" class='cerrar-modal' data-dismiss="modal" value='' title="Cerrar">
    </div>

  </div>
  <table id="ordenar" class="grande">
    <tr>
        <th>&nbsp;&nbsp;Nro.</th>
        <th>Programa</th>
        <th class="nosort">Metas de resultado</th>
        <?php
          $numero_programaadmin=1;
          while($data_programas=$cnxn_pag->obtener_filas($programa_administrativo)){

            $pro_codigo=$data_programas['pro_codigo'];
            $pro_nombre=$data_programas['pro_nombre'];
            $pro_descripcion=$data_programas['pro_descripcion'];
            $pro_objetivo=$data_programas['pro_objetivo'];
            //$sad_nombre=$data_programas['sad_nombre'];

          ?>

          <tr>
              <td class="text-left"><?php echo $numero_programaadmin; ?></td>
              <td class="text-left">
                <a href="Javascript:irmetaresultado('<?php echo $pro_codigo; ?>','<?php echo $pro_nombre; ?>');" title="Meta de Resultado"  id="myBtn_<?php echo  $sad_codigo; ?>">
                <p><?php echo $pro_nombre; ?></p>
              </a>
              </td>
              <td>
                  <a href="Javascript:irmetaresultado('<?php echo $pro_codigo; ?>','<?php echo $pro_nombre; ?>');" title="Meta de Resultado"  id="myBtn_<?php echo  $sad_codigo; ?>"><img src="img/ico/meta_resultado.png" /></a>
              </td>

          </tr>

          <?php
            $numero_programaadmin++;
          }

         ?>
  </table>
  <script type="text/javascript">
    function irmetaresultado(programa_codigo, programa_nombre){
      var programa_codigo=programa_codigo;
      var programa_nombre=programa_nombre;

            window.location.replace('metaresultado?'+programa_codigo);

    }
  </script>
