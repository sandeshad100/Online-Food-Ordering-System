<?php
 include "init.php" 
 ?>

<?php
 if(!(isset($_SESSION['admin_email'])))
 {
     header('location:login.php');
 }

    $m = $_REQUEST['m'];
    $o_id = $_REQUEST['id'];
    // current order status
    $query = "SELECT order_status FROM `tblorder_master` where order_id = '$o_id'";
    $order_result = runQuery($query);
    $row = mysqli_fetch_assoc($order_result);
    $current_order_status = $row['order_status']; 


// update order status
if(isset($_REQUEST['update_o_btn']))
{
    $o_id = $_REQUEST['o_id'];
    // current order status
    $query = "SELECT order_status FROM `tblorder_master` where order_id = '$o_id'";
    $order_result = runQuery($query);
    $row = mysqli_fetch_assoc($order_result);
     $current_order_status = $row['order_status']; 

    // update order status
    $new_order_status = $_REQUEST['updates'];
    $q = "UPDATE `tblorder_master` SET `order_status` = '$new_order_status' where `order_id` = '$o_id';";
    $q = runQuery($q);
    if($q){
        header("location:adminOrderManage.php?m=$m");
    }
   
}
// if(!isset($_REQUEST['id'])){
    //header('location:orderManagement.php');// accesssing this page directly
// }
// echo $order_id = $_REQUEST['id']; 
// echo $m = $_REQUEST['m'];
$order_id = $_REQUEST['id'];
$query = "SELECT * FROM `tblorder_master` where order_id = '$order_id'";
$order_result = runQuery($query);

    $row = mysqli_fetch_assoc($order_result);

    // $order_id           = $row['order_id'];
    $customer_name      = $row['customer_name'];
    $customer_contact1  = $row['customer_contact1']; 
    $customer_contact2  = $row['customer_contact2'];
    $customer_email     = $row['customer_email'];
    $customer_address   = $row['customer_address'];
    $order_status       = $row['order_status'];
    $order_At           = $row['order_datetime'];
    $order_query        = $row['order_query'];
    $order_note         = $row['order_note'];

    //products
    $query = "SELECT * FROM `tblorder_info` WHERE order_id = '$order_id'";
    $product_result = runQuery($query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="HAF/style/headerAndSidebar.css">
    <link rel="stylesheet" href="style/adminOrderView.css">
    <!-- <link rel="stylesheet" href="style/Cart.css"> -->

    <!-- font awesome -->
    <!-- <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" /> -->

    <link rel="stylesheet" href="assets/fontawesome-free-6.1.1-web/css/all.min.css">
     <link rel="stylesheet" href="assets/fontawesome-free-6.1.1-web/css/fontawesome.min.css">
        
    <title>Order View</title>
    <style>
        .box1 th,td{
            text-align: left;
        }
        .cart_container td{
            text-align: center;
        }
    </style>


</head>

<body>
    <?php include 'HAF/adminHeader.php' ?>

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
                
                        <div class="box1">
                            <h1>Order Information</h1>
                            <table>
                                <thead>
                                    <th>Order Properties</th>
                                    <th>Information</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Order ID</td>
                                        <td><?php   echo $order_id; ?></td> 
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td><?php   echo  $customer_name ; ?></td> 
                                    </tr>
                                    <tr>
                                        <td>Phone No</td>
                                        <td><?php   echo  $customer_contact1; ?></td> 
                                    </tr>
                                    <tr>
                                        <td>Phone No 2</td>
                                        <td><?php   echo $customer_contact2; ?></td> 
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php   echo  $customer_email; ?></td> 
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td><?php   echo   $customer_address; ?></td> 
                                    </tr>
                                     <tr>
                                        <td>Ordered At</td>
                                        <td><?php   echo $order_At; ?></td> 
                                    </tr>
                                    <!-- <tr>
                                        <td>Mode Of Payment</td>
                                        <td>Sand</td> 
                                    </tr> -->
                                    <tr class="special">
                                        <td>Current Order Status</td>
                                        <td><?php   echo   $order_status_name_array[$order_status-1] ; ?></td> 
                                    </tr>
                                    <!-- <tr>
                                        <td>Order Note</td>
                                        <td></td> 
                                    </tr> -->
                                   
                                </tbody>
                            </table>
                            <div class="noteBox">
                                <p>Customer Query:</p>
                                <p><?php   echo  $order_query; ?></p>
                            </div>
                            <div class="noteBox">
                                <h4>Order Note:</h4>
                                <p><?php   echo  $order_note; ?></p>
                            </div>
                            
                          <form action="adminOrderView.php?m=<?php echo $m;?>" method="POST">
                          <h4>Change Order Status to:</h4>
                              <input type="hidden" value="<?php  echo $order_id; ?>" name="o_id" class="proceed_btn">
                            <select name="updates">
                                <?php   
                                $i = 0;
                                while($i < $order_status_len)
                                {
                                        if($current_order_status == $order_status_id_array[$i]){
                                            echo
                                            '<option value="'.$order_status_id_array[$i].'" selected>
                                            '.$order_status_name_array[$i].'
                                            </option>';
                                        }
                                        else{
                                            echo
                                            '<option value="'.$order_status_id_array[$i].'">
                                            '.$order_status_name_array[$i].'
                                            </option>';
                                        }

                                            $i++;
                                }
                            ?>
                                
                            </select>
                            <input type="submit" name="update_o_btn" value=" Move" class="proceed_btn">
                          </form>
                        </div>
                        <!-- box2 -->
                        <div class="box2">
                            <div class="cart_container" >
                                <h2>Ordered Products</h2>
                              
                               
                                <table>
                                    <tr>
                                        <th>Product</th>
                                        <th>Name</th>
                                        <th>Rate</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                      
                                    </tr>
                                    <?php
                                    $subTotal = 0;
                                    $total = 0;
                                    while($row = mysqli_fetch_assoc($product_result)){
                                    
                                        $product_id = $row['product_id'];
                                        $product_name = $row['product_name'];
                                        $product_rate = $row['product_rate'];
                                        $product_quantity = $row['product_quantity'];
                                       
                                        $product_img_path =$row['product_img_path'];
                                        $product_img_path = trim($product_img_path);
                                        echo "<br>";
                                    
                                        $subTotal = $product_quantity * $product_rate;
                                        $total = $total+$subTotal;

                                    

                                       echo ' <tr>
                                       <td><img src="backend/'.$product_img_path.'"></td>
                                        <td><p>'.$product_name.'</p></td>
                                        <td><p>'.$product_rate.'</p></td>
                                        <td>
                                            <!-- <a class="inc_btn" href="#"><i class="fa-solid fa-caret-up fa-2x"></i></a> -->

                                            <p class="qty">'.$product_quantity.'</p>

                                            <!-- <a class="dec_btn" href="#"><i class="fa-solid fa-caret-down fa-2x"></i></a> -->
                                        </td>
                                        <td><p>'.$subTotal.'</p></td>
                                       
                                    </tr>
                                    ';

                                    }

                                    ?>

                                    
                                   
                                    
                                </table>
                                <div class="cart_bottom">
                                    <h3>Total: <?php echo $total; ?></h3>
                                </div>
                              
                                <div class="line"></div> 
                               
                                <div class="cart_bottom">
                                   
                                   
                                    <a href="adminOrderManage.php?m=<?php echo $m;?>"><button class="continue_btn">< Back</button></a>
                                    
                                   
                                </div>
                            </div>
                        </div>
               
        </section>
    </div>


</body>
<script src="https://kit.fontawesome.com/f91eeebc13.js" crossorigin="anonymous"></script>


</html>