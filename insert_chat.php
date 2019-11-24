<?php
include 'config/dbconnection.php';
include 'function.php';
   session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //$image = $_FILES['img'];
  //$fileTmpName = $_FILES['img']['tmp_name'];
   $to_user_id = $_POST['to_user_id'];
   $from_user_id = $_SESSION['user_id'];
   $username = $_SESSION['username'];
   $chat_messages = $_POST['chat_message'];
   $image = $_SESSION['profile_image'];
   $user_id = $_SESSION['user_id'];
   $query = "INSERT INTO `chat_messages` (username, user_id, to_user_id, from_user_id, chat_messages, profile_image)
   VALUES (:username, :user_id, :to_user_id, :from_user_id, :chat_messages, :profile_image)";
   $stm = $conn->prepare($query);
   $stm->bindParam(':username', $username);
   $stm->bindParam(':user_id', $user_id);
   $stm->bindParam(':to_user_id', $to_user_id);
   $stm->bindParam(':from_user_id', $from_user_id);
   $stm->bindParam(':chat_messages', $chat_messages);
   $stm->bindParam(':profile_image', $image);
   if ($stm->execute()) {
      echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $conn);
   }
}

?>