<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$dbname = "food_order_php";

$con = new mysqli($host, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

define("SERVER_PATH", "http://localhost:3000/");
?>