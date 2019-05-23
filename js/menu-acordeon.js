/* *******************************************************************************
CONFIGURACION
ckm.co - 2017
******************************************************************************** */

$(document).ready(function(){
	$(".conteMenu ul li.sub").click, $(".conteMenu ul li.sub").hover(function(){
		//$(this).find("ul").slideToggle("speed");
		//$(".conteMenu ul li.sub ul").slideToggle("slow");

		$(".conteMenu ul li.sub ul").slideUp("normal");
		
		if(!$(this).find("ul").is(":visible")){
			$(this).find("ul").slideDown();
		}
	});
});
