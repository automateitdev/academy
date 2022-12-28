const {
    isEmpty, defaultsDeep
} = require("lodash");

// mark input
let searchGroup_id;
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
                    // console.log("key " + key + " has value " + data[key]);
                    ot += '<option value="' + key + '">' + data[key] + '</option>';

                }
                $('.examnameid').append(ot);

            },

        });
       console.log($("select[name=group_id]").val());

        $.ajax({
            type: 'get',
            url: '/getsubjectinfo',
            data: {
                'id': class_id,
                // 'gId' searchGroup_id,
            },
            success: function (data) {
                // console.log(data);
                $('.subjectformarkinput').html(" ");

                or += '<option value="0" selected disabled>Choose One</option>';
                for (var key in data) {
                    // console.log("key " + key + " has value " + data[key]);
                    or += '<option value="' + key + '">' + data[key] + '</option>';

                }
                $('.subjectformarkinput').append(or);

            },

        });

    });
});

// mark input

// Tabulation sheet 

let tabulation_class_id;
let tabulation_group_id;
let tabulation_academic_year_id;
let tabulation_examstartup_id;
let tabulfileName;
let tabulationData;
let tabulPath = 'layouts/dashboard/exam_management/report/tabulation/pdf';


$(document).ready(function () {
    $(document).on('click', '#Generatett', function () {
        console.log("click click");
        $('#mainloader').removeClass('d-none');
        tabulation_class_id = $("select[name=class_id]").val();
        tabulation_group_id = $("select[name=group_id]").val();
        tabulation_academic_year_id = $("select[name=academic_year_id]").val();
        tabulation_examstartup_id = $("select[name=examstartup_id]").val();
        tabulfileName = $("select[name=class_id] option:selected").text().trim();


        $.ajax({
            type: 'get',
            url: '/Tabulation_sheet_generate',
            data: {
                'class_id': tabulation_class_id,
                'group_id': tabulation_group_id,
                'academic_year_id': tabulation_academic_year_id,
                'examstartup_id': tabulation_examstartup_id,
            },
            success: function (data) {
                console.log(data);
                $('#mainloader').addClass('d-none');
                tabulationData = data;
                if (!isEmpty(tabulationData)) {
                    $("#tabuleDownload").attr('disabled', false);
                }
            },
            
            error: function () {
                $('#mainloader').addClass('d-none');
                alert("Something went wrong! Please try later.");
            }

        });
    });
});
$(document).ready(function () {
    $(document).on('click', '#tabuleDownload', function (e) {
        e.preventDefault();
        
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
                // 'pdfname': tabulfileName,
                'path': tabulPath,
            },
            success: function (datas) {
                console.log(datas);
                
                var blob = new Blob([datas], {
                    type: 'contentType'
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'tabulation.pdf';
                link.click();

            },
            error: function () {
                $('#mainloader').addClass('d-none');
                alert("Something went wrong! Please try later.");
            }

        });

    });
});
$(document).ready(function () {

    $(document).on('change', '#tabulationClass', function () {
        var class_id = $(this).val();
        var ot = " ";
        var op = " ";

        $.ajax({
            type: 'get',
            url: '/getexamfromexamcreate',
            data: {
                'id': class_id
            },
            success: function (data) {

                $('.tabuleexamnameid').html(" ");

                ot += '<option value="0" selected disabled>Choose One</option>';
                for (var key in data) {
                    //   console.log("key " + key + " has value " + data[key]);
                    ot += '<option value="' + key + '">' + data[key] + '</option>';

                }
                $('.tabuleexamnameid').append(ot);

            },

        });
        $.ajax({
            type: 'get',
            url: '/getgroupforexaminput',
            data: {
                'id': class_id
            },
            success: function (data) {

                $('.tabulesubjectgroup').html(" ");

                op += '<option value="0" selected disabled>Choose One</option>';
                for (var key in data) {
                    op += '<option value="' + key + '">' + data[key] + '</option>';

                }
                $('.tabulesubjectgroup').append(op);

            },

        });

    });
});
// Tabulation sheet 
