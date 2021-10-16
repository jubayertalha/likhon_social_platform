<?php
    if(isset($_COOKIE['userName']) && !empty($_COOKIE['userName'])){
        header('location:View/home.php');
    }
?>

<html>
    <head>
        <title>Likhon</title>
    </head>
    <body style="margin:50">
        <h1>Welcome to LIKHON</h1>
        <a href="View/login.php"><button>Login</button></a>
        or 
        <a href="View/registration.php"><button>Register</button></a>
    </body>
</html>