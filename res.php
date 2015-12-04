<?php
include 'sources.php';
echo $_SESSION['first_part'];
echo $_SESSION['nav'];
echo $_SESSION['second_part'];

    $host = $_SERVER['SERVER_NAME'];
    $reg = '/http://'.$host.'//';
    $url = $_SERVER['HTTP_REFERER'];
    $readyStr = trim($url, $reg);

    if(strtolower($readyStr) == strtolower('wayofsolution')) {  
        $round = 10;
        include 'reader.php';

    } else {     
        if (!$_SESSION['round']) {
            $round = 10;
        } else {
            $round = $_SESSION['round'];
        }
/*
Змінні:
	$_SESSION['num_group'] - кількість груп
	$_SESSION['num_fact_'.$i] - кулькість факторів в групі $i
	$_SESSION['fname_'.$i.'_'.$j] - назва $j-го фактору для $i-ї групи
	$_SESSION['fact_vidn_'.$i.'_'.$j] - відношення між факторами $i та $j
	$_SESSION['name_gr_'.$i] - назва $i-ї групи
	$_SESSION['r_vidn_gr_'.$i] - відношення між групою $i та $i+1
	$_SESSION['fact_numeral_'.$i.'_'.$j] - чисельник $j-го фактору $i-ї групи
	$_SESSION['fac_'.$i.'_'.$j.'_val'] - 
	$_SESSION['sum_'.$i] - трацепивидне число параметру F* яке відповідвє $i-й групі
	$_SESSION['znam_'.$i] - знаменник для групи $i
*/

		for ($i=1;$i<=$_SESSION['num_group'];$i++){                             
			for ($j=1;$j<=$_SESSION['num_fact_'.$i];$j++) {	
			$_SESSION['fname_'.$i.'_'.$j]=$_POST['fname_'.$i.'_'.$j];
			$_SESSION['fac_'.$i.'_'.$j.'_val']=$_POST['fac_'.$i.'_'.$j.'_val'];
			}
			for ($j=1;$j<$_SESSION['num_fact_'.$i];$j++) {	
			$_SESSION['fact_vidn_'.$i.'_'.$j]=$_POST['fact_vidn_'.$i.'_'.$j];
			}
		}	              
    } 
    

    //Виведення 
        echo '<p class="text_large_center">'.$_SESSION['company'].'</p>';
	echo '<p class="text_large">Кількість груп факторів - ';
	echo $_SESSION['num_group'].'</p>';
	for ($i=1;$i<=$_SESSION['num_group'];$i++) {
        echo '<p class="text_medium">Група "'.$_SESSION['name_gr_'.$i].'" має факторів - '.$_SESSION['num_fact_'.$i].' '.'</p>';
        for ($j=1;$j<=$_SESSION['num_fact_'.$i];$j++) {
            echo '<p class="text_small">"'.$_SESSION['fname_'.$i.'_'.$j].'" ('.$_SESSION['fac_'.$i.'_'.$j.'_val'].')</p>';
        }
	}
	
	echo '<p class="text_large">Маємо такі залежності між групами :</p>';
    echo '<p class="text_small">"'.$_SESSION['name_gr_1'].'"';
	for ($i=1;$i<$_SESSION['num_group'];$i++) {
        $k=$i+1;
		echo ' <b>&nbsp;&nbsp;'.$_SESSION['r_vidn_gr_'.$i].'&nbsp;&nbsp;</b>"'.$_SESSION['name_gr_'.$k];	
        echo '"';
	}
    echo '</p>';
	echo '<p class="text_large">Маємо такі залежності між факторами:</p>';
        
       
	for ($i=1;$i<=$_SESSION['num_group'];$i++){
        echo '<p class="text_small">';
        echo '"'.$_SESSION['fname_'.$i.'_1'].'"';
        for ($j=1;$j<$_SESSION['num_fact_'.$i];$j++) {
            $k=$j+1;
            echo '<b>&nbsp;&nbsp;'.$_SESSION['fact_vidn_'.$i.'_'.$j].'&nbsp;&nbsp;</b>"'.$_SESSION['fname_'.$i.'_'.$k];
            echo '"';
        }
        echo '</p>';
	}                

