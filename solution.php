<?php
include 'sources.php';
echo $_SESSION['first_part'];
echo $_SESSION['nav'];
echo $_SESSION['second_part'];
?>

<FORM  NAME = "num_group_form" ACTION = "num_factors.php" METHOD = "POST"  ENCTYPE = "multipart/form-data">
    Введіть назву підприємства
    <input type="text" name="company" id="company_name" MAXLENGTH = "40" size="40"
           onkeyup="fieldName('company_name', 'nameCompanyCorrect', 'check_name_company', 'green_msg_1', 'red_msg_2')"
           onmousemove="fieldName('company_name', 'nameCompanyCorrect', 'check_name_company', 'green_msg_1', 'red_msg_2')"
           value="">

    <div id="nameCompanyCorrect" class="red_msg_2">поле не повинне бути порожнє</div>

    <div class="left">
        Введіть кількість груп елементів
        <input id="group_num" type="text" name="num_group" MAXLENGTH = "2" size="2"
               onkeyup="checkNum('group_num','group_correct','check_group','green_msg_1','red_msg_2')"
               onmousemove="checkNum('group_num','group_correct','check_group','green_msg_1','red_msg_2')"
               value="">
        <div id="group_correct" class="red_msg_2">число від 1 до 99</div>

        Кількість знаків після коми у результатах:
        <input id="round" type="text" name="round" MAXLENGTH = "2" size="2" value=""
               onkeyup="checkRound()">
        <div class="green_msg_3">за бажанням</div>

        <div class="button">
            <INPUT id="submit_id" class = "sub_button" TYPE = "submit" VALUE = "" NAME = "next" disabled>
        </div>
    </div>

    <input type="hidden" name="check_name_company" id="check_name_company" value="no" />
    <input type="hidden" name="check_group" id="check_group" value="no" />
</FORM>

<?php echo $_SESSION['third_part'];?>

    <div class="box">
        <div class="box_title">Опис етапу розв’язування задачі</div>
        <div class="box_content">
            <p>Для розв’язування даної задачі необхідно вказати назву підприємства (за бажанням),
                для якого розв’язується задача, і кількість груп факторів, які характеризують підприємство.
                Також вказується кількість знаків після коми у результатах обчислень.</p>
        </div>
    </div>

<?php echo $_SESSION['fourth_part'];?>