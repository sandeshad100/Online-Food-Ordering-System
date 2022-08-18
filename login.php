<?php include "init.php" ?>
<?php
  $flag = 0;
    if(isset($_REQUEST['u'])){
    if($_REQUEST['u'] == "0")//log out user
    {

    
    session_destroy();
    header('location:login.php');

   }
   if($_REQUEST['u'] == "1"){
       //echo "from admin";
        session_destroy();
        header('location:login.php');
   }
}

if(isset($_REQUEST['login']))
{

  echo   $email    =$_REQUEST['email'];
  echo "<br>";
  echo $password   =$_REQUEST['password'];
  echo "<br>";

 
    $query = "SELECT * FROM `tblregister` WHERE register_email = '$email' && register_password = '$password' ";
    $result = runQuery($query);
    $total  = mysqli_num_rows($result);
    if(!($total >= 1)){
       $flag = 1;
    }
    else
    {
        $row = mysqli_fetch_assoc($result);
         $isAdmin = $row['user_type'];
       
        $_SESSION['user_id']     = $row['register_id'];
        $_SESSION['user_email']  = $email;
        if($isAdmin == 1){
            
            $_SESSION['admin_email'] = $row['register_email'];
            header('location:adminHome.php');
            
        }
        else{
            $_SESSION['firstLogin']  = "Login successful!";
            header('location:clienthome.php');
        }
      
    }
       

    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/login.css">
    <link rel="stylesheet" href="style/global.css">
</head>
<body>
    <div class="container">
        <div class="image">
            <h1>NamasteFood</h1>
            <p>We know how to make your day!</p>
            <img src="style/images/undraw_tasting_re_fv9d (1).svg" alt="image">
        </div>
        <div class="container_form">
        <?php

if($flag == 1){
    echo 
    '<div class="messageBox">
    <p>Invalid login information!</p>
    <p>Check the form information before submitting!</p>
    
    </div>'
    ;
}
?>
            <h2>Login</h2><br>
            
            <form action="#" class="form">

                <label class="email" for="">Email</label>
                <input type="email" placeholder="" class="email_Input" name = "email">

                <label>Password</label>
                <input type="password" name = "password">

                <input type="submit" value="LOGIN" name="login">

            <p>OR</p>
            
            </form>
            <button class="create_btn"><a href="register.php">Create Account</a></button>
        </div>
    </div>
</body>
</html>