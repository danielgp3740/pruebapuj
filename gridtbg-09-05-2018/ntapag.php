<?php

include "../ck_funciones.php";
//include "https://timthumb.googlecode.com/svn/trunk/timthumb.php";
include('mlbrncio/fnction_sql.php');
$datos_portada = new SqlInicio();

$enlaceMovil=$enlace;

		$sqlnta=" SELECT cnt_codigo, cnt_titulo, cnt_introduccion, cnt_desarrollo, cnt_seccion, cnt_subseccion, per_codigo, cnt_fecharedaccion, cnt_fechapublicacion, 
					   		 pri_codigo, cnt_urlcorta, cnt_palabrasclaves, cnt_periodista
				 	  FROM contenido
				 	  WHERE cnt_codigo='".$codigo_elemento."';";
		//echo $sqlnta;
		$querynta= $cnxn_pag->ejecutar($sqlnta);
		
		$numero_contenido= $cnxn_pag->numero_filas($querynta);
		
		if($numero_contenido<1){
			
			header('Location: http://www.diariodelhuila.com');
			
		}
		
		$numero_dato=1;
		$data= $cnxn_pag->obtener_filas($querynta);
			$codigo_contenido=$data['cnt_codigo'];
			$titulo_contenido=$data['cnt_titulo'];
			$introduccion_contenido=$data['cnt_introduccion'];
			$desarrollo_contenido=$data['cnt_desarrollo'];
			$cnt_seccion =$data['cnt_seccion'];
			$cnt_subseccion=$data['cnt_subseccion'];
			$per_codigo=$data['per_codigo'];
			$cnt_fecharedaccion=$data['cnt_fecharedaccion'];
			$cnt_fechapublicacion=$data['cnt_fechapublicacion'];
			//$cnt_urlcorta=$data_contenido['cnt_urlcorta'];
			//$cnt_palabrasclaves=$data_contenido['cnt_palabrasclaves'];
			$cnt_periodista=$data['cnt_periodista'];
		
			
			$sql_seccioncont=" 	SELECT sec_codigo, sec_nombre, sec_urlamigable
								FROM seccion
								WHERE sec_codigo='".$cnt_seccion."' ";
			$query_seccioncont=$cnxn_pag->ejecutar($sql_seccioncont);
			$data_seccion=$cnxn_pag->obtener_filas($query_seccioncont);
			$seccion_nombre=$data_seccion['sec_nombre'];
			$seccion_url=$data_seccion['sec_urlamigable'];
						
			
			$sql_periodistacont="SELECT per_codigo, per_nombre, per_apellido, per_estado
								 FROM persona
								 WHERE per_codigo = '".$cnt_periodista."' ;";
			
			$query_periodistacont=$cnxn_pag->ejecutar($sql_periodistacont);
			$data_periodista=$cnxn_pag->obtener_filas($query_periodistacont);
			$codigo_periodista=$data_periodista['per_codigo'];
			$nombre_periodista=$data_periodista['per_nombre']." ".$data_periodista['per_apellido'];
			
			
			$sql_fotonumero="SELECT fot_codigo, fot_nombre, fot_url
								FROM foto,foto_contenido
								WHERE fco_foto=fot_codigo
								AND fco_contenido='".$codigo_contenido."' ;";
			$query_fotonumero=$cnxn_pag->ejecutar($sql_fotonumero);
			$numero_foto=$cnxn_pag->numero_filas($query_fotonumero);
			
			$desarrollo_contenido=str_replace ("../noticias", "http://www.diariodelhuila.com/noticias/", $desarrollo_contenido );

			
			
			$photonote = "";
			if($numero_foto > 0){
				$sql_fotocontenido="SELECT fot_codigo, fot_nombre, fot_url, fco_principal
									FROM foto,foto_contenido
									WHERE fco_foto=fot_codigo
									AND fco_contenido='".$codigo_contenido."'
									ORDER BY fco_principal DESC
									LIMIT 1 OFFSET 0;";
				$query_fotocontenido=$cnxn_pag->ejecutar($sql_fotocontenido);
				$data_fotocontenido=$cnxn_pag->obtener_filas($query_fotocontenido);
				$url_foto =$data_fotocontenido['fot_url'];
		//AND fco_principal='1'
		
				$photonote = str_replace ("../", "", $url_foto );
		
			}
			
			$fecha_publicacion=substr($cnt_fechapublicacion,0,16);
		
			$titulo_enviar=str_replace(" ", "-" ,$titulo_contenido);
			//$find = array(utf8_encode('á'), utf8_encode('é'), utf8_encode('í'), utf8_encode('ó'),utf8_encode('ú'), utf8_encode('ñ'),',',':',';','.','?','¿');
			$find = array('á','é', 'í', 'ó','ú', 'ñ',',',':',';','.','?','¿', '"','%');
			$repl = array('a', 'e', 'i', 'o', 'u', 'n','','','','','','','','');
			$titulo_enviar=str_replace($find, $repl, $titulo_enviar);
			
			$link_amigable=$enlace.$seccion_url."/".strtolower($titulo_enviar)."-cdgint".$codigo_contenido;
			
			$numero_dato++;



