/********************************************************************************
César Fernández
2017
**********************************************************************************/
$(document).ready(function(){

	$(".cerrar-modal").click(function() {
		$(".encimaModal").fadeOut(300, function(){
			$(".encima").fadeOut(300);
		});
	});

	$(".encima").click(function() {
		$(".encimaModal").fadeOut(300, function(){
			$(".encima").fadeOut(300);
		});
	});
});

//---------------------------------------------------------

function verMpio(code){
	//var urlMpio = code.split('_');
	var urlMpio = code.replace('_id', '');
	console.log(urlMpio + " //verMpio: " + code);

	$("#infMapa").slideUp(300, function(){
		$("#infMapa").html('<h3>El M/pio seleccionado es: ' + code + '</h3><div class="mapaMpio" style="background-image:url(img/municipios/colombia_id.png)"></div>');
		$("#infMapa").slideDown(300);
	});

	/*
	$.ajax({
		type: "POST",
		url: "ver_municipio.html",
		data: "prodcod="+prodcod,
		success: function(resultado){
			$("#infMapa").slideUp(300, function(){
				$(this).html(resultado);
				$(this).slideDown(300);
			});
		}
	});
	*/
}

//---------------------------------------------------------

$(function(){
	$('#mapaHuila').vectorMap({
		map: 'map',
		zoomOnScroll: false,
		zoomButtons : true,
		onRegionClick: function(event, code){
			verMpio(code);
		},
	
		backgroundColor: '#CCCCCC', //b3d1ff
		series:{
		regions: [{
			values: {"campoalegre_id":"1","colombia_id":"2","baraya_id":"3","villavieja_id":"4","aipe_id":"5","tello_id":"6","neiva_id":"7","palermo_id":"8","rivera_id":"9","santa-maria_id":"10","iquira_id":"12","teruel_id":"13","yaguara_id":"15","hobo_id":"16","algeciras_id":"17","nataga_id":"18","tesalia_id":"19","paicol_id":"20","gigante_id":"21","la-plata_id":"22","el-pital_id":"23","la-argentina_id":"24","agrado_id":"25","garzon_id":"26","tarqui_id":"27","salado-blanco_id":"28","oporapa_id":"29","altamira_id":"30","elias_id":"31","timana_id":"32","suaza_id":"33","san-agustin_id":"34","isnos_id":"35","pitalito_id":"36","palestina_id":"37","acevedo_id":"38","guadalupe_id":"39"},
			scale: ['#4e967d', '#893AD3', '#66C2A5', '#FC8D62', '#8DA0CB', '#D470A5', '#A6D854', '#488E78', '#0FAE33', '#BFBB32', '#8DA0CB', '#66C2A5','#d0a355' ,'#dccd57','#9db69f','#ffe978','#f7e9a1','#c79d3c','#f5934b','#bfb778','#65865f','#84add0','#ea6199','#299888','#1fa223','#f3de74','#aeceb5','#e5f378','#c88fe4','#f3c196','#a4dc84','#146592','#ea7c7c','#8b78c3','#e4c520','#b6a3da','#eacc56','#09b567','#c17b7b'], // LISTADO DE COLORES
			normalizeFunction: 'polynomial'
			}]
		},
	
		regionStyle:{
			initial:{		
				fill:"#f4f3f0",
				stroke:"#CCCCCC",		
				"stroke-width":3,
				"stroke-opacity":1		
			},
	
			hover:{
				fill:"#999999",		
				"fill-opacity":"1"
			}
		}
	})
});
