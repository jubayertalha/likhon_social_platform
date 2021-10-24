<?php session_start();
    if(isset($_SESSION['userName'])){
        header('location:home.php');
    }
?>
<?php
    require_once('../Controller/RegistrationCtr.php');
    $user = new User("","","","","","","");
    $data = [
        'fullNameErr' => "",
        'userNameErr' => "",
        'emailErr' => "",
        'dobErr' => "",
        'passErr' => "",
        'cpassErr' => "",
        'picErr' => "",
        'genderErr' => "",
        'agreeErr' => "",
        'status' => "incomplete"
    ];
    $cpass = "";
    $gender = "";
    $agree = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $cpass = $_POST['cpass'];
        if(isset($_POST['gender'])){
            $gender = $_POST['gender'];
        }
        if(isset($_POST['agree'])){
            $agree = $_POST['agree'];
        }
        $user = new User($_POST['fullName'],$_POST['userName'],$_POST['email'],$gender,$_POST['dob'],$_POST['pass'],"");
        $regCtr = new RegistrationCtr($user,$cpass,$agree);
        $data = $regCtr->register();
    }
?>

<html>
    <head>
        <title>Likhon || Registration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style><?php include '../CSS/style.css'; include '../CSS/lrform.css'; ?></style>
    </head>
    <body>
        <?php require_once('header_login.php');?>
        <div class="main_container">
        <div class="form_container">
        <div class="title">
        <h1>Registration</h1>
        <a href="/">Back</a>
        </div>
        <?php if($data['status']=="incomplete"){ ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		    <input type="text" name="fullName" placeholder="Full Name *" value="<?php echo $user->fullName;?>">
            <label style="color:red;"><?php echo $data['fullNameErr'];?></label>
            
            <input type="text" name="userName" placeholder="User Name *" value="<?php echo $user->userName;?>">
            <label style="color:red;"><?php echo $data['userNameErr'];?></label>

            <input type="email" name="email" placeholder="Email *" value="<?php echo $user->email;?>">
            <label style="color:red;"><?php echo $data['emailErr'];?></label>

            <input type="password" name="pass" placeholder="Password *" value="<?php echo $user->pass;?>">
            <label style="color:red;"><?php echo $data['passErr'];?></label>

            <input type="password" name="cpass" placeholder="Confirm Password *" value="<?php echo $cpass;?>">
            <label style="color:red;"><?php echo $data['cpassErr'];?></label>
            <div class="gender">
            Gender*:
            <input type="radio" name="gender"
            <?php if (isset($user->gender) && $user->gender=="Female") echo "checked";?>
            value="Female">Female
            <input type="radio" name="gender"
            <?php if (isset($user->gender) && $user->gender=="Male") echo "checked";?>
            value="Male">Male
            <input type="radio" name="gender"
            <?php if (isset($user->gender) && $user->gender=="Other") echo "checked";?>
            value="Other">Other
            </div>
            <label style="color:red;"><?php echo $data['genderErr']; ?></label><br>

            Date of Birth*: 
            <input type="date" name="dob" placeholder="Date of Birth" value="<?php echo $user->dob;?>">
            <label style="color:red;"><?php echo $data['dobErr'];?></label>
            
            <div class="agree">
            Agree to Terms of Service*:
            <input type="checkbox" name="agree" value="agree">
            </div>
            <label style="color:red;"><?php echo $data['agreeErr'];?></label>
            
            <input type="submit" name="submit" value="Register">
            </form>
        <?php } else{ ?>
            <h3>Registration Complete</h3>
            <a id="back" href="\">Go to home</a>
        <?php } ?>
        </div>
        </div>
    </body>
</html>