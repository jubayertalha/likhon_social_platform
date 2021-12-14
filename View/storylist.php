<?php require_once('../Controller/session.php');
    require_once('../Controller/StoryCtr.php');
    if(isset($_POST['id'])&&!empty($_POST['id'])&&isset($_POST['writer'])&&!empty($_POST['writer'])){
        $type = htmlspecialchars($_POST['id']);
        $userName = htmlspecialchars($_POST['writer']);
    }else{
        header('location:../');
    }
?>

<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <div id="storyList"></div>
        <div class="load"><h id="more">Load More Stories</h></div>
        <script>
            $(document).ready(function(){
                getStoryList();
                $("#more").click(function(){
                    getStoryList();
                });
            });

            function getStoryList(){
                var storyList;
                var pre = $("#storyList").children().length;
                $.post("../Controller/storyList.php",
                    {
                        id : "<?php echo $type ?>",
                        writer : "<?php echo $userName ?>",
                        pre : pre
                    },
                    function(data, status){
                        storyList = JSON.parse(data);
                        if(storyList.length < 5){
                            $(".load").hide();
                        }
                        storyList.forEach(function(id){
                            $.post("sotrycard.php",
                                {
                                    id : id
                                },
                                function(data, status){
                                    $("#storyList").append(data);
                                }
                            );
                        });
                    }
                );
            }

            function like(id){
                var text = document.getElementById(id).innerHTML;
                if(text.toString()=="Like"){
                    document.getElementById(id).innerHTML = "Unlike";
                    var like = document.getElementById("like"+id).innerHTML;
                    like++;
                    document.getElementById("like"+id).innerHTML = like;
                    $.post("../Controller/react.php",
                        {
                            id : id,
                            type: "Like"
                        }
                    );
                }else{
                    document.getElementById(id).innerHTML = "Like";
                    var like = document.getElementById("like"+id).innerHTML;
                    like--;
                    document.getElementById("like"+id).innerHTML = like;
                    $.post("../Controller/react.php",
                        {
                            id : id,
                            type: "Unlike"
                        }
                    );
                }
            }

            function details(storyID){
                let protocol = location.protocol;
                let hostname = location.hostname;
                let url = protocol+"//"+hostname+"/View/story.php?id="+storyID;
                console.log(url);
                window.open(url,"_self");
            }
        </script>
    </body>
</html>