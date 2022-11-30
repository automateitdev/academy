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
  
  var grand = 0;


  $('.pay_total').each(function(index){
    grand += parseInt($('.pay_total').eq(index).text()); 
    
  });

  $('.grandTotal').html(grand);
  
  $('#grandTotal').val(grand);
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





let studentData;
let exam_id;
let exam_name;
let pdfname;
let lft = null;
let rgt = null;
let academic_yr_id;
let admitname
let path = "layouts.dashboard.layout_certificate.download.essentials.admitprint";



$(document).ready(function () {
  $("#left_sign").change(function () {
    lft = $(this).children("option:selected").val();
  });
  $("#right_sign").change(function () {
    rgt = $(this).children("option:selected").val();
  });
});


$(document).on('keyup', '#admitTo', function () {
 
  // if (e.isComposing || e.keyCode === 229) {
    // e.preventDefault();
 

  let section_id = $("select[name=section_id]").val();
  let session_id = $("select[name=session_id]").val();
  academic_yr_id = $("select[name=academic_year_id]").val();
  exam_id = $("select[name=exam_id]").val();
  let from = $("input[name=admitForm]").val();
  let to = $("input[name=admitTo]").val();
  admitname = $("select[name=section_id] option:selected").text();
  // console.log(admitname);
  // $( "#myselect option:selected" ).text();
  pdfname = $("input[name=righ_title]").val();

  if (!isEmpty(lft) || !isEmpty(rgt)) {
    $.ajax({
      
      type: 'get',
      contentType: 'application/json',
      url: '/getStudentForAdmitCard',
      data: {
        'section_id': section_id,
        'session_id': session_id,
        'academic_yr_id': academic_yr_id,
        'from': from,
        'to': to,
        'exam_id': exam_id,
        'left_sign': lft,
        'right_sign':rgt
        },
      success: function (data) {
        console.log(data);
        studentData = data;
      },
      });
  }
  else{
    alert("Admit Card should have atleast one title");
  }
// }
});

$(document).on('click', '#carddownloadBtn', function (e) {
  e.preventDefault();
  $('#mainloader').removeClass('d-none');
  let _token   = $('meta[name="csrf-token"]').attr('content');
  // apiurl = $form.attr('api/pdfgenerate'),
  $.ajax({
    type:'post',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
    url: '/api/pdfgenerate',
    xhrFields: {
      responseType: 'blob'
    },
    data:{
      _token:_token,
      'data': studentData,
      'pdfname': pdfname,
      'path': path,
    },
    success: function (data) {
      $('#mainloader').addClass('d-none');
      var blob=new Blob([data], { type: 'contentType'});
      var link=document.createElement('a');
      link.href=window.URL.createObjectURL(blob);
      link.download=admitname.trim()+'.pdf';
      link.click();
      
    },
    error: function () {
      $('#mainloader').addClass('d-none');
      alert("Something went wrong! Please try later.");
    }

  });
});


// Admit card end///

// payment report start

let payapplies_invoice;
let payreportpath = 'layouts/student/reportview';
$(document).on('click', '#payreportpdfGenerate', function(e){
  e.preventDefault();
  payapplies_invoice = $(this).val();
  let _token   = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
      
    type: 'get',
    url: '/getDataForPaymentReport',
    data: {
      'payapplies_invoice': payapplies_invoice,
      },
    success: function (data) {

      console.log(data);
      $.ajax({
        type:'post',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url: '/api/pdfgenerate',
        xhrFields: {
          responseType: 'blob'
        },
        data:{
          _token:_token,
          'data': data,
          'pdfname': pdfname,
          'path': payreportpath,
        },
        success: function (data) {

          // $('#mainloader').addClass('d-none');
          var blob=new Blob([data], { type: 'contentType'});
          var link=document.createElement('a');
          link.href=window.URL.createObjectURL(blob);
          link.download=payapplies_invoice.trim()+".pdf";
          link.click();
          
        },
        error: function () {
          // $('#mainloader').addClass('d-none');
          alert("Something went wrong! Please try later.");
        }
    
      });
    },
    });
});
// payment report end

// fee sub head remove
$(document).ready(function(){
  $(document).on('change', '.feeheadForRemove', function(){
    var feehead_id=$(this).val();
          var op=" ";
          var url;

    $.ajax({
      type:'get',
      url: '/getsubheadforremove',
      data:{'id':feehead_id},
      success: function(data){

       $('.feesubheadforremove').html("");
       for(var i=0;i<data.length;i++){ 
          op+='<option value="'+data[i].feesubhead.id+'">'+data[i].feesubhead.subhead_name+'</option>'
        }
       $('.feesubheadforremove').append(op);

      },

    });

  });
});
// fee sub head remove end

//subject assign
let i = 1;
$('form').on('click', '.addsubjecttable', function(){

  $('select.subject_name').val('');
  

  let $newRow = $('div.add:first').clone();

  // $('.selectall').each(function(){
    // $('.selectall'+i).select2();
  // });
  // $('#selectall').each(function(index,event){
  //   $('#selectall'+index).select2();
  // });

  
  $newRow.find('select.subject_name').val('');
  $newRow.find('select.type').val('');
  $newRow.find('input.serial').val('');
  $newRow.find('input.merge').val('');


  $('.subject_table').append($newRow);
});
// subject assign end