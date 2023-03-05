<?php include('./config/constants.php'); ?>

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

    <title>FOOD || Login</title>
  </head>
    <body>

        <!-- start login form -->
        <section class="max-w-4xl p-6 mx-auto bg-blue-600 rounded-md shadow-md mt-20">
            <h1 class="text-xl font-bold text-white capitalize">Login</h1>
            <?php 
                if(isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message'])) {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <form action="" method="POST">
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div>
                        <label class="text-white" for="username">Username</label>
                        <input id="username" type="text" name="username" placeholder="Enter your username" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" required />
                    </div>
                    <div>
                        <label class="text-white" for="password">Password</label>
                        <input id="password" type="password" name="password" placeholder="Enter your password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" required />
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <input type="submit" name="submit" value="Login" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-red-500 rounded-md hover:bg-red-700 focus:outline-one focus:bg-gray-600" />
                </div>
            </form>
        </section>
        <!-- end login form -->
    </body>
</html>

<?php
    if(isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1) {
            $_SESSION['login'] = '
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 my-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">Login success.</span>
            </div>
            ';
            $_SESSION['user'] = $username;
            header('location:'.SITEURL.'/');
        } else {
            $_SESSION['login'] = '
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 my-3 rounded relative" role="alert">
                <strong class="font-bold">Something Wrong!</strong>
                <span class="block sm:inline">Username and Password not match.</span>
            </div>
            ';
            header('location:'.SITEURL.'login.php');
        }
    }
?>