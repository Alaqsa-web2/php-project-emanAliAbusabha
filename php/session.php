<?php
include("connectToDB.php");
session_start();
if (!isset($_SESSION['user_id']) or !isset($_SESSION['user_name'])){
header('location:index.php');
}

$user_id= $_SESSION['user_id'];
$user_name= $_SESSION['user_name'];

?>