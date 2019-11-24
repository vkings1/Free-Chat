<?php
  session_start();
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
    <title>Chatters | Successfully Register</title>
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
<body class="text-center">
    <div id="load"><img src="loader/loaders.gif" alt="loader"></div>
        <div id="contents">
            <div class="container"> 
                <div class="form-successs">
                    <div class="success-register">
                        <span><i class="fa fa-check"></i></span>
                    </div>
                    <div class="thank-you">Congratualations!</div>
                    <h5><p class='text-success-messages'>You have been sucessfully created your account. Please check your email acount to confirm.</p></h5>
                    <div class="success-login"><a href="login">Click here to login</a></div>
                </div>
            </div>
     </div>
    <script src="plugins/jquery/dist/jquery.min.js"></script>
    <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="plugins/jquery-ui/jquery.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <script>
    //load the page first page first
        document.onreadystatechange = function () {
        var state = document.readyState
        if (state == 'interactive') {
            document.getElementById('contents').style.visibility="hidden";
        } else if (state == 'complete') {
            setTimeout(function(){
                document.getElementById('interactive');
                document.getElementById('load').style.visibility="hidden";
                document.getElementById('contents').style.visibility="visible";
            },1000);
        }
        }; //end of the loader of the pagejh
  </script>
</body>
</html>