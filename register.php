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
    
    <title>Chatters | Free Rigestration</title>
    <!-- myFavIcon -->
    <link rel="shortcut icon" type="image/png" href="http://chatters.test/img/favicon.png">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.css">
    <!-- Custom fonts for this template -->
    <link href="http://chatters.test/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jquery ui -->
    <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
     <!-- Google Fonts -->
     <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,600"> -->
    <!-- Core CSS for styling -->
    <link rel="stylesheet" href="http://chatters.test/css/app.css">
</head>
<body>
  <div id="progress"><img src="loader/loaders.gif" alt="loader"> </div>
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
        <h1 class="reg-heading">Welcome  to Chatters</h1>
        <p class="reg-paragraph"> <b>Chatters</b> when you register an account you can chat, call a defferent poeple all over the world. You can add friends, recieve mesages even if you are offline, you can upload images to your profile.</p>
        <div class="friendly-img"><img src="img/friendly.png" alt="friendly"></div><br><br>
        <h4>Friendly Website</h4> 
        <div><p class="reg-2-pag">You find a new friends, new love without limits wihtout pay anything, it's free to use.</p></div>
        <div class="mobile-img"><img src="img/mobile.png" alt="mobile"></div><br><br>
        <h4>Friendly mobile</h4>
        <p class="reg-3-pag">Chatters supports frienly smobile device, so you can use it whenever you go! </p>
      </div>
      <div class="center-forms">
      <div class="heading-reg">Chatters Free Registration</div>
        <div class="signin-logo"><img src="img/onlinetips/chat.jpg" alt=""></div> 
        <div class="myform">
          <form method="post" id="registerform" accept-charset="UTF-8">
            <div id="result"></div>
            <input type="hidden" name="csrf" value="<?php  echo make_form_token(); ?>">
            <div class="form-group">
              <input type="text" class="form-control" name="username">
              <span class="highlight">
              </span><span class="bar"></span>
              <label class="reg-usernames">Username</label>
            </div>
            <div class="form-group">
                <div class="male-female">
                  <select class="gender" name="gender">
                    <option value="">Select you gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <span class="select-highlight"></span>
                <span class="select-bar"></span>
                <label class="select-label">Gender</label>
			    	</div>
            </div>
            <div class="form-group">
              <div class="select-age">
                <select class="ages" name="age">
                  <option value="">Select you Age</option>
                </select>
                <span class="select-highlight"></span>
                <span class="select-bar"></span>
                <label class="select-label">Age</label>
              </div> 
            </div>
            <div class="form-group">
              <div class="select-country">
                <select class="country" id="country" name ="country"></select>
                <span class="select-highlight"></span>
                <span class="select-bar"></span>
                <label class="select-label" id="selectcity">Country</label>
              </div>
            </div>
            <div class="form-group">
              <div class="select-city">
               <select class="city" id="state" name="state"><option value="">Select your State</option></select>
               <span class="select-highlight"></span>
                <span class="select-bar"></span>
                <label class="select-label">state</label>
              </div> 
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email">
              <span class="highlight">
              </span><span class="bar"></span>
              <label class="reg-email">E-mail address</label>
              <p class="text-muted">You can confirm your account to this inbox. We’ll never share your email address with anyone.</p>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password">
              <span class="highlight">
              </span><span class="bar"></span>
              <label class="reg-pass">Password</label>
              <p class="pass-chac">Make sure it's at least 15 characters OR at least 8 characters including a number and a lowercase letter. <a href="#">Learn more.</a> </p>
            </div>
            <div class="agree">
              <p class="clicking-agre">By clicking “Register” below, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Statement</a>. We’ll occasionally send you account-related emails.</p>
            </div>
            
            <div class="form-group"><button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" id="btnreg">Register</button></div>
            
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
  <script src="http://chatters.test/plugins/jquery/dist/jquery.min.js"></script>
  <script src="http://chatters.test/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="http://chatters.test/plugins/jquery-ui/jquery.js"></script>
  <script src="http://chatters.test/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="http://chatters.test/js/register.js"></script>
  <script src="http://chatters.test/js/countries.js"></script>
  <script language="javascript">
    populateCountries("country", "state"); // first parameter is id of country drop-down and second parameter is id of state drop-down
  </script>

</body>
</html>