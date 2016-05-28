<?php

$dbconn = pg_connect("host=localhost dbname=szwedek_aga user=szwedek_aga password=RJBNLC8q")
    or die('Could not connect: ' . pg_last_error());

            if (isset($_POST['rejestr'])) {
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
				$mail=$_POST['mail'];
				$pass1=$_POST['pass1'];
				$pass2=$_POST['pass2'];

			if ($typ=="of") {

				if(!empty($imie) && !empty($nazw) && !empty($pesel) && !empty($tel) && !empty($miasto) && !empty($ulica) && !empty($kod)
					&& !empty($nlokalu) && !empty($nmieszk) && !empty($mail) && !empty($pass1) && !empty($pass2)){
				

				$query = "select count(*) from logowanie where email='$mail'";
				$result = pg_fetch_result(pg_query($query), 0);
				
				if($result==0){
					if($pass1==$pass2){
						
				$query = "insert into klient (nazwa,nazwisko,imie,adres,pesel,nip,nr_telefonu) values ('','$nazw','$imie','$kod','$pesel','','$tel') returning id_klienta";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());
				$id = pg_fetch_row($result)['0'];
				
				$query = "insert into logowanie (id_klienta,email,haslo) values ('$id','$mail','$pass1')";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());
				echo '
				<div class="callout primary rejestr">
				<div class="row">
				<div class="small-3 small-centered columns text-center">		
				Witamy w Hotelu Project! 
				</div>
				</div>
				</div>';	
				}else{
									echo '
				<div class="callout primary rejestr">
				<div class="row">
				<div class="small-3 small-centered columns text-center">		
				Hasła nie są równe.
				</div>
				</div>
				</div>';					
				}
				}else{
				echo '
				<div class="callout primary rejestr">
				<div class="row">
				<div class="small-5 small-centered columns text-center">		
				Klient o takim adresie email już istnieje.
				</div>
				</div>
				</div>';
			}
				
			}

				}

			   }else{   
echo '<div class="callout primary rejestr">
<div class="row">
<form method="post">
    <div class="row large-12">
        <input type="radio" name="typ" id="firma" value="f"><label for="firma">FIRMA</label>
        <input type="radio" name="typ" id="osoba" value="of" checked="checked"><label for="osoba">OSOBA FIZYCZNA</label>

        <label><strong>DANE KLIENTA</strong></label>

        <table class="table">
            <thead>
            <tr>
                <th>Imię
                    <input type="text" name="imie" placeholder="Imię" /></th>

                <th>Nazwisko
                    <input type="text" name="nazw" placeholder="Nazwisko" /></th>

                <th>PESEL
                    <input type="text" name="pesel" placeholder="PESEL" /></th>

                <th>Numer telefonu
                    <input type="text" name="tel" placeholder="Numer telefonu" /></th>
            </tr>
            </thead>

<thead>
<tr>
    <th>Nazwa firmy
        <input type="text" name="nfirmy" placeholder="Nazwa firmy" disabled/></th>

    <th>NIP
        <input type="text" name="nip" placeholder="NIP" disabled/></th>
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
</table>
        <div class="large-6">
        <table class="table">
            <label><strong>DANE LOGOWANIA</strong></label>
            <thead>
            <tr>
                <th>Login
                    <input type="text" name="mail" placeholder="E-mail" /></th>
                <th>Hasło
                    <input type="text" name="pass1" placeholder="Hasło" /></th>
                <th>Powtórz hasło
                    <input type="text" name="pass2" placeholder="Hasło" /></th>
            </tr>
            </thead>

        </table>

            <div class="large-12">
            <input type="submit" name="rejestr" class="button rejestracja2" value="ZAREJESTRUJ SIĘ" />
                </div>
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
}
pg_close($dbconn);
?>
