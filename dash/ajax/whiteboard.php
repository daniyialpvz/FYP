<script type="text/javascript">
   

   $(document).ready(function(){
   init();
});
    var canvas, ctx, flag = false,
        prevX = 0,
        currX = 0,
        prevY = 0,
        currY = 0,
        dot_flag = false;

    var x = "black",
        y = 2;
       
    
    function init() {
        canvas = document.getElementById('can');
        canvas.width = $('#ajax-content').width()-10;
        canvas.height = $('#ajax-content').height();
        ctx = canvas.getContext("2d");
        w = canvas.width;
        h = canvas.height;

        

        // var img = new Image;
        // img.onload = function(){
        //   ctx.drawImage(img,0,0); // Or at whatever offset you like
        // };
        // img.src = img_data;
        // clicked();




        canvas.addEventListener("mousemove", function (e) {
            findxy('move', e)
        }, false);

        canvas.addEventListener("mousedown", function (e) {
            findxy('down', e)
        }, false);
        canvas.addEventListener("mouseup", function (e) {
            findxy('up', e)
        }, false);
        canvas.addEventListener("mouseout", function (e) {
            findxy('out', e)
        }, false);

        canvas.addEventListener("mouseup", function(){
            var dataURL = canvas.toDataURL();
            $.ajax({
              method: "POST",
              url: "index.php",
              data: { "drawn_data": dataURL , "submitCanvas": 1,"group_id": <?php echo $_REQUEST['group_id']; ?>}
            })
          .done(function( msg ) {
            // alert( "Data Saved: " + msg );
          });
            
        }, false);
    }

    
    function color(obj) {
        switch (obj.id) {
            case "green":
                x = "green";
                break;
            case "blue":
                x = "blue";
                break;
            case "red":
                x = "red";
                break;
            case "yellow":
                x = "yellow";
                break;
            case "orange":
                x = "orange";
                break;
            case "black":
                x = "black";
                break;
            case "white":
                x = "white";
                break;
        }
        if (x == "white") y = 14;
        else y = 2;
    
    }
    
    function draw() {
        ctx.beginPath();
        ctx.moveTo(prevX, prevY);
        ctx.lineTo(currX, currY);
        ctx.strokeStyle = x;
        ctx.lineWidth = y;
        ctx.stroke();
        ctx.closePath();
    }

    // function clicked(){
    //      var myEl = document.getElementById('can');

    //     myEl.addEventListener('click', function() {
    //     alert('Hello world');
    //     }, false);
    // }
    
    function erase() {
        var m = confirm("Want to clear");
        if (m) {
            ctx.clearRect(0, 0, w, h);
            document.getElementById("canvasimg").style.display = "none";
        }
    }
    


    function save() {
        document.getElementById("canvasimg").style.border = "2px solid";
        var dataURL = canvas.toDataURL();
        document.getElementById("canvasimg").src = dataURL;
        document.getElementById("canvasimg").style.display = "inline";
    }
    
    function findxy(res, e) {
        if (res == 'down') {
            prevX = currX;
            prevY = currY;
            currX = e.clientX - canvas.offsetLeft - $('#sidebar-left').width() - 30;
            currY = e.clientY - 55;//canvas.offsetTop;
    
            flag = true;
            dot_flag = true;
            if (dot_flag) {
                ctx.beginPath();
                ctx.fillStyle = x;
                ctx.fillRect(currX, currY, 2, 2);
                ctx.closePath();
                dot_flag = false;
            }
        }
        if (res == 'up' || res == "out") {
            flag = false;
        }
        if (res == 'move') {
            if (flag) {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvas.offsetLeft - $('#sidebar-left').width() - 30;
                currY = e.clientY - 55; //canvas.offsetTop;
                draw();
            }
        }
    }
function auto_load_whiteboard(){
  $.ajax({
    url: "ajax/whiteboard_inner.php",
    data:{"group_id":<?php echo $_REQUEST['group_id']; ?>},
    cache: false,
    success: function(data){
       // $("#can").html(data);
        var img = new Image;
        img.onload = function(){
          ctx.drawImage(img,0,0); // Or at whatever offset you like
        };
        img.src = data;

    } 
  });
}
var fetch_whiteboard = setInterval(auto_load_whiteboard,2000);

    </script>
        <canvas id="can" style="border:2px solid;"></canvas>
        <div style="">Choose Color</div>
        <div style="top:15%;left:45%;width:10px;height:10px;background:green;" id="green" onclick="color(this)"></div>
        <div style="top:15%;left:46%;width:10px;height:10px;background:blue;" id="blue" onclick="color(this)"></div>
        <div style="top:15%;left:47%;width:10px;height:10px;background:red;" id="red" onclick="color(this)"></div>
        <div style="top:17%;left:45%;width:10px;height:10px;background:yellow;" id="yellow" onclick="color(this)"></div>
        <div style="top:17%;left:46%;width:10px;height:10px;background:orange;" id="orange" onclick="color(this)"></div>
        <div style="top:17%;left:47%;width:10px;height:10px;background:black;" id="black" onclick="color(this)"></div>
        <div style="top:20%;left:43%;">Eraser</div>
        <div style="top:22%;left:45%;width:15px;height:15px;background:white;border:2px solid;" id="white" onclick="color(this)"></div>
        <!-- <img id="canvasimg" style="position:absolute;top:10%;left:52%;" style="display:none;"> -->
        <input type="button" value="clear" id="clr" size="23" onclick="erase()" style="position:absolute;top:55%;left:15%;">