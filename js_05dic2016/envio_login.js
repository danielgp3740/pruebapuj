// JavaScript Document
/*******************************
*	Valida envio el  login     *
*	Creacion 03 de abril 2013  *
*	ANDRES MORENO COLLAZOS     *
********************************/

function validar_asopano(){
	//$("#formulario").validate();


	$("#frm_logueo").validate({
		submitHandler: function(form){


			var user = $('#txt_usuario').val();
			var passwd = $('#txt_clave').val();

			var oculto_srnm=hex_md5(user);
			var oculto_psswd=hex_sha1(passwd);

			//alert('hola: '+ oculto_srnm+'-'+oculto_psswd);




			$.ajax({
				type: "POST",
				//url: 'pmasccso.php',
				url:'acceso',
				data:'user='+oculto_srnm+'&pswd='+oculto_psswd,
				success: function(response)
				{
					response = response.trim();
					if(response == 'acceso_ok'){
						//window.location.replace('prfl_prsona.php');
						window.location.replace('home');
					}
					else{
						//alert(response);
						$('#txt_usuario').val('');
						$('#txt_clave').val('');
						$("#error_loginall").fadeIn(1200);
					}
				}
			});
			/*
			document.frm_logueo.action='acceso.php';
			document.frm_logueo.method='POST';
			document.frm_logueo.submit();
			*/
		}
	});
}
/*


function validar_asopano(){

			//alert('acceso');

			var user = $('#username').val();
			var passwd = $('#passwd').val();

			//alert(user+' - '+passwd);


			var oculto_srnm=hex_md5(user);
			var oculto_psswd=hex_sha1(passwd);

			//alert(oculto_srnm+' - '+oculto_psswd);


			$.ajax({
				type: "POST",
				//url: 'pmasccso.php',
				url:'acceso',
				data:'user='+oculto_srnm+'&pswd='+oculto_psswd,
				success: function(response)
				{
					response = response.trim();
					if(response == 'acceso_ok')
						//window.location.replace('prfl_prsona.php');
						window.location.replace('home');
					else
						//alert(response);
						$("#error_loginall").fadeIn(1200);
				}
			});


}


function SubmitEnter(oEvento, oFormulario){

	//alert("si");
	 var iAscii;

	 if (oEvento.keyCode)
		 iAscii = oEvento.keyCode;
	 else if (oEvento.which)
		 iAscii = oEvento.which;
	 else
		 return false;
	//alert(iAscii);

	 if (iAscii == 13) {
		//oFormulario.submit();
		 validar_asopano();
	 }
	 return true;
}
*/
