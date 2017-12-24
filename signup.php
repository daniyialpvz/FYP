<?php 
require_once('db.php');
require_once('inc/functions.php');
if (isset($_POST['submit']) && $_POST["password"] == $_POST["confirmpassword"]){

    $sql = "SELECT email FROM users WHERE email LIKE '".$_POST["email"]."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<script type= 'text/javascript'>alert('Email already exists');</script>";
    }else{
        $sql = "INSERT INTO users (firstname, lastname, email, password, contact)
    VALUES ('".$_POST["firstname"]."', '".$_POST["lastname"]."' ,'".$_POST["email"]."','".md5($_POST["password"])."','".$_POST["phone"]."')";

        if ($conn->query($sql) === TRUE) {
            $msg="Please click on the link below to verify your email address:<br>
            <a href=\"http://localhost:8000/collaborationtool/verify.php?email=".$_POST['email']."\">Verify Now</a>";
            send_mail($_POST['name'],$_POST['email'],"Verify your email address",$msg);
            echo "<script type= 'text/javascript'>alert('Your account has been created successfully. Please verify your email address to continue');</script>";
            echo "<script>window.location='index.php';</script>";
        } else {
            echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error."');</script>";
        }
           $conn->close();
        exit();
    }
 }
 else{
    echo "<script type= 'text/javascript'>alert('passwords dont match');</script>";
 }





 
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  


<head>

    <title>Login to Student Teacher Collaboration Tool</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">    
    <link rel="shortcut icon" href="favicon.ico">  
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic,900,900italic,300italic,300' rel='stylesheet' type='text/css'> 
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100' rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">   
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="assets/plugins/flexslider/flexslider.css">
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
 <script type="text/javascript" src="assets/plugins/jquery-1.12.3.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head> 

<body class="login-page access-page has-full-screen-bg">
    <div class="upper-wrapper">
        <!-- ******HEADER****** -->
        <header class="header">  
            <div class="container">       
                <h1 class="logo">
                    <a href="index.php"><span class="logo-icon"></span><span class="text">Let's collab!</span></a>
                </h1><!--//logo-->
                                     
            </div><!--//container-->
        </header><!--//header-->
        
        <!-- ******Signup Section****** --> 
        <section class="signup-section access-section section">
            <div class="container">
                <div class="row">
                    <div class="form-box col-md-offset-2 col-sm-offset-0 xs-offset-0 col-xs-12 col-md-8">     
                        <div class="form-box-inner">
                            <h2 class="title text-center">Sign up now</h2>  
                            <p class="intro text-center">It only takes 3 minutes!</p>               
                            <div class="row">
                                <div class="form-container col-xs-12 col-md-6 col-md-offset-3">
                                    <form class="signup-form" method="POST">  
                                    <div class="form-group name">
                                            <label class="sr-only" for="signup-name">First Name</label>
                                            <input id="first-name" type="text" onkeypress='return event.charCode != 32' class="form-control login-name" name="firstname" placeholder="First name" required="" 
                                            maxlength="25">
                                        </div><!--//form-group-->            
                                         <div class="form-group name">
                                            <label class="sr-only" for="signup-name">Last Name</label>
                                            <input id="last-name" type="text" onkeypress='return event.charCode != 32' class="form-control login-name" name="lastname" placeholder="Last name" required="" 
                                            maxlength="25">
                                        </div><!--//form-group-->    
                                        <div class="form-group email">
                                            <label class="sr-only" for="signup-email">Your email</label>
                                            <input id="signup-email" type="email" onkeypress="return event.charCode != 32" class="form-control login-email" name="email" placeholder="Your email" required="" maxlength="25">
                                        </div><!--//form-group-->
                                        <div class="form-group password">
                                            <label class="sr-only" for="signup-password">Your password</label>
                                            <input id="signup-password" type="password" class="form-control login-password" name="password" placeholder="Password" required="" maxlength="25">
                                        </div><!--//form-group-->
                                        <div class="form-group password">
                                            <label class="sr-only" for="signup-confirmpassword">Confirm Password</label>
                                            <input id="signup-confirm-password" type="password" class="form-control login-password" name="confirmpassword" placeholder="Confirm Password" required="" maxlength="25">
                                        </div>
                                        <div class="form-group phone">
                                            <label class="sr-only" for="signup-phone">Your phone number</label>
                                            <input id="signup-phone" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control login-phonenumber" name="phone" placeholder="Your phone number" required="" maxlength="25">
                                        </div><!--//form-group-->
                                       

                                        <button type="submit" class="btn btn-block btn-cta-primary" name="submit">Sign up</button>
                                        <p class="note">By signing up, you agree to our terms of services and privacy policy.</p>
                                        <p class="lead">Already have an account? <a class="login-link" id="login-link" href="login.php">Log in</a></p>  
                                    </form>
                                </div><!--//form-container-->
                                
                        </div><!--//form-box-inner-->
                    </div><!--//form-box-->
                </div><!--//row-->
            </div><!--//container-->
        </section><!--//signup-section-->
    </div><!--//upper-wrapper-->
    
    <!-- ******FOOTER****** --> 
    
    
   
 
    <!-- Javascript -->          
  
    <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="assets/plugins/bootstrap-hover-dropdown.min.js"></script>
    <script type="text/javascript" src="assets/plugins/back-to-top.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery-placeholder/jquery.placeholder.js"></script>
    <script type="text/javascript" src="assets/plugins/FitVids/jquery.fitvids.js"></script> 
    <script type="text/javascript" src="assets/plugins/flexslider/jquery.flexslider-min.js"></script>  
    <script type="text/javascript" src="assets/js/main.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
        var st = '';
   $("#signup-password").blur(function(){
        var str1 = $("#signup-password").val();
        if (!str1.replace(/\s/g, '').length) {
        // alert("string only contained spaces");
        $("#signup-password").val("");
        }
        st = str1;
    });

    $("#signup-confirm-password").blur(function(){
        var str2 = $("#signup-confirm-password").val();
        if (!str2.replace(/\s/g, '').length) {
        // alert("string only contained spaces");
        $("#signup-confirm-password").val("");
        }
       
       if (st != str2){
        alert("passwords are different!");
         $("#signup-password").val("");
          $("#signup-confirm-password").val("");

       }
    });


}); 
</script>
            
</body>


</html> 



<?php require_once('footer.php'); ?>

