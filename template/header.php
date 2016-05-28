<?php

include("dbconnect.php");

echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Witaj | Welcome</title>
    <link rel="stylesheet" href="css/foundation.css">

    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    
	<script src="js/jquery.js"></script>
	<script src="js/what-input.js"></script>
    <script src="js/foundation.js"></script>

    <script src="js/foundation-datepicker.js"></script>
    <script src="js/foundation-datepicker.vi.js"></script>
    <link rel="stylesheet" href="css/foundation-datepicker.min.css">
    <link rel="stylesheet" href="css/app.css">
    
    <link rel="shortcut icon" href="favicon.png" />


</head>

<body>
        
<div class="top-bar">
    <div class="top-bar-left">';
    if(!$_SESSION['valid']){
		echo '
        <ul class="menu">
            <li class="menu-text">Hotel Project</li>
            <li><a href="?">Strona główna</a></li>
            <li><a href="?s=ohotelu">O hotelu</a></li>
        </ul>';
	}else{
        echo '
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">Hotel Project</li>
            <li><a href="?">Strona główna</a></li>
              <li>
				<a href="#">Twoje konto</a>
				<ul class="menu">
					<li><a href="#">Twoje dane</a></li>
                    <li><a href="#">Edytuj dane</a></li>
                    <li><a href="#">Zmień hasło</a></li>
				</ul>
			</li>
            <li>
                <a href="#">Twoje rezerwacje</a>
                <ul class="menu">
                    <li><a href="#">Aktualne rezerwacje</a></li>
                    <li><a href="#">Edytuj rezerwację</a></li>
                    <li><a href="#">Usuń rezerwację</a></li>
                    <li><a href="#">Historia rezerwacji</a></li>
                    <li><a href="#">Karta pobytu</a></li>
                </ul>
            </li>
        </ul>';}
        
        echo'
    </div>
    <div class="top-bar-right ">
    <ul class="menu">
    ';
    
    if(!$_SESSION['valid']){
    echo '
    
        
            <li class="active"><a href="?s=logowanie">Zaloguj się</a></li>
            <li><a href="?s=rejestracja">Zarejestruj się</a></li>
        
    ';
}else{
	echo '<li class="menu-text">'.$_SESSION['username'].'</li>
		<li><a href="?s=wyloguj">Wyloguj się</a></li>';
}

echo '</ul></div></div>';
?>
