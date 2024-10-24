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

    if (isset($_GET["all"])) {
        $cat_id = get_safe_value($con, $_GET["cat_id"]);
        $search_str = get_safe_value($con, $_GET["search_str"]);
        $type = get_safe_value($con, $_GET["type"]);
        $page = isset($_GET['page']) ? get_safe_value($con, $_GET['page']) : 1;
        $limit = isset($_GET['limit']) ? get_safe_value($con, $_GET['limit']) : 10;
        $offset = ($page - 1) * $limit;

        $query1 = "SELECT COUNT(*) AS total FROM dish WHERE dish.status = 1";
        $query2 = "SELECT dish.*, categories.name AS category_name, (SELECT dd.price FROM dish_details dd WHERE dd.dish_id = dish.id LIMIT 1) AS dish_price FROM dish JOIN categories ON dish.category_id = categories.id WHERE dish.status = 1";

        if ($cat_id != '') {
            $query1 .= " AND dish.category_id = $cat_id ";
            $query2 .= " AND dish.category_id = $cat_id ";
        }
        if ($type != '') {
            $query1 .= " AND dish.type LIKE '%$type%' ";
            $query2 .= " AND dish.type LIKE '%$type%' ";
        }
        if ($search_str != '') {
            $query1 .= " AND dish.dish LIKE '%$search_str%' ";
            $query2 .= " AND dish.dish LIKE '%$search_str%' ";
        }

        $query2 .= " ORDER BY dish.id DESC LIMIT $limit OFFSET $offset";

        $stmt = $con->prepare($query1);
        $stmt->execute();
        $result = $stmt->get_result();
        $totalRows = $result->fetch_assoc()['total'];
        $totalPages = ceil($totalRows / $limit);

        $stmt = $con->prepare($query2);
        $stmt->execute();
        $result = $stmt->get_result();
        $dishes = $result->fetch_all(MYSQLI_ASSOC);

        $finalResult = [];
        foreach ($dishes as $dish) {
            $category = [
                "name" => $dish["category_name"]
            ];

            $finalResult[] = [
                "id" => $dish["id"],
                "dish" => $dish["dish"],
                "image" => $dish["image"],
                "type" => $dish["type"],
                "price" => $dish["dish_price"],
                "createdAt" => $dish["createdAt"],
                "updatedAt" => $dish["updatedAt"],
                "category" => $category
            ];
        }

        echo json_encode(['dish' => $finalResult, 'totalPages' => $totalPages]);
    }
}
?>