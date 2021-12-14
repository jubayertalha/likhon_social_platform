<?php require_once('../Controller/session.php');
    $userName = $_SESSION['userName'];
?>

<html>
    <head>
        <title><?php echo $userName; ?></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style><?php include '../CSS/storycard.css';include '../CSS/profile.css'; ?></style>
    </head>
    <body>
        <?php require_once('header.php'); ?>
        <div class="main_container">
            <div class="profile">
                <?php
                    $_POST['id'] = "home";
                    $_POST['writer'] = $userName;
                    include('../View/storylist.php');
                ?>
            </div>
        </div>
    </body>
</html>