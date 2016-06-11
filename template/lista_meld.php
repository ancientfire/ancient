<?php
include 'config.php';
echo'
<div class="primary callout archive">
    <div class="row large-10">
        <h3><strong>Aktualne meldunki</strong></h3>
        <table>
            <thead>
            <tr>
                <th width="100">ID rezerwacji pokoju</th>
                <th width="100">Imię</th>
                <th width="100">Nazwisko</th>
                <th width="100">PESEL</th>
                <th width="100">Data przyjazdu</th>
                <th width="100">Data wyjazdu</th>
            
            </tr>
            </thead>
            <tbody>
				';
$data=date('o-m-d');

$query="select meldunek.id_rez_pok, meldunek.imie , meldunek.nazwisko, meldunek.pesel, rezerwacja.data_przyjazdu, rezerwacja.data_wyjazdu
from meldunek 
join rezerwacja_pokoju on rezerwacja_pokoju.id_rez_pok=meldunek.id_rez_pok
join rezerwacja on rezerwacja.id_rez_pok = rezerwacja_pokoju.id_rez_pok
where rezerwacja.data_wyjazdu > '$data'
order by data_przyjazdu, data_wyjazdu, nazwisko, imie asc";



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
                <td>$row[5]</td>
            </tr>";
}

echo '
            </tbody>
        </table>
    </div>
</div>';

?>
