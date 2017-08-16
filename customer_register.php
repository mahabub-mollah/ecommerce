<?php
session_start();
   include("includes/db.php");
   include("functions/functions.php");
?>





<!DOCTYPE html>
<html>
<head>
	<title>My E_commerce site...</title>
	<link rel="stylesheet" type="text/css" href="style.css" media="all">
</head>
<body>

    <div class="main_wrapper">
      	
            <!----Header section-->
           <div class="header_wrapper">
          
                <a href="index.php"><img src="images/search.gif" style="float:left"></a> 

              <img src="images/ecommerce-banner.png" style="float: right">
           </div>
            <!----navigation section-->
           <div id="navbar">
               <ul id="menu">
               	   <li><a href="index.php">Home</a></li>
               	    <li><a href="all_products.php">All products</a></li>
               	     <li><a href="my_account.php">My Account</a></li>
               	      <li><a href="user_register.php">Sign Up</a></li>
               	       <li><a href="cart.php">Shopping Cart</a></li>
               	       <li><a href="contact.php">Cotact Us</a></li>
               </ul>
               <div id="form">
               	<form method="get" action="results.php" enctype="multipart/form-data">
               	    <input type="text" name="user_query" placeholder="Search a Product">
               	    <input type="submit" name="search" value="Search">
               	</form>
               </div>
           </div>


            <!----H section-->
           <div class="content-wrapper">
               <div id="left_sidebar">
                 <div id="sidebar_title">Catagories</div>
                 <ul id="cats">
                   <?php  getCats(); ?>
                 </ul>
                  <div id="sidebar_title">Brand</div>
               	 <ul id="cats">
                 	<?php getBrands(); ?>
                 	
                 </ul>
               </div>
               <div id="right_content">
                      <?php
                      cart();
                      ?>
                  <div id="headline">
                        <div id="headline_content">
                          <b>Wellcome Guest!</b>
                          <b style="color: yellow;">Shopping Cart</b>
                          <span>-Total Items:<?php items();?> ToTal Price-<?php total_price();?>-<a href="cart.php" style="color:yellow;">GotoCart</a>
                          <?php

                         if (!isset($_SESSION['customer_email'])) {
                          echo "<a href='check_out.php' style='color:#f93;'>LogIn</a>";
                           
                         }
                         else{
                          echo "<a href='logout.php' style='color:#f93;'>Logout</a>";

                         }
                         ?>



                          </span>
                        </div>

                   </div>
                   <?php
                    $ip= getUserIP();
                    echo $ip;
                   ?>

                  <div id="products_box">
                   <form action="" method="post" enctype="multipart/form-data">
                   <table width="750" align="center">
                   <tr align="center">
                     <td colspan="6"><h2>Create an account</h2></td>
                   </tr>
                   <tr>
                     <td align="right">CustomerName</td>
                      <td><input type="text" name="c_name" required></td>
                   </tr>
                   <tr>
                     <td align="right">CustomerEmail</td>
                      <td><input type="text" name="c_email" required></td>
                   </tr>
                     
                     <tr>
                     <td align="right">CustomerPassword</td>
                      <td><input type="password" name="c_pass" required></td>
                   </tr>
                     
                     <tr>
                     <td align="right">CustomerCountry</td>
                      <td><select name="c_country">
                      <option>Select Country</option>
                       <option>BanglaDesh</option>
                        <option>India</option>
                         <option>Pakistan</option>
                          <option>USA</option>
                           <option>UK</option>
                        
                      </select></td>
                   </tr>
                     
                     <tr>
                     <td align="right">CustomerCity</td>
                      <td><input type="text" name="c_city" required></td>
                   </tr>
                     
                     <tr>
                     <td align="right">CustomerContact</td>
                      <td><input type="text" name="c_contact" required></td>
                   </tr>
                     
                     <tr>
                     <td align="right">CustomerAddress</td>
                      <td><input type="text" name="c_address" required></td>
                   </tr>
                     
                     
                   <tr>
                     <td align="right">CustomerImage</td>
                      <td><input type="File" name="c_img" required></td>
                   </tr>
                     <tr align="center">
                       <td colspan="6"><input type="submit" name="register" value="Submit"></td>
                     </tr>
                     
                     
                   </table>
                     
                   </form>
                     
                  </div>
            </div>
           </div>

           <div class="footer">
             <h1 style="color: #000;padding-top: 30px; text-align: center;">copyright-2017- By www.mahbubhossain.com</h1>
           </div>











      </div>
</body>
</html>

<?php
if (isset($_POST['register'])) {
  $c_name = trim($_POST['c_name']);
  $c_email =trim($_POST['c_email']) ;
  $c_pass = trim($_POST['c_pass']);
  $c_country = $_POST['c_country'];
  $c_city = $_POST['c_city'];
  $c_contact = $_POST['c_contact'];
  $c_address = $_POST['c_address'];
  $c_ip= getUserIP();
  $c_img = $_FILES['c_img']['name'];
  $path = $c_img;
  move_uploaded_file($_FILES['c_img']['tmp_name'], "customer/customer_photos/".$c_img);



  $insert_customer = "INSERT into customers (customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_img,customer_ip) values('$c_name',' $c_email','$c_pass','$c_country','$c_city',' $c_contact','$c_address',' $path','$c_ip')";
  $run_customer =mysqli_query($con, $insert_customer);
  $sel_cart="SELECT * from cart where ip_add='$c_ip'";
  $run_cart= mysqli_query($con,$sel_cart);
  $check_cart=mysqli_num_rows($run_cart);
  if ($check_cart>0) {
    $_SESSION['customer_email']=$c_email;
    echo"<script>alert('Registerd successfully')</script>";
    echo"<script>window.open('check_out.php','_self')</script>";
  }
  
  else{
     $_SESSION['customer_email']=$c_email;
       echo"<script>alert('Registerd unsuccessfull')</script>";
    
    echo"<script>window.open('index.php','_self')</script>";

  }

}

?>