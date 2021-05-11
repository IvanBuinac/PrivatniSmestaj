$( document ).ready(function() {
        var width;
        var max_width;
        var max_height;
        width=document.getElementsByClassName("thumb");
            max_width=width[0].clientWidth;
            max_height=max_width*9/16;
            $(".thumb .thumbnail").css("background-color","#BDBFBF");
            $(".thumb .caption").css("background-color","#FFFFFF");      
            $(".img-thumb").css("max-width",max_width);
            $(".img-thumb").css("max-height",max_height);
        $( window ).resize(function() {
          width=document.getElementsByClassName("thumb");
            max_width=width[0].clientWidth;
            max_height=max_width*9/16;
            $(".thumb .thumbnail").css("background-color","#BDBFBF");
            $(".thumb .caption").css("background-color","#FFFFFF");
            $(".img-thumb").css("max-width",max_width);
            $(".img-thumb").css("max-height",max_height);  
        });
});