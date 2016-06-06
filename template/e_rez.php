<?php


include 'config.php';

if(isset($_POST['zapisz'])){
			$query = "delete from usluga where id_rez_pok=".$_GET['idr'];
			$result = pg_query($query) or die('Query failed: ' . pg_last_error());
			
if(isset($_POST['usl1'])) { 
				$query = "insert into usluga (id_uslugi,id_rez_pok) values ('3','".$_GET['idr']."')";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	 }
if(isset($_POST['usl2'])) { 
				$query = "insert into usluga (id_uslugi,id_rez_pok) values ('1','".$_GET['idr']."')";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	 }
if(isset($_POST['usl3'])) { 
				$query = "insert into usluga (id_uslugi,id_rez_pok) values ('2','".$_GET['idr']."')";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	 }
				$query = "update rachunek set id_rodz_rach=".$_POST['rachunek'].", id_rodz_plat=".$_POST['platnosc']." where id_rezerwacji=".$_SESSION['idrez'];
				$result = pg_query($query) or die('Query failed: ' . pg_last_error()); 
	 
	pg_close($dbconn);
													echo '
				<div class="callout primary rejestr">
				<div class="row">
				<div class="small-3 small-centered columns text-center">		
				Zapisano.
				</div>
				</div>
				</div>';
}else{
echo '
<div class="primary callout klient">
    <div class="row">
<form method="post">
<div class="column">
    <label><strong><h4>DANE REZERWACJI</h4></strong></label>
    <table class="table">
        <thead>';
        
        
        echo '
						<th> ID rezerwacji:
			<select name="idp" onchange="location = this.value;">
			<option disabled selected value> Wybierz ID </option>';
			
			$query="";
			if($_SESSION['s']==1){
								$query = "select id_rez_pok from rezerwacja";
							}else{
								$query = "select id_rez_pok from rezerwacja where id_klienta=".$_SESSION['id'];
							}
								$result = pg_query($query) or die('Query failed: ' . pg_last_error());
								//echo $query;
								
								while($row=pg_fetch_row($result)){
								echo "<option value='?s=e_rez&idr=$row[0]'".(($row[0]==$_GET['idr'])? 'selected':'').">$row[0]</option>";
								}
			
			$query="";
			$uslugi=array();
			if(!empty($_GET['idr'])){
					$query = "select id_uslugi from usluga where id_rez_pok='".$_GET['idr']."'";
					$result = pg_query($query) or die('Query failed: ' . pg_last_error());
					
					while($row=pg_fetch_row($result)){
						array_push($uslugi, $row[0]);
					}			
			}
						
			echo '
			</select>
			</th>';

			
            echo'<tr>
            <th>Usługi dodatkowe:
                <br>
                <input id="checkbox1" name="usl1" type="checkbox" value="3" '.((in_array(3, $uslugi))? 'checked':'').'><label for="checkbox1">Parking</label>
                <input id="checkbox2" name="usl2" type="checkbox" value="1" '.((in_array(1, $uslugi))? 'checked':'').'><label for="checkbox2">Sprzątanie</label>
                <input id="checkbox3" name="usl3" type="checkbox" value="2" '.((in_array(2, $uslugi))? 'checked':'').'><label for="checkbox3">Śniadanie</label>
            </th>

        </tr>
        </thead>

    </table>';

if(!empty($_GET['idr'])){    
$query = "select rachunek.id_rodz_rach, rachunek.id_rodz_plat, rezerwacja.id_rezerwacji from rezerwacja inner join rachunek on (rezerwacja.id_rezerwacji=rachunek.id_rezerwacji) where rezerwacja.id_rez_pok=".$_GET['idr'];
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$row=pg_fetch_row($result);
$_SESSION['idrez']=$row[2];
}

echo '
    <label><strong><h4>PŁATNOŚĆ</h4></strong></label>
   
    <label><strong><h6>Sposób płatności</h6></strong></label>
    <table class="table">
        <div class="column">
            <input type="radio" name="platnosc" value="1" '.(($row[1]==1)? 'checked':'').'><label for="gotowka">Gotówką</label>
            <input type="radio" name="platnosc" value="2" '.(($row[1]==2)? 'checked':'').'><label for="karta">Kartą</label>
        </div>
    </table>

    <label><strong><h6>Rodzaj rachunku</h6></strong></label>
    <table class="table">
        <div class="column">

            <input type="radio" name="rachunek" value="1" '.(($row[0]==1)? 'checked':'').'><label for="paragon">Paragon</label>
            <input type="radio" name="rachunek" value="2" '.(($row[0]==2)? 'checked':'').'><label for="faktura">Faktura</label>
        </div>
    </table>

</div>
         <div class="large-12">
            <input type="submit" name="zapisz" class="button rejestracja2" value="ZAREZERWUJ" />
                </div>
        </div>
        </form>
        </div></div>';
}

?>
