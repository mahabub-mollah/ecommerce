<?php
include("includes/db.php");





?>
<form action="" method="post">
<table width="794" bgcolor="#fc9">
  <tr align="center">
  	<td><h2>Insert Cateagory</h2></td>
  </tr>
  <tr align="center">
  	<td ><input type="text" name="cat_title">
  	 <input type="submit" name="insert_cat" value="Insert Catagorey">
  	</td>
  </tr>

	
</table>
	
</form>
<?php
if (isset($_POST['insert_cat'])) {
	$cat_title = $_POST['cat_title'];



	$insert_cat = "INSERT into categories (cat_title)values('$cat_title')";
	$run_cat=mysqli_query($con,$insert_cat);

	if ($run_cat) {
		echo"<script>alert('Cateagory Inserted Successfully!')</script>";
          echo"<script>window.open('index.php?insert_cat','_self')</script>";
	}
	
}





?>