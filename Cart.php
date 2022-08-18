<?php include "initsmall.php" ?>
<?php
if(!isset($_SESSION['user_email'])){
    header('location:login.php');
}


$c_id = $user_id;
//for delete btn

if($_REQUEST['btn'] == "d"){
    // echo "del clecked";
   $p_id = $_REQUEST['p_id'];
   $query = "DELETE FROM tblcart WHERE product_id = '$p_id' AND customer_id = '$c_id'";
   runQuery($query);
   
  
}
else if($_REQUEST['btn'] == "qty_up"){
    // echo "<br>up clicked";
    $p_id = $_REQUEST['p_id'];
    $qty_query ="SELECT product_quantity FROM tblcart WHERE product_id = '$p_id' AND customer_id = '$c_id'"; 
    $qty_result = runQuery($qty_query);
    $qty_row = mysqli_fetch_assoc($qty_result);
    echo $qty= $qty_row['product_quantity'];
    echo $qty_new = $qty+1;
    $query = "UPDATE tblcart SET product_quantity= '$qty_new' WHERE product_id = '$p_id' AND customer_id = '$c_id';";
    runQuery($query);
    header('location:Cart.php');
    
}
else if($_REQUEST['btn'] == "qty_down"){
    echo "<br>down clicked";
    $p_id = $_REQUEST['p_id'];
    $qty_query ="SELECT product_quantity FROM tblcart WHERE product_id = '$p_id' AND customer_id = '$c_id'"; 
    $qty_result = runQuery($qty_query);
    $qty_row = mysqli_fetch_assoc($qty_result);
    echo $qty= $qty_row['product_quantity'];
    if($qty != 1){
        
        echo $qty_new = $qty-1;
        $query = "UPDATE tblcart SET product_quantity= '$qty_new' WHERE product_id = '$p_id' AND customer_id = '$c_id';";
        runQuery($query);
        header('location:Cart.php');
     
       
    }
    header('location:Cart.php');
   
}


//to fetch cart products:
//sql query
$query = "SELECT * FROM `tblcart` where customer_id = '$c_id'";
$cart_products = runQuery($query);
$total = mysqli_num_rows($cart_products);
if($total < 1){
    $isEmpty = 1;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- font awesome cdn -->
     <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

     <link rel="stylesheet" href="assets/fontawesome-free-6.1.1-web/css/all.min.css">
     <link rel="stylesheet" href="assets/fontawesome-free-6.1.1-web/css/fontawesome.min.css">

  
    <link rel="stylesheet" href="HAF/style/header.css">
    <link rel="stylesheet" href="style/Cart.css">
    <link rel="stylesheet" href="HAF/style/footer.css">
    <link rel="stylesheet" href="style/global.css">

    <title>Cart</title>
   
</head>
<body>
<?php include "HAF/header.php" ?>
   
    
    <div class="container">
        <div class="cart_container">
            <h2>CART</h2>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Rate</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Remove</th>
                </tr>

                <?php
                $total = 0;
                    while($row = mysqli_fetch_assoc($cart_products)){

                        //fetch image path from tblproduct 
                        $p_id = $row['product_id'];
                        // $product_img_path = $row['product_img_path'];
                        $query2 = "SELECT product_img_path FROM tblproduct WHERE product_id = $p_id";
                        $query2 = runQuery($query2);
                        $row_img = mysqli_fetch_assoc($query2);
                        $product_img_path = $row_img['product_img_path'];

                        $product_id = $row['product_id'];
                        $product_name = $row['product_name'];
                        $product_rate = $row['product_rate'];
                        $product_quantity = $row['product_quantity'];
                        $subtotal =  $product_rate * $product_quantity;
                        $total += $subtotal;

                        echo 
                        '<tr>
                        <td><img src="backend/'.$product_img_path.'" alt="Can t load image!"></td>
                        <td><p>'.$product_name.'</p></td>
                        <td><p>'.$product_rate.'</p></td>
                        <td>
                            <a class="inc_btn" href="Cart.php?p_id='.$product_id.'&btn=qty_up"><i class="fa-solid fa-caret-up fa-2x"></i></a>
                            <p class="qty">'.$product_quantity.'</p>
                            <a class="dec_btn" href="Cart.php?p_id='.$product_id.'&btn=qty_down"><i class="fa-solid fa-caret-down fa-2x"></i></a>
                        </td>
                        <td><p>'.$subtotal.'</p></td>
                        <td><a href="Cart.php?p_id='.$product_id.'&btn=d" class="del">
                            <i class="fa-solid fa-trash fa-lg"></i></a>
                        </td>
                        </tr>
                        ';

                    }
                  

                ?>
                
            </table>
    
            <div class="cart_bottom">
                <!-- <a href="clienthome.php"><button class="continue_btn emptyCart">< Continue Shopping</button></a> -->
                <?php if($isEmpty == 0){
                    echo 
                    '
                    <a href="clienthome.php"><button class="continue_btn">< Continue Shopping</button></a>
                    ';
                
                      echo '
                      <h3>Total: '.$total.'</h3>
                      <a href="checkout.php"><button class="proceed_btn">Proceed</button></a>
                      '
                      ;
                }else{
                    echo 
                    '
                    <a href="clienthome.php"><button class="continue_btn emptyCart">< Continue Shopping</button></a>
                    ';
                    echo '<h3>Cart is empty, order some items!</h3>';
                }

                ?>
              
               
            </div>
            <div class="line"></div>
           
      
    
          
        </div>
    </div>
    <?php include "HAF/footer.php" ?>
</body>
</html>