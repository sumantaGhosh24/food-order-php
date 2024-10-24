<?php
include 'database.php';
include 'function.php';

if (isset($_SESSION['DB_LOGIN']) && $_SESSION['DB_LOGIN'] != '') {

} else {
    header('Location: ' . SERVER_PATH . 'delivery_boy/login.php');
    die();
}

$page_title = "Food Order Website";
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="author" content="sumanta ghosh" />
    <meta name="description" content="e commerce delivery boy dashboard" />
    <meta name="keywords" content="e-commerce, dashboard" />

    <!--==================== favicon ====================-->
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon-16x16.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/images/apple-touch-icon.png" />
    <link rel="manifest" href="./assets/images/site.webmanifest" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="msapplication-TileColor" content="#000000" />
    <meta name="theme-color" content="#000000" />

    <!--==================== canonical ====================-->
    <link rel="canonical" href="http://example.com/home" />

    <!--==================== fontawesome cdn ====================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />

    <!--==================== jQuery cdn ====================-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!--==================== custom css ====================-->
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />

    <title>
        <?php echo $page_title; ?>
    </title>
</head>

<body class="bg-white">
    <nav class="bg-blue-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-2xl font-bold">Logo</a>
            <ul class="flex space-x-4">
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>