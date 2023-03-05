<?php
    include('./config/constants.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM admin WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==true) {
        $_SESSION['delete'] = '
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Holy smokes!</strong>
                <span class="block sm:inline">Admin deleted successful.</span>
            </div>
        ';
        ?>
        <script>
            window.location = "http://localhost/food-order-php/manage-admin.php";
        </script>
        <?php
    } else  {
        $_SESSION['delete'] = '
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Holy smokes!</strong>
                <span class="block sm:inline">Failed to delete admin.</span>
            </div>
        ';
        ?>
        <script>
            window.location = "http://localhost/food-order-php/manage-admin.php";
        </script>
        <?php
    }
?>