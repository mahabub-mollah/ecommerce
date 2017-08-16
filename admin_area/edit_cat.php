<?php
include("includes/db.php");

?>
<?php
if (isset($_GET['edit_cat'])) {
	$cat_id = $_GET['edit_cat'];



	$edit_cat = "SELECT * from categories where cat_id='$cat_id'";
	$run_edit=mysqli_query($con,$edit_cat);
	$row_edit = mysqli_fetch_array($run_edit);
	$cat_edit_id = $row_edit['cat_id'];
	$cat_title = $row_edit['cat_title'];

	
	
}





?>
<form action="" method="post">
<table width="794" bgcolor="#fc9">
  <tr align="center">
  	<td><h2>Edit Cateagory</h2></td>
  </tr>
  <tr align="center">
  	<td ><input type="text" name="cat_title" value="<?php echo $cat_title;?>">
  	 <input type="submit" name="update_cat" value="Update Catagorey">
  	</td>
  </tr>

	
</table>
	
</form>
<?php
 if (isset($_POST['update_cat'])) {


	$cat_title1 = $_POST['cat_title'];
	$update_cat ="UPDATE categories set cat_title='$cat_title1' where cat_id='$cat_edit_id'";
	$run_update =mysqli_query($con,$update_cat);

	if ($run_update) {

		echo"<script>alert('category has been updated successfully!')</script>";
          echo"<script>window.open('index.php?view_cats','_self')</script>";
		
	}
}


?>
