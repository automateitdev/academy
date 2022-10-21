// menu hover dropdown
$(document).ready(function () {
  $(document).on('click', '.ecom_cat', function (e) {
    e.preventDefault();
    var cat_id = $(this).data('value');
    // console.log(div);
    var div = $(this).parent().parent();
    var op = "";
    $.ajax({
      type: 'get',
      url: '/getSubCat',
      data: { 'id': cat_id },
      success: function (data) {
        // console.log("data: " + data);
        // op+= '<li>';

        if (data.length == 0) {
          var dataValue = e.target.getAttribute("data-value")
          div.find('.type_' + dataValue).remove()
        }

        for (var i = 0; i < data.length; i++) {
          if(data[i].cat_id == "2"){
            op += '<li><a class="dropdown-item" href="/about/'+data[i].subcat_link+'/'+ data[i].id + '">' + data[i].subcat_name + '</a></li>';
          }
          if(data[i].cat_id == "3")
          {
            op += '<li><a class="dropdown-item" href="/administration/'+data[i].subcat_link+'/'+ data[i].id + '">' + data[i].subcat_name + '</a></li>';
          }
          if(data[i].cat_id == "4")
          {
            op += '<li><a class="dropdown-item" href="/academic/'+data[i].subcat_link+'/'+ data[i].id + '">' + data[i].subcat_name + '</a></li>';
          }
          if(data[i].cat_id == "5")
          {
            op += '<li><a class="dropdown-item" href="/result/'+data[i].subcat_link+'/'+ data[i].id + '">' + data[i].subcat_name + '</a></li>';
          }
          if(data[i].cat_id == "6")
          {
            op += '<li><a class="dropdown-item" href="/co-curricular/'+data[i].subcat_link+'/'+ data[i].id + '">' + data[i].subcat_name + '</a></li>';
          }
          if(data[i].cat_id == "7")
          {
            op += '<li><a class="dropdown-item" href="/media/'+data[i].subcat_link+'/'+ data[i].id + '">' + data[i].subcat_name + '</a></li>';
          }
          if(data[i].cat_id == "8")
          {
            op += '<li><a class="dropdown-item" href="/more/'+data[i].subcat_link+'/'+ data[i].id + '">' + data[i].subcat_name + '</a></li>';
          }

        }

        // op+=   '</li>';
        div.find('.subcatEcom').html("");
        div.find('.subcatEcom').append(op);
      },

    });

  });

  // ///////
  // invoice

});


// owl carousel
$(document).ready(function () {
  $(".owl-carousel").owlCarousel({
    autoPlay: 3000, //Set AutoPlay to 3 seconds
    items: 6,
    itemsDesktop: [1199, 3],
    itemsDesktopSmall: [979, 3]
  });
});
$(document).ready(function () {
  $(".owl-carousel-household").owlCarousel({
    autoPlay: 5000, //Set AutoPlay to 3 seconds
    items: 5,
    itemsDesktop: [10, 100],
    itemsDesktopSmall: [10, 100]
  });
});
// end carousel