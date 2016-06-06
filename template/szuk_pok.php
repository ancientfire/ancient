<?php

if($_SESSION['valid']) {
    include 'config.php';

if(!empty($_GET['r'])){
	if($_SESSION['p']){
		//echo $_SESSION['p'].' '.$_SESSION['dp'].' '.$_SESSION['dw'];
		
		$query = "insert into rezerwacja_pokoju (id_pokoju) values ('".$_SESSION['p']."') returning id_rez_pok";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		$id_rez = pg_fetch_row($result)['0'];
		
		$data=date('o-m-d');
        $query = "insert into rezerwacja (data_przyjazdu,data_wyjazdu, data_rezerwacji, id_klienta, id_rez_pok) values ('".$_SESSION['dp']."','".$_SESSION['dw']."', '$data','".$_SESSION['id']."','$id_rez') returning id_rezerwacji";
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
        $id_rezerwacji = pg_fetch_row($result)['0'];

        if ($_SESSION['kp']) {

if(isset($_POST['zapisz'])){
$query = "select typ_pokoju.cena from pokoj inner join typ_pokoju on (pokoj.typ=typ_pokoju.typ) where pokoj.id_pokoju='".$_SESSION['p']."'";
//echo $query;
$cena = pg_fetch_array(pg_query($query))[0];
$start = strtotime($_SESSION['dp']);
$end = strtotime($_SESSION['dw']);
$dni = ceil(abs($end - $start) / 86400);
$cena*=$dni;

if(isset($_POST['usl1'])) { 
				$query = "insert into usluga (id_uslugi,id_rez_pok) values ('3','$id_rez')";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	 }
if(isset($_POST['usl2'])) { 
				$query = "insert into usluga (id_uslugi,id_rez_pok) values ('1','$id_rez')";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	 }
if(isset($_POST['usl3'])) { 
				$query = "insert into usluga (id_uslugi,id_rez_pok) values ('2','$id_rez')";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	 }
				$query = "insert into rachunek (id_rezerwacji,cena,id_rodz_rach,id_rodz_plat) values ('$id_rezerwacji','$cena','".$_POST['rachunek']."','".$_POST['platnosc']."')";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		unset($_SESSION['p']);
		unset($_SESSION['dp']);
		unset($_SESSION['dw']);
	 			pg_close($dbconn);
	 							echo '
				<div class="callout primary rejestr">
				<div class="row">
				<div class="small-3 small-centered columns text-center">		
				Zarezerwowano.
				</div>
				</div>
				</div>';
	header( "refresh:3;url=index.php" );

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
                      where id_klienta='" . $_SESSION['id'] . "' and id_rezerwacji='$id_rezerwacji'";
            $result = pg_fetch_array(pg_query($query));

            echo'
            
 <div class="column">
    <label><strong><h4>DANE REZERWACJI</h4></strong></label>
    <table class="table">
        <thead>
        <tr>
            <th>Data przyjazdu:
                <input type="text" name ="dp" class="span2"  id="dpd1" value ="' . $result[0] . '">
               
            </th>
            <th>Data wyjazdu:
                <input type="text" name ="dw" class="span2" id="dpd2" value ="' . $result[1] . '">
            </th>
';
     $query = "select typ from pokoj where id_pokoju='".$_SESSION['p']."'";
            $result = pg_fetch_array(pg_query($query));
            echo'
            <th> Ilość osób:
                <select>
                    <option value="' . $result[0] . '" name="tp">' . $result[0] . '</option>
                </select>
            </th>

            <th>Usługi dodatkowe:
                <br>
                <input id="checkbox1" name="usl1" type="checkbox" value="3"><label for="checkbox1">Parking</label>
                <input id="checkbox2" name="usl2" type="checkbox" value="1"><label for="checkbox2">Sprzątanie</label>
                <input id="checkbox3" name="usl3" type="checkbox" value="2"><label for="checkbox3">Śniadanie</label>
            </th>

        </tr>
        </thead>

    </table>


    <label><strong><h4>PŁATNOŚĆ</h4></strong></label>
   
    <label><strong><h6>Sposób płatności</h6></strong></label>
    <table class="table">
        <div class="column">
            <input type="radio" name="platnosc" value="1" checked><label for="gotowka">Gotówką</label>
            <input type="radio" name="platnosc" value="2"><label for="karta">Kartą</label>
        </div>
    </table>

    <label><strong><h6>Rodzaj rachunku</h6></strong></label>
    <table class="table">
        <div class="column">

            <input type="radio" name="rachunek" value="1" checked><label for="paragon">Paragon</label>
            <input type="radio" name="rachunek" value="2"><label for="faktura">Faktura</label>
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
	
}else{

    if (isset($_POST['wyszukaj'])) {


        $dp = date('o-m-d', strtotime($_POST['dp']));
        $dw = date('o-m-d', strtotime($_POST['dw']));

        $io = $_POST['io'];


        if ($_SESSION['kp']) {

            if (!empty($dw) && !empty($dp) && !empty($io)) {

/*
				$data=date('o-m-d');
                $query = "insert into rezerwacja (data_przyjazdu,data_wyjazdu, data_rezerwacji, id_klienta) values ('$dp','$dw', '$data','".$_SESSION['id']."')";
				//echo $query;
                $result = pg_query($query) or die('Query failed: ' . pg_last_error());


                //$query = "insert into typ _pokoju (typ) values ('$io')";
                //$result = pg_query($query) or die('Query failed: ' . pg_last_error());
*/

				$query = "select * from pokoj left outer join typ_pokoju on pokoj.typ=typ_pokoju.typ 
left outer join rezerwacja_pokoju on pokoj.id_pokoju=rezerwacja_pokoju.id_pokoju
 left outer join rezerwacja on rezerwacja_pokoju.id_rez_pok=rezerwacja.id_rez_pok where pokoj.typ='$io' and (not ('$dp' between rezerwacja.data_przyjazdu and rezerwacja.data_wyjazdu) and not ('$dw' between rezerwacja.data_przyjazdu and rezerwacja.data_wyjazdu) or rezerwacja_pokoju.id_pokoju is null) limit 1";
				$result = pg_fetch_row(pg_query($query));
				$_SESSION['p'] = $result[1];
				$_SESSION['dp'] = $dp;
				$_SESSION['dw'] = $dw;
				if($result){
					echo "<div class=\"primary callout archive\">
    <div class=\"row large-10\">
        <h3><strong>Baza pokoi</strong></h3>
        <table>
            <thead>
            <tr>

                <th width=\"100\">Ilość osób</th>
                <th width=\"200\">Opis</th>
                <th width=\"100\">Cena</th>
            </tr>
            </thead><tbody>
            <tr>
                <td>$result[2]</td>
                <td>Ten pokój spełni Twoje najśmielsze oczekiwania! Został wybrany specjalnie dla Ciebie! <br> Zarezerwuj już dziś!</td>
                <td>$result[4]</td>
            </tr>
            </tbody>
        </table>
        
    <div class=\"large-12\">
                   <a href=\"?s=szuk_pok&r=1\" class=\"button \" >ZAREZERWUJ </a>
                   </div>
    </div>
</div>";
				}

                pg_close($dbconn);
			
			}
		} 
		
		
}else{
                echo '
                <div class="primary callout ramka3">
    <div class="row large-7">
    <form method="post">
        <h1><strong>Sprawdź dostępność</strong></h1>
        <div class="column">
            <table class="table">
                <thead>
                <tr>
                    <th>Data przyjazdu:
                        <input type="text" class="span2" name="dp" id="dpd1" >
                    </th>
                    <th>Data wyjazdu:
                        <input type="text" class="span2" name="dw" id="dpd2">
                    </th>
                    <th> Ilość osób:
                        <select name="io">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
                        </select> </th>
                </tr>
                </thead>
            </table>
<div class="large-12">
                   <input type="submit" name="wyszukaj" class="button radius" value="Wyszukaj" />
                   </div>
            <script>
                // implementation of disabled form fields
                var nowTemp = new Date();
                var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
                var checkin = $(\'#dpd1\').fdatepicker({
                    onRender: function (date) {
                        return date.valueOf() < now.valueOf() ? \'disabled\' : \'\';
                    }
                }).on(\'changeDate\', function (ev) {
                    if (ev.date.valueOf() > checkout.date.valueOf()) {
                        var newDate = new Date(ev.date)
                        newDate.setDate(newDate.getDate() + 1);
                        checkout.update(newDate);
                    }
                    checkin.hide();
                    $(\'#dpd2\')[0].focus();
                }).data(\'datepicker\');
                var checkout = $(\'#dpd2\').fdatepicker({
                    onRender: function (date) {
                        return date.valueOf() <= checkin.date.valueOf() ? \'disabled\' : \'\';
                    }
                }).on(\'changeDate\', function (ev) {
                    checkout.hide();
                }).data(\'datepicker\');
            </script>
        </div>
    </form>
    </div>
</div>
';
}
}
}
       ?>
