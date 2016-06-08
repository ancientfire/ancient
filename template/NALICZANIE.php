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
              
                <th width="100">Godziny podstawowe</th>
                <th width="100">Nadgodziny</th>
                </tr>
                </thead>
        
            <tbody>
				';

    $query = "select 

    $result = pg_query($query);
    while ($row = pg_fetch_row($result)) {
        echo "
            <tr>
               
                <td>$row[2]</td>
                <td>$row[1]</td>
            </tr>";
    }

    echo '
            </tbody>
        </table>
    </div>
</div>';
}
?>