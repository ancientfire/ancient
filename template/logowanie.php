<?php

           $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['user']) 
               && !empty($_POST['pass'])) {
			   
			   include 'config.php';
			   
			   $query = "select id_pracownika, id_klienta, email, haslo from logowanie where email='".$_POST['user']."'";
			   
			   $result = pg_fetch_array(pg_query($query));
				
               if ($result){
				  if($_POST['user']==$result[2] && $_POST['pass']==$result[3]){
				  
				  $_SESSION['id'] = ($result[0]==NULL)? $result[1] : $result[0];
				  $_SESSION['kp'] = ($result[0]==NULL)? "k" : "p";
				  $_SESSION['s'] = -1;
				  if($_SESSION['kp']=="p"){
				  $query = "select id_stanowiska from pracownik where id_pracownika='".$_SESSION['id']."'";
				  $_SESSION['s'] = pg_fetch_result(pg_query($query), 0);
				  }
				  
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $_POST['user'];
                  
                  pg_close($dbconn);
                  header('Location: index.php');
					}else{
															echo '
				<div class="callout primary rejestr">
				<div class="row">
				<div class="small-3 small-centered columns text-center">		
				Logowanie nie powiodło się.
				</div>
				</div>
				</div>';
					  header( "refresh:3");
					}
               }else{
				pg_close($dbconn);   
				   echo '
				<div class="callout primary rejestr">
				<div class="row">
				<div class="small-3 small-centered columns text-center">		
				Błędny login lub hasło.
				</div>
				</div>
				</div>';
				   header( "refresh:3");
				   
			   }
            }else{

if(!$_SESSION['valid']){           
echo '
<div class="callout primary log">
<div class="row">
<div class="large-7">

<form action = "" method = "post">
    <table class="table ramka">
        <thead>
            <tr>
                <th>E-mail
                <input type="text" name="user" placeholder="Login" /></th>
            </tr>
     
            <tr>
                <th>Hasło
                <input type="password" name="pass" placeholder="Hasło" /></th>
            </tr>
      
            <tr>
                <th><input type="submit" name="login" class="button guzik" value="Zaloguj" /></th>
               
            </tr>
        </thead>
    </table>
    </form>
</div>
</div>
        </div>';
	}else{
		header('Location: index.php');
	}
	}

?>
