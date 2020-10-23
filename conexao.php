<?php 

$hostname="localhost";
$user="root";
$senha="";
$banco="checklist";

$dbcon = new MySQLi("$hostname","$user","$senha","$banco");

if($dbcon->connect_error){
    echo "erro na conexão";
    exit();
}

?>