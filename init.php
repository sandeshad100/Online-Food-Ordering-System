<?php
include 'db.php';
session_start();


if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}

//turn off error messages:
// error_reporting(0);


//to fetch category id
$category_id_array = array();
$query             = "SELECT * FROM tblcategory";
$result            = runQuery($query);

$category_id_array = array();
while($row = mysqli_fetch_assoc($result)){
    $category_id = $row['category_id'];
    array_push($category_id_array, $category_id);

}

$category_array_id_len = count($category_id_array);



//to fetch category name:
//sql query
$query = "SELECT category_name FROM tblcategory";
//run sql query
$category_result = mysqli_query($conn, $query);
if($category_result){
    //echo "<br>";
    //echo "Success query";
}
else{
    die ("Display failed".mysqli_error($conn));
}
//to store category name in a array
$category_array = array();
while($row = mysqli_fetch_assoc($category_result)){
    $category_name = $row['category_name'];
    array_push($category_array, $category_name);

}
$category_array_len = count($category_array);



//run query
function runQuery($query){
    global $conn;
    //echo "<br>Query function:";
    $res = mysqli_query($conn, $query);
    //echo "<br>";
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

//show data
function show($var){
echo "<pre>";
    print_r($var);
echo "</pre>";
}

//order Status

//fetch order status ids and name
$order_status_id_array = array();
$order_status_name_array = array();

$query = "SELECT * FROM tblorder_status";
$result = runQuery($query);

while($row = mysqli_fetch_assoc($result)){

    $id = $row['status_id'];
    $name = $row['status_name'];

    array_push($order_status_id_array, $id);
    array_push($order_status_name_array, $name);

}

$order_status_len = count($order_status_id_array);


//pagination
$number_of_pages;
function pages($query, $len){
    $results_per_page = $len;
   // $query = "SELECT * FROM `tblproduct`";
    $query = runQuery($query);
    
    //determint current page
    if(!isset($_REQUEST['page'])){
        $page = 1;
        
    }else{
        $page = $_GET['page'];
    }
     //8.determine the sql limit starting number for the result on the displaying page
     $this_page_first_result = ($page-1) * $results_per_page;

     $query = "SELECT * FROM `tblproduct` LIMIT " . $this_page_first_result . ',' . $results_per_page;
    // $query .= $q2;
    // die("stop");
     return $query;
}
//to return no of pages
function pages_no($query, $len){

    $results_per_page = $len;
   
    $query = runQuery($query);
    //total no of rows
    $number_of_results = mysqli_num_rows($query);
    //6.determin number of pages available
    $number_of_pages = ceil($number_of_results/$results_per_page);
    return $number_of_pages;
}



?>