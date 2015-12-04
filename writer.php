<?php

//session_start();
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once 'PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Bankruptcy problem solver")
							 ->setLastModifiedBy("Bankruptcy problem solver")
							 ->setTitle("Bankruptcy problem solution")
							 ->setSubject("Bankruptcy problem solution")
							 ->setDescription("Result document of bankruptcy problem solution")
							 ->setKeywords("Bankruptcy problem")
							 ->setCategory("Ecomonics");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Назва підприємства')
            ->setCellValue('B1', $_SESSION['company']);
//ДОДАЄМО ІНФУ!!
/*
Змінні:
	$_SESSION['num_group'] - кількість груп
	$_SESSION['num_fact_'.$i] - кулькість факторів в групі $i
	$_SESSION['fname_'.$i.'_'.$j] - назва $j-го фактору для $i-ї групи
	$_SESSION['fact_vidn_'.$i.'_'.$j] - відношення між факторами $i та $j
	$_SESSION['name_gr_'.$i] - назва $i-ї групи
	$_SESSION['r_vidn_gr_'.$i] - відношення між групою $i та $i+1
	$_SESSION['fact_numeral_'.$i.'_'.$j] - чисельник $j-го фактору $i-ї групи
	$_SESSION['fac_'.$i.'_'.$j.'_val'] - значення кожного фактору в словесній формі
	$_SESSION['sum_'.$i] - трацепивидне число параметру F* яке відповідвє $i-й групі
	$_SESSION['znam_'.$i] - знаменник для групи $i
*/
//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Назва підприємства');


//$_SESSION['name_gr_1'] = $sheetData[5]['A'];
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Кількість груп');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', $_SESSION['num_group']);

$newPosition = 5;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5', $_SESSION['name_gr_1']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B5', $_SESSION['num_fact_1']);

if ($_SESSION['num_group']>1) {
    for ($i = 2; $i <= $_SESSION['num_group']; $i++) {
        // відрахунок рядків файлу для наступного значення
        $k=$i-1;
        $newPosition = $newPosition + $_SESSION['num_fact_'.$k]*2+3;
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$newPosition, $_SESSION['name_gr_'.$i]);        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$newPosition, $_SESSION['num_fact_'.$i]);

        $_SESSION['wr_firstFactPosition_'.$i] = $newPosition + 1; //позиція комірки з назвою першого фактора в групі
        $_SESSION['wr_firstFactVidnPosition_'.$i] = $newPosition + 2; //позиція комірки з першим відношенням в групі
        $_SESSION['wr_firstGroupVidnPosition_'.$i] = $newPosition - 2; //позиція комірки з другим відношенням між групами
    }
}

//записуємо імена факторів
$_SESSION['wr_firstFactPosition_1']=6;
for ($i = 1; $i <= $_SESSION['num_group']; $i++){
    $k = $_SESSION['wr_firstFactPosition_'.$i];
    for ($j = 1; $j <= $_SESSION['num_fact_'.$i]; $j++){      
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$k, $_SESSION['fname_'.$i.'_'.$j]);        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$k, $_SESSION['fac_'.$i.'_'.$j.'_val']);
            $k+=2;
    }  
$_SESSION['newPosition']=$k;    
}

//записуємо відношення між факторами
$_SESSION['wr_firstFactVidnPosition_1'] = 7;
for ($i = 1; $i <= $_SESSION['num_group']; $i++){
    $n = $_SESSION['wr_firstFactVidnPosition_'.$i];
    for ($j = 1; $j < $_SESSION['num_fact_'.$i]; $j++){
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$n, 'Важливість');        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$n, $_SESSION['fact_vidn_'.$i.'_'.$j]);
        $n+=2;
    }    
}

//запис відношень між групами
//
//Оскільки відклік починається з firstGroupVidnPosition_2, тому для зручності
//тут йде переприсвоєяння значень  $_SESSION['firstGroupVidnPosition_'.$i] щоб 
//відлік починався з індексу 1
//
for ($i = 1; $i <= $_SESSION['num_group']; $i++){   
    $m = $i + 1;
    if ($m <= $_SESSION['num_group']){
        $_SESSION['wr_firstGroupVidnPosition_'.$i] = $_SESSION['wr_firstGroupVidnPosition_'.$m];
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$_SESSION['wr_firstGroupVidnPosition_'.$i], 'Важливість груп');        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$_SESSION['wr_firstGroupVidnPosition_'.$i], $_SESSION['r_vidn_gr_'.$i]);
    }
}

$resPosition = $_SESSION['newPosition'];
//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$resPosition, 'Результати'); 
///////
$objRichText = new PHPExcel_RichText();
$objPayable = $objRichText->createTextRun('Результати');
$objPayable->getFont()->setBold(true);
$objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_DARKGREEN ) );
$objPHPExcel->getActiveSheet()->getCell('A'.$resPosition)->setValue($objRichText);

////////////


$resPosition+=1;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$resPosition, 'Стан підприємства');  
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$resPosition, $_SESSION['stan']); 
//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$resPosition, $_SESSION['newPosition']);
$resPosition+=2;
//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$resPosition, $resPosition);
for ($i=1;$i<=$_SESSION['num_group'];$i++) {
    //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$resPosition, $resPosition);
    $text='Група '.$_SESSION['name_gr_'.$i].' має рівень';
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$resPosition, $text);  
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$resPosition, $_SESSION['level_'.$i]); 
    $resPosition+=1;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$resPosition, 'Відповідність еталонному рівню');  
    $text=($_SESSION['max_'.$i]*100).'%';
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$resPosition, $text);    
    $resPosition+=1;    
}

    
$resPosition+=2; 
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$resPosition, 'Ступінь ризику банкрутства підприємства');  
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$resPosition, $_SESSION['glevel']); 
$resPosition+=1;     
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$resPosition, 'Відповідність рівню'); 
    $text=($_SESSION['gmax']*100).'%';
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$resPosition, $text); 


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Bankruptcy problem solution');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//--------------------тут генерувать імья файла-----------------
$fileNameXlsx = 'excelfiles/xls_'.date('d.m.y_H.i.s').'.xlsx';
$_SESSION['fileNameXLSX']=$fileNameXlsx;
$objWriter->save($fileNameXlsx);

// Save Excel5 file
//$objWriter2 = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//$fileNameXls = 'excelfiles/xls_'.date('d.m.y_H.i.s').'.xls';
//$_SESSION['fileNameXLS']=$fileNameXls;
//
//$objWriter2->save($fileNameXls);


// Save Excel5 file
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//$objWriter->save('myName.xls');
