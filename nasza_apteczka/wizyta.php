<?php
session_start();
include("nagl.php");

include("polacz.php");

$username = "jazaga3";
$table = "WizytyULekarza";


	//Wygnerowanie connection obiekt conn
$conn = polacz();
	
	//Funkcje 
function show($table, $conn){
		$leki = 'SlownikLekow';
		$spec = 'SlownikSpecjalizacji';
		$lek = 'SlownikLekarzy';
		$bad = 'SlownikBadanDiagnostycznych';
		$idUS = $_SESSION['id'];
	
		$zapytanie = "SELECT $table.IdW, $table.kiedy, $table.diagnoza, $lek.imie, $lek.nazwisko, $bad.badanie
		FROM $table LEFT JOIN $lek ON $table.IdSL = $lek.IdSL LEFT JOIN $bad ON $table.IdBL = $bad.IdBL WHERE $table.IdUS = $idUS";
		$result = $conn->query($zapytanie);
		echo "Liczba znalezionych rekordów: ". $result->num_rows . "<br>";
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				echo $row["IdW"] . " | ".
					 $row["kiedy"]. " | lekarz: ". $row["imie"]. " ". $row["nazwisko"]. " | badania: ". $row["badanie"] . " | "."<br>";
				echo "Diagnoza: ". $row["diagnoza"]."<br><br>";
		
			}
		} else {
			echo "Zwrócono 0 rekordów";
		}
		echo "<br>";
	}

	function add($username, $conn, $table, $kiedy, $diagnoza, $status, $badanie, $lekarz){


		//Pobieranie ID lekarza
		$zapytanieLek = "SELECT * FROM `SlownikLekarzy` WHERE (CONCAT(`imie`,' ', `nazwisko`) LIKE '%" . $lekarz . "%')";
		
		$result = $conn->query($zapytanieLek);
		$row = $result->fetch_assoc();
		$idSL = $row['IdSL'];

		//Pobieranie ID badania
		$zapytanieBad = "SELECT * FROM `SlownikBadanDiagnostycznych` WHERE `badanie`='$badanie'";
		$result = $conn->query($zapytanieBad);
			$row = $result->fetch_assoc();
		$idBL = $row['IdBL'];
	
		$mail= $_SESSION['email'];
		$zapytanieUS = "SELECT * FROM `UzytkownicySystemu` WHERE `mail`='$mail'";
		$result = $conn->query($zapytanieUS);
			$row = $result->fetch_assoc();
		$idUS = $row['IdUS'];
	
			$sql = "INSERT INTO `$username`.`$table` (`IdW`, `IdUS`, `IdSL`, `IdBL`, `kiedy`, `diagnoza`, `status`) VALUES (NULL, '$idUS', '$idSL', '$idBL', '$kiedy', '$diagnoza', '$status');";
		//echo $sql;
		if ($conn->query($sql) === TRUE) {
			echo "<br> Dodano nową wizytę";
		} else {
			echo "<br> Error: " . $sql . "<br>" . $conn->error;
		}
	}


	function edit($username, $conn, $table, $id, $kiedy, $diagnoza, $status, $badanie, $lekarz){
		//Pobieranie ID lekarza
		$zapytanieLek = "SELECT * FROM `SlownikLekarzy` WHERE (CONCAT(`imie`,' ', `nazwisko`) LIKE '%" . $lekarz . "%')";
		$result = $conn->query($zapytanieLek);
		$row = $result->fetch_assoc();
		$idSL = $row['IdSL'];
	
		//Pobieranie ID badania
		$zapytanieBad = "SELECT * FROM `SlownikBadanDiagnostycznych` WHERE `badanie`='$badanie'";
		$result = $conn->query($zapytanieBad);
		$row = $result->fetch_assoc();
		$idBL = $row['IdBL'];
	
		
		$sql = "UPDATE $username.$table SET `IdSL` = '$idSL', `IdBL` = '$idBL', `kiedy` = '$kiedy', `diagnoza` = '$diagnoza',
		`status` = '$status' WHERE `$table`.`IdW` = $id";	

		if ($conn->query($sql) === TRUE) {
			echo "<br> Zaktualizowano dane o wizycie <br>";
		} else {
			echo "<br> Error: " . $sql . "<br>" . $conn->error;
		}

	
	}

	function del($username, $conn, $table, $id){

		$sql = "DELETE FROM `$username`.`$table` WHERE `$table`.`idW` = $id";
		if ($conn->query($sql) === TRUE) {
			echo "<br> Wizyta została usunięta";
		} else {
			echo "<br> Error: " . $sql . "<br>" . $conn->error;
		}
	}



	//Sprawdzenie polaczenia
	if ($conn->connect_error){
		die("Brak połączenia: ". $conn->connect_error. "<br>");		
	}
	
	if(!empty($_POST['wyb'])){
        $wybor = $_POST['wyb'];
        // echo "Wybrano z GET<br>";
    }
	if(!isset($wybor)) $wybor = -1;
    //echo "<br> Wybor = $wybor <br>";
    switch ($wybor){
    case 'show':
      show($table, $conn);
      break;
		case 'add':
			add($username, $conn, $table, $_POST['kiedy'], $_POST['diagnoza'], $_POST['status'], $_POST['badanie'], $_POST['lekarz']);
			break;
		case 'edit':
			edit($username, $conn, $table, $_POST['IdW'], $_POST['kiedy'], $_POST['diagnoza'], $_POST['status'], $_POST['badanie'], $_POST['lekarz']);
			break;
		case 'del':
			del($username, $conn, $table, $_POST['IdW']);
			break;
	}

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
<form action="wizyta.php" method="post">
<select name="wyb">
<option value='show'>Wyświetl dane o wizytach</option>
<option value='add'>Dodaj wizytę</option>
<option value='edit'>Edytuj wizytę</option>
<option value='del'>Usuń wizytę</option>
</select>

<br><br>
id: <input type="text" name="IdW"><br>
data: <input type="date" name="kiedy"><br>
diagnoza: <input type="text" name="diagnoza"><br>
status: <input type="text" name="status"><br>

badanie:
<select name="badanie">
<?php
$sql = "SELECT badanie FROM SlownikBadanDiagnostycznych";
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
  echo '<option value="'.$row['badanie'].'">'.$row['badanie'].'</option>';
?>

</select>
<br>

lekarz:
<select name="lekarz">
<?php
$sql = "SELECT imie, nazwisko FROM SlownikLekarzy";
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
  echo '<option value="'.$row['imie'].' '.$row['nazwisko'].'">'.$row['imie'].' '.$row['nazwisko'].'</option>';
?>
</select>
<br>
<input type="submit" value="Potwierdź" />
</form>
<br>
<form action = "zaordleki.php" method = "POST">
<input type="submit" value="Dodaj przepisane leki" />
</form>
</form>
<br>
</form>
<form action = "main1.php" method = "POST">
<input type="submit" value="Powrót do strony głównej" />
</form>
</div>
<?php
	//Zamkniecie polaczenia
	$conn->close();
	include("stopka.php");
?>

