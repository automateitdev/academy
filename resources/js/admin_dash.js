const { colors } = require("laravel-mix/src/Log");
const { isEmpty, isNumber, add, forEach, isSet, replace } = require("lodash");

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
        console.log(data);
        $('.fund_of_amount>tbody').html(" ");

        for(var i=0;i<data.length;i++){ 

          op+='<tr><td style="width: 300px;"><input type="text" class="insId" value="'+data[i].fund.id+'" name="fund_id[]">'+data[i].fund.fund_name+'</td><td style="width: 100px;"><input type="text" class="form-control fun_amount" name="fund_amount[]"></td></tr>';
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

        console.log(data);
        $('.date_assign_table>tbody').html(" ");

        for(var i=0; i < data.length; i++){ 
          console.log(data);
          op+='<tr><td><input type="text" class="form-control insId feesubheadname" value="'+data[i].feesubhead.id+'" name="feesubhead_id[]">'+data[i].feesubhead.subhead_name+'</td><td><input type="date" class="form-control" name="payable_date[]"></td><td><input type="date" class="form-control" name="fineactive_date[]"></td></tr>';
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
          var url;

    $.ajax({
      type:'get',
      url: '/getStudentdata',
      data:{'id':section_id},
      success: function(data){
       
        $('.quickCollection>tbody').html(" ");
        for(var i=0;i<data.length;i++){ 
          op+='<tr><td>'+data[i].std_id+'</td><td>'+data[i].roll+'</td><td>'+data[i].name+'</td><td>'+data[i].group_id+'</td><td>'+data[i].std_category_id+'</td><td><a href="/FeesManagement/feecollection/view/'+data[i].id+'"><button class="btn btn-primary">view</button></a></td></tr>'
        }

        $('.quickCollection>tbody').append(op);

      },

    });

  });
});

//quick collection end


// ////////////////////////Student dashboard start
//payment

$(document).on('click', '#v-pills-payment-tab', function(){
  console.log("click click");
  var payable;
  var fine;
  var waiver;
  var grand = 0;

  $(".pay-table tr td").each(function(index) {
    payable = $('.payable').eq(index).text();
    fine = $('.fine').eq(index).text();
    waiver = $('.waiver').eq(index).text();
    var pyfine = parseFloat(payable) + parseFloat(fine);
    $('.pay_total').eq(index).html(pyfine - waiver); 
    
  });

  $('.pay_total').each(function(index){
    // paytotal = ;
    grand += parseInt($('.pay_total').eq(index).text()); 
    
  });
  var waiverAmount = $('#waiverAmount').val();
  var FinalGrandtotal = grand - waiverAmount;

  $('.grandTotal').html(grand);
  
  $('.grandpass').val(grand);
});

// ////////////////////Stdent dashboard end

////////////// Waiver start

$(document).ready(function(){
  $(document).on('change', '.waiver_feehead', function(){
    var feehead_id = $(this).val();
    var a=$(this).parent().parent();
    $.ajax({
      type:'get',
      url: '/getfeeheadForWaiver',
      data:{'id':feehead_id},
      success: function(data){

        // a.find('#waiver_amount').val(data.feeamount);
        if(isEmpty(data))
        {
          console.log("empty");
          $('#waiver_amount').val(0);
        }
        $.each(data, function() {
          $.each(this, function(k, v) {
          
            if(!isEmpty(k))
            {
              $('#waiver_amount').val(v);
            }
          });
        });
        

      },
      
      error: function (textStatus, errorThrown) {
        console.log("sdsdsds");
    }

    });

  });
});

///////////// Waiver end

// Admit card start///

// $(document).ready(function(){
//   $(document).on('change', '#admit_section', function(){
//     var section_id = $(this).val();
//     var from = a.find('#formData').val();
//     var to = a.find('#toData').val();
//       $.ajax({
//         type:'post',
//         url: '/getStudentForAdmitCard',
//         data:{'id':section_id, 'from': from, 'to':to},
//         success: function(data){
//           console.log(data);
//           $("#std_name").val(data.name);
//         },
//       }); 

//     });

//   });

let studentData;
let exam_id;
let pdfname;
let path = "layouts.dashboard.layout_certificate.download.essentials.admitprint";
$(document).on('keyup change', '#admitTo', function(e){

  e.preventDefault();
  let section_id = $("select[name=section_id]").val();
  exam_id = $("select[name=exam_id]").val();
  let from = $("input[name=admitForm]").val();
  let to = $("input[name=admitTo]").val();
  pdfname = $("input[name=admitcards]").val();

  let _token   = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
      type:'get',
      url: '/getStudentForAdmitCard',
      data:{
          'section_id':section_id,
          'from':from,
          'to':to
      },
    success: function (data) {
      console.log(data);
      studentData = data; 
      },

    });
    
});

$(document).on('click', '#carddownloadBtn', function(e){
 
  $.ajax({
    type:'post',
    url: 'http://127.0.0.1:8000/api/pdfgenerate',
    dataType: "text",
    data:{
        'studentData':studentData,
        'exam_id':exam_id,
        'pdfname':pdfname,
        'path':path
    },
    success: function(res){
      console.log(res);
      // window.location.href.print(data);

      // const data = res;
      //       const link = document.createElement('a');
      //       link.setAttribute('href', window.location.data);
      //       link.setAttribute('download', 'admitcards.pdf'); // Need to modify filename ...
      //       link.click();

      const blob = new Blob([res], { type: 'pdf' });
    const downloadUrl = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = downloadUrl;
    // a.download = "file.pdf";
    document.body.appendChild(a);
    a.click();
    },

  });
});


// Admit card end///

