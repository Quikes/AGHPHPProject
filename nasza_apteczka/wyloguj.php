<?php
session_start();
include("nagl.php");

if(isset($_SESSION)){
    session_destroy();
    $_SESSION = array();
}
?>

<br/> Zostałeś poprawnie wylogowany :) <br/><br/>
<style>
    H1 { color: #111; 
    font-family: 'Helvetica Neue', sans-serif; 
    font-size: 100px; 
    font-weight: bold; 
    letter-spacing: -1px; 
    line-height: 1; 
    text-align: center; }
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
<form action = "index.php" method = "POST">
<input type="submit" value="Zaloguj ponownie">
</form>
</div>

<?php
include("stopka.php")
?>