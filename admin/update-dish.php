<?php require "./includes/header.php"; ?>

<?php
if (!isset($_GET["id"])) {
    echo "There is something wrong, try again later.";
    die();
}
?>

<div class="bg-white min-h-screen">
    <div class="container mx-auto">
        <div class="flex pt-5 mb-5">
            <button id="update" class="mr-2 bg-blue-500 text-white px-4 py-2 rounded">Update Dish</button>
            <button id="addDetail" class="mr-2 bg-gray-400 text-white px-4 py-2 rounded">Add Dish Details</button>
            <button id="removeDetail" class="mr-2 bg-gray-400 text-white px-4 py-2 rounded">Remove Dish Details</button>
        </div>
        <div id="updateContent" class="bg-white shadow-md shadow-black p-5 rounded">
            <h1 class="text-2xl font-semibold mb-4">Update Dish</h1>
            <span id="form_success" class="text-green-500 font-bold text-center my-3 error_field"></span>
            <span id="form_error" class="text-red-500 font-bold text-center my-3 error_field"></span>
            <form id="update_form" class="p-4">
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
                <input type="hidden" name="action" value="update" />
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                <button type="submit" id="update_submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">Update
                    Dish</button>
            </form>
        </div>
        <div id="addDetailContent" class="hidden bg-white shadow-md shadow-black p-5 rounded">
            <h1 class="text-2xl font-semibold mb-4">Add Dish Details</h1>
            <span id="form_success" class="text-green-500 font-bold text-center my-3 error_field"></span>
            <span id="form_error" class="text-red-500 font-bold text-center my-3 error_field"></span>
            <form id="addDetail_form" class="mt-6 p-4">
                <div class="mb-4">
                    <label for="attribute">Dish Attribute:</label>
                    <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                        placeholder="Enter dish attribute" name="attribute" id="attribute" />
                </div>
                <div class="mb-4">
                    <label for="price">Dish Price:</label>
                    <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                        placeholder="Enter dish price" name="price" id="price" />
                </div>
                <input type="hidden" name="action" value="add-detail" />
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                <button type="submit" id="addDetail_submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors mt-5">Add
                    Detail</button>
            </form>
        </div>
        <div id="removeDetailContent" class="hidden bg-white shadow-md shadow-black p-5 rounded">
            <h1 class="text-2xl font-semibold mb-4">Remove Dish Details</h1>
            <span id="form_success" class="text-green-500 font-bold text-center my-3 error_field"></span>
            <span id="form_error" class="text-red-500 font-bold text-center my-3 error_field"></span>
            <table class="min-w-full bg-white rounded-lg shadow-md mx-auto mt-5">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Attribute</th>
                        <th class="py-3 px-6 text-left">Price</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody id="details"></tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#update").click(function () {
            $("#update").addClass("bg-blue-500");
            $("#update").removeClass("bg-gray-400");

            $("#addDetail").removeClass("bg-blue-500");
            $("#addDetail").addClass("bg-gray-400");
            $("#removeDetail").removeClass("bg-blue-500");
            $("#removeDetail").addClass("bg-gray-400");

            $("#updateContent").removeClass("hidden");

            $("#addDetailContent").addClass("hidden");
            $("#removeDetailContent").addClass("hidden");
        });

        $("#addDetail").click(function () {
            $("#addDetail").addClass("bg-blue-500");
            $("#addDetail").removeClass("bg-gray-400");

            $("#update").removeClass("bg-blue-500");
            $("#update").addClass("bg-gray-400");
            $("#removeDetail").removeClass("bg-blue-500");
            $("#removeDetail").addClass("bg-gray-400");

            $("#addDetailContent").removeClass("hidden");

            $("#updateContent").addClass("hidden");
            $("#removeDetailContent").addClass("hidden");
        });

        $("#removeDetail").click(function () {
            $("#removeDetail").addClass("bg-blue-500");
            $("#removeDetail").removeClass("bg-gray-400");

            $("#update").removeClass("bg-blue-500");
            $("#update").addClass("bg-gray-400");
            $("#addDetail").removeClass("bg-blue-500");
            $("#addDetail").addClass("bg-gray-400");

            $("#removeDetailContent").removeClass("hidden");

            $("#updateContent").addClass("hidden");
            $("#addDetailContent").addClass("hidden");
        });

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

        function fetchDish() {
            $.ajax({
                url: "http://localhost:3000/admin/includes/dish.php?id=<?php echo $_GET['id']; ?>",
                type: "get",
                success: function (result) {
                    var data = $.parseJSON(result);

                    $("#category_id").val(data.category.id);
                    $("#dish").val(data.dish);
                    $("#type").val(data.type);

                    $("#details").html("");

                    data.details.forEach(detail => {
                        $("#details").append(`
                            <tr>
                                <td class="py-3 px-6 text-left">${detail.id}</td>
                                <td class="py-3 px-6 text-left">${detail.attribute}</td>
                                <td class="py-3 px-6 text-left">${detail.price}</td>
                                <td class="py-3 px-6 text-left flex items-center gap-3">
                                    <form class="detail_delete_form">
                                        <input type="hidden" name="action" value="remove-detail" />
                                        <input type="hidden" name="id" value="${detail.id}" />
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        `);
                    })
                }
            })
        }

        fetchDish();

        $("#update_form").on("submit", function (e) {
            $(".error_field").html("");
            $("#update_submit").attr("disabled", true);
            $("#update_submit").text("Processing...");

            $.ajax({
                url: "http://localhost:3000/admin/includes/dish.php",
                type: "post",
                data: $("#update_form").serialize(),
                success: function (result) {
                    $("#update_submit").attr("disabled", false);
                    $("#update_submit").text("Update Dish");

                    var data = $.parseJSON(result);

                    if (data.status === "error") {
                        $("#form_error").html(data.msg);
                    }

                    if (data.status === "success") {
                        $("#form_success").html(data.msg);
                        fetchDish();
                    }
                }
            })

            e.preventDefault();
        })

        $("#addDetail_form").on("submit", function (e) {
            $(".error_field").html("");
            $("#addDetail_submit").attr("disabled", true);
            $("#addDetail_submit").text("Processing...");

            var formData = new FormData(this);

            $.ajax({
                url: "http://localhost:3000/admin/includes/dish.php",
                type: "post",
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    $("#addDetail_submit").attr("disabled", false);
                    $("#addDetail_submit").text("Add Detail");

                    var data = $.parseJSON(result);

                    if (data.status === "error") {
                        $("#form_error").html(data.msg);
                    }

                    if (data.status === "success") {
                        $("#form_success").html(data.msg);
                        $("#addDetail_form")[0].reset();
                        fetchDish();
                    }
                }
            })

            e.preventDefault();
        })

        $(document).on("submit", ".detail_delete_form", function (e) {
            e.preventDefault()

            let form = $(this);
            let button = form.find("button[type='submit']");

            $("#form_error").html("");
            $("#form_success").html("");
            button.attr("disabled", true);

            $.ajax({
                url: "http://localhost:3000/admin/includes/dish.php",
                type: "post",
                data: form.serialize(),
                success: function (result) {
                    button.attr("disabled", false);

                    var data = $.parseJSON(result);

                    if (data.status === "error") {
                        $("#form_error").html(data.msg);
                    }

                    if (data.status === "success") {
                        $("#form_success").html(data.msg);
                        fetchDish();
                    }
                }
            });
        })
    })
</script>

<?php require "./includes/footer.php"; ?>