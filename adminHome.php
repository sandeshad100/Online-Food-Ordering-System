<?php
 include "init.php"
 ?>
<?php

    if(!(isset($_SESSION['admin_email'])))
    {
        header('location:login.php');
    }
//for no of registers
$query = "SELECT * FROM tblregister";
$r =runQuery($query);
 $registers  = mysqli_num_rows($r);

//for no of category
$q = "SELECT * FROM tblcategory";
$r = runQuery($q);
 $category = mysqli_num_rows($r);

//for no of products
$q = "SELECT * FROM tblproduct";
$r = runQuery($q);
 $product = mysqli_num_rows($r);

//for no of order requests
$q = "SELECT * FROM `tblorder_master` where order_status = '1'";
$r = runQuery($q);
$order_requests = mysqli_num_rows($r);

//for no of order deliveiries
$q = "SELECT * FROM `tblorder_master` where order_status = '5'";
$r = runQuery($q);
$order_delivered = mysqli_num_rows($r);

 "<br>";
 //for no of customers, who have ordered at least once 
$q = "SELECT DISTINCT customer_id from tblorder_master";
$r = runQuery($q);
 $customers = mysqli_num_rows($r);


//most ordered product
$q = "SELECT product_id FROM tblorder_info GROUP BY product_id ORDER BY COUNT(*) DESC LIMIT 1";
$r = runQuery($q);
$row = mysqli_fetch_assoc($r);
 $most_ordered = $row['product_id'];
$q = "SELECT product_name FROM tblorder_info where product_id = '$most_ordered'";
$r = runQuery($q);
$row = mysqli_fetch_assoc($r);
 $most_ordered = $row['product_name'];

//total sales
$sales = 0;
$q = "SELECT * FROM `tblorder_master` WHERE order_status = 5 ";
$q = runQuery($q);
while($orders = mysqli_fetch_assoc($q)){
   
    $o_id = $orders['order_id'];
    $item_row = "SELECT * FROM `tblorder_info` where `order_id` = $o_id";
    $item_row = runQuery($item_row);
    while($r2 = mysqli_fetch_assoc($item_row))
    {
     
        $rate  = $r2['product_rate'];
        $qty   = $r2['product_quantity'];
        $sales = $sales + ($rate* $qty);
   
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
    <link rel="stylesheet" href="style/adminHome.css">

    <!-- font awesome -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
<!--     
        <link rel="stylesheet" type="text/css" href="assets/fontawesome-free-6.1.1-web/css/fontawesome.min.css"> -->
    <title>Dashboard Home</title>
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
            <h2>DASHBOARD</h2>
            <div class="block block1">
                <div class="statusBox">
                <div class="iconBox success"><i class="fa-solid fa-dollar-sign fa-3x"></i></div>
                    <div class="infoBox"><p>Sales</p><h1>Rs. <?php  echo $sales; ?></h1></div>
                   
                </div>
                <div class="statusBox ">
                    <div class="iconBox warning"><i class="fa-solid fa-cart-arrow-down fa-3x"></i></div>
                    <div class="infoBox"><p>Order Requests</p><h1><?php  echo $order_requests;?></h1>
                    </div>
                </div>

                <div class="statusBox">
                <div class="iconBox joy"><i class="fa-solid fa-house-chimney-user fa-3x"></i></div>
                    <div class="infoBox"><p>Delivered Orders</p><h1><?php  echo $order_delivered;?></h1></div>
                </div>

                <div class="statusBox ">
                    <div class="iconBox success"><i class="fa-solid fa-chart-simple  fa-3x"></i></div>
                    <div class="infoBox"><p>Most Ordered product</p>
                    <h1>
                        <?php echo $most_ordered; ?>
                    </h1>
                    </div>
                </div>
            </div>
            <div class="block block2">
            <div class="statusBox">
            <div class="iconBox success"><i class="fa-solid fa-bowl-rice  fa-3x"></i></div>
                    <div class="infoBox "><p>Products</p><h1><?php  echo $product;?></h1></div>
            </div>
            <div class="statusBox">
            <div class="iconBox"><i class="fa-solid fa-receipt fa-3x"></i></div>
                    <div class="infoBox"><p>Categories</p><h1><?php  echo $category;?></h1></div>
            </div>
            <div class="statusBox">
            <div class="iconBox customer"><i class="fa-solid fa-people-line fa-3x"></i></div>
                    <div class="infoBox"><p>Customers</p><h1><?php  echo $customers; ?></h1></div>
            </div>
            <div class="statusBox">
            <div class="iconBox success"><i class="fa-solid fa-right-to-bracket fa-3x"></i></div>
                    <div class="infoBox"><p>Registers</p><h1><?php  echo $registers;?></h1></div>
            </div>
            </div>
            
          
        </section>
    </div>


</body>
<!-- <script src="https://kit.fontawesome.com/f91eeebc13.js" crossorigin="anonymous"></script> -->


</html>