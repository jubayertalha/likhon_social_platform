<?php session_start();
    $userName = $_SESSION['userName'];
?>
<html>
    <head>
        <style><?php include '../CSS/stylehf.css'; ?></style>
    </head>
    <body>
        <div class="header">
        <a id="home" href="/View/home.php">Likhon</a>
        <div class="left">
            <ul>
                <li><a href="/View/home.php">Home</a></li>
                <li><a href="/View/post.php">Post</a></li>
                <li><a href="#">Writers</a></li>
            </ul>
        </div>
        <div class="right">
            <ul>
                <li><a href="/View/profile.php"><?php echo $userName;?></a></li>
                <li><a href="/Controller/logout.php">Logout</a></li>
            </ul>
        </div>
        </div>
    </body>
</html>