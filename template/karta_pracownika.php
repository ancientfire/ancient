<?php
include 'config.php';
echo'
<div class="primary callout archive">
    <div class="row large-7">
        <h3><strong>Karta pracownika</strong></h3>
        <table>
        
            <tbody>
				';

$query="select 'Pan(i) ' || pracownik.imie || ' ' || pracownik.nazwisko || ' pracuje w Hotelu Project ' || ' od ' || zatrudnienie.data_zatrudnienia || ' na stanowisku ' || stanowisko.nazwa_stanowiska
 from pracownik join zatrudnienie on zatrudnienie.id_pracownika=pracownik.id_pracownika
join stanowisko on stanowisko.id_stanowiska = pracownik.id_stanowiska
where pracownik.id_pracownika='".$_SESSION['id']."'";

//echo $query;
$result = pg_query($query);

while($row=pg_fetch_row($result)) {
    echo "
            <tr>
                <td>$row[0]</td>
                <td>$row[1]</td>
                <td>$row[2]</td>
                <td>$row[3]</td>
                
            </tr>";
}

echo '
            </tbody>
        </table>
    </div>
</div>';

?>
