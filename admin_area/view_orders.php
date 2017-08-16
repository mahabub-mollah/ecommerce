<!DOCTYPE html>
<html>

<body>

<table width="790" align="center" bgcolor="#ffcc99">
<tr align="center">
	<td colspan="10"><h2>View all Orders</h2></td>
</tr>
<tr>
 	<th>order-No</th>
 	<th>Customer</th>
 	<th>InvoiceNo</th>
 	<th>Product ID</th>
 	<th>Quantity</th>
 	<th>Status</th>
    <th>Delete</th>
 </tr>
 <?php
 include("includes/db.php");
 $i=0;
 $get_orders = "SELECT * from pending_orders";

 $run_orders = mysqli_query($con,$get_orders);
 while ($row_orders=mysqli_fetch_array( $run_orders)) {
 	$order_id =$row_orders['order_id'];
 	$c_id =$row_orders['customer_id'];
    $order_invoice =$row_orders['invoice_no'];
 	$p_id =$row_orders['product_id'];
 	$qty =$row_orders['qty'];
 	$status =$row_orders['order_status'];
 	

 	$i++;
 
 ?>
 <tr align="center">
 	<td><?php echo $i;?></td>
 	<td>
 	<?php
 	$get_customer ="SELECT * FROM customers where customer_id='$c_id'";

 	$run_customer = mysqli_query($con,$get_customer);

 	$row_customer =mysqli_fetch_array($run_customer );
 	$customer_email =$row_customer['customer_email'];
 	echo $customer_email;




 	?>
 		



 	</td>
 	<td><?php echo $order_invoice;?></td>
 	<td><?php echo $p_id;?></td>
 	<td><?php echo $qty;?></td>
 	<td><?php echo $status;?></td>
 	
 	
 	
 	
 	<td><a href="delete_order.php?delete_order=<?php echo $order_id;?>">Delete</a></td>
 </tr>
 <?php 
}
  ?>
	
</table>

</body>
</html>