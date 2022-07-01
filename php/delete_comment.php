<?php

include('connectToDB.php');

$comment_id =$_GET['comment_id'];
$post_id =$_GET['post_id'];
	
	// sending query
	$sql="DELETE FROM comments WHERE comment_id = '$comment_id'";
	if($connection->query($sql)==True){
		header("Location: home.php#".$post_id);
	}
	
	

?>
