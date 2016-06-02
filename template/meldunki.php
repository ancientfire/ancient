<?php

include 'config.php';

if (isset($_POST['meldunek'])) {
    $typ=$_POST['typ'];
    $imie=$_POST['imie'];
    $nazw=$_POST['nazw'];
    $pesel=$_POST['pesel'];
    $IDrp=$_POST['IDrp'];
    $miasto=$_POST['miasto'];
    $ulica=$_POST['ulica'];
    $kod=$_POST['kod'];
    $nlokalu=$_POST['nlokalu'];
    $nmieszk=$_POST['nmieszk'];

    if($_SESSION['kp']=="p"){
        if(!empty($imie) && !empty($nazw) && !empty($pesel) && !empty($IDrp) && !empty($miasto) && !empty($ulica) && !empty($kod)
            && !empty($nlokalu) && !empty($nmieszk)){

            $query = "insert into meldunek  (id_rez_pok,nazwisko, imie, adres, pesel) values ('$IDrp','$nazw','$imie',".$kod."*".$miasto."*".$ulica."*".$nmieszk."*".$nlokalu."','$pesel')";
            $result = pg_query($query) or die('Query failed: ' . pg_last_error());

            pg_close($dbconn);
            echo '
				<div class="callout primary rejestr">
				<div class="row">
				<div class="small-3 small-centered columns text-center">		
				Zapisano.
				</div>
				</div>
				</div>';
            header( "refresh:3;url=index.php" );
        }else{
            echo '
				<div class="callout primary rejestr">
				<div class="row">
				<div class="small-3 small-centered columns text-center">		
				Nieprawidłowe lub puste dane.
				</div>
				</div>
				</div>';
            header( "refresh:3;url=meldunki.php" );
        }
    }
}

echo'


<div class="primary callout">

    <div class="row">
    <form method="post">
        <div class="row large-12">

            <label><strong>DANE MELDUNKU</strong></label>

            <table class="table ramka3">
                <thead>
                <tr>
                    <th>ID rezerwacji pokoju
                        <input type="text" name="IDrp" placeholder="ID rezerwacji pokoju" /></th>

                    <th>Imię
                        <input type="text" name="imie" placeholder="Imię" /></th>

                    <th>Nazwisko
                        <input type="text" name="nazw" placeholder="Nazwisko" /></th>

                    <th>PESEL
                        <input type="text" name="pesel" placeholder="PESEL" /></th>

                </tr>
                </thead>

                <thead>
                <tr>
                    <th>Miasto
                        <input type="text" name="miasto" placeholder="Miasto" /></th>

                    <th>Ulica
                        <input type="text" name="ulica" placeholder="Ulica" /></th>

                    <th>Kod pocztowy
                        <input type="text" name="kod" placeholder="Kod pocztowy" /></th>

                    <th>Numer lokalu
                        <input type="text" name="nlokalu" placeholder="Numer lokalu" /></th>
                    <th>Numer mieszkania
                        <input type="text" name="nmieszk" placeholder="Numer mieszkania" /></th>
                </tr>
                </thead>
                
                <div class="large-12">
            <input type="submit" name="rejestr" class="button meldunek" value="ZAMELDUJ SIĘ" />
                </div>
            </table>
        </div>
        </form>
    </div>
</div>
    ';
?>