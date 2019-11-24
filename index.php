<?php 
session_start();
include 'csrf.php';
//session by login
if (isset($_SESSION['user_id'])) {
    header('Location: chat');
    exit();
}
//visitors cookie
if (!isset($_COOKIE['visitor_id'])) {
  setcookie('visitor_id',  sha1('visitors'), time() + 31553280, '/');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Free Chat Rooms, Free Online Chat All Over The World</title>
    <!-- myFavIcon -->
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.css">
    <!-- Custom fonts for this template -->
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jquery ui -->
    <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
     <!-- Google Fonts -->
     <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,600"> -->
    <!-- Core CSS for styling -->
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
  <div id="load"><img src="loader/loaders.gif" alt="loader"></div>
  <div id="content">
      <!-- Navbar -->
    <header class="chatters-heade">
      <div class="logo"><img src="img/favicon.png" alt="Free Chat"></div>
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
          <div><p class="welcome-pag">Meet new single women and men everyday without limits, make friendships, for free you can have a live discussion now with free registration, No payment required</p></div>
          <div class="mobile-img"><img src="img/mobile.png" alt="mobile"></div><br><br>
          <h4>Friendly mobile</h4>
          <p class="friendly-mobile-p">Chatters supports mobile device, so you can use it whenever you go! </p>
        </div>
        <div class="center-forms">
          <div class="signin-logo"><img src="img/onlinetips/chat.jpg" alt=""></div> 
          <div class="myform">
            <form action="" method="post" id="login" accept-charset="UTF-8">
              <div id="result"></div>
              <input type="hidden" name="csrf" value="<?php echo make_form_token(); ?>">
              <div class="form-group">
                <input type="text" class="form-control" name="username" value="" id="inputUsername">
                <span class="highlight">
                </span><span class="bar"></span>
                <label class="email">Username or Email</label>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" value="" id="inputPassword">
                <span class="highlight">
                </span><span class="bar"></span>
                <label class="pass">Password</label>
              </div>
              <div class="form-group">
                <div class="check-forgot">
                  <span><input type="checkbox" name="remember-me" id="checkbox"> Remember me</span>
                  <span><a href="forgot-password">Forgot password?</a></span>  
                </div> 
              </div>
              <div class="form-group"><button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" id="btnlogin">Sign in</button></div>
              <hr>
              <div class="form-group"><div class="creat-accnt"><a href="register">Create an account</a></div></div>
            </form>
          </div>
        </div>
        <div class="rigth-tips">
          <div class="heading-tips">Online Chat tips</div>
          <ul class="online-chat-tips">
            <li>
              <div class="img-tips"><img src="img/onlinetips/relationship.jpg" alt="mobile"></div>
              <p class="tips"><a href="#" target="_blank">People learn from being in a relationship.</a></p>
            </li>
            <li>
              <div class="img-tips"><img src="img/onlinetips/hands-new.jpg" alt="mobile"></div>
              <p class="tips"><a href="#" target="_blank">Dating and online chat tips.</a></p>
            </li>
            <li>
              <div class="img-tips"><img src="img/onlinetips/chat.jpg" alt="mobile"></div>
              <p class="tips"><a href="#" target="_blank">How to talk to stranger.</a></p>
            </li>
            <li>
              <div class="img-tips"><img src="img/onlinetips/dialog-new.png" alt="mobile"></div>
              <p class="tips"><a href="#" target="_blank">Rules you need about online chatting.</a></p>
            </li>
            <li>
              <div class="img-tips"><img src="img/onlinetips/people-new.jpg" alt="mobile"></div>
              <p class="tips"><a href="#" target="_blank">Online dating tips to help yous.</a></p>
            </li>
          </ul>
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
          <li><a href="contact">Contact us</a></li>
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
  <script>
    //load the page first page first
    document.onreadystatechange = function () {
      var state = document.readyState
      if (state == 'interactive') {
          document.getElementById('content').style.visibility="hidden";
      } else if (state == 'complete') {
          setTimeout(function(){
              document.getElementById('interactive');
              document.getElementById('load').style.visibility="hidden";
              document.getElementById('content').style.visibility="visible";
          },1000);
      }
    }; //end of the loader of the pagej
  </script>
</body>
</html>