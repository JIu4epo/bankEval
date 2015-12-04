<?php
include 'sources.php';
echo $_SESSION['first_part'];
echo $_SESSION['nav'];
echo $_SESSION['second_part'];
?>
<div>
    <FORM  id ="formWayOfSolution" NAME = "wayOfSolutionForm" ACTION = "solution.php" METHOD = "POST"  ENCTYPE = "multipart/form-data">
    <div>
        <INPUT onclick ="changeIcon()" onchange="wayOfSolutionF()" TYPE = "radio" NAME = "wayOfSolutionRadio" VALUE = "1" checked>    
        Ввести вхідні дані вручну<br>
    </div>
    <div>
        <INPUT  onclick ="changeIcon()" onchange="wayOfSolutionF('wayOfSolutionRadio', 'formWayOfSolution')" TYPE = "radio" NAME = "wayOfSolutionRadio" VALUE = "2">
        Завантажити вхідні дані з файлу 
        <input onchange="HandleBrowseClick()" type="file" id="browse" name="fileupload" style="display: none" />
        <img id="ok_img" src = "/img/not_ok.png">
        <img id="fakeBrowse" onclick="HandleBrowseClick()" src = "/img/choose_grey.png"><br>
    </div>
    <div class="button">                                                    
        <INPUT id="submit_id" onclick="wayOfSolutionF('wayOfSolutionRadio', 'formWayOfSolution')" class = "sub_button_green" TYPE = "submit" VALUE = "" NAME = "next">
    </div>
    </FORM>
</div>


<?php
echo $_SESSION['third_part'];
echo $_SESSION['fourth_part'];



//<input type="text" id="filename" readonly="true"/>
//echo '<INPUT TYPE = "file" id = "fileButton" NAME = "inputFile" ACCEPT = "text/plain" value = "обра"><br>';
?>
