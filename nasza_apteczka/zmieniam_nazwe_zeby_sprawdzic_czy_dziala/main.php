<?php
session_start();
include("../Common/nagl.php");
include("../Common/polacz.php");

$conn = polacz();
$username = 'jazaga3';
$table = "UzytkownicySystemu";

$zapytanie = "SELECT * FROM $table ";
$zapytanie.= "where mail= \"". $_POST['email']. "\"";
$wynik =  $conn->query($zapytanie);
$data=date("Y-m-d");
$czas=date("H:i:s");
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
	$stat = 1;
?>
<form action = "../Common/main1.php" method = "POST">
<input type="submit" value="Rozpocznij" />
</form>


<?php
}else{
		echo "Podałeś złe dane - nie masz uprawnień";
		$forma = "<form action=\"../index.php\" method=\"POST\">";
		$forma.= "<input type=\"submit\" value=\"Powrót do strony logowania\" />";
		$forma.= "</form>";
		echo $forma;
		
		
		
	}
	
?>

<?php

include("../Common/stopka.php");
?>