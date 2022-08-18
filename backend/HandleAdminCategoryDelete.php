<?php  include '../init.php' ?>

<?php
// echo "del"; 

$c_id = $_REQUEST['c_id'];
$query = "DELETE FROM tblproduct WHERE product_category_id = '$c_id'";
runQuery($query);
$query = "DELETE FROM tblcategory WHERE category_id = $c_id";
runQuery($query);



?>
<html>
<head>
    <style>
        body{
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
        }
        
    </style>
</head>
<body>
    <?php

        if($result){
            header('location:../adminCategoryManage.php');
        }else{
            echo "<h1>Can 't delete, this category is in use!";
            echo '<br><a href="../adminCategoryManage.php">GO BACK</a>';
        }

    ?>
</body>
</html>