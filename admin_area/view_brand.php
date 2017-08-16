<?php
  
  
  include("includes/db.php");

if (!isset($_SESSION['admin_email'])) {
  echo"<script> window.open('login.php','_self')</script>";
}

else
{
?>


<!DOCTYPE html>
<html>

<body>
<table width="794" align="center" bgcolor="#ffcccc">
 <tr align="center">
  	<td colspan="4"><h2>View All Brands</h2></td>
  </tr>
<tr>
	<th>BrandId</th>
	<th>Brand Title</th>
	<th>Edit</th>
	<th>Delete</th>
</tr>
		<?php

		$get_brand ="SELECT * from brands";

		$run_brand =mysqli_query($con,$get_brand);
	    while ($row_brand=mysqli_fetch_array($run_brand)) 
							{

			?>
	<tr align="center">
		<td><?php echo $row_brand['brand_id']?></td>
		<td><?php echo $row_brand['brand_title']?></td>
		<td><a href="index.php?edit_brand=<?php echo $row_brand['brand_id']?>">Edit</a></td>
		<td><a href="index.php?delete_brand=<?php echo $row_brand['brand_id']?>">Delete</a></td>
	</tr>
<?php
}



?>

	
</table>

</body>
</html>
<?php }?>