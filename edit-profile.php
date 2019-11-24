<?php
  include 'config/dbconnection.php';
  session_start();
  include 'csrf.php';
  $user_id = $_GET['edit'];

   $sql = "SELECT * FROM users WHERE user_id = :user_id";
  //preapre the query
  $statement = $conn->prepare($sql);
  $statement->bindParam(':user_id', $user_id );
  $statement->execute();
  $result = $statement->fetch(PDO::FETCH_OBJ);
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chatters | Edit Profile</title>
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
    <!-- dashboar of chatting -->
     <!-- Navbar -->
  <header>
    <div class="logo"><img src="img/favicon.png" alt="Free Chat"></div>
    <nav class="navbar">
      <ul class="login-reg-nab"> 
      <li><a href="http://chatters.test"><span><i class="fa fa-home"></i></span></a></li>
        <li><a href="notifications"><span><i class="fa fa-bell"></i></span></a><span class="badge badge-info"></span></li>
          <li><a class="messages-notification" href="messages" ><span><i class="fa fa-envelope"></i></span><span class="badge badge-danger"></span></a>
            <ul class="messages-dropdow"></ul>
          </li>
        <li><span id="ProfileImage"></span></li> 
      </ul>
    </nav>
    <div class="menu-toggle"><i class="fa fa-bars"></i></div>
  </header>
 
    <div class="container">
    <div id="upadte-result"></div>
	    <div class="container-fluid">
	                <div class="row">
	                    <form method="post" action="/update.php" enctype="multipart/form-data" id="update">
                      <input type="hidden" id="id_user" name="id_user" value="<?php echo $result->user_id ?>">
                      <input type="hidden" id="csrf" name="csrf" value="<?php echo make_form_token(); ?>">
	                    <div class="column col-lg-12">
                                    <div class="title"><h3>Profile Details</h3></div>
                                    <hr>
                    					<div class="row">
	                    					<div class="col-lg-4 col-md-12 col-sm-12">
	                    						<!-- Edit profile photo -->
                                                <div class="img-body ">
                                                    <span class="photo-banner"><img src="img/photo-banner/photo-banner.jpg" alt="photo-banner" id="photo-banner"></span> 
                                                    <span class="edit-photo"><img id="old-img" src='<?php echo $result->profile_image?>' alt='old_image'/></span> 
                                                    <label for="edit-img"><i class="fa fa-pencil"></i></label>
                                                    <input type="file" id="edit-img" name="image" accept="image/jpeg">
                                                </div>
	                    					</div>
	                    					<div class="col-lg-8 col-md-12 col-sm-12">
					                                <div class="row">
					                                	<!-- Form Group -->
					                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">                                    
                                                  <input class="form-control edit" type="text" name="username"  value="<?php echo $result->username; ?>">
                                                  <span class="highlight">
                                                  </span><span class="bar"></span>
                                                  <label class="edit-usernames">Username</label>
					                                    </div>

					                                    <!-- Form Group -->
					                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                  <input class="form-control edit" type="text" name="age"  value="<?php echo $result->age; ?>">
                                                  <span class="highlight">
                                                </span><span class="bar"></span>
                                                <label class="edit-age">Age</label>
                                                           
					                                    </div>

					                                    <!-- Form Group -->
					                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                  <input class="form-control edit" type="text" name="gender"  value="<?php echo $result->gender; ?>">
                                                  <span class="highlight">
                                                  </span><span class="bar"></span>
                                                  <label class="edit-gender">Gender</label>
					                                    </div>

					                                    <!-- Form Group -->
					                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                  <input class="form-control edit" type="text" name="country"  value="<?php echo $result->country; ?>">
                                                <span class="highlight">
                                                </span><span class="bar"></span>
                                                <label class="edit-country">Country</label>
					                                    </div>

					                                    <!-- Form Group -->
					                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                  <input class="form-control edit" type="text" name="state"  value="<?php echo $result->province; ?>">
                                                  <span class="highlight">
                                                  </span><span class="bar"></span>
                                                  <label class="edit-state">State</label>
                                              </div>
                                                         <!-- Form Group -->
					                                    <div class="form-group  col-lg-6 col-md-6 col-sm-12">
                                                  <input type="text" name="password" class="form-control edit" value="<?php echo $result->password; ?>">
                                                  <span class="highlight">
                                                  </span><span class="bar"></span>
                                                  <label class="edit-password">Password</label>
					                                    </div>

                                                        <!-- Form Group -->
					                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <input class="form-control edit" type="text" name="email"  value="<?php echo $result->email; ?>" disabled>
                                                    <span class="highlight">
                                                    </span><span class="bar"></span>
                                                    <label class="edit-email">Email</label>
                                                </div>
                                                       
					                                    <!-- Form Group -->
					                                    <div class="form-group text-right col-lg-12 col-md-12 col-sm-12">
                                                  <input class="btn btn-primary" type="submit" name="submit" value="upadate" id="edit-btn">
					                                    </div>
                                                    </div>
                                                </div>
                    						</form>

	            </div>
	        </div>
	</div>
    <script src="plugins/jquery/dist/jquery.min.js"></script>
  <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="plugins/jquery-ui/jquery.js"></script>
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="js/query.js"></script>

  <script>
   //preview edit image & file to chatbox & file
    $(function() {
        $("#edit-img").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    function imageIsLoaded(e) {
        $('#old-img').attr('src', e.target.result);
    };
    $('input').blur(function() {
        var $this = $(this);
        if ($this.val())
        $this.addClass('used');
        else
        $this.removeClass('used');
    });
  </script>
  
</body>
</html>