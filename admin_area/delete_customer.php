<?php
include("includes/db.php");



if (isset($_GET['delete_customer'])) {
	
	$delete_id = $_GET['delete_customer'];

	$delete_customer ="DELETE from customers where customer_id='$delete_id'";
	$run_delete = mysqli_query($con,$delete_customer);

	if ($run_delete) {

		echo"<script>alert('One Customer has been Deleted Successfully!')</script>";
          echo"<script>window.open('index.php?view_customers','_self')</script>";
		
	}
}





?>