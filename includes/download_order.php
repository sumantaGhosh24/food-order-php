<?php
include "database.php";
include "function.php";
require "../vendor/autoload.php";

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

        $data = '';

        while ($detail = $order_details_result->fetch_assoc()) {
            $data .= '
                <tr>
                    <td class="py-3 px-6 text-left">' . $detail["id"] . '</td>
                    <td class="py-3 px-6 text-left">' . $detail["dish_title"] . '</td>
                    <td class="py-3 px-6 text-left">' . $detail["dish_type"] . '</td>
                    <td class="py-3 px-6 text-left">
                        <img src="../uploads/' . $detail["dish_image"] . '" alt="product" class="w-12 h-12 rounded-full" />
                    </td>
                    <td class="py-3 px-6 text-left">' . $detail["category_name"] . '</td>
                    <td class="py-3 px-6 text-left">' . $detail["price"] . '</td>
                    <td class="py-3 px-6 text-left">' . $detail["price"] / $detail["qty"] . '</td>
                    <td class="py-3 px-6 text-left">' . $detail["qty"] . '</td>
                </tr>
            ';
        }

        $html = '
        <!DOCTYPE html>
            <html lang="en" class="scroll-smooth">
            <head>
                <style>
                    *, *::before, *::after {margin: 0; padding: 0; box-sizing: border-box;}
                    .flex {display: flex;} 
                    .justify-center {justify-content: center;}
                    .items-center {align-items: center;}
                    .bg-white {background-color: #ffffff;}
                    .my-20 {margin-top: 5rem;margin-bottom: 5rem;}
                    .rounded-lg {border-radius: 0.5rem;}
                    .shadow-md {box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);}
                    .p-8 {padding: 2rem;}
                    .shadow-black {box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);}
                    .overflow-y-scroll {overflow-y: scroll;}
                    .text-2xl {font-size: 1.5rem;}
                    .font-bold {font-weight: bold;}
                    .mb-4 {margin-bottom: 1rem;}
                    .min-w-full {min-width: 100%;}
                    .bg-gray-200 {background-color: #e5e7eb;}
                    .text-gray-600 {color: #4b5563;}
                    .text-sm {font-size: 0.875rem;}
                    .leading-normal {line-height: 1.5;}
                    .py-3 {padding-top: 0.37rem;padding-bottom: 0.37rem;}
                    .px-6 {padding-left: 0.75rem;padding-right: 0.75rem;}
                    .text-left {text-align: left;}
                    .uppercase {text-transform: uppercase;}
                    .w-12 {width: 3rem;}
                    .h-12 {height: 3rem;}
                    .rounded-full {border-radius: 9999px;}
                    .mt-5 {margin-top: 1.25rem;}
                </style>
            </head>
            <body class="bg-white">
                <div>
                    <h2 class="text-2xl font-bold mb-4">Order Details</h2>
                    <table class="min-w-full bg-white rounded-lg shadow-md mx-auto mt-5">
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">ID</th>
                            <td class="py-3 px-6 text-left">' . $order["id"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">User Name</th>
                            <td class="py-3 px-6 text-left">' . $order["user_name"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">User Email</th>
                            <td class="py-3 px-6 text-left">' . $order["user_email"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Address</th>
                            <td class="py-3 px-6 text-left">' . $order["address"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">City</th>
                            <td class="py-3 px-6 text-left">' . $order["city"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Pincode</th>
                            <td class="py-3 px-6 text-left">' . $order["pincode"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Total Price</th>
                            <td class="py-3 px-6 text-left">' . $order["total_price"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Net Price</th>
                            <td class="py-3 px-6 text-left">' . $order["net_price"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Order Status</th>
                            <td class="py-3 px-6 text-left">' . $order["order_status_name"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Coupon Value</th>
                            <td class="py-3 px-6 text-left">' . $order["coupon_value"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Coupon Code</th>
                            <td class="py-3 px-6 text-left">' . $order["coupon_code"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Payment</th>
                            <td class="py-3 px-6 text-left">' . $order["paymentResultId"] . ' | ' . $order["paymentResultStatus"] . ' | ' . $order["paymentResultOrderId"] . ' | ' . $order["paymentResultPaymentId"] . ' | ' . $order["paymentResultRazorpaySignature"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Created At</th>
                            <td class="py-3 px-6 text-left">' . $order["createdAt"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Updated At</th>
                            <td class="py-3 px-6 text-left">' . $order["updatedAt"] . '</td>
                        </tr>
                    </table>
                    <table class="min-w-full bg-white rounded-lg shadow-md mx-auto mt-5">
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Delivery Boy Id</th>
                            <td class="py-3 px-6 text-left">' . $order["delivery_boy_id"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Delivery Boy Name</th>
                            <td class="py-3 px-6 text-left">' . $order["delivery_boy_name"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Delivery Boy Email</th>
                            <td class="py-3 px-6 text-left">' . $order["delivery_boy_email"] . '</td>
                        </tr>
                        <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Delivery Boy Mobile</th>
                            <td class="py-3 px-6 text-left">' . $order["delivery_boy_mobile"] . '</td>
                        </tr>
                    </table>
                    <table class="min-w-full bg-white rounded-lg shadow-md mx-auto mt-5">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">ID</th>
                                <th class="py-3 px-6 text-left">Title</th>
                                <th class="py-3 px-6 text-left">Type</th>
                                <th class="py-3 px-6 text-left">Image</th>
                                <th class="py-3 px-6 text-left">Category</th>
                                <th class="py-3 px-6 text-left">Price</th>
                                <th class="py-3 px-6 text-left">Total Price</th>
                                <th class="py-3 px-6 text-left">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>' . $data . '</tbody>
                    </table>
                </div>
            </body>
        </html>
        ';

        try {
            $mpdf = new \Mpdf\Mpdf();

            $mpdf->WriteHTML($html);
            $mpdf->Output();

            exit();
        } catch (Exception $e) {
            echo "Error generating PDF: " . htmlspecialchars($e->getMessage());
            exit();
        }
    }
}
?>