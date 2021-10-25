<?php require_once('session.php');
    require_once('DBCtr.php');
    $userName = $_SESSION['userName'];
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['submit'])&&!empty($_POST['submit'])){
            $pic = $_POST['submit'];
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "UPDATE users SET pic = '$pic' WHERE user_name = '$userName';";
            if($conn->query($sql)===TRUE){
                header('location:../View/profile.php');
            }else{
                header('location:../View/upload.php');
            }
        }else{
            header('location:../View/upload.php');
        }
    }else{
        header('loaction:../View/upload.php');
    }
?>