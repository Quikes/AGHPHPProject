<?php
	session_start();
	include("nagl.php");
    include("polacz.php");
    
    $username = 'jazaga3';
	$table = "SlownikBadanDiagnostycznych";
	
	$conn = polacz();
	

	//Funkcje
	function show($table, $conn){
	
		$zapytanie = "SELECT * FROM $table";
		
		$result = $conn->query($zapytanie);
		echo "Liczba znalezionych rekordów: ". $result->num_rows . "<br>";
		if($result->num_rows > 0){
			//wydrukowanie danych z każdego wiersza
			while($row = $result->fetch_assoc()){
				echo $row["IdBL"] . " | ".
					 $row["badanie"]."<br>";
			}
		} else {
			echo "Zwrócono 0 rekordów";
		}
	}
	function add($username, $conn, $table, $badanie){
		$sql = "INSERT INTO `$username`.`$table` (`IdBL`, `badanie`) VALUES (NULL, '$badanie');";
		//echo $sql;
		if ($conn->query($sql) === TRUE) {
			echo "<br> Dodano nowe badanie: $badanie";
		} else {
			echo "<br> Error: " . $sql . "<br>" . $conn->error;
		}
	}

	function delete($username, $conn, $table, $id){

		$sql = "DELETE FROM `$username`.`$table` WHERE `$table`.`IdBL` = '$id'";
	
		
		if ($conn->query($sql) === TRUE) {
			echo "<br> Badanie zostało usunięte";
		} else {
			echo "<br> Error: " . $sql . "<br>" . $conn->error;
		}
	}

	function edit($username, $conn, $table, $id, $badanie){
	
		$sql = "UPDATE `$username`.`$table` SET `badanie` = '$badanie' WHERE `$table`.`IdBL` = $id;";
		
		if ($conn->query($sql) === TRUE) {
			echo "<br> Zaktualizowano dane o badaniu <br>";
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
    }
	if(!isset($wybor)) $wybor = -1;
    //echo "<br> Wybor = $wybor <br>";
    switch ($wybor){
        case 'show':
            show($table, $conn);
            break;
		case 'add':
			add($username, $conn, $table, $_POST['badanie']);
			break;
		case 'del':
			delete($username, $conn, $table, $_POST['IdBL']);
			break;
		case 'edit':
			edit($username, $conn, $table,  $_POST['IdBL'], $_POST['badanie'] );
			break;
	}
	
	//Zamkniecie polaczenia
	$conn->close();

?>
<br>
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
<h2> Wybierz Opcje</h2>
<form action="badania.php" method="post">
<select name="wyb">
<option value='show'>Wyświetl listę dostępnych badań</option>
<option value='add'>Dodaj badanie</option>
<option value='del'>Usuń badanie</option>
<option value='edit'>Edytuj badanie</option>
</select>

<br><br>
id: <input type="text" name="IdBL"><br>
nazwa badania: <input type="text" name="badanie"><br>
<input type="submit" value="Potwierdź" />
</form>
<br>
<form action = "planowanie.php" method = "POST">
<input type="submit" value="Planowane badanie" />
</form>
<form action = "main1.php" method = "POST">
<input type="submit" value="Powrót do strony głównej" />
</form>
</div>

<?php
	include("../stopka.php");
?>