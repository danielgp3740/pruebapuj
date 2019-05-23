<?php
  $codigo_mepro = $_REQUEST['codigo_metaproducto'];
  //echo $codigo_mepro;
  //$obtener_fotos = $principal_sql->obtener_fotos($cnxn_pag, $codigo_mepro);
  $obtener_municipio_vigencia2017 = $principal_sql->municipio_vigencia2017($cnxn_pag, $codigo_mepro);
  $obtener_municipio_vigencia2018 = $principal_sql->municipio_vigencia2018($cnxn_pag, $codigo_mepro);
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

  <div class="recuadro">
      <div id="titulo" class="titulo">
          Fotos
          <div class="bloDr">
              <input type="button" class='cerrar-modal x-mediano' value='' alt="Cerrar" title="Cerrar">
          </div>
      </div>
         <div class="espacio al60"></div>
         <div class="col-md-6">
           <?php
             if(pg_num_rows($obtener_municipio_vigencia2018) != 0){
               echo "<h3>Vigencia 2018:</h3>";

               while($list_municipio_vigencia2018=$cnxn_pag->obtener_filas($obtener_municipio_vigencia2018)){
                 $muni_codigo = $list_municipio_vigencia2018['pfo_municipio'];
                 $mun_nombre = $list_municipio_vigencia2018['mun_nombre'];
                 echo "<label>".$mun_nombre."</label>";
                 $obtener_municipiofoto2018 = $principal_sql->municipio_foto2018($cnxn_pag, $codigo_mepro, $muni_codigo);
                 while($list_municipiofoto2018=$cnxn_pag->obtener_filas($obtener_municipiofoto2018)){
                   $foto_url = $list_municipiofoto2018['mfo_url'];
                   $foto_descripcion = $list_municipiofoto2018['pfo_descripcion'];
                   //echo "URL: ".$foto_url."// DESC: ".$foto_descripcion."<br>";
                   echo '<img src="img/fotos/'.$foto_url.'" title = "'.$foto_descripcion.'" />';
                 }
               }
             }
             else{
               echo "<h3>No hay fotos de vigencia 2018</h3>";
             }


             if(pg_num_rows($obtener_municipio_vigencia2017) != 0){
               echo "<h3>Vigencia 2017:</h3>";

               while($list_municipio_vigencia2017=$cnxn_pag->obtener_filas($obtener_municipio_vigencia2017)){
                 $muni_codigo = $list_municipio_vigencia2017['pfo_municipio'];
                 $mun_nombre = $list_municipio_vigencia2017['mun_nombre'];
                 echo "<label>".$mun_nombre."</label>";
                 $obtener_municipiofoto2017 = $principal_sql->municipio_foto2017($cnxn_pag, $codigo_mepro, $muni_codigo);
                 while($list_municipiofoto2017=$cnxn_pag->obtener_filas($obtener_municipiofoto2017)){
                   $foto_url = $list_municipiofoto2017['mfo_url'];
                   $foto_descripcion = $list_municipiofoto2017['pfo_descripcion'];
                   //echo "URL: ".$foto_url."// DESC: ".$foto_descripcion."<br>";
                   echo '<img src="img/fotos/'.$foto_url.'" title = "'.$foto_descripcion.'" />';
                 }
               }
             }
             else{
               echo "<h3>No hay fotos de vigencia 2017</h3>";
             }
           ?>
         </div>

        <input type="hidden" name="txt_codigofechareporte" id="txt_codigofechareporte" value="<?php echo $codigo_fechareporte; ?>" />
  </div>
