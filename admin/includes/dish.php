<?php
include "database.php";
include "function.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
        $id = get_safe_value($con, $_GET["id"]);

        $query = "SELECT d.id, d.category_id, d.dish, d.image, d.type, d.createdAt, d.updatedAt, c.id as category_id, c.name as category_name FROM dish d JOIN categories c ON d.category_id = c.id WHERE d.id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $dish = $result->fetch_assoc();

        $query = "SELECT * FROM dish_details WHERE dish_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $dishDetails = $result->fetch_all(MYSQLI_ASSOC);

        $category = [
            "id" => $dish["category_id"],
            "name" => $dish["category_name"]
        ];

        $finalResult = [
            "id" => $dish["id"],
            "dish" => $dish["dish"],
            "image" => $dish["image"],
            "type" => $dish["type"],
            "createdAt" => $dish["createdAt"],
            "updatedAt" => $dish["updatedAt"],
            "category" => $category,
            "details" => $dishDetails,
        ];

        echo json_encode($finalResult);
    }

    if (isset($_GET["admin"])) {
        $query = "SELECT d.*, c.name FROM dish d JOIN categories c ON d.category_id = c.id";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $dishes = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $dishes[] = $row;
            }
        }

        echo json_encode($dishes);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = get_safe_value($con, $_POST["action"]);

    if ($action == "create") {
        $category_id = get_safe_value($con, $_POST["category_id"]);
        $dish = get_safe_value($con, $_POST["dish"]);
        $type = get_safe_value($con, $_POST["type"]);

        if ($category_id == "") {
            $arr = array("status" => "error", "msg" => "Dish category id is required");
        } elseif ($dish == "") {
            $arr = array("status" => "error", "msg" => "Dish title is required");
        } elseif ($type == "") {
            $arr = array("status" => "error", "msg" => "Dish type is required");
        } else {
            $targetDir = "../../uploads/";
            $fileType = pathinfo(basename($_FILES["file"]["name"]), PATHINFO_EXTENSION);
            $fileName = uniqid() . "." . $fileType;
            $targetFilePath = $targetDir . $fileName;

            if (!empty($_FILES["file"]["name"])) {
                $allowTypes = array("jpg", "png", "jpeg");
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                        $query = "INSERT INTO dish (category_id, dish, image, type) VALUES (?, ?, ?, ?)";
                        $stmt = $con->prepare($query);
                        $stmt->bind_param('isss', $category_id, $dish, $fileName, $type);
                        if ($stmt->execute()) {
                            $arr = array("status" => "success", "msg" => "Dish created successful");
                        } else {
                            $arr = array("status" => "error", "msg" => "Failed to create dish");
                        }
                    } else {
                        $arr = array("status" => "error", "msg" => "There is something wrong, when upload your image");
                    }
                } else {
                    $arr = array("status" => "error", "msg" => "Select a valid image type(jpg, jpeg and png required)");
                }
            } else {
                $arr = array("status" => "error", "msg" => "Select a image first");
            }
        }

        echo json_encode($arr);
    }

    if ($action == "update") {
        $id = get_safe_value($con, $_POST["id"]);
        $category_id = get_safe_value($con, $_POST["category_id"]);
        $dish = get_safe_value($con, $_POST["dish"]);
        $type = get_safe_value($con, $_POST["type"]);

        if ($id == "") {
            $arr = array("status" => "error", "msg" => "Dish id is required");
        } elseif ($category_id == "") {
            $arr = array("status" => "error", "msg" => "Dish category id is required");
        } elseif ($dish == "") {
            $arr = array("status" => "error", "msg" => "Dish title is required");
        } elseif ($type == "") {
            $arr = array("status" => "error", "msg" => "Dish type is required");
        } else {
            $query = "SELECT * FROM dish WHERE id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $query = "UPDATE dish SET category_id = ?, dish = ?, type = ? WHERE id = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param('issi', $category_id, $dish, $type, $id);

                if ($stmt->execute()) {
                    $arr = array("status" => "success", "msg" => "Dish updated successful");
                } else {
                    $arr = array("status" => "error", "msg" => 'Failed to update dish');
                }
            } else {
                $arr = array("status" => "error", "msg" => "Dish id is invalid");
            }
        }

        echo json_encode($arr);
    }

    if ($action == "add-detail") {
        $id = get_safe_value($con, $_POST["id"]);
        $attribute = get_safe_value($con, $_POST["attribute"]);
        $price = get_safe_value($con, $_POST["price"]);

        if ($id == "") {
            $arr = array("status" => "error", "msg" => "Dish id is required");
        } elseif ($attribute == "") {
            $arr = array("status" => "error", "msg" => "Attribute is required");
        } elseif ($price == "") {
            $arr = array("status" => "error", "msg" => "Dish price is required");
        } else {
            $query = "SELECT * FROM dish WHERE id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $query = "INSERT INTO dish_details (dish_id, attribute, price) VALUES(?, ?, ?)";
                $stmt = $con->prepare($query);
                $stmt->bind_param('isi', $id, $attribute, $price);

                if ($stmt->execute()) {
                    $arr = array("status" => "success", "msg" => "Dish Attribute successful");
                } else {
                    $arr = array("status" => "error", "msg" => "Failed to add dish attribute");
                }
            } else {
                $arr = array("status" => "error", "msg" => "Dish id is invalid");
            }
        }

        echo json_encode($arr);
    }

    if ($action == "remove-detail") {
        $id = get_safe_value($con, $_POST["id"]);

        if ($id == "") {
            $arr = array("status" => "error", "msg" => "Attribute id is required");
        } else {
            $query = "SELECT * FROM dish_details WHERE id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $check = $result->num_rows;

            if ($check > 0) {
                $query = "DELETE FROM dish_details WHERE id = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param('i', $id);

                if ($stmt->execute()) {
                    $arr = array("status" => "success", "msg" => "Dish attribute removed");
                } else {
                    $arr = array("status" => "error", "msg" => "Failed to remove dish attribute");
                }
            } else {
                $arr = array("status" => "error", "msg" => "Detail id is invalid");
            }
        }

        echo json_encode($arr);
    }

    if ($action == "delete") {
        $id = get_safe_value($con, $_POST["id"]);

        if ($id == "") {
            $arr = array("status" => "error", "msg" => "Dish id is required");
        } else {
            $query = "SELECT * FROM dish WHERE id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $query = "DELETE FROM dish_details WHERE dish_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param('i', $id);

            if ($stmt->execute()) {
                $query = "DELETE FROM dish WHERE id = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param('i', $id);

                if ($stmt->execute()) {
                    $imagePath = "../../uploads/" . $row["image"];
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }

                    $arr = array("status" => "success", "msg" => "Dish deleted successful");
                } else {
                    $arr = array("status" => "error", "msg" => "Unable to delete dish");
                }
            } else {
                $arr = array("status" => "error", "msg" => "Unable to delete dish");
            }
        }

        echo json_encode($arr);
    }
}
?>