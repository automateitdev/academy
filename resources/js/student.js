
$('form').on('click', '.addstudentRow', function(){
    
    let $newRow = $('div.add:first').clone();
    
    $newRow.find('input.std_id').val('');
    $newRow.find('input.roll').val('');
    $newRow.find('input.name').val('');
    $newRow.find('select.gender').val('');
    $newRow.find('select.religion').val('');
    $newRow.find('input.father_name').val('');
    $newRow.find('input.mother_name').val('');
    $newRow.find('input.mobile_no').val('');

    
    $('.student_table').append($newRow);
});