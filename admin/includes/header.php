<?php
include 'database.php';
include 'function.php';

if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] != '') {

} else {
    header('Location: ' . SERVER_PATH . 'admin/login.php');
    die();
}

$curStr = $_SERVER["REQUEST_URI"];
$curArr = explode("/", $curStr);
$cur_path = $curArr[count($curArr) - 1];

$page_title = "Food Order Website";

if ($cur_path == "" || $cur_path == "index.php") {
    $page_title = "Dashboard";
} elseif ($cur_path == "category.php") {
    $page_title = "Categories";
} elseif ($cur_path == "create-category.php") {
    $page_title = "Create Category";
} elseif ($cur_path == "user.php") {
    $page_title = "Users";
} elseif ($cur_path == "delivery_boy.php") {
    $page_title = "Delivery Boy";
} elseif ($cur_path == "create-delivery_boy.php") {
    $page_title = "Create Delivery Boy";
} elseif ($cur_path == "coupon.php") {
    $page_title = "Coupons";
} elseif ($cur_path == "create-coupon.php") {
    $page_title = "Create Coupon";
} elseif ($cur_path == "dish.php") {
    $page_title = "Dishes";
} elseif ($cur_path == "create-dish.php") {
    $page_title = "Create Dish";
} elseif ($cur_path == "banner.php") {
    $page_title = "Banners";
} elseif ($cur_path == "create-banner.php") {
    $page_title = "Create Banner";
} elseif ($cur_path == "contact_us.php") {
    $page_title = "Contact Us";
} elseif ($cur_path == "order.php") {
    $page_title = "Orders";
}
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="author" content="sumanta ghosh" />
    <meta name="description" content="e commerce admin dashboard" />
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
                <div class="dropdown inline-block relative">
                    <button class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center">
                        <span class="mr-1">Manage</span>
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </button>
                    <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
                        <li><a href="category.php"
                                class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap">Categories</a>
                        </li>
                        <li><a href="user.php"
                                class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap">Users</a>
                        </li>
                        <li><a href="delivery_boy.php"
                                class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap">Delivery
                                Boy</a>
                        </li>
                        <li><a href="coupon.php"
                                class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap">Coupons</a>
                        </li>
                        <li><a href="dish.php"
                                class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap">Dishes</a>
                        </li>
                        <li><a href="banner.php"
                                class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap">Banners</a>
                        </li>
                        <li><a href="order.php"
                                class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap">Orders</a>
                        </li>
                        <li><a href="contact_us.php"
                                class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap">Contact
                                Us</a></li>
                    </ul>
                </div>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>