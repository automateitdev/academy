const { isEmpty } = require("lodash");

// mark input
$(document).ready(function () {
    $(document).on('change', '#subjectClass', function () {
        var class_id = $(this).val();
        var op = " ";
        var ot = " ";
        var or = " ";

        $.ajax({
            type: 'get',
            url: '/getgroupforexaminput',
            data: {
                'id': class_id
            },
            success: function (data) {

                $('.subjectgroup').html(" ");

                op += '<option value="0" selected disabled>Choose One</option>';
                for (var key in data) {
                    op += '<option value="' + key + '">' + data[key] + '</option>';

                }
                $('.subjectgroup').append(op);

            },

        });
        $.ajax({
            type: 'get',
            url: '/getexamfromexamcreate',
            data: {
                'id': class_id
            },
            success: function (data) {
                // console.log(data);

                $('.examnameid').html(" ");

                ot += '<option value="0" selected disabled>Choose One</option>';
                for (var key in data) {
                      console.log("key " + key + " has value " + data[key]);
                    ot += '<option value="' + key + '">' + data[key] + '</option>';

                }
                $('.examnameid').append(ot);

            },

        });
        $.ajax({
            type: 'get',
            url: '/getsubjectinfo',
            data: {
                'id': class_id
            },
            success: function (data) {
                // console.log(data);
                $('.subjectformarkinput').html(" ");

                or += '<option value="0" selected disabled>Choose One</option>';
                for (var key in data) {
                      console.log("key " + key + " has value " + data[key]);
                    or += '<option value="' + key + '">' + data[key] + '</option>';

                }
                $('.subjectformarkinput').append(or);

            },

        });

    });
});

// mark input

// Tabulation sheet 
    $(document).ready(function () {
            
        $(document).on('change', '#tabulationClass', function () {
            var class_id = $(this).val();
            var ot = " ";

            $.ajax({
                type: 'get',
                url: '/getexamfromexamcreate',
                data: {
                    'id': class_id
                },
                success: function (data) {

                    $('.examnameid').html(" ");

                    ot += '<option value="0" selected disabled>Choose One</option>';
                    for (var key in data) {
                        //   console.log("key " + key + " has value " + data[key]);
                        ot += '<option value="' + key + '">' + data[key] + '</option>';

                    }
                    $('.examnameid').append(ot);

                },

            });

        });
    });
    let tabulation_class_id;
    let tabulation_academic_year_id;
    let tabulation_examstartup_id;
    let tabulfileName;
    let tabulationData;
    let tabulPath = 'layouts/dashboard/exam_management/report/tabulation/pdf';


    $(document).ready(function () {
        $(document).on('click', '#tabulationGenerate', function () {
            
            tabulation_class_id = $("select[name=class_id]").val();
            tabulation_academic_year_id = $("select[name=academic_year_id]").val();
            tabulation_examstartup_id = $("select[name=examstartup_id]").val();
            tabulfileName = $("select[name=class_id] option:selected").text().trim();
           

            $.ajax({
                type: 'get',
                url: '/Tabulation_sheet_generate',
                data: {
                    'class_id': tabulation_class_id,
                    'academic_year_id': tabulation_academic_year_id,
                    'examstartup_id': tabulation_examstartup_id,
                },
                success: function (data) {
                    console.log(data);
                    tabulationData = data;
                    if(!isEmpty(tabulationData))
                    {
                        $("#tabuleDownload").attr('disabled', false);
                    }
                },

            });
        });
    });
$(document).ready(function () {
                $(document).on('click', '#tabuleDownload', function () {
                    // console.log(tabulationData);
                   
            $('#mainloader').removeClass('d-none');
            let _token = $('meta[name="csrf-token"]').attr('content');
            
            $.ajax({
                
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/api/pdfgenerate',
                xhrFields: {
                    responseType: 'blob'
                },
                data: {
                    _token: _token,
                    'data': tabulationData,
                    'pdfname': tabulfileName,
                    'path': tabulPath,
                },
                success: function (data) {
                    // console.log(data);
                    // $('#mainloader').addClass('d-none');
                    var blob = new Blob([data], {
                        type: 'contentType'
                    });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = tabulfileName+'.pdf';
                    link.click();
        
                },
                error: function () {
                    // $('#mainloader').addClass('d-none');
                    alert("Something went wrong! Please try later.");
                }
        
            });

        });
    });

// Tabulation sheet 