<?php 

$con=mysqli_connect("localhost","root","","myshop");

// getting IP  from visitors .............
function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}
//getting the default for custommer
function getdefault()
{
  global $con;

  $c = $_SESSION['customer_email'];
  $get_c ="SELECT * from customers where customer_email='$c'";
  $run_c =mysqli_query($con, $get_c);
  $row_c=mysqli_fetch_array( $run_c);
    $customer_id = $row_c['customer_id'];

    if (!isset($_GET['my_orders'])){
       if (!isset($_GET['edit_account'])){
           if (!isset($_GET['change_pass'])){
              if (!isset($_GET['delete_account'])) {
                $get_orders = "SELECT * From customer_orders where customer_id=' $customer_id' AND order_status='pending'";
                $run_orders = mysqli_query($con,$get_orders);
                $count_orders= mysqli_num_rows($run_orders);
                if ( $count_orders>0) {
                  echo"
                  <div style='padding:10px;'>
                  <h1 style='color:red;'>Important!</h1>
                  <h2> YOu have  ($count_orders) pending orders </h2>
                  <h3> Please see your orders details by clicking this <a href='my_account.php?my_orders'>Link</a><br> or youcan <a href='pay_offline.php'>payofflineNow</a> </h3>
                  </div>";
                }
                else{
                   echo"
                  <div style='padding:10px;'>
                  <h1 style='color:red;'>Important!</h1>
                  <h2> YOu have no pending orders </h2>
                  <h3> You can see your orders history by clicking this <a href='my_account.php?my_orders'>Link</a></h3>
                  </div>";
                }
           }
      
    
  }
}
}

}


//Creating The  Script forCart

function cart(){

  if (isset($_GET['add_cart'])) {
        global $con;
         $ip_add= getUserIP();
         $p_id=$_GET['add_cart'];
         $check_pro ="SELECT * from cart WHERE ip_add='$ip_add' AND p_id=' $p_id'";
         $run_check=mysqli_query($con,$check_pro);
         if (mysqli_num_rows( $run_check)>0) {

          echo"";
          
         }else{
          $q="INSERT into cart (p_id,ip_add) values('$p_id','$ip_add')";
          $run_q=mysqli_query($con,$q);
          echo"<Script>window.open('index.php','_self')</Script>";
         }
    
  }
}

//getting the number of items from the cart

function items()
{
  if (isset($_GET['add_cart'])) {
    global $con;
     $ip_add= getUserIP();
   $get_items= "SELECT * from cart where ip_add='$ip_add'";
   $run_items = mysqli_query($con, $get_items);
   $count_items =mysqli_num_rows($run_items);
  }else{
     $ip_add= getUserIP();
         global $con;
       $get_items= "SELECT * from cart where ip_add='$ip_add'";
       $run_items = mysqli_query($con, $get_items);
        $count_items =mysqli_num_rows($run_items);
  }
  echo $count_items;
}
//Getting the products to display...
function total_price(){
  
   $ip_add= getUserIP();
   global $con;
    $total=0;
   $sel_price = "SELECT * from cart WHERE ip_add='$ip_add'";
   $run_price = mysqli_query($con, $sel_price);
    while ($record=mysqli_fetch_array( $run_price)) {
     $pro_id =$record['p_id'];
     $pro_price = "SELECT * from products where product_id='$pro_id'";
     $run_pro_price=mysqli_query($con,$pro_price);
     while ($p_price=mysqli_fetch_array( $run_pro_price)) {

      $product_price=array($p_price['product_price']);
      $values =array_sum($product_price);
      $total +=$values;
       
     }
   }
   echo"tk" .$total;
}


//Getting the product display
function getPro(){

	               global $con;
                 if (!isset($_GET['cat'])) {
                 	
                     if (!isset($_GET['brand'])) {
                 
                   
                      
                      $get_products ="SELECT * from products ";
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
                          
 "; }



       }
   }
  }
//Getting cetagory products
function getCatPro(){

	 global $con;
                 if (isset($_GET['cat'])) {
                 	
                     
                   $cat_id=$_GET['cat'];
                      
                      $get_cat_products ="SELECT * from products WHERE cat_id ='$cat_id'";
                      $run_cat_products=mysqli_query($con, $get_cat_products);

                      $count=mysqli_num_rows($run_cat_products);
                      if ($count==0) {
                      	echo "<h2>There is no product in this catagorey!</h2>";
                      }
                      while ($row_cat_products=mysqli_fetch_array($run_cat_products)) {
                        
                        $pro_id=$row_cat_products['product_id'];
                        $pro_title=$row_cat_products['product_title'];
                        $pro_cat=$row_cat_products['cat_id'];
                        $pro_brand=$row_cat_products['brand_id'];
                        $pro_des=$row_cat_products['product_des'];
                        $pro_price=$row_cat_products['product_price'];
                        $pro_image=$row_cat_products['product_img1'];
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
   
  }
//Getting Brands products
function getBrandPro(){

	 global $con;
                 if (isset($_GET['brand'])) {
                 	
                     
                   $brand_id=$_GET['brand'];
                      
                      $get_brand_products ="SELECT * from products WHERE brand_id ='$brand_id'";
                      $run_brand_products=mysqli_query($con, $get_brand_products);

                      $count=mysqli_num_rows($run_brand_products);
                      if ($count==0) {
                      	echo "<h2>There is no product in this catagorey!</h2>";
                      }
                      while ($row_brand_products=mysqli_fetch_array($run_brand_products)) {
                        
                        $pro_id=$row_brand_products['product_id'];
                        $pro_title=$row_brand_products['product_title'];
                        $pro_cat=$row_brand_products['cat_id'];
                        $pro_brand=$row_brand_products['brand_id'];
                        $pro_des=$row_brand_products['product_des'];
                        $pro_price=$row_brand_products['product_price'];
                        $pro_image=$row_brand_products['product_img1'];
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
   
  }

//Getting the brand display.

function getBrands(){

                     global $con;
                     $get_brands="SELECT * from brands";
                     $return_brands = mysqli_query($con, $get_brands);
                     while($row_brands=mysqli_fetch_array( $return_brands)){
                     	$brand_id=$row_brands['brand_id'];
                     	$brand_title =$row_brands['brand_title'];
                    
                 	echo"<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
                 	}
                 }
                 
//getting catagory 
 function getCats() {
      	       global $con;

                     $get_cats="SELECT * from categories";
                     $return_cats = mysqli_query($con, $get_cats);
                     while($row_cats=mysqli_fetch_array( $return_cats)){
                     	$cat_id=$row_cats['cat_id'];
                     	$cat_title =$row_cats['cat_title'];
                    
                 	echo"<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
                 	}
                 
      }
//getting All product display...
      function getAllProducts(){


    	global $con;
                
                 	
                 
                 
                   
                      
                      $get_products ="SELECT * from products ";
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
  //update Quantity

              function updateqty(){

                global $con;

                     if (isset($_POST['update'])) {

                      foreach ($_POST['remove'] as $remove_id) {

                        $delete_products= "DELETE  from cart where p_id='$remove_id'";
                        $run_delete=mysqli_query($con, $delete_products);
                         

                         if ($run_delete) {
                            
                            echo "<script> window.open('cart.php','_self')</script";
                        }
                       
                        
                      }



                     }
                    

                  
                     if (isset($_POST['continue'])) {

                        echo "<script> window.open('index.php','_self')</script";
                        
                      }
                      
                  }
         
    

    
?>
        