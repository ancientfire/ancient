<?
include 'config.php';
if($_SESSION['valid']) {
    if ($_SESSION['s'] == 0) {
        if (isset($_POST['usuOfe'])) {

            $typPok = $_POST['typPok'];
            $cena = $_POST['cena'];

            if(!empty($cena) && !empty($typPok)){
                $query = "delete from typ_pokoju where cena='$cena' and typ='$typPok'";
                $result = pg_query($query) or die('Query failed: ' . pg_last_error());
                pg_close($dbconn);

                echo '			
			    <div class="callout primary rejestr">
				<div class="row">
				<div class="small-3 small-centered columns text-center">
            Usunięto.
				</div>
				</div>
				</div>';
                header("refresh:3;url=index.php");
            } else {
                echo '
				<div class="callout primary rejestr">
				<div class="row">
				<div class="small-3 small-centered columns text-center">
            Nieprawidłowe lub puste dane.
				</div>
				</div>
				</div>';
                header("refresh:3");
            }
        }
        echo '
<div class="callout primary log">
    <div class="row">
    <form method="post">
     <label><strong><h2>USUŃ OFERTĘ</h2></strong></label>
             <div class="row large-7">


                <table class="table ramka">
                    <thead>
                    <tr>

                        <th>Typ pokoju:
                            <input type="text" name="typPok" value=""/></th>
                    </tr>        
                    <tr>
                        <th>Cena:
                            <input type="text" name="cena" value=""/></th>

                    </tr>
                 
                    <tr>
                    <th><input type="submit" name="usuOfe" class="button" value="USUŃ OFERTĘ" /></th>
                    </tr>
                    </thead>
                    </table>
               </div>
            </form>
            </div>
</div>';
    }
}
?>