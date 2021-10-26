<?php require_once('../Controller/session.php');
    $userName = $_SESSION['userName'];
?>

<html>
    <head>
        <title>Post Story</title>
        <style><?php include '../CSS/post.css'; ?></style>
    </head>
    <body>
        <?php require_once('header.php'); ?>
        <div class="main_container">
            <div class="post">
                <h1>Post Story</h1>
                <form class="form_group" action="../Controller/storyupload.php" method="POST">
                    <input id="title" type="text" maxlength="60" minlength="1" name="title" placeholder="Story Title">
                    <textarea id="story" rows="30" minlength="60" name="story" placeholder="Write your story"></textarea>
                    <div class="button">
                        <input id="submit" type="submit" name="submit" value="Post">
                        <input id="reset" type="reset" name="reset" value="Rewrite">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>