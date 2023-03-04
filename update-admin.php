<?php include('partials/menu.php'); ?>

<!-- start update admin form -->
<section class="max-w-4xl p-6 mx-auto bg-blue-600 rounded-md shadow-md my-20">
    <h1 class="text-xl font-bold text-white capitalize">Update Admin</h1>
    <?php
        $id = $_GET['id'];

        $sql = "SELECT * FROM admin WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res == true) {
            $count = mysqli_num_rows($res);
            if($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                ?>
                <script>
                    window.location = "http://localhost/food-order-php/manage-admin.php";
                </script>
                <?php
            }
        }
    ?>
    <form action="" method="POST">
        <div class="grid grid-cols-1 gap-6 my-4 sm:grid-cols-2">
            <div>
                <label class="text-white" for="full_name">Fullname</label>
                <input id="full_name" type="text" name="full_name" placeholder="Enter your fullname" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" required value="<?php echo $full_name; ?>" />
            </div>
            <div>
                <label class="text-white" for="username">Username</label>
                <input id="username" type="text" name="username" placeholder="Enter your username" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" required value="<?php echo $username; ?>" />
            </div>
            <div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <input type="submit" name="submit" value="Update Admin" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-red-500 rounded-md hover:bg-red-700 focus:outline-none focus:bg-gray-600" />
        </div>
    </form>
</section>
<!-- end update admin form -->

<?php
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        $sql = "UPDATE admin SET full_name = '$full_name', username = '$username' WHERE id='$id'";

        $res = mysqli_query($conn, $sql);

        if($res==true) {
            $_SESSION['update'] = '
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">Admin updated successful.</span>
            </div>
            ';
            ?>
            <script>
                window.location = "http://localhost/food-order-php/manage-admin.php";
            </script>
            <?php
        } else {
            $_SESSION['update'] = '
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Danger!</strong>
                <span class="block sm:inline">Failed to delete admin.</span>
            </div>
            ';
            ?>
            <script>
                window.location = "http://localhost/food-order-php/manage-admin.php";
            </script>
            <?php
        }
    }
?>

<?php include('partials/footer.php'); ?>