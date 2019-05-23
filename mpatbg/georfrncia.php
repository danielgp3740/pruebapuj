<?php

$municipios = $principal_sql->municipioid($cnxn_pag, $muni_codigo);

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
<!--<![endif]-->

<head>
  <!-- HEAD -->
  <?php include('prncpal/hdtbg.php'); ?>


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
<script type="text/javascript">

    function altura_encimaModal(){
      var alto_encimaModal = $(".encimaModal").height();
      var ancho_encimaModal = $(".encimaModal").width()-20;
      //alert(alto_encimaModal + ' ::: ' + ancho_encimaModal);
      $("#modalContenido").css({ 'height': alto_encimaModal+'px' });
      //$("#titulo.titulo").css({ 'width': '300px' });
    }

    $(document).ready(function(){

      $(window).resize(function(e){
        altura_encimaModal();
      });

      $("#valor_geodata").click(function() {
          modal_georeferencia();
          altura_encimaModal();
      });

      $(".cerrar-modal").click(function() {
        $(".encimaModal").fadeOut(300, function(){
          $(".encima").fadeOut(300);
        });
      });


    });
</script>



<style>

    .mapgeo {
      width: 100%;
      height: 800px;
    }

</style>



</head>

<!--<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo"> MENU ABIERTO -->
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-sidebar-closed">

<!-- BEGIN HEADER -->
<div class="page-header -i navbar navbar-fixed-top">

  <?php include('prncpal/hdrtbg.php'); ?>

</div>
<!-- END HEADER -->

<div class="clearfix"></div>

<!-- BEGIN CONTAINER -->
<div class="page-container">

  <!-- INICIO MODAL vigencias-->
  <div class="encima"></div>
  <div class="encimaModal">
      <!-- <a href="javascript:void(0);" class="cerrar-modal">CERRAR vvvv</a> -->
      <div id="modalContenido">
      </div>
  </div>
  <!-- FIN MODAL vigencias-->


	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<?php include('prncpal/mntbg.php'); ?>
	</div>
	<!-- END SIDEBAR -->

	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">

      <?php include('prncpal/titulomigatbg.php'); ?>
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">

                	<!-- ---------------------------------------------------------------------------- INTERNA RECUADRO ---------------------------------------------------------------------------- -->
                    <div class="recuadro">
                    	<div class="titulo">

                          <img src="<?php echo $imagen_procemodulo; ?>" /> <?php echo $nombre_modulosytem; ?>

                        </div>
                        <div class="dentro">


                          <div class="col-md-12">

                                <div class="col-md-3">



                                  <label>Municipio</label>
                                    <div class="combo" id="identidad" >
                                        <select class="selmunicipio" name="selmunicipio">
                                          <option value="0">Todos</option>
                                          <?php
                                          while($data_municipio=$cnxn_pag->obtener_filas($municipios)){

                                              $mun_nombre=$data_municipio['mun_nombre'];
                                              $dep_codigo=$data_municipio['dep_codigo'];
                                              $mun_dane=$data_municipio['mun_dane'];
                                              $mun_codigo=$data_municipio['mun_codigo'];
                                              $mun_poblacion=$data_municipio['mun_poblacion'];
                                              $mun_coory=$data_municipio['mun_coory'];
                                              $mun_coorx=$data_municipio['mun_coorx'];
                                          ?>
                                            <option value="<?php echo $mun_codigo; ?>"><?php echo $mun_nombre; ?></option>
                                          <?php
                                              $numeromun++;
                                            }
                                          ?>
                                        </select>
                                    </div>


                                 </div>
                              <!--  INICIO TABLA REGISTROS -->

                                <div class="col-md-9">
                                  <a href="javascript:void(0);" title="Agregar Valores" id="valor_geodata<?php echo $rayahabilita; ?>" class="new-btn"><img src="img/ico/new.png" /></a>
                                    <div class="recuadro resultadomunicipio mapgeo">

                                      <?php include('mpatbg/nfompa/geodata.php'); ?>

                                    </div>

                                </div>







                              <!-- FIN TABLA REGISTROS  -->
                      	</div>


                        </div>
                    </div>
                	<!-- ---------------------------------------------------------------------------- fin INTERNA RECUADRO ---------------------------------------------------------------------------- -->
				</div>
        <script type="text/javascript">

            $(".selmunicipio").change(function(){

                var codigo_municipio = $(".selmunicipio").val();//$(this).data("muncodigo");

                $.ajax({
                  url:"geodata",
                  type:"POST",
                  data:{
                      codigo_municipio: codigo_municipio
                      },
                  //data:"codigo_metaproducto="+codigo_metaproducto+"&codigo_valorejecutado="+codigo_valorejecutado,
                  async:true,

                  success: function(message){
                    $(".mapgeo").empty().append(message);
                    //$("#modalContenido").html("<h2>El M/pio seleccionado es: " + code + "</h2>");

                  }

                });

            });

            //****************************************************************************//
            // *************** MODAL PARA REPORTE DE FOTOS GEODATA ********************** //
            //****************************************************************************//

            //$("#valor_geodata").click(function(){
            function modal_georeferencia(){
                var codigo_metaproducto = $(this).data("codigometaproducto");
                var codigo_valorejecutado = $(this).data("codigovalorejecutado");
                //alert(codigo_metaproducto + ' :: ' + codigo_valorejecutado);

                $.ajax({
                  url:"formgeoreferenciacion",
                  type:"POST",
                  data:"codigo_metaproducto="+codigo_metaproducto+"&codigo_valorejecutado="+codigo_valorejecutado,
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
            //});
            //****************************************************************************//
            // *************** FIN MODAL PARA REPORTE DE FOTOS GEODATA ****************** //
            //****************************************************************************//


        </script>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->



	<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
<div class="page-footer">
	<?php include('prncpal/ftrtbg.php'); ?>
</div>
<!-- END FOOTER -->

</body>
</html>
