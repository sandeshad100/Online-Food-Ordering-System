<?php include "../init.php" ?>

<?php
if(isset($_REQUEST['submit'])){
   
    echo $product_name        = $_REQUEST['product_name'];
    echo $product_rate        = $_REQUEST['product_rate'];
    echo $product_description = $_REQUEST['product_description'];
    echo "<br>";
    echo $product_category_id    = $_REQUEST['product_category'];


    //image
    echo "<br>";
    // print_r($_POST["uploadfile"]);
    // die("<br>stpped");
    echo $filename = $_FILES["uploadfile"]["name"]; //fileName
    echo "<br>";
    echo $tempname = $_FILES["uploadfile"]["tmp_name"]; //fullPath
    echo "<br>";
    $folder = "productImages/" . $filename;
    move_uploaded_file($tempname, $folder);
    echo "<br>";
 



      //find category id
    


      $query = "INSERT INTO tblproduct(product_name,product_img_path, product_rate, product_description,product_category_id) 
      VALUES('$product_name','$folder','$product_rate','$product_description',    '$product_category_id')";
      if(runQuery($query)){
          header('location:../adminProductManage.php');
      }

}


?>