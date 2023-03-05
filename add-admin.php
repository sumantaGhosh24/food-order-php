<?php include('partials/menu.php'); ?>

<!-- start form section -->
<section class="max-w-4xl p-6 mx-auto bg-blue-600 rounded-md shadow-md my-20">
  <h1 class="text-xl font-bold text-white capitalize">Add Admin</h1>
  <?php
    if(isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
  ?>
  <form action="" method="POST">
    <div class="grid grid-cols-1 gap-6 my-4 sm:grid-cols-2">
      <div>
        <label class="text-white" for="full_name">Fullname</label>
        <input id="full_name" type="text" name="full_name" placeholder="Enter your name" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" required />
      </div>
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
      <input type="submit" name="submit" value="Add Admin" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-red-500 rounded-md hover:bg-red-700 focus:outline-none focus:bg-gray-600" />
    </div>
  </form>
</section>
<!-- end form section -->

<?php include('partials/footer.php'); ?>

<?php
    if(isset($_POST['submit'])) {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "INSERT INTO admin SET full_name='$full_name', username='$username', password='$password'";
 
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        if($res==TRUE) {
            $_SESSION['add'] = '
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">Added admin successfully.</span>
                </div>
            ';
            ?>
            <script>
              location.href = "http://localhost/food-order-php/manage-admin.php";
            </script>
            <?php
        } else {
            $_SESSION['add'] = '
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Danger!</strong>
                <span class="block sm:inline">Failed to add admin.</span>
            </div>
            ';
            ?>
            <script>
              location.href = "http://localhost/food-order-php/add-admin.php";
            </script>
            <?php
        }
    }    
?>