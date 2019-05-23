<?php

$entidad_personamp=$_REQUEST['codigo_entidad'];

  $meta_productoentidad=$principal_sql->metaproducto_entidad($cnxn_pag, $entidad_personamp);


?>


<div class="tbl-header">
   <table id="ordenar" class="tablaFijaCss">
       <thead>
       <tr>
           <th width="3%">&nbsp;&nbsp;No.</th>
           <th width="15%">Programa </th>
           <th width="25%">Metas de Producto </th>
           <!-- <th>P</th> -->
           <th>LB</th>
           <th>MC</th>
           <th>TP</th>
           <th>V 2016 </th>
           <th>V 2017 </th>
           <th>V 2018 </th>
           <th>V 2019 </th>
           <th>O</th>
           <th width="6.7%">&nbsp;</th>
       </tr>
       </thead>
  </table>
</div>


<table class="tablaFijaCss">


       <?php
       //Lista Meta de Procuto
       $numeroregistro=1;
        while($data_metaproducto=$cnxn_pag->obtener_filas($meta_productoentidad)){

            $mpr_codigo=$data_metaproducto['mpr_codigo'];
            $mpr_descripcion=$data_metaproducto['mpr_descripcion'];
            $mpr_lineabase=$data_metaproducto['mpr_lineabase'];
            $mpr_valorcuatrenio=$data_metaproducto['mpr_valorcuatrenio'];
            $mpr_codificacion=$data_metaproducto['mpr_codificacion'];
            $mpr_indicador=$data_metaproducto['mpr_indicador'];
            $mpr_entidadresponsable=$data_metaproducto['mpr_entidadresponsable'];
            $mpr_personaresponsable=$data_metaproducto['mpr_personaresponsable'];
            $mpr_sectornn=$data_metaproducto['mpr_sectornn'];
            $mpr_odsproducto=$data_metaproducto['mpr_odsproducto'];
            $mpr_ponderacion=$data_metaproducto['mpr_ponderacion'];
            $mpr_tendenciapositiva=$data_metaproducto['mpr_tendenciapositiva'];
            $pro_codigo=$data_metaproducto['pro_codigo'];
            $pro_nombre=$data_metaproducto['pro_nombre'];

            // INICIO MOSTAR TODOS LOS VALORES DE LA VIGENCIAS POR META DE PRODUCTO

            $valor_allesperadomp = $principal_sql->valor_esperadoall($cnxn_pag, $mpr_codigo);


            $todas_vigencias="";

              while($data_allvaloresperadomp=$cnxn_pag->obtener_filas($valor_allesperadomp)){
                  $ves_vigencia=$data_allvaloresperadomp['ves_vigencia'];
                  $ves_valorall[$ves_vigencia]=$data_allvaloresperadomp['ves_valor'];
                  $todas_vigencias.=$ves_valorall[$ves_vigencia]." ";

              }

            // FIN MOSTAR TODOS LOS VALORES DE LA VIGENCIAS POR META DE PRODUCTO

            $total_ponderacion=$total_ponderacion+$mpr_ponderacion;

            if($mpr_tendenciapositiva=='1'){
              $tendenciap='Incremento';
            }
            elseif($mpr_tendenciapositiva=='2') {
              $tendenciap='Reducción';
            }
            else {
              $tendenciap='';
            }

            if($mpr_ponderacion==''){
              $mpr_ponderacion=0;
            }
            else{
              $mpr_ponderacion=$data_metaproducto['mpr_ponderacion'];
            }

/*
            if($mpr_lineabase > $mpr_valorcuatrenio){
              $imgtipo="diminuye.png";
              $tipometa='Reducción';
              $orientacion='R';
            }
            elseif($mpr_lineabase==$mpr_valorcuatrenio){
              $imgtipo="mantiene.png";
              $tipometa='Mantiene';
              $orientacion='M';
            }
            else{
              $imgtipo="incremento.png";
              $tipometa='Aumenta';
              $orientacion='A';
            }

*/

            $valor_esperadomp = $principal_sql->valor_esperadoall($cnxn_pag, $mpr_codigo);





        ?>

        <tr>
          <td width="3%" class="text-left"><?php echo $numeroregistro; ?></td>
          <td width="15.1%" style=" text-align: left"><?php echo $pro_nombre; ?></td>
          <td width="25.1%" style=" text-align: left"><?php echo $mpr_descripcion; ?></td>
          <!--
          <td class="text-center">
                <div class="tooltip ponderacionmp<?php echo $mpr_codigo; ?> ponderacionmepro" data-codigometaproducto='<?php echo $mpr_codigo; ?>'>
                    <a href="javascript:void(0);" class="edit" title="">
                        <?php //echo $mpr_ponderacion; ?>
                    </a>
                    <span class="tooltiptext">
                          <img src="img/ico/editar-v.png" />
                    </span>
                </div>

          </td>
          -->
          <td style='text-align:center; background:<?php echo $color_rojo; ?>'><?php echo $mpr_lineabase; ?></td>
          <td style='text-align:center; background:<?php echo $color_rojo; ?>'><?php echo $mpr_valorcuatrenio; ?></td>

          <td cstyle='text-align:center;'><?php echo $tendenciap;  ?></td>
          <?php
            $numerorvigencia=1;
            while($data_valoresperado=$cnxn_pag->obtener_filas($valor_esperadomp)){
              $ves_codigo=$data_valoresperado['ves_codigo'];
              $ves_metaproducto=$data_valoresperado['ves_metaproducto'];
              $ves_tipovalor=$data_valoresperado['ves_tipovalor'];
              $ves_valor=$data_valoresperado['ves_valor'];
              $ves_vigencia=$data_valoresperado['ves_vigencia'];

              $acumulado_ejecutadomp = $principal_sql->valor_ejecutadovigenciamp($cnxn_pag, $mpr_codigo, $ves_vigencia);


              $datavalor_ejecutadomp= $cnxn_pag->obtener_filas($acumulado_ejecutadomp);
              $valorejecutadomp=$datavalor_ejecutadomp['total_vigenciamp'];
              $valorporvigencia[$ves_vigencia]=$ves_valor;
              $valorvigenciaesperado[$numerorvigencia]=$ves_valor;
              $numerorvigencia++;

          ?>
              <td><?php echo $ves_valor; ?> | <?php echo $valorejecutadomp; ?></td>
          <?php

            }

            $diferencia_valores=abs($mpr_lineabase-$mpr_valorcuatrenio);

            $vigencia_sumatoria=$valorporvigencia[2016]+$valorporvigencia[2017]+$valorporvigencia[2018]+$valorporvigencia[2019];

            // *************** INICIO TIPO DE ORIENTACION ********************* //
            // 1. MANTENIMIENTO
            if($mpr_lineabase==$mpr_valorcuatrenio && $mpr_valorcuatrenio==$valorvigenciaesperado[4]){
                $imgtipo="mantiene.png";
                $tipometa='Mantiene';
                $orientacion='M';
            }
            elseif($mpr_valorcuatrenio==$valorvigenciaesperado[1] && $mpr_valorcuatrenio==$valorvigenciaesperado[2] && $mpr_valorcuatrenio==$valorvigenciaesperado[3] && $mpr_valorcuatrenio == $valorvigenciaesperado[4]){
                $imgtipo="mantiene.png";
                $tipometa='Mantiene';
                $orientacion='M';
            }
            elseif ($mpr_lineabase==$mpr_valorcuatrenio && $mpr_valorcuatrenio==$vigencia_sumatoria) {
                $imgtipo="mantiene.png";
                $tipometa='Mantiene';
                $orientacion='M';
            }
            // 2. INCREMENTO
            elseif($mpr_lineabase < $mpr_valorcuatrenio ){
                if($mpr_valorcuatrenio!=$valorvigenciaesperado[1] && $mpr_valorcuatrenio!=$valorvigenciaesperado[2] && $mpr_valorcuatrenio!=$valorvigenciaesperado[3] && $mpr_valorcuatrenio!=$valorvigenciaesperado[4]){
                  $imgtipo="incremento.png";
                  $tipometa='Aumenta';
                  $orientacion='A';
                }
                elseif($mpr_valorcuatrenio==$valorvigenciaesperado[4]){
                  $imgtipo="incremento.png";
                  $tipometa='Aumenta';
                  $orientacion='A';
                }
                elseif($mpr_valorcuatrenio==$vigencia_sumatoria){
                  $imgtipo="incremento.png";
                  $tipometa='Aumenta';
                  $orientacion='A';
                }
                elseif($diferencia_valores==$vigencia_sumatoria){
                  $imgtipo="incremento.png";
                  $tipometa='Aumenta';
                  $orientacion='A';
                }
                elseif($diferencia_valores==$valorvigenciaesperado[4]){
                  $imgtipo="incremento.png";
                  $tipometa='Aumenta';
                  $orientacion='A';
                }
                else{
                  $imgtipo="incremento.png";
                  $tipometa='Aumenta';
                  $orientacion='A';
                }
            }
            // 3. REDUCCION
            elseif($mpr_lineabase > $mpr_valorcuatrenio ){
                if($mpr_valorcuatrenio!=$valorvigenciaesperado[1] && $mpr_valorcuatrenio!=$valorvigenciaesperado[2] && $mpr_valorcuatrenio!=$valorvigenciaesperado[3] && $mpr_valorcuatrenio!=$valorvigenciaesperado[4]){
                  $imgtipo="diminuye.png";
                  $tipometa='Reducción';
                  $orientacion='R';
                }
                elseif($mpr_valorcuatrenio==$valorvigenciaesperado[4]){
                  $imgtipo="diminuye.png";
                  $tipometa='Reducción';
                  $orientacion='R';
                }
                elseif($mpr_valorcuatrenio==$vigencia_sumatoria){
                  $imgtipo="diminuye.png";
                  $tipometa='Reducción';
                  $orientacion='R';
                }
                elseif($diferencia_valores==$vigencia_sumatoria){
                  $imgtipo="diminuye.png";
                  $tipometa='Reducción';
                  $orientacion='R';
                }
                elseif($diferencia_valores==$valorvigenciaesperado[4]){
                  $imgtipo="diminuye.png";
                  $tipometa='Reducción';
                  $orientacion='R';
                }
            }

              // *************** INICIO TIPO DE ORIENTACION ********************* //


          ?>
          <td cstyle='text-align:center;'><img src="img/ico/<?php echo $imgtipo; ?>" /></td>
          <td width="6.7%">
            <!--  <input type='button' class='valor_vigencias' data-codigometaproducto='<?php echo $mpr_codigo; ?>' onClick='modal_vigencia("<?php echo $mpr_codigo; ?>","<?php echo $codigo_programa; ?>");' />
              <input type='button' class='valor_vigencias' data-codigometaproducto='<?php echo $mpr_codigo; ?>' /> -->
            <div class="tooltip" data-codigometaproducto='<?php echo $mpr_codigo; ?>'>
               <a class="edit new-btn" title="" href="Javascript:valor_vigencia('<?php echo $mpr_codigo; ?>','<?php echo $pro_codigo; ?>','<?php echo $orientacion; ?>');" class="new-btn" ><img src="img/ico/editar.png" /></a>
               <span class="tooltiptext nw">Editar</span>
               </div>

          </td>
        </tr>

        <?php
        $numeroregistro++;

        }
        // fin lista de meta de producto
        //$total_ponderacion=100;
          if($total_ponderacion!=100){
            $color_ponderacion=" style='color:red;' ";
          }
          else {
            $color_ponderacion="";
          }
        ?>
        <tr>
          <td>&nbsp;</td>
          <td style=" text-align: right"><strong>  </strong></td>
          <td class="totalponderacion<?php echo $mre_codigo; ?>">
            <span <?php echo $color_ponderacion; ?>><strong><?php //echo $total_ponderacion; ?></strong></span>
          </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>

        </tr>


   </table>

    </div>




    <script type="text/javascript">
          $(document).ready(function(){
                $(".cerrar-modal").click(function() {
                  $(".encimaModal").fadeOut(300, function(){
                    $(".encima").fadeOut(300);
                  });
                });
          });

        function valor_vigencia(codigo_metaproducto, codigo_programa, orientacion){

              var codigo_metaproducto = codigo_metaproducto;
              var codigo_programa = codigo_programa;
              var orientacion = orientacion;
              //var codigo_valorejecutado = $(this).data("codigovalorejecutado");
              //alert(codigo_metaproducto + ' :: ' + codigo_metaproducto);
              //alert('modal entra');
              $.ajax({
                url:"vigenciavalor",
                type:"POST",
                data:"codigo_metaproducto="+codigo_metaproducto+"&codigo_programa="+codigo_programa+"&orientacion="+orientacion+"&dataentidadmp=<?php echo $entidad_personamp; ?>",
                async:true,

                success: function(message){
                  $("#modalContenido").empty().append(message);
                  //$("#modalContenido").html("<h2>El M/pio seleccionado es: " + code + "</h2>");

                  $(".encima").fadeIn(300, function(){
                    $(".encimaModal").fadeIn(300);
                  });
                }
              });


          }
    </script>
