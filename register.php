<?php include "init.php" ?>
<?php
$flag = 0;
if(isset($_REQUEST['create'])){
    $name          =$_REQUEST['name'];
   $phone    =$_REQUEST['phone'];
   $email    =$_REQUEST['email'];
  
     $password =$_REQUEST['password'];

    // die("stop");
    $repassword    =$_REQUEST['repassword'];
    $query = "SELECT register_email FROM tblregister WHERE register_email = '$email'";
    $result = runQuery($query);
   $result = mysqli_num_rows($result);
    // die("stop");

    if($password != $repassword || $name == "" || $email == "" || $password == ""){
        $flag = 1;
    }
    else if($result == 1){
        $flag = 2;
    }
    else{
        $query = "INSERT INTO `tblregister`(`register_name`, `register_contact_no`, `register_email`, `register_password`) VALUES ('$name', '$phone', '$email', '$password')";
        runQuery($query);
        header('location:login.php');
    }
   
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Now</title>
    <link rel="stylesheet" href="style/register.css">
    <link rel="stylesheet" href="style/global.css">
</head>
<body>
    <div class="container">
        <div class="image">
            <h1>NamesteFood</h1>
            <p>We know how to make your day!</p>
            <img src="style/images/undraw_tasting_re_fv9d (1).svg" alt="image">
        </div>
        <div class="container_form">
            <h2>Create Account</h2><br>
            <form action="" class="form">
                <?php

                if($flag == 1){
                    echo 
                    '<div class="messageBox">
                    <p>Something went wrong!</p>
                    <p>Check the form information before submitting!</p>
                    </div>
                    '
                    ;
                }
                else if($flag ==2){
                    echo 
                    '<div class="messageBox">
                  
                    <p>Email:'.$email.'</p>
                    <p> is already added!</p>
                    <p>Please try with different email address.</p>
                    </div>
                    '
                    ;
                }
                ?>
                
                <label class="fName" for="">Full Name</label>
                <input type="text" placeholder="" name="name">

                <!-- <label class="sName" for="">Second Name</label>
                <input type="text" placeholder=""> -->

                <label class="phoneNo" for="">Phone No</label>
                <input type="text" placeholder="" name="phone">

                <label class="email" for="">Email</label>
                <input type="email" placeholder="" class="email_Input" name="email">

           

                <label>Password</label>
                <input type="password" name="password">

                <label>Repeat Password</label>
                <input type="password" name="repassword">

                <input type="submit" value="CREATE" name="create">
                
            </form>
            
            <a href="login.php">I have already created an account</a>
        </div>
    </div>
</body>
</html>