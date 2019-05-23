/********************************************************************************
César Fernández
2017
**********************************************************************************/

jQuery(document).ready(function(){
	$('#mapaHuila').vectorMap({
		map: 'mapHuila',
		onRegionClick: function(event, code, name){
				verMpio(code, name);
		},
		showTooltip: true,
		enableZoom: false,
		backgroundColor: '#004610',

	})
});

//---------------------------------------------------------

var ver_destacado = 0;

$(document).ready(function(){
	//$("#mapaHuila").css({ "height":$(".dentro").height()-40 });
	/*
	$(".dentro").mouseout(function(){
		$("#escenarios, #sectores, #entidades, #programas").animate({left: "110%"}, 600);
	});
	*/

	$("#sectGral td.verVentana").click(function(){
		$("#sectores").animate({left: "3%"}, 600); // COLOCAR AL CARGAR EN EL AJAX

		var codigo_escenario=$(this).data("escenario");
		var nameescenario=$(this).data("nameescenario");

		var muncodigo=0;
		var name_municipio='Departamento del Huila';


		$("#sectores").animate({left: "3%"}, 600); // COLOCAR AL CARGAR EN EL AJAX

		//alert('sectores-escenario:'+codigo_escenario);

		$.ajax({
			url:"mapasectormunicipio",
			type:"POST",
			data:"codigo_municipio="+muncodigo+"&name_municipio="+name_municipio+"&codigo_escenario="+codigo_escenario+"&nameescenario="+nameescenario,
			async:true,

			success: function(message){
				$("#sectores").empty().append(message);
			}
		});
	});

	$("#escenarios td.verVentana").click(function(){
		console.log($(this).data("escenario"));

		$("#sectores").animate({left: "3%"}, 600); // COLOCAR AL CARGAR EN EL AJAX

	});

	$("#escenarios .volver-modal").click(function(){
		//alert('escenarioooo cerrarr');
		ver_destacado = 0;
		ocultarDestacado();

		$("#escenarios").animate({left: "110%"}, 400);
	});

	$("#sectores td.verVentana").click(function(){
		$("#programas").animate({left: "3%"}, 600); // COLOCAR AL CARGAR EN EL AJAX
	});

	$("#sectores .volver-modal").click(function(){
		ver_destacado = 0;
		ocultarDestacado();

		$("#sectores").animate({left: "110%"}, 400);
	});


	$("#programas td.verVentana").click(function(){
		$("#entidades").animate({left: "3%"}, 600); // COLOCAR AL CARGAR EN EL AJAX
	});

	$("#programas .volver-modal").click(function(){
		ver_destacado = 0;
		ocultarDestacado();

		$("#programas").animate({left: "110%"}, 400);
	});


	$("#entidades .volver-modal").click(function(){
		ver_destacado = 0;
		ocultarDestacado();

		$("#entidades").animate({left: "110%"}, 400);
	});



	$(".destacados ul li span").click(function(){
		console.log($(this).data("codestacado"));

		var codigo_foto=$(this).data("codestacado");
		var muncodigo='<?php echo $muncodigo; ?>';

		$.ajax({
			url:"mapafoto",
			type:"POST",
			data:"codigo_municipio="+muncodigo+"&codigo_foto="+codigo_foto,
			async:true,

			success: function(message){
				$("#verDestacado").empty().append(message);
			}
		});

		ver_destacado = 1;
		ocultarDestacado(); // COLOCAR AL CARGAR EN EL AJAX
	});

	$("#verDestacado .cerrar-modal").click(function(){
		ocultarDestacado();
	});
});

$(window).on("load resize ", function(){
	$("#escenarios .titulo").css({ "width": $("#escenarios").width()+2 });
	$("#sectores .titulo").css({ "width": $("#sectores").width()+2 });
	//$(".escenarios .titulo").css({ "width": $(".escenarios .titulo").parent().width() });
}).resize();

function ocultarDestacado(){
	if(ver_destacado == 0){
		$("#verDestacado").slideUp(200);
		ver_destacado = 1;
	}
	else{
		$("#verDestacado").slideDown(200);
		ver_destacado = 0;
	}
}

//---------------------------------------------------------

function verMpio(code, name){
	//alert("verMpio: " + code);
	var municipio_code=code;
	var nombremunicipio=name;
	$("#escenarios").animate({left: "2%"}, 600);
	//alert('escenarios');


	$.ajax({
		url:"mapaescenariomunicipio",
		type:"POST",
		data:"codigo_municipio="+municipio_code+"&name_municipio="+nombremunicipio,
		async:true,

		success: function(message){
			$("#escenarios").empty().append(message);
			//$("#modalContenido").html("<h2>El M/pio seleccionado es: " + code + "</h2>");

			/*$(".encima").fadeIn(300, function(){
				$(".encimaModal").fadeIn(300);
			});*/
		}
	});

}

//---------------------------------------------------------
