<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-12">
      <h4>Group Chat: </h4>
      <hr>
      <div class="row" id="group_auto_load_div">
      </div>
      <br>
      <br>
      <br>
      <br>
    </div>
  </div>
  <div style="border-radius: 25px;
    border: 2px solid #73AD21;
    padding: 20px; 
    width: 100%;
    height: 150px; ">
    <form role="form" method="POST" id="group_chat_form">
      <div class="form-group col-sm-10">
        <textarea class="form-control tinyTxt" rows="5" id="group_chat_content" name="group_chat_content"></textarea>
      </div>
      <div class="form-group col-sm-2">
        <input type="hidden" name="group_id" value="<?php echo $_REQUEST['group_id']; ?>">
        <input type="hidden" name="create_chat" value="1">
        <button type="submit" id="groupbutton" class="btn btn-success" name="create_chat">Chat</button>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
$("#groupbutton").on('click',function(e){
    e.preventDefault();
    var datastring = $("#group_chat_form").serialize();
    console.log("datastring",datastring);
    $.ajax({
        type: "POST",
        url: window.location.href,
        data: datastring,
        dataType: "json",
        success: function(data) {
         
          $("#group_chat_content").val("");
            //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
            // do what ever you want with the server response
        },
        error: function() {
            alert('error handing here');
        }
    });
  });


 function auto_load(){
 
  $.ajax({
    url: "ajax/groups_inner.php",
    type:'POST',
    data:{"group_id":<?php echo $_REQUEST['group_id']; ?>},
    cache: false,
    success: function(data){

       $("#group_auto_load_div").html(data);
    } 
  });


}
var fetch_group_chat = setInterval(auto_load,2000);
</script>