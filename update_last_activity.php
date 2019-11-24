<?php
include 'config/dbconnection.php';
include 'function.php';
session_start();
//first query to the last activty table
$query = "UPDATE `user_login_details` SET `user_last_activity`=  now() WHERE `user_details_id` = '".$_SESSION['user_details_id']."'";
$stm = $conn->prepare($query);
$stm->execute();
//second query to user chatbox last active
$user_id =  $_SESSION['user_id'];
$sub_query_2 = "UPDATE `users` SET `last_activity` = now() WHERE `user_id` = '$user_id'";
$stm2 = $conn->prepare( $sub_query_2);
$stm2->execute();
//thrid query to user chat message chat panel last active

// $sub_query_2 = "UPDATE `chat_messages` SET `last_activity` = now() WHERE `user_id` = '$user_id'";
// $stm2 = $conn->prepare( $sub_query_2);
// $stm2->execute();

?>