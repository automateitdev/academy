// menu hover dropdown
$(document).ready(function(){
  $(document).on('click', '.ecom_cat', function(e){
    e.preventDefault();

    var cat_id = $(this).data('value');
    console.log(cat_id);
    var div=$(this).parent().parent();
          var op=" ";

    $.ajax({
      type:'get',
      url: '/getSubCat',
      data:{'id':cat_id},
      success: function(data){
        console.log("data: "+data);
        // op+= '<li>';
        for(var i=0;i<data.length;i++){
          op+='<li><a class="dropdown-item" href="/'+data[i].subcat_link+'">'+data[i].subcat_name+'</a></li>';
          }
        // op+=   '</li>';
        

        div.find('.subcatEcom').html(" ");
        div.find('.subcatEcom').append(op);

      },

    });

  });

  // ///////
  // invoice
  
});
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