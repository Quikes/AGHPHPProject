<?php
session_start();
include("../Common/nagl.php");
?>
<form action = "../Uzytkownicy/user.php" method = "POST">
<input type="submit" value="Ustawienia" />
</form>
<br>
<form action = "../Logowanie/wyloguj.php" method = "POST">
<input type="submit" value="Wyloguj" />
</form>
<br><br>
<form action = "../Wizyty/wizyta.php" method = "POST">
<input type="submit" value="Wizyty Lekarskie" />
</form>
<form action = "../Wizyty/plan.php" method = "POST">
<input type="submit" value="Terminarz planowanych wizyt lekarskich" />
</form>
<form action = "../Lekarze/lekarz.php" method = "POST">
<input type="submit" value="Lekarze" />
</form>
<form action = "../Leki/lek.php" method = "POST">
<input type="submit" value="Leki" />
</form>
<form action = "../Badania/badania.php" method = "POST">
<input type="submit" value="Badania diagnostyczne" />
</form>
<br>
<br>


<?php
include("../Common/stopka.php")
?>