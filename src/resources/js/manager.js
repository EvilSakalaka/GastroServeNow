import $ from 'jquery';

$(document).ready(function() {
    $('#add_form_show').click(function() {
        $('#add_form').attr('action', '/manager/add_worker');
        $('#add_form_overlay').removeClass('hidden');
    });

    $('#add_form_hide').click(function() {
        $('#add_form #worker_id').val('');
        $('#add_form #name').val('');
        $('#add_form #username').val('');
        $('#add_form #role').val('');
        $('#add_form #password').attr('required', 'required');
        $('#add_form_overlay').addClass('hidden');
    });

    $('#edit_form_hide').click(function() {
        $('#edit_form #worker_id').val('');
        $('#edit_form #name').val('');
        $('#edit_form #username').val('');
        $('#edit_form #role').val('');
        $('#edit_form #password').attr('required', 'required');
        $('#edit_form_overlay').addClass('hidden');
    });
    
    $('#delete_form_hide').click(function() {
        $('#delete_form #worker_id').val('');
        $('#delete_form #delete_worker_name').text('');
        $('#delete_form_overlay').addClass('hidden');
    });

});

window.editWorker = function(workerId, worker_name, worker_username, worker_role, worker_status) {
    $('#edit_form #worker_id').val(workerId);
    $('#edit_form #password').removeAttr('required');
    $('#edit_form #name').val(worker_name);
    $('#edit_form #username').val(worker_username);
    $('#edit_form #role').val(worker_role);
    if (worker_status === 'inactive') {
        $('#edit_form #status_inactive').prop('checked', true);
    } else {
        $('#edit_form #status_active').prop('checked', true);
    }
    $('#edit_form_overlay').removeClass('hidden');
}

window.deleteWorker = function(workerId, worker_name) {
    $('#add_form #worker_id').val(workerId);
    $('#delete_worker_name').text(worker_name);
    $('#delete_form_overlay').removeClass('hidden');
}

