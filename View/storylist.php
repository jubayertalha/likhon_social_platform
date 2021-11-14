<?php require_once('../Controller/session.php');
    require_once('../Controller/StoryCtr.php');
    if(isset($_GET['id'])&&!empty($_GET['id'])&&isset($_GET['writer'])&&!empty($_GET['writer'])){
        $id = htmlspecialchars($_GET['id']);
        $userName = htmlspecialchars($_GET['writer']);
        $storyController = new StoryCtr($id);
        $storyList = $storyController->getStoryList($userName);
    }else{
        header('location:../');
    }
?>

<html>
    <body>
        <?php
             foreach($storyList as $id){
                 $_GET['id'] = $id;
                include('../View/sotrycard.php');
            }
        ?>
        <script>
            function like(id){
                var text = document.getElementById(id).innerHTML;
                if(text.toString()=="Like"){
                    document.getElementById(id).innerHTML = "Unlike";
                }else{
                    document.getElementById(id).innerHTML = "Like";
                }
            }
        </script>
    </body>
</html>