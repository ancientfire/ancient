<?php

           $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['user']) 
               && !empty($_POST['pass'])) {
				
               if ($_POST['user'] == 'test' && 
                  $_POST['pass'] == 'test') {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = 'test';
                  
                  header('Location: index.php');
               }else {
                  $msg = 'Wrong username or password';
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
                <th>Login
                <input type="text" name="user" placeholder="Login" /></th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th>Hasło
                <input type="password" name="pass" placeholder="Hasło" /></th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th><input type="submit" name="login" class="button radius" value="Zaloguj" />
                <button class="secondary hollow button" href="#">Nie pamiętam hasła</button></th>
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
