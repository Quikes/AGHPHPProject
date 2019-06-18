<?php
include("nagl.php");
include("polacz.php");
$username = "jazaga3";
$table = "UzytkownicySystemu";
$conn = polacz();
$haslo_md5 = md5($_POST['haslo']);


if ( empty($_POST['imie']) || empty($_POST['nazwisko']) || empty($_POST['mail']) || empty($_POST['haslo'])){
    echo("Uzupełnij wszystkie pola! <br>");
?>
    <form action = "rejestracja.php" method = "POST">
    <input type="submit" value="Spróbuj ponownie" />
    </form>
<?php
}
else{
    $sql = "INSERT INTO $username.$table (`idUS`, `imie`, `nazwisko`, `mail`, `haslo_md5`) VALUES (NULL, '".$_POST['imie']."', '".$_POST['nazwisko']."','".$_POST['mail']."', '$haslo_md5');";
    if ($conn->query($sql) === TRUE) {
        echo "Dodano nowego uzytkownika <br>";
    ?>
        <form action = "zaloguj.php" method = "POST">
        <input type="submit" value="Zaloguj" />
        </form>
    <?php    
    } else {
	    echo "<br> Error: " . $sql . "<br>" . $conn->error;
    }
}
?>