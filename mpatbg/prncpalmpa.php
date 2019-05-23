<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
<!--<![endif]-->

<head>
  <!-- HEAD -->
  <?php include('prncpal/hdtbg.php'); ?>
  <link href="css/jqvmap.css" media="screen" rel="stylesheet" type="text/css"/>
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

                                <div class="col-md-4">
                                  <div id="mapaHuila" style="width: 100%; height: 500px"></div>

                                  <script type="text/javascript" src="js/jquery.vmap.js"></script>
                                  <script type="text/javascript" src="js/huila.js"></script>
                                  <!--
                                    <script type="text/javascript" src="js/jquery-jvectormap-1.2.2.min.js"></script>
                                    <script type="text/javascript" src="js/huila.js"></script>
                                  -->
                                    <script type="text/javascript">

                                    jQuery(document).ready(function(){

                                      jQuery('#mapaHuila').vectorMap({
                                        map: 'mapHuila',
                                        enableZoom: false,
                                        onRegionClick: function(event, code, name){
                                            verMpio(code, name);
                                        },
                                        showTooltip: true,
                                        backgroundColor: '#004610',

                                      });
                                    });

                                    function verMpio(code, name){
                                        //armarModal($(this).attr("id"),2,false,"<span>Municipio "+code+" | Nombre:"+name+"</span>","","");
                                        //alert("verMpio: " + code );
                                        //armarModal($(this).attr("id"),2,false,"<span>"+code+"</span>","","");
                                        var municipio_code=code;
                                        $.ajax({
                                          url:"mapametaproductomunicipio",
                                          type:"POST",
                                          data:"codigo_municipio="+municipio_code,
                                          async:true,

                                          success: function(message){
                                            $(".resultadomunicipio").empty().append(message);
                                            //$("#modalContenido").html("<h2>El M/pio seleccionado es: " + code + "</h2>");

                                            /*$(".encima").fadeIn(300, function(){
                                              $(".encimaModal").fadeIn(300);
                                            });*/
                                          }
                                        });
                                      }


                                    </script>
                                <div class="tooltip ">
                                 <a href="" class="new-btn"><img src="img/ico/flecha_derecha.png"><img src="img/ico/territorial.png"></a>
                                 <span class="tooltiptext mphover">
                                   Listar metas de proucto del departamento
                                 </span>
                               </div>
                                 </div>
                              <!--  INICIO TABLA REGISTROS -->

                                <div class="col-md-8">
                                    <div class="recuadro resultadomunicipio">

                                      <?php
                                        include('nfompa/mtaprdcto.php');
                                      ?>

                                    </div>

                                </div>







                              <!-- FIN TABLA REGISTROS  -->
                      	</div>


                        </div>
                    </div>
                	<!-- ---------------------------------------------------------------------------- fin INTERNA RECUADRO ---------------------------------------------------------------------------- -->
				</div>
        <?php
        /*
        $v1=0;
        $v2=1;
          for ($i=1; $i<10 ; $i++) {
            $vf=$v1+$v2;
            $v1=$v2;
            $v2=$vf;
            echo $vf.",";
          }
          */
        ?>
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
