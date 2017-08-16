<?php
include("includes/db.php");
if (!isset($_SESSION['admin_email'])) {
  echo"<script> window.open('login.php','_self')</script>";
}

else
{




?>
<form action="" method="post">
<table width="794" bgcolor="#fc9">
  <tr align="center">
  	<td><h2>Insert Brand</h2></td>
  </tr>
  <tr align="center">
  	<td ><input type="text" name="brand_title">
  	 <input type="submit" name="insert_brand" value="Insert Brand">
  	</td>
  </tr>

	
</table>
	
</form>
<?php
if (isset($_POST['insert_brand'])) {
	$brand_title = $_POST['brand_title'];



	$insert_brand = "INSERT into brands (brand_title)values('$brand_title')";
	$run_brand=mysqli_query($con,$insert_brand);

	if ($run_brand) {
		echo"<script>alert('Brand has been Inserted Successfully!')</script>";
          echo"<script>window.open('index.php?insert_brand','_self')</script>";
	}
	
}





?>
<?php }?>