<?php

if($_SESSION['valid']) {
    include 'config.php';

    $data1 = date('o-m-d');

    $query = "select count(id_uslugi), pokoj.typ, pokoj.id_pokoju from usluga 
join rezerwacja_pokoju on rezerwacja_pokoju.id_rez_pok=usluga.id_rez_pok
join rezerwacja on rezerwacja.id_rez_pok=rezerwacja_pokoju.id_rez_pok
join pokoj on pokoj.id_pokoju= rezerwacja_pokoju.id_pokoju
where id_uslugi='3' and current_date between rezerwacja.data_przyjazdu and rezerwacja.data_wyjazdu
group by pokoj.typ, pokoj.id_pokoju";

    $result = pg_query($query);

    echo '
<div class="primary callout archive">
    <div class="row large-7">
        <h3><strong>Ilość zajętych miejsc parkingowych</strong></h3>
        <table>
        <thead>
            <tr>
              
                <th width="100">ID pokoju</th>
                <th width="100">Zaparkowane samochody</th>
                </tr>
                </thead>
        
            <tbody>
				';
    while ($row = pg_fetch_row($result)) {
        echo "
            <tr>
               
                <td>$row[1]</td>
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