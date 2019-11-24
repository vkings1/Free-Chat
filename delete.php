<?php
 include 'config/dbconnection.php';
 session_start();
$id = $_REQUEST['id'];
$sql = "DELETE FROM chat_messages WHERE from_user_id = '$id' ";
$statement = $conn->prepare($sql);
$statement->execute();     

?>
