$(document).ready(function(){
    //select ages
    $('input').blur(function() {
        var $this = $(this);
        if ($this.val())
        $this.addClass('used');
        else
        $this.removeClass('used');
    });
    var $select = $(".ages");
    for (i=18;i<=100;i++){
        $select.append($('<option></option>').val(i).html(i))
    }
    //register
    $('#btnreg').on('click', function(event){
        event.preventDefault();
          var formdata = $('#registerform').serialize();
          $.ajax({
             url: 'reg.php',
             method: 'post',
             data: formdata,
             beforeSend: function(){
                 $("#progress").css('display', 'block');
                 $("#document-loader").css('opacity', '0.1');
             },
             success:function(data){
                $('#result').html(data); 
                $('#registerform')[0].reset();
             },
             complete:function(data){
                 $("#progress").css('display', 'none');
                 $("#document-loader").css('opacity', '1');
             }
         });
     });//  end of regester

     //log-in
    $('#btnlogin').on('click', function(event){
        event.preventDefault();
          var formdata = $('#login').serialize();
          $.ajax({
             url: 'log-in.php',
             method: 'post',
             data: formdata,
             beforeSend: function(){
                $("#progress").css('display', 'block');
                 $("#document-loader").css('opacity', '-0.1')
             },
             success:function(data){
                 $('#result').html(data); 
             },
             complete:function(data){
                $("#progress").css('display', 'none');
                $("#document-loader").css('opacity', '1');
             }
         });

     });//  end of log-in
     
     //close the error messages
     $(document).on('click', '.alert', function(){
         $('.alert-danger').hide();
     });
   

});