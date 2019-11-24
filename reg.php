<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require './vendor/autoload.php';
include 'config/dbconnection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (!isset($_SESSION['token']) || $_POST['csrf'] !== $_SESSION['token']) {
        echo "<div class='text-danger'>There was an problem submitting your request. Please refresh your browser or try again later</div>";
    }else {
        $username = $_POST['username'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $activationcode = md5(time().$username);
        
        if (empty($username) || empty($gender) || empty($age) || empty($country) || empty($state) || empty($email) || empty($password)) {
            echo "<div  class='alert alert-danger'>All fields are required</div>";
        }else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<div  class='alert alert-danger'>Invalid e-mail address</div>";  
            }else {
                if (!preg_match('/^[a-zA-Z0-9._]*$/', $password)) {
                    echo "<div  class='alert alert-danger'>The password does not meet the requirements</div>";  
                }else {
                    # insert new record
                    $sql = "SELECT username FROM users WHERE username = :username";
                    $statement = $conn->prepare($sql);            
                    $statement->bindParam('username', $username);
                    $statement->execute();
                    $row = $statement->rowCount();
                    if ($row > 0) {
                        echo "<div  class='alert alert-danger'>The username <b>$username </b> is all ready exist</div>";
                    }else {
                        $sql = "INSERT INTO `users`(`username`, `email`, `gender`,`password`, `activation_code`, `age`, `country`, `province`) 
                                VALUES (:username, :email, :gender, :password, :activation_code, :age, :country, :province)";
                            $stm = $conn->prepare($sql);
                            $stm->bindParam(':username', $username);
                            $stm->bindParam(':email', $email);
                            $stm->bindParam(':gender', $gender);
                            $stm->bindParam(':password', $hash_password);
                            $stm->bindParam(':activation_code', $activationcode);
                            $stm->bindParam(':age', $age);
                            $stm->bindParam(':country', $country);
                            $stm->bindParam(':province', $state);
                            $stm->execute();
                        if ($sql) {
                            $mail = new PHPMailer;
                           try {
                                $mail->isSMTP();                                           
                                $mail->Host       = 'smtp.gmail.com';                      
                                $mail->SMTPAuth   = true;                                  
                                $mail->Username   = '';               
                                $mail->Password   = '';                        
                                $mail->SMTPSecure = 'tls';                                  
                                $mail->Port       = 587;                                   
                                $mail->FormName = 'Chatters';
                                //Recipients
                                $mail->setFrom('elmer.alluad@gmail.com', 'Chatters');
                                $mail->addAddress($email, $username);     
                                $mail->isHTML(true);                                 
                                $mail->Subject = 'Verification code';
                                $mail->Body    = "Hi <b style=' text-transform: uppercase;'>$username</b><br><br>
                                                Welcome to Chatters, it's a free chat, free vioce call, free video call where you can have live chat with single women and men, Discuss with a random strangers all over the world. It's free no payment required.
                                                To make sure we have your correct email, please confirm it by clicking the link below.<br><br>
                                                    <a href='http://chatters.test/verify?activation-code=$activationcode'>Confirm your Email</a><br><br>
                                                    
        
                                                    Thank you<br>
                                                    Chatters
                                    ";
                                 if ($mail->send()) {
                                    echo '<script>window.location.href = "http://chatters.test/succes-register"</script>';
                                 }   
                            } catch (Exception $e) {
                               echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                           }
                         }        
                    }
                }
            }
        }
    
    }
}
?>