<?php
    require_once('../Controller/session.php');
    $userName = $_SESSION['userName'];
    require_once('../Controller/UserCtr.php');
    require_once('../Model/User.php');
    $userController = new UserCtr($userName);
    $user = $userController->getAllUserInfo();
    $pic = "";
    if(empty($user->pic)){
        $pic = "../Pic/avatar.png";
    }else{
        $pic = "../Pic/$user->userName/$user->pic";
    }
    $dob = date('F j, Y',strtotime($user->dob));
?>

<html>
    <head>
        <title><?php echo $userName; ?></title>
        <style><?php include '../CSS/style.css'; include '../CSS/profile.css'; ?></style>
    </head>
    <body>
        <?php require_once('header.php'); ?>
        <div class="main_container">
            <div class="profile">
                <div class="cover">
                    <div class="pic">
                    <img id="image" src="<?php $date = new DateTime(); $time = $date->format('YmdHis'); echo $pic."?=".$time; ?>" alt="Profile Image">
                        <a id="change" href="../View/upload.php">Change Pic</a>
                    </div>
                    <div class="info">
                        <h2><?php echo $user->fullName; ?></h2>
                        <div class="other">
                            <h>User: <?php echo $user->userName; ?></h>
                            <h>Gender: <?php echo $user->gender; ?></h>
                            <h>Date of Birth: <?php echo $dob; ?></h>
                            <h>Email: <?php echo $user->email; ?></h>
                        </div>
                    </div>
                    <a id="edit" href="#">Edit</a>
                </div>
            </div>
        </div>
    </body>
</html>