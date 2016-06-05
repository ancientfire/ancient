<div class="callout primary rejestr">
    <div class="row">
        <form method="post">
            <div class="row large-12">

                <label><strong>DANE KLIENTA</strong></label>

                <table class="table">
                    <thead>
                    <tr>

                        <th>Stanowisko:

                            <select name="stan">
                                <option value="Recepcja">RECEPCJA</option>
                                <option value="Kuchnia">KUCHNIA</option>
                                <option value="Serwis Sprzątający">SERWIS SPRZĄTAJĄCY</option>
                            </select> </th>
                        
                        <th>ID pracownika:

                            <select name="id">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="6">5</option>
                            </select> </th>

                        <th>Data wyjazdu:
                            <input type="text" class="span2" name="dw" id="dpd">
                        </th>

                    <th> Zmiana:
                        <select name="zm">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
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

                    <div class="large-12">
                        <input type="submit" name="zapisz" class="button rejestracja2" value="ZAPISZ GRAFIK" />
                    </div>


                    </table>
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

