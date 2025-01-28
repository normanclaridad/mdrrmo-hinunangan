<?php
include('../../../inc/app_settings.php');
require_once('../../../inc/helpers.php');

$helpers = new Helpers();
define('PAGE_TITLE', 'Menu');

if(!$helpers->checkSession()) {
    $helpers->redirectLogin();
    return;
}


include_once '../../../templates/header.php';
include_once '../../../templates/sidebar.php';
?>
<style>
     .btn.btn-icon {
        width: 30px;
        height: 30px;
    }
    .card .card-title {
        border-bottom: 1px solid #ccc;
        padding-bottom: 13px;
    }
    .form-group {
        margin-bottom: 0.75rem;
    }

    .form-control, .typeahead, .tt-query, .tt-hint, .select2-container--default .select2-selection--single .select2-search__field, .select2-container--default .select2-selection--single{
        padding: 8px 8px;
    }

    .table th, .table td{
        padding: 5px 5px 5px 5px;
    }

    .table > :not(caption) > * > *{
        padding: 5px 5px 5px 5px;
    }

    table.dataTable{
        margin-top: 21px !important;
    }

    .parsley-errors-list {
        margin: 0px;
    }

    .parsley-errors-list {
        font-size: 0.8rem;
    }
    .password-area {
        display: none;
    }

    .select2-container--default .select2-selection--single .select2-search__field, .select2-container--default .select2-selection--single {
        padding: 16px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: -6px;
    }
    .table {
    width: 100%;
    border-collapse: collapse;
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.table th {
    background-color: #f2f2f2;
    font-weight: bold;
}

.table td {
    text-align: center;
}

.btn {
    padding: 5px 10px;
    background-color: #9e9e9e;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn:hover {
    background-color: #6d6d6d;
}

.btn.btn-sm, .ajax-upload-dragdrop .btn-sm.ajax-file-upload, .btn-group-sm > .btn, .ajax-upload-dragdrop .btn-group-sm > .ajax-file-upload {
    font-size: 0.875rem;
}
.btn i, .ajax-upload-dragdrop .ajax-file-upload i {
    font-size: 1rem;
}
.fa-edit:before, .fa-pencil-square-o:before {
    content: "\f044";
}
.fa-trash:before {
    content: "\f1f8";
}
/* Style for the Term Section */
/* Modal Header */
.modal-header {
    background-color: #f8f9fa; /* Light background for better contrast */
    border-bottom: 1px solid #dee2e6; /* Subtle border at the bottom */
}

/* Modal Title */
.modal-title {
    font-weight: 500; /* Medium weight for better readability */
    font-size: 1.25rem; /* Adjusted font size */
}

/* Modal Body */
.modal-body {
    padding: 20px; /* Increased padding for comfort */
}

/* Fieldset Styles */
fieldset {
    border: 1px solid #dee2e6; /* Light gray border */
    border-radius: 5px; /* Rounded corners */
    padding: 15px; /* Padding inside fieldsets */
    margin-bottom: 20px; /* Space between fieldsets */
}

/* Legend Styles */
legend {
    font-size: 1.1rem; /* Slightly larger font for legend */
    font-weight: bold; /* Bold text for emphasis */
    color: #333; /* Darker color for better contrast */
}

/* Input Styles */
.form-control {
    border-radius: 5px; /* Rounded corners for inputs */
    border: 1px solid #ced4da; /* Light gray border */
}

/* Input Focus */
.form-control:focus {
    border-color: #80bdff; /* Lighter blue border on focus */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Shadow on focus */
}

/* Button Styles */
.btn-primary {
    border-radius: 5px; /* Rounded corners for buttons */
    transition: background-color 0.3s; /* Smooth transition effect */
}

/* Button Hover Effect */
.btn-primary:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

/* Footer Styles */
.modal-footer {
    background-color: #f1f1f1; /* Slightly darker background for footer */
    border-top: 1px solid #dee2e6; /* Gray border on top */
}

/* Small Text Styles */
.form-text {
    font-size: 0.85rem; /* Smaller text for hints */
    color: #6c757d; /* Subtle gray color for less emphasis */
}

</style>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> <?php echo PAGE_TITLE ?> </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?php echo PAGE_TITLE ?>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <?php echo PAGE_TITLE ?>
                        <span class="float-end">
                            <button class="btn btn-outline-secondary btn-rounded btn-icon btn-sm" id="btn-add">
                                <i class="mdi mdi-plus-outline text-info"></i>
                            </button>
                        </span>
                    </h4>
                    <table class="table" id="tbl-data">
                        <thead>
                            <tr> 
                                <th>Subject</th>
                                <th>Created </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
<!-- MODAL 1: Add Maps -->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="addMapModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMapModalLabel">Add Maps</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm-menu" method="post" data-parsley-validate="">
                    <input type="hidden" name="action_type" id="action_type" value="add_map">
                    
                    <div class="form-group">
                        <label for="mapSource">Map Source *</label>
                        <input type="text" class="form-control" id="mapSource" name="map_source" data-parsley-required="" data-parsley-required-message="Map Source is required" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="listName">List Name *</label>
                        <input type="text" class="form-control" id="listName" name="list_name" data-parsley-required="" data-parsley-required-message="List Name is required" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="mapType">Types of Maps *</label>
                        <select class="form-control" id="mapType" name="map_type" data-parsley-required="" data-parsley-required-message="Map Type is required">
                            <option value="">Select a Map Type</option>
                            <option value="Street Map">Street Map</option>
                            <option value="Satellite Map">Satellite Map</option>
                            <option value="Topographic Map">Topographic Map</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn-save" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

                             
<?php
    include_once '../../../templates/footer.php';
?>

<script>
    $(document).ready(function(){
    var table = $('#tbl-data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo BASE_URL ?>/api/menu/get.php',
            type: 'POST'
        },
        columnDefs: [{
            targets: [4],
            orderable: false
        }],
        order: []
    });

    // Show Add Maps Modal
    $('#btn-add').click(function() {
        $('#frm-menu').parsley().reset(); // Clear form validation
        $('#frm-menu')[0].reset();       // Clear form fields
        $('#modal-add').modal('show');   // Show modal
        $('#addMapModalLabel').text('Add Map'); // Update modal title
    });

    // Save button action
    $('#btn-save').click(function() {
        if(!$('#frm-menu').parsley().validate()) {
            return;
        }

        $.ajax({
            url: '<?php echo BASE_URL ?>/api/menu/dml.php', // Adjust to your backend endpoint
            type: 'post',
            data: $('#frm-menu').serialize(),
            success: function(response) {
                var json = $.parseJSON(response);
                if (json['code'] == 0) {
                    alert('Map added successfully!');
                    $('#modal-add').modal('hide');
                    table.ajax.reload();
                } else {
                    alert('Error: ' + json['message']);
                }
            }
        });
    });

    // Clear modal on close
    $('body').on('hidden.bs.modal', '#modal-add', function() {
        $('#frm-menu').parsley().reset();
        $('#frm-menu')[0].reset();
    });
});

