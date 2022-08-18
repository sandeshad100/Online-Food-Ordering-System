<?php include "init.php" ?>

<?php
 if(!(isset($_SESSION['admin_email'])))
 {
     header('location:login.php');
 }

//to fetch products:
//sql query
$query = "SELECT * FROM `tblproduct`";
//run sql query
$product_result = mysqli_query($conn, $query);
if($product_result){
   // echo "<br>";
   // echo "Success query";
}
else{
    die ("Display failed".mysqli_error($conn));
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="HAF/style/headerAndSidebar.css">
    <link rel="stylesheet" href="style/adminProductManage.css">
  <!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <title>Daseboard productManagement</title>
    <style>
        
    </style>
</head>

<body>
<script src="assets/jquery/jquery-3.6.0.js">
    </script>
    <script src="app.js"></script>
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
        <section class="container">
            <div class="cart_container">
                <h1>Product Management</h1>

                <a href="adminProductAdd.php"><button class="add_btn">ADD</button></a>

                <table>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Rate</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    <?php

while($row = mysqli_fetch_assoc($product_result)){

   $product_img_path = $row['product_img_path'];
   $product_id = $row['product_id'];
   $product_name = $row['product_name'];
   $product_rate = $row['product_rate'];
   $product_category_id = $row['product_category_id']; 
   $product_description = $row['product_description'];


   $query2 = "SELECT category_name FROM tblcategory where category_id = '$product_category_id '";
   $r = runQuery($query2);
   $r = mysqli_fetch_assoc($r);
   $category_name = $r['category_name'];

   echo '
   <tr>
       <td><img src="backend/'.$product_img_path.'"></td>
       <td><p>'.$product_name.'</p></td>
       <td><p>'.$product_description.'</p></td>
       <td><p>'.$product_rate.'</p></td>
       <td><p>'.$category_name.'</p></td>
       <td  class="action_btn">
           <a href="adminProductEdit.php?product_id='.$product_id.'"><i class="fa-solid fa-pen-to-square fa-lg"></i></a>
           <a href="backend/HandleAdminProductDelete.php?product_id='.$product_id.'" class="del">
           <i class="fa-solid fa-trash fa-lg"></i></a>
       </td>
   </tr>
   ';
}
?>

                </table>
              
            </div>
        </section>
    </div>

    
</body>
<script src="https://kit.fontawesome.com/f91eeebc13.js" crossorigin="anonymous"></script>

</html>