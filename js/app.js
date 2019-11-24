$(document).ready(function(){

    $('input').blur(function() {
        var $this = $(this);
        if ($this.val())
        $this.addClass('used');
        else
        $this.removeClass('used');
    });

      //navbar taggle show when mobile version view
    //   $('.menu-toggle').click(function(){
    //     $('.navbar').toggleClass('active');
    // });
    // $('ul li').click(function(){
    //     $(this).siblings().removeClass('active');
    //     $(this).toggleClass('active');
    // });

});
