<?php include('partials/menu.php'); ?>

<!-- start update food form -->
<section class="max-w-4xl p-6 mx-auto bg-blue-600 rounded-md shadow-md my-20">
    <h1 class="text-xl font-bold text-white capitalize">Update Food</h1>
    <?php 
        if(isset($_GET['id'])) {
            $pid = $_GET['id'];

            $sql2 = "SELECT * FROM food WHERE id=$pid";
            $res2 = mysqli_query($conn, $sql2);

            $row2 = mysqli_fetch_assoc($res2);

            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];
        } else {
            header('location:'.SITEURL.'manage-food.php');
        }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
            <div>
                <label class="text-white" for="title">Title</label>
                <input id="title" type="text" name="title" placeholder="Enter food title" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" value="<?php echo $title; ?>" />
            </div>
            <div>
                <label class="text-white" for="description">Description</label>
                <textarea id="description" type="textarea" name="description" placeholder="Enter food description" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring"><?php echo $description; ?></textarea>
            </div>
            <div>
                <label class="text-white" for="price">Price</label>
                <input id="price" type="number" name="price" placeholder="Enter food price" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" value="<?php echo $price; ?>" />
            </div>
            <div>
                <?php
                    if($current_image != "") {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" class="h-24">
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
                <label class="text-white" for="category">Category</label>
                <select name="category" id="category" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring">
                    <?php
                    $sql = "SELECT * FROM category WHERE active='Yes'";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if($count>0) {
                        while($row=mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $title = $row['title'];
                            ?>
                            <option value="<?php echo $id; ?>" <?php if($current_category == $id) {echo "selected";} ?>><?php echo $title; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="0">No Category Found</option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <label class="text-white" for="featured">Featured</label>
                <input id="featured-1" type="radio" value="Yes" name="featured" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?php if($featured=="Yes") {echo "checked";} ?> >
                <input id="featured-2" type="radio" value="No" name="featured" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?php if($featured=="No") {echo "checked";} ?> >
            </div>
            <div>
                <label class="text-white" for="active">Active</label>
                <input id="active-1" type="radio" value="Yes" name="active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?php if($active=="Yes") {echo "checked";} ?> >
                <input id="active-2" type="radio" value="No" name="active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" <?php if($active=="No") {echo "checked";} ?> >
            </div>
            <div>
                <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <input type="submit" name="submit" value="Update Food" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">
        </div>
    </form>
    <?php    
        if(isset($_POST['submit'])) {
            $pid = $_POST['pid'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            if(isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                if($image_name!="") {
                    $ext = end(explode('.', $image_name));

                    $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext;

                    $src_path = $_FILES['image']['tmp_name'];
                    $dest_path = "./images/food/".$image_name;

                    $upload = move_uploaded_file($src_path, $dest_path);

                    if($upload==false) {
                        $_SESSION['upload'] = '
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Danger!</strong>
                            <span class="block sm:inline">Failed to upload image.</span>
                        </div>
                        ';
                        ?>
                        <script>
                            window.location = "http://localhost/food-order-php/manage-food.php";
                        </script>
                        <?php
                        die();
                    }
                    if($current_image!="") {
                        $remove_path = "./images/food/".$current_image;

                        $remove = unlink($remove_path);

                        if($remove==false) {
                            $_SESSION['remove-failed'] = '
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
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }     

            $sql3 = "UPDATE food SET title = '$title',description = '$description', price = $price,image_name = '$image_name', category_id = '$category', featured = '$featured', active = '$active' WHERE id=$pid";

            $res3 = mysqli_query($conn, $sql3);

            if($res3==true) {
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                $_SESSION['update'] = '
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">Food updated successful.</span>
                </div>
                ';
                ?>
                <script>
                    window.location = "http://localhost/food-order-php/manage-food.php";
                </script>
                <?php
            } else {
                $_SESSION['update'] = '
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Danger!</strong>
                    <span class="block sm:inline">Failed to update food.</span>
                </div>
                ';
                ?>
                <script>
                    window.location = "http://localhost/food-order-php/manage-food.php";
                </script>
                <?php
            }            
        }    
    ?>
</section>
<!-- end update food form -->

<?php include('partials/footer.php'); ?>