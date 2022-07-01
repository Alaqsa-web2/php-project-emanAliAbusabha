<?php 
require "session.php";
require "nav.php";
require "card.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/postStyle.css">
    <title>Document</title>
</head>
<body>
<div class="container">

        <br>
        <div id="createpost">
            <form method="post" action="" onsubmit="return validatePost()" enctype="multipart/form-data">
                <h2>Make Post</h2>
                <hr>
                <span style="float:right; color:black">
                </span>
                Caption <span class="required" style="display:none;"> *You can't Leave the Caption Empty.</span><br>
                <textarea rows="6" name="caption"></textarea>
                <center><img src="" id="preview" style="max-width:580px; display:none;"></center>
                <div class="createpostbuttons">
                    <!--<form action="" method="post" enctype="multipart/form-data" id="imageform">-->
                    <label>
                        <img src="../image/photo.png">
                        <input type="file" name="fileUpload" id="imagefile">
                        <!--<input type="submit" style="display:none;">-->
                    </label>
                    <input type="submit" value="Post" name="post">
                    <!--</form>-->
                </div>
            </form>
        </div>
        <h1>News Feed</h1>
    <script type="text/javascript">
        function validatePost(){
            var required = document.getElementsByClassName("required");
            var caption = document.getElementsByTagName("textarea")[0].value;
            required[0].style.display = "none";
            if(caption == ""){
                required[0].style.display = "initial";
                return false;
            }
            return true;
        }
       
        </script>
</body>
</html>
<?php
require "connectToDB.php";
$sql_post="SELECT * FROM posts INNER JOIN users ON posts.user_id=users.user_id ORDER BY post_time DESC";
$query_post=$connection->query($sql_post);
if(!$query_post){
    echo $connection->error;
}
if($query_post->num_rows== 0){
    echo '<div class="post">';
    echo 'There are no posts yet to show.';
    echo '</div>';
}
else{
    $width = '40px'; // Profile Image Dimensions
    $height = '40px';
    while($row = $query_post->fetch_assoc()){
        include 'post.php';
        echo '<br>';
    }
}

if(isset($_POST['post'])){
    date_default_timezone_set("Asia/Gaza");
    $textOfPost=$_POST['caption'];
    $time=time();
    $timeOfPost=date("Y-m-d h:i:s",time());
    $toPath=null;
    if(empty($_FILES["fileUpload"]["name"])){
        $topath=null;
    }
    elseif(isset($_FILES["fileUpload"]["name"])){
        $tmp=$_FILES["fileUpload"]["tmp_name"];
        $name=$_FILES["fileUpload"]["name"];
        $toPath="../image/".$user_name."/".$name;
        move_uploaded_file($tmp,$toPath);
    }
    
    
    $sql="INSERT INTO posts (post_text,user_id,post_time,image_path) VALUES ('$textOfPost','$user_id','$timeOfPost','$toPath')";
    if($connection->query($sql)===True){
        //header("location: home.php");
        echo "<script>window.location='home.php'</script>";
    }


}
?>