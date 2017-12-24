<?php
require_once('../../db.php');
require_once('../../inc/functions.php');
$sql = "SELECT c.chat_id, c.chat_content, c.chat_date, u.firstname FROM chat c, users u WHERE u.id = c.user_id AND ((c.user_id=".$_COOKIE['user_id']." AND c.user_id2 = ".$_REQUEST['id'].") OR (c.user_id2=".$_COOKIE['user_id']." AND c.user_id = ".$_REQUEST['id'].")) ORDER BY c.chat_date ASC";
$result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row_onetoone_chats = $result->fetch_assoc()) {
?>
<div class="col-sm-10">
    <h4><?php echo $row_onetoone_chats['firstname']; ?> <small><?php echo date('M d, Y, g:i A',strtotime($row_onetoone_chats['chat_date'])); ?></small></h4>
    <?php echo $row_onetoone_chats['chat_content']; ?>
    <br>
    </div>
    <?php 
      }
    }
    ?>