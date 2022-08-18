<?php include "init.php" ?>
<?php
//client page
if(!isset($_SESSION['user_email'])){
    header('location:login.php');
}
$c_id = $user_id;
//pagination
//3.define number of results per page
$results_per_page = 2;
//4.find out number of results stored in db
$sql = "SELECT * FROM `tblorder_master` WHERE customer_id = '$c_id' ORDER BY order_id  DESC";
$result = runQuery($sql);
$number_of_results = mysqli_num_rows($result);
//6.determin number of pages available

$number_of_pages = ceil($number_of_results/$results_per_page);
//determin which page visitor is currently on
if(!isset($_GET['page'])){
    $page = 1;
    
}else{
    $page = $_GET['page'];
}
 //8.determine the sql limit starting number for the result on the displaying page
 $this_page_first_result = ($page-1)*$results_per_page;
//  $sql = " SELECT * FROM pagination LIMIT " . $this_page_first_result . ',' . $results_per_page;


$query = "SELECT * FROM `tblorder_master` WHERE customer_id = '$c_id' ORDER BY order_id  DESC LIMIT ". $this_page_first_result . ',' . $results_per_page;

$order_lists = runQuery($query);
$num_of_order = mysqli_num_rows($order_lists);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style/orderTrack.css">
    <link rel="stylesheet" href="HAF/style/header.css">  
    <link rel="stylesheet" href="HAF/style/footer.css">  
    <!-- <link rel="stylesheet" href="style/Cart.css"> -->

    <!-- font awesome -->
    <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
        
    <title>Order Track</title>


</head>

<body>
<?php include "HAF/header.php" ?>

    <!-- <div class="bodyContainer"> -->
        
        <section class="container">
        <?php
        if($num_of_order == 0){
            echo '<h2 class = "textCenter">You haven t made a order, 
            <br>Please order some items😋!</h2>
            ';
        }
        while($row = mysqli_fetch_assoc($order_lists))
        {
            $order_id = $row['order_id'];
            $order_master_row = "SELECT * FROM tblorder_master WHERE `order_id` = '$order_id'";
            $order_master_row = runQuery($order_master_row);
            $order_master_row = mysqli_fetch_assoc($order_master_row);
            $customer_name      = $order_master_row['customer_name'];
            $customer_contact1  = $order_master_row['customer_contact1']; 
            $customer_contact2  = $order_master_row['customer_contact2'];
            $customer_email     = $order_master_row['customer_email'];
            $customer_address   = $order_master_row['customer_address'];
            $order_status       = $order_master_row['order_status'];
            $order_At           = $order_master_row['order_datetime'];
            $order_query        = $order_master_row['order_query'];

            echo ' <div class="box1">
                            
                            <h1 class="orderHead">Ordered At: '.$order_At .'</h1>
                           
                           
                            <table>
                                <thead>
                                    <th>Order Properties</th>
                                    <th>Information</th>
                                </thead>
                                <tbody>
                                  
                                    

                                   
                                    <tr>
                                        <td>Order ID</td>
                                        <td>'.$order_id.'</td> 
                                    </tr>

                                    <tr class="special">
                                        <td>Order Status</td>
                                        <td>'.$order_status_name_array[$order_status-1].'</td> 
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>'.$customer_name .'</td> 
                                    </tr>
                                    <tr>
                                        <td>Contact No 1</td>
                                        <td>'. $customer_contact1.'</td> 
                                    </tr>
                                    <tr>
                                        <td>Phone No 2</td>
                                        <td>'. $customer_contact2.'</td> 
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>'. $customer_email.'</td> 
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>'.$customer_address.'</td> 
                                    </tr>
                                     
                                    <tr>
                                        <td>Mode Of Payment</td>
                                        <td>Cash on Delivery</td> 
                                    </tr>
                                    
                                
                                </tbody>
                            </table>
                            <div class="noteBox">
                                <p>Your Query:</p>
                                <p>'.$order_query.'</p>
                            </div>
                         
                        </div>';
        
                // die("stop");
                //products detail
             


                    
                       echo ' <div class="box2">
                            <div class="cart_container" >
                                <h3>Ordered Products</h3>
                              
                               
                                <table>
                                    <tr>
                                        <th>Product</th>
                                        <th>Name</th>
                                        <th>Rate</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                      
                                    </tr>';
                                    ?>

                                    <?php
                                     $total = 0;
                                     $product_details = "SELECT * FROM tblorder_info WHERE order_id = '$order_id'";
                                     $product_details = runQuery($product_details);
                     
                                     while($product_row = mysqli_fetch_assoc($product_details))
                                     {
                                         echo $product_name       = $product_row['product_name'];
                                         $product_img        = $product_row['product_img_path'];
                                         $product_img        = trim($product_img);
                                         $product_rate       = $product_row['product_rate'];
                                         $product_quantity   = $product_row['product_quantity'];

                                         $subtotal = $product_rate * $product_quantity;
                                         $total    = $total + $subtotal;

                                       echo '<tr>
                                        <td><img src="backend/'.$product_img.'"></td>
                                        <td><p>'.$product_name.'</p></td>
                                        <td><p>'.$product_rate.'</p></td>
                                        <td>
                                           
                                            <p class="qty">'.$product_quantity.'</p>
                                           
                                        </td>
                                        <td><p>'.$subtotal.'</p></td>

                                        </tr>
                                        ';
                }
                                 
                                    
                                    
                                    
                                    
                               echo 
                               ' </table>
                                <div class="cart_bottom">
                                    <h3>Total: Rs.'.$total.'</h3>
                                </div>
                              
                                <div class="line"></div> 
                               
                             
                              
                            </div>
                        </div>';
 }
                        ?>
               
        </section>
        <div class="pages">
       
       <?php
           //7.display the links to the page
           for($page=1;$page<=$number_of_pages;$page++)
           {
           // echo '<a href="clienthome.php?page='.$page.'">'.$page.'</a><br>';
           echo '<a href="orderTrack.php?page='.$page.'"><button class="page_btn">'.$page.'</button></a><br>';
   
           }
        ?>
       </div>

    <?php include "HAF/footer.php" ?>
</body>
<script src="https://kit.fontawesome.com/f91eeebc13.js" crossorigin="anonymous"></script>


</html>