<?
include 'config.php';
if($_SESSION['valid']) {
    if ($_SESSION['s'] == 0) {
        if (isset($_POST['dodPok'])) {

            $typPok = $_POST['typPok'];
            if (!empty($typPok)) {

            $query = "insert into pokoj (typ) values ('$typPok') returning id_pokoju";
            $result = pg_query($query) or die('Query failed: ' . pg_last_error());
            pg_close($dbconn);

                echo '			
			    <div class="callout primary rejestr">
				<div class="row">
				<div class="small-3 small-centered columns text-center">
            Zapisano.
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
             <label><strong><h2>DODAJ POKÓJ</h2></strong></label>
            <div class="row large-7">


                <table class="table ramka">
                
                    <thead>
                    <tr>

                        <th>Typ pokoju:
                            <input type="text" name="typPok" placeholder="Typ pokoju"/>
                        </th>
                            
                    </tr>
                    <th><input type="submit" name="dodPok" class="button guzik" value="DODAJ POKÓJ" /></th>
                    </thead>
                </table>
            </div>
        </form>
    </div>
</div>';
        }

    }
?>