$(document).ready(function(){
  console.log('Main JS ready!');
  changeNavbarOnScroll();
  expandAdvancedSearchDiv();
  //clickImageToShowSlider();
  // closeImageOnClickOutside();
  toggleDropdown();
  //tooltip();
  userTimelineTabs();
  markNotifAsRead();
});
// ================================================
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
// ================================================
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
// ================================================
function clickImageToShowSlider(){

  console.log('img_a');

  var html =$(this).find('img').attr('id'); console.log(html);
  $('.modal-slider .content img').attr('src', html);
};
// ================================================
function closeImageOnClickOutside (){
  $('.mfp-close, .mfp-container').on('click', function(){
    $('.ws_images').removeClass('is-active');
  });
}
// ================================================
function toggleDropdown(){
  $('.dropdown-toggle').on('click', function(){
    $('.dropdown-menu').toggle(); 
  });
}
// ================================================
function updateRangeLabel(val){
  $('#range_year').text = val; 
}
// ================================================
function tooltip(){
  $('[data-toggle="tooltip"]').tooltip();
}
// ================================================
function userTimelineTabs(){
  $('.user-timeline .nav-tabs a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
  })
}
// ================================================
function markNotifAsRead(){ 
  $.get('/mark-notif-as-read');
}