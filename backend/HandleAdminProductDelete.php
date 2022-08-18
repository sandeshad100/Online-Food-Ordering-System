<?php  include '../init.php' ?>

<?php
// echo "del"; 
$product_id = $_REQUEST['product_id'];
$query = "DELETE FROM tblproduct WHERE product_id = $product_id";
// $result = mysqli_query($conn, $query);
// if($result)
// {
//     echo "Success query";
// }else
// {
//     echo "failed query";
// }

if(runQuery($query)){
    header('location:../adminProductManage.php');
}
?>