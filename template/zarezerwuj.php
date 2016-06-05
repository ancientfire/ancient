<?php

if($_SESSION['valid']) {
    include 'config.php';

        if ($_SESSION['kp'] == "k") {

if(isset($_POST['zapisz'])){
	if(isset($_POST['usl1'])){
				echo $_SESSION['idr'];
				//$query = "insert into logowanie (id_klienta,email,haslo) values ('$id','$mail','$pass1')";
				//$result = pg_query($query) or die('Query failed: ' . pg_last_error());
				//pg_close($dbconn);
		}

}else{
            $query = "select nazwa,nazwisko,imie,adres,pesel,nip,nr_telefonu from klient where id_klienta='" . $_SESSION['id'] . "'";
            $result = pg_fetch_array(pg_query($query));

            $adres = explode("*", $result[3]);


            echo '
<div class="primary callout klient">
    <div class="row">
    <form method="post">
        <div class="row large-12">
        
        <h3>REZERWACJA</h3>
        
            <input type="radio" name="typ" id="firma" value="f" ' . ((!empty($result[0])) ? 'checked="checked"' : '') . '><label for="firma">FIRMA</label>
            <input type="radio" name="typ" id="osoba" value="of" ' . ((empty($result[0])) ? 'checked="checked"' : '') . '><label for="osoba">OSOBA FIZYCZNA</label>

            <label><strong><h4>DANE KLIENTA</h4></strong></label>

            <table class="table ramka3">
                <thead>
                <tr>
                
                    <th>ID klienta
                    <input type="text" name="id" value="' . $_SESSION['id'] . '" /></th>
                
                    <th>Imię
                    <input type="text" name="imie" value="' . $result[2] . '" ' . ((!empty($result[0])) ? 'disabled' : '') . '/></th>

                    <th>Nazwisko
                        <input type="text" name="nazw" value="' . $result[1] . '" ' . ((!empty($result[0])) ? 'disabled' : '') . '/></th>

                    <th>PESEL
                        <input type="text" name="pesel" value="' . $result[4] . '" ' . ((!empty($result[0])) ? 'disabled' : '') . '/></th>

                    <th>Numer telefonu
                        <input type="text" name="tel" value="' . $result[6] . '" /></th>
                </tr>
                </thead>

                <thead>
                <tr>
                    <th>Nazwa firmy
                        <input type="text" name="nfirmy" value="' . $result[0] . '" ' . ((empty($result[0])) ? 'disabled' : '') . '/></th>

                    <th>NIP
                        <input type="text" name="nip" value="' . $result[5] . '" ' . ((empty($result[0])) ? 'disabled' : '') . '/></th>
                </tr>
                </thead>


                <thead>
                <tr>
                    <th>Miasto
                        <input type="text" name="miasto" value="' . $adres[1] . '" /></th>

                    <th>Ulica
                        <input type="text" name="ulica" value="' . $adres[2] . '" /></th>

                    <th>Kod pocztowy
                        <input type="text" name="kod" value="' . $adres[0] . '" /></th>

                    <th>Numer lokalu
                        <input type="text" name="nlokalu" value="' . $adres[4] . '" /></th>

                    <th>Numer mieszkania
                        <input type="text" name="nmieszk" value="' . $adres[3] . '" /></th>
                </tr>
                </thead>
            </table>
               
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


            $query = "select data_przyjazdu, data_wyjazdu from rezerwacja
                      where id_klienta='" . $_SESSION['id'] . "'";
            $result = pg_fetch_array(pg_query($query));

            echo'
            
 <div class="column">
    <label><strong><h4>DANE REZERWACJI</h4></strong></label>
    <table class="table">
        <thead>
        <tr>
            <th>Data przyjazdu:
                <input type="text" name ="dp" class="span2"  id="dpd1" value ="' . $result[0] . '" disabled>
               
            </th>
            <th>Data wyjazdu:
                <input type="text" name ="dw" class="span2" id="dpd2" value ="' . $result[1] . '" disabled>
            </th>
';
     $query = "select typ_pokoju.typ from typ_pokoju 
                      join pokoj on pokoj.typ=typ_pokoju.typ
                      join rezerwacja_pokoju on rezerwacja_pokoju.id_pokoju=pokoj.id_pokoju
                      join rezerwacja on rezerwacja.id_rez_pok=rezerwacja_pokoju.id_rez_pok
                      where rezerwacja.id_klienta='" . $_SESSION['id'] . "'";
                      
            $result = pg_fetch_array(pg_query($query));
            echo'
            <th> Ilość osób:
                <select>
                    <option value="' . $result[0] . '" name="tp">' . $result[0] . '</option>
                </select>
            </th>

            <th>Usługi dodatkowe:
                <br>
                <input id="checkbox1" name="usl1" type="checkbox"><label for="checkbox1">Parking</label>
                <input id="checkbox2" name="usl2" type="checkbox"><label for="checkbox2">Sprzątanie</label>
                <input id="checkbox3" name="usl3" type="checkbox"><label for="checkbox3">Śniadanie</label>
            </th>

        </tr>
        </thead>

    </table>


    <label><strong><h4>PŁATNOŚĆ</h4></strong></label>
    <table class="table">
        <div class="column">

            <div class="row large-4">
                <input type="text" placeholder="Cena" />
                <a href="#" class="button radius">Oblicz cenę</a>
            </div>
        </div>
    </table>
    <label><strong><h6>Sposób płatności</h6></strong></label>
    <table class="table">
        <div class="column">
            <input type="radio" name="platnosc" id="platnosc" value="g" checked><label for="gotowka">Gotówką</label>
            <input type="radio" name="platnosc" id="platnosc" value="k"><label for="karta">Kartą</label>
        </div>
    </table>

    <label><strong><h6>Rodzaj rachunku</h6></strong></label>
    <table class="table">
        <div class="column">

            <input type="radio" name="rachunek" id="rachunek" value="p" checked><label for="paragon">Paragon</label>
            <input type="radio" name="rachunek" id="rachunek" value="f"><label for="faktura">Faktura</label>
        </div>
    </table>

</div>
         <div class="large-12">
            <input type="submit" name="zapisz" class="button rejestracja2" value="ZAREZERWUJ" />
                </div>
        </div>
        </form>
    </div>
</div>
';}
        }
        }
?>
