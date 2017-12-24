<?php
if (!isset($_COOKIE['user_id'])){
	$return_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	setcookie("return_url",$return_url, time() + (60 * 60), "/"); // 1 Hour
	echo "<script>window.location='../login.php';</script>";
	exit();
}
require_once('../db.php');
require_once('../inc/functions.php');
if (isset($_POST['create_group'])){
	$member_emails = explode(';', $_POST['member_emails']);
	$sql = "INSERT INTO groups (group_title, user_id, date_created)
    VALUES ('".$_POST["group_title"]."','".$_COOKIE["user_id"]."',SYSDATE())";
    if ($conn->query($sql) === TRUE) {
    	$group_id = $conn->insert_id;
    	//Inserting group in users_groups
    	$sql = "INSERT INTO users_groups (user_id,group_id,date_joined) VALUES(".$_COOKIE['user_id'].",".$group_id.",SYSDATE())";
		$conn->query($sql);
        //Sending group invitations
        foreach ($member_emails as $email) {
	        $msg="USERNAME has invited you to join this group. Please click on the link below to join:<br>
	        <a href=\"http://localhost/collaborationtool/join_group.php?group_id=".$group_id."\">Join Now</a>";
	        send_mail($email,$email,"Join Group - ".$_POST['group_title'],$msg);
	    }
        echo "<script type= 'text/javascript'>alert('Group created successfully.');</script>";
        echo "<script>window.location='index.php';</script>";

    } else {
        echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error."');</script>";
    }
	$conn->close();
	exit(); //creating posts
}
// elseif (isset($_POST['create_post'])){
	
// 	$sql = "INSERT INTO posts (post_content, user_id, group_id, date_created)
//     VALUES ('".$_POST["post_content"]."',".$_COOKIE["user_id"].", ".$_REQUEST['group_id'].", SYSDATE())";
//     if ($conn->query($sql) === TRUE) {
//     	echo json_encode(array("status"=>"success"));
//     	exit();
       

//      } else {
//     	echo json_encode(array("status"=>"failure","reason"=>$conn->error));
//     	exit();
//     }
// }
// else if (isset($_POST['create_reply'])){
//   $sql = "INSERT INTO posts_reply (reply_content, post_id, user_id, date_replied)
//     VALUES ('".$_POST["reply_content"]."',".$_REQUEST['post_id'].",".$_COOKIE["user_id"].", SYSDATE())";
//    if ($conn->query($sql) === TRUE) {
//     	echo json_encode(array("status"=>"success"));
//     	exit();
       

//      } else {
//     	echo json_encode(array("status"=>"failure","reason"=>$conn->error));
//     	exit();
//     }
// }
elseif (isset($_POST['create_post'])){
	if(!isset($_FILES['create_uploads'])){
		$sql = "INSERT INTO posts (post_content, user_id, group_id, date_created)
    			VALUES ('".$_POST["post_content"]."',".$_COOKIE["user_id"].", ".$_REQUEST['group_id'].", SYSDATE())";
	}
	elseif(isset($_FILES['create_uploads']) && $_FILES['create_uploads']['error'] == 0){ //might need to add MIME types in this check
		if($err = move_uploaded_file($_FILES['create_uploads']['tmp_name'], 'post_uploads/'.$_FILES['create_uploads']['name'])){
			$sql = "INSERT INTO posts (post_content, user_id, group_id, date_created, uploads_name)
	    			VALUES ('".$_POST["post_content"]."',".$_COOKIE["user_id"].", ".$_REQUEST['group_id'].", SYSDATE(), '".$_FILES["create_uploads"]["name"]."')"; 
	   } else {
	   		echo json_encode(array("status"=>"failure","reason"=>$err));
		    exit();
	   }
   }
   echo $sql;
	if ($conn->query($sql) === TRUE) {
		echo json_encode(array("status"=>"success"));
		exit();
	} 
	else {
		echo json_encode(array("status"=>"failure","reason"=>$conn->error));
		exit();
	}
}

