<?php 
require_once('db.php');
$sql = "UPDATE users SET is_verified=1 WHERE email LIKE '".$_GET['email']."' LIMIT 1";
if ($conn->query($sql) === TRUE) {
	echo "<script type= 'text/javascript'>alert('Your email has been verified successfully');</script>";
    echo "<script>window.location='login.php';</script>";
}
$conn->close();
?>