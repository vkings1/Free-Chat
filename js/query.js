$(document).ready(function(){
       fetch_user();
      setInterval(function(){
        fetch_user();
        update_last_activity();
        update_chat_history_data();
        load_unseen_messages();
        chat_history();
      }, 5000);
     //all user display into dashboard 
    function fetch_user(){
      $.ajax({
        url:"fetch_user.php",
        method:"POST",
        success:function(data){
          $('#display-users-details').html(data);
        }
      });
    }
    //fetch user image display into chat navbar
    fetch_user_image_profile();
    function fetch_user_image_profile(){
      $.ajax({
          url: 'fetch_profile_image.php',
          method: 'POST',
          success:function(data){
              $('#ProfileImage').html(data);
          }
      });
    }
    //fetch user image display into chat Chat panel
    fetch_user_image_chat_panel();
    function fetch_user_image_chat_panel(){
      $.ajax({
          url: 'fetch_user_image_chat_panel.php',
          method: 'POST',
          success:function(data){
              $('#profileImageChatHistorys').html(data);
          }
      });
    }
    //update the last activity on database
    function update_last_activity(){
        $.ajax({
            url: 'update_last_activity.php',
            success:function(){
            }
        });
    }
    //chatbox
    // function make_chat_dialog_box(to_user_id, to_user_name, to_user_image, to_user_time){ 
    //  var modal_content = '<div id="chat_user_dialog">';
    //       modal_content += '<div class="chatbox-header"><span class="chat-box-user-name"><span class="data-user-image"><img class="to-user-image" src="'+to_user_image+'" alt="!"></span><span class="to-user-name">'+to_user_name+'</span><span class="call-video"> <span class="cam"><i class="fa fa-video-camera '+to_user_id+'" title="Start a video chat with '+to_user_name+'"></i></span> <span class="phone"><i class="fa fa-phone '+to_user_id+'" title="Start a vioce call with '+to_user_name+'"></i></span><span class="settings"><i class="fa fa-cog" title="Options"></i></span><span class="close" title="close">X</span></div>';
    //       modal_content += '<div id="active-offline">'+to_user_time+'</div>';
    //       modal_content += '<div id="chat-loaders"><img src="loader/spinner.svg" alt="loader"> </div>';
    //       modal_content += ' <div id="chat-loader">';
    //       modal_content += '<div class="chat_historybox" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
    //       //modal_content += fetch_user_chat_history();
    //       modal_content += '</div></div>';  
    //       modal_content += '<form id="chat-form">';
    //       modal_content += ' <input type="hidden" id="id_user" name="id_user" value="'+to_user_id+'">';
    //       //modal_content += '<div id="img-preview"><img id="preview_'+to_user_id+'" class="img_'+to_user_id+'" name="img" src=""></div>';
    //       modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message" placeholder="Type a message..."></textarea>';
    //       modal_content +=  '<label for="file"><i class="fa fa-picture-o" title="Add photos"></i></label><input type="file" name="image" id="file">';
    //       modal_content += '<i class="fa fa-paperclip" title="Add file"></i>';
    //       modal_content+= '<button type="submit" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat" style="float:right">Send</button>';
    //       modal_content += '</form></div>';
    //     $('#user_model_details').html(modal_content);
    //       $(function() {
    //         $("#file").change(function() {
    //             if (this.files && this.files[0]) {
    //                 var reader = new FileReader();
    //                 reader.onload = imageIsLoaded;
    //                 reader.readAsDataURL(this.files[0]);
    //             }
    //         });
    //     });
    //     function imageIsLoaded(e) {
    //         $('#preview_'+to_user_id).attr('src', e.target.result);
    //     };
    //     $(document).on('click', '#file', function(){
    //       $('#img-preview').css('display', 'block');
    //     });
    //      //disable button when text are is empty
    //     $('.send_chat').attr('disabled', true);
    //     $('textarea').keyup(function(){
    //         if($(this).val() != '') {
    //             $('.send_chat').attr('disabled', false);
    //         } else {
    //             $('.send_chat').attr('disabled', true);
    //         }
    //     });
    // }
    //start to  chat to suser
    // $(document).on('click', '.start_chat', function(){
    //   var to_user_id = $(this).data('touserid');
    //   var to_user_name = $(this).data('tousername');
    //   var to_user_image = $(this).data('touserimg');
    //   var to_user_time = $(this).data('tousertime');
    //   make_chat_dialog_box(to_user_id, to_user_name,to_user_image,to_user_time);
    //     // $('#chat_message_'+to_user_id).emojioneArea({
    //     //   pickerPosition:"top",
    //     //   toneStyle: "bullet"
    //     // });
    // }); 
    //start chat box
    var arr = []; // List of users 
    $(document).on('click', '.msg_head', function() { 
      var chatbox = $(this).parents().attr("rel");
      $('[rel="'+chatbox+'"] .msg_wrap').slideToggle('slow');
       return false;
    });
    
  $(document).on('click', '.close', function() { 
      var chatbox = $(this).parents().parents().attr("rel") ;
      $('[rel="'+chatbox+'"]').remove();
      arr.splice($.inArray(chatbox, arr), 1);
      displayChatBox();
      return false;
  });
  
  $(document).on('click', '.start_chat', function() {
    var to_user_id = $(this).data('touserid');
    var to_user_name = $(this).data('tousername');
    var to_user_image = $(this).data('touserimg');
    var to_user_time = $(this).data('tousertime');
    if ($.inArray(to_user_id, arr) != -1){
      arr.splice($.inArray(to_user_id, arr), 1);
    }
    arr.unshift(to_user_id);
    chatPopup =  '<div class="msg_box" style="right:310px" rel="'+to_user_id+'">'+
    '<div class="msg_head"><span id="user-img"><img src="'+to_user_image+'" alt=""></span> <span id="user-name">'+to_user_name+'</span>'+
    '<div class="close" title="press esc to close">x</div> </div>'+
    '<div id="active-offline">'+to_user_time+'</div>'+
    '<div class="call-video"> <span class="cam"><i class="fa fa-video-camera '+to_user_id+'" title="Start a video chat with '+to_user_name+'"></i></span> <span class="phone"><i class="fa fa-phone '+to_user_id+'" title="Start a vioce call with '+to_user_name+'"></i></span><span class="settings"><i class="fa fa-cog" title="Options"></i></div>'+
    '<div id="chat-loaders"><img src="loader/spinner.svg" alt="loader"> </div>'+
    '<div class="msg_wrap"><div class="chat_historybox" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'"></div>'+ 
    '<input type="hidden" id="id_user" name="id_user" value="'+to_user_id+'">'+
    '<div id="img-preview"><img id="preview" " name="img" src=""></div>'+
    '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="chat_message" placeholder="Type a message..."></textarea>'+
    '<label for="photo"><i class="fa fa-picture-o" title="Add photos"></i></label><input type="file" name="photo" id="photo" accept="image/*">'+
    '<label for="file"><i class="fa fa-paperclip" title="Add file"></i></label><input type="file" name="file" id="file" accept="*">'+
    '<button type="submit" name="send_chat" id="'+to_user_id+'" class="send_chat" style="float:right">Send</button>'+

    '</div></div>' ;     
   
    $("body").append(  chatPopup  );
    $(function() {
        $("#photo").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    function imageIsLoaded(e) {
        $('#preview').attr('src', e.target.result);
    };
    $(document).on('click', '#photo', function(){
        $('#img-preview').css('display', 'block');
        $('.chat_historybox').css('height', '170px');
     });
     $(".chat_message").focus();
     displayChatBox();
  });
    //disable button when text are is empty
    $('.send_chat').attr('disabled', true);
    $('.chat_message').keyup(function(){
        if($(this).val() != '') {
            $('.send_chat').attr('disabled', false);
        } else {
            $('.send_chat').attr('disabled', true);
        }
    });
    
  $(document).on('keypress', '.chat_message' , function(e) {       
     var code = (e.keyCode ? e.keyCode : e.which);
      if (code == 13) {
          $(".send_chat").trigger('click');
          return true;
      }
  });

  $(document).on('keyup',function(evt) {
    if (evt.keyCode == 27) {
      var to_user_id = $(this).data('touserid');
      $('.msg_box').remove();
      // $('[rel="'+to_user_id+'"]').remove();
    }
  });

    
  function displayChatBox(){ 
    i = 310 ; // start position
    j = 280;  //next position
    $.each( arr, function( index, value ) {  
      if(index < 3){
        $('[rel="'+value+'"]').css("right",i);
        $('[rel="'+value+'"]').show();
        i = i+j;    
      }else{
       $('[rel="'+value+'"]').remove();
      }
    });  
  }  
    








    //close the chatbox
    // $(document).on('click', '.close',function(){
    //   $('#chat_user_dialog').remove();
    //   // $(this).parent('#chat_user_dialog').hide();
    // });

    //send a chat to user with auto scroll to bottom
    $(document).on('click', '.send_chat', function(e){
      e.preventDefault();
      $('.chat_historybox').animate({
        scrollTop: $(".chat_historybox").offset().top
      }, 1000);
      var to_user_id = $(this).attr('id');
      var chat_message = $('#chat_message_'+to_user_id).val();
      var img = $('.img_'+to_user_id).val();
        $.ajax({
            url: 'insert_chat.php',
            method: 'POST',
            // contentType: false,
            // cache: false,
            // processData:false,
            data:{to_user_id:to_user_id, chat_message:chat_message, img:img},
            success:function(data){
                $('#chat_message_'+to_user_id).val('');
                $('#chat_history_'+to_user_id).html(data);
            }
        });
    });
  //   $(function () {
  //     $(".chat_message").keypress(function (e) {
  //         var code = (e.keyCode ? e.keyCode : e.which);
  //         alert(code);
  //         if (code == 13) {
  //             $(".send_chat").trigger('click');
  //             return true;
  //         }
  //     });
  // });
    //start chat auto scroll t bottom 
    $(document).on('click', '.start_chat', function(){
      $('.chat_historybox').animate({
        scrollTop: $(".chat_historybox").offset().top
      }, 1000)
    });
    //fetch user chat history
    function fetch_user_chat_history(to_user_id){
		$.ajax({
			url:"fetch_user_chat_history.php",
			method:"POST",
      data:{to_user_id:to_user_id},
      beforeSend: function(){
        $("#chat-loaders").css('display', 'none');
        // $("#chat-loader").css('opacity', '-0.1')
     },
			success:function(data){
        $('#chat_history_'+to_user_id).html(data);
        $("#chat-loaders").css({'display': 'none'});
      
      },
      complete:function(){
         $("#chat-loaders").css('display', 'none');
        // $("#chat-loader").css('opacity', '1');
     }
		});
  }
  //update chat history real time
  function update_chat_history_data(){
		$('.chat_historybox').each(function(){
			 var to_user_id = $(this).data('touserid');
			fetch_user_chat_history(to_user_id);
		});
  }
  //typing yes or
  $(document).on('focus', '.chat_message', function(){
    var is_type = 'yes';
    $.ajax({
        url: 'update_is_type_status.php',
        method: 'POST',
        data:{is_type:is_type},
        success:function(data){
        //to do typing & unseen
        
        }
    });
  });
  $(document).on('blur', '.chat_message', function(){
      var is_type = 'no';
      $.ajax({
          url: 'update_is_type_status.php',
          method: 'POST',
          data:{is_type:is_type},
          success:function(data){
            // to do typing & unseen
          }
      });
  });
  
  //all user display into chat panel dashboard 
  chat_history();
  function chat_history(){
    $.ajax({
      url:"chat_history_panel.php",
      method:"POST",
      success:function(data){
        $('#chat-history').html(data);
      }
    });
  }
  //search username
  $('#search').keyup(function(){
  //   var search = $(this).val();
  //   if (search != '') {
  //     $.ajax({
  //       url: 'search_user_to_chat_pannel.php',
  //       method: 'POST',
  //       data:{search:search},
  //       success:function(data){
  //         $('#chat-search-result').html(data);
  //         //$('#chat-history').css('display', 'block');
  //       }
  //   });
      
  //  }else{
  //       $('#search-result').html('');
  //       $.ajax({
  //         url: 'search_user_to_chat_pannel.php',
  //         method: 'POST',
  //         data:{search:search},
  //         success:function(data){
  //           $('#search-result').html(data);
  //           $('#chat-history').css('display', 'none');
  //         }
  //     });
  //   }
  });
  //vioce call
  $(document).on('click', '.fa-phone',function(){
    alert('This action is under maintenace');
  });
   //video call
   $(document).on('click', '.fa-video-camera',function(){
    window.open("http://localhost/chatsys/videocall/incall/videocall.php", "newWindow", "width=500, height=600")
   // window.location.href = "http://localhost/chatsys/videocall/incall/videocall.php"
  });
  
  //new message soud function
  function play_sound(){
    var audioElement = document.createElement('audio');
    audioElement.setAttribute('src', 'sound-notification/notif.mp3');
    audioElement.setAttribute('autoplay', 'autoplay');
    audioElement.load();
    audioElement.play();
    
  }
  //unseen messages notification
  load_unseen_messages();
  function load_unseen_messages(view = ''){
    $.ajax({
      url: 'unseen_messages.php',
      method: 'POST',
      data:{view:view},
      dataType: 'JSON',
      success:function(data){
        $('.messages-dropdow').html(data.messages);
        if (data.unseen_messages > 0) {
          $('.badge-danger').html(data.unseen_messages);
          $('.badge-dark').html(data.unseen_messages);
          $(".header-chat").css("background", "red");
          $(".header-chat").css("color", "#fff");
          $('.badge-danger').css("display", "block");
          $('.badge-dark').css("display", "inline-block");
           play_sound();
        }else{
          $('.badge-danger').css("display", "none");
          $('.badge-dark').css("display", "none");
          $(".header-chat").css("background", "#283e4a");
        }
      }
    });
  }

  //when click the chat history panel slide up  & down
  var clicked = false;
  $(document).on('click', '.header-chat', function(){
      if (clicked) {
        clicked = false;
        $(".large").css({
            "bottom": "-480px"
        });
    } else {
        clicked = true;
        $(".large").css({
            "bottom": "-10px",
            "height": "530px"
        });
    }
    
  });
  // //when click the chat box panel slide up  & down
  // var click = false; 
  // $(document).on('click', '.to-user-image', function(){
  //   if (click) {
  //     click = false;
  //     $("#user_model_details").css({
  //       "height": "383px"
  //     });
  // } else {
  //     click = true;
  //     $("#user_model_details").css({
  //         "height": "49px"
  //     });
  // }
  // });
  //delete messgage to chat history
  $(document).on('click', '.delete', function(){
    var id =$(this).attr('id');
      $.ajax({
        url: 'delete.php',
        method: 'POST',
        data: "id="+id,
        beforeSend: function(){
          $("#chat-panel-loaders").css('display', 'block');
          $("#chat-panel-loader").css('opacity', '-0.1')
       },
        success:function(data){
          // $("#delete-result").html(data);
        },
        complete:function(){
          $("#chat-panel-loaders").css('display', 'none');
           $("#chat-panel-loader").css('opacity', '1');
        }
    });
  });

  $('#update').on('submit', function(e){
    e.preventDefault();
    $.ajax({
      url: 'update.php',
      method: 'POST',
      data:  new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      success:function(data){
         $("#upadte-result").html(data);
      }
    });
  });

});// end of jquery
