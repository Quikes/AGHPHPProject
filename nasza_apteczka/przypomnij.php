<?php
session_start();
include("nagl.php");
include("polacz.php");

$conn = polacz();
$username = 'jazaga3';
$table = "UzytkownicySystemu";

$haslo_md5 = md5($_POST['nowehaslo']);



    if (!empty($_POST['nowehaslo']) && !empty($_POST['nowehaslo2'])){
        
            $email = $_POST['email'];
            $haslo_md5 = md5($_POST['nowehaslo']);
            if($_POST['nowehaslo'] == $_POST['nowehaslo2']){

                $sql = "UPDATE $username.$table SET `haslo_md5` = '$haslo_md5' WHERE $table.`mail` = '$email'";
                //echo $sql;
                if ($conn->query($sql) === TRUE) {
                    echo "<br> Twoje hasło zostało zmienione, jeśli podany email jest w bazie danych! <br>";
                } 
            } else {
                    echo "Podane hasła nie są takie same!";
            } 
    }
?>
<style>
input[type=text], select {
  width: 20%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
H1 { color: #111; 
    font-family: 'Helvetica Neue', sans-serif; 
    font-size: 100px; 
    font-weight: bold; 
    letter-spacing: -1px; 
    line-height: 1; 
    text-align: center; }
input {
  width: 20%;
}

input[type=submit] {
  width: 20%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  text-align: center;
}
</style>
<H1> Zmiana hasła </H1><br><br>
<div>
<form action = "przypomnij.php" method = "POST">
Podaj Email: <input type="text" name ="email"><br>
Podaj nowe hasło: <input type="password" name="nowehaslo"><br>
Potwierdź nowe hasło: <input type="password" name="nowehaslo2"><br>
<input type="submit" value="Potwierdź" />
</form>
<form action = "zaloguj.php" method = "POST">
<input type="submit" value="Wróć do logowania" />
</form>
</div>

<?php
include("stopka.php")
?>