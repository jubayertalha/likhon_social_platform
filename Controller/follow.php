<?php require_once('../Controller/session.php');
    $userName = $_SESSION['userName'];
    require_once('../Controller/UserCtr.php');
    if(isset($_POST['id'])&&!empty($_POST['id'])&&isset($_POST['type'])&&!empty($_POST['type'])){
        $id = htmlspecialchars($_POST['id']);
        $type = htmlspecialchars($_POST['type']);
        $userController = new UserCtr($userName);
        if($type=="follow"){
            $userController->follow($id);
        }else{
            $userController->unfollow($id);
        }
    }
?>