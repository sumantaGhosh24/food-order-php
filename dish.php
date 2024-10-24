<?php require "./includes/header.php"; ?>

<?php
if (!isset($_SESSION["USER_ID"])) {
    header("Location: login.php");
    die();
}
?>

<?php
if (!isset($_GET["id"])) {
    echo "There is something wrong, try again later.";
    die();
}
?>

<div class="bg-white min-h-screen">
    <br><br>
    <div class="container mx-auto">
        <div class="bg-white shadow-md shadow-black p-5 rounded space-y-5">
            <h1 id="title" class="text-2xl font-bold capitalize"></h1>
            <div id="image"></div>
            <div class="flex items-center gap-3">
                <h3 id="category" class="px-3 py-1.5 bg-blue-600 text-white rounded-full uppercase text-xs"></h3>
                <h3 id="type" class="px-3 py-1.5 bg-blue-600 text-white rounded-full uppercase text-xs"></h3>
            </div>
            <div id="details" class="flex items-center justify-between gap-2"></div>
            <div class="flex items-center justify-between">
                <h3 id="createdAt"></h3>
                <h3 id="updatedAt"></h3>
            </div>
        </div>
    </div>
    <br><br>
</div>

<script>
    $(document).ready(function () {
        function fetchDish() {
            $.ajax({
                url: "http://localhost:3000/includes/dish.php?id=<?php echo $_GET['id']; ?>",
                type: "get",
                success: function (result) {
                    var dish = $.parseJSON(result);

                    $("#title").text(dish.dish);
                    $("#image").html(`<img src="./uploads/${dish.image}" alt="dish" class="h-[300px] w-full rounded" />`);
                    $("#category").html(dish.category.name);
                    $("#type").text(dish.type);
                    $("#createdAt").html(`Created At: ${dish.createdAt}`);
                    $("#updatedAt").html(`Updated At: ${dish.updatedAt}`);

                    $("#details").html("");

                    dish.details.forEach(detail => {
                        $("#details").append(`
                        <form class="add_cart_form space-y-3 bg-gray-300 p-3 rounded w-full">
                            <h3>₹${detail.price}</del></h3>
                            <div class="flex items-center gap-3">
                                <h3 class="px-3 py-1.5 bg-blue-600 text-white rounded-full uppercase text-xs">${detail.attribute}</h3>
                            </div>
                            <input type="number" name="quantity" placeholder="add dish quantity" class="w-full px-4 py-2 rounded-md border border-gray-300" required />
                            <br />
                            <input type="hidden" name="dish_id" value="${dish.id}" />
                            <input type="hidden" name="detail_id" value="${detail.id}" />
                            <input type="hidden" name="action" value="add" />
                            <button type="submit" class="w-fit bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">Add Cart</button>
                        </form>
                        `);
                    })
                }
            })
        }

        fetchDish();

        $(document).on("submit", ".add_cart_form", function (e) {
            e.preventDefault();

            let form = $(this);
            let button = form.find("button[type='submit']");

            button.attr("disabled", true).text("Processing...");

            $.ajax({
                url: "http://localhost:3000/includes/cart.php",
                type: "post",
                data: form.serialize(),
                success: function (result) {
                    button.attr("disabled", false).text("Add Cart");

                    alert("Dish added to cart");
                }
            });
        });
    })
</script>

<?php require "./includes/footer.php"; ?>