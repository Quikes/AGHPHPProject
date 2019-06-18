<?php
	session_start();
	include("nagl.php");
	include("polacz.php");
	
	$username = 'jazaga3';
	$table = "SlownikLekarzy";

	//Wygnerowanie connection obiekt conn
	$conn = polacz();

	
	//Sprawdzenie polaczenia
	if ($conn->connect_error){
		die("Brak połączenia: ". $conn->connect_error. "<br>");		
	}
	//Funkcje


	function show($table, $conn){
	
		$spec = 'SlownikSpecjalizacji';
	
		$zapytanie = "SELECT $table.IdSL, $table.imie, $table.nazwisko, $spec.spec, $table.tel1, $table.tel2, $table.email
		FROM $table LEFT JOIN $spec ON $table.IdSS = $spec.IdSS";
		$result = $conn->query($zapytanie);
		echo "Liczba znalezionych rekordów: ". $result->num_rows . "<br>";
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				echo $row["IdSL"] . " | ".
					 $row["nazwisko"]. " | ". $row["imie"]. " | ".
					 $row["spec"]. " | ". $row["tel1"]. " | ". $row["tel2"] .
					 " | ". $row["email"] . " | "."<br>";
			}
		} else {
			echo "Zwrócono 0 rekordów";
		}
	}
	function add($username, $conn, $table, $imie, $nazwisko, $nr, $tel1, $tel2, $spec, $mail){
		$zapytanie = "SELECT * FROM `SlownikSpecjalizacji` WHERE `spec`='$spec'";
		$result = $conn->query($zapytanie);
		$row = $result->fetch_assoc();
		$idSS = $row['IdSS'];
	
		$sql = "INSERT INTO `$username`.`$table` (`IdSL`, `IdSS`, `imie`, `nazwisko`, `nr_pwz`, `tel1`, `tel2`, `email`)  VALUES (NULL, '$idSS', '$imie', '$nazwisko', '$nr', '$tel1', '$tel2', '$mail');";
		if ($conn->query($sql) === TRUE) {
			echo "<br> Dodano nowego lekarze: $imie $nazwisko";
		} 
	}
	function delete($username, $conn, $table, $id){

		$sql = "DELETE FROM `$username`.`$table` WHERE `$table`.`idSL` = $id";
		if ($conn->query($sql) === TRUE) {
			echo "<br> Lekarz został usunięty z rejestru";
		} 
	}

	function edit($username, $conn, $table, $id, $imie, $nazwisko, $nr, $tel1, $tel2, $spec, $mail){
	
		$zapytanie = "SELECT * FROM `SlownikSpecjalizacji` WHERE `spec`='$spec'";
		$result = $conn->query($zapytanie);
		$row = $result->fetch_assoc();
		$idSS = $row['IdSS'];
	

		
		$sql = "UPDATE $username.$table SET `IdSS` = '$idSS', `imie` = '$imie', `nazwisko` = '$nazwisko', `nr_pwz` = '$nr',
		`tel1` = '$tel1', `tel2` = '$tel2', `email` = '$mail' WHERE `$table`.`IdSL` = $id";	
		
		if ($conn->query($sql) === TRUE) {
			echo "<br> Zaktualizowano dane o lekarzu <br>";
		} 
		
	}





	if(!empty($_POST['wyb'])){
        $wybor = $_POST['wyb'];
    }
	if(!isset($wybor)) $wybor = -1;
    switch ($wybor){
        case 'show':
            show($table, $conn);
            break;
		case 'add':
			add($username, $conn, $table, $_POST['imie'], $_POST['nazwisko'], $_POST['nr_pwz'], $_POST['tel1'], $_POST['tel2'],  $_POST['spec'], $_POST['mail']);
			break;
		case 'del':
			delete($username, $conn, $table, $_POST['IdSL']);
			break;
		case 'edit':
			edit($username, $conn, $table, $_POST['IdSL'], $_POST['imie'], $_POST['nazwisko'], $_POST['nr_pwz'], $_POST['tel1'], $_POST['tel2'],  $_POST['spec'], $_POST['mail']);
			break;
	}
	
	//Zamkniecie polaczenia
	

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
}
</style>

<div>
<form action="lekarz.php" method="post">
<select name="wyb">
<option value='show'>Wyświetl wszystkich lekarzy</option>
<option value='add'>Dodaj lekarza</option>
<option value='del'>Usuń lekarza</option>
<option value='edit'>Edytuj lekarza</option>
</select>
<input type="submit" value="Potwierdź" />
<br><br>
id: <input type="text" name="IdSL"><br>
imię: <input type="text" name="imie"><br>
nazwisko: <input type="text" name="nazwisko"><br>
specjalizacja:
<select name="spec">
<?php
$sql = "SELECT spec FROM SlownikSpecjalizacji";
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
  echo '<option value="'.$row['spec'].'">'.$row['spec'].'</option>';
?>
</select>
<br>
numer pozwolenia do wykonywania zawodu: <input type="text" name="nr_pwz"><br>
numer telefonu 1: <input type="text" name="tel1"><br>
numer telefonu 2: <input type="text" name="tel2"><br>
email: <input type="text" name="mail">
<br>
</form>
<form action = "main1.php" method = "POST">
<input type="submit" value="Powrót do strony głównej" />
</form>
</div>
<?php
	$conn->close();
	include("stopka.php");
?>

