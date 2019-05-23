<?php

$mepro_codigo=$_POST['codigo_metaproducto'];
$codigo_programa=$_POST['codigo_programa'];
$orientacion=$_POST['orientacion'];
$dataentidadmp=$_POST['dataentidadmp'];
//echo "Valores Vigencias";
$valor_esperadomp_modificar = $principal_sql->valor_esperadoall($cnxn_pag, $mepro_codigo);

//echo "Orientacion: ".$orientacion;

$meta_productovi = $principal_sql->meproid($cnxn_pag, $mepro_codigo);
$data_valormp=$cnxn_pag->obtener_filas($meta_productovi);
$mpr_descripcion=$data_valormp['mpr_descripcion'];
$mpr_lineabase=$data_valormp['mpr_lineabase'];
$mpr_valorcuatrenio=$data_valormp['mpr_valorcuatrenio'];
$mpr_tendenciapositiva=$data_valormp['mpr_tendenciapositiva'];
$mpr_metaresultado=$data_valormp['mpr_metaresultado'];

$metaresultado_consulta=$principal_sql->meta_resultadoid($cnxn_pag, $mpr_metaresultado);
$data_metaresultado=$cnxn_pag->obtener_filas($metaresultado_consulta);
$pro_nombre=$data_metaresultado['pro_nombre'];
$sad_nombre=$data_metaresultado['sad_nombre'];
$eac_nombre=$data_metaresultado['eac_nombre'];
$mre_descripcion=$data_metaresultado['mre_descripcion'];


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
 <form id="formulario" class='frm_vigenciamodificar' name="frm_vigenciamodificar" action="procesovigenciamepro" method="post" >
                <div class="recuadro">
                     	<div class="titulo">
                         	  Modificar valores por vigencia
                             <div class="bloDr">
                                <input type="button" value='' onclick="modificar_vigencia()" class="guardar-modal" title="Guardar">
                                <input type="button" class='cerrar-modal x-grande' value='' title="Cerrar">
                             </div>
                         </div>
                         <br>

                         <div style="width:100%" class="bg-title">
                           <strong> Escenario: <?php echo $eac_nombre; ?></strong> |
                           <strong> Sector: <?php echo $sad_nombre; ?> |
                             Programa: <strong> <?php echo $pro_nombre; ?></strong> |
                            Meta de Resultado: <strong> <?php echo $mre_descripcion; ?></strong>
                         </div>

                         <br>
                         <div class="no-padding">
                           <div style="width:100%" class="mp">
                              <p> <img src="img/ico/meta_producto.png"> <?php echo $mpr_descripcion; ?></p>
                           </div>
                           <div style="width:100%" class="bg-title">
                             <strong>Linea Base: <?php echo $mpr_lineabase; ?></strong> | <strong>Valor Cuatrenio: <?php echo $mpr_valorcuatrenio; ?></strong>
                           </div>
                           <?php
                              if($orientacion=='M'){
                            ?>
                                <div class="col-md-12">
                                 <label class="tendencia"><img src="img/ico/incremento.png"> Tendencia Positiva</label>
                                 <select class="" name="sel_tendencia" id="sel_tendencia" >
                                   <?php
                                      if ($mpr_tendenciapositiva=='1') {
                                        $tendenciaincresel="selected";
                                        $tendenciadesmisel="";
                                      }
                                      elseif ($mpr_tendenciapositiva=='2') {
                                        $tendenciaincresel="";
                                        $tendenciadesmisel="selected";
                                      }
                                   ?>
                                   <option value="0" >Seleccione...</option>
                                   <option value="1" <?php echo $tendenciaincresel; ?> >Incremento</option>
                                   <option value="2" <?php echo $tendenciadesmisel; ?> >Reducción</option>
                                 </select>
                               </div>
                            <?php
                            }
                              else{
                                echo "";
                              }

                            ?>

                        <?php
                        $numero_vig=1;
                           while($data_valoresperado=$cnxn_pag->obtener_filas($valor_esperadomp_modificar)){
                             $ves_codigo=$data_valoresperado['ves_codigo'];
                             $ves_metaproducto=$data_valoresperado['ves_metaproducto'];
                             $ves_tipovalor=$data_valoresperado['ves_tipovalor'];
                             $ves_valor=$data_valoresperado['ves_valor'];
                             $ves_vigencia=$data_valoresperado['ves_vigencia'];
                          ?>
                           <div class="col-md-3">
                            <label><?php echo $ves_vigencia; ?></label>
                            <input type="text" value="<?php echo $ves_valor; ?>" name='valor_vigencia<?php echo $numero_vig; ?>' id='valor_vigencia<?php echo $numero_vig; ?>' />
                          </div>
                            <input type="hidden" value="<?php echo $ves_codigo; ?>" name='id_vigencia<?php echo $numero_vig; ?>' id='id_vigencia<?php echo $numero_vig; ?>' />

                          <?php
                          $numero_vig++;
                            }
                          ?>
                          <!---------------------------------------------------------------------->
                          <!--------------------- INICIO DATOS SGI ------------------------------->
                          <!---------------------------------------------------------------------->
                          <div class="col-md-12">

                              <div class="col-md-5">
                                <label>Indicador SGI</label>
                                <textarea id="txt_inidicadorsgi" name="txt_inidicadorsgi" rows="8" cols="80"></textarea>
                              </div>

                              <div class="col-md-5">
                                <label>Formula SGI</label>
                                <textarea id="txt_formulasgi" name="txt_formulasgi" rows="8" cols="80"></textarea>
                              </div>
                              <!------------------------------------------------------------------->
                              <!--------------------- FIN DATOS SGI ------------------------------->
                              <!------------------------------------------------------------------->

                          </div>
                          <input type="hidden" value="<?php echo $numero_vig; ?>" name='numero_mepro' />
                          <input type="hidden" value="<?php echo $mepro_codigo; ?>" name='id_mepro' />
                          <input type="hidden" value="<?php echo $codigo_programa; ?>" name='id_programa' />
                         </div>
                </div>
</form>


<script>
  function modificar_vigencia(){
    /*
    var vigencia2016=$('#valor_vigencia1').val();
    var vigencia2017=$('#valor_vigencia2').val();
    var vigencia2018=$('#valor_vigencia3').val();
    var vigencia2019=$('#valor_vigencia4').val();
    */
    //alert("2016: "+vigencia2016+" 2017:"+vigencia2017+" 2018:"+vigencia2018+" 2019:"+vigencia2019);
    <?php
        if($dataentidadmp){
    ?>
        var data_enviar=$('.frm_vigenciamodificar').serialize();
          $.post("procesovigenciamepro",data_enviar,
              function(data_enviar, status){
                 //alert("Data: " + data + "\nStatus: " + status);

                  $("#cuerpo_tabla<?php echo $dataentidadmp; ?>").load('dataentidadppd?codigo_entidad=<?php echo $dataentidadmp; ?>');

                  $(".encimaModal").fadeOut(300, function(){
                      $(".encima").fadeOut(300);
                  });

            });

    <?php
        }
        else {
    ?>
        $(".frm_vigenciamodificar").submit();
    <?php
        }
    ?>



  }
</script>
