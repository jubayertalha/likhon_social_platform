<?php require_once('../Controller/session.php');
    $userName = $_SESSION['userName'];
    require_once('../Controller/StoryCtr.php');
    require_once('../Controller/UserCtr.php');
    require_once('../Model/Story.php');
    require_once('../Model/User.php');
    $isOwner = false;
    $pic = "";
    $title = "";
    $storytext = "";
    $date = "";
    $id = "";
    $like = 0;
    $comment = 0;
    if(isset($_POST['id'])&&!empty($_POST['id'])){
        $id = htmlspecialchars($_POST['id']);
        $storyController = new StoryCtr($id);
        $valid = $storyController->checkStoryID();
        if(!$valid){
            header('location:../');
        }
        $story = $storyController->getStory();
        if($userName==$story->userName){
            $isOwner = true;
        }
        $userController = new UserCtr($story->userName);
        $user = $userController->getAllUserInfo();
        if(empty($user->pic)){
            $pic = "../Pic/avatar.png";
        }else{
            $pic = "../Pic/$user->userName/$user->pic";
        }
        $reactList = $storyController->getLikeInfo();
        $like = count($reactList);
        $likeTxt = "Like";
        foreach($reactList as $react){
            if($userName==$react){
                $likeTxt = "Unlike";
            }
        }
        $comment = $storyController->getCommentInfo();
        $day = date('h:i A M d Y',strtotime($story->date));
        $storyLoc = "../Story/$story->userName/$id".".json";
        $file = fopen($storyLoc, "r");
        $post = json_decode(fread($file,filesize($storyLoc)));
        $title = $post->title;
        $storytext = $storyController->substrwords($post->story,300);
        $edit = '';
        $date = new DateTime(); 
        $time = $date->format('YmdHis'); 
        $src = $pic."?=".$time;
        if($isOwner){ $edit = '<a id="storyedit" href="#">Edit</a>';}
        $d = "'".$id."'";
        $data = '
            <div class="story">'
                .$edit.'
                <div class="storycover">
                    <h3 id="title">'.$title.'</h3>
                    <a id="writerimage" href="/View/profile.php?id='.$story->userName.'"><img src="'.$src.'" alt="Profile Image"></a>
                </div>
                <h id="date">'.$day.'</h>
                <p id="storytext">'.$storytext.'</p>
                <div id="storyInfo">
                    <h>Likes.</h>
                    <h id="like'.$id.'">'.$like.'</h>
                    <h>Comments.</h>
                    <h id="comment'.$id.'">'.$comment.'</h>
                </div>
                <div class="bottom_menu">
                    <ul>
                        <li id="'.$id.'" onclick="like(this.id)">'.$likeTxt.'</li>
                        <li onclick="details('.$d.')">Comment</li>
                        <li onclick="details('.$d.')">Read More</li>
                    </ul>
                </div>
            </div>
        ';
        echo $data;
    }else{
        header('location:../');
    }
?>