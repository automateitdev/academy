
//startup start
$(document).ready(function(){
    $(document).on('change', '.startup_category', function(){
      var startup_cat_id=$(this).val();
      console.log(startup_cat_id);
      var div=$(this).parent().parent().parent();
            var op=" ";

      $.ajax({
        type:'get',
        url: '/getStartupSubCat',
        data:{'id':startup_cat_id},
        success: function(data){
            console.log("dd: "+data);
          op+='<option value="0" selected disabled>Choose</option>';
                    for(var i=0;i<data.length;i++){
                      op+='<option value="'+data[i].id+'">'+data[i].startup_subcategory_name+'</option>';
          }

          div.find('.startup_subcategory').html(" ");
          div.find('.startup_subcategory').append(op);

        },

      });

    });
});
//startup end

// ledger start
$(document).ready(function(){
  $(document).on('change', '.account_category', function(){
    var account_id=$(this).val();
    console.log(account_id);
    var div=$(this).parent().parent().parent();
          var op=" ";

    $.ajax({
      type:'get',
      url: '/getAccountCategory',
      data:{'id':account_id},
      success: function(data){
          console.log("dd: "+data);
        op+='<option value="0" selected disabled>Choose</option>';
                  for(var i=0;i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].account_group+'</option>';
        }

        div.find('.acount_group').html(" ");
        div.find('.acount_group').append(op);

      },

    });

  });
});
//ledger end

// fee amount start
$(document).ready(function(){
  $(document).on('change', '.feehead_amount', function(){
    var feehead_id=$(this).val();
    console.log(feehead_id);
    var op=$(this).parent().parent().parent().parent();
          var op=" ";

    $.ajax({
      type:'get',
      url: '/getFeeheadToFund',
      data:{'id':feehead_id},
      dataType:'json',
      success: function(data){
        
        console.log("dd: "+data);
        
        for(var i=0;i<data.length;i++){ 
          op+='<tr><td style="width: 300px;">'+data[i].fund_id+'</td><td style="width: 100px;"><input type="text" class="form-control" name="fun_amount"></td></tr>'
      }

        div.find('.fund_of_amount tr').html(" ");
        div.find('.fund_of_amount tr').append(op);

      },

    });

  });
});
// fee amount end