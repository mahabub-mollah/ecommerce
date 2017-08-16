<!DOCTYPE html>
<html>
<head>
	<title>PaymentOptions</title>
</head>
<body>
<?php
   include("includes/db.php");

   
?>

<div align="center" style="padding:10px;">
<h2>Paypent Options For you</h2>
<?php
$ip= getUserIP();
$get_customer="SELECT * FROM customers where customer_ip='$ip'";
$run_customer = mysqli_query($con,$get_customer);
$customer = mysqli_fetch_array($run_customer);
$customer_id = $customer['customer_id'];
?>
<b>Pay with</b><a href="http://www.paypal.com"></a><img src="images/paypal-buttons-au.gif" width="200" height="200"><b> OR <a href="order.php?c_id=<?php echo $customer_id;?>">Pay Offline</a></b><br>

<b> If you order in offline then check your email address for invoice....!</b>
	





</div>

</body>
</html>






