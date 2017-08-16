<!DOCTYPE html>
<html>

<body>

<table width="790" align="center" bgcolor="blue">
<tr align="center">
	<td colspan="10"><h2>View all Payments</h2></td>
</tr>
<tr>
 	<th>payment-No</th>
 	<th>Invoice No</th>
 	<th>AmountPaid</th>
 	<th>payment Method</th>
 	<th>Ref No</th>
 	<th>Code</th>
    <th>Payment Date</th>
 </tr>
 <?php
 include("includes/db.php");
 $i=0;
 $get_payments = "SELECT * from payments";

 $run_payments = mysqli_query($con,$get_payments);
 while ($row_payments=mysqli_fetch_array( $run_payments)) {
 	$payment_id =$row_payments['payment_id'];
 	$payment_invoice =$row_payments['invoice_no'];
    $payment_amount=$row_payments['amount'];
 	$payment_mood=$row_payments['payment_mode'];
 	$ref_no =$row_payments['ref_no'];
 	$code =$row_payments['code'];
 	$date=$row_payments['payment_date'];

 	$i++;
 
 ?>
 <tr align="center">
 	<td><?php echo $i;?></td>
 	<td bgcolor=""><?php echo $payment_invoice;?></td>
 	<td><?php echo $payment_amount;?></td>
 	<td><?php echo $payment_mood;?></td>
 	<td><?php echo $ref_no;?></td>
 	<td><?php echo $code;?></td>
 	<td><?php echo $date;?></td>
 	</tr>
 <?php 
}
  ?>
	
</table>

</body>
</html>