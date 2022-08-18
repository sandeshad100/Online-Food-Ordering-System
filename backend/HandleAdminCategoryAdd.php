<?php include "../init.php" ?>

<?php

if(isset($_REQUEST['add'])){
  $category_name  = $_REQUEST['category_name'];
  $category_description = $_REQUEST['category_description'];

//   print_r($_REQUEST);
$query = "INSERT INTO `tblcategory`(`category_name`, `category_description`) VALUES ('$category_name','$category_description')";

$result = runQuery($query);

if($result) 
{
  header('location:../adminCategoryManage.php');
}



}

?>