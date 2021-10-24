<?php session_start();
    if(isset($_SESSION['userName'])){
        header('location:home.php');
    }
?>
<?php
    require_once('../Controller/LoginCtr.php');
    $userName = "";
    $pass = "";
    $data = [
        'userNameErr' => "",
        'passErr' => "",
        'status' => "incomplete"
    ];
    if(isset($_COOKIE['userName'])){
        $userName = $_COOKIE['userName'];
        $pass = $_COOKIE['pass'];
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $pass = $_POST['pass'];
        $userName = $_POST['userName'];
        $loginCtr = new LoginCtr($userName,$pass);
        $data = $loginCtr->login();
        if($data['status']!="incomplete"){
            if(isset($_POST['rem'])){
                setcookie("userName",$userName,time()+86400,'/');
                setcookie("pass",$pass,time()+86400,'/');
            }
            $_SESSION['userName'] = $userName;
        }
    }
?>

<html>
    <head>
        <title>Likhon || Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style><?php include '../CSS/style.css'; include '../CSS/lrform.css'; ?></style>
    </head>
    <body>
        <?php require_once('header_login.php');?>
        <div class="main_container">
        <div class="form_container">
        <div class="title">
        <h1>Login</h1>
        <a href="/">Back</a>
        </div>
        <?php if($data['status']=="incomplete"){ ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <input type="text" name="userName" placeholder="User Name *" value="<?php echo $userName;?>">
            <label style="color:red;"><?php echo $data['userNameErr'];?></label>

            <input type="password" name="pass" placeholder="Password *" value="<?php echo $pass;?>">
            <label style="color:red;"><?php echo $data['passErr'];?></label>

            <input type="submit" name="submit" value="Login">
            <div class="remember">
                <input type="checkbox" name="rem">
                <h>Remember me</h>
            </div>
            </form>
            
            <div class="bottom">
            <h>Don't have an account?</h>
            <a href="registration.php">Register Now</a>
            </div>
        <?php } else{ ?>
            <h3>Login Complete</h3><br>
            <a id="back" href="\">Go to home</a>
        <?php } ?>
        </div>
        </div>
    </body>
</html>