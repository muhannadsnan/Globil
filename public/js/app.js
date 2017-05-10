$(document).ready(function(){
  changeNavbarOnScroll();
  expandAdvancedSearchDiv();
  
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

function expandAdvancedSearchDiv (){
  $(".expand-advanced-search").click(function () {
    $btn = $(this);
    //getting the next element
    $content = /*$btn.next();*/ $(".advanced-filtering"); 
    //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
    $content.slideToggle(500, function () {
        //execute this after slideToggle is done
        //change text of btn based on visibility of content div
        $btn.text(function () {
            //change text based on condition
            return $content.is(":visible") ? "Hide filters" : "More filters";
        });
    });

});
}