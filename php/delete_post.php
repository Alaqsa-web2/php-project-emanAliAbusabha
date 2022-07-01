<?php

include('connectToDB.php');
include('session.php');

$get_id =$_GET['post_id'];
$user_id=$_GET['user_id'];
	
	// sending query

	if($user_id==$_SESSION['user_id']){
		$sql_delete_post="DELETE FROM posts WHERE post_id = '$get_id'";
		$sql_delete_commentOfPost="DELETE FROM comments WHERE post_id = '$get_id'";
		$connection->query($sql_delete_commentOfPost);
		$connection->query($sql_delete_post);
	}
	
	header("Location: home.php");

?>
