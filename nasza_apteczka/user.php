<?php
session_start();
include("nagl.php");

?>
<style>
    H1 { color: #111; 
    font-family: 'Helvetica Neue', sans-serif; 
    font-size: 100px; 
    font-weight: bold; 
    letter-spacing: -1px; 
    line-height: 1; 
    text-align: center; }
input[type=text], select {
  width: 20%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
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
<form action = "fun-user.php" method = "POST">
Podaj stare hasło: <input type="password" name="starehaslo"><br>
Podaj nowe hasło: <input type="password" name="nowehaslo"><br>
<input type="submit" value="Potwierdź" />
</form>

<form action = "main1.php" method = "POST">
<input type="submit" value="Powrót do strony głównej" />
</form>
<?php
if($_SESSION['status'] == 1){
?>
<form action = "uzytkownicy.php" method = "POST">
<input type="submit" value="Użytkownicy systemu" />
</form>
</div>

<?php
}
include("stopka.php")
?>