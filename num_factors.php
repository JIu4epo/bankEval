<?php
include 'sources.php';
echo $_SESSION['first_part'];
echo $_SESSION['nav'];
echo $_SESSION['second_part']; ?>
<FORM  NAME = "num_factors" ACTION = "factors.php" METHOD = "POST"  ENCTYPE = "multipart/form-data">
<?php
    echo 'Введіть назви груп факторів:<br>';
    $_SESSION['num_group'] = $_POST['num_group'];
        if ($_SESSION['num_group']) {
            for ($i=1;$i<=$_SESSION['num_group'];$i++){
                        echo 'Група '.$i.'
                                <input type="text" name="name_gr_'.$i.'" id="name_gr_'.$i.'" MAXLENGTH = "50" size="40"
                                    onkeyup="fieldName(\'name_gr_'.$i.'\',\'nameGroupCorrect_'.$i.'\',\'check_name_gr_'.$i.'\',\'green_msg_2\',\'red_msg_3\')"
                                    onmousemove="fieldName(\'name_gr_'.$i.'\',\'nameGroupCorrect_'.$i.'\',\'check_name_gr_'.$i.'\',\'green_msg_2\',\'red_msg_3\')"
                                    value="">
                                , кількість факторів у групі
                                <input type="text" name="num_fact_'.$i.'" id="num_fact_'.$i.'" MAXLENGTH = "2" size="2"
                                    onkeyup="checkNum(\'num_fact_'.$i.'\',\'group_correct_'.$i.'\',\'check_num_fact_'.$i.'\',\'green_msg_5 right\',\'red_msg_5 right\')"
                                    onmousemove="checkNum(\'num_fact_'.$i.'\',\'group_correct_'.$i.'\',\'check_num_fact_'.$i.'\',\'green_msg_5 right\',\'red_msg_5 right\')"
                                    value=""><br>' ;

                        echo '<div id="group_correct_'.$i.'" class="red_msg_5 right">число від 1 до 99</div>';
                        echo '<div id="nameGroupCorrect_'.$i.'" class="red_msg_3">поле не повинне бути порожнє</div>';
                        if ($i<$_SESSION['num_group']) {
                            echo '<span>Група '.$i.'</span>';
                            echo '<INPUT onclick="radioCheck(\'r_vidn_gr_'.$i.'\',\'raioCheck_'.$i.'\',\'check_radio_'.$i.'\',\'green_msg_2\')" TYPE = "radio" NAME = "r_vidn_gr_'.$i.'" VALUE = ">"><i>важливіша</i>';
                            echo '<INPUT onclick="radioCheck(\'r_vidn_gr_'.$i.'\',\'raioCheck_'.$i.'\',\'check_radio_'.$i.'\',\'green_msg_2\')" TYPE = "radio" NAME = "r_vidn_gr_'.$i.'" VALUE = "="><i>рівна</i> ';
                            $l=$i+1;
                            echo ' за групу '.$l.'<br>';
                            echo '<div id="raioCheck_'.$i.'" class="red_msg_3">оберіть один із варіантів</div>';
                            echo '<input type="hidden" name="check_radio_'.$i.'" id="check_radio_'.$i.'" value="no" />';
                        }
                        echo '<input type="hidden" name="check_name_gr_'.$i.'" id="check_name_gr_'.$i.'" value="no" />';
                        echo '<input type="hidden" name="check_num_fact_'.$i.'" id="check_num_fact_'.$i.'" value="no" />';
            }
        }
    $_SESSION['round']=$_POST['round'];
    $_SESSION['company']=$_POST['company'];
    echo '<input type="hidden" name="hid_num_gr" id="hid_num_gr" value="'.$_SESSION['num_group'].'" />';
?>

    <div class="button">
        <INPUT id="submit_id" class = "sub_button" TYPE = "submit" VALUE = "" NAME = "next" disabled>
    </div>
</FORM>

<?php echo $_SESSION['third_part']; ?>
					<div class="box">
						<div class="box_title" onclick="radioCheck('r_vidn_gr_')">Опис етапу розв’язування задачі</div>
						<div class="box_content">
							<p>На даному етапі вказуються назви груп факторів, 
                               кількість факторів у кожній групі, а також вказується важливість
                               (перевага або рівність) кожної групи по відношенню до наступної групи.
                            </p>
						</div>
					</div>
<?php echo $_SESSION['fourth_part']; ?>
