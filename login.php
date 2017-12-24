<?php 
require_once('db.php');
if (isset($_POST['submit'])){
    $sql = "SELECT id,is_verified FROM users WHERE email LIKE '".$_POST["email"]."' AND password='".md5($_POST['password'])."' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['is_verified'] == 1){
            setcookie("user_id",$row['id'], time() + (60 * 60), "/"); // 1 Hour
            if (isset($_COOKIE['return_url'])){
                $return_url = $_COOKIE['return_url'];
                setcookie("return_url",'', time() - (60 * 60), "/"); // past 1 Hour
            }else{
                $return_url = "http://localhost/collaborationtool/dash/index.php#ajax/create_group.php";
            }
            echo "<script>window.location='".$return_url."';</script>";
            $conn->close();
            exit();
        }else{
            echo "<script type= 'text/javascript'>alert('Please verify your email first');</script>";
        }
    }else{
        echo "<script type= 'text/javascript'>alert('Invalid Email/Password');</script>";
    }
 }
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  

<!-- Mirrored from themes.3rdwavemedia.com/velocity/1.6/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 Sep 2016 19:11:09 GMT -->
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
        
        <!-- ******Login Section****** --> 
        <section class="login-section access-section">
            <div class="container">
                <div class="row">
                    <div class="form-box col-md-offset-2 col-sm-offset-0 xs-offset-0 col-xs-12 col-md-8">     
                        <div class="form-box-inner">
                            <h2 class="title text-center">Log in to Student Teacher Collaboration Tool</h2>                 
                            <div class="row">
                                <div class="form-container col-xs-12 col-md-6 col-md-offset-3">
                                    <form class="login-form" method="POST">              
                                        <div class="form-group email">
                                            <label class="sr-only" for="login-email">Email</label>
                                            <input id="login-email" type="email" name="email" class="form-control login-email" placeholder="Email" required=""   
                                             value="<?php echo $_POST['school_code']; error_reporting(E_ALL ^ E_NOTICE); ?>" maxlength="25">
                                        </div><!--//form-group-->
                                        <div class="form-group password">
                                            <label class="sr-only" for="login-password">Password</label>
                                            <input id="login-password" type="password" name="password" class="form-control login-password" placeholder="Password" required="" maxlength="25">
                                            <p class="forgot-password"><a href="reset-password.html">Forgot password?</a></p>
                                        </div><!--//form-group-->
                                        <button type="submit" name="submit" class="btn btn-block btn-cta-primary">Log in</button>
                                        <div class="checkbox remember">
                                            <label>
                                                <input type="checkbox"> Remember me
                                            </label>
                                        </div><!--//checkbox-->
                                         <p class="lead">Don't have an account yet? <br /><a class="signup-link" href="signup.php">Create your account now</a></p>  
                                    </form>
                                </div><!--//form-container-->
                                <!--  <div class="social-btns col-md-offset-1 col-sm-offset-0 col-sm-offset-0 col-xs-12 col-md-5">  
                                    <div class="divider"><span>Or</span></div>                      
                                    <ul class="list-unstyled social-login">
                                        <li><button class="twitter-btn btn" type="button"><i class="fa fa-twitter"></i>Log in with Twitter</button></li>
                                        <li><button class="facebook-btn btn" type="button"><i class="fa fa-facebook"></i>Log in with Facebook</button></li>
                                        <li><button class="github-btn btn" type="button"><i class="fa fa-github-alt"></i>Log in with Github</button></li>
                                        <li><button class="google-btn btn" type="button"><i class="fa fa-google-plus"></i>Log in with Google</button></li>
                                    </ul>
                                </div><!//social-btns
                            </div> --> <!--//row-->
                        </div><!--//form-box-inner-->
                    </div><!--//form-box-->
                </div><!--//row-->
            </div><!--//container-->
        </section><!--//contact-section-->
    </div><!--//upper-wrapper-->
    
    <!-- ******FOOTER****** --> 
    
    
    <!-- *****CONFIGURE STYLE****** -->  
    <!-- <div class="config-wrapper"> -->
        <!-- <div class="config-wrapper-inner"> -->
            <!-- <a id="config-trigger" class="config-trigger" href="#"><i class="fa fa-cog"></i></a> -->
            <!-- <div id="config-panel" class="config-panel"> -->
                <!-- <h5>Choose Colour</h5> -->
                <!-- <ul id="color-options" class="list-unstyled list-inline"> -->
                    <!-- <li class="theme-1 active" ><a data-style="assets/css/styles.css" href="#"></a></li> -->
                    <!-- <li class="theme-2"><a data-style="assets/css/styles-2.css" href="#"></a></li> -->
                    <!-- <li class="theme-3"><a data-style="assets/css/styles-3.css" href="#"></a></li> -->
                    <!-- <li class="theme-4"><a data-style="assets/css/styles-4.css" href="#"></a></li>                    -->
                    <!-- <li class="theme-5"><a data-style="assets/css/styles-5.css" href="#"></a></li>                      -->
                    <!-- <li class="theme-6"><a data-style="assets/css/styles-6.css" href="#"></a></li> -->
                    <!-- <li class="theme-7"><a data-style="assets/css/styles-7.css" href="#"></a></li> -->
                    <!-- <li class="theme-8"><a data-style="assets/css/styles-8.css" href="#"></a></li>                     -->
                    <!-- <li class="theme-9"><a data-style="assets/css/styles-9.css" href="#"></a></li> -->
                    <!-- <li class="theme-10"><a data-style="assets/css/styles-10.css" href="#"></a></li> -->
                <!-- </ul>//color-options -->
                <!-- <a id="config-close" class="close" href="#"><i class="fa fa-times-circle"></i></a> -->
            <!-- </div>//configure-panel -->
        <!-- </div>//config-wrapper-inner -->
    <!-- </div>//config-wrapper -->
 
    <!-- Javascript -->          
    <script type="text/javascript" src="assets/plugins/jquery-1.12.3.min.js"></script>
    <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="assets/plugins/bootstrap-hover-dropdown.min.js"></script>
    <script type="text/javascript" src="assets/plugins/back-to-top.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery-placeholder/jquery.placeholder.js"></script>
    <script type="text/javascript" src="assets/plugins/FitVids/jquery.fitvids.js"></script>
    <script type="text/javascript" src="assets/plugins/flexslider/jquery.flexslider-min.js"></script> 
    <script type="text/javascript" src="assets/js/main.js"></script>
    
            
</body>

<!-- Mirrored from themes.3rdwavemedia.com/velocity/1.6/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 Sep 2016 19:11:11 GMT -->
</html> 

<?php require_once('footer.php'); ?>

