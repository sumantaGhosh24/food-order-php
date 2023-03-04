<?php
    // authorization - access control
    if(!isset($_SESSION['user'])) {
        $_SESSION['no-login-message'] = '
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Danger!</strong>
                <span class="block sm:inline">Please login to access admin panel.</span>
            </div>
        ';
        header('location:'.SITEURL.'login.php');
    }
?>