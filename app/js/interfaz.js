/* *******************************************************************************
CONFIGURACION
ckm.co - 2017
******************************************************************************** */

$(document).ready(function(){
	//MENU ICONOS DERECHA
	var verHelp = 1;
	$("#men-help").click(function(){
		if(verHelp == 0){
			$(this).removeClass("open");
			//$(this).removeClass("ver");
			$(this).next().slideUp(200);
			verHelp = 1;
		}
		else{
			$(this).addClass("open");
			$(this).next().slideDown(200);
			verHelp = 0;
		}
		//$(this).next().slideToggle("fast");
	});

	//AREA USUARIO
	$("#fotoUsu").click(function(){
		$(this).prev().slideToggle("fast");
	});

	//PONER ICONOS A LOS BOTONES
	var ids = $('input.image').map(function(){
		var icono = $(this).data('icono');
		//alert(icono);
		$(this).css({'background-image': 'url(img/iconos/' + icono + ')'});
		/*
		var titulo = $("#"+this.id).data('titulo');
		$("#"+this.id).html('<div>'+titulo+'</div><img src="interfaz/geo.png" class="ico" /><br /><img src="interfaz/geo_sombra.png" class="som" />');
		$("#"+this.id).css( { "margin-top" : $("#"+this.id).data('top')+"px", "margin-left" : $("#"+this.id).data('left')+"px" } );
		return this.id;
		*/
	}).get();

	var ids = $('a.image').map(function(){
		var icono = $(this).data('icono');
		$(this).css({'background-image': 'url(img/iconos/' + icono + ')'});
	}).get();
});
