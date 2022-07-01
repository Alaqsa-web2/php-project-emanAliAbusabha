<?php
$host="localhost";
$username="root";
$password="";
$db="website";

$connection=new mysqli($host,$username,$password,$db) or die("Could not connection");

if($connection->connect_error){
    echo "Error connecting to website";
}
else{
    //echo "Successfully connected to website";
}
?>