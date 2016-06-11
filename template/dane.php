<?php

if($_SESSION['valid']){
include 'config.php';

            if (isset($_POST['zapisz'])) {
				$typ=$_POST['typ'];
				$imie=$_POST['imie'];
				$nazw=$_POST['nazw'];
				$pesel=$_POST['pesel'];
				$tel=$_POST['tel'];
				$nfirmy=$_POST['nfirmy'];
				$nip=$_POST['nip'];
				$miasto=$_POST['miasto'];
				$ulica=$_POST['ulica'];
				$kod=$_POST['kod'];
				$nlokalu=$_POST['nlokalu'];
				$nmieszk=$_POST['nmieszk'];
			if($_SESSION['kp']=="k"){
			if ($typ=="of") {
	
				if(!empty($imie) && !empty($nazw) && !empty($pesel) && !empty($tel) && !empty($miasto) && !empty($ulica) && !empty($kod)
					&& !empty($nlokalu) && !empty($nmieszk)){
						
				$query = "update klient set nazwa='',nip='',nazwisko='$nazw',imie='$imie',adres='".$kod."*".$miasto."*".$ulica."*".$nmieszk."*".$nlokalu."',pesel='$pesel',nr_telefonu='$tel' where id_klienta='".$_SESSION['id']."'";
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
				header( "refresh:3;url=index.php" );
			}

				}else{
				if(!empty($nfirmy) && !empty($nip) && !empty($tel) && !empty($miasto) && !empty($ulica) && !empty($kod)
					&& !empty($nlokalu) && !empty($nmieszk)){
						
				$query = "update klient set nazwisko='',imie='',pesel='',nazwa='$nfirmy',nip='$nip',adres='".$kod."*".$miasto."*".$ulica."*".$nmieszk."*".$nlokalu."',nr_telefonu='$tel' where id_klienta='".$_SESSION['id']."'";
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
				}
			}
			}else{
				if(!empty($imie) && !empty($nazw) && !empty($tel) && !empty($miasto) && !empty($ulica) && !empty($kod)
					&& !empty($nlokalu) && !empty($nmieszk)){
						
				$query = "update pracownik set imie='$imie',nazwisko='$nazw',adres='".$kod."*".$miasto."*".$ulica."*".$nmieszk."*".$nlokalu."',nr_tele='$tel' where id_pracownika='".$_SESSION['id']."'";
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
				header( "refresh:3;url=index.php" );	
				
			}
				
			}
		}
			else{
				
if($_SESSION['kp']=="k"){

$query = "select nazwa,nazwisko,imie,adres,pesel,nip,nr_telefonu from klient where id_klienta='".$_SESSION['id']."'";
$result = pg_fetch_array(pg_query($query));

$adres=explode("*", $result[3]);
  
echo'
<div class="primary callout klient">
    <div class="row">
    <form method="post">
        <div class="row large-12">
            <input type="radio" name="typ" id="firma" value="f" '.((!empty($result[0]))? 'checked="checked"':'').'><label for="firma">FIRMA</label>
            <input type="radio" name="typ" id="osoba" value="of" '.((empty($result[0]))? 'checked="checked"':'').'><label for="osoba">OSOBA FIZYCZNA</label>

            <label><strong>EDYTUJ DANE</strong></label>

            <table class="table ramka3">
                <thead>
                <tr>
                    <th>Imię
                    <input type="text" name="imie" value="'.$result[2].'" '.((!empty($result[0]))? 'disabled':'').'/></th>

                    <th>Nazwisko
                        <input type="text" name="nazw" value="'.$result[1].'" '.((!empty($result[0]))? 'disabled':'').'/></th>

                    <th>PESEL
                        <input type="text" name="pesel" value="'.$result[4].'" '.((!empty($result[0]))? 'disabled':'').'/></th>

                    <th>Numer telefonu
                        <input type="text" name="tel" value="'.$result[6].'" /></th>
                </tr>
                </thead>

                <thead>
                <tr>
                    <th>Nazwa firmy
                        <input type="text" name="nfirmy" value="'.$result[0].'" '.((empty($result[0]))? 'disabled':'').'/></th>

                    <th>NIP
                        <input type="text" name="nip" value="'.$result[5].'" '.((empty($result[0]))? 'disabled':'').'/></th>
                </tr>
                </thead>


                <thead>
                <tr>
                    <th>Miasto
                        <input type="text" name="miasto" value="'.$adres[1].'" /></th>

                    <th>Ulica
                        <input type="text" name="ulica" value="'.$adres[2].'" /></th>

                    <th>Kod pocztowy
                        <input type="text" name="kod" value="'.$adres[0].'" /></th>

                    <th>Numer lokalu
                        <input type="text" name="nlokalu" value="'.$adres[4].'" /></th>

                    <th>Numer mieszkania
                        <input type="text" name="nmieszk" value="'.$adres[3].'" /></th>
                </tr>
                </thead>
            </table>
                        <div class="large-12">
            <input type="submit" name="zapisz" class="button rejestracja2" value="EDYTUJ" />
                </div>
        </div>
        </form>
    </div>
</div>
<script>
var radios =  $(\'input[name=typ]\');
radios.click(function() { 

    if(this.value==\'f\') {
        $(\'input[name=nip]\').prop( "disabled", false );
        $(\'input[name=nfirmy]\').prop( "disabled", false );
        $(\'input[name=imie]\').prop( "disabled", true );
        $(\'input[name=nazw]\').prop( "disabled", true );
        $(\'input[name=pesel]\').prop( "disabled", true );
    }else{
        $(\'input[name=nip]\').prop( "disabled", true );
        $(\'input[name=nfirmy]\').prop( "disabled", true );    
        $(\'input[name=imie]\').prop( "disabled", false );
        $(\'input[name=nazw]\').prop( "disabled", false ); 
        $(\'input[name=pesel]\').prop( "disabled", false );
	}

    
});
</script>
';
pg_close($dbconn);
}else{


if($_SESSION['s']==0){
echo '
<div class="primary callout klient">
    <div class="row">
    <form method="post">
        <div class="row large-12">

            <label><strong>EDYTUJ DANE</strong></label>

            <table class="table ramka3">';
            
            if($_GET['ep']==1){
			echo'
            <thead>
            <th> Stanowisko:
			<select name="stan" onchange="location = this.value;">
			<option disabled selected value> Wybierz stanowisko </option>
			<option value="?s=dane&ep=1&st=1" '.(($_GET['st']==1)? 'selected':'').'>RECEPCJA</option>
            <option value="?s=dane&ep=1&st=2" '.(($_GET['st']==2)? 'selected':'').'>KUCHNIA</option>
            <option value="?s=dane&ep=1&st=3" '.(($_GET['st']==3)? 'selected':'').'>SERWIS SPRZĄTAJĄCY</option>
			</select> </th>
			<th> ID pracownika:
			<select name="idp" onchange="location = this.value;">
			<option disabled selected value> Wybierz ID </option>
			';
											
								if(empty($_GET['st'])){ echo "<option value=''></option>";}else{
								$query = "select id_pracownika from pracownik where id_stanowiska='".$_GET['st']."'";
								$result = pg_query($query) or die('Query failed: ' . pg_last_error());
								//echo $query;
								
								while($row=pg_fetch_row($result)){
								echo "<option value='?s=dane&ep=1&st=".$_GET['st']."&idp=$row[0]'".(($row[0]==$_GET['idp'])? 'selected':'').">$row[0]</option>";
								}
							}
			echo '
			</select>
			</th>
                </thead>';
			}
			
			$query = "";
			if($_GET['ep']!=1){
			$query = "select imie,nazwisko,adres,nr_tele from pracownik where id_pracownika='".$_SESSION['id']."'";
			}else{
			if(!empty($_GET['st']) and !empty($_GET['idp'])){
			$query = "select imie,nazwisko,adres,nr_tele from pracownik where id_pracownika='".$_GET['idp']."'";
			}	
			}
			$result = pg_fetch_array(pg_query($query));

			$adres=explode("*", $result[2]);
                echo '
                <thead>
                <tr>
                    <th>Imię
                        <input type="text" name="imie" value="'.$result[0].'" /></th>

                    <th>Nazwisko
                        <input type="text" name="nazw" value="'.$result[1].'" /></th>

                    <th>Numer telefonu
                        <input type="text" name="tel" value="'.$result[3].'" /></th>
                </tr>
                </thead>



                <thead>
                <tr>
                    <th>Miasto
                        <input type="text" name="miasto" value="'.$adres[1].'" /></th>

                    <th>Ulica
                        <input type="text" name="ulica" value="'.$adres[2].'" /></th>

                    <th>Kod pocztowy
                        <input type="text" name="kod" value="'.$adres[0].'" /></th>

                    <th>Numer lokalu
                        <input type="text" name="nlokalu" value="'.$adres[4].'" /></th>

                    <th>Numer mieszkania
                        <input type="text" name="nmieszk" value="'.$adres[3].'" /></th>
                </tr>
                </thead>
            </table>
            <div class="large-12">
            <input type="submit" name="zapisz" class="button rejestracja2" value="EDYTUJ" />
                </div>
            </div>
            </form>
        </div>
    </div>
';	
}else{
			$query = "select imie,nazwisko,adres,nr_tele from pracownik where id_pracownika='".$_SESSION['id']."'";
			$result = pg_fetch_array(pg_query($query));

			$adres=explode("*", $result[2]);
	echo '
<div class="primary callout klient">
    <div class="row">
        <div class="row large-12">

            <label><strong>PRZEGLĄDAJ DANE</strong></label>

            <table class="table ramka3">
                <thead>
                <tr>
                    <th>Imię
                        <input type="text" name="imie" value="'.$result[0].'" disabled /></th>

                    <th>Nazwisko
                        <input type="text" name="nazw" value="'.$result[1].'" disabled /></th>

                    <th>Numer telefonu
                        <input type="text" name="tel" value="'.$result[3].'" disabled /></th>
                </tr>
                </thead>



                <thead>
                <tr>
                    <th>Miasto
                        <input type="text" name="miasto" value="'.$adres[1].'" disabled /></th>

                    <th>Ulica
                        <input type="text" name="ulica" value="'.$adres[2].'" disabled /></th>

                    <th>Kod pocztowy
                        <input type="text" name="kod" value="'.$adres[0].'" disabled /></th>

                    <th>Numer lokalu
                        <input type="text" name="nlokalu" value="'.$adres[4].'" disabled /></th>

                    <th>Numer mieszkania
                        <input type="text" name="nmieszk" value="'.$adres[3].'" disabled /></th>
                </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
';	
}
}

}
}
?>
