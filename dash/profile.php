<?php
require_once('../db.php');
$sql="SELECT * FROM users WHERE id=".$_COOKIE['user_id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
<!-- <div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			
			<div class="box-content">
				<h4 class="page-header">Registration form</h4>

				<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
					<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" value="<?php echo $row['name'];  ?>" name="name" placeholder="Enter your name" data-toggle="tooltip" data-placement="bottom">
						</div>
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" value="<?php echo $row['email'];  ?>" name="email" placeholder="Enter your city's name" data-toggle="tooltip" data-placement="bottom">
						</div>
						<label class="col-sm-2 control-label">Current Password</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" name="current_password" placeholder="Enter your current password" data-toggle="tooltip" data-placement="bottom" required="required">
						</div>
						<label class="col-sm-2 control-label">New Password</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" name="new_password" placeholder="Enter your new password" data-toggle="tooltip" data-placement="bottom">
						</div>
						<label class="col-sm-2 control-label">Contact</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" value="<?php echo $row['contact'];  ?>" name="contact" placeholder="Enter your city's name" data-toggle="tooltip" data-placement="bottom">
						</div>
						<label class="col-sm-2 control-label">City</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" value="<?php echo $row['city'];  ?>" name="city" placeholder="Enter your city's name" data-toggle="tooltip" data-placement="bottom">
						</div>
						<label class="col-sm-2 control-label">Country</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" value="<?php echo $row['country'];  ?>" name="country" placeholder="Enter your country's name" data-toggle="tooltip" data-placement="bottom">
						</div>
						
						<label class="col-sm-2 control-label">Education</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" value="<?php echo $row['education'];  ?>" name="education" placeholder="Enter your Education" data-toggle="tooltip" data-placement="bottom">
						</div>
						<label class="col-sm-2 control-label">Institution</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" value="<?php echo $row['institution'];  ?>" name="institution" placeholder="Enter your Institution's name" data-toggle="tooltip" data-placement="bottom">
						</div>
						<label class="col-sm-2 control-label">Profile picture</label>
						<div class="col-sm-4">
							<div class="col-sm-2">
								<img src="profile_photos/<?php echo $row['image_name']; ?>" width="50" height="50">
							</div>
							<div class="col-sm-2">
								<input type="file" name="profile_picture">
							</div>
						</div>
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-4">
							<button type="submit" class="btn btn-success" name="submit_profile">Submit</button>
						</div>
					</div>
				</form>

							
					</div> -->
					<!DOCTYPE html>
					<html>

<head>
	<title></title>
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
</head>
<body>
					
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-content">
				<h4 class="page-header"><?php echo $row['firstname']?>'s profile</h4>
				<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">

					<label class="">NOTE: YOU ARE REQUIRED TO PROVIDE YOUR CURRENT PASSWORD TO SUBMIT THE INFORMATION!</label>

					<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" value="<?php echo $row['firstname'];  ?>" name="name" placeholder="Enter your name">
						</div>
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" value="<?php echo $row['email'];  ?>" name="email" placeholder="Enter your email">
						</div>
						<label class="col-sm-2 control-label" style="padding-top: 15px;">Contact</label>
						<div class="col-sm-4" style="padding-top: 15px;">
							<input type="text" class="form-control" value="<?php echo $row['contact'];  ?>" name="contact" placeholder="Enter your contact info">
						</div>
						<label class="col-sm-2 control-label" style="padding-top: 15px;">City</label>
						<div class="col-sm-4" style="padding-top: 15px;">
							<input type="text" class="form-control" value="<?php echo $row['city'];  ?>" name="city" placeholder="Enter your city">
						</div>
						<label class="col-sm-2 control-label" style="padding-top: 15px;">Country</label>
						<div class="col-sm-4" style="padding-top: 15px;">
							<input type="text" class="form-control" value="<?php echo $row['country'];  ?>" name="country" placeholder="Enter your country">
						</div>
						<label class="col-sm-2 control-label" style="padding-top: 15px;">Address</label>
						<div class="col-sm-4" style="padding-top: 15px;">
							<input type="text" class="form-control" value="<?php echo $row['address'];  ?>" name="address" placeholder="Enter your address">
						</div>
					</div>

					<div class="form-group">
					<label style="padding-left: 15px;">EDUCATION:</label>
					</div>

					<div class="form-group">
					<label class="col-sm-2 control-label" style="padding-top: 15px;">School's Name</label>
						<div class="col-sm-4" style="padding-top: 15px;">
							<input type="text" class="form-control" value="<?php echo $row['schoolname'];  ?>" name="schoolname" placeholder="Enter your school's name">
						</div>
						<label class="col-sm-2 control-label" style="padding-top: 15px;">College's Name</label>
						<div class="col-sm-4" style="padding-top: 15px;">
							<input type="text" class="form-control" value="<?php echo $row['collegename'];  ?>" name="collegename" placeholder="Enter your college's name">
						</div>
						<label class="col-sm-2 control-label" style="padding-top: 15px;">University's Name</label>
						<div class="col-sm-4" style="padding-top: 15px;">
							<input type="text" class="form-control" value="<?php echo $row['universityname'];  ?>" name="universityname" placeholder="Enter your university's name">
						</div>
					</div>

					<div class="form-group">
					<label style="padding-left: 15px;">EMPLOYEMENT:</label>
					</div>

					<div class="form-group">
					<label class="col-sm-2 control-label">Company</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" value="<?php echo $row['companyname'];  ?>" name="companyname" placeholder="Enter your company's name">
						</div>
						<label class="col-sm-2 control-label">Designation</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" value="<?php echo $row['designation'];  ?>" name="designation" placeholder="Enter your designation">
						</div>
						<label class="col-sm-2 control-label" style="padding-top: 15px;">Experience</label>
						<div class="col-sm-4" style="padding-top: 15px;">
							<input type="text" class="form-control" value="<?php echo $row['experience'];  ?>" name="experience" placeholder="Enter your experience">
						</div>
					</div>

					<div class="form-group">
						
					</div>

					<div class="form-group">
					<label class="col-sm-2 control-label">Profile picture</label>
						<div class="col-sm-6">
							<div class="col-sm-2">
								<img src="profile_photos/<?php echo $row['image_name']; ?>" width="60" height="60">
							</div>
							<div class="col-sm-4">
								<input type="file" name="profile_picture">
							</div>
						</div>
					</div>

					<div class="form-group">
						
					</div>

					<div class="form-group">
					<label class="col-sm-2 control-label">Current Password</label>
						<div class="col-sm-4">
							<input type="password" id="current_password" class="form-control" name="current_password" placeholder="Enter your current password" data-toggle="tooltip" data-placement="bottom" required="required">
						</div>
					</div>

					<div class="form-group">
						
					</div>

					<div class="form-group">
						
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-4">
							<button type="submit" class="btn btn-success" name="submit_profile">Submit</button>
						</div>
					</div>

					<div class="form-group">
						
					</div>

					<div class="form-group">
					<label style="padding-left: 15px;">CHANGE PASSWORD:</label>
					</div>

					<div class="form-group">
					<label id="changepass" class="col-sm-4 control-label"><u>Click here to change password</u></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label toggling" style="display: none;">New Password</label>
						<div class="col-sm-4 toggling" style="display: none;">
							<input type="password" class="form-control" name="new_password" placeholder="Enter your new password" data-toggle="tooltip" data-placement="bottom">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label toggling" style="display: none;"></label>
						<div class="col-sm-4 toggling">
							<button type="submit" class="btn btn-success toggling" name="change_password" style="display: none;">change password</button>
						</div>
					</div>

					
				</form>
			</div>
			
		</div>
	</div>
</div>








</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#changepass").click(function(){
			// alert("clicked");
			$(".toggling").show();
		});
		
	});
</script>