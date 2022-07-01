<?php
require "connectToDB.php";
session_start();
if (isset($_SESSION['user_id'])) {
    header("location:home.php");
}
session_destroy();
session_start();

if(isset($_POST['signin'])){
    $username = $_POST["username_signin"];
    $password = $_POST["password_signin"];
    $sql="SELECT * FROM users WHERE username=? AND password=?";
    $statment=$connection->prepare($sql);
    $statment->bind_param("ss",$username,$password);
    $query=$statment->execute();
    if($query){
        $result = $statment->get_result();
        if($result->num_rows==1){
            $row=$result->fetch_assoc();
            $_SESSION['user_id']=$row['user_id'];
            $_SESSION['user_name']=$row['username'];
            echo 'hi';
            header("location:home.php");
                }
        else{
            ?> <script>
                    document.getElementsByClassName("required")[0].innerHTML = "Invalid Login Credentials.";
                    document.getElementsByClassName("required")[1].innerHTML = "Invalid Login Credentials.";
                </script> <?php
        }
    }
    else{
        header('Location:index.php');
    }
}

if(isset($_POST["signup"])){
    $username=$_POST["username_signup"];
    $password=$_POST["password_signup_1"];
    $email=$_POST["email_signup"];
    $picture_path="../image/virtual.png";

    $sql="INSERT Into users (username , password, email,picture_path) VALUES (?,?,?,?)";
    $statment=$connection->prepare($sql);
    $statment->bind_param("ssss",$username,$password,$email,$picture_path);
    $query=$statment->execute();
    if($query){
        $sql="SELECT * FROM users WHERE username=? AND password=?";
        $statment=$connection->prepare($sql);
        $statment->bind_param("ss",$username,$password);
        $query=$statment->execute();
        $result=$statment->get_result();
        $row=$result->fetch_assoc();
        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['user_name']=$row['username'];
        mkdir("../image/".$row["username"],777);
        header("Location:home.php");
       
    }
    else{
        header("Location:index.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
           
            <div class="login-form">
                 <form action="" method="post">
                <div class="sign-in-htm">
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="user" type="text" class="input" name="username_signin" required>
                    </div>
                    <div class="required"></div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" type="password" class="input" data-type="password" name="password_signin" required>
                    </div>
                    <div class="required"></div>
                    <div class="group">
                        <input id="check" type="checkbox" class="check" checked>
                        <label for="check"><span class="icon"></span> Keep me Signed in</label>
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Sign In" name="signin">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="#forgot">Forgot Password?</a>
                    </div>
                      </form>
                </div>
               
                 <form action="" method="post" onSubmit = "return checkPassword(this)">
                <div class="sign-up-htm">
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="user" type="text" class="input" name="username_signup" required>
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" type="password" class="input" data-type="password" name="password_signup_1" required>
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Repeat Password</label>
                        <input id="pass" type="password" class="input" data-type="password" name="password_signup_2" required>
                    </div>
          
                    <div class="group">
                        <label for="pass" class="label">Email Address</label>
                        <input id="pass" type="email" class="input" name="email_signup" required>
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Sign Up" name="signup">
                    </div>
                    
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <label for="tab-1">Already Member?</a>
                    </div>
                </div>
</form>
            </div>
        </div>
    </div>

    <script>
          
          // Function to check Whether both passwords
          // is same or not.
          function checkPassword(form) {
              password1 = form.password_signup_1.value;
              password2 = form.password_signup_1.value;

              // If password not entered
              if (password1 == '')
                  alert ("Please enter Password");
                    
              // If confirm password not entered
              else if (password2 == '')
                  alert ("Please enter confirm password");
                    
              // If Not same return False.    
              else if (password1 != password2) {
                  alert ("\nPassword did not match: Please try again...")
                  return false;
              }

              // If same return True.
              else{
                  alert("Password Match: Welcome to GeeksforGeeks!")
                  return true;
              }
          }
      </script>
</body>
</html>

