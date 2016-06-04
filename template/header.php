<?php
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
    
<link href="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js">

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
			if ($_SESSION['kp'] == "k") {
				echo '
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">Hotel Project</li>
            <li><a href="?">Strona główna</a></li>
              <li>
				<a>Twoje konto</a>
				<ul class="menu">
					<li><a href="?s=dane">Wyświetl/Edytuj dane</a></li>
                    <li><a href="?s=zmiana_hasla">Zmień hasło</a></li>
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
        </ul>';
			} else {

				if ($_SESSION['s'] == 0) {
						echo ' 
			<ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">Hotel Project</li>
            <li>
                <a>Twoje konto</a>
                <ul class="menu">
                    <li><a href="?s=dane">Wyświetl/Edytuj dane</a></li>
                    <li><a href="?s=zmiana_hasla">Zmień hasło</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Grafik pracowniczy</a>
                <ul class="menu">
                    <li><a href="#">Dodaj grafik</a>
                        <ul class="menu">
                            <li><a href="#">Recepcja</a></li>
                            <li><a href="#">Kuchnia</a></li>
                            <li><a href="#">Sprzątanie</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Edytuj grafik</a>
                        <ul class="menu">
                            <li><a href="#">Recepcja</a></li>
                            <li><a href="#">Kuchnia</a></li>
                            <li><a href="#">Sprzątanie</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Archiwum grafików</a>
                        <ul class="menu">
                            <li><a href="#">Recepcja</a></li>
                            <li><a href="#">Kuchnia</a></li>
                            <li><a href="#">Sprzątanie</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a>Pracownicy</a>
                <ul class="menu">
                    <li><a href="?s=pracownik&f=add">Dodaj pracownika</a></li>
                    <li><a href="#">Wyświetl/Edytuj dane pracownika</a></li>
                </ul>
            </li>
            <li>
            <a href="#">Oferta</a>
            <ul class="menu">
                <li><a href="#">Dodaj oferty</a></li>
                <li><a href="#">Wyświetl/Edytuj oferty</a></li>
            </ul>
            </li>
        </ul>';

					}else{
											echo '
					<ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">Hotel Project</li>
            <li><a href="#">Strona główna</a></li>
            <li>
                <a href="#">Twoje konto</a>
                <ul class="menu">
                    <li><a href="?s=dane">Wyświetl/edytuj dane</a></li>
                    <li><a href="?s=zmiana_hasla">Zmień hasło</a></li>
                    <!-- ... -->
                </ul>
            </li>
            <li>
                <a href="#">Grafik pracowniczy</a>
                <ul class="menu">
                    <li><a href="#">Grafik całodniowy</a>
                        <ul class="menu">
                            <li><a href="#">Recepcja</a></li>
                            <li><a href="#">Kuchnia</a></li>
                            <li><a href="#">Sprzątanie</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Grafik tygodniowy</a>
                        <ul class="menu">
                            <li><a href="#">Recepcja</a></li>
                            <li><a href="#">Kuchnia</a></li>
                            <li><a href="#">Sprzątanie</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Twój grafik</a></li>
                    <!-- ... -->
                </ul>
            </li>
            <li><a href="#">Rezerwacje</a>
                <ul class="menu">
                    <li><a href="#">Dodaj rezerwację</a></li>
                    <li><a href="#">Edytuj rezerwację</a></li>
                    <li><a href="#">Usuń rezerwację</a></li>
                    <li><a href="#">Wyszukaj rezerwację</a></li>
                </ul>
            </li>
            <li><a href="#">Meldunki</a>
                <ul class="menu">
                    <li><a href="?s=meldunki">Zamelduj</a></li>
                    <li><a href="?s=szuk_meld">Wyszukaj</a></li>
                </ul>
            </li>
        </ul>
';
						
					}



			}
}
		

		echo '
    </div>
    <div class="top-bar-right ">
    <ul class="menu">
    ';

		if (!$_SESSION['valid']) {
			echo '
    
        
            <li class="active"><a href="?s=logowanie">Zaloguj się</a></li>
            <li><a href="?s=rejestracja">Zarejestruj się</a></li>
        
    ';
		} else {

			if ($_SESSION['kp'] == "k") {
				echo '<li class="menu-text">' . $_SESSION['username'] . ' ' . $_SESSION['s'] . '</li>
			<li class="active"><a href="?s=szuk_pok">Zarezerwuj</a></li>
			<li><a href="?s=wyloguj">Wyloguj się</a></li>';
			} else {
				echo '<li class="menu-text">' . $_SESSION['username'] . ' ' . $_SESSION['s'] . '</li>
			<li><a href="?s=wyloguj">Wyloguj się</a></li>';
			}
		}
	

echo '</ul></div></div>';
?>
