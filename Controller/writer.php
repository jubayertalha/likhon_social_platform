<?php require_once('../Controller/session.php');
    $userName = $_SESSION['userName'];
    require_once('../Controller/UserCtr.php');
    require_once('../Model/User.php');
    if(isset($_POST['id'])&&!empty($_POST['id'])){
        $id = htmlspecialchars($_POST['id']);
        $userController = new UserCtr($userName);
        $userList = $userController->search($id);
        $writerList = array();
        foreach($userList as $user){
            $uName  = $user->userName;
            $fullName = $user->fullName;
            $pic = "";
            if(empty($user->pic)){
                $pic = "../Pic/avatar.png";
            }else{
                $pic = "../Pic/$user->userName/$user->pic";
            }
            $date = new DateTime(); 
            $time = $date->format('YmdHis'); 
            $src = $pic."?=".$time;
            $followers = $userController->getFollowerNo($uName);
            $following = $userController->getFollowingNo($uName);
            $isFollowing = $userController->isFollowing($uName);
            $u = "'".$uName."'";

            $data = '
            
                <div class="card">
                    <img onclick="details('.$u.')" src="'.$src.'" alt="Profile Image"></a>
                    <div class="name" onclick="details('.$u.')">
                        <h id="fullName">'.$fullName.'</h>
                        <h id="userName">'.$uName.'</h>
                    </div>
                    <div class="info" onclick="details('.$u.')">
                        <div class="follower">
                            <h>Followers: </h><h id="f'.$uName.'">'.$followers.'</h>
                        </div>
                        <h id="following">Following:'.$following.'</h>
                    </div>
                    <div class="button" onclick="follow('.$u.')">
                        <h id="'.$uName.'">'.$isFollowing.'</h>
                    </div>
                </div>
            
            ';

            array_push($writerList,$data);

            echo $data;

        }
    }
    
?>