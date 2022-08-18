<?php
    $conn = mysqli_connect("localhost", "root","","myfoodorder");
    if($conn){
        //echo "Success DB Connection!";
    }else{
        echo die("Failed").mysqli_connect_error();
       
    }


?>