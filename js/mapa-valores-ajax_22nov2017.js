/********************************************************************************
César Fernández
2017
**********************************************************************************/
$(document).ready(function(){
	$("a.infMpio").click(function(){
		$(".encimaModal").fadeIn(300, function(){
			$(".encima").fadeIn(300);
		});
	});

});

/*
	$.ajax({
        //data:  params,
        url:   'ajax/factorial.php',
        dataType: 'html',
        type:  'post',
        beforeSend: function(){
            //mostramos gif "cargando"
            jQuery('#loading_spinner').show();
            //antes de enviar la petición al fichero PHP, mostramos mensaje
            jQuery("#resultado").html("Déjame pensar un poco...");
        },
        success:  function (response) {
            //escondemos gif
            jQuery('#loading_spinner').hide();
            //mostramos salida del PHP
            jQuery("#sb-site").html(response);
        }
    });
*/
