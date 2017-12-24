<?php
require_once('../../db.php');
require_once('../../inc/functions.php');
$sql = "SELECT p.post_id,p.post_content,p.date_created,p.uploads_name,u.firstname,u.image_name FROM posts p, users u WHERE u.id = p.user_id AND p.group_id = ".$_REQUEST['group_id']." ORDER BY p.date_created DESC";
$result = $conn->query($sql)
;  if ($result->num_rows > 0) {
    while($row_posts = $result->fetch_assoc()) {
?>
  <div class="col-sm-2 text-center">
    <!--<img src="bandmember.jpg" class="img-circle" height="65" width="65" alt="Avatar">-->
    <img src="profile_photos/<?php echo $row_posts['image_name']; ?>" width="50" height="50">
  </div>
  <div class="col-sm-10">
    <h4><?php echo $row_posts['firstname']; ?> <small><?php echo date('M d, Y, g:i A',strtotime($row_posts['date_created'])); ?></small></h4>
    <?php echo $row_posts['post_content']; ?>
    <br>
<?php 
  if($row_posts['uploads_name'] != ""){

?>
  
    <a href="../post_uploads/<?php echo $row_posts['uploads_name']; ?>" download><i class="fa fa-paperclip" aria-hidden="true"><?php echo $row_posts['uploads_name']; ?></i></a>
   <?php }?> 
    <br>
    <button class="btn btn-xs btn-danger btn_reply">Reply</button>
    <form role="form" method="POST">
    <div class="form-group div_reply" style="display:none;">
      <textarea class="form-control col-sm-12" name="reply_content"></textarea>
      <input type="hidden" name="post_id" value="<?php echo $row_posts['post_id']; ?>">
      <button class="btn btn-xs btn-default" type="submit" name="create_reply">Submit Reply</button>
    </div>
    </form>
    <?php
    $sql_reply = "SELECT pr.reply_content,pr.date_replied,u.firstname,u.image_name FROM posts_reply pr, users u WHERE u.id = pr.user_id AND pr.post_id = ".$row_posts['post_id']." ORDER BY pr.date_replied DESC";
    $result_reply = $conn->query($sql_reply);
      if ($result_reply->num_rows > 0) {
        while($row_reply = $result_reply->fetch_assoc()) {
    ?>
    <div class="row">
      <div class="col-sm-2 text-center">
       <!-- <img src="bird.jpg" class="img-circle" height="65" width="65" alt="Avatar">-->
        <img src="profile_photos/<?php echo $row_reply['image_name']; ?>" width="50" height="50">
      </div>
      <div class="col-xs-10">
        <h4><?php echo $row_reply['firstname']; ?> <small><?php echo date('M d, Y, g:i A',strtotime($row_reply['date_replied'])); ?></small></h4>
        <p><?php echo $row_reply['reply_content']; ?></p>
        <br>
      </div>
    </div>
    <?php }} ?>
  </div>
<?php
    }
  }
?>

<script type="text/javascript">
  $(document).ready(function () {
  $(".btn_reply").on('click',function(){
    $(this).siblings("form").find('.div_reply').toggle();
  });
  // auto_load();
});
// setInterval(auto_load,10000);  
</script>