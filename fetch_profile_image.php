<?php
include 'config/dbconnection.php';
session_start();
$query = "SELECT * FROM `users` WHERE `user_id` = '".$_SESSION['user_id']."'  ";
$stm = $conn->prepare($query);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
        if ($row['profile_status'] == 1) {
            echo ' 
                <ul class="login-reg-nab"> 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 20px;color: #fff;"><img class="default-image" src="'.$row['profile_image'].'"></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown">  
                                <a class="dropdown-item" href="edit-profile?edit='.$row['user_id'].'"><span><i class="fa fa-pencil-square-o"></i></span> Edit profile</a> 
                                <hr>                  
                                <a class="dropdown-item" href="#"><span><i class="fa fa-cog"></i></span> Settings & Privacy</a>
                                <hr>
                                <a class="dropdown-item" href="logout"><span><i class="fa fa-sign-out"></i></span> Log out</a>
                            </div>
                    </li>
                </ul>
            ';   
        }else {
          echo ' 
          <ul class="login-reg-nab"> 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 20px;color: #fff;"><img class="secondary-profile" src="profile-images/defualtprofile.jpg"></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown">  
                        <a class="dropdown-item" href="edit-profile?edit='.$row['user_id'].'"><span><i class="fa fa-cog" aria-hidden="true"></i></span> Edit profile</a> 
                        <hr>                  
                        <a class="dropdown-item" href="#"><span><i class="fa fa-cog" aria-hidden="true"></i></span> Settings & Privacy</a>
                        <hr>
                        <a class="dropdown-item" href="logout"><span><i class="fa fa-sign-out"></i></span> Log out</a>
                    </div>
                </li>
            </ul>
          ';   
        }
    }
?>