<?php
    //fetch_user_chat_history.php
    include 'config/dbconnection.php';
    include 'function.php';
    session_start();
    if (isset($_POST['to_user_id'])) {
        $user_id = $_SESSION['user_id'];
        $to_user_id = $_POST['to_user_id'];
        echo fetch_user_chat_history($user_id, $to_user_id, $conn);
    }
   
?>