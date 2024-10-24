<?php
include "database.php";
include "function.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
        $id = get_safe_value($con, $_GET["id"]);

        $query = "SELECT * FROM delivery_boy WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $deliveryBoy = $result->fetch_assoc();

        echo json_encode($deliveryBoy);
    }

    if (isset($_GET["admin"])) {
        $query = "SELECT * FROM delivery_boy";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $delivery_boy = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $delivery_boy[] = $row;
            }
        }

        echo json_encode($delivery_boy);
    }

    if (isset($_GET["get"])) {
        $query = "SELECT * FROM delivery_boy WHERE status = '1'";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $delivery_boy = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $delivery_boy[] = $row;
            }
        }

        echo json_encode($delivery_boy);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = get_safe_value($con, $_POST["action"]);

    if ($action == "create") {
        $name = get_safe_value($con, $_POST["name"]);
        $email = get_safe_value($con, $_POST["email"]);
        $mobile = get_safe_value($con, $_POST["mobile"]);
        $password = get_safe_value($con, $_POST["password"]);
        $status = "1";

        if ($name == "") {
            $arr = array("status" => "error", "msg" => "Name is required");
        } elseif ($email == "") {
            $arr = array("status" => "error", "msg" => "Email is required");
        } elseif ($mobile == "") {
            $arr = array("status" => "error", "msg" => "Mobile number is required");
        } elseif (strlen($password) < 6) {
            $arr = array("status" => "error", "msg" => "Password length minimum 6");
        } else {
            $query = "SELECT * FROM delivery_boy WHERE email = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $arr = array('status' => 'error', 'msg' => 'Email id already registered');
            } else {
                $new_password = password_hash($password, PASSWORD_BCRYPT);

                $query = "INSERT INTO delivery_boy (name, mobile, email, password, status) VALUES (?, ?, ?, ?, ?)";
                $stmt = $con->prepare($query);
                $stmt->bind_param('ssssi', $name, $mobile, $email, $new_password, $status);

                if ($stmt->execute()) {
                    $arr = array("status" => "success", "msg" => "Registration success");
                } else {
                    $arr = array("status" => "error", "msg" => "Register failed");
                }
            }
        }

        echo json_encode($arr);
    }

    if ($action == "update") {
        $id = get_safe_value($con, $_POST["id"]);
        $name = get_safe_value($con, $_POST["name"]);
        $mobile = get_safe_value($con, $_POST["mobile"]);
        $status = get_safe_value($con, $_POST["status"]);

        if ($id == "") {
            $arr = array("status" => "error", "msg" => "Delivery boy id is required");
        } elseif ($name == "") {
            $arr = array("status" => "error", "msg" => "Name is required");
        } elseif ($mobile == "") {
            $arr = array("status" => "error", "msg" => "Mobile is required");
        } elseif ($status == "") {
            $arr = array("status" => "error", "msg" => "Status is required");
        } else {
            $query = "SELECT * FROM delivery_boy WHERE id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $query = "UPDATE delivery_boy SET name = ?, mobile = ?, status = ? WHERE id = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param('ssii', $name, $mobile, $status, $id);

                if ($stmt->execute()) {
                    $arr = array("status" => "success", "msg" => "Delivery boy updated successful");
                } else {
                    $arr = array("status" => "error", "msg" => 'Failed to update delivery boy');
                }
            } else {
                $arr = array("status" => "error", "msg" => "Delivery boy id is invalid");
            }
        }

        echo json_encode($arr);
    }

    if ($action == "delete") {
        $id = get_safe_value($con, $_POST["id"]);

        if ($id == "") {
            $arr = array("status" => "error", "msg" => "Delivery boy id is required");
        } else {
            $query = "DELETE FROM delivery_boy WHERE id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param('i', $id);

            if ($stmt->execute()) {
                $arr = array("status" => "success", "msg" => "Delivery boy deleted successful");
            } else {
                $arr = array("status" => "error", "msg" => "Unable to delete delivery boy");
            }
        }

        echo json_encode($arr);
    }
}
?>