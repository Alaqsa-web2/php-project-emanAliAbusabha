<?php
$post_id=$row['post_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.php" type="text/css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php

echo '<div id="post" id="'.$post_id.'">';
$post_id=$row['post_id'];
echo '<div class="delete-post">';
echo '<a href="delete_post.php?post_id='.$post_id.'&user_id='.$row['user_id'].'" title="Delete your post"><i class="far fa-times-circle" id="i"></i></a>';
echo '</div>';
echo '<br>';
echo '<p class="public">';
echo '<span class="postedtime" style="float:right;">' . $row['post_time'] . '</span>';
echo '</p>';
echo '<div>';
echo '<img src="' . $row['picture_path'] . '" width="' . $width . '" height="' . $height .'">';
echo '<a class="profilelink" href="profile.php?id=' . $row['user_id'] .'">' . $row['username']  . '<a>';
echo'</div>';
echo '<br>';
echo '<p class="caption">' . $row['post_text'] . '</p>';
echo '<center>'; 
if($row['image_path'] !=null){
    echo '<img src="' .$row['image_path'] . '"  style="max-width:580px">';
}
echo '</center>';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form  action="addComment.php" method="post" onsubmit="return validateComment()">
        <input type="text" name="comment" placeholder="Write a comment..." required>
        <input type="hidden" name="post_id" value="<?php echo "$post_id" ?>">
        <input type="submit" value="add Comment" name="addComment">
    </form>
    
</body>
</html>


<!-- /******************************************************************************* */ -->
<?php
$sql_comment="SELECT * from comments where post_id='$post_id' order by time DESC";
$result=$connection->query($sql_comment);
while($row=$result->fetch_assoc()){
    $comment_id=$row['comment_id'];
	$content_comment=$row['comment'];
	$time=$row['time'];	
	$post_id=$row['post_id'];
	$user=$row['user_id'];
    $sql_name="SELECT * from users where user_id='$user'";
    $res=$connection->query($sql_name);
    while(($row_of_user=$res->fetch_assoc())){
        $user_name_comment=$row_of_user['username'];
        $user_image_comment=$row_of_user['picture_path'];
    
    ?>

<!-- ********************************************************* -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="../css/main.css">
        <link rel="stylesheet" type="text/css" href="../css/postStyle.css">
        <script src="https://kit.fontawesome.com/f17cea77c9.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <style>

    
    
        </style>
    <div class="comment-display"<?php echo $comment_id ?>>
     <div class="delete-post">
     <a href="delete_comment.php<?php echo '?comment_id='.$comment_id.'&post_id='.$post_id; ?>" title="Delete your comment"><i class="far fa-times-circle" id="i" ></i></a>
					</div>
				<div class="user-comment-name">
                <img src="<?php echo $user_image_comment; ?>">  <?php echo $user_name_comment; ?>
                   <b class="time-comment"><?php echo $row['time']; ?></b>
                
            </div>
				<div class="comment"><?php echo $row['comment']; ?></div>
			</div>
			<br />
    </body>
    </html>
     
    
    
    <?php
    }
}
?>
<?php

echo '</div>';


?>