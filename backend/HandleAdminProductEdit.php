<?php include '../init.php'?>

<?php
if (isset($_REQUEST['submit'])) {
//temp
//real code:

    echo $product_id = $_REQUEST['product_id'];
    echo $product_name = $_REQUEST['product_name'];
    echo $product_rate = $_REQUEST['product_rate'];
    echo $product_description = $_REQUEST['product_description'];
    echo "<br>c-id = ";
    echo $product_category = $_REQUEST['product_category'];

    //images
    $hasImage = 0;
    echo $filename = $_FILES["uploadfile"]["name"];
    if ($filename == "") {
        $hasImage = 0;
    } else {
        $hasImage = 1;
    }
    if($hasImage){
        echo "<br>" . $hasImage;
        echo $filename = $_FILES["uploadfile"]["name"]; //fileName
        echo "<br>";
        echo $tempname = $_FILES["uploadfile"]["tmp_name"]; //fullPath
        echo "<br>";
    
        $folder = "productImages/" . $filename;
        move_uploaded_file($tempname, $folder);
        echo "<br>";
    }
   

    //find category id
    // echo "<br>";
    // $i = 0;
    // $product_category_id = 0;
    // while ($i < $category_array_len) {
    //     if ($product_category == $category_array[$i]) {
    //         $product_category_id = $i + 1;
    //         break;
    //     }
    //     $i++;
    // }
    echo $product_category_id = $product_category;

    if ($hasImage) {//with image selected
        $query = "UPDATE tblproduct SET product_name  = '$product_name', product_rate = '$product_rate', product_category_id = '$product_category_id', product_description = '$product_description',product_img_path = '$folder'  where product_id = '$product_id' ";

    } else { //if image file not choosen
        $query = "UPDATE tblproduct SET product_name  = '$product_name', product_rate = '$product_rate', product_category_id = '$product_category_id', product_description = '$product_description'  where product_id = '$product_id' ";
    }

    // run SQL query
    $update_result = mysqli_query($conn, $query);
    if ($update_result) {
        echo "Success update";
        header("location: ../adminProductManage.php");
    } else {
        die('Query FAILED' . mysqli_error($conn));

    }
}

?>