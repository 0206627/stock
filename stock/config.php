<?php 

$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "stock";

$connect = new mysqli($localhost, $username, $password, $dbname);
if ($connect->connect_error) {
    die("Connection failed:" . $connect->connect_error);
}

?>
