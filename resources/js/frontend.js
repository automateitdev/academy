// owl carousel
$(document).ready(function() {
    $(".owl-carousel").owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items: 6,
      itemsDesktop: [1199, 3],
      itemsDesktopSmall: [979, 3]
    });
});
$(document).ready(function() {
    $(".owl-carousel-household").owlCarousel({
      autoPlay: 5000, //Set AutoPlay to 3 seconds
      items: 5,
      itemsDesktop: [10, 100],
      itemsDesktopSmall: [10, 100]
    });
});
// end carousel