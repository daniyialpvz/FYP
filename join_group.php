<?php 
if (!isset($_COOKIE['user_id'])){
	$return_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	setcookie("return_url",$return_url, time() + (60 * 60), "/"); // 1 Hour
	echo "<script>window.location='login.php';</script>";
	exit();
}
require_once('db.php');
$sql = "INSERT INTO users_groups (user_id,group_id,date_joined) VALUES(".$_COOKIE['user_id'].",".$_REQUEST['group_id'].",SYSDATE())";
if ($conn->query($sql) === TRUE) {
	echo "<script type= 'text/javascript'>alert('You have joined the group successfully');</script>";
    echo "<script>window.location='dash/index.php';</script>";
}
$conn->close();
?>