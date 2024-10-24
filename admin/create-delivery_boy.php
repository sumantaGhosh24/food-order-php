<?php require "./includes/header.php"; ?>

<div class="flex justify-center items-center h-screen bg-white">
    <div class="bg-white rounded-lg shadow-md p-8 shadow-black w-[60%]">
        <h1 class="text-3xl font-semibold mb-5">Create Delivery Boy</h1>
        <span id="form_error" class="text-red-500 font-bold text-center my-3 error_field"></span>
        <span id="form_success" class="text-green-500 font-bold text-center my-3 error_field"></span>
        <form class="mb-6" id="create_delivery_boy_form">
            <div class="mb-4">
                <label for="name">Delivery Boy Name:</label>
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter delivery boy name" name="name" />
            </div>
            <div class="mb-4">
                <label for="email">Delivery Boy Email:</label>
                <input type="email" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter delivery boy email" name="email" />
            </div>
            <div class="mb-4">
                <label for="mobile">Delivery Boy Mobile:</label>
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter delivery boy mobile" name="mobile" />
            </div>
            <div class="mb-4">
                <label for="password">Delivery Boy Password:</label>
                <input type="password" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter delivery boy password" name="password" />
            </div>
            <input type="hidden" name="action" value="create" />
            <button type="submit" id="create_delivery_boy_submit"
                class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200">Create
                Delivery Boy</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#create_delivery_boy_form").on("submit", function (e) {
            $(".error_field").html("");
            $("#create_delivery_boy_submit").attr("disabled", true);
            $("#create_delivery_boy_submit").text("Processing...");

            var formData = new FormData(this);

            $.ajax({
                url: "http://localhost:3000/admin/includes/delivery_boy.php",
                type: "post",
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    $("#create_delivery_boy_submit").attr("disabled", false);
                    $("#create_delivery_boy_submit").text("Create Delivery Boy");

                    var data = $.parseJSON(result);

                    if (data.status === "error") {
                        $("#form_error").html(data.msg);
                    }

                    if (data.status === "success") {
                        $("#form_success").html(data.msg);
                        $("#create_delivery_boy_form")[0].reset();
                    }
                }
            })

            e.preventDefault();
        })
    })
</script>

<?php require "./includes/footer.php"; ?>