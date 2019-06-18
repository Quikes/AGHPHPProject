<?php
session_start();
include("nagl.php");

if(isset($_SESSION['login'])){
	session_destroy();
	$_SESSION = array();
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

<div>
<form action = "main.php" method = "POST">
e-mail: <input type="text" name="email"><br>
hasło: <input type="password" name="haslo"><br>
<input type="submit" value="Zaloguj" />
</form>
<form action = "przypomnij.php" method = "POST">
<input type="submit" value="Nie pamiętasz hasła?" />
</form>
</div>
<?php
include("stopka.php")
?>