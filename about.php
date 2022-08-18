 <?php 
 include "init.php";
 ?> 
 <?php
if(!isset($_SESSION['user_email'])){
  header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <link rel="stylesheet" href="style/global.css">
    <link rel="stylesheet" href="HAF/style/header.css">
    <link rel="stylesheet" href="HAF/style/footer.css">
    <link rel="stylesheet" href="style/about.css">

     <!-- font awesome cdn -->
     <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
     <link rel="stylesheet" href="assets/fontawesome-free-6.1.1-web/css/all.min.css">
     <link rel="stylesheet" href="assets/fontawesome-free-6.1.1-web/css/fontawesome.min.css">
    <title>Document</title>
</head>
<body>
    
<?php include "HAF/header.php" ?>
    <div class="container">
        <div class="imageBox">
          <img src="images/pexels-pixabay-260922.jpg" alt="image">
          <div class="centered">
            <h1>NamasteFood</h1>
            <p>We know how to make your day!</p>
          </div>
         
        </div>
        <div class="textBox">
            <p>Since 1996</p>
        </div>
    </div>
    <?php include "HAF/footer.php" ?>
</body>
</html>