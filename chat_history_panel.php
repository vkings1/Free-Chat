<?php
    include 'config/dbconnection.php';
    session_start();
    include 'function.php';
    $to_user_id = $_SESSION['user_id'];
    $query ="SELECT chat_messages.user_id, chat_messages.chat_messages, chat_messages.from_user_id,
     chat_messages.status,  chat_messages.chat_datetime, users.user_id, chat_messages.username, users.profile_image, users.last_activity 
    FROM users JOIN chat_messages ON chat_messages.user_id = users.user_id wHERE chat_messages.to_user_id = ' $to_user_id'
    group BY chat_messages.user_id, chat_messages.status ORDER BY  chat_datetime  DESC";
    // $query = "";
    $stm = $conn->prepare($query);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    $output = '';
    foreach($result as $row){
        if ($row['status'] == 0) { 
            $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
            $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
            $user_last_activity = fetch_user_last_activity($row['user_id'], $conn);
            if ($user_last_activity > $current_timestamp) {
            //online
            $output .= '<li><div class="message-panel-not-read"><a class="start_chat" data-touserid="'.$row['from_user_id'].'" data-tousername="'.$row['username'].'" data-touserimg="'.$row['profile_image'].'" data-tousertime="'.time_Ago($row['last_activity']).'"><span class="panel-image"><img class="panel-img" src="'.$row['profile_image'].'" ></span><span id="user-online" title="Online"></span><span class="panel-message">'.$row['username'].' <span class="not-seen"><i class="fa fa-circle"></i></span></span>
            <p class="chat-messages-not-read">'.substr($row['chat_messages'],0,22).'</p></a></div> <hr></li>';
            }else {
              //offline
              $output .= '<li><div class="message-panel-not-read"><a class="start_chat" data-touserid="'.$row['from_user_id'].'" data-tousername="'.$row['username'].'" data-touserimg="'.$row['profile_image'].'" data-tousertime="'.time_Ago($row['last_activity']).'"><span class="panel-image"><img class="panel-img" src="'.$row['profile_image'].'" > </span><span id="user-offline" title="Offline"></span><span class="panel-message">'.$row['username'].'<span class="not-seen"><i class="fa fa-circle"></i></span</span>
            <p class="chat-messages-not-read">'.substr($row['chat_messages'],0,22).'</p></a></div> <hr></li>';
            }
        }elseif ($row['status'] == 1) {
            $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
            $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
            $user_last_activity = fetch_user_last_activity($row['user_id'], $conn);
            if ($user_last_activity > $current_timestamp) {
              //online
              $output .= '<li><div class="message-panel-read"><a class="start_chat" data-touserid="'.$row['from_user_id'].'" data-tousername="'.$row['username'].'" data-touserimg="'.$row['profile_image'].'" data-tousertime="'.time_Ago($row['last_activity']).'"><span class="panel-image"><img class="panel-img" src="'.$row['profile_image'].'" ></span><span id="user-online" title="Online"></span><span class="panel-message">'.$row['username'].'</span>
              <p class="chat-messages-text">'.substr($row['chat_messages'],0,22).'</p></a><span class="delete" id="'.$row['from_user_id'].'" title="Delete message">X</span></div><hr></li>';
            }else {
              //offline
              $output .= '<li><div class="message-panel-read"><a class="start_chat" data-touserid="'.$row['from_user_id'].'" data-tousername="'.$row['username'].'" data-touserimg="'.$row['profile_image'].'" data-tousertime="'.time_Ago($row['last_activity']).'"><span class="panel-image"><img class="panel-img" src="'.$row['profile_image'].'" > </span><span id="user-offline" title="Offline"></span><span class="panel-message">'.$row['username'].'</span>
              <p class="chat-messages-text">'.substr($row['chat_messages'],0,22).'</p></a><span class="delete" id="'.$row['from_user_id'].'" title="Delete message">X</span></div><hr></li>';
            }
        }
    }
    echo $output;

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
         return "<span id='offline'></span> active $minutes m ago";  
       }  
     }  
        else if($hours <=24)  
        {  
       if($hours==1)  
             {  
         return "<span id='offline'></span> active an hour ago";  
       }  
             else  
             {  
         return "<span id='offline'></span> active $hours hrs ago";  
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
         return "<span id='offline'></span> active $days days ago";  
       }  
     }  
        else if($weeks <= 4.3) //4.3 == 52/12  
        {  
       if($weeks==1)  
             {  
         return "<span id='offline'></span> active a week ago";  
       }  
             else  
             {  
         return "<span id='offline'></span> active $weeks weeks ago";  
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
         return "<span id='offline'></span> active $months months ago";  
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
         return "<span id='offline'></span> acitve $years years ago";  
       }  
     }  
    } 
?>
