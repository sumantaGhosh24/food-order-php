<?php include('partials/menu.php'); ?>

<!-- start update form -->
<section class="max-w-4xl p-5 mx-auto bg-blue-600 rounded-md shadow-md my-20">
    <h1 class="text-xl font-bold text-white capitalize">Update Admin Password</h1>
    <?php
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
        }
    ?>
    <form action="" method="POST">
        <div class="grid grid-cols-1 gap-6 my-4 sm:grid-cols-2">
            <div>
                <label class="text-white" for="current_password">Current Password</label>
                <input id="current_password" type="password" name="current_password" placeholder="Enter your current password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" required />
            </div>
            <div>
                <label class="text-white" for="new_password">New Password</label>
                <input id="new_password" type="password" name="new_password" placeholder="Enter your new password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" required />
            </div>
            <div>
                <label class="text-white" for="confirm_password">Confirm Password</label>
                <input id="confirm_password" type="password" name="confirm_password" placeholder="Enter your confirm password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" required />
            </div>
            <div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <input type="submit" name="submit" value="Change Password" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-red-500 rounded-md hover:bg-red-700 focus:outline-none focus:bg-gray-600" />
        </div>
    </form>
</section>
<!-- end update form -->

<?php 
    if(isset($_POST['submit'])) {
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * FROM admin WHERE id=$id AND password='$current_password'";

        $res = mysqli_query($conn, $sql);

        if($res==true) {
            $count=mysqli_num_rows($res);

            if($count==1) {
                if($new_password==$confirm_password) {
                    $sql2 = "UPDATE admin SET password='$new_password' WHERE id=$id";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true) {
                        $_SESSION['change-pwd'] = '
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">Password changed successful.</span>
                        </div>
                        ';
                        ?>
                        <script>
                            location.href = 'http://localhost/food-order-php/manage-admin.php';
                        </script>
                        <?php
                    } else {
                        $_SESSION['change-pwd'] = '
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Danger!</strong>
                            <span class="block sm:inline">Failed to change password.</span>
                        </div>
                        ';
                        ?>
                        <script>
                            location.href = "http://localhost/food-order-php/manage-admin.php";
                        </script>
                        <?php
                    }
                } else {
                    $_SESSION['pwd-not-match'] = '
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Danger!</strong>
                        <span class="block sm:inline">Password did not match.</span>
                    </div>
                    ';
                    ?>
                    <script>
                        location.href = "http://localhost/food-order-php/manage-admin.php";
                    </script>
                    <?php
                }
            } else {
                $_SESSION['user-not-found'] = '
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Danger!</strong>
                    <span class="block sm:inline">User not found.</span>
                </div>
                ';
                ?>
                <script>
                    location.href = "http://localhost/food-order-php/manage-admin.php";
                </script>
                <?php
            }
        }
    }
?>

<?php include('partials/footer.php'); ?>