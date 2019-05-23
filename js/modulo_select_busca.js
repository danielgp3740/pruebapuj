/******************************************************************************************************************
Ckm!
web; Apps Y Multimedia
www.ckm.co
2015
******************************************************************************************************************/
// JavaScript Document

// SELECT CON BUSCADOR

$(document).ready(function(){
	var config = {
		'.chosen-select'           : {},
		/*
		'.chosen-select-deselect'  : {allow_single_deselect:true},
		'.chosen-select-no-single' : {disable_search_threshold:10},
		'.chosen-select-no-results': {no_results_text:'Lo sentimos, no existen registros!'},
		'.chosen-select-width'     : {width:"95%"}
		*/
	}
	for (var selector in config) {
		$(selector).chosen(config[selector]);
	}
});
