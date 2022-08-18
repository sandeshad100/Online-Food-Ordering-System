<?php
include 'db.php';
session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}
//turn off error messages:
error_reporting(0);


//run query
function runQuery($query){
    global $conn;
  
    $res = mysqli_query($conn, $query);

    if($res)
    {
        // echo "Success query";
        return $res;
    }
    else
    {
        echo mysqli_error($conn);
        
    }
}
?>