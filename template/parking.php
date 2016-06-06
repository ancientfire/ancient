<?php

if($_SESSION['valid']) {
    include 'config.php';

    $data1 = date('o-m-d');

    $query = "select count(id_uslugi) from usluga 
join rezerwacja_pokoju on rezerwacja_pokoju.id_rez_pok=usluga.id_rez_pok
join rezerwacja on rezerwacja.id_rez_pok=rezerwacja_pokoju.id_rez_pok
where id_uslugi='3' and (current_date >= rezerwacja.data_przyjazdu and current_date <= rezerwacja.data_wyjazdu)";

    $result = pg_query($query);

    echo '
<div class="primary callout archive">
    <div class="row large-7">
        <h3><strong>Ilość zajętych miejsc parkingowych</strong></h3>
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
}
       ?>