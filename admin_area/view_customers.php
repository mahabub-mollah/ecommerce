<!DOCTYPE html>
<html>

<body>

<table width="790" align="center" bgcolor="#ffcc99">
<tr align="center">
	<td colspan="10"><h2>View all customers</h2></td>
</tr>
<tr>
 	<th>C-No</th>
 	<th>C-Name</th>
 	<th>C-Email</th>
 	<th>C-Passsword</th>
 	<th>C-Country</th>
 	<th>C-City</th>
 	<th>C-Contact</th>
 	<th>C-Address</th>
 	<th>C-Photo</th>
 
 	<th>Edit</th>
 	<th>Delete</th>
 </tr>
 <?php
 include("includes/db.php");
 $i=0;
 $get_customers = "SELECT * from customers";

 $run_customers = mysqli_query($con,$get_customers);
 while ($row_customers=mysqli_fetch_array( $run_customers)) {
 	$c_id =$row_customers['customer_id'];
 	$c_name = $row_customers['customer_name'];
 	$c_email= $row_customers['customer_email'];
 	$c_pass = $row_customers['customer_pass'];
 	$c_country = $row_customers['customer_country'];
 	$c_city = $row_customers['customer_city'];
 	$c_contact = $row_customers['customer_contact'];
 	$c_address = $row_customers['customer_address'];
 	$c_img = $row_customers['customer_img'];

 	$i++;
 
 ?>
 <tr align="center">
 	<td><?php echo $i;?></td>
 	<td><?php echo $c_name;?></td>
 	<td><?php echo $c_email;?></td>
 	<td><?php echo $c_pass;?></td>
 	<td><?php echo $c_country;?></td>
 	<td><?php echo $c_city;?></td>
 	<td><?php echo $c_contact;?></td>
 	<td><?php echo $c_address;?></td>
 	
 	<td><img src="../customer/customer_photos/<?php echo trim($c_img);?>" style='width: 50px; height: 50px'></td>
 	<td><a href="index.php?edit_customer=<?php echo $c_id;?>">Edit</a></td>
 	<td><a href="index.php?delete_customer=<?php echo $c_id;?>">Delete</a></td>
 </tr>
 <?php 
}
  ?>
	
</table>

</body>
</html>