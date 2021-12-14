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
        $storytext = $post->story;
    }else{
        header('location:../');
    }
?>

<html>
    <head>
        <title><?php echo $title; ?></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                <div id="storyInfo">
                    <h>Likes.</h>
                    <h id="like"><?php echo $like; ?></h>
                    <h>Comments.</h>
                    <h id="comment"><?php echo $comment; ?></h>
                </div>
                <div class="bottom_menu">
                    <ul id="<?php echo $id; ?>" onclick="like(this.id)">
                        <li id="text"><?php echo $likeTxt; ?></li>
                    </ul>
                </div>
                <div class="comment_box">
                    <textarea id="eComment" rows="4" minlength="1" placeholder="Write your Comment"></textarea>
                    <button id="sComment">Comment</button>
                </div>
            </div>
        </div>
        <script>
            function like(id){
                var text = document.getElementById("text").innerHTML;
                if(text.toString()=="Like"){
                    document.getElementById("text").innerHTML = "Unlike";
                    var like = document.getElementById("like").innerHTML;
                    like++;
                    document.getElementById("like").innerHTML = like;
                    $.post("../Controller/react.php",
                        {
                            id : id,
                            type: "Like"
                        }
                    );
                }else{
                    document.getElementById("text").innerHTML = "Like";
                    var like = document.getElementById("like").innerHTML;
                    like--;
                    document.getElementById("like").innerHTML = like;
                    $.post("../Controller/react.php",
                        {
                            id : id,
                            type: "Unlike"
                        }
                    );
                }
            }
        </script>
    </body>
</html>