</script>


<script>
    $(document).ready(function() {
    var table = $('#tbl-data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo BASE_URL ?>/api/menu/get.php',
            type: 'POST'
        },
        columns: [
            { data: 'map_source' },
            { data: 'list_name' },
            { data: 'map_type' },
            {
                data: 'id',
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-warning btn-edit btn-sm" data-id="${data}" data-map-source="${row.map_source}" data-list-name="${row.list_name}" data-map-type="${row.map_type}">
                            Edit
                        </button>
                        <button class="btn btn-danger btn-delete btn-sm" data-id="${data}" data-name="${row.list_name}">
                            Delete
                        </button>`;
                }
            }
        ],
        columnDefs: [
            { orderable: false, targets: [3] } // Disable ordering on the action column
        ]
    });

    // Handle Edit Button
    $(document).on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        var mapSource = $(this).data('map-source');
        var listName = $(this).data('list-name');
        var mapType = $(this).data('map-type');

        $('#action_type').val('edit');
        $('#id').val(id);
        $('#mapSource').val(mapSource);
        $('#listName').val(listName);
        $('#mapType').val(mapType);

        $('#modal-add').modal('show');
        $('#addMapModalLabel').text('Edit Map');
    });

    // Handle Delete Button
    $(document).on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');

        if (confirm(`Are you sure you want to delete the map: ${name}?`)) {
            $.ajax({
                url: '<?php echo BASE_URL ?>/api/menu/dml.php',
                type: 'POST',
                data: { action_type: 'delete', id: id },
                success: function(response) {
                    var json = $.parseJSON(response);
                    if (json.code === 0) {
                        alert(json.message);
                        table.ajax.reload();
                    } else {
                        alert('Error: ' + json.message);
                    }
                }
            });
        }
    });

    // Save Button Logic
    $('#btn-save').click(function() {
        if (!$('#frm-menu').parsley().validate()) {
            return;
        }

        var actionType = $('#action_type').val();
        var ajaxUrl = '<?php echo BASE_URL ?>/api/menu/dml.php';
        var formData = $('#frm-menu').serialize();

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: formData,
            success: function(response) {
                var json = $.parseJSON(response);
                if (json.code === 0) {
                    alert(actionType === 'add_map' ? 'Map added successfully!' : 'Map updated successfully!');
                    $('#modal-add').modal('hide');
                    table.ajax.reload();
                } else {
                    alert('Error: ' + json.message);
                }
            }
        });
    });
});

</script>




<script>
        //for edit
        $(document).on('click', '.btn-edit' ,function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var url = $(this).data('url');
                var icon = $(this).data('icon');
                var sort = $(this).data('sort');
                var status = $(this).data('status');
                var activekeyword = $(this).data('active-keyword');
                
                // Reset the form to remove the validation error
                $('#frm-menu').parsley().reset();

                $('#id').val(id);
                $('#action_type').val('update');
                $('#name').val(name);
                $('#url').val(url);
                $('#icon').val(icon);
                $('#sort').val(sort);
                $('#status').val(status);
                $('#active_keyword').val(activekeyword);
                
                if(status == 'Y'){
                    $('#status').prop('checked', true);
                }
                else {
                    $('#status').prop('checked', false);

                }
            

                $('#modal-add').modal('show');
                $('#modal-title').text('Edit Menu');
            })

            //for delete
            $(document).on('click', 'a.btn-delete', function(){
                var id = $(this).data('id');
                var name = $(this).data('name');

                if(confirm('Are you sure you want delete name: ' + name + '?'))
                {
                    $.ajax({
                        url : '<?php echo BASE_URL ?>/api/menu/dml.php',
                        type : 'post',
                        data : { action_type : 'delete', 'id' : id },
                        success : function(data) {
                            var json = $.parseJSON(data);
                            if(json['code'] == 0) {
                                alert(json['message']);
                                $('#tbl-data').DataTable().ajax.reload();
                            } else {
                                alert(json['message']);
                            }
                        }
                    })
                }
            })


            //clearing modal styles
            $('body').on('hidden.bs.modal', '.modal', function () {
                console.log("modal closed");
            
                $("#error-message").html("");
                $("#name").add("#url").add("#icon").add("#sort").css({ 'background-color' : 'white', 'border-color' : '', 'color' : 'black' });
                $('#frm-menu').parsley().reset();

        });
</script>