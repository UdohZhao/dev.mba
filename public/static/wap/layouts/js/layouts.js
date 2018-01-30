
$(".swiper-container").swiper({
        loop: true,
        autoplay: 3000,
        paginationClickable :true, 
      });


// 显示和隐藏
$(function(){
     $(".toggle-area").click(function(){
     	if($(this).children().hasClass('glyphicon-chevron-down'))
     	{
	        $(this).children().removeClass('glyphicon-chevron-down').addClass("glyphicon-chevron-up");
	        $(".expand-list").addClass("expand");
        }
        else{
        	$(this).children().removeClass('glyphicon-chevron-up').addClass("glyphicon-chevron-down");
	        $(".expand-list").removeClass("expand");
        }
    });
});
          
