<?php
include 'config/dbconnection.php';
include 'function.php';
session_start();
if (!isset($_SESSION['user_id'])) {
   header('Location: login');
}
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM `users` WHERE `user_id` != '$user_id'";
$stm = $conn->prepare($query);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row){
    if ($row['profile_status'] == 1) {
        $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
        $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
        $user_last_activity = fetch_user_last_activity($row['user_id'], $conn);
        if($user_last_activity > $current_timestamp){
           echo  '
        <div class="profile-box">
            <div class="profile-wrapper">
             <span class="online" title="Online"></span>
                <div class="profile-images"><img class="user-images" src="'.$row['profile_image'].'"></div>
                <div class="profile-details">
                <hr>
                    <span>Age: '.$row['age'].'</span> |
                    <span>Gender: '.$row['gender'].'</span>
                    <div>
                        Country: '.$row['country'].'
                    </div>
                    <div>
                        State: '.$row['province'].'
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'" data-touserimg="'.$row['profile_image'].'"data-touserimg="'.$row['profile_image'].'" data-tousertime="'.time_Ago($row['last_activity']).'">Send Message</button>
        </div>
    ';
        }else{
            echo  '
        <div class="profile-box">
            <div class="profile-wrapper">
                <span class="offline" title="Offline"></span>
                <div class="profile-images"><img class="user-images" src="'.$row['profile_image'].'"></div>
                <div class="profile-details">
                <hr>
                    <span>Age: '.$row['age'].'</span> |
                    <span>Gender: '.$row['gender'].'</span>
                    <div>
                        Country: '.$row['country'].'
                    </div>
                    <div>
                        State: '.$row['province'].'
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-info btn-xs start_chat"  data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'" data-touserimg="'.$row['profile_image'].'" data-tousertime="'.time_Ago($row['last_activity']).'">Send Message</button>
        </div>
    ';
        }
        
    }else {
        $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
        $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
        $user_last_activity = fetch_user_last_activity($row['user_id'], $conn);
        if($user_last_activity > $current_timestamp){
          
           echo  '
           <div class="profile-box">
               <div class="profile-wrapper">
                    <span class="online" title="Online"></span>
                   <div class="profile-images"><img class="user-images" src="profile-images/defualtprofile.jpg"></div>
                       <div class="profile-details">
                       <hr>
                           <span>Age: '.$row['age'].'</span> |
                           <span>Gender: '.$row['gender'].'</span>
                           <div>
                                Country: '.$row['country'].'
                           </div>
                           <div>
                                State: '.$row['province'].'
                           </div>
                       </div>
               </div>
               <button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'" data-touserimg="'.$row['profile_image'].'" data-tousertime="'.time_Ago($row['last_activity']).'">Send Message</button>
           </div>
       ';
        }else{
            echo  '
            <div class="profile-box">
                <div class="profile-wrapper">
                <span class="offline" title="Offline"></span>
                    <div class="profile-images"><img class="user-images" src="profile-images/defualtprofile.jpg"></div>
                        <div class="profile-details">
                        <hr>
                            <span>Age: '.$row['age'].'</span> |
                            <span>Gender: '.$row['gender'].'</span>
                            <div>
                                 Country: '.$row['country'].'
                            </div>
                            <div>
                                 State: '.$row['province'].'
                            </div>
                        </div>
                </div>
                <button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'" data-touserimg="'.$row['profile_image'].'" data-tousertime="'.time_Ago($row['last_activity']).'">Send Message</button>
            </div>
        ';
        }
       
    }
}
function time_Ago($timestamp)  {  
    $time_ago = strtotime($timestamp);  
    $current_time = time();  
    $time_difference = $current_time - $time_ago;  
    $seconds = $time_difference;  
    $minutes      = round($seconds / 60 );            
    $hours           = round($seconds / 3600);            
    $days          = round($seconds / 86400);            
    $weeks          = round($seconds / 604800);           
    $months          = round($seconds / 2629440);       
    $years          = round($seconds / 31553280);      
    if($seconds <= 60)  
    {  
   return "<span id='active'></span> active now";  
 }  
    else if($minutes <=60)  
    {  
   if($minutes==1)  
         {  
     return "<span id='offline'></span> active minute ago";  
   }  
   else  
         {  
     return "<span id='offline'></span> $minutes m ago";  
   }  
 }  
    else if($hours <=24)  
    {  
   if($hours==1)  
         {  
     return "<span id='offline'></span> an hour ago";  
   }  
         else  
         {  
     return "<span id='offline'></span> $hours hrs ago";  
   }  
 }  
    else if($days <= 7)  
    {  
   if($days==1)  
         {  
     return "<span id='offline'></span> active yesterday";  
   }  
         else  
         {  
     return "<span id='offline'></span> $days days ago";  
   }  
 }  
    else if($weeks <= 4.3) //4.3 == 52/12  
    {  
   if($weeks==1)  
         {  
     return "<span id='offline'></span> a week ago";  
   }  
         else  
         {  
     return "<span id='offline'></span> $weeks weeks ago";  
   }  
 }  
     else if($months <=12)  
    {  
   if($months==1)  
         {  
     return "<span id='offline'></span> active a month ago";  
   }  
         else  
         {  
     return "<span id='offline'></span> $months months ago";  
   }  
 }  
    else  
    {  
   if($years==1)  
         {  
     return "<span id='offline'></span> active one year ago";  
   }  
         else  
         {  
     return "<span id='offline'></span> $years years ago";  
   }  
 }  
} 
?>
