<?php 
require_once('../../db.php');
require_once('../../inc/functions.php');
$sql = "SELECT drawn_data FROM whiteboard WHERE group_id = ".$_REQUEST['group_id']." ";
$result = $conn->query($sql);  
if ($result->num_rows > 0) {
    $row_whiteboard = $result->fetch_assoc();
    echo $row_whiteboard['drawn_data'];
}
?>
