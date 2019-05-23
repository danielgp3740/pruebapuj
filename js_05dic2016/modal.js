


$(document).ready(function(){
  function alturaModal(){
    var recuadroModal = $('#modalContenido').height();
    //alert(recuadroModal);
		$("#modalContenido .recuadro .dentro").attr('style', 'height:' + recuadroModal + 'px');
  }

	alturaModal();

	$(window).resize(function(e){
    alturaModal();
	});
});
