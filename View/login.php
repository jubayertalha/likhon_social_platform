<?php
    require_once('../Controller/LoginCtr.php');
    $userName = "";
    $pass = "";
    $data = [
        'userNameErr' => "",
        'passErr' => "",
        'status' => "incomplete"
    ];
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $pass = $_POST['pass'];
        $userName = $_POST['userName'];
        $loginCtr = new LoginCtr($userName,$pass);
        $data = $loginCtr->login();
        if($data['status']!="incomplete"){
            setcookie("userName",$userName,time()+86400,'/');
        }
    }
?>

<html>
    <head>
        <title>Likhon || Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../CSS/style.css">
        <link rel="stylesheet" type="text/css" href="../CSS/lrform.css">
    </head>
    <body>
        <?php require_once('header_login.html');?>
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