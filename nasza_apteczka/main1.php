<?php
session_start();
include("nagl.php");
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
  text-align: center;
}
</style>
<div>
<form action = "user.php" method = "POST">
<input type="submit" value="Ustawienia" />
</form>
<br>
<form action = "wizyta.php" method = "POST">
<input type="submit" value="Wizyty Lekarskie" />
</form>
<form action = "plan.php" method = "POST">
<input type="submit" value="Terminarz planowanych wizyt lekarskich" />
</form>
<form action = "lekarz.php" method = "POST">
<input type="submit" value="Lekarze" />
</form>
<form action = "lek.php" method = "POST">
<input type="submit" value="Leki" />
</form>
<form action = "badania.php" method = "POST">
<input type="submit" value="Badania diagnostyczne" />
</form>
<br>
<br>
<form action = "wyloguj.php" method = "POST">
<input type="submit" value="Wyloguj" />
</form>
<br
</div>
<br>
<br>


<?php
include("stopka.php")
?>