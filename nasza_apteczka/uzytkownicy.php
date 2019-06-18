<?php
	session_start();
	include("nagl.php");
	include("polacz.php");
    
    $username = "jazaga3";
    $table = "UzytkownicySystemu";


	//Wygnerowanie connection obiekt conn
	$conn = polacz();
	
	//Sprawdzenie polaczenia
	if ($conn->connect_error){
		die("Brak połączenia: ". $conn->connect_error. "<br>");		
	}


	//Funkcje

	function show($table, $conn){
	
		$zapytanie = "SELECT * FROM $table";
		
		
		$result = $conn->query($zapytanie);
		echo "Liczba znalezionych rekordów: ". $result->num_rows . "<br>";
		if($result->num_rows > 0){
			
			while($row = $result->fetch_assoc()){
				echo $row["IdUS"] . " | ".
					 $row["imie"]. " | ". $row["nazwisko"]. " | ".
					 $row["mail"]."<br>";
			}
		} else {
			echo "Zwrócono 0 rekordów";
		}
	}

	function delete($username, $conn, $table, $id){

		$sql = "DELETE FROM `$username`.`$table` WHERE `$table`.`idUS` = $id";
		if ($conn->query($sql) === TRUE) {
			echo "<br> Użytkownik został usunięty";
		} else {
			echo "<br> Error: " . $sql . "<br>" . $conn->error;
		}
	}


	function edit($username, $conn, $table, $imie, $nazwisko, $mail, $IdUS){
	
	


		$sql = "UPDATE $username.$table SET `imie` = '$imie', `nazwisko` = '$nazwisko', `mail` = '$mail' WHERE `$table`.`IdUS` = '$IdUS'";	
		if ($conn->query($sql) === TRUE) {
			echo "<br> Zaktualizowano dane o użytkowniku <br>";
		} else {
			echo "<br> Error: " . $sql . "<br>" . $conn->error;
		}
	}




	if(!empty($_POST['wyb'])){
        $wybor = $_POST['wyb'];
    }
	if(!isset($wybor)) {
		$wybor = -1;
	} 

    switch ($wybor){
        case 'show':
            show($table, $conn);
            break;
		case 'del':
			delete($username, $conn, $table, $_POST['IdUS']);
			break;
		case 'edit':
			edit($username, $conn, $table, $_POST['imie'], $_POST['nazwisko'], $_POST['mail'], $_POST['IdUS']);
			break;
	}
	
	//Zamkniecie polaczenia
	$conn->close();

?>
<style>
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
</style>
<form action="uzytkownicy.php" method="post">
<select name="wyb">
<option value='show'>Wyświetl użytkowników</option>
<option value='del'>Usuń użytkownika</option>
<option value='edit'>Edytuj użytkownika</option>
</select>
<input type="submit" value="Potwierdź" />
<br><br>
id: <input type="text" name="IdUS"><br>
Imie: <input type="text" name="imie"><br>
Nazwisko: <input type="text" name="nazwisko"><br>
Email: <input type="text" name="mail">
<br>
</form>
<form action = "main1.php" method = "POST">
<input type="submit" value="Powrót do strony głównej" />
</form>


<?php
	include("stopka.php");
?>
