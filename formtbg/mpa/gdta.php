<?php


$entidad=$principal_sql->entidad($cnxn_pag,$persona_entidad);
$metas_producto_entidad = $principal_sql->metaproducto_entidad($cnxn_pag, $persona_entidad);


?>

<script type='text/javascript' src="js/titulo_fijo.js"></script>

<script type="text/javascript">
$(document).ready(function(){
      $(".cerrar-modal").click(function() {
        $(".encimaModal").fadeOut(300, function(){
          $(".encima").fadeOut(300);
        });
      });

      $('.selMepro').selectpicker();
      $('.selEntidad').selectpicker();
});





</script>


<form id="formulario" class='frm_georeferencia' name="frm_georeferencia" action="prcs_georeferencia" method="post" >
    <div class="recuadro_list">
      <div id="titulo" class="titulo">
           Georreferenciación
             <div class="bloDr">
                 <input type="button" onclick="modificar_valorejecutado();" value='' class="guardar-modal" alt="Guardar" title="Guardar">
				         <input type="button" class='cerrar-modal' value='' alt="Cerrar" title="Cerrar">
             </div>
      </div>
      <div class="espacio al80"></div>


       <div class="col-md-12">
             <p> &nbsp;</p>
       </div>


         <label>Entidad</label>


           <select id="sel_entidad" name="sel_entidad" class="selEntidad" title="Seleccione un Entidad"  data-live-search="true" onchange="traer_programaentidad();">
               <option value="">Seleccione:</option>
               <?php
                 while($list_entidad=$cnxn_pag->obtener_filas($entidad)){
                     $ent_codigo=$list_entidad['ent_codigo'];
                     $ent_nombre=$list_entidad['ent_nombre'];
               ?>
                   <option value="<?php echo $ent_codigo; ?>"><?php echo $ent_nombre; ?></option>
               <?php
                 }
               ?>
           </select>








       <div class="col-md-12">
             <p> &nbsp;</p>
       </div>


                  <label>Meta de Producto</label>


                 <select class="selMepro" data-live-search="true">
                   <option value="">Seleccione:</option>
                   <?php
                       while($data_metaproductoxentidad=$cnxn_pag->obtener_filas($metas_producto_entidad)){
                           $mpr_codigo=$data_metaproductoxentidad['mpr_codigo'];
                           $mpr_descripcion=$data_metaproductoxentidad['mpr_descripcion'];
                           $mpr_lineabase=$data_metaproductoxentidad['mpr_lineabase'];
                           $mpr_valorcuatrenio=$data_metaproductoxentidad['mpr_valorcuatrenio'];

                           $migamepro = $principal_sql->miga_mepro($cnxn_pag, $mpr_codigo);
                           $data_migamepro=$cnxn_pag->obtener_filas($migamepro);

                           $eac_nombre=$data_migamepro['eac_nombre'];
                           $sad_nombre=$data_migamepro['sad_nombre'];
                           $pro_nombre=$data_migamepro['pro_nombre'];
                           $mre_descripcion=$data_migamepro['mre_descripcion'];

                   ?>

                     <option  data-tokens="$mpr_descripcion" value="<?php echo $mpr_codigo; ?>"><?php echo $mpr_descripcion; ?></option>
                   <?php

                         }

                   ?>
                   <!--
                  <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
                   <option data-tokens="mustard">Burger, Shake and a Smile</option>
                   <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                 -->
                 </select>


    </div>

</form>
