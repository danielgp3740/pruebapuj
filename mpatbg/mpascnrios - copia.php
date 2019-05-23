<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
<!--<![endif]-->

<head>
<meta charset="utf-8"/>
<title>TBG | Tablero Balanceado de Gestión</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>

<link href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<link href="css/layout/css/layout.css" rel="stylesheet" type="text/css"/><!-- area interana -->
<link id="style_color" href="css/thuila.css" rel="stylesheet" type="text/css"/><!-- color interfaz -->
<link rel="stylesheet" href="css/ckm!Style.css" type="text/css" />

<link href="css/jqvmap.css" media="screen" rel="stylesheet" type="text/css"/>

<link rel="shortcut icon" href="favicon.ico"/>

<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery-migrate.min.js" type="text/javascript"></script>

<script src="css/bootstrap/js/bootstrap.min.js" type="text/javascript"></script><!-- sin este no funciona el menu -->

<script src="js/scripts/metronic.js" type="text/javascript"></script><!-- sin este no funciona el menu -->
<script src="css/layout/scripts/layout.js" type="text/javascript"></script><!-- aqui funciono el menu -->
<script>
jQuery(document).ready(function() {
	Layout.init(); // init current layout
});
</script>

</head>

<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo">

<!-- BEGIN HEADER -->
<div class="page-header -i navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">

		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="index.html">
                <img src="img/logo_sm.png" alt="Administración" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler"></div>
		</div>
		<!-- END LOGO -->

		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
		<!-- END RESPONSIVE MENU TOGGLER -->

		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<li class="dropdown dropdown-user ms-hover usuario">
                        Usuario
				</li>
				<li class="dropdown dropdown-user ms-hover ">
				 <a href="" class="help">
                 <img class="media-object" src="img/ico/ayuda.png" alt="Ayuda" title="Ayuda" />
                 </a>
				</li>
				<li class="dropdown dropdown-user ms-hover ">
				 <a href="" class="help">
                 <img class="media-object" src="img/ico/campana.png" alt="Alerta" title="Alerta" />
                 </a>
				</li>
				<li class="dropdown dropdown-quick-sidebar-toggler">
					<a href="javascript:;" class="dropdown-toggle">
					<img class="media-object" src="img/salir.png" alt="Salir" title="Salir" />
					</a>
				</li>
				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->



<div class="clearfix"></div>



