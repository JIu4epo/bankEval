<?php
//session_start();
error_reporting(E_ALL);
//set_time_limit(0);

date_default_timezone_set('Europe/London');



/** Include path **/
//set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';
//print_r($_FILES['fileupload']);
if(is_uploaded_file($_FILES['fileupload']['tmp_name'])) {
    $UploadedFileName = $_FILES['fileupload']['name'];
    $pos = strrpos($UploadedFileName, '.');
    $readyName =  substr($UploadedFileName, 0, $pos);
    $readyStr = $readyName.date('d.m.y_H.i.s').'.xls';
	move_uploaded_file($_FILES['fileupload']['tmp_name'],"excelfiles/".$readyStr);
        //echo "ok";
}
$inputFileName = 'excelfiles/'.$readyStr;
//echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);


//echo '<hr />';

$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

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

$_SESSION['company'] = $sheetData[1]['B'];
$_SESSION['num_group'] = $sheetData[3]['B'];
$_SESSION['name_gr_1'] = $sheetData[5]['A'];
//комірка з кількістю елементів в першій групі
$newPosition = 5;
//кількість факторів у групі 1
$_SESSION['num_fact_1'] = $sheetData[$newPosition]['B'];
//кількість факторів у кожній наступній групі
if ($_SESSION['num_group']>1) {
    for ($i = 2; $i <= $_SESSION['num_group']; $i++) {
        // відрахунок рядків файлу для наступного значення
        $newPosition = $newPosition + $sheetData[$newPosition]['B']*2 + 3;
        $_SESSION['num_fact_'.$i] = $sheetData[$newPosition]['B'];
        $_SESSION['firstFactPosition_'.$i] = $newPosition + 1; //позиція комірки з назвою першого фактора в групі
        $_SESSION['firstFactVidnPosition_'.$i] = $newPosition + 2; //позиція комірки з першим відношенням в групі
        $_SESSION['firstGroupVidnPosition_'.$i] = $newPosition - 2; //позиція комірки з другим відношенням між групами
        $_SESSION['name_gr_'.$i] = $sheetData[$newPosition]['A'];
    }
}



//вибираємо імена факторів
$_SESSION['firstFactPosition_1']=6;
for ($i = 1; $i <= $_SESSION['num_group']; $i++){
    $k = $_SESSION['firstFactPosition_'.$i];
    for ($j = 1; $j <= $_SESSION['num_fact_'.$i]; $j++){
            $_SESSION['fname_'.$i.'_'.$j] = $sheetData[$k]['A'];
            $_SESSION['fac_'.$i.'_'.$j.'_val'] = $sheetData[$k]['B'];
            $k+=2;
    }    
}

//вибірка відношень між факторами
$_SESSION['firstFactVidnPosition_1'] = 7;
for ($i = 1; $i <= $_SESSION['num_group']; $i++){
    $n = $_SESSION['firstFactVidnPosition_'.$i];
    for ($j = 1; $j < $_SESSION['num_fact_'.$i]; $j++){
            $_SESSION['fact_vidn_'.$i.'_'.$j] = $sheetData[$n]['B'];
            $n+=2;
    }    
}

//вибірка відношень між групами
//
//Оскільки відклік починається з firstGroupVidnPosition_2, тому для зручності
//тут йде переприсвоєяння значень  $_SESSION['firstGroupVidnPosition_'.$i] щоб 
//відлік починався з індексу 1
//
for ($i = 1; $i <= $_SESSION['num_group']; $i++){   
    $m = $i + 1;
    if ($m <= $_SESSION['num_group']){
        $_SESSION['firstGroupVidnPosition_'.$i] = $_SESSION['firstGroupVidnPosition_'.$m];
        $_SESSION['r_vidn_gr_'.$i] = $sheetData[$_SESSION['firstGroupVidnPosition_'.$i]]['B'];
    }
}

unlink($inputFileName);
//unlink($readyStr);
?>
