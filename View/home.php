<?php 
    if(isset($_GET['submit'])){
        setcookie("userName","",time()-86400,'/');
        header('location:../index.php');
    }
?>

<html>
    <head>
        <title>Likhon</title>
    </head>
    <body style="margin:50">
        <h1>Welcome <?php echo $_COOKIE['userName']?></h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="GET">
            <input type="submit" name="submit" value="Logout">
        </form>
    </body>
</html>