<!-- BEGIN CONTAINER -->
<div class="page-container">

	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">

			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element
					<form class="sidebar-search sidebar-search-bordered" action="extra_search.html" method="POST">
						<a href="javascript:;" class="remove">
						<i class="icon-close"></i>
						</a>
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
							</span>
						</div>
					</form>-->
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				<li class="start ">
					<a href="javascript:;">
                        <img class="media-object" src="img/ico/home.png" />
                        <span class="title">Inicio</span>
					</a>
				</li>
				<li>
					<a href="javascript:;">
                        <img class="media-object" src="img/ico/usuario.png" />
                        <span class="title">Usuario</span>
                        <span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="#"><img src="img/ico/new.png" /> Nuevo</a>
						</li>
						<li>
							<a href="#"><img src="img/ico/listar.png" /> Listar</a>
						</li>
						<li>
							<a href="#"><img src="img/ico/guardar.png" /> Guardar</a>
						</li>
						<li>
							<a href="#"><img src="img/ico/cerrar.png" /> Cancelar</a>
						</li>
					     <li>
							<a href="#"><img src="img/ico/basura.png" /> Eliminar</a>
						</li>
						 <li>
							<a href="#"><img src="img/ico/imagen.png" /> Imagen</a>
						</li>
						<li>
							<a href="#"><img src="img/ico/video.png" /> Video</a>
						</li>
						<li>
							<a href="#"><img src="img/ico/audio.png" /> Audio</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="javascript:;">
                        <img class="media-object" src="img/ico/reporte.png" />
                        <span class="title">Reportes</span>
                        <span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								Item 1 <span class="arrow"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="javascript:;">
										Subtem 1  <span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li>
											<a href="#">Sub Subtem 1</a>
										</li>
										<li>
											<a href="#">Sub Subtem 2</a>
										</li>
										<li>
											<a href="#">Sub Subtem 3</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="#">Subtem 2</a>
								</li>
								<li>
									<a href="#">Subtem 3</a>
								</li>
								<li>
									<a href="#">Subtem 4</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
								Item 2 <span class="arrow"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">Subtem 2.1</a>
								</li>
								<li>
									<a href="#">Subtem 2.2</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#"> Item 3 </a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;">
                        <img class="media-object" src="img/ico/estadistica.png" />
                        <span class="title">Estadistica</span>
                        <span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="#"><img src="img/ico/new.png" /> Nuevo</a>
						</li>
						<li>
							<a href="#"><img src="img/ico/listar.png" /> Listar</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="javascript:;">
                        <img class="media-object" src="img/ico/doc.png" />
                        <span class="title">Documentos</span>
                        <span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="#"><img src="img/ico/new.png" /> Nuevo</a>
						</li>
						<li>
							<a href="#"><img src="img/ico/listar.png" /> Listar</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#">
                        <img class="media-object" src="img/ico/check.png" />
                        <span class="title">Check</span>
					</a>
				</li>
				<li class="last ">
					<a href="#">
                        <img class="media-object" src="img/ico/pinon2.png" />
                        <span class="title">Configuración</span>
					</a>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->

		</div>
	</div>
	<!-- END SIDEBAR -->



	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">

			<h3 class="page-title">Título del Item</h3>

			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<a href="index.html">Inicio</a> &nbsp;<img class="media-object" src="img/flecha_miga.png">&nbsp;
					</li>
					<li>
						<a href="#">Listado de Procedimientos</a> &nbsp;<img class="media-object" src="img/flecha_miga.png">&nbsp;
					</li>
					<li>
						Procedimiento Option 1
					</li>
				</ul>
			</div>


			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">

                	<!-- ---------------------------------------------------------------------------- INTERNA RECUADRO ---------------------------------------------------------------------------- -->
                    <div class="recuadro">
                    	<div class="titulo">
                        	<img src="img/ico/usuario.png" /> Escenarios departamentos del Huila
                        </div>

                        <div class="dentro">

                        	<div id="verDestacado">
                            	<input type="button" class="cerrar-modal" value="" alt="Cerrar" title="Cerrar">
                            	<h3>Proyecto destacado</h3>
                                <img src="http://1.bp.blogspot.com/-hGuqPkdCoO4/UqnlkEteJmI/AAAAAAABb6E/COwEZFVL_Qk/s1600/carreteras-del-huila.JPG" />
                                <p>Información del proyeco descatado.</p>
                            </div>

                            <!-- ESCENARIOS -->
                            <div id="escenarios" class="escenarios">
                                <div class="titulo">
	                                Municipio: Colombia
                                    <div class="bloDr">
                                        <input type="button" class="volver-modal" value="" alt="Regresar" title="Regresar">
                                    </div>
                                </div>
                                <div class="bloqIzq" style="background-image: url(img/municipios/colombia_id.png);">
                                	<div class="destacados">
                                    	<ul>
                                        	<li>
                                            <div class="tooltip" data-codigometaproducto="201611130609253">
                                        		<span data-codestacado="1"><img src="http://1.bp.blogspot.com/-hGuqPkdCoO4/UqnlkEteJmI/AAAAAAABb6E/COwEZFVL_Qk/s1600/carreteras-del-huila.JPG"></span>

                                                    <span class="tooltiptext toolmp">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse diam lacus, blandit et tellus blandit, dignissim condimentum risus
                                                    </span>
                                           </div>
                                        	</li>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li>
                                        		<div class="tooltip" data-codigometaproducto="201611130609253"><span data-codestacado="1"><img src="http://1.bp.blogspot.com/-hGuqPkdCoO4/UqnlkEteJmI/AAAAAAABb6E/COwEZFVL_Qk/s1600/carreteras-del-huila.JPG">
                                        		</span>

                                        		    <span class="tooltiptext toolmp">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse diam lacus, blandit et tellus blandit, dignissim condimentum risus
                                                    </span>
                                                </div>
                                        	</li>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><div class="tooltip" data-codigometaproducto="201611130609253"><span data-codestacado="1"><img src="http://1.bp.blogspot.com/-hGuqPkdCoO4/UqnlkEteJmI/AAAAAAABb6E/COwEZFVL_Qk/s1600/carreteras-del-huila.JPG"></span>

                                        		 <span class="tooltiptext toolmp">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse diam lacus, blandit et tellus blandit, dignissim condimentum risus
                                                    </span>
                                            </div>
                                        	</li>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><div class="tooltip" data-codigometaproducto="201611130609253"><span data-codestacado="1"><img src="http://1.bp.blogspot.com/-hGuqPkdCoO4/UqnlkEteJmI/AAAAAAABb6E/COwEZFVL_Qk/s1600/carreteras-del-huila.JPG"></span>
                                        		 <span class="tooltiptext toolmp">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse diam lacus, blandit et tellus blandit, dignissim condimentum risus
                                                    </span>
                                            </div>
                                        	</li>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><div class="tooltip" data-codigometaproducto="201611130609253"><span data-codestacado="1"><img src="http://1.bp.blogspot.com/-hGuqPkdCoO4/UqnlkEteJmI/AAAAAAABb6E/COwEZFVL_Qk/s1600/carreteras-del-huila.JPG"></span>
                                        		 <span class="tooltiptext toolmp">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse diam lacus, blandit et tellus blandit, dignissim condimentum risus
                                                    </span>
                                            </div>
                                        	</li>
                                        	<li><span data-codestacado="1"></span></li>
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
                                      <tr>
                                        <td class="titul verVentana" data-escenario="Social">Social</td>
                                        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                      </tr>
                                      <tr>
                                        <td class="titul verVentana">Económico</td>
                                        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                      </tr>
                                      <tr>
                                        <td class="titul verVentana">Territorial</td>
                                        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                      </tr>
                                      <tr>
                                        <td class="titul verVentana">Rural y Productivo</td>
                                        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                      </tr>
                                      <tr>
                                        <td class="titul verVentana">Gobernanza</td>
                                        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                      </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- fin ESCENARIOS -->

                            <!-- SECTORES -->
                             <div id="sectores" class="escenarios sectores">
                                <div class="titulo">
	                                Municipio: Colombia / Sectores
                                    <div class="bloDr">
                                        <input type="button" class="volver-modal" value="" alt="Regresar" title="Regresar">
                                    </div>
                                </div>
                                <div class="bloqIzq" style="background-image: url(img/municipios/colombia_id.png);">
                                	<div class="destacados">
                                	<div class="destacados">
                                    	<ul>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><span data-codestacado="1"></span></li>
                                        </ul>
                                    </div>
                                    </div>
                                </div>
                                <div class="bloqDer">
                                    <table>
                                      <tr>
                                        <td class="titul verVentana">Salud</td>
                                        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                      </tr>
                                      <tr>
                                        <td class="titul verVentana">Educación</td>
                                        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                      </tr>
                                      <tr>
                                        <td class="titul verVentana">Deporte y Recreación</td>
                                        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                      </tr>
                                      <tr>
                                        <td class="titul verVentana">Etnias - Grupos de Equidad</td>
                                        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                      </tr>
                                      <tr>
                                        <td class="titul verVentana">Gobernanza</td>
                                        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                      </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- fin SECTORES -->

                            <!-- PROGRAMAS -->
                            <div id="programas" class="escenarios sectores">
                                <div class="titulo">
	                                Municipio: Colombia / Sectores / Programas
                                    <div class="bloDr">
                                        <input type="button" class="volver-modal" value="" alt="Regresar" title="Regresar">
                                    </div>
                                </div>
                                <div class="bloqIzq" style="background-image: url(img/municipios/colombia_id.png);">
                                	<div class="destacados">
                                    	<ul>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><span data-codestacado="1"></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bloqDer">
                                    <table>
                                      <tr>
                                        <td class="titul verVentana">Programa 1</td>
                                        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                      </tr>
                                      <tr>
                                        <td class="titul verVentana">Programa 2</td>
                                        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                      </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- fin PROGRAMAS -->

                            <!-- ENTIDADES -->
                            <div id="entidades" class="escenarios sectores">
                                <div class="titulo">
	                                Municipio: Colombia / Sectores / Programas / Entidades
                                    <div class="bloDr">
                                        <input type="button" class="volver-modal" value="" alt="Regresar" title="Regresar">
                                    </div>
                                </div>
                                <div class="bloqIzq" style="background-image: url(img/municipios/colombia_id.png);">
                                	<div class="destacados">
                                    	<ul>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><span data-codestacado="1"></span></li>
                                        	<li><span data-codestacado="1"></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bloqDer">
                                    <table>
                                      <tr>
                                        <td class="titul">Entidad 1</td>
                                        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                      </tr>
                                      <tr>
                                        <td class="titul">Entidad 2</td>
                                        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                      </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- fin ENTIDADES -->


                            <!-- MAPA HUILA -->
                        	<div class="bloqIzq">
	                        	<div id="mapaHuila" class="mapaEscenarios"></div>
                            </div>
                        	<div id="sectGral" class="bloqDer">
                                <table>
                                	<tr>
                                    		<th>Esenario</th>
                                    		<th>Total Invertido</th>
                                    		<th>Población</th>
                                    	</tr>
                                  <tr>
                                    <td class="titul verVentana" data-escenario="Social">Social</td>
                                    <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                    <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                  </tr>
                                  <tr>
                                    <td class="titul verVentana">Económico</td>
                                    <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                    <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                  </tr>
                                  <tr>
                                    <td class="titul verVentana">Territorial</td>
                                    <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                    <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                  </tr>
                                  <tr>
                                    <td class="titul verVentana">Rural y Productivo</td>
                                    <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                    <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                  </tr>
                                  <tr>
                                    <td class="titul verVentana">Gobernanza</td>
                                    <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
                                    <td>10.234 <img src="img/ico/inf-genero.png" /></td>
                                  </tr>
                                </table>
                            </div>
                            <!-- fin MAPA HUILA -->

                            <link rel="stylesheet" href="css/mapa-escenarios.css" type="text/css" />
							  						<script type="text/javascript" src="js/jquery.vmap.js"></script>
                            <script type="text/javascript" src="js/huila.js"></script>
                            <script type="text/javascript" src="js/mapa-escenarios.js"></script>
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
	<div class="page-footer-inner">
		TBG | Tablero Balanceado de Gestión - 2016
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->


</body>
</html>
