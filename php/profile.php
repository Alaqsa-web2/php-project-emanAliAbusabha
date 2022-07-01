<?php
    require "connectToDB.php";
	require "session.php";
	require 'nav.php' ;
	
	?>

<!DOCTYPE html>
<html>
	<head>
		<title>Welcome  To Biobook - Sign up, Log in, Post </title>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/postStyle.css">
	</head>

<body>
   
<?php require 'card.php'?>
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
if(isset($_GET["id"])){
	$user_id=$_GET['id'];
}
$sql_post="SELECT * FROM posts INNER JOIN users where posts.user_id=users.user_id AND posts.user_id='$user_id' ORDER BY post_time DESC";
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

if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
echo "<script>window.location='profile.php'</script>";
}


}


