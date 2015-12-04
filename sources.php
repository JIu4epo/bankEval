<?php
session_start();
 $_SESSION['first_part'] = '
<!DOCTYPE html>
<html>
    <head>
            <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
            <meta name="author" content="Borys Tkachenko" />

            <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />

            <link rel="SHORTCUT ICON" href="img/favicon.ico" type="image/x-icon">

            <title>Прогнозування бункрутства підприємства</title>
            <script type="text/javascript" src="js/js.js"></script>
    </head>

    <body onload="currentPage()">

            <div id="base">
                <div id="header">
                    <div id="title">
                                <a  href="index.php">
                                    <img id="title_pic" alt ="Прогнозування бункрутства підприємства" src="img/logo_text.png">
                                </a>
                    </div>
                </div>

                
                
                <div id="body_outer">
                    <div id="body">
                        <div id="navigation">
                             ';

$_SESSION['nav'] = '  
                            <ul>
                                <li><a href="index.php"><span id="index.php" class="">Головна</span></a></li>
                                <li><a href="wayofsolution.php"><span id="solution.php" class="">Розв\'язування</span></a></li>
                                <li><a href="methods.php"><span id="methods.php" class="">Методика</span></a></li>
                                <li><a href="about.php"><span id="about.php" class="">Про програму</span></a></li>
                                <li><a href="author.php"><span id="author.php" class="">Автори</span></a></li>
                                <li><a href="help.php"><span id="help.php" class="">Допомога</span></a></li>
                                <li><a href="literature.php"><span id="literature.php" class="">Джерела</span></a></li>
                            </ul> 
';
 $_SESSION['second_part'] = ' 
				<!--<div class="clearer">&nbsp;</div>-->


                        </div>
                <!--extra container for columns align-->
                    <div id="container_right">
                        <div id="container_left">
                            <div id="content_outer">
				                <div id="content">

';

    // -----------------------------тіло сторінки
    //


            
$_SESSION['third_part'] = ' 

				                </div>
                            </div>
                            <div id="rightbar_outer">
                                <div id="rightbar">';

//-----------------------------------опис сторінки
$_SESSION['fourth_part'] = ' 
                                    <div class="box">
                                        <div class="box_title" onclick="tellMeTheNameOfThisPage()">
                                            Корисні посилання
                                        </div>
                                        <div class="box_content">
                                            <ul>
                                                <li><a href="http://logistics.cdtu.edu.ua/">Портал "Логістика"</a></li>
                                                <li><a href="http://uk.wikipedia.org/wiki/%D0%9D%D0%B5%D1%87%D1%96%D1%82%D0%BA%D0%B0_%D0%BB%D0%BE%D0%B3%D1%96%D0%BA%D0%B0" rel="nofollow">Wikipedia</a> - Нечітка логіка</li>
                                            </ul>
                                        </div>
                                    </div>
				                </div>
                            </div>

                        </div>  <!-- end of container_left-->
                    </div>  <!-- end of container_right-->


                    </div>
                </div>

                <div id="footer">
                    <div class="left">
                        &copy; <a href="http://logistics.cdtu.edu.ua/">Портал "Логістика"</a> - 2013
                    </div>
                    <div class="right">
                        Модуль розробив Ткаченко Борис Леонідович 
                    </div>
		
                    <div class="clearer">&nbsp;</div>
                </div>
            </div>

    </body>
</html>
';
?>

