<?php include "init.php" ?>

<?php
if(!isset($_SESSION['user_email'])){
    header('location:login.php');
}
$customer_id = 1;
$c_id = $_REQUEST['c_id'];
$query = "SELECT * FROM tblproduct WHERE product_category_id = '$c_id'";
//pagination
//start
// $results_per_page = 2;
// $result = runQuery($query);
// $number_of_results = mysqli_num_rows($result);
// $number_of_pages = ceil($number_of_results/$results_per_page);
// if(!isset($_GET['page'])){
//     $page = 1;
    
// }else{
//     $page = $_GET['page'];
// }
// $this_page_first_result = ($page-1) * $results_per_page;
// $query = "SELECT * FROM tblproduct WHERE product_category_id = '$c_id' LIMIT" . $this_page_first_result . ',' . $results_per_page;
//end
$category = runQuery($query);

//category name
$query2 ="SELECT * FROM `tblcategory` WHERE category_id = $c_id";
$category2 = runQuery($query2);
$row2 = mysqli_fetch_assoc($category2)  or die('Something went wrong');
$cname=$row2['category_name'];

//fetch cart products ids
$cart_product_ids_array = array();
$query = "SELECT  product_id FROM tblcart WHERE customer_id = '$customer_id'";
$cart_product_ids = runQuery($query);
while($row = mysqli_fetch_assoc($cart_product_ids)){
    array_push($cart_product_ids_array, $row['product_id']);
}
// echo "<pre>";
// print_r ($cart_product_ids_array);
// echo "</pre>";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/category.css">
    <link rel="stylesheet" href="HAF/style/header.css">
    <link rel="stylesheet" href="HAF/style/footer.css"> 
  <!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <title>Category</title>
    <style>
        body{
            /* background-color:#3A3845; */
        }
        .default_btn{
            width: 90%;
            height: 10%;
            border: none;
            border-radius: 5px;
            position: absolute;
            bottom: 15px;
            left: 15px;
            background-color: var(--RED);
            color: rgb(240, 255, 242);
            font-size: 16px;
            transition: 0.3s ease-in-out;
        }
        
        .default_btn:hover{
            cursor: pointer;
            background-color: var(--DEEPGREEN);
        }

        .update_btn{
            width: 90%;
            height: 10%;
            border: none;
            border-radius: 5px;
            position: absolute;
            bottom: 15px;
            left: 15px;
            background-color: var(--DEEPGREEN);
            color: rgb(240, 255, 242);
            font-size: 15px;
            transition: 0.3s ease-in-out;
        }
        .update_btn:hover{
            cursor:pointer;
            color: #085824;
            background-color: white;
            border: 1px solid #1fae51;

}
    </style>
</head>

<body>
<?php include "HAF/header.php" ?>
    <section>
        <div class="search">
            <h2>Find something delicious!</h2>
            <form action="clienthome.php?m=search">
            <input type="text" name="search" placeholder="search">
            </form>
        </div>
    </section>
    <div class="bodyContainer">
        <div class="category">
            <h3>Category</h3>
            <ul>
            <?php
                $i=0;
                while($i<$category_array_len){
                    
                    $c_name = $category_array[$i];
                    $c_id = $category_id_array[$i];
                    echo '
                    <li><a href="category.php?c_id='.$c_id.'">'.$c_name.'</a></li>
                    
                    ';
                    $i++;
                }
                    

                ?>

            </ul>
        </div>
        <section class="productShowcase" style="width: 100%;">
            <h2 class="entry-text"><?php  echo $cname; ?></h2>
            <div class="container">

            <?php
                 while($row = mysqli_fetch_assoc($category)){
                    $product_img_path = $row['product_img_path'];
                    $product_id = $row['product_id'];
                    $product_name = $row['product_name'];
                    $product_rate = $row['product_rate'];
                    $product_category_id = $row['product_category_id']; 
                    $product_description = $row['product_description'];

                    echo '<form action="backend/HandleIndex.php">
                    <input type="hidden" name="product_id" value="'.$product_id.'" >

                     <div class="image">
                         <img src="backend/'.$product_img_path.'" alt=""> 
                         <h3>'.$product_name.'</h3>
                         <p name="product_rate">Rs.'.$product_rate.'</p>';
                        

                         $flag = in_array($product_id, $cart_product_ids_array);
                         if($flag){
                            echo ' <input type = "submit" name="added" value="VIEW in CART" class="update_btn">';
                         }
                         else{
                             echo '<label>Qty:</label>
                             <input type="number" name="product_quantity" value="1" min="1" max="500">

                             <input type = "submit" name="add" value="ADD" class="default_btn">';
                         }
                          
                     echo '</div>
                        
                     </form>
                    
                ';
                        }
            ?>
                

              
            </div>
        </section>
    </div>
    <div class="pages">
       
    <?php
        //7.display the links to the page
        for($page=1;$page<=$number_of_pages;$page++)
        {
        // echo '<a href="clienthome.php?page='.$page.'">'.$page.'</a><br>';
        echo '<a href="clienthome.php?page='.$page.'"><button class="page_btn">'.$page.'</button></a><br>';

        }
?>
    </div>
    <?php include "HAF/footer.php" ?>
</body>
<script src="https://kit.fontawesome.com/f91eeebc13.js" crossorigin="anonymous"></script>

</html>