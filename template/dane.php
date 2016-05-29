<?php
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
					
				}
			}
			}else{
				
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
            <input type="submit" name="zapisz" class="button rejestracja2" value="ZAPISZ" />
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
}}

?>
