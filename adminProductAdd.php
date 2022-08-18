
<?php include "init.php" ?>
<?php
 if(!(isset($_SESSION['admin_email'])))
 {
     header('location:login.php');
 }

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="HAF/style/headerAndSidebar.css">

    <link rel="stylesheet" href="style/adminProductAdd.css">
  <!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <title>ProductAdd</title>
    <style>
        
        .cancle_btn
     {
        
        text-decoration: none;
        border: none;
        width: 100%;
        height: 30px;
        background-color: #b6b625;
        color: white;
        font-size: 15px;
        font-weight: 600;
        border: none;
        border-radius: 10px;
        transition: all 0.3s ease;

 }
.cancle_btn:hover{
cursor: pointer;
color:#414104 ;
background-color: white;
border: 1px solid #b3b32a;
}   

    </style>
    
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
        <section class="container">
            <h2>New Product</h2>
            <div class="formParent">
                <form action="backend/HandleAdminProductAdd.php" method="POST" enctype="multipart/form-data">
                
                   <label>Name</label>
                   <input type="text" name="product_name" value="">
                   <label>Rate</label>
                   <input type="number" min="1" name="product_rate" value="">
                   <label>Description</label>
                   <textarea rows="10" cols="50" name="product_description"></textarea>
        
        
                   <label>Category</label>
                   <select name="product_category" id="dropDown">
                     <?php
                     $i = 0;
                      while($i < $category_array_len){
                          echo '<option value="'.$category_id_array[$i].'">'.$category_array[$i].'</option>';
                        $i++;
                      }
                     
                     ?>
                  </select>
        
                  <div class="img_parent">
                    
                   </div>
                   <label>Select image - </label>
                  <input type="file" name="uploadfile">
                  <input type="submit" value="ADD" name="submit">
                </form>
        
                <a href="adminProductManage.php"><button class="cancle_btn">Cancle</button></a>
            </div>
        </section>
    </div>

    
</body>
<script src="https://kit.fontawesome.com/f91eeebc13.js" crossorigin="anonymous"></script>

</html>