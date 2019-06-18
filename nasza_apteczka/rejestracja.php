<?php
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
  background-color: #E3130E;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #F16D6A;
}

div {
  border-radius: 10px;
  background-color: #f2f2f2;
  padding: 10px;
}
</style>
<div>
<form action = "rejestracja-fun.php" method = "POST">
Wprowadz swoje dane poniżej:
<br><br>
imie: <input type="text" name="imie"><br>
nazwisko: <input type="text" name="nazwisko"><br>
e-mail: <input type="text" name="mail"><br>
hasło: <input type="password" name="haslo"><br>
<input type="submit" value="Potwierdź" />
</form>
<form action = "index.php" method = "POST">
<input type="submit" value="Wróć do strony głównej" />
</form>
</div>
<?php
include("stopka.php")
?>