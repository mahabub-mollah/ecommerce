<?php


include("includes/db.php");
if (!isset($_SESSION['admin_email'])) {
  echo"<script> window.open('login.php','_self')</script>";
}

else
{


?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body bgcolor="white">
    <form method="post" action="" enctype="multipart/form-data">
    <table width="794" align="center" border="1" bgcolor="blue">
       <tr align="center">
       	 <td colspan="2"><h2>Insert New Product</h2></td>
       </tr>
       <tr>
       <td align="right"><b>Product title</b></td>
       	 <td><input type="text" name="product_title"></td>
       </tr>
       <tr>
       <td  align="right"><b>Product Cat</b></td>
       	 <td>
       	 	<select name="product_cat">
       	 	 <option>Select a Category</option>
       	 	 <?php
                     $get_cats="SELECT * from categories";
                     $return_cats = mysqli_query($con, $get_cats);
                     while($row_cats=mysqli_fetch_array( $return_cats)){
                     	$cat_id=$row_cats['cat_id'];
                     	$cat_title =$row_cats['cat_title'];
                    
                 	echo"<option value='$cat_id'>$cat_title</option>";
                 	}
                 	?>
       	 	</select>
       	 </td>
       </tr>
       <tr>
       <td  align="right"><b>Product Brand</b></td>
       	 <td>
       	 	<select name="product_brand">
       	 	<option>Select Brand</option>
       	 	<?php
                     $get_brands="SELECT * from brands";
                     $return_brands = mysqli_query($con, $get_brands);
                     while($row_brands=mysqli_fetch_array( $return_brands)){
                     	$brand_id=$row_brands['brand_id'];
                     	$brand_title =$row_brands['brand_title'];
                    
                 	echo"<option value='$brand_id'>$brand_title</option>";
                 	}
                 	?>
       	 		
       	 	</select>
       	 </td>
       </tr>
       <tr>
       <td  align="right"><b>Product Img1</b></td>
       	 <td><input type="file" name="product_img1"></td>
       </tr>
       <tr>
       <td  align="right"><b>Product Img2</b></td>
       	 <td><input type="file" name="product_img2"></td>
       </tr>
       <tr>
       <td  align="right"><b>Product img3</b></td>
       	 <td><input type="file" name="product_img3"></td>
       </tr>
       <tr>
         <td  align="right"><b>Product price</b></td>
       	 <td><input type="text" name="product_price"></td>
       </tr>
       <tr>
       <td  align="right"><b>Product Description</b></td>
       	 <td><textarea name="product_des" cols="35" rows="10"></textarea></td>
       </tr>
       <tr>
         <td  align="right"><b>Product Keywords</b></td>
       	 <td><input type="text" name="product_keywords"></td>
       </tr>
       <tr align="center">
       	 <td colspan="2"><input type="submit" name="insert_product" value="Insert Product"></td>
       </tr>
    	
    </table>
    	
    </form>

</body>
</html>
<?php
if (isset($_POST['insert_product'])) {
    //text data variables
	 $product_title = $_POST['product_title'];
	 $product_cat = $_POST['product_cat'];
	 $product_brand = $_POST['product_brand'];
	 $product_price = $_POST['product_price'];
	 $product_des = $_POST['product_des'];
	 $status = 'on';
	 $product_keywords = $_POST['product_keywords'];
	
     //images name
     $product_img1 = $_FILES['product_img1']['name'];
      

     $path1 = $product_img1;
      move_uploaded_file($_FILES['product_img1']['tmp_name'], "product_images/".$product_img1);

      $product_img2 = $_FILES['product_img2']['name'];
      

     $path2 =  $product_img2;
      move_uploaded_file($_FILES['product_img2']['tmp_name'], "product_images/". $product_img2);

      $product_img3 = $_FILES['product_img3']['name'];
      

     $path3 =$product_img3;
      move_uploaded_file($_FILES['product_img3']['tmp_name'], "product_images/".$product_img3);

    
    if ($product_title=='' OR $product_cat=='' OR $product_price=='' OR $product_price=='' OR $product_keywords=='' OR $product_img1=='') {

    	echo"<script> alert('please fill all the field!')</script>";
    	
     exit();

      }else{

      	
        
        
        

      	 $insert_product="INSERT into products(cat_id,brand_id,date,product_title,product_img1,product_img2,product_img3,product_price,product_des,product_keywords,status) values('$product_cat','$product_brand',NOW(),'$product_title',' $path1',' $path2',' $path3','$product_price','$product_des','$product_keywords','$status')";
    

       $run_product=mysqli_query($con,$insert_product);

        if ( $run_product) {

          echo"<script>alert('Product inserted successfully!')</script>";
          echo"<script>window.open('index.php?insert_product','_self')</script>";
        }





      }
    


   




    }


?>
<?php }?>