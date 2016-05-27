<?php

$connection = @mysqli_connect('localhost', 'uzytkownik', 'haslo')
or die('Brak połączenia z serwerem MySQL.<br />Błąd: '.mysqli_error());
echo "Udało się połączyć z serwerem!<br />";

$db = @mysqli_select_db('nazwa_bazy', $connection)
or die('Nie mogę połączyć się z bazą danych<br />Błąd: '.mysqli_error());
echo "Udało się połączyć z bazą dancych!";

$wynik = mysqli_query($connection,"SELECT * FROM logowanie");


mysqli_close($connection);

?>


