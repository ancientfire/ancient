<?php
include 'config.php';
echo'
<div class="primary callout archive">
    <div class="row large-10">
        <h3><strong>Wybrany grafik</strong></h3>
        <table>
            <thead>
            <tr>
                <th width="100">ID pracownika</th>
                <th width="100">Data</th>
                <th width="100">Zmiana</th>
                <th width="100">Godzina rozpoczęcia</th>
                <th width="100">Godzina zakończenia</th>
            </tr>
            </thead>
            <tbody>
				';
			
			$data=date('o-m-d');
			$data7=date('o-m-d', strtotime('+7 days'));
$data1=date('o-m-d', strtotime('-1 day'));
$data0=date('o-m-d', strtotime('-31 days'));
			$query="";
			if($_GET['l']==1){
			$query="select * from grafik inner join pracownik on grafik.id_pracownika=pracownik.id_pracownika where pracownik.id_stanowiska='".$_GET['st']."' and data='".$data."' order by data asc";
		}
		if($_GET['l']==7){
			$query="select * from grafik inner join pracownik on grafik.id_pracownika=pracownik.id_pracownika where pracownik.id_stanowiska='".$_GET['st']."' and data between '$data' and '$data7' order by data asc limit ".$_GET['l'];
		}
		if($_GET['l']==2){
			$query="select zmiana.nazwa_zmiany,grafik.id_pracownika, grafik.data, grafik.godzina_rozpoczęcia, grafik.godzina_zakończenia from grafik join zmiana on zmiana.id_zmiany = grafik.id_zmiany  inner join pracownik on grafik.id_pracownika=pracownik.id_pracownika where  data between '$data' and '$data7' order by data asc";
		}
if($_GET['l']==3){
	$query="select zmiana.nazwa_zmiany,grafik.id_pracownika, grafik.data, grafik.godzina_rozpoczęcia, grafik.godzina_zakończenia from grafik join zmiana on zmiana.id_zmiany = grafik.id_zmiany  inner join pracownik on grafik.id_pracownika=pracownik.id_pracownika where  data between '$data0' and '$data1' order by data asc";
}
		
		if(empty($_GET['l'])){
			$query="select * from grafik inner join pracownik on grafik.id_pracownika=pracownik.id_pracownika where pracownik.id_stanowiska='".$_SESSION['s']."' and data between '$data' and '$data7' and pracownik.id_pracownika='".$_SESSION['id']."' order by data asc";
		}
	        //echo $query;
	        $result = pg_query($query);

		    while($row=pg_fetch_row($result)) {
            echo "
            <tr>
                <td>$row[1]</td>
                <td>$row[2]</td>
                <td>$row[0]</td>
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
