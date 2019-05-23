<?php

$muncodigo=$_REQUEST['codigo_municipio'];
$name_municipio=$_REQUEST['name_municipio'];
$mapa_escenariofufi = $mapa_sql->escenariofufi_mapaespe($cnxn_pag, $escenario, $muncodigo, $entidad);

$mapa_foto = $mapa_sql->fotosmapa($cnxn_pag, $escenario, $muncodigo, $sector, $codigofoto);
//echo $mapa_foto;
// listas los dato por el total inversion por escenario

$mapa_poblacionnumero = $principal_sql->municipioid($cnxn_pag, $muncodigo);
$data_poblacion=$cnxn_pag->obtener_filas($mapa_poblacionnumero);
$mun_poblacion=$data_poblacion['mun_poblacion'];


$data_numfufi=1;
while($data_escenariofufi=$cnxn_pag->obtener_filas($mapa_escenariofufi)){
    $eac_codigo[$data_numfufi]=$data_escenariofufi['eac_codigo'];
    $eac_nombre[$data_numfufi]=$data_escenariofufi['eac_nombre'];
    $total_fufi[$data_numfufi]=$data_escenariofufi['total_fifu'];


    $mapa_escenarioimpacto = $mapa_sql->escenarioimpacto_mapaespe($cnxn_pag, $data_escenariofufi['eac_codigo'], $muncodigo, $entidad);
    $data_escenarioimpacto=$cnxn_pag->obtener_filas($mapa_escenarioimpacto);
    $total_impacto[$data_numfufi]=$data_escenarioimpacto['total_impacto'];
    $data_numfufi++;

}





?>

    <div class="titulo">
      Municipio: <?php echo $name_municipio; ?>
        <div class="bloDr">
            <input type="button" class="volver-modal" value="" alt="Regresar" title="Regresar">
        </div>
    </div>
    <div class="bloqIzq" style="background-image: url(img/municipios/<?php echo $muncodigo; ?>.png);">
      <div class="destacados">
          <ul>

            <?php
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
            ?>

            </ul>
        </div>
    </div>
    <div class="bloqDer">
        <table>
          <tr>
            <th>Esenario</th>
            <th>Total Invertido</th>
            <th>Población</th>
          </tr>

          <?php


            for($dataescenario=1; $dataescenario<$data_numfufi; $dataescenario++){
                $codigo_escenario=$eac_codigo[$dataescenario];
                $nombre_escenario=$eac_nombre[$dataescenario];
                $fufi_escenario=$total_fufi[$dataescenario];
                $impacto_escenario=$total_impacto[$dataescenario];
                $codigo_escenarioim=$eac_codigoim[$dataescenario];

                if($mun_poblacion > $total_impacto[$dataescenario]){
                  $impacto_escenario=$total_impacto[$dataescenario];
                }
                else {
                  $impacto_escenario=$mun_poblacion;
                }
          ?>
              <tr>
                <td class="titul verVentana" data-escenario="<?php echo $codigo_escenario; ?>"  data-nameescenario="<?php echo $nombre_escenario; ?>"> <?php echo $nombre_escenario; ?> </td>
                <td> <img src="img/ico/inf-ejecutado.png" /> $<?php echo  number_format($fufi_escenario, 0, '.', '.'); ?> </td>
                <td> <img src="img/ico/inf-genero.png" /> <?php echo  number_format($impacto_escenario, 0, '.', '.'); ; ?> </td>
              </tr>
        <?php

            }

          ?>
        </table>
    </div>

<script type="text/javascript">

      $("#escenarios .volver-modal").click(function(){
        //alert('escenarioooo cerrarr');
        ver_destacado = 0;
        ocultarDestacado();

        $("#escenarios").animate({left: "110%"}, 400);
      });

      $(".destacados ul li span").click(function(){
        		console.log($(this).data("codestacado"));

            var codigo_foto=$(this).data("codestacado");
            var muncodigo='<?php echo $muncodigo; ?>';
            alert(codigo_foto);
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

      $("#escenarios td.verVentana").click(function(){
    		console.log($(this).data("escenario"));
        var codigo_escenario=$(this).data("escenario");
        var nameescenario=$(this).data("nameescenario");

        var muncodigo='<?php echo $muncodigo; ?>';
        var name_municipio='<?php echo $name_municipio; ?>';


    		$("#sectores").animate({left: "3%"}, 600); // COLOCAR AL CARGAR EN EL AJAX

        //alert('sectores-escenario:'+codigo_escenario);

        $.ajax({
      		url:"mapasectormunicipio",
      		type:"POST",
      		data:"codigo_municipio="+muncodigo+"&name_municipio="+name_municipio+"&codigo_escenario="+codigo_escenario+"&nameescenario="+nameescenario,
      		async:true,

      		success: function(message){
      			$("#sectores").empty().append(message);
      		}
      	});

    	});


      $("#sectores td.verVentana").click(function(){
    		$("#programas").animate({left: "3%"}, 600); // COLOCAR AL CARGAR EN EL AJAX
    	});

    	$("#sectores .volver-modal").click(function(){
    		ver_destacado = 0;
    		ocultarDestacado();

    		$("#sectores").animate({left: "110%"}, 400);
    	});




</script>
