<?php include "../init.php" ?>

<?php
if(isset($_REQUEST['add'])){
    echo "add clicked";

    $customer_id = $user_id;//temp
    //$customer_name = "Sandesh Adhikari";
    
    $product_id = $_REQUEST['product_id'];
    //get product data
    $product_quantity = $_REQUEST['product_quantity'];
     $query = "SELECT * FROM tblproduct where product_id = '$product_id'";
     $product_detail = runQuery($query);
     $row = mysqli_fetch_assoc($product_detail);
    
    $product_name = $row['product_name'];
    $product_rate = $row['product_rate'];
    $product_img_path = $row['product_img_path'];
    
    
     //insert data in cart table
     $query = "INSERT INTO tblcart(customer_id,product_id,product_name, product_rate,product_quantity,product_img_path) 
     VALUES('$customer_id','$product_id','$product_name','$product_rate','$product_quantity','  $product_img_path ') ";
    
    if(runQuery($query)){
        header('location:../clienthome.php');
    }
    
}
else if(isset($_REQUEST['added'])){
    echo "added clicked";

    header('location:../Cart.php');
}


?>