<?php
include 'config/dbconnection.php';
include 'function.php';
session_start();
$query = "SELECT * FROM `users` WHERE `user_id` = '".$_SESSION['user_id']."' ";
$stm = $conn->prepare($query);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
        if ($row['profile_status'] == 1) {
            echo '<img class="chat-image-panel" src="'.$row['profile_image'].'"><span class="badge badge-light"></span>';   
        }else {
             echo '<img class="panel-secondary-profile" src="profile-images/defualtprofile.jpg"><span class="badge badge-light"></span>';   
        }
    }
?>