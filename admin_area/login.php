<?php
include("includes/db.php");
session_start();



?>


<link href='styles/style.css' rel='stylesheet' type='text/css'>

<form method="post" action="">
<h2 style="color: white;padding-top: 10px"><?php echo @$_GET['logout'];?></h2>
<div class="box">
<h1>Dashboard</h1>

<input type="text" name="admin_email" value="email" class="email" required="" />
  
<input type="text" name="admin_pass" value="password"  class="email" required="" />
  
<div class="btn"><input type="submit" name="login" value="Login"></div>


  
</div> <!-- End Box -->
  
</form>
<?php
if (isset($_POST['login'])) {

	$user_email = $_POST['admin_email'];
	$user_password = $_POST['admin_pass'];

	$sel_admin ="SELECT * from admins where admin_email='$user_email'and admin_pass='$user_password'";
	$run_admin = mysqli_query($con,$sel_admin);
	$check_admin = mysqli_num_rows($run_admin);

	if ($check_admin==1) {

		$_SESSION['admin_email'] = $user_email;

		echo"<script> window.open('index.php?logged_in=You have Successfully logged in!','_self')</script>";
		
	}else{
		echo"<script>alert('Admin email or password is incorre3ct')</script>";
		
	}
	

}


?>


