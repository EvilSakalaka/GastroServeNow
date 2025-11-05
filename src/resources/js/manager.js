import $ from 'jquery';

$(document).ready(function() {
    $('#add_form_show').click(function() {
        $('#add_form').removeClass('hidden');
    });

    $('#add_form_hide').click(function() {
        $('#add_form').addClass('hidden');
    });


});

function editWorker(workerId) 
{
    
}