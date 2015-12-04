<?php
include 'sources.php';
echo $_SESSION['first_part'];
echo $_SESSION['nav'];
echo $_SESSION['second_part'];
?>

<FORM  NAME = "factors" ACTION = "res.php" METHOD = "POST"  ENCTYPE = "multipart/form-data">
<?php
    echo '<br>';
    $var = $_SESSION['num_group'];
    if ($var) {
        for ($i=1;$i<=$var;$i++){
                echo '<p class="text_large_center">Група '.$_POST['name_gr_'.$i].'</p><br>';
                for ($j=1;$j<=$_POST['num_fact_'.$i];$j++) {
                    echo '
                        Введіть назву фактору '.$i.'.'.$j.'
                            <input
                                type="text"
                                id = "fname_'.$i.'_'.$j.'"
                                name="fname_'.$i.'_'.$j.'"
                                MAXLENGTH = "30" size="24"
                                onkeyup="fieldName(\'fname_'.$i.'_'.$j.'\',\'nameFactorCorrect_'.$i.'_'.$j.'\',\'check_name_fac_'.$i.'_'.$j.'\',\'green_msg_1\',\'red_msg_2\')"
                                onmousemove="fieldName(\'fname_'.$i.'_'.$j.'\',\'nameFactorCorrect_'.$i.'_'.$j.'\',\'check_name_fac_'.$i.'_'.$j.'\',\'green_msg_1\',\'red_msg_2\')"
                                value = ""
                            >
                        і його рівень
                            <select
                                id="fac_'.$i.'_'.$j.'_val"
                                name="fac_'.$i.'_'.$j.'_val"
                                onclick="selectBoxCheck(\'fac_'.$i.'_'.$j.'_val\',\'selectBoxFlag_'.$i.'_'.$j.'\',\'check_box_'.$i.'_'.$j.'\',\'green_msg_5 right\',\'red_msg_5 right\')">
                                    <option selected disabled>Оберіть рівень</option>
                                    <option value="Дуже низький">Дуже низький</option>
                                    <option value="Низький">Низький</option>
                                    <option value="Середній">Середній</option>
                                    <option value="Високий">Високий</option>
                                    <option value="Дуже високий">Дуже високий</option>
                            </select>
                        <br>';

                    echo '<div id="selectBoxFlag_'.$i.'_'.$j.'" class="red_msg_5 right">оберіть один із варіантів</div>';
                    echo '<div id="nameFactorCorrect_'.$i.'_'.$j.'" class="red_msg_2">поле не повинне бути порожнє</div>';
                    if ($j<$_POST['num_fact_'.$i]){
                        echo 'Верхній фактор';
                        echo '<INPUT onclick="radioCheck(\'fact_vidn_'.$i.'_'.$j.'\',\'raioCheck_'.$i.'_'.$j.'\',\'check_radio_'.$i.'_'.$j.'\',\'green_msg_2\')" TYPE = "radio" NAME = "fact_vidn_'.$i.'_'.$j.'" VALUE = ">">важливіший';
                        echo '<INPUT onclick="radioCheck(\'fact_vidn_'.$i.'_'.$j.'\',\'raioCheck_'.$i.'_'.$j.'\',\'check_radio_'.$i.'_'.$j.'\',\'green_msg_2\')" TYPE = "radio" NAME = "fact_vidn_'.$i.'_'.$j.'" VALUE = "=">рівний<br>';
                        echo '<div id="raioCheck_'.$i.'_'.$j.'" class="red_msg_3">оберіть один із варіантів</div>';
                        echo '<input type="hidden" name="check_radio_'.$i.'_'.$j.'" id="check_radio_'.$i.'_'.$j.'" value="no" />';
                    } else
                            echo '<br>';

                        echo '<input type="hidden" name="check_box_'.$i.'_'.$j.'" id="check_box_'.$i.'_'.$j.'" value="no" />';
                        echo '<input type="hidden" name="check_name_fac_'.$i.'_'.$j.'" id="check_name_fac_'.$i.'_'.$j.'" value="no" />';
                }
        }
    }
    for ($i=1;$i<=$_SESSION['num_group'];$i++) {
	    $_SESSION['name_gr_'.$i]=$_POST['name_gr_'.$i];
	    $_SESSION['num_fact_'.$i]=$_POST['num_fact_'.$i];
    }
    for ($i=1;$i<$_SESSION['num_group'];$i++) {
	    $_SESSION['r_vidn_gr_'.$i]=$_POST['r_vidn_gr_'.$i];
    }
?>
    <div class="button">
    <INPUT id="submit_id" class = "sub_button" TYPE = "submit" VALUE = "" NAME = "next" disabled>
    </div>
</FORM>

<?php echo $_SESSION['third_part']; ?>
					<div class="box">
						<div class="box_title">Опис етапу розв’язування задачі</div>
						<div class="box_content">
							<p>На даному етапі вказуються назви всіх факторів кожної групи, рівень, 
                               який характеризує кожен фактор, виражений у словесній формі: «Дуже низький»,
                               «Низький», …., при цьому вищий показник – кращий, наприклад, рівень
                               «Середній» краще за рівень «Низький». Також вказується важливість
                               (перевага або рівність) кожного фактора по відношенню до наступного фактора групи.
                            </p>
						</div>
					</div>
<?php echo $_SESSION['fourth_part']; ?>
