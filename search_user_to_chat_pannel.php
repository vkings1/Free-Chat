<?php
 include 'config/dbconnection.php';
 session_start();
//  $query =" SELECT * FROM chat_messages WHERE to_user_id LIKE '".$_POST['search']."%' ORDER BY chat_message_id limit 1";
 $query = "SELECT * FROM chat_messages WHERE to_user_id LIKE '".$_POST['search']."%' GROUP BY `user_id` ";
 $stm = $conn->prepare($query);
 $stm->execute();
 $result = $stm->fetchAll(PDO::FETCH_ASSOC);
//  $output = '<ul class="list-unstyled" style="padding:0 20px 0 20px; margin: 20px 0">';
 if ($result > 0) {
    foreach($result as $row){
        echo '<ul><li><a class="start_chat" data-touserid="'.$row['from_user_id'].'" data-tousername="'.$row['to_user_id'].'"><img class="chatbox-img" src="'.$row['profile_image'].'" > '.$row['username'].'</a></li>
        <li</li>
        </ul>
        ';
    }
 }else {
    echo'No user found';
 }
 
?>