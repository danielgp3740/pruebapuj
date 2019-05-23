/******************************************************************************************************************
Ckm!
Web, Apps & Multimedia
www.ckm.co
2016
******************************************************************************************************************/
$(document).ready(function(){
	$(".acor_btn").addClass("cierra");

	//$('.acor_btn').click(function(){
	$(".acor_btn").click(function(event){
		event.preventDefault();		

		if( $(this).attr("class") == "acor_btn cierra"){
			$('div.acor_conte').slideUp('normal');
			$(".acor_btn").removeClass("open").addClass("cierra");

			//$(this).next().slideDown('normal');
			$(this).next().slideDown("normal", function(){
				$("html, body").animate({ scrollTop: ($(this).offset().top)-70 }, 200);
			});
			$(this).removeClass("cierra").addClass("open");
		}
		else if( $(this).attr("class") == "acor_btn open"){
			//$(this).next().slideUp('normal');
			$(this).next().slideUp("normal", function(){
				$("html, body").animate({ scrollTop: $(this).offset().top }, 200);
			});

			$(this).removeClass("open").addClass("cierra");
		}

		//$(this).scrollTop(300);
		//$("html, body").animate({ scrollTop: 0 }, "slow");
		//alert ($(this).scrollTop());
	//	$("html, body").animate({ scrollTop: ($(this).offset().top)-30 }, 300);
	// ESTE ES	$("html, body").animate({ scrollTop: $(this).offset().top }, 300);
		
		//alert ( $(this).offset().top + ' // ' + $(this).position.top );
	});
	$("div.acor_conte").hide();
});

