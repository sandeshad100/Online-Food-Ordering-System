<?php include "init.php" ?>
<?php
 if(!(isset($_SESSION['admin_email'])))
 {
     header('location:login.php');
 }

// echo "<br>";
$product_id = $_REQUEST['product_id'];
//to fetch product details:
//sql query
$query = "SELECT * FROM `tblproduct` WHERE product_id = '$product_id'";
//run sql query
$product_result = mysqli_query($conn, $query);
if($product_result){
    // echo "<br>";
    // echo "Success query";
}
else{
    die ("Query failed".mysqli_error($conn));
}
$row = mysqli_fetch_assoc($product_result);
//product_id is fetched from the achore tag of the previous page
 $product_img_path =      $row['product_img_path'];
 $product_name =          $row['product_name'];
 $product_rate =          $row['product_rate'];

 $product_category_id =   $row['product_category_id']; 

$product_description =   $row['product_description'];


// die("");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="HAF/style/headerAndSidebar.css">
    <link rel="stylesheet" href="style/adminProductEdit.css">
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <title>DaseboardProductEdit</title>
  
     

</head>

<body>
<?php include "HAF/adminHeader.php" ?>


    <div class="bodyContainer">
        <div class="category">
            <h3>Manage</h3>
            <ul>
            <li><a href="adminHome.php">Home</a></li>
                    <div class="border"></div>
                    <li><a href="adminCategoryManage.php">Category</a></li>
                    <div class="border"></div>
                    <li><a href="adminProductManage.php">Product</a></li>
                    <div class="border"></div>
                    <li><a href="adminOrderManage.php">Orders</a>
                </li>
                <div class="border"></div>


            </ul>
        </div>
       
          
            <div class="container">
                <div class="formParent">
                <h2>Update Details</h2>
                <form action="backend/HandleAdminProductEdit.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                   <label>Name</label>
                   <input type="text" name="product_name" value="<?php echo $product_name ?>">
                   <label>Rate</label>
                   <input type="number" min="1" name="product_rate" value="<?php echo $product_rate ?>">
                   <label>Description</label>
                   <textarea rows="10" cols="50" name="product_description"><?php echo $product_description ?></textarea>
        
        
                   <label>Category</label>
                   <select name="product_category" id="dropDown">
                     <?php

                    $i = 0;
                      while($i < $category_array_len){

                        if($category_id_array[$i] == $product_category_id){
                            echo '<option value="'.$category_id_array[$i].'" selected>'.$category_array[$i].'</option>';
                        }
                        else{
                            echo '<option value="'.$category_id_array[$i].'">'.$category_array[$i].'</option>';
                        }
                          
                        $i++;
                      }
                     
                     ?>
                  </select>
        
                  <div class="img_parent">
                    <?php
                      echo '<img src="backend/'.$product_img_path.'" alt="image">';
                    ?>
                    
                   </div>
                   <label>Select new image - </label>
                  <input type="file" name="uploadfile">
                  <input type="submit" value="UPDATE" name="submit">
                </form>
           
        
                <a href="adminProductManage.php"><button class="cancle_btn">Cancle Update</button></a>
            </div>
            </div>
        
    </div>


</body>
<script src="https://kit.fontawesome.com/f91eeebc13.js" crossorigin="anonymous"></script>

</html>