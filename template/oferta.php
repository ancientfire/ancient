<div class="primary callout archive">
    <div class="row large-10">
        <h3><strong>Oferta</strong></h3>
        <table>
            <thead>
            <tr>
                <th width="100">Rodzaj pokoju</th>
                <th width="200">Opis</th>
                <th width="100">Cena za pokój/doba</th>
            </tr>
            </thead>
            <tbody>
								<?php
								include 'config.php';
								$query = "select typ, cena from typ_pokoju";
								$result = pg_query($query) or die('Query failed: ' . pg_last_error());
								//echo $query;
								
								while($row=pg_fetch_row($result)){
								echo "<tr><td>$row[0]</td>
								<td>Taki super pokój, że każdy powinien go wynająć!</td>
				                <td>$row[1]</td></tr>
				                ";
								}
							
							?>
       
            </tbody>

        </table>
    </div>
</div>

