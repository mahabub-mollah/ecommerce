<!DOCTYPE html>
<html>

<body>
<form action="" method="post">
<table align="center" width="600">
	<tr align="center">
		<td colspan="2"><h2>Do Yoy really want to Delete Your Account</h2></td>
	</tr>
	<tr align="center">
		<td ><input type="submit" name="yes" value=" Yes,I Want..">
		<input type="submit" name="no" value="No,I dont Want..">
		</td>
		
	</tr>
</table>
	
</form>

</body>
</html>



<?php
 include("includes/db.php");

 $c = $_SESSION['customer_email'];

 if (isset($_POST['yes'])) {
 	session_destroy();
 	
 	$delete_customer ="DELETE from customers where customer_email='$c'";
 	$run_delete = mysqli_query($con,$delete_customer);
 	if ($run_delete) {
 			echo "<script>alert('Your Account has been deleted , Good Bye')</script>";
 			echo "<script>window.open('../index.php','_self')</script>";
 	}
 }
if (isset($_POST['no'])) {
	echo "<script>window.open('my_account.php','_self')</script>";
}
?>

