<?php
include("includes/db.php");



if (isset($_GET['delete_order'])) {
	
	$delete_id = $_GET['delete_order'];

	$delete_order ="DELETE from pending_orders where order_id='$delete_id'";
	$run_delete =mysqli_query($con,$delete_order);

	if ($run_delete) {

		echo"<script>alert('One Order has been Deleted Successfully!')</script>";
          echo"<script>window.open('index.php?view_orders','_self')</script>";
		
	}
}





?>