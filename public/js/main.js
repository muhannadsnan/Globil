$(document).ready(function(){
  console.log('Main JS ready!');
  changeNavbarOnScroll();
  expandAdvancedSearchDiv();
  // clickImageToShowSlider();
  // closeImageOnClickOutside();
  toggleDropdown();
  $('[data-toggle="tooltip"]').tooltip()
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
// // ================================================
// function clickImageToShowSlider (){
// $('.preview-pic img').on('click', function(e){
//     $('.mfp-wrap, .mfp-bg').removeClass('hide');
//     var src = $('.preview-pic .active img').attr('src'); console.log(src);
//     $('.mfp-img').attr('src', src);

//   });
// });
// // ================================================
// function closeImageOnClickOutside (){
//   $('.mfp-close, .mfp-container').on('click', function(){
//     $('.mfp-wrap, .mfp-bg').addClass('hide');
//   });
// });

}

function toggleDropdown(){
  $('.dropdown-toggle').on('click', function(){
    $('.dropdown-menu').toggle(); 
  });
}