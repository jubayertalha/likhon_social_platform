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
        $userController = new UserCtr($userName);
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
        $storytext = $post->story;
    }else{
        header('location:../');
    }
?>

<html>
    <head>
        <title><?php echo $title; ?></title>
        <style><?php include '../CSS/story.css'; ?></style>
    </head>
    <body>
        <?php require_once('header.php'); ?>
        <div class="main_container">
            <div class="story">
                <?php if($isOwner){?><a id="edit" href="#">Edit</a><?php } ?>
                <div class="cover">
                    <h3 id="title"><?php echo $title ?></h3>
                    <a id="image" href="/View/profile.php?id=<?php echo $story->userName;?>"><img src="<?php $date = new DateTime(); $time = $date->format('YmdHis'); echo $pic."?=".$time; ?>" alt="Profile Image"></a>
                </div>
                <h id="date"><?php echo $day ?></h>
                <p id="storytext"><?php echo $storytext ?></p>
            </div>
        </div>
    </body>
</html>