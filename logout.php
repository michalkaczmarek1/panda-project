<?php
//require header script
require_once('views/header.html.php');
?>


<?php

// display statement about logout
 if(!isset($_SESSION['success-login'])){
    echo "<div class='alert alert-success'>Zostałeś poprawnie wylogowany. <a href='". APP_PATH."index.php' class='btn btn-info'>Przejdź do strony głównej</a></div>";
 }

//require footer script
require_once('views/footer.html.php');
?>