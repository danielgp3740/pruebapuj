$(document).ready(function(){
	// CONTACTO
	"use strict";

	$("#form_contacto").validate({
		rules:{ 
			txtNombres:{
				required: true,
				minlength: 5,
				maxlength: 30,
				},				
			txtTel:{
				required: true,
				digits: true,
				minlength: 7,
				maxlength: 12,
				},
			email:{
				required: true,
				email: true,
			},
		},
		messages:{
				txtNombres:{
					required: "Por favor digite sus Nombres y Apellidos.",
					minlength: "Por favor revise sus Nombres y Apellidos, demasiado corto.",
					maxlength: "Por favor revise sus Nombres y Apellidos, demasiado largo."
				},
				txtTel:{
					required: "Por favor digite sólo números.",
					digits: "Por favor digita un número válido.",
					minlength: "Por favor revise el número, demasiado corto.",
					maxlength: "Por favor revise el número, demasiado largo."
				}, 
				email:{
					required: "Se necesita un email de contacto.",
					email: "Email incorrecto, digitelo en formato name@domain.com"
				}, 
		},

		debug: true,
		//errorContainer: $('#errores'),

		submitHandler: function(form){
			$("#ajax_loader").fadeIn();
			//alert( $('#send').val() );

			// EMAIL
			var dataString = "nombre="+escape($('#txtNombres').val())+
							 "&telefono="+escape($('#txtTel').val())+
							 "&email="+escape($('#email').val())+
							 "&email="+escape($('#email').val())+
							 "&email="+escape($('#email').val())+
							 "&comentario="+escape($('#txtComentario').val());

			$.ajax({
				type: "POST",
				url: $('#send').val()+"forma.php",
				data: dataString,
				success: function(data){
					//$("#ajax_loader").html(data);
					$("#ajax_loader").html(data);
					$("#submit").attr("disabled", "disabled");
					$("#submit").addClass("desac");
					//$("#form_contacto center").slideUp();
				}
			});
		}
	});
	errorElement: "div class='alerta'";
	//$(".form_register form").resetForm();

});
