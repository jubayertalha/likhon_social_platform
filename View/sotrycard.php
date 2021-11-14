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
    if(isset($_GET['id'])&&!empty($_GET['id'])){
        $id = htmlspecialchars($_GET['id']);
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
        $day = date('h:i A M d Y',strtotime($story->date));
        $storyLoc = "../Story/$story->userName/$id".".json";
        $file = fopen($storyLoc, "r");
        $post = json_decode(fread($file,filesize($storyLoc)));
        $title = $post->title;
        $storytext = $storyController->substrwords($post->story,300);
    }else{
        header('location:../');
    }
?>

<html>
    <body>
            <div class="story">
                <?php if($isOwner){?><a id="storyedit" href="#">Edit</a><?php } ?>
                <div class="storycover">
                    <h3 id="title"><?php echo $title ?></h3>
                    <a id="writerimage" href="/View/profile.php?id=<?php echo $story->userName;?>"><img src="<?php $date = new DateTime(); $time = $date->format('YmdHis'); echo $pic."?=".$time; ?>" alt="Profile Image"></a>
                </div>
                <h id="date"><?php echo $day ?></h>
                <p id="storytext"><?php echo $storytext ?></p>
                <div class="bottom_menu">
                    <ul>
                        <li id="<?php echo $id; ?>" onclick="like(this.id)">Like</li>
                        <li>Comment</li>
                        <li>Read More</li>
                    </ul>
                </div>
            </div>
    </body>
</html>