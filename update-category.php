<?php include('partials/menu.php'); ?>

<!-- start update category form -->
<section class="max-w-4xl p-6 mx-auto bg-blue-600 rounded-md shadow-md my-20">
    <h1 class="text-xl font-bold text-white capitalize">Update Category</h1>
    <?php
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM category WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count==1) {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                $_SESSION['no-category-found'] = '
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Danger!</strong>
                    <span class="block sm:inline">Category not found.</span>
                </div>
                ';
                ?>
                <script>
                    window.location = "http://localhost/food-order-php/manage-category.php";
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                window.location = "http://localhost/food-order-php/manage-category.php";
            </script>
            <?php
        }    
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
            <div>
                <label class="text-white" for="title">Title</label>
                <input id="title" type="text" name="title" placeholder="Enter category title" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" value="<?php echo $title; ?>" required />
            </div>
            <div>
                <?php
                    if($current_image != "") {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" class="h-24 w-24" >
                        <?php
                    } else {
                        echo "<div>Image not added.</div>";
                    }
                ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-white"> Image </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-white" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span class="">Upload a file</span>
                            <input id="image" name="image" type="file" class="sr-only" />
                        </label>
                        <p class="pl-1 text-white">or drag and drop</p>
                        </div>
                        <p class="text-xs text-white">PNG, JPG, GIF up to 10MB</p>
                    </div>
                </div>
            </div>
            <div>
                <label class="text-white" for="featured">Featured</label>
                <input id="featured-1" type="radio" value="Yes" name="featured" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?php if($featured=="Yes") {echo "checked";} ?> > Yes
                <input id="featured-2" type="radio" value="No" name="featured" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?php if($featured=="No") {echo "checked";} ?> > No
            </div>
            <div>
                <label class="text-white" for="active">Active</label>
                <input id="active-1" type="radio" value="Yes" name="active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?php if($active=="Yes") {echo "checked";} ?> > Yes
                <input id="active-2" type="radio" value="No" name="active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?php if($active=="No") {echo "checked";} ?> > No
            </div>
            <div>
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            </div>
        </div>
        <div class="flex justify-end mt-6">
        <input type="submit" name="submit" value="Update Category" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">
        </div>
    </form>
</section>
<!-- end update category form -->

<?php
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        
        if(isset($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];
            
            if($image_name != "") {
                $ext = end(explode('.', $image_name));
                
                $image_name = "Food_Category_".rand(000, 999).'.'.$ext;                

                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "./images/category/".$image_name;

                $upload = move_uploaded_file($source_path, $destination_path);

                if($upload==false) {
                    $_SESSION['upload'] = '
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Danger!</strong>
                        <span class="block sm:inline">Failed to upload image.</span>
                    </div>
                    ';
                    ?>
                    <script>
                        window.location = "http://localhost/food-order-php/manage-category.php";
                    </script>
                    <?php
                    die();
                }

                if($current_image!="") {
                    $remove_path = "./images/category/".$current_image;

                    $remove = unlink($remove_path);

                    if($remove==false) {
                        $_SESSION['failed-remove'] = '
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Danger!</strong>
                            <span class="block sm:inline">Failed to remove current image.</span>
                        </div>
                        ';
                        ?>
                        <script>
                            window.location = "http://localhost/food-order-php/manage-category.php";
                        </script>
                        <?php
                        die();
                    }
                }
            } else {
                $image_name = $current_image;
            }
        } else {
            $image_name = $current_image;
        }

        $sql2 = "UPDATE category SET title = '$title', image_name = '$image_name', featured = '$featured', active = '$active' WHERE id=$id";

        $res2 = mysqli_query($conn, $sql2);

        if($res2==true) {
            $_SESSION['update'] = '
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">Category updated successful.</span>
            </div>
            ';
            ?>
            <script>
                window.location = "http://localhost/food-order-php/manage-category.php";
            </script>
            <?php
        } else {
            $_SESSION['update'] = '
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Danger!</strong>
                <span class="block sm:inline">Failed to update category.</span>
            </div>
            ';
            ?>
            <script>
                window.location = "http://localhost/food-order-php/manage-category.php";
            </script>
            <?php
        }
    }
?>

<?php include('partials/footer.php'); ?>