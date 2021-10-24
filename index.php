<?php session_start();
    if(isset($_SESSION['userName'])){
        header('location:View/home.php');
    }
?>

<html>
    <head>
        <title>Likhon</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style><?php include 'CSS/style.css'; include 'CSS/index.css'; include 'CSS/stylehf.css'; ?></style>
    </head>
    <body>
        <?php require_once('View/header_login.php');?>
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