<?php

ob_start();
session_start();

include("template/header.php"); 

$strona = 'index'; 

$niedozwolone = array('header', 'footer');

if ($_GET['s']=="wyloguj"){
   unset($_SESSION["user"]);
   unset($_SESSION["pass"]);
   unset($_SESSION["valid"]);
   header('Location: index.php');
}

if (!empty($_GET['s'])) { 
    $temp_strona = basename($_GET['s']); 

    if (!in_array($temp_strona, $niedozwolone) && file_exists("template/{$temp_strona}.php")) 
        $strona = $temp_strona; 
} 

include("template/$strona.php"); 
include("template/footer.php");

?>
