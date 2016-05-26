<?php
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Witaj | Welcome</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/foundation.min.css">
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
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">Hotel Project</li>
            <li><a href="#">Strona główna</a></li>
            ';
            if($_SESSION['valid']==true){
				echo '
              <li>
				<a href="#">Twoje konto</a>
				<ul class="menu">
					<li><a href="#">Item 1A</a></li>
				<!-- ... -->
				</ul>
				</li>';
			}
			echo '
			
            <li><a href="#">Aktualne rezerwacje</a></li>
            <li><a href="#">Zarezerwuj</a></li>
            <li><a href="#">Historia</a></li>
        </ul>
    </div>';
    if($_SESSION['valid']==true){
		echo '
    <div class="top-bar-right ">
        <ul class="menu">
            <li><a href="#">Wyloguj się</a></li>
        </ul>
    </div>';
}

echo '</div>';
?>
