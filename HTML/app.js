$(document).ready(function(){ 
  
  changeNavbarOnScroll();
  
});

function changeNavbarOnScroll(){ 
  
  var scrollTop = 0;
  $(window).scroll(function(){
    scrollTop = $(window).scrollTop();
     $('.counter').html(scrollTop);
    
    if (scrollTop >= 100) {
      $('#global-nav').addClass('scrolled-nav');
    } else if (scrollTop < 100) {
      $('#global-nav').removeClass('scrolled-nav');
    } 
    
  }); 
}