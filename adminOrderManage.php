<?php include "init.php" ?>

<?php
 if(!(isset($_SESSION['admin_email'])))
 {
     header('location:login.php');
 }

if(isset($_REQUEST['btn'])){

    if($_REQUEST['btn'] == "d"){
        
        $o_id = $_REQUEST['o_id'];
        $query = "DELETE FROM `tblorder_info` WHERE order_id = '$o_id'";
        runQuery($query);
        $query = "DELETE FROM `tblorder_master` WHERE order_id = '$o_id'";
        runQuery($query);
      
    }
  
}
if(!isset($_REQUEST['m'])){
    $order_stage = 1;
    $query = "SELECT * FROM `tblorder_master` where order_status = '$order_stage' ORDER BY order_id  DESC";
}
else{
    $order_stage = $_REQUEST['m'];
    $query = "SELECT * FROM `tblorder_master` where order_status = '$order_stage' ORDER BY order_id  DESC";
}

$order_result = runQuery($query);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="HAF/style/headerAndSidebar.css">
    <link rel="stylesheet" href="style/adminOrderManage.css">
  <!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <title>Dashboard productManagement</title>
    
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
                <h1>Order Management</h1>
                <div class="stage">
                    <a href="adminOrderManage.php?m=1"><button class="stage_btn <?php if($order_stage == 1)echo "selected_btn"; ?>">Order Requests</button></a>
                    
                    <a href="adminOrderManage.php?m=2">
                        <button class="stage_btn <?php if($order_stage == 2)echo "selected_btn"; ?>">Approved</button></a>
                    <a href="adminOrderManage.php?m=3"><button class="stage_btn <?php if($order_stage == 3)echo "selected_btn"; ?>">Processing</button></a>
                    <a href="adminOrderManage.php?m=4"><button class="stage_btn <?php if($order_stage == 4)echo "selected_btn"; ?>">On The Way</button></a>
                    <a href="adminOrderManage.php?m=5"><button class="stage_btn <?php if($order_stage == 5)echo "selected_btn"; ?>">Delivered</button></a>
                    <a href="adminOrderManage.php?m=6"><button class="stage_btn <?php if($order_stage == 6)echo "selected_btn"; ?>">Exception</button></a>
                
                </div>
              
                <table>
                    <tr>
                        <th>Order ID</th>
                        <th>Name</th>
                        <th class="smallSize">Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Ordered At</th>
                        <th>Action</th>
                    </tr>
                    <?php
                            while($row = mysqli_fetch_assoc($order_result)){
                                $order_id = $row['order_id'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact1'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];
                                $order_At = $row['order_datetime'];
                                // $order_Status = $row['order_status'] ;
                                echo '<tr>
                        
                                <td><p>'.$order_id.'</p></td>
                                <td><p>'.$customer_name.'</p></td>
                                <td  class="smallSize"><p>'.$customer_contact.'</p></td>
                                <td><p>'. $customer_email.'</p></td>
                                <td>
                                    <p>'.$customer_address.'</p>
                                  </td>
                                <td><p>'.$order_At.'</p></td>
                                <td class="action_btn">
                                    <a href="adminOrderView.php?id='.$order_id.'&m='.$order_stage.'"  class="green"><i class="fa-solid fa-eye  fa-lg"></i></a>
                                    
                                    <a href="adminOrderUpdate.php?id='.$order_id.'&m='.$order_stage.'"><i class="fa-solid fa-pen-to-square fa-lg"></i></a>
                                    <a href="adminOrderManage.php?btn=d&o_id='.$order_id.'&m='.$order_stage.'" class="del">
                                    <i class="fa-solid fa-trash fa-lg"></i></a>
                                </td>
                            </tr>';

                            }

                        ?>
                </table>
            </div>
        </section>
    </div>

    
</body>
<script src="https://kit.fontawesome.com/f91eeebc13.js" crossorigin="anonymous"></script>

</html>