<?php

include 'config.php';

echo '
<div class="primary callout archive">
    <div class="row large-10">
        <h3><strong>Baza pokoi</strong></h3>
        <table>
            <thead>
            <tr>

                <th width="100">Ilość osób</th>
                <th width="200">Opis</th>
                <th width="100">Cena</th>
            </tr>
            </thead><tbody>';

$query = "select * from pokoj left outer join typ_pokoju on pokoj.typ=typ_pokoju.typ left outer join rezerwacja_pokoju on pokoj.id_pokoju=rezerwacja_pokoju.id_pokoju left outer join rezerwacja on rezerwacja_pokoju.id_rez_pok=rezerwacja.id_rez_pok where pokoj.typ=3 and (not ('2016-06-11' between rezerwacja.data_przyjazdu and rezerwacja.data_wyjazdu) and not ('2016-06-11' between rezerwacja.data_przyjazdu and rezerwacja.data_wyjazdu) or rezerwacja_pokoju.id_pokoju is null) limit 1";
$result = pg_query($query);

while ($row = pg_fetch_row($result)){
echo "
            <tr>
                <td>$row[2]</td>
                <td>Chuj dupa i kamieni kupa.</td>
                <td>$row[4]</td>
            </tr>";
		}
pg_close($dbconn);
echo '
            </tbody>
        </table>
        
    <div class="large-12">
                   <input type="submit" name="zarezerwuj" class="button radius" value="ZAREZERWUJ" />
                   </div>
    </div>
</div>';

?>
