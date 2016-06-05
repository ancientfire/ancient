<?php
include 'config.php'; ?>
<div class="callout primary rejestr">
    <div class="row">
        <form method="post">
            <div class="row large-12">

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
                        
                        <th>ID pracownika:

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

								$query = "select id_zmiany from zmiana";
								$result = pg_query($query) or die('Query failed: ' . pg_last_error());
								//echo $query;
								
								while($row=pg_fetch_row($result)){
								echo "<option value='$row[0]'>$row[0]</option>";
								}
								pg_close($dbconn);
							
							?>
                        </select> </th>


                        <th>Godzina rozpoczęcia:
                        <select name="gr">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
                        </select> </th>

                        <th>Godzina zakończenia:
                            <select name="gz">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                            </select> </th>
                    </tr>
                    </thead>

                    </table>
                    <div class="large-12">
                        <input type="submit" name="zapisz" class="button rejestracja2" value="ZAPISZ GRAFIK" />
                    </div>
                </div>
            </form>
        </div>
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
