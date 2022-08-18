<?php include "init.php" ?>

<?php
  if(!(isset($_SESSION['admin_email'])))
  {
      header('location:login.php');
  }
$query  = "SELECT *  FROM `tblcategory`";
$result = runQuery($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="HAF/style/headerAndSidebar.css">
    <link rel="stylesheet" href="style/adminCategoryManage.css">
  <!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>

    
    <!-- <link rel="stylesheet" type="text/css" href="assets/fontawesome-free-6.1.1-web/css/fontawesome.min.css"> -->
    <title>DaseboardCategory</title>
    
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
                <h1>Category Management</h1>
                <a href="adminCategoryAdd.php"><button class="add_btn">ADD</button></a>
                <table>
                    <tr>
                        <!-- <th>Product</th> -->
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    
                    <?php
        while($row = mysqli_fetch_assoc($result)){
            echo '
                <tr>
                    <!-- <td><img src="images/g-1.jpg"></td> -->
                    <td><p>'.$row['category_name'].'</p></td>
                    <td><p>'.$row['category_description'].'</p></td>
                    <td  class="action_btn">
                        <a href="adminCategoryEdit.php?c_id='.$row['category_id'].'"><i class="fa-solid fa-pen-to-square fa-lg"></i></a>
                        <a href="backend/HandleAdminCategoryDelete.php?c_id='.$row['category_id'].'" class="del">
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