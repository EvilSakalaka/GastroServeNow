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

    $('#addProductButton').click(function() {
        $('#add_product_form_overlay').removeClass('hidden');
    });

    $('#add_product_form_hide').click(function() {
        $('#add_product_form_overlay').addClass('hidden');
    });

    $('#edit_product_form_hide').click(function() {
        $('#edit_product_form #product_id').val('');
        $('#edit_product_form #name').val('');
        $('#edit_product_form #category').val('');
        $('#edit_product_form #price').val('');
        $('#edit_product_form #photo_url').val('');
        $('#edit_product_form #area').val('');
        $('#edit_product_form_overlay').addClass('hidden'); 
    });

    $('#delete_product_form_hide').click(function() {
        $('#delete_product_form #product_id').val('');
        $('#delete_product_form #delete_product_name').text('');
        $('#delete_product_form_overlay').addClass('hidden');
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
    $('#delete_form #worker_id').val(workerId);
    $('#delete_worker_name').text(worker_name);
    $('#delete_form_overlay').removeClass('hidden');
}

window.editProduct = function(p_id, p_name, p_category, p_price, p_status, p_photourl, p_isfeatured, p_area, p_allergens) {
    console.log("Allergens: ", p_allergens);
    $('#edit_product_form #product_id').val(p_id);
    $('#edit_product_form #name').val(p_name);
    $('#edit_product_form #category').val(p_category);
    $('#edit_product_form #price').val(p_price);
    $('#edit_product_form #photo_url').val(p_photourl);
    $('#edit_product_form #product_area').val(p_area);
    if (p_status === 'unavailable') {
        $('#edit_product_form #status_unavailable').prop('checked', true);
    } else {
        $('#edit_product_form #status_available').prop('checked', true);
    }
    if (p_isfeatured) {
        $('#edit_product_form #is_featured').prop('checked', true);
    } else {
        $('#edit_product_form #is_featured').prop('checked', false);
    }
    $('#edit_product_form_overlay').removeClass('hidden');
}

window.deleteProduct = function(p_id, p_name) {
    $('#delete_product_form #product_id').val(p_id);
    $('#delete_product_name').text(p_name);
    $('#delete_product_form_overlay').removeClass('hidden');
}