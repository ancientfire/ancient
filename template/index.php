<?php

if(!$_SESSION['valid']){
	echo '
          <br> <div class="callout primary">
                <div class="row">
                    <div class="column">
                        <img src="banner.png">
                    </div>
                </div>
            </div></br>

            <br><div class="row small-up-4 medium-up-4 large-up-4">
                <div class="column">
                    <img class="thumbnail" src="OHOTELU.png">
                </div>
                <div class="column">
                    <img class="thumbnail" src="OFERTA.png">
                </div>
                <div class="column">
                    <img class="thumbnail" src="AKTUALNOSCI.png">
                </div>
                <div class="column">
                    <img class="thumbnail" src="ZAREZERWUJ.png">
                </div>
            </div></br>
<br>
            <div class="primary callout">
                <div class="row large-7">
                    <h1><strong>Zarezerwuj już dziś!</strong></h1>
                    <div class="column">
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
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select> </th>

                  <th><br><a href="#" class="button radius">Wyszukaj</a></br></th>
                </tr>
                </thead>
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
            </div>';
		}else{
			
			if($_SESSION['s']==0){
			echo '
			<div class="primary callout klient">
    <div class="row large-10">
        <h3><strong>Baza pracowników</strong></h3>
            <p><a href="baza_prac.html">Zobacz więcej>></a></p>
    </div>
</div>

<div class="primary callout">
    <div class="row large-10">
        <h3><strong>Oferta</strong></h3>
        <p><a href="oferta.html">Zobacz więcej>></a></p>
    </div>
</div>


<div class="primary callout">
    <div class="row large-10">
        <h3><strong>Grafik</strong></h3>
        <p><a href="grafik.html">Zobacz więcej>></a></p>
    </div>
</div>
			';	
				
			}else{
			echo '
			<div class="primary callout klient">
    <div class="row large-7">
        <h1><strong>Zarezerwuj już dziś!</strong></h1>
        <div class="column">
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
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select> </th>

                    <th><br><a href="#" class="button radius">Wyszukaj</a></br></th>
                </tr>
                </thead>
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
</div>

<div class="primary callout archive">
    <div class="row large-10">
        <h3><strong>Historia Twoich rezerwacji</strong></h3>
        <table>
            <thead>
            <tr>
                <th width="150">ID klienta</th>
                <th width="150">Data przyjazdu</th>
                <th width="150">Data wyjazdu</th>
                <th width="400">Usługi dodatkowe</th>
                <th width="150">Sposób płatności</th>
                <th width="150">Cena</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Content Here</td>
                <td>Content Here.</td>
                <td>Content Here</td>
                <td>Content Goes Here Content Goes Here Content Goes Here Content Goes Here </td>
                <td>Content Here</td>
                <td>Content Here</td>
            </tr>
            <tr>
                <td>Content Here</td>
                <td>Content Here.</td>
                <td>Content Here</td>
                <td>Content Goes Here Content Goes Here Content Goes Here Content Goes Here </td>
                <td>Content Here</td>
                <td>Content Here</td>
            </tr>
            <tr>
                <td>Content Here</td>
                <td>Content Here.</td>
                <td>Content Here</td>
                <td>Content Goes Here Content Goes Here Content Goes Here Content Goes Here </td>
                <td>Content Here</td>
                <td>Content Here</td>
            </tr>
            </tbody>

        </table>
        <div class="large-2 columns">
            <p><a href="file:///C:/Users/agata/Downloads/foundation-6.2.1-essential/historia_rez.html">Zobacz więcej>></a></p>
        </div>
    </div>
</div>';}
}
?>
