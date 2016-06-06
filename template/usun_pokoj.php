<?
include 'config.php';
if($_SESSION['valid']) {
    if ($_SESSION['s'] == 0) {
        if (isset($_POST['usuPok'])) {

            $idPok = $_POST['idPok'];
            $typPok = $_POST['typPok'];
            if (!empty($typPok) && !empty($idPok)) {

                $query = "delete from pokoj where (typ='$typPok' AND id_pokoju='$idPok')";
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
             <label><strong><h2>USUŃ POKÓJ</h2></strong></label>
            <div class="row large-7">


                <table class="table ramka">
                
                    <thead>
                    <tr>

                        <th>Typ pokoju:
                            <input type="text" name="typPok" placeholder="Typ pokoju"/>
                        </th>
                        </tr>
                        <tr>
                        <th>ID pokoju:
                            <input type="text" name="idPok" placeholder="ID pokoju"/>
                        </th>
                            
                    </tr>
                    <th><input type="submit" name="usuPok" class="button guzik" value="USUŃ POKÓJ" /></th>
                    </thead>
                </table>
            </div>
        </form>
    </div>
</div>';
    }

}
?>