// groupchat
elseif (isset($_POST['create_chat'])){
	$sql = "INSERT INTO group_chats (group_chat_content, user_id, group_id, chat_date)
    VALUES ('".$_POST["group_chat_content"]."',".$_COOKIE["user_id"].", ".$_REQUEST['group_id'].", SYSDATE())";
    if ($conn->query($sql) === TRUE) {
    	echo json_encode(array("status"=>"success"));
    	exit();
        // echo "<script type= 'text/javascript'>alert('Group created successfully.');</script>";
        // echo "<script>window.location='index.php#ajax/posts.php?group_id=".$_REQUEST['group_id']."';</script>";

    } else {
    	echo json_encode(array("status"=>"failure","reason"=>$conn->error));
    	exit();
    }
}
// onetoonechat
elseif (isset($_POST['create_onetoonechat'])){
	$sql = "INSERT INTO chat (chat_content, user_id, user_id2, chat_date)
    VALUES ('".$_POST["onetoone_chat_content"]."',".$_COOKIE["user_id"].",".$_REQUEST["id"].", SYSDATE())";
    if ($conn->query($sql) === TRUE) {
    	echo json_encode(array("status"=>"success"));
    	exit();
        // echo "<script type= 'text/javascript'>alert('Group created successfully.');</script>";
        // echo "<script>window.location='index.php#ajax/posts.php?group_id=".$_REQUEST['group_id']."';</script>";

   } else {
    	echo json_encode(array("status"=>"failure","reason"=>$conn->error));
    	exit();
    }
}

elseif (isset($_POST['submitCanvas'])) {
	  $sql = "SELECT * FROM whiteboard WHERE group_id = '".$_REQUEST['group_id']."'"; 
      $result = $conn->query($sql);
       if ($result->num_rows > 0) {
       	 $sql = "UPDATE whiteboard set drawn_data = '".$_REQUEST["drawn_data"]."' WHERE group_id = '".$_REQUEST["group_id"]."' ";
			$conn->query($sql); 
       	 echo $sql;
       }
       else{
       	$sql = "INSERT INTO whiteboard (drawn_data, group_id)
                VALUES ('".$_REQUEST["drawn_data"]."',".$_REQUEST['group_id'].")";	
        echo $sql;
       $conn->query($sql);
       }
       echo json_encode(array("status"=>"success"));
    	exit();
}

elseif (isset($_POST['submit_profile'])){
	$sql = "SELECT password FROM users WHERE password = '".md5($_POST["current_password"])."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    	if (isset($_FILES['profile_picture']) && $_FILES['proflie_picture']['size'] == 0){
    		$sql = "UPDATE users set firstname = '".$_POST["name"]."', email = '".$_POST["email"]."', contact = '".$_POST["contact"]."', address = '".$_POST["address"]."', city = '".$_POST["city"]."', country = '".$_POST["country"]."', schoolname = '".$_POST["schoolname"]."', collegename = '".$_POST["collegename"]."', universityname = '".$_POST["universityname"]."', companyname = '".$_POST["companyname"]."', designation = '".$_POST["designation"]."', experience = '".$_POST["experience"]."' WHERE id=".$_COOKIE['user_id']." LIMIT 1";
			$conn->query($sql); 
		}elseif (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0){
			if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], 'profile_photos/'.$_FILES['profile_picture']['name'])){
				$sql = "UPDATE users set firstname = '".$_POST["name"]."', email = '".$_POST["email"]."', contact = '".$_POST["contact"]."', address = '".$_POST["address"]."', city = '".$_POST["city"]."', country = '".$_POST["country"]."', schoolname = '".$_POST["schoolname"]."', collegename = '".$_POST["collegename"]."', universityname = '".$_POST["universityname"]."', companyname = '".$_POST["companyname"]."', designation = '".$_POST["designation"]."', experience = '".$_POST["experience"]."', image_name = '".$_FILES["profile_picture"]["name"]."' WHERE id=".$_COOKIE['user_id']." LIMIT 1";
			    if ($conn->query($sql) === TRUE) {
			         // echo "<script type= 'text/javascript'>alert('Group created successfully.');</script>";
		        	// echo "<script>window.location='index.php#ajax/posts.php?group_id=".$_REQUEST['group_id']."';</script>";
			    } 
			    else {
			        echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error."');</script>";
			    }
			}else{
				    echo "<script type= 'text/javascript'>alert('Unable to upload file');</script>";
			}
		}
	}
	else{
		 echo "<script type= 'text/javascript'>alert('The password you entered is incorrect!');</script>";
	}

	// elseif (isset($_POST['change_password'])) {
		
	// }
  // exit();//chatting
	
}
$sql="SELECT firstname FROM users WHERE id=".$_COOKIE['user_id'];
$result = $conn->query($sql);
$row_name = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Student Teacher Collaboration Tool</title>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="plugins/select2/select2.css" rel="stylesheet">
		<link href="plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">
		<link href="css/style_v2.css" rel="stylesheet">
		<link href="plugins/chartist/chartist.min.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
<body>
<!--Start Header-->
<div id="screensaver">
	<canvas id="canvas"></canvas>
	<i class="fa fa-lock" id="screen_unlock"></i>
