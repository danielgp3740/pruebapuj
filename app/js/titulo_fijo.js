/******************************************************************************************************************
Ckm!
Web, Apps & Multimedia
www.ckm.co
2016
******************************************************************************************************************/
function ancho_titulo(){
	var ancho_encimaModal = $(".encimaModal").width()-30;
	//alert(' ::: ' + ancho_encimaModal);
	$("#titulo.titulo").css({ 'width': +ancho_encimaModal+'px' });
}

$(window).resize(function(){
	ancho_titulo();
});

ancho_titulo();
