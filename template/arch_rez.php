<?php
include 'config.php';

if ($_SESSION['s']==1) {
    echo '
<div class="primary callout archive">
    <div class="row large-10">
        <h3><strong>Archiwum rezerwacji</strong></h3>
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
            <tbody>
				';
    $data = date('o-m-d');

    $query = "select rezerwacja.id_rezerwacji, rezerwacja.id_klienta, rezerwacja.id_rez_pok, rezerwacja.data_przyjazdu, rezerwacja.data_wyjazdu, rodzaj_platnosci.nazwa_rodz_plat, rachunek.cena 
from rezerwacja join rachunek on rachunek.id_rezerwacji= rezerwacja.id_rezerwacji 
join rodzaj_platnosci on rodzaj_platnosci.id_rodz_plat=rachunek.id_rodz_plat
where rezerwacja.data_wyjazdu < '$data'
 order by rezerwacja.data_przyjazdu";
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
}
else if($_SESSION['kp']=="k") {


    echo '<div class="primary callout archive">
    <div class="row large-10">
        <h3><strong> Archiwum Twoich rezerwacji</strong></h3>
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
    $data = date('o-m-d');
    $query = "select rezerwacja.data_przyjazdu, rezerwacja.data_wyjazdu, rodzaj_platnosci.nazwa_rodz_plat, rachunek.cena
from rezerwacja join rachunek on rachunek.id_rezerwacji= rezerwacja.id_rezerwacji 
join rodzaj_platnosci on rodzaj_platnosci.id_rodz_plat=rachunek.id_rodz_plat
where id_klienta=" . $_SESSION['id'] . " and rezerwacja.data_wyjazdu < '$data'";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());

    while ($row = pg_fetch_row($result)) {
        echo "       
            <tr>
              <td>$row[0]</td>
                <td>$row[1]</td>
        		<td>$row[2]</td>
        		<td>$row[3]</td>
   
            </tr>";
    }
}
					pg_close($dbconn);

echo '
            </tbody>
        </table>
    </div>
</div>';

?>