</div>
<div id="modalbox">
	<div class="devoops-modal">
		<div class="devoops-modal-header">
			<div class="modal-header-name">
				<span>Basic table</span>
			</div>
			<div class="box-icons">
				<a class="close-link">
					<i class="fa fa-times"></i>
				</a>
			</div>
		</div>
		<div class="devoops-modal-inner">
		</div>
		<div class="devoops-modal-bottom">
		</div>
	</div>
</div>
<header class="navbar">
	<div class="container-fluid expanded-panel">
		<div class="row">
			<div id="logo" class="col-xs-12 col-sm-2">
				<a href="index.php">STCTool</a>
			</div>
			<div id="top-panel" class="col-xs-12 col-sm-10">
				<div class="row">
					<div class="col-xs-8 col-sm-4">
						<div id="search">
							<input type="text" placeholder="search"/>
							<i class="fa fa-search"></i>
						</div>
					</div>
					<div class="col-xs-4 col-sm-8 top-panel-right">
						<!-- <a href="#" class="about">about</a> -->
						<!-- <a href="index_v1.html" class="style1"></a> -->
						<ul class="nav navbar-nav pull-right panel-menu">
							<!-- <li class="hidden-xs">
								<a href="index.html" class="modal-link">
									<i class="fa fa-bell"></i>
									<span class="badge">7</span>
								</a>
							</li> -->
							
							<li class="dropdown">
								<a class="ajax-link" href="profile.php">
									<i class="fa fa-user"><span><?php echo $row_name['firstname'];  ?></span></i>
								</a>
							</li>
							<!-- <li class="hidden-xs">
								<a href="ajax/page_messages.html" class="ajax-link">
									<i class="fa fa-envelope"></i>
									<span class="badge">7</span>
								</a>
							</li> -->
							<li class="dropdown">
								<!-- <a href="#" class="dropdown-toggle account" data-toggle="dropdown"> -->
									<!-- <div class="avatar">
										<img src="img/avatar.jpg" class="img-circle" alt="avatar" />
									</div> -->
									<!-- <i class="fa fa-angle-down pull-right"></i>
									<div class="user-mini pull-right">
										<span class="welcome">Welcome,</span>
										<span>Jane Devoops</span>
									</div> -->
									<li>
										<a href="http://localhost/collaborationtool/dash/logout.php">
											<i class="fa fa-power-off"></i>
											<span>Logout</span>
											
										</a>
									</li>
								</a>
							<!-- 	<ul class="dropdown-menu">
									<li>
										<a href="#">
											<i class="fa fa-user"></i>
											<span>Profile</span>
										</a>
									</li>
									<li>
										<a href="ajax/page_messages.html" class="ajax-link">
											<i class="fa fa-envelope"></i>
											<span>Messages</span>
										</a>
									</li>
									<li>
										<a href="ajax/gallery_simple.html" class="ajax-link"> -->
											<!-- <i class="fa fa-picture-o"></i>
											<span>Albums</span>
										</a>
									</li>
									<li>
										<a href="ajax/calendar.html" class="ajax-link">
											<i class="fa fa-tasks"></i>
											<span>Tasks</span>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fa fa-cog"></i>
											<span>Settings</span>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fa fa-power-off"></i>
											<span>Logout</span>
										</a>
									</li> -->
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!--End Header-->
<!--Start Container-->
<div id="main" class="container-fluid">
	<div class="row">
		<div id="sidebar-left" class="col-xs-2 col-sm-2">
			<ul class="nav main-menu">
				<!-- <li>
					<a href="ajax/dashboard.html" class="ajax-link">
						<i class="fa fa-dashboard"></i>
						<span class="hidden-xs">Dashboard</span>
					</a>
				</li> -->
				<!-- <li class="dropdown"> -->
					<!-- <a href="#" class="dropdown-toggle"> -->
						<!-- <i class="fa fa-bar-chart-o"></i> -->
						<!-- <span class="hidden-xs">Charts</span> -->
					<!-- </a> -->
					<!-- <ul class="dropdown-menu"> -->
						<!-- <li><a class="ajax-link" href="ajax/charts_xcharts.html">xCharts</a></li> -->
						<!-- <li><a class="ajax-link" href="ajax/charts_flot.html">Flot Charts</a></li>
						<li><a class="ajax-link" href="ajax/charts_google.html">Google Charts</a></li> -->
						<!-- <li><a class="ajax-link" href="ajax/charts_morris.html">Morris Charts</a></li> -->
						<!-- <li><a class="ajax-link" href="ajax/charts_chartist.html">Chartist</a></li> -->
						<!-- <li><a class="ajax-link" href="ajax/charts_amcharts.html">AmCharts</a></li> -->
						<!-- <li><a class="ajax-link" href="ajax/charts_coindesk.html">CoinDesk realtime</a></li> -->
					<!-- </ul> -->
				<!-- </li> -->
				<!-- <li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-table"></i>
						 <span class="hidden-xs">Tables</span>
					</a>
					<ul class="dropdown-menu">
						<li><a class="ajax-link" href="ajax/tables_simple.html">Simple Tables</a></li>
						<li><a class="ajax-link" href="ajax/tables_datatables.html">Data Tables</a></li>
						<li><a class="ajax-link" href="ajax/tables_beauty.html">Beauty Tables</a></li>
					</ul>
				</li> -->
				<!-- <li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-pencil-square-o"></i>
						 <span class="hidden-xs">Forms</span>
					</a>
					<ul class="dropdown-menu">
						<li><a class="ajax-link" href="ajax/forms_elements.html">Elements</a></li>
						<li><a class="ajax-link" href="ajax/forms_layouts.html">Layouts</a></li>
						<li><a class="ajax-link" href="ajax/forms_file_uploader.html">File Uploader</a></li>
					</ul>
				</li> -->
				<!-- <li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-desktop"></i>
						 <span class="hidden-xs">UI Elements</span>
					</a>
					<ul class="dropdown-menu">
						<li><a class="ajax-link" href="ajax/ui_grid.html">Grid</a></li>
						<li><a class="ajax-link" href="ajax/ui_buttons.html">Buttons</a></li>
						<li><a class="ajax-link" href="ajax/ui_progressbars.html">Progress Bars</a></li>
						<li><a class="ajax-link" href="ajax/ui_jquery-ui.html">Jquery UI</a></li>
						<li><a class="ajax-link" href="ajax/ui_icons.html">Icons</a></li>
					</ul>
				</li> -->
				<!-- <li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-list"></i>
						 <span class="hidden-xs">Pages</span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="ajax/page_login.html">Login</a></li>
						<li><a href="ajax/page_register.html">Register</a></li>
						<li><a id="locked-screen" class="submenu" href="ajax/page_locked.html">Locked Screen</a></li>
						<li><a class="ajax-link" href="ajax/page_contacts.html">Contacts</a></li>
						<li><a class="ajax-link" href="ajax/page_feed.html">Feed</a></li>
						<li><a class="ajax-link add-full" href="ajax/page_messages.html">Messages</a></li>
						<li><a class="ajax-link" href="ajax/page_pricing.html">Pricing</a></li>
						<li><a class="ajax-link" href="ajax/page_product.html">Product</a></li>
						<li><a class="ajax-link" href="ajax/page_invoice.html">Invoice</a></li>
						<li><a class="ajax-link" href="ajax/page_search.html">Search Results</a></li>
						<li><a class="ajax-link" href="ajax/page_404.html">Error 404</a></li>
						<li><a href="ajax/page_500.html">Error 500</a></li>
					</ul>
				</li> -->
				<!-- <li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-map-marker"></i>
						<span class="hidden-xs">Maps</span>
					</a>
					<ul class="dropdown-menu">
						<li><a class="ajax-link" href="ajax/maps.html">OpenStreetMap</a></li>
						<li><a class="ajax-link" href="ajax/map_fullscreen.html">Fullscreen map</a></li>
						<li><a class="ajax-link" href="ajax/map_leaflet.html">Leaflet</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">
						<i class="fa fa-picture-o"></i>
						 <span class="hidden-xs">Gallery</span>
					</a>
					<ul class="dropdown-menu">
						<li><a class="ajax-link" href="ajax/gallery_simple.html">Simple Gallery</a></li>
						<li><a class="ajax-link" href="ajax/gallery_flickr.html">Flickr Gallery</a></li>
					</ul>
				</li>
				<li>
					 <a class="ajax-link" href="ajax/typography.html">
						 <i class="fa fa-font"></i>
						 <span class="hidden-xs">Typography</span>
					</a>
				</li> -->
				 <li>
					<a class="ajax-link" href="ajax/create_group.php" selected>
						 <i class="fa fa-group"></i>
						 <span class="hidden-xs">Create a Group</span>
					</a>
				 </li>
				 <?php
				 $sql = "SELECT g.group_id,g.group_title FROM groups g, users_groups ug WHERE ug.group_id = g.group_id AND ug.user_id = ".$_COOKIE['user_id'];
				 $result = $conn->query($sql);
				 if ($result->num_rows > 0) {
				    while($row_groups = $result->fetch_assoc()) {
				        ?>
						 <li class="dropdown">
							<a href="#" class="dropdown-toggle">
								<i class="fa fa-group"></i>
								 <span class="hidden-xs"><?php echo $row_groups['group_title']; ?></span>
							</a>
							<ul class="dropdown-menu">
								<li><a class="ajax-link" href="ajax/posts.php?group_id=<?php echo $row_groups['group_id']; ?>"><i class="fa fa-calendar"></i>
						 			<span class="hidden-xs">Posts</span></a>
						 		</li>
						 		<li><a class="ajax-link" href="ajax/groupchat.php?group_id=<?php echo $row_groups['group_id']; ?>"><i class="fa fa-calendar"></i>
						 			<span class="hidden-xs">Group Chat</span></a>
						 		</li>
						 		<li><a class="ajax-link" href="ajax/whiteboard.php?group_id=<?php echo $row_groups['group_id']; ?>"><i class="fa fa-calendar"></i>
						 			<span class="hidden-xs">WhiteBoard</span></a>
						 		</li>
						 		
							</ul>
						</li>
				        <?php
				    }
				 } 
				 ?>

				 <br>
				 <br>

				 <li class="dropdown">
				 <a href="#" class="dropdown-toggle">
					<i class="fa fa-group"></i>
					<span class="hidden-xs">One to One Chat</span>
				 </a>


				 	<ul class="dropdown-menu">
				 	<?php
					 $sql = "SELECT u.id, u.firstname FROM users u LEFT JOIN users_groups ug ON u.id = ug.user_id LEFT JOIN users_groups ug1 ON ug.group_id = ug1.group_id 
