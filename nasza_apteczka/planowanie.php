<?php
	session_start();
  include("nagl.php");
  include("polacz.php");
  $username = 'jazaga3';
	$table = "PlanowaneBadania";

	//Wygnerowanie connection obiekt conn
	$conn = polacz(); 
    
    
    //Funkcje
    
    function show($table, $conn){
	
        $sl = 'SlownikBadanDiagnostycznych';
    
        $zapytanie = "SELECT $table.IdPB, $table.kiedy,$sl.badanie FROM $table LEFT JOIN $sl ON $table.IdBL = $sl.IdBL";
    
        $result = $conn->query($zapytanie);
        echo "Liczba znalezionych rekordów: ". $result->num_rows . "<br>";
        if($result->num_rows > 0){
            
            while($row = $result->fetch_assoc()){
                echo $row["IdPB"] . " | ".
                    $row["kiedy"] . " | ".
                    $row["badanie"]."<br>";
            }
        } else {
            echo "Zwrócono 0 rekordów";
        }
    }

    function add($username, $conn, $table, $badanie, $kiedy){
        $sql = "INSERT INTO `$username`.`$table` (`IdPB`, `kiedy`, `IdBL`) VALUES (NULL, '$kiedy', '$badanie');";
        
        if ($conn->query($sql) === TRUE) {
            echo "<br> Dodano nowe badanie numer: $badanie";
        } else {
            echo "<br> Error: " . $sql . "<br>" . $conn->error;
        }
    }

    

	
	if ($conn->connect_error){
		die("Brak połączenia: ". $conn->connect_error. "<br>");		
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
			add($username, $conn, $table, $_POST['badanie'], $_POST['kiedy']);
			break;
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
<form action="planowanie.php" method="post">
<select name="wyb">
<option value='show'>Terminarz badań</option>
<option value='add'>Zarejestruj badanie</option>
</select>
<input type="submit" value="Potwierdź" />
<br><br>
data: <input type="date" name="kiedy"><br>
nazwa badania:
<select name="badanie">
<?php
$sql = "SELECT * FROM SlownikBadanDiagnostycznych";
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
  echo '<option value="'.$row['IdBL'].'">'.$row['badanie'].'</option>';
?>
</select>
<br>
</form>
<br>
<form action = "main1.php" method = "POST">
<input type="submit" value="Powrót do strony głównej" />
</form>


<?php
    include("stopka.php");
    $conn->close();
?>
