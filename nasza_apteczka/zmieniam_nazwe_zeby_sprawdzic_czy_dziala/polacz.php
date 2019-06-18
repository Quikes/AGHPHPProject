<?php 
function polacz(){
$host = "mysql.agh.edu.pl";
$username = "jazaga3";
$password = "9C5wDvAJcr3HXZsV";
$database = "jazaga3";
$conn = new mysqli($host, $username, $password, $database);
//conn->query("SET CHARSET utf8");
//$conn->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");

return $conn;
}
?>