WHERE ug1.user_id=".$_COOKIE['user_id']." AND u.id !=".$_COOKIE['user_id']." GROUP BY u.id";
					 $result = $conn->query($sql);
					 if ($result->num_rows > 0) {
					    while($row_group_users = $result->fetch_assoc()) {
					        ?>
				 		<li><a class="ajax-link" href="ajax/onetoonechat.php?id=<?php echo $row_group_users['id']; ?>"><i class="fa fa-user"></i>
						 			<span class="hidden-xs"><?php echo $row_group_users['firstname']; ?></span></a>
						</li>
						<?php
							}
						}
						?>
				 	</ul>





							</li>
				 <!-- <li>
					<a class="ajax-link" href="ajax/posts.php" >
						 <i class="fa fa-calendar"></i>
						 <span class="hidden-xs">Posts</span>
					</a>
				 </li>

				 <li>
					<a class="ajax-link" href="ajax/onetoonechat.php">
						 <i class="fa fa-calendar"></i>
						 <span class="hidden-xs">One to One Chat</span>
					</a>
				 </li>
				 <li>
					<a class="ajax-link" href="ajax/groupchat.php">
						 <i class="fa fa-calendar"></i>
						 <span class="hidden-xs">Group Chat</span>
					</a>
				 </li>
				 <li>
					<a class="ajax-link" href="ajax/whiteboard.php">
						 <i class="fa fa-calendar"></i>
						 <span class="hidden-xs">WhiteBoard</span>
					</a>
				 </li> -->
			</ul>
		</div>
		<!--Start Content-->
		<div id="content" class="col-xs-12 col-sm-10">
			<div id="about">
				<div class="about-inner">
					<h4 class="page-header">Open-source admin theme for you</h4>
					<p>DevOOPS team</p>
					<p>Homepage - <a href="http://devoops.me" target="_blank">http://devoops.me</a></p>
					<p>Email - <a href="mailto:devoopsme@gmail.com">devoopsme@gmail.com</a></p>
					<p>Twitter - <a href="http://twitter.com/devoopsme" target="_blank">http://twitter.com/devoopsme</a></p>
					<p>Donate - BTC 123Ci1ZFK5V7gyLsyVU36yPNWSB5TDqKn3</p>
				</div>
			</div>
			<div class="preloader">
				<img src="img/devoops_getdata.gif" class="devoops-getdata" alt="preloader"/>
			</div>
			<div id="ajax-content"></div>
		</div>
		<!--End Content-->
	</div>
</div>
<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/justified-gallery/jquery.justifiedGallery.min.js"></script>
<script src="plugins/tinymce/tinymce.min.js"></script>
<script src="plugins/tinymce/jquery.tinymce.min.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="js/devoops.js"></script>
</body>
</html>
