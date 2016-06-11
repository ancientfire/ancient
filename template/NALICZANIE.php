<?php

if($_SESSION['valid']) {
    include 'config.php';
    
    echo '
<div class="primary callout archive">
    <div class="row large-7">
        <h3><strong>Godziny pracy</strong></h3>
        <table>
        <thead>
            <tr>
              
               
                <th width="100">Stawka</th>
                <th width="100">Data</th>
                <th width="100">Zmiana</th>
                </tr>
                </thead>
        
            <tbody>
				';

    $data1=date('o-m-01');
    $data2=date('o-m-t');

//echo $data1.' '.$data2;
    $query = "select zmiana.godziny*zmiana.stawka as hajs, grafik.data, zmiana.nazwa_zmiany  from zmiana 
join grafik on grafik.id_zmiany = zmiana.id_zmiany 
join pracownik on pracownik.id_pracownika=grafik.id_pracownika
<<<<<<< HEAD
where  data between '$data1' and '$data2' and pracownik.id_pracownika= '".$_SESSION['id']."'
order by data asc";
=======
where  data between '$data1' and '$data2' and pracownik.id_pracownika= '".$_SESSION['id']."'";
>>>>>>> 0fc1edb8744d5fa32267a51425b5fb8d9f7749e1

//echo $query;
    $result = pg_query($query);

    while ($row = pg_fetch_row($result)) {
        echo "
            <tr>
              
                <td>$row[0]</td>
                <td>$row[1]</td>
                <td>$row[2]</td>
            </tr>";
    }

    echo '
            </tbody>
        </table>
    </div>
</div>';
}
?>
