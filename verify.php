<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chatters | Activation</title>
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
            <?php
                    include 'config/dbconnection.php'; 
                    if (isset($_GET['activation-code'])) {

                        $activationcode = $_GET['activation-code'];

                        $sql = "SELECT `activation_code`, `verefied_user` FROM `users` WHERE verefied_user = 0 AND activation_code = :activation_code LIMIT 1;"; 
                        $statement = $conn->prepare($sql);
                        $statement->bindParam(':activation_code', $activationcode);
                        $statement->execute();

                        $result = $statement->rowCount();

                        if ($result > 0) {
                            $sql = "UPDATE users SET verefied_user = 1 WHERE  activation_code = :activation_code LIMIT 1;";
                            $statement = $conn->prepare($sql);
                            $statement->bindParam(':activation_code', $activationcode);
                            $statement->execute();

                            if ($sql) {
                                echo '<div class="success-verified">
                                        <div class="verity-success">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="congrats">Congratualations!</div>
                                        <h5><p class="success-verify">Your account has been verified. Enjoy free chatting, meet new friends, chat with men and women all over the world.</p><h5> 
                                        <div class="verified-login"><a href="login">Please click here to login</a></div>
                                    </div>';
                            }else {
                                echo '<div class="warning-verified"> 
                                        <div class="cannot-verify">
                                            <i class="fa fa-warning"></i>
                                        </div>
                                        <div class="warning">Cannot verify your account. Try aging later.</div>
                                        <h5><p>If you cannot verify you account.Please contact chatters.com</p><h5>
                                        <div class="verified-warning"><a href="contact">Please click here to contact Chatters</a></div>
                                    </div>';
                            }
                        }else {
                            echo '<div class="invalid-verified">
                                    <div class="invalid-verify">
                                        <i class="fa fa-warning"></i>
                                    </div>
                                    <div class="invalid">The account is invalid or already verified.</div>
                                    <h5><p class="invalid-messge">Please contact chatters, for more details to your account.<p></h5>
                                    <div class="verified-warning"><a href="contact">Please click here to contact Chatters.</a></div>
                            </div>';
                        }

                    }else {
                        echo '<div class="wrong-verified">
                                    <div class="wrong">
                                        <i class="fa fa-close"></i>
                                    </div>
                                    <div class="went-wrong"> Something went wrong</dvi>
                                    <div class="back"><a href="register">Please click here to register</a></div>
                        
                            </div>';
                    }
                ?>
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