$(document).ready(function () {    


    // Nice select JS
    // $('#select_classes').niceSelect();
    // $('#classes').niceSelect();
    // $('#select_views').niceSelect();
    // $('#qstGroup').niceSelect();
    // $('#type').niceSelect();
    // $('#studentCat').niceSelect();
    // $('#studentGender').niceSelect();
    
    // Select2 JS
    // $('.select2_states').select2();
    // $('#select_section').select2();
    // $('#select_subject').select2();
    // $('#section').select2();
    // $('#subject').select2();


    // jQuery Datepicker
    $("#datepicker").datepicker({
        dateFormat: "mm"
    });

    // Add style
    $("ul[class='list']").addClass('shadow');

    // // Add style  in Staff section                     
    $("#staff_tbody").css('display', 'block');

    $('button[data-duplicate-add="email"]').on('click', function () {
        // $("#staff_tbody").css('display', 'block');
    });


});