$(function(){
    //$(".swiper-slide.swiper-slide-active img").css("margin-top", "40px");
    $(".topbtn").click(function(){
        $("html, body").animate({scrollTop:0},500);
    });
    $(".news-nav2 .active").click(function(){
        return(false);
    });
    $(window).scroll(function() {
        if ($(this).scrollTop() > 400){
            $(".topbtn").fadeIn("fast");
        } else {
            $(".topbtn").stop().fadeOut("fast");
        };
    });
    
    function isMobile()
    {
        try{ document.createEvent("TouchEvent"); return true; }
        catch(e){ return false;}
    }
    
if(!isMobile())
{
    $("#secGroup").fullpage({
      verticalCentered: false,
	  responsiveWidth: 1100,
	  loopHorizontal: false,
      anchors: ['top', 'sec1', 'sec2', 'sec3', 'footer'],
      menu: '#nav',
      sectionsColor: ['#000000', '#000000', '#000000', '#000000', '#000000'],
      onLeave: function(index, nextIndex, direction) {
			var leavingSection = $(this);
          
			/*if (index == 1 && direction == 'down') {
				
				$('.floatr').show();
				
			} else if (index == 2 && direction == 'up') {
				
				$('.floatr').hide();
			}*/
			if (index == 3 && direction == 'down') {
				
				$('.mouse').hide();
				
			} else if (index == 4 && direction == 'up') {
				
				$('.mouse').show();
			}
          
			},
  });
};
    
  /*$(".btn-nav2, .btn-nav3, .btn-nav4").click(function(){
     if(!$(this).hasClass("active")){
         $('.floatr').show();
     }
  });
  $(".btn-nav1").click(function(){
     if(!$(this).hasClass("active")){
         $('.floatr').hide();
     }
  });*/
  $(".btn-nav1, .btn-nav2, .btn-nav3").click(function(){
     if(!$(this).hasClass("active")){
         $('.mouse').show();
     }
  });
  $(".btn-nav4").click(function(){
     if(!$(this).hasClass("active")){
         $('.mouse').hide();
     }
  });
    
  /*$(".swiper-button-next, .swiper-button-prev").click(function(){
      TweenMax.to($(".swiper-slide.swiper-slide-active img"), 0.3,{"margin-top" : "40px"});
      TweenMax.to($(".swiper-slide:not(.swiper-slide-active) img"), 0.3,{"margin-top" : "0"});
  })*/
    
  var navBtn = $('.news-nav ul li');
  var navWrap = $('.news-item-wrap');
  navBtn.click(function () {
        var navIndex = $(this).index();
        $(this).addClass('active').siblings().removeClass('active');
        navWrap.eq(navIndex).addClass('active').siblings().removeClass('active');
    });
});