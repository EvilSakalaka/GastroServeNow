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
    $('#delete_form_hide').click(function() {
        $('#delete_form #worker_id').val('');
        $('#delete_form #delete_worker_name').text('');
        $('#delete_form_overlay').addClass('hidden');
    });

});

window.editWorker = function(workerId, worker_name, worker_username, worker_role, worker_status) {
    $('#add_form').attr('action', '/manager/edit_worker');
    $('#add_form #worker_id').val(workerId);
    $('#add_form #password').removeAttr('required');
    $('#add_form #name').val(worker_name);
    $('#add_form #username').val(worker_username);
    $('#add_form #role').val(worker_role);
    if (worker_status === 'inactive') {
        $('#add_form #status_inactive').prop('checked', true);
    } else {
        $('#add_form #status_active').prop('checked', true);
    }
    $('#add_form_overlay').removeClass('hidden');
}

window.deleteWorker = function(workerId, worker_name) {
    $('#add_form #worker_id').val(workerId);
    $('#delete_worker_name').text(worker_name);
    $('#delete_form_overlay').removeClass('hidden');
}

