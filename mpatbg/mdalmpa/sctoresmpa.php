<?php

$codigo_municipio=$_REQUEST['codigo_municipio'];
$name_municipio=$_REQUEST['name_municipio'];
$codigo_escenario=$_REQUEST['codigo_escenario'];
$nameescenario=$_REQUEST['nameescenario'];


$mapa_sectorfufi = $mapa_sql->sectorfufi_mapaespe($cnxn_pag, $codigo_escenario, $codigo_municipio, $entidad);
$mapa_sectorimpacto = $mapa_sql->sectorimpacto_mapaespe($cnxn_pag, $codigo_escenario, $codigo_municipio, $entidad);
//echo $mapa_sectorimpacto;
// listas los dato por el total inversion por escenario
if($codigo_municipio==0){
  $codigo_municipiosect=1;
}
else {
 $codigo_municipiosect=$_REQUEST['codigo_municipio'];
}
$mapa_poblacionnumero = $principal_sql->municipioid($cnxn_pag, $codigo_municipiosect);
$data_poblacion=$cnxn_pag->obtener_filas($mapa_poblacionnumero);
$mun_poblacion=$data_poblacion['mun_poblacion'];

$data_numfufi=1;
while($data_sectorfufi=$cnxn_pag->obtener_filas($mapa_sectorfufi)){
    $sad_codigo[$data_numfufi]=$data_sectorfufi['sad_codigo'];
    $sad_nombre[$data_numfufi]=$data_sectorfufi['sad_nombre'];
    $total_fufi[$data_numfufi]=$data_sectorfufi['total_fifu'];

    $mapa_sectorimpacto = $mapa_sql->sectorimpacto_mapaespe($cnxn_pag, $codigo_escenario, $codigo_municipio, $data_sectorfufi['sad_codigo']);
    $data_sectorimpacto=$cnxn_pag->obtener_filas($mapa_sectorimpacto);
    $total_impacto[$data_numfufi]=$data_sectorimpacto['total_impacto'];


    $data_numfufi++;

}
/*
$data_numimpacto=1;
while($data_sectorimpacto=$cnxn_pag->obtener_filas($mapa_sectorimpacto)){


    if(!$data_sectorimpacto['total_impacto']){
      $total_impacto[$data_numimpacto]=0;
    }
    else{
      $total_impacto[$data_numimpacto]=$data_sectorimpacto['total_impacto'];
    }

    $data_numimpacto++;

}
*/


?>

<div class="titulo">
  Municipio: <?php echo $name_municipio ?> / Escenario: <?php echo $nameescenario ?>
    <div class="bloDr">
        <input type="button" class="volver-modal" value="" alt="Regresar" title="Regresar">
    </div>
</div>
<div class="bloqIzq" style="background-image: url(img/municipios/<?php echo $codigo_municipiosect ?>.png);">
  <div class="destacados">
  <div class="destacados">
      <ul>



        <?php
        if($codigo_municipio==0){
              $mapa_foto = $mapa_sql->fotosmapa($cnxn_pag, $escenario, $codigo_municipiosect, $sector, $codigofoto);
                  while($data_fotos=$cnxn_pag->obtener_filas($mapa_foto)){
                      $mfo_codigo=$data_fotos['mfo_codigo'];
                      $mfo_mepro=$data_fotos['mfo_mepro'];
                      $mfo_url=$data_fotos['mfo_url'];
                      $pfo_municipio=$data_fotos['pfo_municipio'];
                      $pfo_descripcion=$data_fotos['pfo_descripcion'];


              ?>

              <li>
                <div class="tooltip" data-codigometaproducto="<?php echo $mfo_mepro; ?>">
                <span data-codestacado="<?php echo $mfo_codigo; ?>"><img src="<?php echo $enlace."img/fotos/".$mfo_url; ?>"></span>

                        <span class="tooltiptext toolmp">
                          <?php echo $pfo_descripcion;  ?>
                        </span>
               </div>
              </li>

              <?php
                }
              }
              else {
                echo "";
              }
              ?>
        <!--
          <li><span data-codestacado="1"></span></li>
          <li><span data-codestacado="1"></span></li>
          <li><span data-codestacado="1"></span></li>
          <li><span data-codestacado="1"></span></li>
        -->
        </ul>
    </div>
    </div>
</div>
<div class="bloqDer">
    <table>

      <tr>
        <th>Sector</th>
        <th>Total Invertido</th>
        <th>Población</th>
      </tr>
      <?php


        for($datasector=1; $datasector<$data_numfufi; $datasector++){
            $codigo_sector=$sad_codigo[$datasector];
            $nombre_sector=$sad_nombre[$datasector];
            $fufi_sector=$total_fufi[$datasector];
            $impacto_sector=$total_impacto[$datasector];

            if($mun_poblacion > $total_impacto[$datasector]){
              $impacto_sector=$total_impacto[$datasector];
            }
            else {
              $impacto_sector=$mun_poblacion;
            }
      ?>
          <tr>
            <td class="titul verVentana_" data-escenario="<?php echo $codigo_sector; ?>"  data-nameescenario="<?php echo $nombre_escenario; ?>"> <?php echo $nombre_sector; ?> </td>
            <td> <img src="img/ico/inf-ejecutado.png" /> $<?php echo  number_format($fufi_sector, 0, '.', '.'); ?> </td>
            <td> <img src="img/ico/inf-genero.png" /> <?php echo  number_format($impacto_sector, 0, '.', '.'); ; ?> </td>
          </tr>
    <?php

        }

      ?>


    </table>
</div>
<script type="text/javascript">

      $("#sectores .volver-modal").click(function(){
        ver_destacado = 0;
        ocultarDestacado();

        $("#sectores").animate({left: "110%"}, 400);
      });


      $("#sectores td.verVentana").click(function(){

    		$("#programas").animate({left: "3%"}, 600); // COLOCAR AL CARGAR EN EL AJAX

        var codigo_escenario=$(this).data("escenario");
        var nameescenario=$(this).data("nameescenario");

        var muncodigo='<?php echo $muncodigo; ?>';
        var name_municipio='<?php echo $name_municipio; ?>';
        alert('prrrr');

        $.ajax({
      		url:"mapaprogramamunicipio",
      		type:"POST",
      		data:"codigo_municipio="+muncodigo+"&name_municipio="+name_municipio+"&codigo_escenario="+codigo_escenario+"&nameescenario="+nameescenario,
      		async:true,

      		success: function(message){
      			$("#programas").empty().append(message);
      		}
      	});
    	});


      $(".destacados ul li span").click(function(){
        console.log($(this).data("codestacado"));

        var codigo_foto=$(this).data("codestacado");
        var muncodigo='1';

        $.ajax({
          url:"mapafoto",
          type:"POST",
          data:"codigo_municipio="+muncodigo+"&codigo_foto="+codigo_foto,
          async:true,

          success: function(message){
            $("#verDestacado").empty().append(message);
          }
        });

        ver_destacado = 1;
        ocultarDestacado(); // COLOCAR AL CARGAR EN EL AJAX
      });


</script>
