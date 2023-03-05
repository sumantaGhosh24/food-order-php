<?php

require './config/constants.php';

if (isset($_POST["getNewOrderItem"])) {
	$sql = "SELECT * FROM food";
	$res = mysqli_query($conn, $sql);
	if($res==TRUE) {
		$count = mysqli_num_rows($res);
		$sn = 1;
		if($count > 0) {
			?>
			<tr>
				<td><b class="number text-white">1</b></td>
				<td>
					<select name="id[]" class="block w-[200px] px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring id" required>
						<option value="">Choose Food</option>
						<?php
							while($row = mysqli_fetch_assoc($res)) {
								?>
								<option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
								<?php
							}
						?>
					</select>
				</td>  
				<td><input name="qty[]" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring qty" required></td>
				<td><input name="price[]" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring price" readonly></span>
				<span><input name="pro_name[]" type="hidden" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring pro_name"></td>
				<td class="text-white">Rs.<span class="amt">0</span></td>
			</tr>
			<?php
		} else {
			echo 'no data found';
		}
	}
	exit();
}

if (isset($_POST["getPriceAndQty"])) {
	$id = $_POST['id'];
	$sql = "SELECT * FROM food WHERE id=$id";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($res);
	echo json_encode($row);
	exit();
}



if (isset($_POST["order_date"]) AND isset($_POST["cust_name"])) {
	$orderdate = $_POST["order_date"];
	$cust_name = $_POST["cust_name"];
	
	
	$ar_qty = $_POST["qty"];
	$ar_price = $_POST["price"];
	$ar_pro_name = $_POST["pro_name"];
	
	
	$sub_total = $_POST["sub_total"];
	$gst = $_POST["gst"];
	$discount = $_POST["discount"];
	$net_total = $_POST["net_total"];
	$paid = $_POST["paid"];
	$due = $_POST["due"];
	$payment_type = $_POST["payment_type"];

	$sql = "INSERT INTO invoice SET customer_name='$cust_name', order_date='$orderdate', sub_total=$sub_total, gst=$gst, discount=$discount, net_total=$net_total, paid=$paid, due=$due, payment_type='$payment_type'";

	$res = mysqli_query($conn, $sql);
	$last_id = mysqli_insert_id($conn);

	if($res==true) {
		$i = 0;		
		while($i < count($ar_price)) {
			mysqli_query($conn, "INSERT INTO invoice_details SET invoice_no=$last_id, product_name='$ar_pro_name[$i]', price=$ar_price[$i], qty=$ar_qty[$i]");
			$i++;
		}
	}
	echo $last_id;
}
?>