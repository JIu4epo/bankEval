<?php
include 'sources.php';
echo $_SESSION['first_part'];
echo $_SESSION['nav'];
echo $_SESSION['second_part'];
echo '
<object data="metod.pdf" type="application/pdf" width="596px" height="600px">
alt: <a href="metod.pdf">Альт</a>
</object>
';
//include 'text_files/method_text.html';
echo $_SESSION['third_part'];
echo $_SESSION['fourth_part'];
?>