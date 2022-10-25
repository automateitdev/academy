const { isEmpty } = require("lodash");

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
          var op=" ";

    $.ajax({
      type:'get',
      url: '/getFeeheadToFund',
      data:{'id':feehead_id},
      success: function(data){
        
        $('.fund_of_amount>tbody').html(" ");
        for(var i=0;i<data.length;i++){ 
          op+='<tr><td style="width: 300px;"><input type="text" class="insId" value="'+data[i].id+'" name="fund_id[]">'+data[i].fund_name+'</td><td style="width: 100px;"><input type="text" class="form-control fun_amount" name="fund_amount[]"></td></tr>';
        }

        $('.fund_of_amount>tbody').append(op);

      },

    });

  });
});
// fee amount end

// fee amount check total
$(document).on("keyup change mouseup mousedown mouseout keydown", ".feeamount", function() {
  $('.saveBtn').prop('disabled', true);
  $(document).on("keyup change mouseup mousedown mouseout keydown", ".fun_amount", function() {
  var sum = 0.00;
  $(".fun_amount").each(function(){
      sum += +$(this).val();
  });

  var mainAmount = $(".feeamount").val();

  if(mainAmount != sum)
  {
    $('.saveBtn').prop('disabled', true);
  }
  else{
    $('.saveBtn').prop('disabled', false);
  }
});
});

// date setup
$(document).ready(function(){
  $(document).on('change', '.feehead_for_date', function(){
    var feehead_id=$(this).val();
          var op=" ";

    $.ajax({
      type:'get',
      url: '/getFeesubheadfromFeehead',
      data:{'id':feehead_id},
      success: function(data){
        
        $('.date_assign_table>tbody').html(" ");
        for(var i=0;i<data.length;i++){ 
          op+='<tr><td><input type="text" class="form-control insId feesubheadname" value="'+data[i].id+'" name="feesubhead_id[]">'+data[i].subhead_name+'</td><td><input type="date" class="form-control" name="payable_date[]"></td><td><input type="date" class="form-control" name="fineactive_date[]"></td></tr>'
        }

        $('.date_assign_table>tbody').append(op);

      },

    });

  });
});
// date setup end

// quick collection start
$(document).ready(function(){
  $(document).on('change', '.quick_student', function(){
    var section_id=$(this).val();
          var op=" ";

    $.ajax({
      type:'get',
      url: '/getStudentdata',
      data:{'id':section_id},
      success: function(data){
        
        $('.quickCollection>tbody').html(" ");
        for(var i=0;i<data.length;i++){ 
          op+='<tr><td>'+data[i].std_id+'</td><td>'+data[i].roll+'</td><td>'+data[i].name+'</td><td>'+data[i].group_id+'</td><td>'+data[i].group_id+'</td><td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-yelp" viewBox="0 0 16 16"><path d="m4.188 10.095.736-.17a.824.824 0 0 0 .073-.02.813.813 0 0 0 .453-1.255 1.025 1.025 0 0 0-.3-.258 2.782 2.782 0 0 0-.428-.198l-.808-.295a76.035 76.035 0 0 0-1.364-.493C2.253 7.3 2 7.208 1.783 7.14c-.041-.013-.087-.025-.124-.038a2.143 2.143 0 0 0-.606-.116.723.723 0 0 0-.572.245 1.625 1.625 0 0 0-.105.132 1.555 1.555 0 0 0-.155.309c-.15.443-.225.908-.22 1.376.002.423.013.966.246 1.334a.785.785 0 0 0 .22.24c.166.114.333.129.507.141.26.019.513-.045.764-.103l2.447-.566.003.001Zm8.219-3.911a4.185 4.185 0 0 0-.8-1.14 1.602 1.602 0 0 0-.275-.21 1.591 1.591 0 0 0-.15-.073.723.723 0 0 0-.621.031c-.142.07-.294.182-.496.37-.028.028-.063.06-.094.089-.167.156-.353.35-.574.575-.34.345-.677.691-1.01 1.042l-.598.62a2.79 2.79 0 0 0-.298.365 1 1 0 0 0-.157.364.813.813 0 0 0 .007.301c0 .005.002.009.003.013a.812.812 0 0 0 .945.616.774.774 0 0 0 .074-.014l3.185-.736c.251-.058.506-.112.732-.242.151-.088.295-.175.394-.35a.787.787 0 0 0 .093-.313c.05-.434-.178-.927-.36-1.308ZM6.706 7.523c.23-.29.23-.722.25-1.075.07-1.181.143-2.362.201-3.543.022-.448.07-.89.044-1.34-.022-.372-.025-.799-.26-1.104C6.528-.077 5.644-.033 5.04.05c-.185.025-.37.06-.553.104a7.589 7.589 0 0 0-.543.149c-.58.19-1.393.537-1.53 1.204-.078.377.106.763.249 1.107.173.417.41.792.625 1.185.57 1.036 1.15 2.066 1.728 3.097.172.308.36.697.695.857.022.01.045.018.068.025.15.057.313.068.469.032l.028-.007a.809.809 0 0 0 .377-.226.732.732 0 0 0 .053-.055Zm-.276 3.161a.737.737 0 0 0-.923-.234.976.976 0 0 0-.145.09 1.909 1.909 0 0 0-.346.354c-.026.033-.05.077-.08.104l-.512.705c-.29.395-.577.791-.861 1.193-.185.26-.346.479-.472.673l-.072.11c-.152.235-.238.406-.282.559a.73.73 0 0 0-.03.314c.013.11.05.217.108.312.031.047.064.093.1.138a1.548 1.548 0 0 0 .257.237 4.482 4.482 0 0 0 2.196.76 1.593 1.593 0 0 0 .349-.027 1.57 1.57 0 0 0 .163-.048.797.797 0 0 0 .278-.178.731.731 0 0 0 .17-.266c.059-.147.098-.335.123-.613l.012-.13c.02-.231.03-.502.045-.821.025-.49.044-.98.06-1.469l.033-.87a2.09 2.09 0 0 0-.055-.623.93.93 0 0 0-.117-.27Zm5.783 1.362a2.199 2.199 0 0 0-.498-.378l-.112-.067c-.199-.12-.438-.246-.719-.398-.43-.236-.86-.466-1.295-.695l-.767-.407c-.04-.012-.08-.04-.118-.059a1.908 1.908 0 0 0-.466-.166.993.993 0 0 0-.17-.018.738.738 0 0 0-.725.616.946.946 0 0 0 .01.293c.038.204.13.406.224.583l.41.768c.228.434.459.864.696 1.294.152.28.28.52.398.719.023.037.048.077.068.112.145.239.261.39.379.497a.73.73 0 0 0 .596.201 1.55 1.55 0 0 0 .168-.029 1.584 1.584 0 0 0 .325-.129 4.06 4.06 0 0 0 .855-.64c.306-.3.577-.63.788-1.006.03-.053.055-.109.076-.165a1.58 1.58 0 0 0 .051-.161c.013-.056.022-.111.029-.168a.792.792 0 0 0-.038-.327.73.73 0 0 0-.165-.27Z"/></svg></td></tr>'
        }

        $('.quickCollection>tbody').append(op);

      },

    });

  });
});

//quick collection end