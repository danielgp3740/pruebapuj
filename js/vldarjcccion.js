function validar_ejecucion(){

    var tipoidentificacion_persona=$('#txt_valorejecutado').val();
    //var financiacion=$('input:radio[name=chkestado]:checked').val();
    //var poblacion=$('input:radio[name=chkestado]:checked').val();

    if($('.chkfufi').attr('checked')){
      alert('Seleccionado');
    }
    else{
      alert('no selecciono nada');
      return 0;
    }

    if($('.chkgenero').attr('checked')){
      alert('Seleccionado');
    }
    else{
      alert('no selecciono nada');
      return 0;
    }


    if ($(this).is(':checked') ) {
                alert("Checkbox " + $(this).prop("id") +  " (" + $(this).val() + ") => Seleccionado");
              }
}
