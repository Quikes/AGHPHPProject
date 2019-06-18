<?php
	session_start();
	include("nagl.php");
	//include("fun-leki.php");
	include("polacz.php");
    
    $username = "jazaga3";
	$table = "SlownikLekow";


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
				echo $row["IdSLek"] . " | ".
					 $row["nazwa"]. " | ". $row["sub_czynna"]. " | ".
					 $row["postac"]."<br>";
			}
		} else {
			echo "Zwrócono 0 rekordów";
		}
	}


	function add($username, $conn, $table, $nazwa, $sub_czynna, $postac){
		$sql = "INSERT INTO `$username`.`$table` (`IdSLek`, `nazwa`, `sub_czynna`, `postac`) VALUES (NULL, '$nazwa', '$sub_czynna', '$postac');";
		//echo $sql;
		if ($conn->query($sql) === TRUE) {
			echo "<br> Dodano nowy lek: $nazwa";
		} else {
			echo "<br> Error: " . $sql . "<br>" . $conn->error;
		}
	}

	function delete($username, $conn, $table,$IdSLek){
			$column = 'IdSLek';
			
	
		if($column == 'IdSLek'){
			$sql = "DELETE FROM `$username`.`$table` WHERE `$table`.`$column` = $IdSLek";
		}
		//echo $sql;
		if ($conn->query($sql) === TRUE) {
			echo "<br> Lek został usunięty";
		} else {
			echo "<br> Error: " . $sql . "<br>" . $conn->error;
		}
	}

	function edit($username, $conn, $table, $nazwa, $sub_czynna, $postac, $IdSLek){

		$sql = "UPDATE `jazaga3`.`SlownikLekow` SET `nazwa` = '$nazwa', `sub_czynna` = '$sub_czynna', `postac` = '$postac' WHERE `SlownikLekow`.`IdSLek` = $IdSLek";
			
		if ($conn->query($sql) === TRUE) {
			echo "<br> Zaktualizowano dane o leku <br>";
		}else{
			echo "<br> Error: " . $sql . "<br>" . $conn->error;
		}
	}
			
		
	



	if(!empty($_GET['wyb'])){
        $wybor = $_GET['wyb'];
        // echo "Wybrano z GET<br>";
    }
	if(!isset($wybor)) $wybor = -1;
    //echo "<br> Wybor = $wybor <br>";
    switch ($wybor){
        case 'show':
            show($table, $conn);
            break;
		case 'add':
			add($username, $conn, $table, $_GET['nazwa'], $_GET['sub_czynna'], $_GET['postac']);
			break;
		case 'del':
			delete($username, $conn, $table,$_GET['IdSLek']);
			break;
		case 'edit':
			edit($username, $conn, $table, $_GET['nazwa'], $_GET['sub_czynna'], $_GET['postac'], $_GET['IdSLek']);
			break;
	}
	
	//Zamkniecie polaczenia
	$conn->close();

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
<form action="lek.php" method="get">
<select name="wyb">
<option value='show'>Wyświetl Listę dostępnych leków</option>
<option value='add'>Dodaj lek</option>
<option value='del'>Usuń lek</option>
<option value='edit'>Edytuj lek</option>
</select>
<input type="submit" value="Potwierdź" />
<br><br>
id: <input type="text" name="IdSLek"><br>
nazwa: <input type="text" name="nazwa"><br>
substancja czynna: <input type="text" name="sub_czynna"><br>
postać: <input type="text" name="postac">
<br>
</form>
<form action = "zaordleki.php" method = "POST">
<input type="submit" value="Przepisywanie leków" />
</form>
<form action = "main1.php" method = "POST">
<input type="submit" value="Powrót do strony głównej" />
</form>
</div>

<?php
	include("stopka.php");
?>
