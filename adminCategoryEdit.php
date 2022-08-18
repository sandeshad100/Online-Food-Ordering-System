<?php include "init.php" ?>
<?php

  if(!(isset($_SESSION['admin_email'])))
  {
     header('location:login.php');
  }

  
$c_id = $_REQUEST['c_id'];
$query  = "SELECT *  FROM `tblcategory` where category_id = $c_id";
$result = runQuery($query);
$row = mysqli_fetch_assoc($result);
$c_name = $row['category_name'];
$c_desc = $row['category_description'];

//for update
if(isset($_REQUEST['update'])){
    $category_name  =$_REQUEST['category_name'];
    $category_description =$_REQUEST['category_description'];

    $query  = "UPDATE `tblcategory` SET `category_id`='$c_id',`category_name`='$category_name',`category_description`='$category_description' WHERE category_id = '$c_id'";

    if(runQuery($query)){
        header('location:adminCategoryManage.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="HAF/style/headerAndSidebar.css">
    <link rel="stylesheet" href="style/adminCategoryEdit.css">
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <title>DaseboardCategory</title>
    <style>
     
       
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
            <h2>Update Category</h2>
            <div class="container_form">
             
                <form action="" class="form" method="POST">
                 
                    <label  for="">Category Name</label>
                    <input type="text" placeholder="" name="category_name" value="<?php echo $c_name  ?>">
    
                    <label for="">Category Description</label>
                   <textarea name="category_description" rows="10"><?php echo $c_desc  ?></textarea>
                    <input type="submit" name="update" value="UPDATE">
                </form>
            </div>
        </section>
    </div>


</body>
<script src="https://kit.fontawesome.com/f91eeebc13.js" crossorigin="anonymous">

</script>

</html>