<?php
require "session.php";
if (isset($_POST['addComment']))
	{
		//var_dump($_POST['post_id']);
		$user_id=$_SESSION['user_id'];
		$comment=$_POST['comment'];
		$post_id=$_POST['post_id'];
		$timeOfComment=date("Y-m-d h:i:s",time());

		{
            $sql_comment="INSERT INTO comments (post_id,user_id,comment,time)
			VALUES ('$post_id','$user_id','$comment','$timeOfComment')";
			if($connection->query($sql_comment)==True){
                echo "<script>window.location='home.php#$post_id'</script>";
                //header("Location: home.php#$post_id");
            }
			
		}
			
	}
?>