<?php
	session_start();
	include("nagl.php");
	include("polacz.php");


    $username = "jazaga3";
    
	//Wygnerowanie connection obiekt conn
	$conn = polacz();
	
	$table = "TabelaZaordynowanychLekow";

	//Funkcje


	function show($table, $conn, $IdW){
		$IdW = $_POST['IdW'];
		$slownik = "SlownikLekow";
		$zapytanie = "SELECT $table.IdZL, $slownik.nazwa, $slownik.postac, $table.dawka_jednorazowa FROM $table LEFT JOIN $slownik ON $table.IdSLek = $slownik.IdSLek WHERE $table.IdW = $IdW"  ;
		
		
		$result = $conn->query($zapytanie);
		echo "Liczba znalezionych rekordów: ". $result->num_rows . "<br>";
		if($result->num_rows > 0){
			
			while($row = $result->fetch_assoc()){
				echo $row["IdZL"] . " | ".$row["nazwa"]. " | ".
					 $row["postac"]. " | ". $row["dawka_jednorazowa"]."<br>";
			}
		} else {
			echo "Zwrócono 0 rekordów";
		}
	}
	function add($username, $conn, $table, $IdW, $IdSLek, $dawka){

		
		$sql = "INSERT INTO `$username`.`$table` (`IdZL`, `IdW`, `IdSLek`, `dawka_jednorazowa`) VALUES (NULL, $IdW, $IdSLek, $dawka);";
		//echo $sql;
	
		if ($conn->query($sql) === TRUE) {
			echo "<br> Dodano nowy lek!";
		} else {
			echo "<br> Error: " . $sql . "<br>" . $conn->error;
		}
	}
	function delete($username, $conn, $table, $IdZL){

		$sql = "DELETE FROM `$username`.`$table` WHERE `$table`.`IdZL` = $IdZL";
	
		//echo $sql;
		if ($conn->query($sql) === TRUE) {
			echo "<br> Lek został usunięty";
		} else {
			echo "<br> Error: " . $sql . "<br>" . $conn->error;
		}
	}
	function edit($username, $conn, $table, $IdZL, $dawka, $IdSLek){
	


		$sql = "UPDATE $username.$table SET `dawka_jednorazowa` = '$dawka', `IdSLek` = '$IdSLek' WHERE `$table`.`IdZL` = $IdZL";	
		if ($conn->query($sql) === TRUE) {
			echo "<br> Zaktualizowano dane o leku <br>";
		}else{
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
            show($table, $conn, $IdW);
            break;
		case 'add':
			add($username, $conn, $table, $_POST['IdW'], $_POST['IdSLek'], $_POST["dawka"]);
			break;
		case 'del':
			delete($username, $conn, $table, $_POST['IdZL']);
			break;
		case 'edit':
			edit($username, $conn, $table, $_POST['IdZL'], $_POST["dawka"], $_POST['IdSLek']);
			break;
	}
	


?>
<h2> Wybierz Opcje </h2>
<form action="zaordleki.php" method="post">
	
<select name="wyb">

<option value='show'>Wyświetl zapisane leki</option>
<option value='add'>Dodaj lek</option>
<option value='del'>Usuń lek</option>
<option value='edit'>Edytuj lek</option>
</select>

<br><h3>Uzupełnij</h3>

id zaordynowanego leku: <input type="text" name="IdZL"><br>
lek: 
<select name="IdSLek">
<?php
$sql = "SELECT * FROM SlownikLekow";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
print_r($orw);
while($row = $result->fetch_assoc())
  echo '<option value="'.$row['IdSLek'].'">'.$row['nazwa'].'</option>';
?>
</select>
<br>
id Wizyty:
<select name="IdW">
<?php
$id = $_SESSION['id'];
$sql = "SELECT IdW FROM WizytyULekarza where IdUS = $id";
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
  echo '<option value="'.$row['IdW'].'">'.$row['IdW'].'</option>';
?>
</select>
<br>
dawka jednorazowa: <input type="text" name="dawka"><br>
<br>
<input type="submit" value="Potwierdź" />
</form>

</form>
<br>
<form action = "main1.php" method = "POST">
<input type="submit" value="Powrót do strony głównej" />
</form>


<?php
    include("stopka.php");
    
    //Zamkniecie polaczenia
	$conn->close();
?>