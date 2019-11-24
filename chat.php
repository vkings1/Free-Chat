<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: login');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chatters</title>
        <!-- myFavIcon -->
        <link rel="shortcut icon" type="image/png" href="img/favicon.png">
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.css">
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
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
        
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script> -->
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script> -->
</head>
<body>
    <!-- Navbar -->
  <header>
    <div class="logo"><img src="img/favicon.png" alt="Free Chat"></div>
    <nav class="navbar">
      <ul class="login-reg-nab"> 
        <li><a href="notifications"><span><i class="fa fa-bell"></i></span></a><span class="badge badge-info"></span></li>
          <li><a class="messages-notification" href="messages" ><span><i class="fa fa-envelope"></i></span><span class="badge badge-danger"></span></a></li>
        <li><span id="ProfileImage"></span></li> 
      </ul>
    </nav>
    <div class="menu-toggle"><i class="fa fa-bars"></i></div>
  </header>
    <div class="container">
            <!-- search bar -->
      <form method="" action="" id="search-form">
        <div class="row search-bar">
              <div class="search-age">
                  <select class="age" name="search-ages">
                    <option value="">Select Age</option>
                  </select>
              </div>
              <div class="search-gender">
                  <select class="age" name="search-gender">
                    <option>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
              </div>
              <div class="search-country">
                <select id="country" name ="country"></select>
              </div>
              <div class="search-city">
                <select id="state" name="state"><option value="">Select your State</option></select>
              </div>
              <div class="search-users"><button type="submit" name="submit" id="search-button" class="btn btn-info btn-xs">Search</button></div>
            </div><!-- end of search bar -->
        </form>
        <hr>
        <div class="row">
        <div class="display-online-offline">
            <label>Choose you want to display</label>
            <select id="users-online" name="display-all-online-user">
              <option value="">Display all</option>
              <option value="">Display only online users</option>
            </select>
          </div>
          <div class="filter-gender">
              <label>Filter by Gender</label>
              <select id="gender" name="display-all-online-user">
                <option>Select gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
          </div>
        </div>
        <!-- display search result-->
        <div id="search-result"></div>
        <!-- display filter by gender-->
        <div id="filter-by-gender"></div>
         <!-- display only online user-->
         <div id="display-only-online"></div>
        <!-- display all random user -->
         <div class="row" id="display-users-details"></div>
         <div id="data-massage"></div>
         <!-- chatbox style -->
         <div id="user_model_details"></div>
         <!-- Chat history panel -->
         <div class="chat-panel large">
            <div class="header-chat"><span id="profileImageChatHistorys"></span><span class="chat-slide">Chat History</span><span class="badge badge-dark"></span><span><span><i class="fa fa-pencil-square-o"></i></span><span><i class="fa fa-cog"></i></span></span></div>
                <div class="search"><input class="form-control" id="search" name="search" type="text" placeholder="Search Username"></div>
                <div id="chat-search-result"></div>
                  <div id="delete-result"></div>
                  <div id="chat-panel-loaders"><img src="loader/spinner.svg" alt="loader"></div>
                  <div id="chat-panel-loader">
                    <div class="main-chat-history-panel"> 
                      <ul id="chat-history"></ul>
                    </div> 
                   </div>
          </div>
    </div>
  <script src="plugins/jquery/dist/jquery.min.js"></script>
  <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="plugins/jquery-ui/jquery.js"></script>
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="js/query.js"></script>
  <script src="http://chatters.test/js/countries.js"></script>
  <!-- <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script> -->
  <script>populateCountries("country", "state");</script>
  <script>
    $(document).ready(function() {
      $('#search-button').attr('disabled', true);
    
      });
  </script>
</body>
</html>