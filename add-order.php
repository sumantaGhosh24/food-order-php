<?php include('partials/menu.php'); ?>

<!-- start add order form -->
<section class="max-w-4xl p-6 mx-auto bg-blue-600 rounded-md shadow-md my-20">
    <h1 class="text-xl font-bold text-white capitalize">Add Order</h1>
    <?php
        if(isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
    ?>
    <form action="" method="POST" id="get_order_data" onsubmit="return false">
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
            <div>
                <label class="text-white" for="order_date">Order Date</label>
                <input id="order_date" type="text" name="order_date" placeholder="Enter order date" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" readonly value="<?php echo date("Y-d-m"); ?>" />
            </div>
            <div>
                <label class="text-white" for="cust_name">Customer Name</label>
                <input id="cust_name" type="text" name="cust_name" placeholder="Enter customer name" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" required />
            </div>
            <div>
                <label class="text-white">Make order list</label><br>
                <table class="w-[750px]">
                    <thead>
                        <tr class="text-white">
                            <th>#</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="invoice_item">
					</tbody>
					<button id="add" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-700 rounded mt-5 mr-5" type="button">Add</button>
					<button id="remove" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded mb-5" type="button">Remove</button>
                </table>
            </div>
            <div>
                <label class="text-white" for="sub_total">Sub Total</label>
                <input id="sub_total" type="text" name="sub_total" placeholder="sub total" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" readonly />
            </div>
            <div>
                <label class="text-white" for="gst">GST (18%)</label>
                <input id="gst" type="text" name="gst" placeholder="Enter gst" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" readonly />
            </div>
            <div>
                <label class="text-white" for="discount">Discount</label>
                <input id="discount" type="text" name="discount" placeholder="Enter order discount" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" required />
            </div>
            <div>
                <label class="text-white" for="net_total">Net Total</label>
                <input id="net_total" type="text" name="net_total" placeholder="order net total" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" readonly />
            </div>
			<div>
				<label for="paid" class="text-white">Paid</label>
				<input type="text" name="paid" id="paid" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" required />
			</div>
			<div>
				<label for="due" class="text-white">Due</label>
				<input type="text" name="due" id="due" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" readonly />
			</div>
			<div>
            	<label class="text-white" for="payment_type">Payment Method</label>
            	<select class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" name="payment_type" id="payment_type" required >
					<option>Cash</option>
					<option>Card</option>
					<option>Draft</option>
					<option>Cheque</option>
				</select>
          	</div>
        </div>
		<input type="submit" id="order_form" value="Order" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded mt-5">
    </form>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>	
	$(document).ready(function(){
		var DOMAIN = "http://localhost/food-order-php/admin";
	
		addNewRow();
	
		$("#add").click(function(){
			addNewRow();
		})
	
		function addNewRow(){
			$.ajax({
				url : DOMAIN+"/order.php",
				method : "POST",
				data : {getNewOrderItem:1},
				success : function(data){
					$("#invoice_item").append(data);
					var n = 0;
					$(".number").each(function(){
						$(this).html(++n);
					})
				}
			})
		}
	
		$("#remove").click(function(){
			$("#invoice_item").children("tr:last").remove();
			calculate(0,0);
		})
	
		$("#invoice_item").delegate(".id","change",function(){
			var pid = $(this).val();
			var tr = $(this).parent().parent();
			$(".overlay").show();
			$.ajax({
				url : DOMAIN+"/order.php",
				method : "POST",
				dataType : "json",
				data : {getPriceAndQty:1,id:pid},
				success : function(data){
					tr.find(".pro_name").val(data["title"]);
					tr.find(".qty").val(1);
					tr.find(".price").val(data["price"]);
					tr.find(".amt").html( tr.find(".qty").val() * tr.find(".price").val() );
					calculate(0,0);
				}
			})
		})
	
		$("#invoice_item").delegate(".qty","keyup",function(){
			var qty = $(this);
			var tr = $(this).parent().parent();
			if (isNaN(qty.val())) {
				alert("Please enter a valid quantity");
				qty.val(1);
			}else{
				if ((qty.val() - 0) > (tr.find(".tqty").val()-0)) {
					alert("Sorry ! This much of quantity is not available");
					aty.val(1);
				}else{
					tr.find(".amt").html(qty.val() * tr.find(".price").val());
					calculate(0,0);
				}
			}
	
		})
	
		function calculate(dis,paid){
			var sub_total = 0;
			var gst = 0;
			var net_total = 0;
			var discount = dis;
			var paid_amt = paid;
			var due = 0;
			$(".amt").each(function(){
				sub_total = sub_total + ($(this).html() * 1);
			})
			gst = 0.18 * sub_total;
			net_total = gst + sub_total;
			net_total = net_total - discount;
			due = net_total - paid_amt;
			$("#gst").val(gst);
			$("#sub_total").val(sub_total);
			
			$("#discount").val(discount);
			$("#net_total").val(net_total);
			//$("#paid")
			$("#due").val(due);
	
		}
	
		$("#discount").keyup(function(){
			var discount = $(this).val();
			calculate(discount,0);
		})
	
		$("#paid").keyup(function(){
			var paid = $(this).val();
			var discount = $("#discount").val();
			calculate(discount,paid);
		})
		
		$("#order_form").click(function(){	
			var invoice = $("#get_order_data").serialize();
			console.log('invoice', invoice)
			if ($("#cust_name").val() === "") {
				alert("Plaese enter customer name");
			}else if($("#paid").val() === ""){
				alert("Plaese eneter paid amount");
			}else{
				$.ajax({
					url : DOMAIN+"/order.php",
					method : "POST",
					data : $("#get_order_data").serialize(),
					success : function(data){
						if (data < 0) {
							alert(data);
						}else{
							$("#get_order_data").trigger("reset");	
							if (confirm("Do u want to print invoice ?")) {
								window.location.href = "http://localhost/food-order-php/invoice_bill.php?invoice_no="+data+"&"+invoice;
							}
						}	
					}
				});
			}	
		});	
	});
	
</script>


<?php include('partials/footer.php'); ?>