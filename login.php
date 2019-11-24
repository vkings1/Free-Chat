<?php
  session_start();
  include 'csrf.php';
  if (isset($_SESSION['user_id'])) {
      header('Location: chat');
      exit();
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
    <title>Chatters | Login</title>
    <!-- myFavIcon -->
    <link rel="shortcut icon" type="image/png" href="http://chatters.test/img/favicon.png">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="http://chatters.test/plugins/bootstrap/dist/css/bootstrap.css">
    <!-- Custom fonts for this template -->
    <link href="http://chatters.test/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jquery ui -->
    <link href="http://chatters.test/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <!-- Core CSS for styling -->
    <link rel="stylesheet" href="http://chatters.test/css/app.css">
</head>
<body>
  <div id="progress"><img src="loader/loaders.gif" alt="loader"></div>
  <div id="document-loader">
    <!-- Navbar -->
  <header>
    <div class="logo"><img src="http://chatters.test/img/favicon.png" alt="Free Chat"></div>
    <nav class="navbar">
      <ul class="login-reg-nab">
          <li><a class="nav-btn" href="login">Login</a></li>
          <li><a class="nav-btn" href="register">Free Registration</a></li>
      </ul>
    </nav>
    <div class="menu-toggle"><i class="fa fa-bars"></i></div>
  </header>
  <div class="container">
    <div class="wrapper">
      <div class="left-info">
        <h1 class="free-chat-heading">Free Chat, Free Call, Free Vedio Call, Chat, Call, Vedio Online With Free Registration</h1>
        <p class="welcome_paragraph">This web site is an online free chat, call, vedio call. You can meet new friends from all over the world. No download, Create your account & free registration needed, No payment required.</p>
        <div class="friendly-img"><img src="img/friendly.png" alt="friendly"></div><br><br>
        <h4>Friendly Website</h4> 
        <div><p>Meet new single women and men everyday without limits, make friendships, for free you can have a live discussion now with free registration, No payment required</p></div>
        <div class="mobile-img"><img src="img/mobile.png" alt="mobile"></div><br><br>
        <h4>Friendly mobile</h4>
        <p class="friendly-mobile-p">Chatters supports mobile device, so you can use it whenever you go! </p>
      </div>
      <div class="center-forms">
        <div class="heading-reg">Chatters Login</div>
        <div class="signin-logo"><img src="img/onlinetips/chat.jpg" alt=""></div> 
        <div class="myform">
          <form action="" method="post" id="login" accept-charset="UTF-8">
            <div id="result"></div>
            <input type="hidden" name="csrf" value="<?php echo make_form_token(); ?>">
            <div class="form-group">
              <input type="text" class="form-control" name="username">
              <label class="email">Username or Email</label>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password">
              <label class="pass">Password</label>
            </div>
            <div class="form-group">
              <div class="check-forgot">
                <span><input type="checkbox" name="rememberme" id=""> Remember me</span>
                <span><a href="forgot-password">Forgot password?</a></span>  
              </div> 
            </div>
            <div class="form-group"><button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" id="btnlogin">Sign in</button></div>
            <hr>
            <div class="form-group"><div class="creat-accnt"><a href="register">Create an account</a></div></div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <footer class="indexfooter">
    <div class="footer-first-heading">
      <hr>
      <p><b>Chatters</b> is a free chat, free call, free vedio call website where you can have live chat with single women and men, you can discuss with random strangers from USA, Canada, United Kingdom, Australia and people from all over the world, at the same time, any time you can start a private conversation to meet girls and boys living nearby in your area.</p>
    </div>
    <div class="footer-second-heading">
      <div class="copy-rigth">Copyright &copy 2019 chatterrs.com | All Rights Reserved</div>
      <ul class="privacy-security">
        <li><a href="#">FAQ</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Cookie Policy</a></li>
        <li><a href="#">Safety</a></li>
        <li><a href="#">Contact us</a></li>
      </ul>
    </div>
  </footer>
  </div>
  <script src="plugins/jquery/dist/jquery.min.js"></script>
  <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="plugins/jquery-ui/jquery.js"></script>
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="js/app.js"></script>
  <script src="js/register.js"></script>
</body>
</html>