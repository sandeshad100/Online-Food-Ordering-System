<?php include "init.php" ?>
<?php
if(!isset($_SESSION['user_email'])){
    header('location:login.php');
}
$c_id = $user_id;
if(isset($_REQUEST['btn_order'])){

  show($_REQUEST);
//   die("stop");
   
 
    $customer_id         = $_REQUEST['register_id'];
    $customer_name       = $_REQUEST['c_name'];
    $customer_contact1   = $_REQUEST['c_contact'];
    $customer_contact2   = $_REQUEST['c_contact2'];
    $customer_email      = $_REQUEST['c_email']; 
    $customer_address    = $_REQUEST['c_address'];  
    $customer_query      = $_REQUEST['c_query'];
// die("stop");
    //get order time
    date_default_timezone_set('Asia/Kathmandu');
    $datetime = date('m/d/Y h:i:s a', time());

    //insert in order master  table
    $query = "INSERT INTO `tblorder_master`(`customer_id`,  `customer_name`, `customer_contact1`, `customer_contact2`, `customer_email`, `customer_address`,  `order_query`,`order_datetime`) VALUES ('$customer_id','$customer_name','$customer_contact1','$customer_contact2','$customer_email','$customer_address','$customer_query', '$datetime')";

    $order_master = runQuery($query);
    //get last/max order id
    $q = "SELECT MAX(order_id) as MAX FROM tblorder_master";
    $q = runQuery($q);
    $q = mysqli_fetch_array($q);
    echo $o_id = $q['MAX']; 

    //insert ordered products
    $query = "SELECT * FROM `tblcart` where customer_id = '$c_id'";
    $cart_products = runQuery($query);

    while($row = mysqli_fetch_assoc($cart_products)){
        global $o_id;
        $product_id = $row['product_id'];
       echo $product_name = $row['product_name'];   
        $product_rate = $row['product_rate'];
        $product_quantity = $row['product_quantity'];
        $product_img_path = $row['product_img_path'];

        $query = "INSERT INTO `tblorder_info`( `order_id`, `product_id`, `product_name`, `product_rate`, `product_quantity`, `product_img_path`) VALUES ('$o_id', '$product_id' ,'$product_name', '$product_rate','$product_quantity','$product_img_path')";
        // $query = "INSERT INTO `tblorder_info`( `order_id`, `product_id`, `product_name`, `product_rate`, `product_quantity`) VALUES ('101','58','Purbanchal Tea','70','7');";

        runQuery($query);

    }
   //clear cart
   $del_query = "DELETE  FROM `tblcart` WHERE `customer_id` = '$c_id'";
   runQuery($del_query);
   header('location:orderTrack.php');
    
}

$query = "SELECT * FROM tblregister where register_id = '$c_id'";
$customer_info = runQuery($query);
$row = mysqli_fetch_assoc($customer_info);

$register_id = $row['register_id'];
$register_name = $row['register_name'];
$register_contact = $row['register_contact_no'];
$register_email = $row['register_email'];
// $c_address = $row['register_password'];

//total amount
$query = "SELECT * FROM `tblcart` where customer_id = '$c_id'";
$cart_products = runQuery($query);

$total = 0;
while($row = mysqli_fetch_assoc($cart_products))
{
$product_rate = $row['product_rate'];
$product_quantity = $row['product_quantity'];
$subtotal =  $product_rate * $product_quantity;
$total += $subtotal;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- font awesome -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <!-- <link rel="stylesheet" href="headerAndFooter/style/header.css"> -->
     <link rel="stylesheet" href="HAF/style/header.css">
    <link rel="stylesheet" href="style/checkout.css">
    <link rel="stylesheet" href="HAF/style/footer.css"> 
    <title>with Checkout</title>
</head>
<body>
<?php include "HAF/header.php" ?>
   
    <div class="container">
        <div class="shipping_form">
            <h1>Shipping Information</h1>
            <div class="container">
                <form action="checkout.php" method="POST">
                    <input type="hidden" value="<?php echo $c_id; ?>" name="register_id">
                   <label>Name</label>
                   <input type="text" name="c_name" value="<?php echo $register_name; ?>">
                   <label>Contact No</label>
                   <input type="text" name="c_contact" value="<?php echo $register_contact; ?>">
                   <label>Contact No 2<small> optional</small></label>
                   <input type="text" name="c_contact2" value="<?php  ?>">
                   <label>Email</label>
                   <input type="email" name="c_email" value="<?php echo $register_email; ?>">
                   <label>Address</label>
                   <input type="text" name="c_address" value="<?php  ?>">
                   <label>Any query<small> optional</small></label>
                   <textarea rows="5" cols="10" name="c_query"></textarea>
                
                   
                   <label>Payment Mode: Cash On Delivery(COD)</label>
                   
                  <h3 class="total">Total amount to be paid: <?php echo "Rs.".$total; ?></h3>
                  <input class="proceed_btn" type="submit" value="Confirm Order" name="btn_order" >
                
                </form>
                <a href="Cart.php"><button class="continue_btn">Back to Cart</button></a>
            </div>
            
        </div>
    </div>
    
    <?php include "HAF/footer.php" ?>
</body>
</html>