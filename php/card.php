<?php require "connectToDB.php";
if(isset($_GET['id'])){
  $user_id=$_GET['id'];
}else{
  $user_id=$_SESSION['user_id'];
}

$sql="SELECT * FROM users WHERE user_id='$user_id'";
$result=$connection->query($sql);
if($result->num_rows == 1){
  $row=$result->fetch_assoc();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link  rel="stylesheet" href="../css/card.css" type="text/css">>
  <title>Document</title>
</head>
<body>
<body>
    <div id="card">
        <a href="updatephoto.php?id=<?php echo $user_id; ?>&name=<?php echo $row['username'];?>" title="Change Profile Picture"><img id ="user_image" src="<?php echo $row['picture_path'] ?>"><button id="update">Update Picture</button></a>
        <div class="information">
        <h3><?php echo '<a class="profilelink" href="profile.php?id=' . $row['user_id'] .'">' . $row['username']  . '<a>';?></h3>
        <h4><?php echo $row['email']?></h4>
</div>
    </div>

</body>

</html>