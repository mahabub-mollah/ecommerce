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
                          <?php
                        if (!isset($_SESSION['customer_email'])) {
                          echo"<b>Welcome Guest</b>";

                        }
                        else{
                          echo"<b>Welcome:".$_SESSION['customer_email']. "</b>";
                        }

                        ?>
                          
                          <b style="color: yellow;"> YourShopping Cart</b>
                          <span>-Total Items:<?php items();?> ToTal- Price<?php total_price();?>-<a href="index.php" style="color:yellow;">BackToShopping</a>
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
                    <table width="740" align="center" bgcolor="blue">
                    <tr align="center">
                      <td><b>Remove</b></td>
                       <td><b>product(s)</b></td>
                        <td><b>Quantity</b></td>
                         <td><b>Total Price</b></td>
                    </tr>
                        <?php
                                 $ip_add= getUserIP();
                                 
                                  $total=0;
                                 $sel_price = "SELECT * from cart WHERE ip_add='$ip_add'";
                                 $run_price = mysqli_query($con, $sel_price);
                                  while ($record=mysqli_fetch_array( $run_price)) {
                                   $pro_id =$record['p_id'];
                                   $pro_price = "SELECT * from products where product_id='$pro_id'";
                                   $run_pro_price=mysqli_query($con,$pro_price);
                                   while ($p_price=mysqli_fetch_array( $run_pro_price)) {

                                    $product_price=array($p_price['product_price']);
                                     $product_title=$p_price['product_title'];
                                      $product_image=$p_price['product_img1'];
                                      $only_price=$p_price['product_price'];
                                    $values =array_sum($product_price);
                                    $total +=$values;
                                
                                 
                        ?>
                    <tr>
                      <td><input type="checkbox" name="remove[]" value=" <?php echo $pro_id;?>"></td>
                      <td><?php echo  $product_title;?><br><img src="admin_area/product_images/<?php echo trim($product_image);?>" width="80" height='80'></td>
                      <td><input type="text" name="qty" value="" size="3"></td>
                        
                        <?php
                          if (isset($_POST['update'])) {
                            $qty =$_POST['qty'];
                            $insert_qty = "UPDATE cart set qty ='$qty' where ip_add='$ip_add'";
                            $run_qty = mysqli_query($con, $insert_qty);
                            $total= $total*$qty;
                          }
                        ?>

                      <td><?php echo "tk". $only_price;?></td>
                    </tr>
                    <?php 
                      }
                        }

                     ?>
                     <tr  style="color:yellow; font-size: 18px;" >
                       <td colspan="3" align="right">Sub Total:</td>
                       
                       <td><?php echo"tk". $total; ?></td>
                     </tr>
                     <tr align="center">
                       <td><input type="submit" name="update" value="UpdateCart"></td>
                        <td><input type="submit" name="continue" value="ContinueShopping"></td>
                         <td><button style=" background:yellow;"><a href="check_out.php" style="text-decoration: none; color: #000;">Checkout</a></button></td>
                     </tr>
                      
                    </table>

                       
                     </form>

        <!--@ sine used to define not to work if user do not check the remove option. and calling function from function page...-->
                      <?php  
                      echo @$qty_update = updateqty();
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