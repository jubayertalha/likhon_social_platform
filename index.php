<?php
    
    if(isset($_COOKIE['userName']) && !empty($_COOKIE['userName'])){
        header('location:View/home.php');
    }
?>

<html>
    <head>
        <title>Likhon</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../CSS/style.css">
        <link rel="stylesheet" type="text/css" href="../CSS/index.css">
    </head>
    <body>
        <?php require_once('View/header_login.html');?>
        <div class = "main_container">
            <div class="welcome">
                <h1>Welcome to Likhon</h1>
                <p>Let your story reach the world. Write, Share & Enjoy!</p>
                <div class="button">
                <a href="View/login.php">Login</a>
                or 
                <a href="View/registration.php">Register</a>
                </div>
            </div>
        </div>
    </body>
</html>