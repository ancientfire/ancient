<div class="primary callout">
    <div class="row">
        <div class="row large-12">
            <h1><strong>Zarezerwuj</strong></h1>
            <div class="column">
                <table class="table">

                    <label><strong><h4>DANE KLIENTA</h4></strong></label>

                    <input type="radio" name="firma" id="firma"><label for="firma">FIRMA</label>
                    <input type="radio" name="osoba fizyczna" id="osoba"><label for="osoba">OSOBA FIZYCZNA</label>

                    <thead>
                    <tr>
                        <th>ID klienta
                            <input type="text" placeholder="ID klienta" /></th>
                        <th>Imię
                            <input type="text" placeholder="Imię" /></th>

                        <th>Nazwisko
                            <input type="text" placeholder="Nazwisko" /></th>

                        <th>PESEL
                            <input type="text" placeholder="PESEL" /></th>

                        <th>Numer telefonu
                            <input type="text" placeholder="Numer telefonu" /></th>
                    </tr>
                    </thead>

                    <thead>
                    <tr>
                        <th>ID klienta
                            <input type="text" placeholder="ID klienta" /></th>

                        <th>Nazwa firmy
                            <input type="text" placeholder="Nazwa firmy" /></th>

                        <th>NIP
                            <input type="text" placeholder="NIP" /></th>
                    </tr>
                    </thead>

                    <thead>
                    <tr>
                        <th>Miasto
                            <input type="text" placeholder="Miasto" /></th>

                        <th>Ulica
                            <input type="text" placeholder="Ulica" /></th>

                        <th>Kod pocztowy
                            <input type="text" placeholder="Kod pocztowy" /></th>

                        <th>Numer lokalu
                            <input type="text" placeholder="Numer lokalu" /></th>
                        <th>Numer mieszkania
                            <input type="text" placeholder="Numer mieszkania" /></th>
                    </tr>
                    </thead>
                </table>
            </div>

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
        <div class="column">
            <div class="row large-24">
                <a href="#" class="button but1">Dokonaj rezerwacji</a>
            </div>
        </div>

    </div>
</div>