<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
<!--<![endif]-->

<head>
  <!-- HEAD -->
  <?php include('hdtbg.php'); ?>
</head>

<!--<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo"> MENU ABIERTO -->
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-sidebar-closed">

<!-- BEGIN HEADER -->
<div class="page-header -i navbar navbar-fixed-top">

  <?php include('hdrtbg.php'); ?>


</div>
<!-- END HEADER -->

<div class="clearfix"></div>

<!-- BEGIN CONTAINER -->
<div class="page-container">

	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<?php include('mntbg.php'); ?>
	</div>
	<!-- END SIDEBAR -->

	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">


			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">

                	<!-- ---------------------------------------------------------------------------- INTERNA RECUADRO ---------------------------------------------------------------------------- -->
                    <div class="recuadro">
                    	<div class="titulo">

                          <img src="<?php echo $imagen_procemodulo; ?>" /> <?php echo $nombre_modulosytem; ?>

                        </div>
                        <div class="dentro intro">
                          <?php
                          /*
                          for($i=65; $i<=90; $i++) {
                              $letra = chr($i);
                              echo '<a href="index.php?letra='.$letra.'">'.$letra.'</a> | ';
                          }
                          */
                          ?>
<!--
<div class="slider">
</div>
-->
<br>
  <h1>BIENVENIDOS</h1>
  <br>

    <p>Tablero Balanceado de Gestión – TBG es la herramienta gerencial
tecnológica que permite a las diferentes secretarias, departamentos e
institutos descentralizados visualizar de forma estandarizada,
organizada e integral la estructura, conformada por escenarios,
sectores, programas, metas de resultado y metas de producto, del
Plan de Desarrollo Departamental 2016-2019 “EL CAMINO ES LA
EDUCACIÓN”.</p><p>
TBG es parte de una estrategia de seguimiento diseñada por el
Departamento Administrativo de Planeación correspondiente con la
medición de las metas de producto, su avance, su impacto geográfico,
social, teniendo en cuenta el enfoque diferencial, análisis y revisión de
la información de manera conjunta con los ejecutores y consolidando
bajo unos parámetros de medición rigurosos el avance en la ejecución
de las metas del Plan de Desarrollo.
TBG permite además hacer seguimiento permanente y oportuno a
cada uno de los escenarios y sectores de actuación estratégica, de
acuerdo con la estructura misma del Plan de Desarrollo, o desde una
visión territorializada donde se visibiliza la inversión realizada por el
departamento en los 37 municipios.</p>
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
	<?php include('ftrtbg.php'); ?>
</div>
<!-- END FOOTER -->

</body>
</html>
