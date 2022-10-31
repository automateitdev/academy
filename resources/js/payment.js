
$(document).ready(function(){
    $(document).on('click', '#spgbtn', function(){
      
  console.log('asi gachi');


      $.ajax({
        type:'post',
        url: 'https://spgapi.sblesheba.com:6314/api/v2/SpgService/GetAccessToken',

        header: 'Content-Type: application/json',
        header:'Authorization: Basic ZHVVc2VyMjAxNDpkdVVzZXJQYXltZW50MjAxNA==',
        data:{ 'AccessUser':{
            'userName':'duUser2014',
            'password':'duUserPayment2014' },
            'invoiceNo':'INV155422121443', 'amount':'400', 'invoiceDate':'2019-02-26', 'accounts': [
            {
            'crAccount': '0002634313655', 'crAmount': 200
            }, {
            'crAccount': '0002634313651', 'crAmount': 200
            } ]
            },
        // dataType : 'json',
        success: function(data){
          
          console.log(data);
  
        },
  
      });
  
    });
  });



/////

 