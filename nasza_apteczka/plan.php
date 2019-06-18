<?php
	session_start();
	include("nagl.php");
  include("polacz.php");
    
  $username = 'jazaga3';
	$table = "WizytyULekarza";

	//Wygnerowanie connection obiekt conn
	$conn = polacz();
	
	//Sprawdzenie polaczenia
	if ($conn->connect_error){
		die("Brak połączenia: ". $conn->connect_error. "<br>");		
	}

	$leki = 'SlownikLekow';
	$spec = 'SlownikSpecjalizacji';
	$lek = 'SlownikLekarzy';
	$bad = 'SlownikBadanDiagnostycznych';
	$idUS = $_SESSION['id'];

	$zapytanie = "SELECT $table.IdW, $table.kiedy, $lek.imie, $lek.nazwisko
    FROM $table LEFT JOIN $lek ON $table.IdSL = $lek.IdSL WHERE $table.IdUS = $idUS";
    
    $ile = 0;
	$result = $conn->query($zapytanie);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
            if($row["kiedy"] > date("Y-m-d")){
			    echo $row["kiedy"]. " | lekarz: ". $row["imie"]. " ". $row["nazwisko"]. "<br>";
                $ile = $ile + 1;}
		}
	} else {
		echo "Zwrócono 0 rekordów";
    }

    if($ile == 0){
        echo("Brak zaplanowanych wizyt lekarskich");
	}
    echo "<br>";
    
	//Zamkniecie polaczenia
	$conn->close();

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
<div>
<form action = "main1.php" method = "POST">
<input type="submit" value="Powrót do strony głównej" />
</form>
</div>

<?php
	include("stopka.php");
?>