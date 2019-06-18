<?php
session_start();
include("nagl.php");
include("polacz.php");

    $conn = polacz();
    $username = 'jazaga3';
    $table = "UzytkownicySystemu";
    $email = $_SESSION['email'];
    $haslo_md5 = md5($_POST['nowehaslo']);

    $sql = "SELECT * FROM $table WHERE `mail`='$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
   

    if (!empty($_POST['starehaslo']) && !empty($_POST['nowehaslo']) && $row['haslo_md5'] == md5($_POST['starehaslo']))
    {
    $sql = "UPDATE $username.$table SET  `haslo_md5` = '$haslo_md5' WHERE $table.`mail` = '$email';";

    
	    if ($conn->query($sql) === TRUE) {
            echo "<br> Twoje hasło zostało zmienione! <br>";
?>

<form action = "zaloguj.php" method = "POST">
<input type="submit" value="Zaloguj ⇨" />
</form>

<?php
	    } else {
		    echo "<br> Error: " . $sql . "<br>" . $conn->error;
	    }
    }else{
        echo 'Podałeś niepoprawne stare hasło! <br>';
        
        }
?>