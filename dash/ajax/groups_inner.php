<?php
require_once('../../db.php');
require_once('../../inc/functions.php');
$sql = "SELECT c.group_chat_id,c.group_chat_content,c.chat_date,u.firstname FROM group_chats c, users u WHERE u.id = c.user_id AND c.group_id = ".$_REQUEST['group_id']." ORDER BY c.chat_date ASC";
$result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row_group_chats = $result->fetch_assoc()) {
?>
<div class="col-sm-10">
    <h4><?php echo $row_group_chats['firstname']; ?> <small><?php echo date('M d, Y, g:i A',strtotime($row_group_chats['chat_date'])); ?></small></h4>
    <?php echo $row_group_chats['group_chat_content']; ?>
    <br>
    </div>
    <?php 
      }
    }
    ?>