?>

<!doctype html>

<head>

	<?php

		$titulo_paginatitulo=$titulo_contenido;
		include('hdsccpag.php'); ?>

</head>

<body>
	
	<?php include('mhdrpag.php'); ?>
	<!--
<article>

    <figure><a href="#"><img src="<?php echo $enlace; ?>publicidad/restuarantesguantanamomovil.jpg" border='0' style=" width:100%" /></a></figure>
</article>
   


<!-- cuerpo ----------------------------------------------------------------------------------------------------------------------------------------- -->
<div id="cuerpo">
	<!--contenido -->	
	<div id="contenido">

		<section>
			<article class="interna">
				<header>
					<h1 title="<?php echo $titulo_contenido;?>"><?php echo $titulo_contenido;?></h1>
				</header>

					<?php 
                        if($numero_foto > 0){
                        
                    ?>
                    <figure>
                        <figcaption class="nover"><?php echo $titulo_contenido;?></figcaption>
                        <img src="http://www.diariodelhuila.com/<? echo $photonote; ?>" alt="<?php echo $titulo_contenido;?>" title="<?php echo $titulo_contenido;?>" />
                    </figure>
                    <?php 
                        }
                    ?>

				<div class="fecha"><strong><?php echo $seccion_nombre; ?></strong> / <time datetime="<?php echo $fecha_publicacion; ?>"><?php echo $fecha_publicacion; ?></time></div>
				

					<?php echo $introduccion_contenido;?>
                    <?php echo $desarrollo_contenido;?>
                    <strong>Por: <?php echo $nombre_periodista; ?></strong>
			</article>
            
            
		</section>








	</div>
	<!-- end contenido -->	
</div>
<!-- end cuerpo ------------------------------------------------------------------------------------------------------------------------------------- -->


<?php
	include('includeee4.php');
?>


<!-- PUBLICIDAD --------------------------------------------------------------------------------- -->
<div class="publicidad">

	<!-- <img src="../publicidad/publicidadMovil.png" alt="Publicidad" /> -->
</div>


<!-- BUSCAR --------------------------------------------------------------------------------- -->
<form class="buscar">
	<input type="text" name="textBuscar" placeholder="Buscar" autocomplete="off" required />
	<input type="submit" id="submit" value="Buscar" class="btBuscar">
</form>

<!-- MENU  --------------------------------------------------------------------------------- -->
<!-- end MENU -->


<!-- footer  --------------------------------------------------------------------------------- -->
<!--  -->	
<footer id="footer">
	<?php include('fter_pag.php'); ?>

</footer>
<!-- end footer -->	


</body>
</html>