<?php
include 'config.php'; ?>
<div class="callout primary rejestr">
    <div class="row">
		
		<?php if(isset($_POST['zapisz']) and !empty($_POST['dw'])){
			//echo $_GET['st']." ".$_POST['id']." ".$POST['zm']." ".$_POST['gr']." ".$_POST['gz']." ".$_POST['dw'];
			$data = date('o-m-d', strtotime($_POST['dw']));
			$query = "insert into grafik (id_zmiany,id_pracownika,data,godzina_rozpoczęcia, godzina_zakończenia) values ('".$_POST['zm']."','".$_POST['id']."','".$data."','".$_POST['gr']."','".$_POST['gz']."')";

			$result = pg_query($query) or die('Query failed: ' . pg_last_error());
			pg_close($dbconn);
				echo '
				<div class="row">
				<div class="small-3 small-centered columns text-center">		
				Dodano.
				</div>
				</div>';
            header( "refresh:3;url=index.php?s=stworz_grafik");
		}else{
		
		?>
		
		
        <form method="post">
            <div class="row large-14">

                <label><strong>DANE PRACOWNIKA</strong></label>

                <table class="table">
                    <thead>
                    <tr>

                        <th>Stanowisko:

                            <select name="stan" onchange="location = this.value;">
								<option disabled selected value> Wybierz stanowisko </option>
                                <option value="?s=stworz_grafik&st=1" <?php if($_GET['st']==1){ echo 'selected'; } ?>>RECEPCJA</option>
                                <option value="?s=stworz_grafik&st=2" <?php if($_GET['st']==2){ echo 'selected'; } ?>>KUCHNIA</option>
                                <option value="?s=stworz_grafik&st=3" <?php if($_GET['st']==3){ echo 'selected'; } ?>>SERWIS SPRZĄTAJĄCY</option>
                            </select> </th>
                        
                        <th>Pracownik:

                            <select name="id">
								
								<?php
								if(empty($_GET['st'])){ echo "<option value=''></option>";}else{
								$query = "select id_pracownika from pracownik where id_stanowiska='".$_GET['st']."'";
								$result = pg_query($query) or die('Query failed: ' . pg_last_error());
								//echo $query;
								
								while($row=pg_fetch_row($result)){
								echo "<option value='$row[0]'>$row[0]</option>
								";
								}
							}
							?>
								
                            </select> </th>

                        <th>Data:
                            <input type="text" class="span2" name="dw" id="dpd">
                        </th>

                    <th> Zmiana:
                        <select name="zm">
								<?php

								$query = "select id_zmiany, nazwa_zmiany from zmiana";
								$result = pg_query($query) or die('Query failed: ' . pg_last_error());
								//echo $query;
								
								while($row=pg_fetch_row($result)){
								echo "<option value='$row[0]'>$row[1]</option>";
								}
								pg_close($dbconn);
							
							?>
                        </select> </th>


                        <th>Godzina rozpoczęcia:
                        <select name="gr">
                            <option value="6:00">6:00</option>
                            <option value="7:00">7:00</option>
                            <option value="12:00">12:00</option>
                            <option value="15:00">15:00</option>
                            <option value="18:00">18:00</option>
                            <option value="23:00">23:00</option>
                            <option value="00:00">00:00</option>
                        </select> </th>

                        <th>Godzina zakończenia:
                            <select name="gz">
                                <option value="6:00">6:00</option>
                                <option value="7:00">7:00</option>
                                <option value="12:00">12:00</option>
                                <option value="15:00">15:00</option>
                                <option value="18:00">18:00</option>
                                <option value="23:00">23:00</option>
                                <option value="00:00">00:00</option>
                            </select> </th>
                    </tr>
                    </thead>

                    </table>
                    <div class="large-14">
                        <input type="submit" name="zapisz" class="button rejestracja2" value="ZAPISZ GRAFIK" />
                    </div>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
    
                    <script>
                    // implementation of disabled form fields
                    var nowTemp = new Date();
                    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
                    var checkin = $('#dpd').fdatepicker({
                        onRender: function (date) {
                            return date.valueOf() < now.valueOf() ? 'disabled' : '';
                        }
                    }).on('changeDate', function (ev) {
                        checkin.hide();
                    }).data('datepicker');
                    
                </script>
