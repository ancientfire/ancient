
if (isset($_POST['zapisz'])) {

if (!empty($dp) && !empty($dw) && !empty($io) && !empty($rach) && !empty($splat)) {


$query = "update rezerwacja set data_przyjazdu='$dp', data_wyjazdu='$dw' where id_klienta='" . $_SESSION['id'] . "'";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
pg_close($dbconn);

echo'

<div class="column">

    <label><strong><h4>DANE REZERWACJI</h4></strong></label>
    <table class="table">
        <thead>
        <tr>
            <th>Data przyjazdu:
                <input type="text" class="span2" value="" id="dpd1">
            </th>
            <th>Data wyjazdu:
                <input type="text" class="span2" value="" id="dpd2">
            </th>

            <th> Ilość osób:
                <select>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="6">6</option>
                </select>
            </th>

            <th>Usługi dodatkowe:
                <br>
                <input id="checkbox1" type="checkbox"><label for="checkbox1">Parking</label>
                <input id="checkbox2" type="checkbox"><label for="checkbox2">Sprzątanie</label>
                <input id="checkbox3" type="checkbox"><label for="checkbox3">Śniadanie</label>
            </th>

        </tr>
        </thead>

    </table>


    <label><strong><h4>PŁATNOŚĆ</h4></strong></label>
    <table class="table">
        <div class="column">

            <div class="row large-4">
                <input type="text" placeholder="Cena" />
                <a href="#" class="button radius">Oblicz cenę</a>
            </div>
        </div>
    </table>
    <label><strong><h6>Sposób płatności</h6></strong></label>
    <table class="table">
        <div class="column">
            <input type="radio" name="gotowka" id="gotowka"><label for="gotowka">Gotówką</label>
            <input type="radio" name="karta" id="karta"><label for="karta">Kartą</label>
        </div>
    </table>

    <label><strong><h6>Rodzaj rachunku</h6></strong></label>
    <table class="table">
        <div class="column">

            <input type="radio" name="paragon" id="paragon"><label for="paragon">Paragon</label>
            <input type="radio" name="faktura" id="faktura"><label for="faktura">Faktura</label>
        </div>
    </table>

    <script>
        // implementation of disabled form fields
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
        var checkin = $(\'#dpd1\').fdatepicker({
        onRender: function (date) {
            return date.valueOf() < now.valueOf() ? \'disabled\' : \'\';
        }
        }).on(\'changeDate\', function (ev) {
        if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.update(newDate);
        }
        checkin.hide();
        $(\'#dpd2\')[0].focus();
        }).data(\'datepicker\');
        var checkout = $(\'#dpd2\').fdatepicker({
        onRender: function (date) {
            return date.valueOf() <= checkin.date.valueOf() ? \'disabled\' : \'\';
        }
        }).on(\'changeDate\', function (ev) {
        checkout.hide();
        }).data(\'datepicker\');
    </script>
</div>
</div>
<div class="column">
    <div class="row large-24">
        <a href="#" class="button but1">Dokonaj rezerwacji</a>
    </div>
</div>
';
}
}
}
}
}
