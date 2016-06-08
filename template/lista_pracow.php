<?php
include 'config.php';
echo'
<div class="primary callout archive">
    <div class="row large-10">
        <h3><strong>Baza pracowników</strong></h3>
        <table>
            <thead>
            <tr>
                <th width="100">ID pracownika</th>
                <th width="100">Imię</th>
                <th width="100">Nazwisko</th>
                <th width="100">Data zatrudnienia</th>
                <th width="100">Stanowisko</th>
            </tr>
            </thead>
            <tbody>
				';

    $query="select pracownik.id_pracownika, pracownik.imie, pracownik.nazwisko, zatrudnienie.data_zatrudnienia, stanowisko.nazwa_stanowiska 
from pracownik inner join zatrudnienie on zatrudnienie.id_pracownika=pracownik.id_pracownika 
inner join stanowisko on stanowisko.id_stanowiska = pracownik.id_stanowiska 
order by data_zatrudnienia, nazwisko, imie asc";



//echo $query;
$result = pg_query($query);

while($row=pg_fetch_row($result)) {
    echo "
            <tr>
                <td>$row[0]</td>
                <td>$row[1]</td>
                <td>$row[2]</td>
                <td>$row[3]</td>
                <td>$row[4]</td>
            </tr>";
}

echo '
            </tbody>
        </table>
    </div>
</div>';

?>
