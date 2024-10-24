<?php
include "database.php";
include "function.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $finalResult = [];

    if (isset($_SESSION["cart"])) {
        foreach ($_SESSION["cart"] as $key => $val) {
            foreach ($val as $valKey => $valValue) {
                $query = "SELECT dd.id, dd.dish_id, dd.attribute, dd.price, d.id AS dish_id, d.dish AS dish_title, d.image AS dish_image, d.type AS dish_type FROM dish_details dd JOIN dish d ON dd.dish_id = d.id WHERE dd.id = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param('i', $valKey);
                $stmt->execute();
                $result = $stmt->get_result();
                $dish = $result->fetch_assoc();

                $attribute = [
                    "id" => $dish["id"],
                    "dish_id" => $dish["dish_id"],
                    "attribute" => $dish["attribute"],
                    "price" => $dish["price"]
                ];

                $dish = [
                    "id" => $dish["dish_id"],
                    "title" => $dish["dish_title"],
                    "image" => $dish["dish_image"],
                    "type" => $dish["dish_type"]
                ];

                $finalResult[] = [
                    "dish" => $dish,
                    "attribute" => $attribute,
                    "qty" => $valValue["qty"]
                ];
            }
        }
    }

    echo json_encode($finalResult);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = get_safe_value($con, $_POST["action"]);

    if ($action == "add") {
        $dish_id = get_safe_value($con, $_POST["dish_id"]);
        $detail_id = get_safe_value($con, $_POST["detail_id"]);
        $quantity = get_safe_value($con, $_POST["quantity"]);

        $_SESSION["cart"][$dish_id][$detail_id]["qty"] = $quantity;
    }

    if ($action == "update") {
        $dish_id = get_safe_value($con, $_POST["dish_id"]);
        $detail_id = get_safe_value($con, $_POST["detail_id"]);
        $quantity = get_safe_value($con, $_POST["quantity"]);

        if (isset($_SESSION["cart"][$dish_id][$detail_id])) {
            $_SESSION["cart"][$dish_id][$detail_id]["qty"] = $quantity;
        }
    }

    if ($action == "remove") {
        $dish_id = get_safe_value($con, $_POST["dish_id"]);
        $detail_id = get_safe_value($con, $_POST["detail_id"]);

        if (isset($_SESSION["cart"][$dish_id][$detail_id])) {
            unset($_SESSION["cart"][$dish_id][$detail_id]);
        }
    }

    if ($action == "clear") {
        unset($_SESSION["cart"]);
    }
}
?>