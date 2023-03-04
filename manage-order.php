<?php include('partials/menu.php'); ?>

<!-- start manage order -->
<section class="max-2-4xl mx-auto mt-5">
    <?php
        if(isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
    ?>
</section>
<div class="max-w-6xl mx-auto my-5">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold capitalize mb-5">Manage Order</h1>
        <a href="add-order.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Create Order</a>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-white border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">No.</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Customer Name</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Order Date</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Sub Total</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">GST</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Discount</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Net Total</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Paid</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Due</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Payment Type</th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Invoice</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM invoice ORDER BY id DESC";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            $sn = 1;
                            if($count > 0) {
                                while($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $customer_name = $row['customer_name'];
                                    $order_date = $row['order_date'];
                                    $sub_total = $row['sub_total'];
                                    $gst = $row['gst'];
                                    $discount = $row['discount'];
                                    $net_total = $row['net_total'];
                                    $paid = $row['paid'];
                                    $due = $row['due'];
                                    $payment_type = $row['payment_type'];
                                    ?>
                                    <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $sn++; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $customer_name; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $order_date; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $sub_total; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $gst; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $discount; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $net_total; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $paid; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $due; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $payment_type; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <a href="http://localhost/food-order-php/PDF_INVOICE/PDF_INVOICE_<?php echo $id; ?>.pdf" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded block max-w-fit" title="delete food">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else { ?>
                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 flex justify-around">no category find.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end manage order -->

<?php include('partials/footer.php'); ?>