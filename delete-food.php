<?php
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])) {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "") {
            $path = "../images/food/".$image_name;

            $remove = unlink($path);

            if($remove==false) {
                $_SESSION['upload'] = '
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Danger!</strong>
                    <span class="block sm:inline">Failed to remove image.</span>
                </div>
                ';
                ?>
                <script>
                    window.location = "http://localhost/food-order-php/manage-food.php";
                </script>
                <?php
                die();
            }
        }

        $sql = "DELETE FROM food WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res==true) {
            $_SESSION['delete'] = '
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">Food deleted successful.</span>
            </div>
            ';
            ?>
            <script>
                window.location = "http://localhost/food-order-php/manage-food.php";
            </script>
            <?php
        } else {
            $_SESSION['delete'] ='
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Danger!</strong>
                <span class="block sm:inline">Failed to delete food.</span>
            </div>
            ';
            ?>
            <script>
                window.location = "http://localhost/food-order-php/manage-food.php";
            </script>
            <?php
        }
    } else {
        $_SESSION['unauthorize'] = '
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Danger!</strong>
                <span class="block sm:inline">Unauthorized access.</span>
            </div>
        ';
        ?>
        <script>
            window.location = "http://localhost/food-order-php/manage-food.php";
        </script>
        <?php
    }
?>