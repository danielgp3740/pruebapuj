<?php

$fecha_generar=date('YmdHis');
/** Incluir la libreria PHPExcel */
require_once 'Classes/PHPExcel.php';
//$persona_entidad=$_SESSION['entidad_persona'];
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
  $numero_registro=0;
  $numero_excel=0;
  $numero_metapro=1;

  /*if($numero_registro > 0){
    $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex($numero_registro);
    $objPHPExcel->getActiveSheet()->setTitle($eac_nombre);
  }
  else{
  */
    $objPHPExcel->getActiveSheet()->setTitle('Prueba Reporte');
  //}

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
  ->setCellValue('G1', 'Linea Base')
  ->setCellValue('H1', 'Meta Cuatrenio')
  ->setCellValue('I1', 'Esperado V2016')
  ->setCellValue('J1', 'Ejecutado V2016')
  ->setCellValue('K1', 'Semáforo V2016')
  ->setCellValue('L1', 'Esperado V2017')
  ->setCellValue('M1', 'Ejecutado V2017')
  ->setCellValue('N1', 'Semáforo V2017');



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
  $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_metapro)->setRowHeight(20);



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
