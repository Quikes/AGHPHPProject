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
H1 { color: #111; 
    font-family: 'Helvetica Neue', sans-serif; 
    font-size: 100px; 
    font-weight: bold; 
    letter-spacing: -1px; 
    line-height: 1; 
    text-align: center; }

    h2 { color: #111; 
        font-family: 'Open Sans', sans-serif;
         font-size: 30px; 
         font-weight: 300; 
         line-height: 32px; 
         margin: 0 0 72px; 
         text-align: center; }
         p { color: #685206; 
            font-family: 'Helvetica Neue', sans-serif; 
            font-size: 14px; 
            line-height: 24px;
            margin: 0 0 24px;
            text-align: center;}

div {
  border-radius: 10px;
  background-color: #f2f2f2;
  padding: 10px;
  text-align: center;
}
</style>

<p><img src="ksiazeczka.png"></p><H1> Książeczka zdrowia </H1><br>
<h2>Bartłomiej Król-Józaga & Bartosz Lizoń</h2><br>
<p>Projekt zrealizowany w ramach przedmiotu SIwM 2019</p>
<div>
<form action = "zaloguj.php" method = "POST">
<input type="submit" value="Zaloguj" />
</form>
<form action = "rejestracja.php" method = "POST">
<input type="submit" value="Zarejestruj się" />
</form>
</div>

<?php
include("stopka.php")
?>