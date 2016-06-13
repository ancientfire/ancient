<?php
include 'config.php';

$query = "select nazwa_hotelu, adres, nr_tel, strona_www,email from hotel";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

//echo $result[1];
$row = pg_fetch_row($result);
$adres=explode("*", $row[1]);

//while ($row = pg_fetch_row($result)){

    echo '
<div class="primary callout archive">
    <div class="row large-7">
        <h3><strong>Kontakt</strong></h3>
        <table class=" table">
       
       
                 <tr><h4><th width="100">Nazwa :  '.$row[0].' </th></h4></tr>
                 <tr><h4><th width="100">Adres :  '.$adres[0].' ul.'.$adres[1].' nr '.$adres[2].'</th></h4></tr>
                 <tr><h4><th width="100">Numer telefonu :  '.$row[2].'</th></h4></tr>
                 <tr><h4><th width="100">Strona WWW : '.$row[3].'</th></h4></tr>
                 <tr><h4><th width="100">E-mail :  '.$row[4].'</th></h4></tr>
                 
				';

//}
pg_close($dbconn);

echo '
          
        </table>
    </div>
</div>';

?>
