/********************************************************************************
César Fernández
2017
**********************************************************************************/
function armarModal(ide,medida,ajax,texto,ajax_url,ajax_variables){
	var aleatorio = Math.round(Math.random()*10000);
	crearDivs(medida,aleatorio);
	$("#"+ide).attr("disabled", true);

	//$("#id_elemento").attr("disabled", "disabled");
	//$("#id_elemento").removeAttr("disabled");

	function altura_sobreModal(){
		var alto_sobreModal = $(".sobreModal").height();
		//alert(alto_sobreModal);
		$(".modaAdentro").css({ 'height': alto_sobreModal+'px' });
	}

	$(window).resize(function(e){
		altura_sobreModal();
	});

	function bindingClick(){
		$("#cerrar-modal"+aleatorio).click(function(){
			$("#sobreModal"+aleatorio).fadeOut(200, function(){
				$("#sobrep"+aleatorio).fadeOut(200, function(){
					$("#sobrep"+aleatorio+", #sobreModal"+aleatorio).remove();
				});
				$("#"+ide).attr("disabled", false);
			});
		});
	}

	bindingClick();

	$("#modaAdentro"+aleatorio).html("");

	$(".sobrep").fadeIn(200, function(){
		$(".sobreModal").fadeIn(200);
		altura_sobreModal();
	});


	if(ajax==false){
		$("#modaAdentro"+aleatorio).html(texto);
	}
	else if(ajax==true){
		if(ajax_url === ""){
			alert("Defina el archivo a invocar en el ajax");
			return 0;
		}
		else{
			//console.log(ajax_url + ' //// '  + ajax_variables);
			$.ajax({
				type: "POST",
				url: ajax_url,
				data: ajax_variables,
				cache: false,
				beforeSend: function(){
					$("#modaAdentro"+aleatorio).html("Procesando...");
				},
				success: function(resultado){
					//console.log(typeof resultado);

					if(resultado.trim() == 'cerrarVentana'){
						//alert('cierra!xxxxx!');
						$("#sobreModal"+aleatorio).fadeOut(200, function(){
							$("#sobrep"+aleatorio).fadeOut(200, function(){
								$("#sobrep"+aleatorio+", #sobreModal"+aleatorio).remove();
							});
							$("#"+ide).attr("disabled", false);
						});
					}
					else{
						$("#modaAdentro"+aleatorio).html(resultado);
						$("#load").fadeOut("normal", function() {
							$("#modaAdentro"+aleatorio).html(resultado);
							//$(this).fadeIn("normal");
						});
					}
				}
			});
		}
	}
}


function crearDivs(medida,aleatorio){
	//console.log(medida);
	$html_modal = '<div id="sobrep'+aleatorio+'" class="sobrep" data-codigoalemodal="'+aleatorio+'"></div><div id="sobreModal'+aleatorio+'" class="sobreModal medi'+medida+'"><div id="cerrar-modal'+aleatorio+'"  class="cerrar-modal2"> </div><div id="modaAdentro'+aleatorio+'"  data-codigoalemodal="'+aleatorio+'" class="modaAdentro"></div></div>';
	$("body").append($html_modal);
}

/*
$(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
*/
