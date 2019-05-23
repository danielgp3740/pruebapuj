<?php
session_start();
include('libreria/conexion.php'); 
include("fckeditor/fckeditor.php") ;

if(!$_SESSION['persona']){
		header("Location: index.php");
	}


$accion="nuevo";

//$sql_seccion="SELECT * FROM seccion WHERE sec_enlace='0' ";
$sql_seccion="SELECT * FROM seccion WHERE sec_enlace='0' AND sec_codigo!=3 AND sec_codigo!=4 ORDER BY sec_nombre ASC"; //SIN LAS SECC CONTACTO Y MAPA


$query_seccion=pg_query($conexion,$sql_seccion);


if($_REQUEST['codigo_contenido']){

	$accion="modificar";
	$conte_codigo=$_REQUEST['codigo_contenido'];
	
	$sql_contenido="SELECT * FROM contenido WHERE cont_codigo=".$conte_codigo." ";
	$query_contenido=pg_query($conexion,$sql_contenido);

	//SI NO HAY CONTENIDOS CON ESE CODIGO
	$num_datos=pg_num_rows($query_contenido);
	//echo 'num: '.$num_datos;
	
	if ($num_datos <= 0){
		echo "<script>alert ('esta buscando un contenido que no existe!!!!!')</script>";
		echo "<script>location.href='lista_seccion.php'</script>";
	}

	$dato_contenido=pg_fetch_array($query_contenido);
	$codigo_contenido=$dato_contenido['cont_codigo'];
	$titulo_contenido=$dato_contenido['cont_titulo'];
	$titulo_estado=$dato_contenido['cont_tit_estado'];
	$intro_contenido=$dato_contenido['cont_intro'];
	$intro_estado=$dato_contenido['cont_intro_estado'];
	$total_contenido=$dato_contenido['cont_contenido'];
	$seccion=$dato_contenido['sse_codigo'];
	$estado=$dato_contenido['cont_estado'];
	$subseccion=$dato_contenido['cont_subseccion'];
	$cont_iniciopagina=$dato_contenido['cont_iniciopagina'];
	
	if($subseccion=='0'){
		$seccion_conte=$seccion;
	}
	if($subseccion){
		$sql_seccione="SELECT sec_codigo,sse_codigo FROM subseccion 
					  WHERE sse_codigo=".$subseccion." ";
		//echo $sql_seccione."<br>";			  
		$query_seccione=pg_query($conexion,$sql_seccione);
		
		$dato_seccion=pg_fetch_array($query_seccione);
		$seccion_conte=$dato_seccion['sec_codigo'];
		$subseccion_conte=$dato_seccion['sse_codigo'];
		
		/*echo $seccion_conte." sec<br>";
		echo $subseccion_conte." sub<br>";*/
		
	}
		
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<?php include 'head.php'; ?>
<link href="css/sample.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/ajaxSubseccion.js"></script>
<script type="text/javascript" src="js/validar_contenidos.js"></script>

<script type="text/javascript" src="js/jquery-1.9.0.js"></script>
<script type="text/javascript" src="js/validar_contenidos.js"></script>
<script type="text/javascript" src="tinymce/js/tinymce/plugins/example/plugin.js"></script>
<script type="text/javascript" src="tinymce/js/tinymce/plugins/example/plugin.min.js"></script>
<script type="text/javascript" src="tinymce/js/tinymce/tinymce.js"></script>
 
<link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css" media="screen" />
<script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>


<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

<!-- Add Thumbnail helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!-- Add Media helper (this is optional) -->
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
 
 
 
 
 
<script type="application/javascript">
		tinymce.init({
			selector: "textarea#txtintroduccion",
			plugins: [
				"advlist autolink lists link charmap print preview anchor pagebreak ",
				"searchreplace visualblocks code fullscreen nonbreaking",
				"insertdatetime media table contextmenu paste "
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ",
			autosave_ask_before_unload: false,
			max_height: 200,
			min_height: 160,
			height : 380,
			
			
			// CONFIGURACIÓN SERVIDOR LOCAL
				
			/* 
			relative_urls:true,
			external_filemanager_path:"/caracoli/filemanager/",
			filemanager_title:"Administrador de Archivos" ,
			external_plugins: { "filemanager" : "/esecolombia/filemanager/plugin.min.js"}
			*/
			
			// CONFIGURACIÓN SERVIDOR REAL
			relative_urls:true,
			external_filemanager_path:"/filemanager/",
			filemanager_title:"Administrador de Archivos" ,
			external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
			
		
			
		});

		tinymce.init({
			selector: "textarea#txtcontenido",
			
			plugins: [
				"advlist autolink lists link image charmap print preview anchor pagebreak ",
				"searchreplace visualblocks code fullscreen insertdatetime nonbreaking",
				"insertdatetime media table contextmenu paste responsivefilemanager"
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			autosave_ask_before_unload: false,
			max_height: 200,
			min_height: 160,
			height : 380,
			
			/*	
			// CONFIGURACIÓN SERVIDOR LOCAL
			
			relative_urls:true,
			external_filemanager_path:"/caracoli/filemanager/",
			filemanager_title:"Administrador de Archivos" ,
			external_plugins: { "filemanager" : "/caracoli/filemanager/plugin.min.js"}
		*/
			
			// CONFIGURACIÓN SERVIDOR REAL
			relative_urls:true,
			external_filemanager_path:"/filemanager/",
			filemanager_title:"Administrador de Archivos" ,
			external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}

			
		});



		jQuery(document).ready(function ($) {
			  $('.iframe-btn').fancybox({
			  'width'	: 880,
			  'height'	: 570,
			  'maxHeight'	: 570,
			  'minHeight'	: 470,
			  'type'	: 'iframe',
			  'autoScale'   : false
			  });
			  
			  $('#txtimagen').on('change',function(){
				  alert('change triggered');
			  });
			  
			  $('#download-button').on('click', function() {
				ga('send', 'event', 'button', 'click', 'download-buttons');      
			  });
			  $('.toggle').click(function(){
				var _this=$(this);
				$('#'+_this.data('ref')).toggle(200);
				var i=_this.find('i');
				if (i.hasClass('icon-plus')) {
				  i.removeClass('icon-plus');
				  i.addClass('icon-minus');
				}else{
				  i.removeClass('icon-minus');
				  i.addClass('icon-plus');
				}
			  });
		});
		

</script>




</head>

<body>

<div id="wrap">

	<?php include 'header.php'; ?>
				
	<!-- content-wrap -->
	<div id="content-wrap">
		
	  <div id="content">
			<h1><? echo ucwords($accion);?> Contenido</h1>

			<form name="frm_contenido" method="post" enctype="multipart/form-data" >			
				<p>			
				<!--
                 
                -->
                <label>Mostrar en el Inicio de la P&aacute;gina</label>
                <select name="mostrar_inicio">
                	<option value="0">Ninguno</option>
                	<option value="1">Inicio</option>
                </select>
                
				<label>T&iacute;tulo Contenido</label>
				<input name="txtTitulo" value="<?php echo $titulo_contenido; ?>" type="text"  size="70" />
				<br />
                <label><span>Imagen</span> </label>
                   <!--  <input type="file" name="txtimagen" id="txtimagen" placeholder="Seleccion la imagen" value="" size="70" style="background:none;" />  -->
                <input id="txtimagen" name="txtimagen" type="text" value="" size="70" >
                <a href="../filemanager/dialog.php?type=1&field_id=txtimagen" class="btn iframe-btn" type="button">Seleccionar</a>
                <div class="message_error" id="error_iamgen" >El Peso de la Imagen dede ser menor o igual a 1MB</div>

				<br />
				<label>Seleccione la Secci&oacute;n</label>
				<select name="selSeccion" id="selSeccion" onchange="startRequest_subseccion();" >
				  <option value="0" >Seleccione...</option>
					<?php
					//SI VIENE CODIGO DE SECCION - NVO CONTENIDO A SECCION CREADA
					if (!empty($_REQUEST['codigo_seccion']))
						$seleccionado = $_REQUEST['codigo_seccion'];
					else
						$seleccionado = $seccion_conte;

					while($lista_seccion=pg_fetch_array($query_seccion)){
						$codigo_seccion=$lista_seccion['sec_codigo'];
						$nombre_seccion=$lista_seccion['sec_nombre'];
						
						//if($codigo_seccion==$seccion_conte){
						if($codigo_seccion==$seleccionado){
							$selected="selected";
						}
						else{
							$selected="";
						}
						
						echo "<option value='".$codigo_seccion."' $selected>".$nombre_seccion."</option>";
					}
					
					?>
				  <option value="4" >Papelera</option>
				</select>
                <br />
                <label>Seleccione la Subsecci&oacute;n</label>
				<div id="sub_seccion">
				<select name="selSubseccion" id="selSubseccion">
				  <option value="0">Seleccione..</option>

				  <?php
				  
				  //SI VIENE CODIGO DE CONTENIDO - RECARGADO
				  if($_REQUEST['codigo_contenido']){
				  	$sql_subseccion="SELECT sse_codigo, sse_nombre 
									 FROM subseccion
									 WHERE sec_codigo=".$seccion_conte." AND sse_enlace='0' ";
					$query_subseccion=pg_query($conexion,$sql_subseccion);
					
					while($lista_subseccion=pg_fetch_array($query_subseccion)){
					
						$subseccion_codigo=$lista_subseccion['sse_codigo'];
						$subseccion_nombre=$lista_subseccion['sse_nombre'];
						
						if($subseccion_codigo==$subseccion_conte){
							$selected="selected";
						}
						else{
							$selected="";
						}
						
						echo "<option value='".$subseccion_codigo."' $selected>".$subseccion_nombre."</option>";
					}
					
				  }
				  
				  //SI VIENE CODIGO DE SUBSECCION - NVO CONTENIDO A SUBSECCION CREADA
				  elseif($_REQUEST['codigo_subSeccion']){
				  	echo '<option value="0">cod subseccion</option>';

				  	$sql_subseccion="SELECT sse_codigo, sse_nombre 
									 FROM subseccion
									 WHERE sec_codigo=".$_REQUEST['codigo_seccion']." ";
					$query_subseccion=pg_query($conexion,$sql_subseccion);
					
					while($lista_subseccion=pg_fetch_array($query_subseccion)){
					
						$subseccion_codigo=$lista_subseccion['sse_codigo'];
						$subseccion_nombre=$lista_subseccion['sse_nombre'];
						
						if($subseccion_codigo==$_REQUEST['codigo_subSeccion']){
							$selected="selected";
						}
						else{
							$selected="";
						}
						
						echo "<option value='".$subseccion_codigo."' $selected>".$subseccion_nombre."</option>";
					}
				  }
				  ?>
				  
				  <?php echo $sub_option; ?>
				  
				</select>
				</div>
				<br />
				<label>Estado</label>
				<select name="selEstado" id="selEstado">
				<?php
					if($estado=='1'){
						$selected="selected";
					}
					else{
						$selected="";
					}

				  echo"<option value='1' $selected >Activo</option>
					   <option value='0'>Inactivo</option>";
				?>
				</select>
                <br /><br />
                <label>Introducci&oacute;n</label>
               	<textarea rows="20" cols="55" name="txtintroduccion" id="txtintroduccion"><?php echo $intro_contenido; ?></textarea>


                <label>Contenido</label>
               	<textarea rows="20" cols="55" name="txtcontenido" id="txtcontenido"><?php echo $total_contenido; ?></textarea>
				<input name="txtCodigoCont" value="<?php echo $codigo_contenido; ?>" type="hidden" />
				<input name="txtAccion" value="<?php echo $accion; ?>" type="hidden" />
				<br />
				<br />
				<input type="button" class="button" value="Guardar" onclick="val_contenido();" />	
				</p>		
		  </form>

	  </div>
	  
	</div>
	<!-- end content-wrap-->		

<?php include 'footer.php'; ?>
	
<!-- wrap ends here -->
</div>

</body>
</html>