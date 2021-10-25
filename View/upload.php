<?php
    require_once('../Controller/session.php');
    $userName = $_SESSION['userName'];
    require_once('../Controller/UserCtr.php');
    require_once('../Model/User.php');
    $userController = new UserCtr($userName);
    $user = $userController->getAllUserInfo();
    $pic = "";
    $picName = "";
    if(empty($user->pic)){
        $pic = "../Pic/avatar.png";
    }else{
        $pic = "../Pic/$user->userName/$user->pic";
        $picName = $user->pic;
    }
    $msg = "";
    $oldPic = $pic;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $fileName = $_FILES['file']['name'];
        $fileType = $_FILES['file']['type'];
        $fileSize = $_FILES['file']['size'];
        $fileTempLoc = $_FILES['file']['tmp_name'];

        $targeteLoc = "../Pic/$user->userName/";

        if(!empty($fileName)){
            if($fileType === "image/jpeg" || $fileType == "image/png"){
                if($fileSize<=5000000){
                    $picName = "propic.".pathinfo($fileName,PATHINFO_EXTENSION);
                    $pic = $targeteLoc.$picName;
                    if(!file_exists($targeteLoc)){
                        mkdir($targeteLoc,0777,true);
                        chmod($targetLoc, 0777);
                    }
                    if(file_exists($oldPic)){
                        unlink($oldPic);
                    }
                    move_uploaded_file($fileTempLoc, $pic);
                    chmod($pic, 0777);
                }else{
                    $msg = "Select lower file size";
                }
            }else{
                $msg = "Select jpeg or png file";
            }
        }else{
            $msg = "Select a file";
        }
    }
?>

<html>
    <head>
        <title>Uplad</title>
        <style><?php include '../CSS/style.css'; include '../CSS/upload.css'; ?></style>
    </head>
    <body>
        <?php require_once('header.php'); ?>
        <div class="main_container">
            <div class="upload">
                <div class="title">
                    <h1>Upload</h1>
                    <a href="../View/profile.php">Cancel</a>
                </div>
                <div class="holder">
                    <img id="image" src="<?php $date = new DateTime(); $time = $date->format('YmdHis'); echo $pic."?=".$time; ?>" alt="Profile Image">
                    <div class="button">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                            <input type="file" name="file">
                            <h><?php echo $msg; ?></h>
                            <input type="submit" value="Upload">
                        </form>
                        <form id="save" action="/Controller/picupload.php" method="POST">
                            <button id="submit" type="submit" name="submit" value="<?php echo $picName; ?>">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>