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
    <link rel="stylesheet" href="style/adminCategoryAdd.css">
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <title>Category Add</title>
   

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
            <h2>Add Category</h2>
            <div class="container_form">
             
                <form action="backend/HandleAdminCategoryAdd.php" class="form" method="POST">
                 
                    <label  for="">Category Name</label>
                    <input type="text" placeholder="" name="category_name">
    
                    <label for="">Category Description</label>
                   <textarea name="category_description" rows="10" ></textarea>
                    <input type="submit" name="add" value="ADD">
                </form>
            </div>
        </section>
    </div>


</body>
<script src="https://kit.fontawesome.com/f91eeebc13.js" crossorigin="anonymous"></script>

</html>