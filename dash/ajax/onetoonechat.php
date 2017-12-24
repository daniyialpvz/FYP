<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-12">
      <h4>One To One Chat: </h4>
      <hr>
      <div class="row" id="onetoone_auto_load_div">
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
    <form role="form" method="POST" id="onetooneForm">
      <div class="form-group col-sm-10">
        <textarea class="form-control tinyTxt" rows="5" id="onetoone_chat_content" name="onetoone_chat_content"></textarea>
      </div>
      <div class="form-group col-sm-2">
        <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>">
        <input type="hidden" name="create_onetoonechat" value="1">
        <button type="submit" id="onetooneButton" class="btn btn-success" name="create_onetoonechat">Chat</button>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
$("#onetooneButton").on('click',function(e){
    e.preventDefault();
    var datastring = $("#onetooneForm").serialize();
    console.log("datastring",datastring);
    $.ajax({
        type: "POST",
        url: window.location.href,
        data: datastring,
        dataType: "json",
        success: function(data) {
        $("#onetoone_chat_content").val("");
            //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
            // do what ever you want with the server response
        },
        error: function() {
            alert('error handing here');
        }
    });
  });

function auto_loadchat(){
  $.ajax({
    url: "ajax/onetoonechat_inner.php",
    data:{"id":<?php echo $_REQUEST['id']; ?>},
    cache: false,
    success: function(data){
     
       $("#onetoone_auto_load_div").html(data);
    } 
  });
}
// setInterval(auto_loadchat,2000);
var fetch_onetoone_chat = setInterval(auto_loadchat,2000);
</script>