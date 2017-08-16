<?php
include("includes/db.php");





?>

<?php
if (isset($_GET['edit_brand'])) {

	$brand_id = $_GET['edit_brand'];



	$edit_brand = "SELECT * from  brands where brand_id='$brand_id '";
	$run_edit= mysqli_query($con,$edit_brand);
	$row_edit= mysqli_fetch_array($run_edit);
	$get_edit_id = $row_edit['brand_id'];
	$brand_title1 =$row_edit['brand_title'];

	
	
}
?>
<form action="" method="post">
<table width="794" bgcolor="#fc9">
  <tr align="center">
  	<td><h2>Insert Cateagory</h2></td>
  </tr>
  <tr align="center">
  	<td ><input type="text" name="brand_title" value="<?php echo $brand_title1;?>">
  	 <input type="submit" name="update_brand" value="Update Brand">
  	</td>
  </tr>

	
</table>
	
</form>
<?php
 if (isset($_POST['update_brand'])) {


	$brand_title12 = $_POST['brand_title'];
	$update_brand ="UPDATE brands set brand_title='$brand_title12' where brand_id='$get_edit_id'";
	$run_update =mysqli_query($con,$update_brand);

	if ($run_update) {

		echo"<script>alert('One Brand has been updated successfully!')</script>";
          echo"<script>window.open('index.php?view_brands','_self')</script>";
		
	}
}


?>

