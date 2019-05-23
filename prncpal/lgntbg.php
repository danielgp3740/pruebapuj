<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.3.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>TBG::Login</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>


<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/> -->
<link href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/ckm!Style.css" type="text/css" />

<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.validate.min.js" type="text/javascript"></script>


<!-- e -->
<script type="text/javascript" src="js/cambio_u.js"></script>
<script type="text/javascript" src="js/cambio_c.js"></script>

<script type="text/javascript" src="js/envio_login.js" ></script>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->


<!-- BEGIN LOGO -->
<div class="logo">
	<img src="img/logo.png" alt=""/>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
    <form id="frm_logueo" name="frm_logueo" class="login-form">
     <img src="img/camino_educacion.png" alt=""/>
		<h3 class="form-title">Acceso</h3>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Usuario</label>
            <input type="text" id="txt_usuario" name="txt_usuario" minlength="2" placeholder="Usuario" autocomplete="off" class="form-control form-control-solid placeholder-no-fix" data-rule-required="true" data-msg-required="Por favor ingrese su Usuario."  required />

		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Contraseña</label>
            <input type="password" id="txt_clave" name="txt_clave" placeholder="Contraseña" autocomplete="off" class="form-control form-control-solid placeholder-no-fix" data-rule-required="true" data-msg-required="Por favor ingrese su Contraseña." required />
		</div>
		<div id='error_loginall' style="color:#611; display:none; margin-bottom:5px; " ><strong>Usuario y Contraseña no Valida<strong></div>
		<div class="form-actions">
			<button type="submit" class="btn btn-success uppercase" onClick="validar_asopano();">Iniciar Sesión</button>
		</div>
	</form>
</div>
<div class="copyright">
<!--	TBG | Tablero Balanceado de Gestión - v 1.0  2016 <a href=""><img src="img/tdifooter.png" alt=""/></a><a href=""><img src="img/ckmfooter.png" alt=""/></a> -->
	TBG | Tablero Balanceado de Gestión - v 2.0 <!-- 2016 --> <a href=""><img src="img/tdifooter.png" alt=""/></a><a href=""><img src="img/ckmfooter.png" alt=""/></a>
</div>

</body>
<!-- END BODY -->
</html>
