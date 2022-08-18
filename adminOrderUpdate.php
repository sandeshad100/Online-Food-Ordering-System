<?php
 include "init.php" 
 ?>

<?php
 if(!(isset($_SESSION['admin_email'])))
 {
     header('location:login.php');
 }

if(isset($_REQUEST['m'])){
     $m = $_REQUEST['m']; 
}
$isUpdate = 0;
if(isset($_REQUEST['updateorder'])){
 

    $isUpdate = 1;
    $order_id           = $_REQUEST['o_id'];
    $customer_name      = $_REQUEST['c_name']; 
    $customer_contact1  = $_REQUEST['c_contact1'];
    $customer_contact2  = $_REQUEST['c_contact2'];
    $customer_email     = $_REQUEST['c_email'];
    $customer_address   = $_REQUEST['c_address'];
    $order_status       = $_REQUEST['o_status'];
    // echo "<pre>";
    // print_r ($order_status);
    // echo "</pre>";
    // die("");
  
    $order_note         = $_REQUEST['o_note'];

    $query = "UPDATE `tblorder_master` SET `customer_name`='$customer_name',`customer_contact1`='$customer_contact1',`customer_contact2`='$customer_contact2',`customer_email`='$customer_email', `customer_address`='$customer_address', 
    `order_status`='$order_status', 
    `order_note`='$order_note' WHERE `order_id` = $order_id";

    $q = runQuery($query);
    if($q){
        // die("updated");
        header('location:adminOrderManage.php');
    }
}



//show data in form from db:
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
    $current_order_status       = $row['order_status'];
    $order_At           = $row['order_datetime'];
    $order_query        = $row['order_query'];
    $order_note         = $row['order_note'];

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <title>Order Update</title>
    <link rel="stylesheet" href="HAF/style/headerAndSidebar.css">
   <link rel="stylesheet" href="style/adminOrderUpdate.css">
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
       
            <div class="shipping_form">
                <div class="container">
                    <h1>Edit order information</h1>
                    <form action="" method="POST">
                       
                        <label>Order ID</label><small>Read only</small>
                       <input type="text" name= "o_id" value="<?php  echo $order_id; ?>" readonly>
                       <label>Name</label>
                       <input type="text" name= "c_name" value = "<?php echo $customer_name; ?>">
                       <label>Contact No</label>
                       <input type="text"  name= "c_contact1" value = "<?php echo $customer_contact1; ?>">
                       <label>Contact No 2<small> optional</small></label>
                       <input type="text" name= "c_contact2"  value = "<?php echo $customer_contact2; ?>">
                       <label>Email</label>
                       <input type="email" name= "c_email"  value = "<?php echo   $customer_email; ?>">
                       <label>Address</label>
                       <input type="text"  name= "c_address" value = "<?php echo   $customer_address; ?>">
                       <label>Order Status</label>
                       <select name="o_status">
                        <?php   
                        $i = 0;
                            while($i < $order_status_len){
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
                       <label>Order Note</label>
                       <textarea rows="10" cols="50"  name= "o_note"><?php echo   $order_note; ?>"</textarea>
                    
                       
                       <!-- <label>Payment Mode</label>
                       <select name="" id="">
                        <option value="">Case on delivery</option>
                        <option value="">Pre-payment</option>
                        
                      </select> -->
                  
                      <input class="proceed_btn" type="submit" value="Update Order" name="updateorder">
                    
                    </form>
                    <a href="adminOrderManage.php?m=<?php  echo $m; ?>"><button class="continue_btn">Back</button></a>
                </div>
            </div>
      
    </div>


</body>
<script src="https://kit.fontawesome.com/f91eeebc13.js" crossorigin="anonymous"></script>

</html>