<?php
session_start();
include("nagl.php");
include("polacz.php");

$conn = polacz();
$username = 'jazaga3';
$table = "UzytkownicySystemu";

$zapytanie = "SELECT * FROM $table ";
$zapytanie.= "where mail= \"". $_POST['email']. "\"";
$wynik =  $conn->query($zapytanie);
$login = $_POST['email'];

if($wynik){
	$row = $wynik->fetch_assoc();
  $has = $row['haslo_md5'];
	$kto = $row['imie'];
	$id = $row['IdUS'];
	$status = $row['status'];
}

if((isset($has)) && md5($_POST['haslo']) == $has){	
	echo("Witaj $kto !");
	$_SESSION['login'] = $kto;
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['id'] = $id;
	$_SESSION['status'] = $status;
	//$stat = 1;
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
<form action = "main1.php" method = "POST">
<input type="submit" value="Rozpocznij" />
</form>


<?php
}else{
		echo "Podałeś złe dane - nie masz uprawnień";
		$forma = "<form action=\"index.php\" method=\"POST\">";
		$forma.= "<input type=\"submit\" value=\"Powrót do strony logowania\" />";
		$forma.= "</form>";
		echo $forma;
		
		
		
	}
	
?>
</div>
<?php

include("stopka.php");
?>