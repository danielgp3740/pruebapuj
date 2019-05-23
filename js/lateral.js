
var amount = "270px";

;( function ( $ ) {
	$(document).ready(function() {
		$abierto = $(".sb-slidebar").data("abierto");

		$("#verM").click(function(){			
			console.log($abierto);

			if ( $abierto === false ){
				$('.sb-toggle-left').animate({"left": amount}, 40);
				$(".sb-slidebar").animate({"marginLeft": "0"}, 200);				
				$("#sb-site").animate({"marginLeft": amount}, 200, function(){
					$('.sb-slidebar').css( 'z-index', 10000 );					
				});
				$abierto = true;
			}
			else{
				$('.sb-toggle-left').animate({"left": "0"}, 40);
				$(".sb-slidebar").animate({"marginLeft": "-"+amount}, 200);				
				$("#sb-site").animate({"marginLeft": "0"}, 200, function(){
					$('.sb-slidebar').css( 'z-index', 0 );						
				});
				$abierto = false;
			}
		});
	});
} ) ( jQuery );
