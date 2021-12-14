<?php require_once('../Controller/session.php');
    $pic = "../Pic/avatar.png";
?>

<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Writers</title>
        <style><?php include '../CSS/writer.css'; ?></style>
    </head>
    <body>
        <?php require_once('header.php'); ?>
        <div class="main_container">
            <div class="search">
                <input type="text" placeholder="Search"></textarea>
            </div>
            <div class="writer"><h2>Search Writers By Name or ID</h2></div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            $("input").keydown(function (){
                var text = $(this).val();
                $(".writer").load("../Controller/writer.php",
                    {
                        id : text
                    }
                );
            });
        });
        function details(userName){
            let protocol = location.protocol;
            let hostname = location.hostname;
            let url = protocol+"//"+hostname+"/View/profile.php?id="+userName;
            console.log(url);
            window.open(url,"_self");
        }
        function follow(userName){
            var noE = document.getElementById("f"+userName);
            var no = noE.innerHTML;
            var textE = document.getElementById(userName);
            var text = textE.innerHTML;
            if(text.toString()=="Follow"){
                textE.innerHTML = "Unfollow";
                no++;
                noE.innerHTML = no;
                $.post("../Controller/follow.php",
                    {
                        id : userName,
                        type: "follow"
                    }
                );
            }else{
                textE.innerHTML = "Follow";
                no--;
                noE.innerHTML = no;
                $.post("../Controller/follow.php",
                    {
                        id : userName,
                        type: "unfollow"
                    }
                );
            }
        }
    </script>
</html>