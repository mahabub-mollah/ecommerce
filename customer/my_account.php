<?php
session_start();
   include("includes/db.php");
   include("../functions/functions.php");
?>





<!DOCTYPE html>
<html>
<head>
	<title>My E_commerce site...</title>
	<link rel="stylesheet" type="text/css" href="styles/style1.css" media="all">
</head>
<body>

    <div class="main_wrapper">
      	
            <!----Header section-->
           <div class="header_wrapper">
          
                <a href="index.php"><img src="../images/search.gif" style="float:left"></a> 

              <img src="../images/ecommerce-banner.png" style="float: right">
           </div>
            <!----navigation section-->
           <div id="navbar">
               <ul id="menu">
               	   <li><a href="../index.php">Home</a></li>
               	    <li><a href="../all_products.php">All products</a></li>
               	     <li><a href="customer/my_account.php">My Account</a></li>
                     <?php
                     if(isset($_SESSION['customer_email'])) {
                       echo"<span style='display:none;'> <li><a href='../user_register.php'>Sign Up</a></li></span>";
                     }
                     else
                     {
                       echo"<li><a href='../user_register.php'>Sign Up</a></li>";
                     }
                     ?>
               	      
               	       <li><a href="../cart.php">Shopping Cart</a></li>
               	       <li><a href="../contact.php">Cotact Us</a></li>
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
                 <div id="sidebar_title">Mannage Account</div>
                 <ul id="cats">

                 <?php
                 
                   $user_session = $_SESSION['customer_email'];
                   $get_customer_pic ="SELECT * from customers where customer_email='$user_session'" ;
                   $run_customer = mysqli_query($con,$get_customer_pic);
                   $row_customer = mysqli_fetch_array( $run_customer );
                   $customer_pic =  $row_customer['customer_img'];
                   echo"<img src='customer_photos/$customer_pic' width='150' height='150'>";
                 ?>


                 <li><a href="my_account.php?my_orders">MyOrders</a></li>
                 <li><a href="my_account.php?edit_account">EditAccount</a></li>
                 <li><a href="my_account.php?change_pass">ChangePassword</a></li>
                 <li><a href="my_account.php?delete_account">DeleteAccount</a></li>
                 <li><a href="my_account.php">Logout</a></li>
                 </ul>
                 
               	 
               </div>
               <div id="right_content">
                      <?php
                      cart();
                      ?>
                  <div id="headline">
                        <div id="headline_content">
                        <?php
                         if(isset($_SESSION['customer_email'])){

                          echo "<b>Wellcome:"."</b> &nbsp"."<b style='color:yellow;'>" .$_SESSION['customer_email'] ."</b>";
                         }
                        ?>
                          
                          

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
                   

                  <div>
                  <h2 style="background: #999; color: #fff; padding: 20px; text-align: center; border: 2px #fff solid;">Mnage Your Account</h2>

                  <?php 
                  getdefault(); ?>
                  <?php
                   if (isset($_GET['my_orders'])) {
                     include('my_orders.php');
                   }

                   if (isset($_GET['edit_account'])) {
                     include('edit_account.php');
                   }
                   if (isset($_GET['change_pass'])) {
                     include('change_password.php');
                   }
                   if (isset($_GET['delete_account'])) {
                     include('delete_account.php');
                   }

                  ?>
                     
                  </div>
            </div>
           </div>

           <div class="footer">
             <h1 style="color: #000;padding-top: 30px; text-align: center;">copyright-2017- By www.mahbubhossain.com</h1>
           </div>











      </div>
</body>
</html>