<?php
include "./includes/database.php";

unset($_SESSION["DB_ID"]);
unset($_SESSION["DB_LOGIN"]);

header('Location: ' . SERVER_PATH . 'delivery_boy/login.php');
?>