<?php 
@session_start();
 include("includes/db.php");
 

 ?>


<div>
   
	<form action="check_out.php" method="post">
	<table width="800" bgcolor="#66cccc" align="center">
	        <tr align="center">
			    <td colspan="4"><h2>Login or register</h2></td>
			 </tr>

			 <tr>
			     <td align="right"><b> Your Email</b></td>
		         <td colspan="2"><b><input type="text" name="c_email"  /></b></td>
			 	
			 </tr>
			 <tr>
			     <td align="right"><b>Your Password</b></td>
			     <td colspan="2"><b><input type="password" name="c_pass"  /></b></td>
			 	
			 </tr>
			 
		      
			<tr align="center">
			       <td colspan="4"><input type="submit" name="c_login" value="Login" /></td>
				
			</tr>
			<tr align="center">
			 	<td colspan="4" ><a href="check_out.php?forgot_pass" style="text-decoration: none; color: red;"> forgot Password</a></td>
			 </tr>
			
	
	</table>

	</form>
	<?php
	if (isset($_GET['forgot_pass'])) {
		echo"

         <div align='center'>

             <b> Enter your email below we will send password</b><br>
             <form action='' method='post'>
             <input type='text' name='c_email' value='Enter Your Email' required /><br>
             <input type='submit' name='forgot_pass' value='send me password'/><br>
           </form>
         </div>


		";

		if (isset($_POST['forgot_pass'])) {
		$c_email =$_POST['c_email'];

		$sel_c="SELECT * from customers where customer_email='$c_email'";
		$run_c=mysqli_query($con,$sel_c);
		$check_c = mysqli_num_rows($run_c);
		$row_c =mysqli_fetch_array($run_c);
		$c_name = $row_c['customer_name'];
		$c_pass = $row_c['customer_pass'];

		if ($check_c==0) {
			echo"<script> alert('Sorry!This email does not exist')</script>";

		}else{


			$from ='mahbubsprint310@gmail.com';
			$subject ='Your Password';
			$msg ="
			<html>
			<h3>Dear $c_name</h3>
			<p>You requested for your password at www.mysite.com</p>
			<b>Your password is</b><span style='color:red;'>$c_pass</span>
			<h3>Thank you for using our password</h3>



			</html>

              ";

              mail($c_email,$subject , $msg,$from);
              echo"<script> alert('Password was sent to your email...please check your email')</script>";
             echo"<script> window.open('check_out.php','_self')</script>";






		
		}


		}
	}
	?>
	  <h2 style=" padding: 10px; "><a href="customer_register.php" style="text-decoration:none; font-size: 20px;"> New?RegisterHere</a><h2>
		
</div>
<?php 
if (isset($_POST['c_login'])) {
	$customer_email=trim($_POST['c_email']);
	$customer_pass=trim($_POST['c_pass']);
	$sel_customer= "SELECT * from customers where customer_email='$customer_email' and customer_pass='$customer_pass'";
	$run_customer = mysqli_query($con,$sel_customer);
	$check_customer=mysqli_num_rows($run_customer);
	$get_ip= getUserIP();
	$sel_cart="SELECT * from cart where ip_add='$get_ip'";
	$run_cart= mysqli_query($con,$sel_cart);
	$check_cart=mysqli_num_rows($run_cart);


	if ($check_customer==0) {

		echo "<script>alert('password or email address is not correct')</script>";
		return false;
		
	}
	if($check_customer==1 && $check_cart==0) {

		$_SESSION['customer_email']=$customer_email;
		echo"<script>window.open('customer/my_account.php','_self')</script>";
	}
	
	else{
		$_SESSION['customer_email']=$customer_email;
		include("payment_options.php");
	}

}






 ?>