//------------------математика
	for ($i=1;$i<=$_SESSION['num_group'];$i++){ 
		$_SESSION['fact_numeral_'.$i.'_'.$_SESSION['num_fact_'.$i]]=1;
		for ($j=$_SESSION['num_fact_'.$i];$j>=2;--$j){
			$k=$j-1; // наступний з кінця
			if ($_SESSION['fact_vidn_'.$i.'_'.$k]=='='){
				$_SESSION['fact_numeral_'.$i.'_'.$k]=$_SESSION['fact_numeral_'.$i.'_'.$j];
			} else if ($_SESSION['fact_vidn_'.$i.'_'.$k]=='>'){
				$_SESSION['fact_numeral_'.$i.'_'.$k]=$_SESSION['fact_numeral_'.$i.'_'.$j]+1;		
			}
		}
	}
        
	for ($i=1;$i<=$_SESSION['num_group'];$i++){
		$_SESSION['znam_'.$i]=0;
		for ($j=1;$j<=$_SESSION['num_fact_'.$i];$j++){
			$_SESSION['znam_'.$i]=$_SESSION['znam_'.$i]+$_SESSION['fact_numeral_'.$i.'_'.$j];
		}
	}

// трапецієвиді числа
	$_SESSION['lvl_1'] = array (0, 0, 0.15, 0.25);
	$_SESSION['lvl_2'] = array (0.15, 0.25, 0.35, 0.45);
	$_SESSION['lvl_3'] = array (0.35, 0.45, 0.55, 0.65);
	$_SESSION['lvl_4'] = array (0.55, 0.65, 0.75, 0.85);
	$_SESSION['lvl_5'] = array (0.75, 0.85, 1, 1);

		
for ($i=1;$i<=$_SESSION['num_group'];$i++) {	
	$_SESSION['sum_'.$i]= array (0, 0, 0, 0);
	for ($j=1;$j<=$_SESSION['num_fact_'.$i];$j++) {		
		switch ($_SESSION['fac_'.$i.'_'.$j.'_val']){
			case 'Дуже низький':
				for ($k=0;$k<=3;$k++){
					$_SESSION['sum_'.$i][$k]=$_SESSION['sum_'.$i][$k]+($_SESSION['fact_numeral_'.$i.'_'.$j]/$_SESSION['znam_'.$i])*$_SESSION['lvl_1'][$k];
				}
				break;
			case 'Низький':
				for ($k=0;$k<=3;$k++){
					$_SESSION['sum_'.$i][$k]=$_SESSION['sum_'.$i][$k]+($_SESSION['fact_numeral_'.$i.'_'.$j]/$_SESSION['znam_'.$i])*$_SESSION['lvl_2'][$k];
				}
				break;
			case 'Середній':
				for ($k=0;$k<=3;$k++){
					$_SESSION['sum_'.$i][$k]=$_SESSION['sum_'.$i][$k]+($_SESSION['fact_numeral_'.$i.'_'.$j]/$_SESSION['znam_'.$i])*$_SESSION['lvl_3'][$k];
				}
				break;
			case 'Високий':
				for ($k=0;$k<=3;$k++){
					$_SESSION['sum_'.$i][$k]=$_SESSION['sum_'.$i][$k]+($_SESSION['fact_numeral_'.$i.'_'.$j]/$_SESSION['znam_'.$i])*$_SESSION['lvl_4'][$k];
				}
				break;
			case 'Дуже високий':
				for ($k=0;$k<=3;$k++){
					$_SESSION['sum_'.$i][$k]=$_SESSION['sum_'.$i][$k]+($_SESSION['fact_numeral_'.$i.'_'.$j]/$_SESSION['znam_'.$i])*$_SESSION['lvl_5'][$k];
				}	
				break;
		}
	}
}

for ($i=1;$i<=$_SESSION['num_group'];$i++) {	
	$_SESSION['temp_'.$i]= array (0, 0, 0, 0);
	for ($j=1;$j<=5;$j++) {
		for ($k=0;$k<=3;$k++){
			$_SESSION['temp_'.$i][$k]=abs($_SESSION['sum_'.$i][$k]-$_SESSION['lvl_'.$j][$k]);
		}	
	$_SESSION['v_'.$i.'_lvl_'.$j]=1-max($_SESSION['temp_'.$i]);
	}
	
	$max=0;
	for ($j=1;$j<=5;$j++) {
		if ($_SESSION['v_'.$i.'_lvl_'.$j]>$max) {
			$max=$_SESSION['v_'.$i.'_lvl_'.$j];
			$ind=$j;
			}	
	}
	$_SESSION['max_'.$i]=$max;
	$_SESSION['ind_'.$i]=$ind;
}
for ($i=1;$i<=$_SESSION['num_group'];$i++) {
	switch ($_SESSION['ind_'.$i]){
			case '1':
				$_SESSION['level_'.$i]='дуже низький';
			break;
			case '2':
				$_SESSION['level_'.$i]='низький';
			break;	
			case '3':
				$_SESSION['level_'.$i]='середній';
			break;	
			case '4':
				$_SESSION['level_'.$i]='високий';
			break;	
			case '5':
				$_SESSION['level_'.$i]='дуже високий';
			break;	
	}				

 
}
$_SESSION['group_numeral_'.$_SESSION['num_group']]=1;

