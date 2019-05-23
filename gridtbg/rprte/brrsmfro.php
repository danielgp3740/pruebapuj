<?php
//barras rojas

class BarrasSemaforo{

    function barrasrojas($numerorojo, $numero_eaclista, $yearvigencia){
      $numero_eaclista=$numero_eaclista-1;
      $barra_rojo='';
      //for ($yearvigencia=2016; $yearvigencia <= 2017; $yearvigencia++) {
          $numero_rojo=$numerorojo[$yearvigencia];
          $porcentaje_rojo=($numero_rojo/$numero_eaclista)*100;
          $resta_rojo=100-$porcentaje_rojo;




          $barra_rojo.= '
          <div class="colu">
             <h6>&nbsp;</h6>
                <div style="height:'.$resta_rojo.'%" class="b-roja"></div>
                <div class="rojo" style="height:'.$porcentaje_rojo.'%">
                </div>
                <p class="percent"> &nbsp; </p>
          </div>
          ';
      //}


      return $barra_rojo;
    }

    function barrasnaranja($numeronaranja,$numeroamarillo, $numero_eaclista, $yearvigencia){
      $numero_eaclista=$numero_eaclista-1;
      $barra_naranja='';
      //for ($yearvigencia=2016; $yearvigencia <= 2017; $yearvigencia++) {
          $numero_naranja=$numeronaranja[$yearvigencia];
          $porcentaje_naranja=($numero_naranja/$numero_eaclista)*100;
          $resta_naranja=100-$porcentaje_naranja;

          $numero_amarillo=$numeroamarillo[$yearvigencia];
          $porcentaje_amarillo=($numero_amarillo/$numero_eaclista)*100;
          $resta_amarillo=100-$porcentaje_amarillo;

          $resta_naranjaamarrillo=100-($porcentaje_amarillo+$porcentaje_naranja);

          $barra_naranja.= '
              <div class="colu">
                   <h6><strong>'.$yearvigencia.'</strong></h6>
                     <div style="height:'.$resta_naranjaamarrillo.'%" class="b-amarillo"></div>
                     <div class="amarillo" style="height:'.$porcentaje_amarillo.'%"></div>
                     <div class="naranja" style="height:'.$porcentaje_naranja.'%"></div>
                     <p class="percent"> &nbsp; </p>
                     <p class="percent"> &nbsp; </p>
             </div>
          ';
      //}


      return $barra_naranja;
    }

    function barrasamarillo($numeroamarillo, $numero_eaclista){
      $numero_eaclista=$numero_eaclista-1;
      $barra_amarillo='';
      //for ($yearvigencia=2016; $yearvigencia <= 2017; $yearvigencia++) {
          $numero_amarillo=$numeroamarillo[$yearvigencia];
          $porcentaje_amarillo=($numero_amarillo/$numero_eaclista)*100;
          $resta_amarillo=100-$porcentaje_amarillo;

          $barra_amarillo.= '
              <div class="colu amarillo">
                <h6>&nbsp;</h6>
                <div style="height:'.$resta_amarillo.'%" class="b-amarillo"></div>
                <div class="color" style="height:'.$porcentaje_amarillo.'%"></div>
                <span style="font-weight:bold; margin-top:10px; font-size:120%">'. round($porcentaje_amarillo,2).'% = '.$numero_amarillo.'</span>
              </div>
          ';
      //}


      return $barra_amarillo;
    }

    function barrasverde($numeroverde,$numerovioleta,$numeroazul,$numero_eaclista,$yearvigencia){
    $numero_eaclista=$numero_eaclista-1;
    $barra_verde='';
    //for ($yearvigencia=2016; $yearvigencia <= 2017; $yearvigencia++) {
        $numero_verde=$numeroverde[$yearvigencia];
        $porcentaje_verde=($numero_verde/$numero_eaclista)*100;
        $resta_verde=100-$porcentaje_verde;

        $numero_violeta=$numerovioleta[$yearvigencia];
        $porcentaje_violeta=($numero_violeta/$numero_eaclista)*100;
        $resta_violeta=100-$porcentaje_violeta;

        $numero_azul=$numeroazul[$yearvigencia];
        $porcentaje_azul=($numero_azul/$numero_eaclista)*100;
        $resta_azul=100-$porcentaje_azul;

        $resta_vva=100-($porcentaje_verde+$porcentaje_violeta+$porcentaje_azul);

        $barra_verde.= '
            <div class="colu">
                <h6>&nbsp;</h6>
                <div style="height:'.$resta_vva.'%" class="b-verde"></div>
                <div class="verde" style="height:'.$porcentaje_verde.'%"></div>
                <div class="violeta" style="height:'.$porcentaje_violeta.'%"></div>
                <div class="azul" style="height:'.$porcentaje_azul.'%"></div>
                <p class="percents"> &nbsp; </p>
                <p class="percents"> &nbsp; </p>
                <p class="percents"> &nbsp; </p>
            </div>
        ';
  //  }


    return $barra_verde;
    }

    function barrasvioleta($numerovioleta, $numero_eaclista){
    $numero_eaclista=$numero_eaclista-1;
    $barra_violeta='';
    for ($yearvigencia=2016; $yearvigencia <= 2017; $yearvigencia++) {
        $numero_violeta=$numerovioleta[$yearvigencia];
        $porcentaje_violeta=($numero_violeta/$numero_eaclista)*100;
        $resta_violeta=100-$porcentaje_violeta;

        $barra_violeta.= '
            <div class="colu violeta">
              <h6>&nbsp;</h6>
              <div style="height:'.$resta_violeta.'%" class="b-violeta"></div>
              <div class="color" style="height:'.$porcentaje_violeta.'%" ></div>
              <span style="font-weight:bold; margin-top:10px; font-size:120%">'. round($porcentaje_violeta,2).'% = '.$numero_violeta.'</span>
            </div>
        ';
    }


    return $barra_violeta;
    }

    function barrasazul($numeroazul, $numero_eaclista){
    $numero_eaclista=$numero_eaclista-1;
    $barra_azul='';
    for ($yearvigencia=2016; $yearvigencia <= 2017; $yearvigencia++) {
        $numero_azul=$numeroazul[$yearvigencia];
        $porcentaje_azul=($numero_azul/$numero_eaclista)*100;
        $resta_azul=100-$porcentaje_azul;

        $barra_azul.= '
            <div class="colu azul">
              <h6>&nbsp;</h6>
              <div style="height:'.$resta_azul.'%" class="b-azul"></div>
              <div class="color" style="height:'.$porcentaje_azul.'%" ></div>
              <span style="font-weight:bold; margin-top:10px; font-size:120%">'. round($porcentaje_azul,2).'% = '.$numero_azul.'</span>
            </div>
        ';
    }


    return $barra_azul;
    }

    function barrasgris($numerogris, $numero_eaclista, $yearvigencia){
    $numero_eaclista=$numero_eaclista-1;
    $barra_gris='';
    //for ($yearvigencia=2016; $yearvigencia <= 2017; $yearvigencia++) {
        $numero_gris=$numerogris[$yearvigencia];
        $porcentaje_gris=($numero_gris/$numero_eaclista)*100;
        $resta_gris=100-$porcentaje_gris;

        $barra_gris.= '
            <div class="colu">
              <h6>&nbsp;</h6>
              <div style="height:'.$resta_gris.'%" class="b-gris"></div>
              <div class="gris" style="height:'.$porcentaje_gris.'%"><p class="percent"> &nbsp; </p></div>
            </div>
          ';
    //}


    return $barra_gris;
    }

}

?>
