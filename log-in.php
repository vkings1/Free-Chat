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
        $password = $_POST['password'];
        if (empty($username) || empty($password)) {
            echo "<div class='alert alert-danger'>Invalid username or password</div>";
        }else {
            $query = "SELECT * FROM `users` WHERE `username` = :username OR `email` = :email ";
            $stm = $conn->prepare($query);
            $stm->bindParam('username', $username);
            $stm->bindParam('email', $username);
            $stm->execute();
            $count = $stm->rowCount();
            if ($count > 0) {
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                   if (password_verify($password, $row['password'])) {
                        if ($row['verefied_user'] == 0) {
                            echo "<div class='alert alert-danger'>Please verified your account</div>";
                        }elseif ($row['user_type'] == 'admin') {
                            # go to admin panel
                        }elseif ($row['user_type'] == 'user') {
                            # go to chat dashboard
                            $_SESSION['user_id'] = $row['user_id'];
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['profile_image'] = $row['profile_image'];
                            //sub query to login last activity to display to user
                            $sub_query = "INSERT INTO `user_login_details` (`user_id`) VALUES ('".$row['user_id']."')";
                            $stm1 = $conn->prepare($sub_query);
                            $stm1->execute();
                            $_SESSION['user_details_id'] = $conn->lastInsertId();
                            //sub query update users login last activity to display to chatbox
                            $user_id =  $_SESSION['user_id'];
                            $sub_query_2 = "UPDATE `users` SET last_activity =  now() WHERE `user_id` = '$user_id'";
                            $stm2 = $conn->prepare( $sub_query_2);
                            $stm2->execute();
                            //set cookie for detect device
                            if (empty($_COOKIE['chat_users'])) {
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
                                    $mail->addAddress($row['email']);     
                                    $mail->isHTML(true);                                 
                                    $mail->Subject = 'New login to Chatters from ';
                                    $mail->Body    = "<b>We noticed a login to your account</b></b><br>
                                                    <b> ".$row['username']."</b> from a new device.</b></b><br>
                                                     <b>Was this you?</b>
                                                     ".getUserDevice()." </b></b><br>
                                                     ".getUserBrowser()." </b></b><br>
                                                     ".getUserInformation()." </b></b><br>

                                                    <b>If this was you</b>
                                                    You can ignore this message. There's no need to take any action.<br><br>
                                                    <b>If this wasn’t you<b/>
                                                    Your account may have been compromised and you should take a few steps to make sure your account is secure. 
                                                    To start <a href='http://chatters.test/forgot-password'>reset your password now.</a><br><br>   
                                                     Thank you<br>
                                                     Chatters
                                        ";
                                     $mail->send();
                                
                                } catch (Exception $e) {
                                   echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                               }
                               //set a cookie for new device
                                setcookie('chat_users',  md5($row['username']), time() + 31553280, '/');
                            }
                            //set cookie for rember me
                            if (!empty($_POST['rememberme'])) {
                                setcookie('_rm',  md5($row['username']), time() + 31553280,'/' );
                            }else {
                                if (isset($_COOKIE['_us'])) {
                                    setcookie('_rm','');
                                }
                            }
                            //if successfull login go to the dashboard
                            echo '<script>window.location.href = "http://chatters.test/chat";</script>';
                        }
                   }else {
                    echo "<div class='alert alert-danger'>Invalid password</div>";
                   }
                }
            }else {
                echo "<div class='alert alert-danger'>Invalid username or email</div>";
              }
        }
    }
}

//get the user ip
function getUserIP() {
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else {
      return(isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
    }
}

$user_ip = getUserIP();

//get the users information
function getUserInformation(){

$query=@unserialize(file_get_contents('http://ip-api.com/php/'.$user_ip));
  if ($query && $query['status'] == 'success') {
     'ISP:'.$query['isp'].'<br>'; 
     return 'Country:'.$query['country'].' '.$query['city'].' '; 
     'Country code:'.$query['countryCode'].'<br>'; 
     'Region Name:'.$query['regionName'].'<br>'; 

     'Zip:'.$query['zip'].'<br>'; 
     'Latitude:'.$query['lat'].'<br>'; 
     'Longtitude:'.$query['lon'].'<br>'; 
     'Timezone:'.$query['timezone'].'<br>'; 
     'ORG:'.$query['org'].'<br>'; 
     'AS:'.$query['as'].'<br>'; 
  }
}

//get the device mobile or desktop
function getUserDevice(){
 $useragent=$_SERVER['HTTP_USER_AGENT'];
    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
    { 
        return "Mobile";
    
    }
    else{
        return "Desktop";
    }
}
//get the user brrowserr
function getUserBrowser(){
if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
    return 'Internet explorer';
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
 return 'Internet explorer';
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
 return 'Mozilla Firefox';
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
 return 'Google Chrome';
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
 return "Opera Mini";
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
 return "Opera";
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
 return "Safari";
 else
 return 'Something else';
}

$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
//get the device mobile or desktop
// function getOS() { 

//     global $user_agent;

//     $os_platform    =   "Unknown OS Platform";

//     $os_array       =   array(
//                             '/windows nt 10.0/i'    =>  'Windows 10',
//                             '/windows nt 6.2/i'     =>  'Windows 8',
//                             '/windows nt 6.1/i'     =>  'Windows 7',
//                             '/windows nt 6.0/i'     =>  'Windows Vista',
//                             '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
//                             '/windows nt 5.1/i'     =>  'Windows XP',
//                             '/windows xp/i'         =>  'Windows XP',
//                             '/windows nt 5.0/i'     =>  'Windows 2000',
//                             '/windows me/i'         =>  'Windows ME',
//                             '/win98/i'              =>  'Windows 98',
//                             '/win95/i'              =>  'Windows 95',
//                             '/win16/i'              =>  'Windows 3.11',
//                             '/macintosh|mac os x/i' =>  'Mac OS X',
//                             '/mac_powerpc/i'        =>  'Mac OS 9',
//                             '/linux/i'              =>  'Linux',
//                             '/ubuntu/i'             =>  'Ubuntu',
//                             '/iphone/i'             =>  'iPhone',
//                             '/ipod/i'               =>  'iPod',
//                             '/ipad/i'               =>  'iPad',
//                             '/android/i'            =>  'Android',
//                             '/blackberry/i'         =>  'BlackBerry',
//                             '/webos/i'              =>  'Mobile'
//                         );

//     foreach ($os_array as $regex => $value) { 

//         if (preg_match($regex, $user_agent)) {
//             $os_platform    =   $value;
//         }

//     }   

//     return $os_platform;

// }
// //get the user brrowserr
// function getBrowser() {

//     global $user_agent;

//     $browser        =   "Unknown Browser";

//     $browser_array  =   array(
//                             '/msie/i'       =>  'Internet Explorer',
//                             '/firefox/i'    =>  'Firefox',
//                             '/safari/i'     =>  'Safari',
//                             '/chrome/i'     =>  'Chrome',
//                             '/opera/i'      =>  'Opera',
//                             '/netscape/i'   =>  'Netscape',
//                             '/maxthon/i'    =>  'Maxthon',
//                             '/konqueror/i'  =>  'Konqueror',
//                             '/mobile/i'     =>  'Handheld Browser'
//                         );

//     foreach ($browser_array as $regex => $value) { 

//         if (preg_match($regex, $user_agent)) {
//             $browser    =   $value;
//         }

//     }

//     return $browser;

//}

?>