<?php

if($_SESSION['valid']) {
    include 'config.php';



        if (isset($_POST['rejestr'])) {
            $dp=$_POST['dp'];
            $dw=$_POST['dw'];
            $io=$_POST['io'];


            if ($_SESSION['kp'] == "k") {

                if(!empty($dw) && !empty($dp) && !empty($io)){

                    $query = "insert into rezerwacja (data_przyjazdu,data_wyjazdu, data_rezerwacji) values ('$dp','$dw', date)";
                    $result = pg_query($query) or die('Query failed: ' . pg_last_error());


                    pg_close($dbconn);



echo'
<div class="primary callout ramka3">
    <div class="row large-7">
        <h1><strong>Sprawdź dostępność</strong></h1>
        <div class="column">
            <table class="table">
                <thead>
                <tr>
                    <th>Data przyjazdu:
                        <input type="text" class="span2" name="dp" id="dpd1">
                    </th>
                    <th>Data wyjazdu:
                        <input type="text" class="span2" name="dw" id="dpd2">
                    </th>
                    <th> Ilość osób:
                        <select>
                            <option name ="io" value="1">1</option>
                            <option name ="io" value="2">2</option>
                            <option name ="io" value="3">3</option>
                            <option name ="io" value="4">4</option>
                            <option name ="io" value="6">6</option>
                        </select> </th>

                    <th><br><a href="#" class="button radius">Wyszukaj</a></br></th>
                </tr>
                </thead>
            </table>

            <script>
                // implementation of disabled form fields
                var nowTemp = new Date();
                var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
                var checkin = $('#dpd1').fdatepicker({
                    onRender: function (date) {
                        return date.valueOf() < now.valueOf() ? 'disabled' : '';
                    }
                }).on('changeDate', function (ev) {
                    if (ev.date.valueOf() > checkout.date.valueOf()) {
                        var newDate = new Date(ev.date)
                        newDate.setDate(newDate.getDate() + 1);
                        checkout.update(newDate);
                    }
                    checkin.hide();
                    $('#dpd2')[0].focus();
                }).data('datepicker');
                var checkout = $('#dpd2').fdatepicker({
                    onRender: function (date) {
                        return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                    }
                }).on('changeDate', function (ev) {
                    checkout.hide();
                }).data('datepicker');
            </script>
        </div>

    </div>
</div>