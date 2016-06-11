<?php
include 'config.php';
echo'
<div class="primary callout archive">
    <div class="row large-7">
        <h3><strong>Karta pobytu</strong></h3>
        <table>
        
            <tbody>
				';

if($_SESSION['s']==1) {
    echo '
			<select name="idr" onchange="location = this.value;">
			<option disabled selected value> Wybierz ID rezerwacji pokoju </option>';

    $query = "select id_rez_pok from rezerwacja";

    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    


        while ($row = pg_fetch_row($result)) {
            echo "<option value='?s=karta&idr=$row[0]'>$row[0]</option>";
        }
    echo '</select>';
    
    if(isset($_GET['idr'])){
		
		$query = "select 'Pan(i) ' || meldunek.imie || ' ' || meldunek.nazwisko || ' przebywał(a) w Hotelu Project od: ' || rezerwacja.data_przyjazdu || ' do: ' || rezerwacja.data_wyjazdu || '. '
 from meldunek 
 join rezerwacja_pokoju on rezerwacja_pokoju.id_rez_pok = meldunek.id_rez_pok 
 join rezerwacja on rezerwacja.id_rez_pok= rezerwacja_pokoju.id_rez_pok
 where meldunek.id_rez_pok='" . $_GET['idr'] . "'";
 
 //echo $query;
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
}else{
	
	$query="select 'Pan(i) ' || klient.imie || ' ' || klient.nazwisko || ' przebywał(a) w Hotelu Project od: ' || rezerwacja.data_przyjazdu || ' do: ' || rezerwacja.data_wyjazdu || '. ' \n || 'Całkowity koszt pobytu wyniósł: ' || rachunek.cena \n || '. Rodzaj płatności: ' || rodzaj_platnosci.nazwa_rodz_plat || '. Rodzaj rachunku: ' || rodzaj_rachunku.nazwa_rodz_rach|| '.'
 from klient join rezerwacja on rezerwacja.id_klienta=klient.id_klienta
join rachunek on rachunek.id_rezerwacji= rezerwacja.id_rezerwacji
join rodzaj_platnosci on rodzaj_platnosci.id_rodz_plat=rachunek.id_rodz_plat
join rodzaj_rachunku on rodzaj_rachunku.id_rodz_rach=rachunek.id_rodz_rach 
where klient.id_klienta='".$_SESSION['id']."'";


//echo $query.' '.$_SESSION['s'];
$result = pg_query($query);

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

                echo '
            </tbody>
        </table>
    </div>
</div>';
?>
