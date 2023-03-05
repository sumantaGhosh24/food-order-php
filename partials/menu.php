<?php
    include('./config/constants.php');
    include('login-check.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- favicon -->
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />

    <!-- tailwind js cdn -->
    <script src="https://cdn.tailwindcss.com"></script>

    <title>FOOD || Home</title>
  </head>
  <body>
    <!-- start navbar section -->
    <nav
      class="flex justify-between items-center px-10 py-5 relative bg-blue-700"
    >
      <a class="font-black text-xl text-white" href="">ELEARN</a>
      <div class="hidden sm:flex gap-16">
        <ul class="flex gap-10 items-center">
          <li>
            <a href="index.php" class="text-white">Home</a>
          </li>
          <li>
            <a href="manage-admin.php" class="text-white">Admin</a>
          </li>
          <li>
            <a href="manage-category.php" class="text-white">Category</a>
          </li>
          <li>
            <a href="manage-food.php" class="text-white">Food</a>
          </li>
          <li>
            <a href="manage-order.php" class="text-white">Order</a>
          </li>
          <li>
            <a href="logout.php" class="text-white">Logout</a>
          </li>
        </ul>
      </div>
      <button id="menu_btn" class="w-10 sm:hidden">
        <svg
          id="menu_bars"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          class="bi bi-list text-white"
          viewBox="0 0 16 16"
        >
          <path
            fill-rule="evenodd"
            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"
          />
        </svg>
        <svg
          id="menu_close"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          class="bi bi-x hidden text-white"
          viewBox="0 0 16 16"
        >
          <path
            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"
          />
        </svg>
      </button>
      <div
        id="mobile_menu"
        class="absolute top-full bg-blue-600 right-5 left-5 hidden"
      >
        <div class="flex flex-col gap-10 p-5 sm:hidden">
          <ul class="flex flex-col gap-2 items-center text-center">
            <li class="w-full">
              <a class="py-5 block text-white hover:text-gray-400" href="index.php"
                >Home</a
              >
            </li>
            <li class="w-full">
              <a class="py-5 block text-white hover:text-gray-400" href="manage-admin.php"
                >Admin</a
              >
            </li>
            <li class="w-full">
              <a class="py-5 block text-white hover:text-gray-400" href="manage-category.php"
                >Category</a
              >
            </li>
            <li class="w-full">
              <a class="py-5 block text-white hover:text-gray-400" href="manage-food.php"
                >Food</a
              >
            </li>
            <li class="w-full">
              <a class="py-5 block text-white hover:text-gray-400" href="manage-order.php"
                >Order</a
              >
            </li>
            <li class="w-full">
              <a class="py-5 block text-white hover:text-gray-400" href="logout.php"
                >Logout</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end navbar section -->