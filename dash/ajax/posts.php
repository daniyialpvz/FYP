<?php 
require_once('../../db.php');
// $sql="SELECT image_name FROM users WHERE id=".$_COOKIE['user_id'];
// $result = $conn->query($sql);
// $row = $result->fetch_assoc(); 


?>
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-12">
      <!-- <h4><small>POSTS</small></h4> -->
      <hr>
      <h4>POST HERE: </h4>
      <form role="form" method="POST" id="post_submit_form">
        <div class="form-group">
          <textarea class="form-control" style="resize: none;" rows="5" id="postTextarea" name="post_content"></textarea>
        </div>
        <input type="hidden" name="group_id" value="<?php echo $_REQUEST['group_id']; ?>">
        <input type="hidden" name="create_post" value="1">
        <button type="submit"  class="btn btn-success" id="postbutton" >Submit</button>
        <input type="file" name="create_uploads" id="create_uploads" style="float: right;">
      </form>
      <br>
      
      <div class="row" id="auto_load_div">
      
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
// $("#postbutton").click(function(){
//   var content = document.getElementById("postTextarea").value;
//     (content.length < 1) ? alert("Has No Content"):"";

// });
// $("#postbutton").click(function(){
//   $("#postbutton").on('click',function(e){
//   var content = document.getElementById("postTextarea").value;
// if(content.length < 1){
// alert("has no content");
// return true;
// }
// elseif(content.length > 1){
// $("#create_post").on('click',function(e){
//     // var content = document.getElementById("postTextarea").val().trim().length;
//     var comment = $.trim($('#postTextarea').val());
//     alert(comment);
//     if(comment.length >1){
//       e.preventDefault();
//     var datastring = $("#post_submit_form").serialize();
//     console.log("datastring",datastring);
//     $.ajax({
//         type: "POST",
//         url: window.location.href,
//         data: datastring,
//         dataType: "json",
//         success: function(data) {
//           $("#postTextarea").val("");
//             //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
//             // do what ever you want with the server response
//         },
//         error: function() {
//             alert('error handing here');
//         }
//     });
//     }
//     else{
//       alert("Has no value");
//     }
//   });
$('#postbutton').on('click', function(e) {
    e.preventDefault();
    var file_data = $('#create_uploads').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('create_uploads', file_data);
    form_data.append('group_id',<?php echo $_REQUEST['group_id']; ?>);
    form_data.append('create_post',1);
    form_data.append('post_content',$("#postTextarea").val());          
    console.log(form_data);                   
    $.ajax({
                url: window.location.href, // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                
                    $('#post_submit_form').trigger('reset');
                }
     });
});





// $("#postbutton").on('click',function(e){
//     e.preventDefault();
//     var datastring = $("#post_submit_form").serialize();
//     console.log("datastring",datastring);
//     if ($("#postTextarea").val() != ""){

//       $.ajax({
//           type: "POST",
//           url: window.location.href,
//           data: datastring,
//           dataType: "json",
//           success: function(data) {
//             $("#postTextarea").val("");
//               //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
//               // do what ever you want with the server response
//           },
//           error: function() {
//               alert('error handing here');
//           }
//       });
//     } else {
//       alert("Please fill post content");
//     }
//   });

// tinymce.init({
//       selector: '.tinyTxt',
//       theme: "modern",
//       menubar:false,
//       statusbar: false,        
//         plugins: [
//              "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
//              "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
//              "save table contextmenu directionality emoticons template paste textcolor"
//        ],
//        content_css: "css/content.css",
//        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons", 
//        style_formats: [
//             {title: 'Bold text', inline: 'b'},
//             {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
//             {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
//             {title: 'Example 1', inline: 'span', classes: 'example1'},
//             {title: 'Example 2', inline: 'span', classes: 'example2'},
//             {title: 'Table styles'},
//             {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
//         ],
//       file_picker_types: 'file image media'
//     });

function auto_load(){
  $.ajax({
    url: "ajax/posts_inner.php",
    data:{"group_id":<?php echo $_REQUEST['group_id']; ?>},
    cache: false,
    success: function(data){

       $("#auto_load_div").html(data);
    } 
  });
}

$(document).ready(function () {
  $(".btn_reply").on('click',function(){
    $(this).siblings("form").find('.div_reply').toggle();
  });
  auto_load();
});
var fetch_posts = setInterval(auto_load,2000);


</script>