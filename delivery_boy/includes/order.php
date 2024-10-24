<?php
include "database.php";
include "function.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
        $id = get_safe_value($con, $_GET["id"]);

        $query = "SELECT o.*, u.name AS user_name, u.email AS user_email, os.name AS order_status_name, db.id AS delivery_boy_id, db.name AS delivery_boy_name, db.email AS delivery_boy_email, db.mobile AS delivery_boy_mobile FROM orders o JOIN users u ON o.user_id = u.id JOIN order_status os ON o.order_status = os.id JOIN delivery_boy db ON o.delivery_boy_id = db.id WHERE o.id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $order_result = $stmt->get_result();
        $order = $order_result->fetch_assoc();

        $order_detail_query = "SELECT od.*, d.dish AS dish_title, d.type AS dish_type, d.image AS dish_image, c.name AS category_name, dd.price AS dish_price FROM order_detail od JOIN dish_details dd ON od.dish_details_id = dd.id JOIN dish d ON dd.dish_id = d.id JOIN categories c ON d.category_id = c.id WHERE od.order_id = ?";
        $stmt_details = $con->prepare($order_detail_query);
        $stmt_details->bind_param("i", $id);
        $stmt_details->execute();
        $order_details_result = $stmt_details->get_result();

        $order_details = [];
        while ($detail = $order_details_result->fetch_assoc()) {
            $order_details[] = $detail;
        }

        echo json_encode([
            'order' => $order,
            'order_details' => $order_details
        ]);
    }

    if (isset($_GET["admin"])) {
        $id = $_SESSION["DB_ID"];

        $query = "SELECT orders.*, order_status.name as order_status_str FROM orders JOIN order_status ON order_status.id = orders.order_status WHERE orders.delivery_boy_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $orders = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }

        echo json_encode($orders);
    }

    if (isset($_GET["status"])) {
        $query = "SELECT * FROM order_status";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $order_status = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $order_status[] = $row;
            }
        }

        echo json_encode($order_status);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = get_safe_value($con, $_POST["action"]);

    if ($action == "update") {
        $id = get_safe_value($con, $_POST["id"]);
        $status = get_safe_value($con, $_POST["status"]);

        if ($status == "") {
            $arr = array("status" => "error", "msg" => "Order status is required");
        } else {
            $query = "SELECT * FROM orders WHERE id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $query = "UPDATE orders SET order_status = ? WHERE id = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param('si', $status, $id);

                if ($stmt->execute()) {
                    $arr = array("status" => "success", "msg" => "Order updated successful");
                } else {
                    $arr = array("status" => "error", "msg" => 'Failed to update order');
                }
            } else {
                $arr = array("status" => "error", "msg" => "Order id is invalid");
            }
        }

        echo json_encode($arr);
    }
}
?>