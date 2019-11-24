<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Messages</title>
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
         <!-- Core emoji -->
        <!-- <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css"> -->
</head>
<body>
 <!-- Navbar -->
 <header>
    <div class="logo"><img src="img/favicon.png" alt="Free Chat"></div>
    <nav class="navbar">
      <ul class="login-reg-nab"> 
        <li><a href="http://chatters.test"><span><i class="fa fa-home"></i></span></a></li>
        <li><a href="notifications"><span><i class="fa fa-bell"></i></span></a><span class="badge badge-info"></span></li>
          <li><a class="messages-notification" href="messages" ><span><i class="fa fa-envelope"></i></span><span class="badge badge-danger"></span></a></li>
        <li><span id="ProfileImage"></span></li> 
      </ul>
    </nav>
    <div class="menu-toggle"><i class="fa fa-bars"></i></div>
  </header>
  <div class="container">
    <div class="row">
        <div class="display-ChatHistory">
          <div class="display-ChatHIstory-Header"><span>Messaging</span> <span><i class="fa fa-pencil-square-o"></i></span><span><i class="fa fa-cog"></i></span></span></div>
          <div class="search"><input class="form-control" id="search" name="search" type="text" placeholder="Search Username"></div>
          <div id="search-result"></div>
          <div class="main-chat-history-panel"> 
            <ul id="chat-history"></ul>
          </div> 
        </div>
        <div class="messaging">
          <h1>sample</h1>
        </div>
    </div>
  </div>

<script src="plugins/jquery/dist/jquery.min.js"></script>
  <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="plugins/jquery-ui/jquery.js"></script>
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="js/query.js"></script>
  <!-- <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script> -->
</body>
</html>