//--знаходження коефіцієнтів Р для груп--
for ($i=$_SESSION['num_group'];$i>=1;--$i) {
    if ($i>1){ 	
        $k=$i-1;    
    };
    if ($_SESSION['r_vidn_gr_'.$k]=='='){
        $_SESSION['group_numeral_'.$k]=$_SESSION['group_numeral_'.$i];
    } else if ($_SESSION['r_vidn_gr_'.$k]=='>'){
        $_SESSION['group_numeral_'.$k]=$_SESSION['group_numeral_'.$i]+1;
    }
}



//--знаходження знаменника для груп--
$gznam=0;
for ($i=1;$i<=$_SESSION['num_group'];$i++) {
	$gznam=$gznam+$_SESSION['group_numeral_'.$i];
}

$_SESSION['gsum']= array (0, 0, 0, 0);
for ($i=1;$i<=$_SESSION['num_group'];$i++) {	
    for ($k=0;$k<=3;$k++){
        $_SESSION['gsum'][$k]=$_SESSION['gsum'][$k]+($_SESSION['group_numeral_'.$i]/$gznam)*$_SESSION['sum_'.$i][$k];
    }
}

$_SESSION['temp']= array (0, 0, 0, 0);
for ($j=1;$j<=5;$j++) {
    for ($k=0;$k<=3;$k++){
        $_SESSION['temp'][$k]=abs($_SESSION['gsum'][$k]-$_SESSION['lvl_'.$j][$k]);
    }
$_SESSION['v_lvl_'.$j]=1-max($_SESSION['temp']);
}

$max=0;
for ($j=1;$j<=5;$j++) {
    if ($_SESSION['v_lvl_'.$j]>$max) {
        $max=$_SESSION['v_lvl_'.$j];
        $ind=$j;
        }
}
$_SESSION['gmax']=$max;
$_SESSION['gind']=$ind;



switch ($_SESSION['gind']){
        case '1':
                        $_SESSION['glevel']='дуже висока';
                        $_SESSION['stan']='дуже низький';
        break;
        case '2':
                        $_SESSION['glevel']='висока';
                        $_SESSION['stan']='низький';
        break;
        case '3':
            $_SESSION['glevel']='середня';
                        $_SESSION['stan']='середній';
        break;
        case '4':
                        $_SESSION['glevel']='низька';
                        $_SESSION['stan']='високий';
        break;
        case '5':
                        $_SESSION['glevel']='дуже низька';
                        $_SESSION['stan']='дуже високий';
        break;	}


echo '<p class="text_medium">Стан підприємства <span class="blue_color"><b>'.$_SESSION['stan'].'</b></span>.<br> ';

for ($i=1;$i<=$_SESSION['num_group'];$i++) {
    echo '<p class="text_medium">Група "'.$_SESSION['name_gr_'.$i].'" має "<span class="red_color">'.$_SESSION['level_'.$i].'</span>" рівень. <br>';
    echo 'Відповідність еталонному рівню '.round($_SESSION['max_'.$i]*100, $round).'%</p>';
}

echo '<p class="text_medium">Ступінь ризику банкрутства підприємства "<span class="blue_color"><b>'.$_SESSION['glevel'].'</b></span>".<br> ';
echo 'Відповідність рівню '.round($_SESSION['gmax']*100, $round).'%</p>';
//--------------тут поставить кнопку на яку привязать інклуд))
include 'writer.php';



//echo '<input  type = "button" class = "save_button_xls" value = "" onclick="self.location.href=\''.$_SESSION['fileNameXLS'].'\'" > ';
echo '<input  type = "button" class = "save_button_xlsx" value = "" onclick="self.location.href=\''.$_SESSION['fileNameXLSX'].'\'" > ';


echo $_SESSION['third_part']; ?>

                <div class="box">
                    <div class="box_title">Опис етапу розв’язування задачі</div>
                    <div class="box_content">
                        <p>У даному вікні подано структурований опис вхідних даних про
                           підприємство, а також виводяться результати обрахунку рівня
                           ризику банкрутства підприємства.
                        </p>
                    </div>

                </div>

<?php echo $_SESSION['fourth_part']; ?>
