<?php


include("includes/db.php");

if (isset($_GET['edit_pro'])) {

 $edit_id = $_GET['edit_pro'];

$get_edit = "SELECT * from products where product_id ='$edit_id'";
$run_edit = mysqli_query($con,$get_edit);
$row_edit = mysqli_fetch_array($run_edit);
$update_id = $row_edit['product_id'];

$p_title = $row_edit['product_title'];
$c_id = $row_edit['cat_id'];
$brand_id = $row_edit['brand_id'];
$p_img1 = $row_edit['product_img1'];
$p_img2 = $row_edit['product_img2'];
$p_img3 = $row_edit['product_img3'];
$p_price = $row_edit['product_price'];
$p_des = $row_edit['product_des'];
$p_keywords = $row_edit['product_keywords'];


}
$get_cat = "SELECT * from categories where cat_id='$c_id'";
$run_cat = mysqli_query($con,$get_cat );
$cat_row = mysqli_fetch_array($run_cat);
$cat_edit_title = $cat_row['cat_title'];


$get_brand = "SELECT * from brands where brand_id='$brand_id'";
$run_brand = mysqli_query($con,$get_brand);
$brand_row = mysqli_fetch_array($run_brand);
$brand_edit_title = $brand_row['brand_title'];



?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body bgcolor="white">
    <form  method="post" action="" enctype="multipart/form-data">
    <table width="794" align="center" border="1" bgcolor="blue">
       <tr align="center">
       	 <td colspan="2"><h2>Update OR Edite Product</h2></td>
       </tr>
       <tr>
       <td align="right"><b>Product title</b></td>
       	 <td><input type="text" name="product_title" value="<?php echo $p_title;?>"></td>
       </tr>
       <tr>
       <td  align="right"><b>Product Cat</b></td>
       	 <td>
       	 	<select name="product_cat">
       	 	 <option value="<?php echo $c_id;?>"><?php echo $cat_edit_title;?></option>
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
       	 	<option value="<?php echo $brand_id;?>"><?php echo $brand_edit_title; ?></option>
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
       	 <td><input type="file" name="product_img1"><img src="product_images/<?php echo trim($p_img1);?>" style="width: 50px; height: 50px;"></td>
       </tr>
       <tr>
       <td  align="right"><b>Product Img2</b></td>
       	 <td><input type="file" name="product_img2"><img src="product_images/<?php echo trim($p_img2); ?>" style="width: 50px; height: 50px;"></td>
       </tr>
       <tr>
       <td  align="right"><b>Product img3</b></td>
       	 <td><input type="file" name="product_img3"><img src="product_images/<?php echo trim($p_img3);?>" style="width: 50px; height: 50px;"></td>
       </tr>
       <tr>
         <td  align="right"><b>Product price</b></td>
       	 <td><input type="text" name="product_price" value="<?php echo $p_price;?>"></td>
       </tr>
       <tr>
       <td  align="right"><b>Product Description</b></td>
       	 <td><textarea name="product_des" cols="35" rows="10"><?php echo $p_des;?></textarea></td>
       </tr>
       <tr>
         <td  align="right"><b>Product Keywords</b></td>
       	 <td><input type="text" name="product_keywords" value="<?php echo $p_keywords;?>"></td>
       </tr>
       <tr align="center">
       	 <td colspan="2"><input type="submit" name="update_product" value="Update Product"></td>
       </tr>
    	
    </table>
    	
    </form>

</body>
</html>
<?php
if (isset($_POST['update_product'])) {
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

      	
        
        
        

      	 $update_product="UPDATE products set cat_id='$product_cat',brand_id='$product_brand',date=NOW(),product_title='$product_title',product_img1='$path1',product_img2='$path2',product_img3='$path3',product_price='$product_price',product_des='$product_des',product_keywords='$product_keywords' where product_id='$update_id'";
    

       $run_update=mysqli_query($con,$update_product);

        if ( $run_update) {

          echo"<script>alert('Product updated successfully!')</script>";
          echo"<script>window.open('index.php?view_products','_self')</script>";
        }





      }
    


   




    }


?>