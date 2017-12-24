<?php
// set the expiration date to one hour ago
setcookie("user_id",$row['id'], time() - (60 * 60), "/");
echo "<script>window.location='http://localhost/collaborationtool/index.php';</script>";
?>

