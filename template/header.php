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
    if(!isset($_SESSION['valid'])){
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
					<li><a href="?s=dane">Edytuj dane</a></li>
                    <li><a href="?s=zmiana_hasla">Zmień hasło</a></li>
				</ul>
			</li>
		
            <li>
                <a href="#">Twoje rezerwacje</a>
                <ul class="menu">
                    <li><a href="?h=1">Aktualne rezerwacje</a></li>
                    <li><a href="?s=e_rez">Edytuj rezerwację</a></li>
                    <li><a href="?s=arch_rez">Historia rezerwacji</a></li>
                    <li><a href="?s=karta">Karta pobytu</a></li>
                </ul>
            </li>
           
        </ul>';
			} else {

				if ($_SESSION['s'] == 0) {
					echo ' 
			<ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">Hotel Project</li>
            <li><a href="?">Strona główna</a></li>
            <li>
                <a>Twoje konto</a>
                <ul class="menu">
                    <li><a href="?s=dane">Edytuj dane</a></li>
                    <li><a href="?s=zmiana_hasla">Zmień hasło</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Grafik pracowniczy</a>
                <ul class="menu">
                    <li><a href="?s=stworz_grafik">Dodaj grafik</a></li>
                    <li><a href="?s=wysw_grafik&l=3">Archiwum grafików</a></li>
                </ul>
            </li>
            <li>
                <a>Pracownicy</a>
                <ul class="menu">
                    <li><a href="?s=pracownik&f=add">Dodaj pracownika</a></li>
                    <li><a href="?s=dane&ep=1">Edytuj dane pracownika</a></li>
                </ul>
            </li>
            <li>
            <a href="#">Oferta</a>
            <ul class="menu">
                <li><a href="?s=dodaj_oferte">Dodaj ofertę</a></li>
                 <li><a href="?s=usun_oferte">Usuń ofertę</a></li>
                <li><a href="?s=dodaj_pokoj">Dodaj pokój</a></li>
                <li><a href="?s=usun_pokoj">Usuń pokój</a></li>
                <li><a href="?s=oferta">Wyświetl oferty</a></li>
            </ul>
            </li>
        </ul>';

				} else if ($_SESSION['s'] == 1) {
					echo '
					<ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">Hotel Project</li>
            <li><a href="?">Strona główna</a></li>
          
            <li>
                <a href="#">Twoje konto</a>
                <ul class="menu">
                    <li><a href="?s=dane">Edytuj dane</a></li>
                    <li><a href="?s=zmiana_hasla">Zmień hasło</a></li>
                    <li><a href="?s=NALICZANIE">Zobacz wypłatę</a></li>
                    <li><a href="?s=karta_pracownika">Karta pracownika</a></li>
                    <!-- ... -->
                </ul>
            </li>
            <li>
                <a href="#">Grafik pracowniczy</a>
                <ul class="menu">
                    <li><a>Grafik całodniowy</a>
                        <ul class="menu">
                            <li><a href="?s=wysw_grafik&st=1&l=1">Recepcja</a></li>
                            <li><a href="?s=wysw_grafik&st=2&l=1">Kuchnia</a></li>
                            <li><a href="?s=wysw_grafik&st=3&l=1">Sprzątanie</a></li>
                        </ul>
                    </li>
                    <li><a>Grafik tygodniowy</a>
                        <ul class="menu">
                            <li><a href="?s=wysw_grafik&st=1&l=7">Recepcja</a></li>
                            <li><a href="?s=wysw_grafik&st=2&l=7">Kuchnia</a></li>
                            <li><a href="?s=wysw_grafik&st=3&l=7">Sprzątanie</a></li>
                        </ul>
                    </li>
                    <li><a href="?s=wysw_grafik">Twój grafik</a></li>
                    <!-- ... -->
                </ul>
            </li>
            <li><a href="#">Rezerwacje</a>
                <ul class="menu">
                    <li><a href="?s=e_rez">Edytuj rezerwację</a></li>
                    <li><a href="?h=1">Wyświetl rezerwacje</a></li>
                    <li><a href="?s=arch_rez">Archiwum rezerwacji</a></li>
                </ul>
            </li>
            <li><a href="#">Meldunki</a>
                <ul class="menu">
                    <li><a href="?s=meldunki">Zamelduj</a></li>
                    <li><a href="?s=szuk_meld">Wyszukaj</a></li>
                    <li><a href="?s=lista_meld">Wyświelt meldunki </a></li>
                    <li><a href="?s=arch_meld">Archiwum meldunków </a></li>
                    <li><a href="?s=karta">Karta meldunku</a></li>
                </ul>
            </li>
            <li><a href="?s=parking">Miejsca parkingowe</a></li>
        </ul>
';

				} if($_SESSION['s']==2) {
					echo '
	<ul class="dropdown menu" data-dropdown-menu>
	<li class="menu-text">Hotel Project</li>
            <li><a href="?">Ilość posiłków</a></li>
          
            <li>
                <a href="#">Twoje konto</a>
                <ul class="menu">
                    <li><a href="?s=dane">Wyświetl dane</a></li>
                    <li><a href="?s=zmiana_hasla">Zmień hasło</a></li>
                    <li><a href="?s=NALICZANIE">Zobacz wypłatę</a></li>
                    <li><a href="?s=karta_pracownika">Karta pracownika</a></li>
                    <!-- ... -->
                </ul>
            </li>
            <li>
                <a href="#">Grafik pracowniczy</a>
                <ul class="menu">
                            <li><a href="?s=wysw_grafik">Twój grafik</a></li>
                            <li><a href="?s=wysw_grafik&st=2&l=1">Całodniowy - Kuchnia</a></li>
                             <li><a href="?s=wysw_grafik&st=2&l=7">Tygodniowy - Kuchnia</a></li>
                </ul>
            </li>
               	
        </ul>';

				}
				if ($_SESSION['s'] == 3) {
					echo '
	<ul class="dropdown menu" data-dropdown-menu>
	<li class="menu-text">Hotel Project</li>
            <li><a href="?">Pokoje do sprzątania</a></li>
          
            <li>
                <a href="#">Twoje konto</a>
                <ul class="menu">
                    <li><a href="?s=dane">Wyświetl dane</a></li>
                    <li><a href="?s=zmiana_hasla">Zmień hasło</a></li>
                    <li><a href="?s=NALICZANIE">Zobacz wypłatę</a></li>
                    <li><a href="?s=karta_pracownika">Karta pracownika</a></li>
                    <!-- ... -->
                </ul>
            </li>
            <li>
                <a href="#">Grafik pracowniczy</a>
                <ul class="menu">
                            <li><a href="?s=wysw_grafik">Twój grafik</a></li>
                            <li><a href="?s=wysw_grafik&st=3&l=1">Całodniowy - Serwis Sprzątający</a></li>
                             <li><a href="?s=wysw_grafik&st=3&l=7">Tygodniowy - Serwis Sprzątający</a></li>
                </ul>
            </li>
               
        </ul>';
				}
			}
}
		

		echo '
    </div>
    <div class="top-bar-right ">
    <ul class="menu">
    ';

		if (!isset($_SESSION['valid'])) {
			echo '
    
        
            <li class="active"><a href="?s=logowanie">Zaloguj się</a></li>
            <li><a href="?s=rejestracja">Zarejestruj się</a></li>
        
    ';
		} else {

			if ($_SESSION['kp'] == "k") {
				echo '<li class="menu-text">' . $_SESSION['username'] . ' ' . $_SESSION['id'] . '</li>
			<li class="active"><a href="?s=szuk_pok">Zarezerwuj</a></li>
			<li><a href="?s=wyloguj">Wyloguj się</a></li>';
			} else {
				echo '<li class="menu-text">' . $_SESSION['username'] . ' ' . $_SESSION['id'] . '</li>
			<li><a href="?s=wyloguj">Wyloguj się</a></li>';
			}
		}
	

echo '</ul></div></div>';
?>
