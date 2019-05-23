<?php

	
	$sql_portada="SELECT cnt_codigo, cnt_titulo, cnt_introduccion, cnt_desarrollo, cnt_seccion, 
       				   cnt_subseccion, per_codigo, cnt_fecharedaccion, cnt_fechapublicacion, 
					   pri_codigo, cnt_urlcorta, cnt_palabrasclaves, cnt_periodista
				 FROM contenido
				 WHERE pri_codigo=1
				 ORDER BY cnt_fecharedaccion ASC
				 LIMIT 1 OFFSET 0; ";
	$query_portada=$cnxn_pag->ejecutar($sql_portada);



?>