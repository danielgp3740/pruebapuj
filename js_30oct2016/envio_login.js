// JavaScript Document
/*******************************
*	Valida envio el  login     *
*	Creacion 03 de abril 2013  *
*	ANDRES MORENO COLLAZOS     *
********************************/
/*

		$(document).ready(function() {

			$('#username').clearField({
				blurClass: 'clearFieldBlurred',
				activeClass: 'clearFieldActive'
			});
			
			$('#passwd').clearField({
				blurClass: 'clearFieldBlurred',
				activeClass: 'clearFieldActive'
			});
						
		});
		
*/		
		
function validar_asopano(){
			
			//alert('acceso');
			
			var user = $('#username').val();
			var passwd = $('#passwd').val();

			//alert(user+' - '+passwd);

			
			var oculto_srnm=hex_md5(user);
			var oculto_psswd=hex_sha1(passwd);
			
			//alert(oculto_srnm+' - '+oculto_psswd);
			

			if(user==''){
				$('#respuesta_usuario').css('display','block');
				$('#respuesta_usuario').fadeIn(1200);
				//alert('error usuario');
				return false;
			}
			else{
				$('#respuesta_usuario').css('display','none');
			}

			
			if(passwd == ''){
				$('#respuesta_password').fadeIn(1200);
				return false;
			}
			else{
				$('#respuesta_password').css('display','none');
			}
			

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
