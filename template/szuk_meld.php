<?php

if($_SESSION['valid']) {
    include 'config.php';
    $typ=$_POST['typ'];
    $warunek=$_POST['warunek'];
    if(!empty($warunek)) {
        if ($typ == "idrp") {
            $query = "select id_rez_pok, nazwisko, imie, adres, pesel from meldunek where id_rez_pok='$warunek'";
            $result = pg_fetch_result(pg_query($query));
            $adres=explode("*", $result[3]);


        }
        else {
            $query = "select id_rez_pok, nazwisko, imie, adres, pesel from meldunek where nazwisko='$warunek'";
            $result = pg_fetch_result(pg_query($query));
            $adres = explode("*", $result[3]);
        }
        }


    echo'

<div class="primary callout" >
  <form role="form">
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
    echo'
<div class="primary callout">
    <div class="row">
    <form method="post">
        <div class="row large-12">
            <label><strong>WYNIK WYSZUKIWANIA</strong></label>

            <table class="table ">
                <thead>
                <tr>
                    <th>ID rezerwacji pokoju
                    <input type="text" name="idrp" value="'.$result[0].'" ></th>

                    <th>Nazwisko
                        <input type="text" name="nazw" value="'.$result[1].'" ></th>

                    <th>Imię
                        <input type="text" name="imie" value="'.$result[2].'"></th>               
              
                    <th>Pesel
                        <input type="text" name="pesel" value="'.$result[4].'"></th>

                </tr>
               </thead>
                     <thead>
                <tr>
                    <th>Miasto
                        <input type="text" name="miasto" value="'.$adres[1].'" /></th>

                    <th>Ulica
                        <input type="text" name="ulica" value="'.$adres[2].'" /></th>

                    <th>Kod pocztowy
                        <input type="text" name="kod" value="'.$adres[0].'" /></th>

                    <th>Numer lokalu
                        <input type="text" name="nlokalu" value="'.$adres[4].'" /></th>

                    <th>Numer mieszkania
                        <input type="text" name="nmieszk" value="'.$adres[3].'" /></th>
                </tr>
                </thead>
            </table>
                      
                </div>
        </div>
        </form>
    </div>
</div>';

}
?>
