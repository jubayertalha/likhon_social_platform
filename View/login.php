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
    </head>
    <body style="margin:50">
        <h1>Login</h1>
        <?php if($data['status']=="incomplete"){ ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <input type="text" name="userName" placeholder="User Name *" value="<?php echo $userName;?>">
            <label style="color:red;"><?php echo $data['userNameErr'];?></label><br><br>

            <input type="password" name="pass" placeholder="Password *" value="<?php echo $pass;?>">
            <label style="color:red;"><?php echo $data['passErr'];?></label><br><br>

            <input type="submit" name="submit" value="Login">
            </form>
        <?php } else{ ?>
            <h3>Login Complete</h3><br>
            <a href="\">Go to home</a>
        <?php } ?>
    </body>
</html>