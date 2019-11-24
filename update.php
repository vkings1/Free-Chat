<?php
session_start();
include 'config/dbconnection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['token']) || $_POST['csrf'] !== $_SESSION['token']) {
        echo "<div class='text-danger'>There was an problem submitting your request. Please refresh your browser or try again later</div>";
    }else {
        $profil_status = 1;
        $user_id = $_SESSION['user_id'];
        $age = $_POST['age'];
        $image = $_FILES['image'];
        $filename = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileType = $_FILES['image']['type'];
        $fileExt = explode('.', $filename);
        $fileActualExt = strtolower(end($fileExt));
        $allowedimg = array('jpg', 'jpeg', 'png', 'pdf');
            if (in_array($fileActualExt, $allowedimg)) {
                if ($fileError === 0) {
                    if ($fileSize < 100000) {
                        $fileNameNew = "profile-".$user_id.".".$fileActualExt;
                        $fileDestination = 'profile-images/'. $fileNameNew;
                        if (move_uploaded_file($fileTmpName, $fileDestination)) {
                                $sql = "UPDATE users SET age = :age,  profile_image = :profile_image, profile_status = :profile_status
                                WHERE user_id = :user_id";
                                $statement = $conn->prepare($sql);
                                $statement->bindParam(':age', $age);
                                $statement->bindParam(':profile_image', $fileDestination);
                                $statement->bindParam(':profile_status', $profil_status);
                                $statement->bindParam(':user_id', $user_id);
                                $statement->execute();
                           echo '<div class="update-success"><span><i class="fa fa-check"></i></span> Succesfully update your data</div>';
                        }
                    }else {
                        echo "Your image is to big";
                    }
                }else {
                    echo "There was an error";
                }
            } else {
                echo "Cannot upload images";
            }
 
    }
}

?>