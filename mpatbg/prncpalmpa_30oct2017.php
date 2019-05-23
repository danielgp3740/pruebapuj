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

   <script type="text/javascript" src="js/jquery.vmap.min.js"></script>
  <!--  <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="js/jquery-jvectormap-1.2.2.min.js"></script> -->
  <script type="text/javascript" src="js/huila.js"></script>
  <script type="text/javascript">

  //---------------------------------------------------------

  function verMpio(code){
    alert("verMpio: " + code );
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

  //---------------------------------------------------------

jQuery(document).ready(function (){//$(function(){
    jQuery('#mapaHuila').vectorMap({
        map: 'mapHuila',
        enableZoom: false,
        showTooltip: true
      });

      /*$('#mapaHuila').vectorMap({
        //map: 'map',
        map: 'mapHuila',
          onRegionClick: function(event, code){
              verMpio(code);
              event.preventDefault();
          },
          showTooltip: true,
          backgroundColor: '#CCCCC9', //b3d1ff
          series:{
          regions: [{
            values:{
              "campoalegre_20150221150315610":"1",
              "colombia_20150221150315611":"2",
              "baraya_20150221150315609":"3",
              "villavieja_20150221150315638":"4",
              "aipe_20150221150315606":"5",
              "tello_20150221150315635":"6",
              "neiva_20150221150315603":"7",
              "palermo_20150221150315624":"8",
              "rivera_20150221150315628":"9",
              "santa-maria_20150221150315631":"10",
              "iquira_20150221150315617":"11",
              "teruel_20150221150315636":"12",
              "yaguara_20150221150315639":"13",
              "hobo_20150221150315616":"14",
              "algeciras_20150221150315607":"15",
              "nataga_20150221150315621":"16",
              "tesalia_20150221150315634":"17",
              "paicol_20150221150315623":"18",
              "gigante_20150221150315614":"19",
              "la-plata_20150221150315620":"20",
              "el-pital_20150221150315626":"21",
              "la-argentina_20150221150315619":"22",
              "agrado_20150221150315605":"23",
              "garzon_20150221150315613":"24",
              "tarqui_20150221150315633":"25",
              "salado-blanco_20150221150315629":"26",
              "oporapa_20150221150315622":"27",
              "altamira_20150221150315608":"28",
              "elias_20150221150315612":"29",
              "timana_20150221150315637":"30",
              "suaza_20150221150315632":"31",
              "san-agustin_20150221150315630":"32",
              "isnos_20150221150315618":"33",
              "pitalito_20150221150315627":"34",
              "palestina_20150221150315625":"35",
              "acevedo_20150221150315604":"36",
              "guadalupe_20150221150315615":"37"},

            scale: ['#4e967d', //1
                    '#893AD3', //2
                    '#66C2A5', //3
                    '#FC8D62', //4
                    '#8DA0CB', //5
                    '#D470A5', //6
                    '#A6D854', //7
                    '#488E78', //8
                    '#0FAE33', //9
                    '#BFBB32', //10
                    '#8DA0CB', //11
                    '#66C2A5', //12
                    '#d0a355', //13
                    '#dccd57', //14
                    '#9db69f', //15
                    '#ffe978', //16
                    '#f7e9a1', //17
                    '#c79d3c', //18
                    '#f5934b', //19
                    '#bfb778', //20
                    '#65865f', //21
                    '#84add0', //22
                    '#ea6199', //23
                    '#299888', //24
                    '#1fa223', //25
                    '#f3de74', //26
                    '#aeceb5', //27
                    '#e5f378', //28
                    '#c88fe4', //29
                    '#f3c196', //30
                    '#a4dc84', //31
                    '#146592', //32
                    '#ea7c7c', //33
                    '#8b78c3', //34
                    '#e4c520', //35
                    '#b6a3da', //36
                    '#eacc56'], //37 // LISTADO DE COLORES
            normalizeFunction: 'polynomial'
              }]
          },

          regionStyle:{
              initial:{
                  fill:"#f4f3f0",
                  stroke:"#CCCCCC",
                  "stroke-width":3,
                  "stroke-opacity":1
              },

              hover:{
                  fill:"#999999",
                  "fill-opacity":"1"
              }

          }
      }) */
  });
  </script>

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
