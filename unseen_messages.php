<?php
include 'config/dbconnection.php';
session_start();
  //fetch data to display into messages notification
  if (isset($_POST['view'])) {
        $query_1 = "SELECT * FROM chat_messages WHERE to_user_id = '".$_SESSION['user_id']."' and status = 0 GROUP BY `user_id` ";
        $stm = $conn->prepare($query_1);
        $stm->execute();
        $count = $stm->rowCount();
        $output = '';
        $data = array(
            'messages' => $output,
            'unseen_messages' => $count
          );
          echo json_encode($data);
  }

 ?> 
