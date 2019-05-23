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
->setTitle("Plan de Desarrollo")
->setSubject("Plan de Desarrollo")
->setDescription("Plan de Desarrollo.")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Plan de Desarrollo Dptal");

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
    $eac_nombrereal=$data_escenarioentidad['eac_nombre'];
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
    ->setCellValue('B1', 'Codigo Escenario')
    ->setCellValue('C1', 'Escenario')
    ->setCellValue('D1', 'Codigo Sector Administrativo')
    ->setCellValue('E1', 'Sector Administrativo')
    ->setCellValue('F1', 'Codigo Programa')
    ->setCellValue('G1', 'Programa')
    ->setCellValue('H1', 'Codigo Entidad')
    ->setCellValue('I1', 'Entidad')
    ->setCellValue('J1', 'Codigo Meta Resultado')
    ->setCellValue('K1', 'Meta Resultado')
    ->setCellValue('L1', 'Codigo Meta Producto')
    ->setCellValue('M1', 'Meta Producto');


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


    $reporte_resultadoxproducto=$reportes_sql->reporte_metaresultadoproducto($cnxn_pag, $eac_codigo, $persona_entidad);

    $numero_metapro=1;
    $numero_excel=$numero_metapro+1;


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
          $sad_codigo=$data_metaproductoescenario['sad_codigo'];
          $sad_nombre=$data_metaproductoescenario['sad_nombre'];
          $pro_codigo=$data_metaproductoescenario['pro_codigo'];
          $pro_nombre=$data_metaproductoescenario['pro_nombre'];
          $mre_descripcion=$data_metaproductoescenario['mre_descripcion'];
          $ent_nombre=$data_metaproductoescenario['ent_nombre'];
          $ent_codigo=$data_metaproductoescenario['ent_codigo'];


          $objPHPExcel->setActiveSheetIndex($numero_registro)
          ->setCellValue('A'.$numero_excel, $numero_metapro)
          ->setCellValue('B'.$numero_excel, $eac_codigo)
          ->setCellValue('C'.$numero_excel, $eac_nombrereal)
          ->setCellValue('D'.$numero_excel, $sad_codigo)
          ->setCellValue('E'.$numero_excel, $sad_nombre )
          ->setCellValue('F'.$numero_excel, $pro_codigo)
          ->setCellValue('G'.$numero_excel, $pro_nombre)
          ->setCellValue('H'.$numero_excel, $ent_codigo)
          ->setCellValue('I'.$numero_excel, $ent_nombre)
          ->setCellValue('J'.$numero_excel, $mpr_metaresultado)
          ->setCellValue('K'.$numero_excel, $mre_descripcion)
          ->setCellValue('L'.$numero_excel, $mpr_codigo)
          ->setCellValue('M'.$numero_excel, $mpr_descripcion);

          $valor_esperadomp = $principal_sql->valor_esperado($cnxn_pag, $mpr_codigo);

          $vigencia_numero=1;
          $colorvigencia=0;
          $letra = 73;

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
          $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_metapro)->setRowHeight(20);

          //$objPHPExcel->getRowDimension('1')->setRowHeight(-1);



    }

  $numero_registro++;
}








// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);



// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="PDD_escenario_entidad_'.$fecha_generar.'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// incluir o gráfico no ficheiro que vamos gerar
$objWriter->setIncludeCharts(TRUE);
ob_end_clean();
$objWriter->save('php://output');
exit;
?>
