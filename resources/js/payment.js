
$(document).ready(function () {
  $(document).on('click', '#spgbtn', function () {

    console.log('asi gachi');


    $.ajax({
      type: 'options',
      url: 'https://spgapi.sblesheba.com:6314/api/v2/SpgService/GetAccessToken',
      headers: {
        'Access-Control-Allow-Origin': 'http://127.0.0.1:8000',
        'Content-Type': 'application/json',
        'Authorization': 'Basic ZHVVc2VyMjAxNDpkdVVzZXJQYXltZW50MjAxNA==',
        // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'jsonp',
      CrossDomain: true,
      data: {
        'AccessUser': {
          'userName': 'duUser2014',
          'password': 'duUserPayment2014'
        },
        'invoiceNo': 'INV155422121443', 'amount': '400', 'invoiceDate': '2019-02-26', 'accounts': [
          {
            'crAccount': '0002634313655', 'crAmount': 200
          }, {
            'crAccount': '0002634313651', 'crAmount': 200
          }]
      },

      processData: false,
      success: function (data) {

        console.log(data);

      },

    });

  });
});



  /////

