<?php

if($_SESSION['valid']) {
    include 'config.php';

    if (isset($_POST['zmiana']) && !empty($_POST['stareh'])
        && !empty($_POST['noweh1']) && !empty($_POST['noweh2'])
    ) {


        $query = "select id_pracownika, id_klienta, email, haslo from logowanie where id_pracownika='" . $_SESSION['id'] . "'
             or id_klienta='" . $_SESSION['id'] . "'";

        $result = pg_fetch_array(pg_query($query));

        if ($result) {
            if ($_POST['stareh'] == $result[3]) {
                if ($_POST['noweh1'] == $_POST['noweh2']) {

                    $nowe = $_POST['noweh1'];
                    $query = "update logowanie set haslo='$nowe' where id_pracownika='" . $_SESSION['id'] . "'
                     or id_klienta='" . $_SESSION['id'] . "'";
                    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
                                        pg_close($dbconn);
                    echo '
				<div class="callout primary rejestr">
				<div class="row">
				<div class="small-3 small-centered columns text-center">		
				Hasło zostało zmienione.
				</div>
				</div>
				</div>';
                } else {
                    pg_close($dbconn);
                    echo '
				<div class="callout primary rejestr">
				<div class="row">
				<div class="small-3 small-centered columns text-center">		
				Źle powtórzone hasło.
				</div>
				</div>
				</div>';
                }
            } else {
                pg_close($dbconn);
                echo '
				<div class="callout primary rejestr">
				<div class="row">
				<div class="small-3 small-centered columns text-center">		
				Błędne stare hasło.
				</div>
				</div>
				</div>';
            }

        }
    }else{

echo'
    <div class="callout primary" >
    <div class="row" >
    <form method="post">
        <div class="large-7 ramka" >

            <table class="table" >
                <thead>
                <tr>
                    <th> Podaj stare hasło
                 
    <input type = "password" name = "stareh" placeholder = "Stare hasło" /></th>
                </tr >
                </thead >
                <thead >
                <tr>
                    <th> Podaj nowe hasło
    <input type = "password" name = "noweh1" placeholder = "Nowe hasło"/></th >
                </tr >
                </thead >
                <thead >
                <tr >
                    <th > Powtórz nowe hasło
    <input type = "password" name = "noweh2" placeholder ="Nowe hasło" /></th >
                </tr >
                </thead >

            </table >
                            <thead >
                <tr >
                    <th ><input type = "submit" name = "zmiana" class="button" value = "Zmien" >

                </tr >
                </thead >
        </div >
        </form>
    </div >
</div >';}

}
?>

