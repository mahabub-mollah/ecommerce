<!DOCTYPE html>
<html>

<body>
<table width="794" align="center" bgcolor="#ffcccc">
 <tr align="center">
  	<td colspan="4"><h2>View All Cateagory</h2></td>
  </tr>
<tr>
	<th>Category Id</th>
	<th>Category Title</th>
	<th>Edit</th>
	<th>Delete</th>
</tr>
<?php

include("includes/db.php");
 $get_cats ="SELECT * from categories";

$run_cats =mysqli_query($con,$get_cats);
while ($row_cats=mysqli_fetch_array($run_cats)) 
{

	?>
	<tr align="center">
		<td><?php echo $row_cats['cat_id']?></td>
		<td><?php echo $row_cats['cat_title']?></td>
		<td><a href="index.php?edit_cat=<?php echo $row_cats['cat_id']?>">Edit</a></td>
		<td><a href="index.php?delete_cat=<?php echo $row_cats['cat_id']?>">Delete</a></td>
	</tr>
<?php
}



?>
	
</table>

</body>
</html>