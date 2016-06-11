<?php

if($_SESSION['s']==0 && $_SESSION['valid']){
if($_GET['f']=='add'){
	
	include 'config.php';

            if (isset($_POST['rejestr'])) {
				$imie=$_POST['imie'];
				$nazw=$_POST['nazw'];
				$st=$_POST['st'];
				$tel=$_POST['tel'];
				$miasto=$_POST['miasto'];
				$ulica=$_POST['ulica'];
				$kod=$_POST['kod'];
				$nlokalu=$_POST['nlokalu'];
				$nmieszk=$_POST['nmieszk'];
				$mail=$_POST['mail'];
				$pass1=$_POST['pass1'];
				$pass2=$_POST['pass2'];

			if(filter_var($mail, FILTER_VALIDATE_EMAIL)){

				if(!empty($imie) && !empty($nazw) && isset($st) && !empty($tel) && !empty($miasto) && !empty($ulica) && !empty($kod)
					&& !empty($nlokalu) && !empty($nmieszk) && !empty($mail) && !empty($pass1) && !empty($pass2)){
						
				$query = "select count(*) from logowanie where email='$mail'";
				$result = pg_fetch_result(pg_query($query), 0);
				
				if($result==0){
					if($pass1==$pass2){
						
					$query = "insert into pracownik (imie, nazwisko,adres,nr_tele,id_stanowiska) values ('$imie','$nazw','$kod','$tel','$st') returning id_pracownika";
					$result = pg_query($query) or die('Query failed: ' . pg_last_error());
					$id = pg_fetch_row($result)['0'];
				     
					$query = "insert into logowanie (id_pracownika,email,haslo) values ('$id','$mail','$pass1')";
					$result = pg_query($query) or die('Query failed: ' . pg_last_error());
					
					$query = "insert into zatrudnienie (id_pracownika) values ('$id')";
					$result = pg_query($query) or die('Query failed: ' . pg_last_error());
					pg_close($dbconn);
					echo '
					<div class="callout large primary rejestr">
					<div class="row">
					<div class="small-7 small-centered columns text-center">		
					<h3>Dodano pracownika.</h3>
					</div>
					</div>
					</div>';	
					header( "refresh:3;url=index.php" );
					}else{
					echo '
					<div class="callout primary rejestr">
					<div class="row">
					<div class="small-3 small-centered columns text-center">		
					Hasła nie są równe.
					</div>
					</div>
					</div>';
					pg_close($dbconn);
					header( "refresh:3;url=?s=pracownik&f=add" );					
						}
					}else{
					echo '
					<div class="callout primary rejestr">
					<div class="row">
					<div class="small-5 small-centered columns text-center">		
					Pracownik o takim adresie email już istnieje.
					</div>
					</div>
					</div>';
					pg_close($dbconn);
					header( "refresh:3;url=?s=pracownik&f=add" );
						}
				
						}

					}else{
								echo '
				<div class="callout primary rejestr">
				<div class="row">
				<div class="small-5 small-centered columns text-center">		
				Nieprawidłowy mail.
				</div>
				</div>
				</div>';
				pg_close($dbconn);
				header( "refresh:3;url=?s=pracownik&f=add" );

			   }
			   }else{
echo'
<div class="primary callout klient">
    <div class="row">
    <form method="post">
        <div class="row large-12">

            <label><strong>DANE PRACOWNIKA</strong></label>

            <table class="table">
                <thead>
                <tr>
                    <th>Imię
                        <input type="text" name="imie" placeholder="Imię" /></th>

                    <th>Nazwisko
                        <input type="text" name="nazw" placeholder="Nazwisko" /></th>

                    <th>Numer telefonu
                        <input type="text" name="tel" placeholder="Numer telefonu" /></th>
                    <th>Stanowisko
                        <select name="st">
                            <option value="0">ADMIN</option>
                            <option value="1">RECEPCJA</option>
                            <option value="2">KUCHNIA</option>
                            <option value="3">SERWIS SPRZĄTAJĄCY</option>
                        </select>
                    </th>

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
                        <th>E-mail
                            <input type="text" name="mail" placeholder="E-mail" /></th>
                        <th>Hasło
                            <input type="password" name="pass1" placeholder="Hasło" /></th>
                        <th>Powtórz hasło
                            <input type="password" name="pass2" placeholder="Hasło" /></th>
                    </tr>
                    </thead>

                </table>

                <div class="large-12">
                    <input type="submit" name="rejestr" class="button rejestracja2" value="ZAREJESTRUJ PRACOWNIKA" />
                </div>
            </div>


        </div>
        </form>
    </div>
</div>';}

}
}

?>
