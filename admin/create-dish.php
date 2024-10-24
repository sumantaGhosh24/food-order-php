<?php require "./includes/header.php"; ?>

<div class="flex justify-center items-center bg-white my-20">
    <div class="bg-white rounded-lg shadow-md p-8 shadow-black w-[60%]">
        <h1 class="text-3xl font-semibold mb-5">Create Dish</h1>
        <span id="form_error" class="text-red-500 font-bold text-center my-3 error_field"></span>
        <span id="form_success" class="text-green-500 font-bold text-center my-3 error_field"></span>
        <form class="mb-6" id="create_dish_form">
            <div class="mb-4">
                <label for="file">Dish Image:</label>
                <input type="file" id="file" name="file" accept="image/*"
                    class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300" />
            </div>
            <div class="mb-4">
                <label for="category_id">Dish Category:</label>
                <select name="category_id" id="category_id"
                    class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300">
                    <option value="">Select Category</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="type">Dish Category:</label>
                <select name="type" id="type" class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300">
                    <option value="">Select Dish Type</option>
                    <option value="veg">Veg</option>
                    <option value="non-veg">Non Veg</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="dish">Dish Title:</label>
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter dish title" name="dish" id="dish" />
            </div>
            <input type="hidden" name="action" value="create" />
            <button type="submit" id="create_dish_submit"
                class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200">Create
                Dish</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        function fetchCategories() {
            $.ajax({
                url: "http://localhost:3000/admin/includes/category.php?get=true",
                type: "get",
                success: function (result) {
                    let categories = $.parseJSON(result);

                    categories.forEach(category => {
                        $("#category_id").append(`
                            <option value="${category.id}">${category.name}</option>
                        `);
                    })
                }
            })
        }

        fetchCategories();

        $("#create_dish_form").on("submit", function (e) {
            $(".error_field").html("");
            $("#create_dish_submit").attr("disabled", true);
            $("#create_dish_submit").text("Processing...");

            var formData = new FormData(this);

            $.ajax({
                url: "http://localhost:3000/admin/includes/dish.php",
                type: "post",
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    $("#create_dish_submit").attr("disabled", false);
                    $("#create_dish_submit").text("Create Dish");

                    var data = $.parseJSON(result);

                    if (data.status === "error") {
                        $("#form_error").html(data.msg);
                    }

                    if (data.status === "success") {
                        $("#form_success").html(data.msg);
                        $("#create_dish_form")[0].reset();
                    }
                }
            })

            e.preventDefault();
        })
    })
</script>

<?php require "./includes/footer.php"; ?>