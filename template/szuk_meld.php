<?php

if($_SESSION['valid']) {
    include 'config.php';
    $typ=$_POST['typ'];
    $warunek=$_POST['usr'];
    if(!empty($warunek)) {
		
		
		echo'
<div class="primary callout klient">
    <div class="row">
    <form method="post">
         
    <div class="row large-12">
        <h3><strong>Wyniki wyszukiwania</strong></h3>
        <table class="table">
            <thead>
            <tr>
                 <th width="150">ID rezerwacji pokoju</th>
                <th width="150">Imię</th>
                <th width="150">Nazwisko</th>
                <th width="150">PESEL</th>
                <th width="150">Adres</th>
            </tr>
            </thead>
            <tbody>';
        $query="";
        if($typ=="id"){    
        $query = "select id_rez_pok, nazwisko, imie, adres, pesel from meldunek where id_rez_pok='$warunek'";
		}else{
		$query = "select id_rez_pok, nazwisko, imie, adres, pesel from meldunek where nazwisko='$warunek'";
		}
		
        $result = pg_query($query);

		while($row=pg_fetch_row($result)) {
            echo "
            <tr>
                <td>$row[0]</td>
                <td>$row[2]</td>
                <td>$row[1]</td>
                <td>$row[4]</td>
                <td>$row[3]</td>
            </tr>";
        }
        
        }else{


    echo'

<div class="primary callout klient" >
  <form method="post">
  <table class="table">
  
    <div class="radio">
      <label><input type="radio" name="typ" id="idpok" value="id" checked="checked">ID rezerwacji pokoju</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="typ" id="nazw" value="nazw">Nazwisko</label>
    </div>
    
  <input type="text" value="ID rezerwacji pokoju" class="form-control" name="usr">
  
  </table>
  </form>
</div>

<script>
var radios =  $(\'input[name=typ]\');
radios.click(function() { 

    if(this.value==\'id\') {
        $(\'input[name=usr]\').prop(\'value\', \'ID rezerwacji pokoju\');
    }else{
        $(\'input[name=usr]\').prop(\'value\', \'Nazwisko\');
	}

    
});
</script>
';
    


}
}
?>
