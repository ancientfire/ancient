<?php

include 'config.php';
if(!isset($_SESSION['valid'])){
	echo '
          <br> <div class="callout primary">
                <div class="row">
                    <div class="column">
                        <img src="banner.png">
                    </div>
                </div>
            </div></br>

            <br><div class="row small-up-3 medium-up-3 large-up-3">
                <div class="column">
                    <a class="th" role="button" aria-label="Thumbnail" href="?s=ohotelu">
                        <img aria-hidden=true src="OHOTELU.png"/>
                    </a>
                </div>
                <div class="column">
                    <a class="th" role="button" aria-label="Thumbnail" href="?s=oferta">
                        <img aria-hidden=true src="OFERTA.png"/>
                        </a>
                </div>
            
                <div class="column">
                    <a class="th" role="button" aria-label="Thumbnail" href="?s=szuk_pok">
                        <img aria-hidden=true src="ZAREZERWUJ.png"/>
                    </a>
                </div>
            </div></br>
<br>
            <div class="primary callout">
                <div class="row large-7">
                    <h1><strong>Zarezerwuj już dziś!</strong></h1>
                    <div class="column">
            <table class="table">
                <thead>
                <tr>
                    <th>Data przyjazdu:
                        <input type="text" class="span2" value="" id="dpd1">
                    </th>
                    <th>Data wyjazdu:
                        <input type="text" class="span2" value="" id="dpd2">
                    </th>
                   <th> Ilość osób:
                    <select>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                       
                        <option value="6">6</option>
                    </select> </th>

                  <th><br><a href="?s=logowanie" class="button radius">Wyszukaj</a></br></th>
                </tr>
                </thead>
            </table>

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

                </div>
            </div>';
		}else{
			
			if($_SESSION['s']==0){
			echo '
			<div class="primary callout klient">
    <div class="row large-10">
        <h3><strong>Baza pracowników</strong></h3>
            <p><a href="?s=lista_pracow">Zobacz więcej>></a></p>
    </div>
</div>

<div class="primary callout">
    <div class="row large-10">
        <h3><strong>Oferta</strong></h3>
        <p><a href="?s=oferta">Zobacz więcej>></a></p>
    </div>
</div>


<div class="primary callout">
    <div class="row large-10">
        <h3><strong>Grafik</strong></h3>
        <p><a href="?s=wysw_grafik&l=2">Zobacz więcej>></a></p>
    </div>
</div>
			';	
				
			}else {
				if ($_SESSION['s'] == 1) {
					if ($_GET['h'] != 1) {
						echo '
<div class="primary callout archive">
    <div class="row large-10">
        <h3><strong>Aktualne rezerwacje</strong></h3>
        <table>
            <thead>
            <tr>
                <th width="100">ID rezerwacji</th>
                <th width="100">ID klienta</th>
                <th width="100">ID rez pokoju</th>
                <th width="100">Data przyjazdu</th>
                <th width="100">Data wyjazdu</th>
                <th width="200">Usługi dodatkowe</th>
                <th width="100">Sposób płatności</th>
                <th width="100">Cena</th>
            </tr>
            </thead><tbody>';

						$query = "select rezerwacja.id_rezerwacji, rezerwacja.id_klienta, rezerwacja.id_rez_pok, rezerwacja.data_przyjazdu, rezerwacja.data_wyjazdu, typ_uslugi.nazwa_uslugi, rodzaj_platnosci.nazwa_rodz_plat, rachunek.cena 
from rezerwacja join rachunek on rachunek.id_rezerwacji= rezerwacja.id_rezerwacji 
join usluga on usluga.id_rez_pok=rezerwacja.id_rez_pok 
join typ_uslugi on typ_uslugi.id_uslugi=usluga.id_uslugi
join rodzaj_platnosci on rodzaj_platnosci.id_rodz_plat=rachunek.id_rodz_plat limit 3";
						$result = pg_query($query) or die('Query failed: ' . pg_last_error());

						while ($row = pg_fetch_row($result)) {
							echo "       
            <tr>
               <td>$row[0]</td>
                <td>$row[1]</td>
                <td>$row[2]</td>
                <td>$row[3]</td>
                <td>$row[4]</td>
                <td>$row[5] </td>
                <td>$row[6]</td>
                <td>$row[7]</td>
            </tr>";
						}
						pg_close($dbconn);
						echo '
            </tbody>

        </table>
        <div class="large-2 columns">
            <p><a href="?h=1">Zobacz więcej>></a></p>
        </div>
    </div>
</div>';
					} else {
						echo '
	<div class="primary callout archive">
    <div class="row large-10">
        <h3><strong>Aktualne rezerwacje</strong></h3>
        <table>
            <thead>
            <tr>
                <th width="100">ID rezerwacji</th>
                <th width="100">ID klienta</th>
                <th width="100">ID rez pokoju</th>
                <th width="100">Data przyjazdu</th>
                <th width="100">Data wyjazdu</th>
                <th width="200">Usługi dodatkowe</th>
                <th width="100">Sposób płatności</th>
                <th width="100">Cena</th>
            </tr>
            </thead>
            <tbody>';
						$query = "select rezerwacja.id_rezerwacji, rezerwacja.id_klienta, rezerwacja.id_rez_pok, rezerwacja.data_przyjazdu, rezerwacja.data_wyjazdu, typ_uslugi.nazwa_uslugi, rodzaj_platnosci.nazwa_rodz_plat, rachunek.cena 
from rezerwacja join rachunek on rachunek.id_rezerwacji= rezerwacja.id_rezerwacji 
join usluga on usluga.id_rez_pok=rezerwacja.id_rez_pok 
join typ_uslugi on typ_uslugi.id_uslugi=usluga.id_uslugi
join rodzaj_platnosci on rodzaj_platnosci.id_rodz_plat=rachunek.id_rodz_plat";


						$result = pg_query($query) or die('Query failed: ' . pg_last_error());

						while ($row = pg_fetch_row($result)) {

							echo "       
            <tr>
                <td>$row[0]</td>
                <td>$row[1]</td>
                <td>$row[2]</td>
                <td>$row[3]</td>
                <td>$row[4]</td>
                <td>$row[5] </td>
                <td>$row[6]</td>
                <td>$row[7]</td>
            </tr>";
						}
						pg_close($dbconn);
						echo ' </tbody>
        </table>
    </div>
</div>';

					}
				} else if ($_SESSION['s'] == 2) {
					echo '
<div class="primary callout archive">
    <div class="row large-7">
        <h3><strong>Ilość posiłków na dany dzień</strong></h3>
        <table>
        <thead>
            <tr>
                <th width="100">ID pokoju</th>
                <th width="100">Ilość śniadań</th>
                </tr>
                </thead>
        
            <tbody>
				';

					$query = "select count(id_uslugi), pokoj.typ, pokoj.id_pokoju from usluga 
join rezerwacja_pokoju on rezerwacja_pokoju.id_rez_pok=usluga.id_rez_pok
join rezerwacja on rezerwacja.id_rez_pok=rezerwacja_pokoju.id_rez_pok
join pokoj on pokoj.id_pokoju= rezerwacja_pokoju.id_pokoju
where id_uslugi='2' and current_date between rezerwacja.data_przyjazdu and rezerwacja.data_wyjazdu
group by pokoj.typ, pokoj.id_pokoju";

					$result = pg_query($query);
					while ($row = pg_fetch_row($result)) {
						echo "
            <tr>
                <td>$row[2]</td>
                <td>$row[1]</td>
            </tr>";
					}

					echo '
            </tbody>
        </table>
    </div>
</div>';


				} else if ($_SESSION['s'] == 3) {

					$query = "select count(id_uslugi) from usluga 
join rezerwacja_pokoju on rezerwacja_pokoju.id_rez_pok=usluga.id_rez_pok
join rezerwacja on rezerwacja.id_rez_pok=rezerwacja_pokoju.id_rez_pok
where id_uslugi='1' and current_date between rezerwacja.data_przyjazdu and rezerwacja.data_wyjazdu";

					$result = pg_query($query);

					echo '
<div class="primary callout archive">
    <div class="row large-7">
        <h3><strong>Ilość pokoi do sprzątania</strong></h3>
        <table>
        
        
        
            <tbody>
				';
					while ($row = pg_fetch_row($result)) {
						echo "
            <tr>
                <td>$row[0]</td>
            </tr>";
					}

					echo '
            </tbody>
        </table>
    </div>
</div>';
			}else{

				if($_GET['h']!=1){
					echo '
			<div class="primary callout klient">
    <div class="row large-7">
        <h1><strong>Zarezerwuj już dziś!</strong></h1>
        <div class="column">
            <table class="table">
                <thead>
                <tr>
                    <th>Data przyjazdu:
                        <input type="text" class="span2" value="" id="dpd1">
                    </th>
                    <th>Data wyjazdu:
                        <input type="text" class="span2" value="" id="dpd2">
                    </th>
                    <th> Ilość osób:
                        <select>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                     
                            <option value="6">6</option>
                        </select> </th>

                    <th><br><a href="?s=szuk_pok" class="button radius">Wyszukaj</a></br></th>
                </tr>
                </thead>
            </table>

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
    </div>
</div>
<div class="primary callout archive">
    <div class="row large-10">
        <h3><strong>Twoje rezerwacje</strong></h3>
        <table>
            <thead>
            <tr>
                <th width="150">Data przyjazdu</th>
                <th width="150">Data wyjazdu</th>
                <th width="400">Usługi dodatkowe</th>
                <th width="150">Sposób płatności</th>
                <th width="150">Cena</th>
            </tr>
            </thead><tbody>';

					$query = "select rezerwacja.data_przyjazdu, rezerwacja.data_wyjazdu, typ_uslugi.nazwa_uslugi, rodzaj_platnosci.nazwa_rodz_plat, rachunek.cena
from rezerwacja join rachunek on rachunek.id_rezerwacji= rezerwacja.id_rezerwacji 
join usluga on usluga.id_rez_pok=rezerwacja.id_rez_pok 
join typ_uslugi on typ_uslugi.id_uslugi=usluga.id_uslugi
join rodzaj_platnosci on rodzaj_platnosci.id_rodz_plat=rachunek.id_rodz_plat
where id_klienta=".$_SESSION['id']." limit 3";
					$result = pg_query($query) or die('Query failed: ' . pg_last_error());

					while($row=pg_fetch_row($result)){
						echo "       
            <tr>
                <td>$row[0]</td>
                <td>$row[1]</td>
        		<td>$row[2]</td>
        		<td>$row[3]</td>
        		<td>$row[4]</td>
            </tr>";
					}
					pg_close($dbconn);
					echo '
            </tbody>

        </table>
        <div class="large-2 columns">
            <p><a href="?h=1">Zobacz więcej>></a></p>
        </div>
    </div>
</div>';
				}else{
					echo '
	<div class="primary callout archive">
    <div class="row large-10">
        <h3><strong> Twoje rezerwacje</strong></h3>
        <table>
            <thead>
            <tr>
                 <th width="150">Data przyjazdu</th>
                <th width="150">Data wyjazdu</th>
                <th width="400">Usługi dodatkowe</th>
                <th width="150">Sposób płatności</th>
                <th width="150">Cena</th>
            </tr>
            </thead>
            <tbody>';
					$query = "select rezerwacja.data_przyjazdu, rezerwacja.data_wyjazdu, typ_uslugi.nazwa_uslugi, rodzaj_platnosci.nazwa_rodz_plat, rachunek.cena
from rezerwacja join rachunek on rachunek.id_rezerwacji= rezerwacja.id_rezerwacji 
join usluga on usluga.id_rez_pok=rezerwacja.id_rez_pok 
join typ_uslugi on typ_uslugi.id_uslugi=usluga.id_uslugi
join rodzaj_platnosci on rodzaj_platnosci.id_rodz_plat=rachunek.id_rodz_plat
where id_klienta=".$_SESSION['id']."";
					$result = pg_query($query) or die('Query failed: ' . pg_last_error());

					while($row=pg_fetch_row($result)){
						echo "       
            <tr>
              <td>$row[0]</td>
                <td>$row[1]</td>
        		<td>$row[2]</td>
        		<td>$row[3]</td>
        		<td>$row[4]</td>
            </tr>";
					}
					pg_close($dbconn);
					echo ' </tbody>
        </table>
    </div>
</div>';

				}
			}
		}
}
?>
