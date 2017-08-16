<?php
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

                  <div id="headline">
                        <div id="headline_content">
                          <b>Wellcome Guest!</b>
                          <b style="color: yellow;">Shopping Cart</b>
                          <span>-Items: - Price</span>
                        </div>

                   </div>

                  <div id="products_box">

                     <?php  

                     if (isset($_GET['search'])) {
                      
                    $user_keywords=$_GET['user_query'];
                     $get_products ="SELECT * from products WHERE product_keywords like'%$user_keywords%' ";
                      $run_products=mysqli_query($con, $get_products);
                      while ($row_products=mysqli_fetch_array($run_products)) {
                        
                        $pro_id=$row_products['product_id'];
                        $pro_title=$row_products['product_title'];
                        $pro_cat=$row_products['cat_id'];
                        $pro_brand=$row_products['brand_id'];
                        $pro_des=$row_products['product_des'];
                        $pro_price=$row_products['product_price'];
                        $pro_image=$row_products['product_img1'];
                         echo"
                           <div id='single_product'>
                           <h3>$pro_title</h3>
                           <img src='admin_area/product_images/".trim($pro_image)."' width='180' height='180' /><br>
                             <p><b> Price: $ $pro_price</B></p>
                           
                          
                           <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                            <a href='index.php?add_cart=$pro_id'><button style ='float:right;'>Add to cart</button></a>

                           </div>
                          







                         ";
                      }
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