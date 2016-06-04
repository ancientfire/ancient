<?php
include 'config.php';
echo'
<div class="primary callout archive">
    <div class="row large-10">
        <h3><strong>Twój grafik</strong></h3>
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
			
			$query="select * from grafik inner join pracownik on grafik.id_pracownika=pracownik.id_pracownika where pracownik.id_stanowiska='".$_SESSION['s']."' limit 7";
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
