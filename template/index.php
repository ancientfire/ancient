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
                    <a class="th" role="button" aria-label="Thumbnail" href="?s=kontakt">
                        <img aria-hidden=true src="KONTAKT.png"/>
                    </a>
                </div>
            </div></br>
';
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
                <th width="100">Sposób płatności</th>
                <th width="100">Cena</th>
            </tr>
            </thead><tbody>';
						$data = date('o-m-d');
						$query = "select rezerwacja.id_rezerwacji, rezerwacja.id_klienta, rezerwacja.id_rez_pok, rezerwacja.data_przyjazdu, rezerwacja.data_wyjazdu, rodzaj_platnosci.nazwa_rodz_plat, rachunek.cena 
from rezerwacja join rachunek on rachunek.id_rezerwacji= rezerwacja.id_rezerwacji 
left outer join rodzaj_platnosci on rodzaj_platnosci.id_rodz_plat=rachunek.id_rodz_plat
where rezerwacja.data_wyjazdu > '$data'
order by rezerwacja.data_przyjazdu asc limit 3";

						
						$result = pg_query($query) or die('Query failed: ' . pg_last_error());

						while ($row = pg_fetch_row($result)) {
							echo "       
            <tr>
               <td>$row[0]</td>
                <td>$row[1]</td>
                <td>$row[2]</td>
                <td>$row[3]</td>
                <td>$row[4]</td>
                <td>$row[5]</td>
                <td>$row[6]</td>
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
                <th width="100">Sposób płatności</th>
                <th width="100">Cena</th>
            </tr>
            </thead>
            <tbody>';
						$data = date('o-m-d');
						$query = "select rezerwacja.id_rezerwacji, rezerwacja.id_klienta, rezerwacja.id_rez_pok, rezerwacja.data_przyjazdu, rezerwacja.data_wyjazdu, rodzaj_platnosci.nazwa_rodz_plat, rachunek.cena 
from rezerwacja join rachunek on rachunek.id_rezerwacji= rezerwacja.id_rezerwacji 
left outer join rodzaj_platnosci on rodzaj_platnosci.id_rodz_plat=rachunek.id_rodz_plat
where rezerwacja.data_wyjazdu > '$data'
order by rezerwacja.data_przyjazdu asc ";


						$result = pg_query($query) or die('Query failed: ' . pg_last_error());

						while ($row = pg_fetch_row($result)) {

							echo "       
            <tr>
                <td>$row[0]</td>
                <td>$row[1]</td>
                <td>$row[2]</td>
                <td>$row[3]</td>
                <td>$row[4]</td>
                <td>$row[5]</td>
                <td>$row[6]</td>
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
left outer join rezerwacja_pokoju on rezerwacja_pokoju.id_rez_pok=usluga.id_rez_pok
left outer join rezerwacja on rezerwacja.id_rez_pok=rezerwacja_pokoju.id_rez_pok
left outer join pokoj on pokoj.id_pokoju= rezerwacja_pokoju.id_pokoju
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
$data=date('o-m-d');
					$query = "select rezerwacja.data_przyjazdu, rezerwacja.data_wyjazdu,rezerwacja_pokoju.id_pokoju from rezerwacja
					left outer join usluga on usluga.id_rez_pok=rezerwacja.id_rez_pok
					left outer join rezerwacja_pokoju on rezerwacja_pokoju.id_rez_pok=usluga.id_rez_pok
					where id_uslugi='1' and '$data' between rezerwacja.data_przyjazdu and rezerwacja.data_wyjazdu
					order by rezerwacja_pokoju.id_pokoju";

					$result = pg_query($query);

					echo '
<div class="primary callout archive">
    <div class="row large-7">
        <h3><strong>Pokoje do sprzątania</strong></h3>
        <table>
        
        		<thead>
            	<tr>
                	<th width="100">ID pokoju</th>
                </tr>
                </thead>
        
            <tbody>
				';
					while ($row = pg_fetch_row($result)) {
						echo "
            <tr>
                <td>$row[2]</td>
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
					
					
<div class="primary callout archive">
    <div class="row large-10">
        <h3><strong>Oferta</strong></h3>
        <p><a href="?s=oferta">Zobacz więcej>></a></p>
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
                <th width="150">Sposób płatności</th>
                <th width="150">Cena</th>
            </tr>
            </thead><tbody>';
$data=date('o-m-d');
					$query = "select rezerwacja.data_przyjazdu, rezerwacja.data_wyjazdu, rodzaj_platnosci.nazwa_rodz_plat, rachunek.cena
from rezerwacja join rachunek on rachunek.id_rezerwacji= rezerwacja.id_rezerwacji 
left outer join rodzaj_platnosci on rodzaj_platnosci.id_rodz_plat=rachunek.id_rodz_plat
where id_klienta=".$_SESSION['id']." and rezerwacja.data_wyjazdu >'$data' limit 3";

					//echo $query;
					$result = pg_query($query) or die('Query failed: ' . pg_last_error());

					while($row=pg_fetch_row($result)){
						echo "       
            <tr>
                <td>$row[0]</td>
                <td>$row[1]</td>
        		<td>$row[2]</td>
        		<td>$row[3]</td>
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
                <th width="150">Sposób płatności</th>
                <th width="150">Cena</th>
            </tr>
            </thead>
            <tbody>';
					$data=date('o-m-d');
					$query = "select rezerwacja.data_przyjazdu, rezerwacja.data_wyjazdu, rodzaj_platnosci.nazwa_rodz_plat, rachunek.cena
from rezerwacja join rachunek on rachunek.id_rezerwacji= rezerwacja.id_rezerwacji 
left outer join rodzaj_platnosci on rodzaj_platnosci.id_rodz_plat=rachunek.id_rodz_plat
where id_klienta=".$_SESSION['id']." and rezerwacja.data_wyjazdu >'$data'";

					$result = pg_query($query) or die('Query failed: ' . pg_last_error());

					while($row=pg_fetch_row($result)){
						echo "       
            <tr>
            n   <td>$row[0]</td>
                <td>$row[1]</td>
        		<td>$row[2]</td>
        		<td>$row[3]</td>
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
