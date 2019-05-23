<?php

$fecha_generar=date('YmdHis');
/** Incluir la libreria PHPExcel */
require_once 'Classes/PHPExcel.php';
$persona_entidad=$_SESSION['entidad_persona'];
// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();
//$objWorksheet = $objPHPExcel->getActiveSheet();

// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("Cattivo")
->setLastModifiedBy("Cattivo")
->setTitle("Semaforo por Escenario")
->setSubject("Semaforo por Escenario")
->setDescription("Semaforo de Metas de Producto por Escenario.")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Escenarios");

$styleFuenteLetra = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 9,
        'name'  => 'Verdana'
    ),
    'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
  );


$reporte_escenarioentidad=$reportes_sql->reporte_escenarioxentidad($cnxn_pag, $persona_entidad);

$numero_registro=0;
while ($data_escenarioentidad=$cnxn_pag->obtener_filas($reporte_escenarioentidad)) {
    $eac_codigo=$data_escenarioentidad['eac_codigo'];
    $eac_nombre=$data_escenarioentidad['eac_nombre'];
    $eac_descripcion=$data_escenarioentidad['eac_descripcion'];

//    $eac_nombre=str_replace ('y', '', $eac_nombre);
    $eac_nombre=str_replace (' ', '', $eac_nombre);

    if($numero_registro > 0){
      $objPHPExcel->createSheet();
      $objPHPExcel->setActiveSheetIndex($numero_registro);
      $objPHPExcel->getActiveSheet()->setTitle($eac_nombre);
    }
    else{
      $objPHPExcel->getActiveSheet()->setTitle($eac_nombre);
    }

    $sheet = $objPHPExcel->getActiveSheet();
    $sheet->getPageMargins()->setTop(0.6);
    $sheet->getPageMargins()->setBottom(0.6);
    $sheet->getPageMargins()->setHeader(0.4);
    $sheet->getPageMargins()->setFooter(0.4);
    $sheet->getPageMargins()->setLeft(0.4);
    $sheet->getPageMargins()->setRight(0.4);



    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A1', 'No')
    ->setCellValue('B1', 'Sector Administrativo')
    ->setCellValue('C1', 'Programa')
    ->setCellValue('D1', 'Entidad')
    ->setCellValue('E1', 'Meta Resultado')
    ->setCellValue('F1', 'Meta Producto')
    ->setCellValue('G1', 'CodFut')
    ->setCellValue('H1', 'Linea Base')
    ->setCellValue('I1', 'Meta Cuatrenio')
    ->setCellValue('J1', 'Esperado V2016')
    ->setCellValue('K1', 'Ejecutado V2016')
    ->setCellValue('L1', 'Semáforo V2016')
    ->setCellValue('M1', 'Esperado V2017')
    ->setCellValue('N1', 'Ejecutado V2017')
    ->setCellValue('O1', 'Semáforo V2017')
    ->setCellValue('P1', 'Esperado V2018')
    ->setCellValue('Q1', 'Ejecutado V2018')
    ->setCellValue('R1', 'Semáforo V2018')
    ->setCellValue('S1', 'Esperado Cuatrenio')
    ->setCellValue('T1', 'Acumulado')
    ->setCellValue('U1', 'Cumplimiento %');

    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('J1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('K1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('L1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('M1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('N1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('O1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('P1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('Q1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('R1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('S1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('T1')->applyFromArray($styleFuenteLetra);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('U1')->applyFromArray($styleFuenteLetra);


    $reporte_resultadoxproducto=$reportes_sql->reporte_metaresultadoproducto($cnxn_pag, $eac_codigo, $persona_entidad);

    $numero_metapro=1;
    $numero_excel=$numero_metapro+1;

    for($yearv=2016;$yearv<=2018;$yearv++){
          $numerorojo[$yearv]=0;
          $numeronaranja[$yearv]=0;
          $numeroamarillo[$yearv]=0;
          $numeroverde[$yearv]=0;
          $numerovioleta[$yearv]=0;
          $numeroazul[$yearv]=0;
          $numerogris[$yearv]=0;
    }

    while ($data_metaproductoescenario=$cnxn_pag->obtener_filas($reporte_resultadoxproducto)) {
          $mpr_codigo=$data_metaproductoescenario['mpr_codigo'];
          $mpr_descripcion=$data_metaproductoescenario['mpr_descripcion'];
          $mpr_lineabase=$data_metaproductoescenario['mpr_lineabase'];
          $mpr_valorcuatrenio=$data_metaproductoescenario['mpr_valorcuatrenio'];
          $mpr_metaresultado=$data_metaproductoescenario['mpr_metaresultado'];
          $mpr_codificacion=$data_metaproductoescenario['mpr_codificacion'];
          $mpr_indicador=$data_metaproductoescenario['mpr_indicador'];
          $mpr_entidadresponsable=$data_metaproductoescenario['mpr_entidadresponsable'];
          $mpr_personaresponsable=$data_metaproductoescenario['mpr_personaresponsable'];
          $mpr_sectornn=$data_metaproductoescenario['mpr_sectornn'];
          $mpr_odsproducto=$data_metaproductoescenario['mpr_odsproducto'];
          $mpr_tipovalor=$data_metaproductoescenario['mpr_tipovalor'];
          $mpr_codificacionmp=$data_metaproductoescenario['mpr_codificacionmp'];
          $mpr_codificacionmr=$data_metaproductoescenario['mpr_codificacionmr'];
          $mpr_ponderacion=$data_metaproductoescenario['mpr_ponderacion'];
          $mpr_tendenciapositiva=$data_metaproductoescenario['mpr_tendenciapositiva'];
          //$eac_nombre=$data_metaproductoescenario['eac_nombre'];
          $sad_nombre=$data_metaproductoescenario['sad_nombre'];
          $pro_nombre=$data_metaproductoescenario['pro_nombre'];
          $mre_descripcion=$data_metaproductoescenario['mre_descripcion'];
          $ent_nombre=$data_metaproductoescenario['ent_nombre'];
          $ent_codigo=$data_metaproductoescenario['ent_codigo'];


          $objPHPExcel->setActiveSheetIndex($numero_registro)
          ->setCellValue('A'.$numero_excel, $numero_metapro)
          ->setCellValue('B'.$numero_excel, $sad_nombre)
          ->setCellValue('C'.$numero_excel, $pro_nombre)
          ->setCellValue('D'.$numero_excel, $ent_nombre)
          ->setCellValue('E'.$numero_excel, $mre_descripcion)
          ->setCellValue('F'.$numero_excel, $mpr_descripcion)
          ->setCellValue('G'.$numero_excel, $mpr_codificacion)
          ->setCellValue('H'.$numero_excel, $mpr_lineabase)
          ->setCellValue('I'.$numero_excel, $mpr_valorcuatrenio);


          $valor_esperadomp = $principal_sql->valor_esperado($cnxn_pag, $mpr_codigo);

          $valorultimo_esperado=$principal_sql->valor_esperadoultimo($cnxn_pag, $mpr_codigo);
          $data_valorultimoesperado=$cnxn_pag->obtener_filas($valorultimo_esperado);
          $ultimovaloresperado=$data_valorultimoesperado['ves_valor'];

          // INICIO MOSTAR TODOS LOS VALORES DE LA VIGENCIAS POR META DE PRODUCTO

          $valor_allesperadomp = $principal_sql->valor_esperadoall($cnxn_pag, $mpr_codigo);


          $todas_vigencias="";
            $numerovigenciaesperado=1;
            while($data_allvaloresperadomp=$cnxn_pag->obtener_filas($valor_allesperadomp)){
                $ves_vigencia=$data_allvaloresperadomp['ves_vigencia'];
                $ves_valorall[$ves_vigencia]=$data_allvaloresperadomp['ves_valor'];
                $todas_vigencias.=$ves_valorall[$ves_vigencia]." ";
                $valorporvigencia[$ves_vigencia]=$data_allvaloresperadomp['ves_valor'];
                $valorvigenciaesperado[$numerovigenciaesperado]=$data_allvaloresperadomp['ves_valor'];
                $numerovigenciaesperado++;
            }

          // FIN MOSTAR TODOS LOS VALORES DE LA VIGENCIAS POR META DE PRODUCTO

          $baselinea=$mpr_lineabase;
          $valorcuatro=$mpr_valorcuatrenio;

          $totalesperadometa=abs($mpr_valorcuatrenio-$mpr_lineabase);

          $diferencia_valores=abs($mpr_lineabase-$mpr_valorcuatrenio);
          $vigencia_sumatoria=$valorporvigencia[2016]+$valorporvigencia[2017]+$valorporvigencia[2018]+$valorporvigencia[2019];

                // *************** INICIO TIPO DE ORIENTACION ********************* //
                // 1. MANTENIMIENTO
                if($mpr_lineabase==$mpr_valorcuatrenio && $mpr_valorcuatrenio==$valorvigenciaesperado[4]){
                      $tipometaproducto='Ma';
                      $tipometaresul='M';
                      $tipoorientacion='LBMV4';//MetaCuatrenio=LineaBase=vigencia4

                      if($mpr_tendenciapositiva=='1'){
                        $tipometaproducto='Au';
                        $tipometaresul='A';
                      }
                      elseif($mpr_tendenciapositiva=='2'){
                        $tipometaproducto='Re';
                        $tipometaresul='R';
                      }
                }
                elseif($mpr_valorcuatrenio==$valorvigenciaesperado[1] && $mpr_valorcuatrenio==$valorvigenciaesperado[2] && $mpr_valorcuatrenio==$valorvigenciaesperado[3] && $mpr_valorcuatrenio==$valorvigenciaesperado[4]){
                      $tipometaproducto='Ma';
                      $tipometaresul='M';
                      $tipoorientacion='MV1V2V3V4';//MetaCuatreni=vigencia1=vigencia2=vigencia3=vigencia4

                      if($mpr_tendenciapositiva=='1'){
                        $tipometaproducto='Au';
                        $tipometaresul='A';
                      }
                      elseif($mpr_tendenciapositiva=='2'){
                        $tipometaproducto='Re';
                        $tipometaresul='R';
                      }
                }
                elseif ($mpr_lineabase==$mpr_valorcuatrenio && $mpr_valorcuatrenio==$vigencia_sumatoria) {
                      $tipometaproducto='Ma';
                      $tipometaresul='M';
                      $tipoorientacion='LMS';//lineaBase=MetaCuatrenio=sumavigencias

                      if($mpr_tendenciapositiva=='1'){
                        $tipometaproducto='Au';
                        $tipometaresul='A';
                      }
                      elseif($mpr_tendenciapositiva=='2'){
                        $tipometaproducto='Re';
                        $tipometaresul='R';
                      }

                }
                // 2. INCREMENTO
                elseif($mpr_lineabase < $mpr_valorcuatrenio ){
                    if($mpr_valorcuatrenio!=$valorvigenciaesperado[1] && $mpr_valorcuatrenio!=$valorvigenciaesperado[2] && $mpr_valorcuatrenio!=$valorvigenciaesperado[3] && $mpr_valorcuatrenio!=$valorvigenciaesperado[4]){
                      $imgtipo="incremento.png";
                      $tipometa='Aumenta';
                      $orientacion='A';
                      $tipometaproducto='Au';
                      $tipoorientacion='MCDIFERENTE';
                    }
                    elseif($mpr_valorcuatrenio==$valorvigenciaesperado[4]){
                      $imgtipo="incremento.png";
                      $tipometa='Aumenta';
                      $orientacion='A';
                      $tipometaproducto='Au';
                      $tipoorientacion='MCV4';
                    }
                    elseif($mpr_valorcuatrenio==$vigencia_sumatoria){
                      $imgtipo="incremento.png";
                      $tipometa='Aumenta';
                      $orientacion='A';
                      $tipometaproducto='Au';
                      $tipoorientacion='MCSUMATORIA';
                    }
                    elseif($diferencia_valores==$vigencia_sumatoria){
                      $imgtipo="incremento.png";
                      $tipometa='Aumenta';
                      $orientacion='A';
                      $tipometaproducto='Au';
                      $tipoorientacion='DIFERENCIASUMATORIA';
                    }
                    elseif($diferencia_valores==$valorvigenciaesperado[4]){
                      $imgtipo="incremento.png";
                      $tipometa='Aumenta';
                      $orientacion='A';
                      $tipometaproducto='Au';
                      $tipoorientacion='DIFERENCIAV4';
                    }
                    else{
                      $imgtipo="incremento.png";
                      $tipometa='Aumenta';
                      $orientacion='A';
                      $tipometaproducto='Au';
                      $tipoorientacion='LBMCINCREMENTO';
                    }
                }
                // 3. REDUCCION
                elseif($mpr_lineabase > $mpr_valorcuatrenio ){
                    if($mpr_valorcuatrenio!=$valorvigenciaesperado[1] && $mpr_valorcuatrenio!=$valorvigenciaesperado[2] && $mpr_valorcuatrenio!=$valorvigenciaesperado[3] && $mpr_valorcuatrenio!=$valorvigenciaesperado[4]){
                      $imgtipo="diminuye.png";
                      $tipometa='Reducción';
                      $orientacion='R';
                      $tipometaproducto='Re';
                      $tipoorientacion='LBDIFERENTE';
                    }
                    elseif($mpr_valorcuatrenio==$valorvigenciaesperado[4]){
                      $imgtipo="diminuye.png";
                      $tipometa='Reducción';
                      $orientacion='R';
                      $tipometaproducto='Re';
                      $tipoorientacion='LBV4';
                    }
                    elseif($mpr_valorcuatrenio==$vigencia_sumatoria){
                      $imgtipo="diminuye.png";
                      $tipometa='Reducción';
                      $orientacion='R';
                      $tipometaproducto='Re';
                      $tipoorientacion='LBSUMATORIA';
                    }
                    elseif($diferencia_valores==$vigencia_sumatoria){
                      $imgtipo="diminuye.png";
                      $tipometa='Reducción';
                      $orientacion='R';
                      $tipometaproducto='Re';
                      $tipoorientacion='LBDIFERENCIAVIGENCIA';
                    }
                    elseif($diferencia_valores==$valorvigenciaesperado[4]){
                      $imgtipo="diminuye.png";
                      $tipometa='Reducción';
                      $orientacion='R';
                      $tipometaproducto='Re';
                      $tipoorientacion='LBDIFERENCIAV4';
                    }
                    else{
                      $imgtipo="diminuye.png";
                      $tipometa='Reducción';
                      $orientacion='R';
                      $tipometaproducto='Re';
                      $tipoorientacion='LBMCDISMINUYE';
                    }
                }


                  // *************** FIN TIPO DE ORIENTACION ********************* //


              if($mpr_codigo=='20161113060927475' || $mpr_codigo=='20161129060927502'){
                  $tipometaproducto='Re';
                  $tipometaresul='R';
              }

              if($mpr_codigo=='2016111306092518'){
                $orientacion='A';
                $tipometaproducto='Au';

              }
        /*
        Hacienda 20161113060927475 40.5 - 80
                  20161129060927502 7.25 - 40
        20161113060927476 acumulado es rojo 88.91 - 89
        */

        if($mpr_descripcion=='Indicador de endeudamiento "Sostenibilidad", dentro de los límites de viabilidad fiscal' || $mpr_descripcion=='Inidicador de solvencia dentro de los límites de la viabilidad fiscal'){
          $mpr_valorcuatrenio=$baselinea;
        }
        else{
          $mpr_valorcuatrenio=$valorcuatro;
        }

          $vigencia_numero=1;
          $colorvigencia=0;
          $letra = 74;

          $valoracumuladoejecutado=0;
          $valoracumuladoesperado=0;
          $valoracumuladovigencias=0;


            while($data_valoresperado=$cnxn_pag->obtener_filas($valor_esperadomp)){
              $ves_codigo=$data_valoresperado['ves_codigo'];
              $ves_metaproducto=$data_valoresperado['ves_metaproducto'];
              $ves_tipovalor=$data_valoresperado['ves_tipovalor'];
              $ves_valor=$data_valoresperado['ves_valor'];
              $ves_vigencia=$data_valoresperado['ves_vigencia'];

              $column = chr($letra);

              //$acumulado_ejecutadomp = $principal_sql->valor_ejecutadovigenciamp($cnxn_pag, $mpr_codigo, $ves_vigencia);
              if($ent_codigo==12){
                $acumulado_ejecutadomp = $principal_sql->valor_ejecutadovigenciampsalud($cnxn_pag, $mpr_codigo, $ves_vigencia);
              }
              else{
                $acumulado_ejecutadomp = $principal_sql->valor_ejecutadovigenciamp($cnxn_pag, $mpr_codigo, $ves_vigencia);
              }

              $datavalor_ejecutadomp= $cnxn_pag->obtener_filas($acumulado_ejecutadomp);
              $valorejecutadomp=$datavalor_ejecutadomp['total_vigenciamp'];

              if($datavalor_ejecutadomp['total_vigenciamp']){
                $valorejecutadomp=$datavalor_ejecutadomp['total_vigenciamp'];
              }
              else{
                $valorejecutadomp=0;
              }

              $valor_esperadomepro[$vigencia_numero]=$ves_valor;
              $valor_esperado=$valor_esperadomepro[1];
              //$color_semaforomp = $semaforomepro->semaforomp($cnxn_pag, $ves_vigencia, $codigoentidad, $ves_metaproducto, $valor_esperado);
              //list($valorpromedio_semaforo, $letro_logro, $colorcirculo_semaforo, $colorvigencia, $entrovalore)=$semaforomepro->semaforomp($cnxn_pag, $ves_vigencia, $ent_codigo, $ves_metaproducto, $ves_valor,$mpr_valorcuatrenio, $mpr_tendenciapositiva, $mpr_lineabase);
              list($valorpromedio_semaforo, $letro_logro, $colorcirculo_semaforo, $colorvigencia, $entrovalore)=$semaforomepro->semaforomp($cnxn_pag, $ves_vigencia, $codigoentidad, $ves_metaproducto, $ves_valor,$mpr_valorcuatrenio, $mpr_tendenciapositiva, $mpr_lineabase, $tipometaproducto);


              if($colorvigencia=='rojo'.$ves_vigencia){
                  $numerorojo[$ves_vigencia]=$numerorojo[$ves_vigencia]+1;
              }
              elseif($colorvigencia=='naranja'.$ves_vigencia){
                  $numeronaranja[$ves_vigencia]=$numeronaranja[$ves_vigencia]+1;
              }
              elseif($colorvigencia=='amarillo'.$ves_vigencia){
                  $numeroamarillo[$ves_vigencia]=$numeroamarillo[$ves_vigencia]+1;
              }
              elseif($colorvigencia=='verde'.$ves_vigencia){
                  $numeroverde[$ves_vigencia]=$numeroverde[$ves_vigencia]+1;
              }
              elseif($colorvigencia=='violeta'.$ves_vigencia){
                  $numerovioleta[$ves_vigencia]=$numerovioleta[$ves_vigencia]+1;
              }
              elseif($colorvigencia=='azul'.$ves_vigencia){
                  $numeroazul[$ves_vigencia]=$numeroazul[$ves_vigencia]+1;
              }
              elseif($colorvigencia=='gris'.$ves_vigencia){
                  $numerogris[$ves_vigencia]=$numerogris[$ves_vigencia]+1;
              }

              if($ves_valor==$mpr_valorcuatrenio){
                $valoracumuladoesperado=$ves_valor;
                $valoracumuladoejecutado=$valorejecutadomp;
                $totalesperadometa=0;
              }
              else {
                $valoracumuladoesperado=$valoracumuladoesperado+$ves_valor;
                $valoracumuladoejecutado=$valoracumuladoejecutado+$valorejecutadomp;
              }

              $valoracumuladovigencias=$valoracumuladovigencias+$valorejecutadomp;
/*
              if($mpr_descripcion=='Magnitud de la inversión Pública/Gasto Total'){
                if($mpr_lineabase > $valor_ejecutado){
                  $colorcirculo_semaforo="red";
                }
              }
*/

              if($mpr_descripcion=='Magnitud de la inversión Pública/Gasto Total' || $mpr_descripcion=='Porcentaje de Evaluación MECI'){
                if ($mpr_lineabase > $valorejecutadomp) {
                  $colorcirculo_semaforo="red";
                  $valorpromedio_semaforo=abs($valorpromedio_semaforo);
                }
                else {
                  $colorcirculo_semaforo="green";
                  $valorpromedio_semaforo=abs($valorpromedio_semaforo);
                }

              }

              if($mpr_descripcion=="Transferencias Nacionales+SGR/Gasto Total" && $colorcirculo_semaforo=="green"){
                $valorpromedio_semaforo=($valorpromedio_semaforo+100);
                //$positivosigno="+";
              }
              elseif($mpr_descripcion=="Transferencias Nacionales+SGR/Gasto Total" && $colorcirculo_semaforo=="red"){
                $valorpromedio_semaforo=($valorpromedio_semaforo+100);
              }


              $objPHPExcel->setActiveSheetIndex($numero_registro)
              ->setCellValue($column.$numero_excel, $ves_valor);

              $letra=$letra+1;
              $column = chr($letra);

              $objPHPExcel->setActiveSheetIndex($numero_registro)
              ->setCellValue($column.$numero_excel, $valorejecutadomp);

              $letra=$letra+1;
              $column = chr($letra);
              $colorcirculosemaforo=$colorcirculo_semaforo;
              $imgsemaforo="img/".$colorcirculosemaforo."semaforo.png";
              $objPHPExcel->setActiveSheetIndex($numero_registro)
              ->setCellValue($column.$numero_excel, $valorpromedio_semaforo);


              $objDrawing = new PHPExcel_Worksheet_Drawing();
              $objDrawing->setName('PHPExcel logo');
              $objDrawing->setDescription('PHPExcel logo');
              $objDrawing->setPath($imgsemaforo);
              $objDrawing->setHeight(18);
              $objDrawing->setCoordinates($column.$numero_excel);
              $objDrawing->setOffsetX(30);
              $objDrawing->setOffsetY(4);
              $objDrawing->setWorksheet($objPHPExcel->getActiveSheet($numero_excel));




              $letra++;
            }

            //////////////////////////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////////   INICIO CALCULO DE ACUMULADO /////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////////////////////
            /***/
            /***/
            /***/              $positivosigno="";
            /***/              // Inicio Operacion de acumulados
            /***/              switch ($tipoorientacion) {
            /***/                // INICIO MATENIMIENTO
            /***/                case 'LBMV4':
            /***/                    $totalesperadometa=$valorvigenciaesperado[4];
            /***/                    $valoracumuladoejecutado=$valorejecutadomp;
            /***/                    if($mpr_valorcuatrenio==0 && $valoracumuladoejecutado==0){
            /***/                      $cumplimientovigencias=100;
            /***/                    }
            /***/                    else{
            /***/                      if($mpr_tendenciapositiva=='1'){
            /***/                        $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            /***/                      }
            /***/                      elseif($mpr_tendenciapositiva=='2') {
            /***/                        $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado)*100 , 2, '.', '');
            /***/                      }
            /***/                    }
            /***/
            /***/                break;
            /***/
            /***/                case 'MV1V2V3V4':
            /***/                    $totalesperadometa=$mpr_valorcuatrenio;
            /***/                    $valoracumuladoejecutado=$valorejecutadomp;
            /***/                    $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            /***/                break;
            /***/
            /***/                case 'LMS':
            /***/                    $totalesperadometa=$mpr_valorcuatrenio;
            /***/                    $valoracumuladoejecutado=$valoracumuladovigencias;
            /***/                    $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            /***/                break;
            /***/                // FIN MATENIMIENTO
            /***/
            /***/                //INICIO INCREMENTO
            /***/                case 'MCDIFERENTE':
            /***/                    $totalesperadometa=$diferencia_valores;
            /***/                    $valoracumuladoejecutado=$valoracumuladovigencias;
            /***/                    if($mpr_codigo=='20161113060927475' || $mpr_codigo=='20161129060927502'){
            /***/                        $valoracumuladoejecutado=$valorejecutadomp;
            /***/                        $totalesperadometa=$mpr_lineabase;
            /***/                        $positivosigno="+";
            /***/                    }
            /***/                    else {
            /***/                        $positivosigno="";
            /***/                    }
            /***/                    $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            /***/                break;
            /***/
            /***/                case 'MCV4':
            /***/                    $totalesperadometa=$valorvigenciaesperado[4];
            /***/                    $valoracumuladoejecutado=$valorejecutadomp;
            /***/                    $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            /***/                break;
            /***/
            /***/                case 'MCSUMATORIA':
            /***/                    $totalesperadometa=$vigencia_sumatoria;
            /***/                    $valoracumuladoejecutado=$valoracumuladovigencias;
            /***/                    $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            /***/                break;
            /***/
            /***/                case 'DIFERENCIASUMATORIA':
            /***/                    $totalesperadometa=$diferencia_valores;
            /***/                    $valoracumuladoejecutado=$valoracumuladovigencias;
            /***/                    $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            /***/                break;
            /***/
            /***/                case 'DIFERENCIAV4':
            /***/                    $totalesperadometa=$valorvigenciaesperado[4];
            /***/                    $valoracumuladoejecutado=$valoracumuladovigencias;
            /***/                    $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            /***/                break;
            /***/
            /***/                case 'LBMCINCREMENTO':
            /***/                    $totalesperadometa=$diferencia_valores;
            /***/                    $valoracumuladoejecutado=$valoracumuladovigencias;
            /***/                    $vigenciaigual = array_search($mpr_valorcuatrenio, $valorvigenciaesperado); // buscar valor igua en el array
            /***/
            /***/                    if($valorvigenciaesperado[$vigenciaigual]==$mpr_valorcuatrenio){
            /***/                      $caso=1;
            /***/                      $totalesperadometa=$mpr_valorcuatrenio;
            /***/                    }
            /***/                    else{
            /***/                      $totalesperadometa=$diferencia_valores;
            /***/                      $valoracumuladoejecutado=$valoracumuladovigencias;
            /***/                    }
            /***/
            /***/                    $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            /***/                break;
            /***/
            /***/                //FIN INCREMENTO
            /***/
            /***/                //INICIO REDUCCION
            /***/                case 'LBDIFERENTE':
            /***/                    $totalesperadometa=$diferencia_valores;
            /***/                    $valoracumuladoejecutado=$valoracumuladovigencias;
            /***/                    if($mpr_descripcion=='ESEs con Proyectos elaborados de Infraestructura'){
            /***/                      $totalesperadometa=$mpr_valorcuatrenio;
            /***/                    }
            /***/                    else{
            /***/                      $totalesperadometa=$diferencia_valores;
            /***/                    }
            /***/                    $cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            /***/                break;
            /***/
            /***/                case 'LBV4':
            /***/                    $totalesperadometa=$valorvigenciaesperado[4];
            /***/                    $valoracumuladoejecutado=$valorejecutadomp;
            /***/                    if($valoracumuladoejecutado==0){
            /***/                      $cumplimientovigencias=0;
            /***/                    }
            /***/                    else{
            /***/                      $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado)*100 , 2, '.', '');
            /***/                    }
            /***/                    if($cumplimientovigencias>50){
            /***/                      $cumplimientovigencias=$cumplimientovigencias-100;
            /***/                     }
            /***/
            /***/                    //$cumplimientovigencias=number_format(($valoracumuladoejecutado/$totalesperadometa)*100 , 2, '.', '');
            /***/                break;
            /***/
            /***/                case 'LBSUMATORIA':
            /***/                    $totalesperadometa=$vigencia_sumatoria;
            /***/                    $valoracumuladoejecutado=$valoracumuladovigencias;
            /***/                    $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado)*100 , 2, '.', '');
            /***/                break;
            /***/
            /***/                case 'LBDIFERENCIAVIGENCIA':
            /***/                    $totalesperadometa=$diferencia_valores;
            /***/                    $valoracumuladoejecutado=$valoracumuladovigencias;
            /***/                    $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado)*100 , 2, '.', '');
            /***/                break;
            /***/
            /***/                case 'LBDIFERENCIAV4':
            /***/                    $totalesperadometa=$valorvigenciaesperado[4];
            /***/                    $valoracumuladoejecutado=$valoracumuladovigencias;
            /***/                   $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado)*100 , 2, '.', '');
            /***/                break;
            /***/
            /***/                case 'LBMCDISMINUYE':
            /***/                    $totalesperadometa=$diferencia_valores;
            /***/                    $valoracumuladoejecutado=$valoracumuladovigencias;
            /***/                    $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado)*100 , 2, '.', '');
            /***/                break;
            /***/
            /***/                //FIN
            /***/
            /***/              }
            /***/              // Fin Operacion de acumulados
            /***/
            /***/
            /***/            if($tipometaproducto=='Re'){
            /***/                if($totalesperadometa < $valoracumuladoejecutado  ){
            /***/                    $colorcirculoacu_semaforo="red";
            /***/                    $positivosigno="";
            /***/                }
            /***/                else{
            /***/                  $colorcirculoacu_semaforo="green";
            /***/                  if($cumplimientovigencias==0){
            /***/                      $cumplimientovigencias=100;
            /***/                    }
            /***/                   elseif($cumplimientovigencias<100){
            /***/                      $cumplimientovigencias=$cumplimientovigencias+100;
            /***/                    }
            /***/                    elseif($cumplimientovigencias>200){
            /***/                      $cumplimientovigencias=100;
            /***/                     }
            /***/
            /***/                  if($cumplimientovigencias > 0 && $cumplimientovigencias < 100){
            /***/                    $positivosigno="+";
            /***/                  }
            /***/                  else {
            /***/                    $positivosigno="";
            /***/                  }
            /***/
            /***/                  $entreee='verrrr';
            /***/                }
            /***/            }
            /***/            elseif($tipometaproducto=='Au') {
            /***/              if($cumplimientovigencias < 0 ){
            /***/                  $colorcirculoacu_semaforo="red";
            /***/              }
            /***/              elseif($cumplimientovigencias >= 0 && $cumplimientovigencias <= 40){
            /***/                    $colorcirculoacu_semaforo="red";
            /***/              }
            /***/              elseif($cumplimientovigencias > 40 && $cumplimientovigencias <= 60){
            /***/                    $colorcirculoacu_semaforo="orange";
            /***/              }
            /***/              elseif($cumplimientovigencias > 60 && $cumplimientovigencias < 80){
            /***/                    $colorcirculoacu_semaforo="yellow";
            /***/              }
            /***/              elseif($cumplimientovigencias >= 80 && $cumplimientovigencias <= 100 ){
            /***/                  $colorcirculoacu_semaforo="green";
            /***/              }
            /***/              else {
            /***/                  $colorcirculoacu_semaforo="viol";
            /***/              }
            /***/            }
            /***/
            /***/
            /***/              if($mpr_descripcion=='Magnitud de la inversión Pública/Gasto Total'){
            /***/                if($mpr_lineabase > $valoracumuladoejecutado){
            /***/                  $colorcirculoacu_semaforo="red";
            /***/                  $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado), 2, '.', '');
            /***/                  $positivosigno="";
            /***/                }
            /***/                elseif($mpr_lineabase < $valoracumuladoejecutado){
            /***/                    $colorcirculoacu_semaforo="green";
            /***/                    $cumplimientovigencias=number_format(($totalesperadometa/$valoracumuladoejecutado), 2, '.', '');
            /***/                    $cumplimientovigencias=$cumplimientovigencias+100;
            /***/                    $positivosigno="";
            /***/                }
            /***/
            /***/
            /***/              }
            /***/
            /***/              if($mpr_descripcion=="Transferencias Nacionales+SGR/Gasto Total" && $colorcirculoacu_semaforo=="green"){
            /***/                $cumplimientovigencias=($cumplimientovigencias+100)-100;
            /***/                //$positivosigno="+";
            /***/              }
            /***/
            /***/              if($mpr_descripcion=='Asistencia funeraria para la población víctima, en apoyo a municipios'){
            /***/                if($valoracumuladoejecutado < $mpr_lineabase){
            /***/                  $colorcirculoacu_semaforo="green";
            /***/                }
            /***/              }
            ///////////////////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////   FIN CALCULO DE ACUMULADO /////////////////////////////////////
            ///////////////////////////////////////////////////////////////////////////////////////////////
                        $imgsemaforoacumalado="img/".$colorcirculoacu_semaforo."semaforo.png";

                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue('S'.$numero_excel, $totalesperadometa)
                        ->setCellValue('T'.$numero_excel, $valoracumuladoejecutado)
                        ->setCellValue('U'.$numero_excel, $positivosigno.abs($cumplimientovigencias));

                        $objDrawing = new PHPExcel_Worksheet_Drawing();
                        $objDrawing->setName('PHPExcel logo');
                        $objDrawing->setDescription('PHPExcel logo');
                        $objDrawing->setPath($imgsemaforoacumalado);
                        $objDrawing->setHeight(18);
                        $objDrawing->setCoordinates('U'.$numero_excel);
                        $objDrawing->setOffsetX(30);
                        $objDrawing->setOffsetY(4);
                        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet($numero_excel));

          $numero_metapro++;
          $numero_excel++;


          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('F')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('G')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('H')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('I')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('J')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('K')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('L')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('M')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('N')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('O')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('P')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('Q')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('R')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('S')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('T')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('U')->setAutoSize(true);
          $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_metapro)->setRowHeight(20);

          //$objPHPExcel->getRowDimension('1')->setRowHeight(-1);



    }

    //$objPHPExcel->getActiveSheet()->getColumnDimension()->setAutoSize(true);
  $numero_finalregistro=$numero_excel;

  for($yearv=2016;$yearv<=2018;$yearv++){
    $numero_finalregistro=$numero_finalregistro+2;
    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A'.$numero_finalregistro, $yearv);

    $numero_finalregistro=$numero_finalregistro+1;
    $numerograficainicio=$numero_finalregistro;
    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A'.$numero_finalregistro, "CRITICO ")
    ->setCellValue('B'.$numero_finalregistro, $numerorojo[$yearv]);

    $numero_finalregistro=$numero_finalregistro+1;
    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A'.$numero_finalregistro, "BAJO")
    ->setCellValue('B'.$numero_finalregistro, $numeronaranja[$yearv]);

    $numero_finalregistro=$numero_finalregistro+1;
    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A'.$numero_finalregistro, "MEDIO")
    ->setCellValue('B'.$numero_finalregistro, $numeroamarillo[$yearv]);

    $numero_finalregistro=$numero_finalregistro+1;
    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A'.$numero_finalregistro, "CUMPLIDO")
    ->setCellValue('B'.$numero_finalregistro, $numeroverde[$yearv]);

    $numero_finalregistro=$numero_finalregistro+1;
    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A'.$numero_finalregistro, "SUPERO META CUATRENIO")
    ->setCellValue('B'.$numero_finalregistro, $numerovioleta[$yearv]);

    $numero_finalregistro=$numero_finalregistro+1;
    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A'.$numero_finalregistro, "EJECUTADA SIN PLANEAR")
    ->setCellValue('B'.$numero_finalregistro, $numeroazul[$yearv]);

    $numero_finalregistro=$numero_finalregistro+1;
    $numerograficafinal=$numero_finalregistro;
    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A'.$numero_finalregistro, "NO PROGRAMADA ")
    ->setCellValue('B'.$numero_finalregistro, $numerogris[$yearv]);

    ///---------------------------GRAFICOS ----------------------------------------//////

    // definir origem dos rótulos das colunas
    $categories = array(new PHPExcel_Chart_DataSeriesValues('String', $eac_nombre.'!$A$'.$numerograficainicio.':$A$'.$numerograficafinal,NULL,7));

    // definir origem dos valores
    $values = array(new PHPExcel_Chart_DataSeriesValues('Number', $eac_nombre.'!$B$'.$numerograficainicio.':$B$'.$numerograficafinal, NULL, 7));


    // definir dados a mostrar no gráfico
    $series = new PHPExcel_Chart_DataSeries(
      PHPExcel_Chart_DataSeries::TYPE_BARCHART, // tipo de gráfico
      PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,
      array(0),
      array(),
      $categories, // rótulos das colunas
      $values // valores
    );
    $series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

    // inicializar o layout do gráfico e área do gráfico
    $layout = new PHPExcel_Chart_Layout();
    $plotarea = new PHPExcel_Chart_PlotArea($layout, array($series));

    // inicializar o gráfico
    $chart = new PHPExcel_Chart('Vigencia', null, null, $plotarea);

    // definir título do gráfico
    $title = new PHPExcel_Chart_Title(null, $layout);
    $title->setCaption($eac_nombre.': Vigencia '.$yearv);

    // definir posição do gráfico e título
    $graficavalorfinal=$numerograficafinal+20;
    $chart->setTopLeftPosition('E'.$numerograficainicio);
    $chart->setBottomRightPosition('F'.$graficavalorfinal);
    $chart->setTitle($title);

    // adicionar o gráfico à folha
    $sheet->addChart($chart);

    ///---------------------------FIN GRAFICOS ----------------------------------------//////

}


    $numero_registro++;
}




// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);



// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Semaforo_escenario_entidad_'.$fecha_generar.'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// incluir o gráfico no ficheiro que vamos gerar
$objWriter->setIncludeCharts(TRUE);
ob_end_clean();
$objWriter->save('php://output');
exit;
?>
