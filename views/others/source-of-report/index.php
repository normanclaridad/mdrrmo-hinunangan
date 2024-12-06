<?php
include('../../../inc/app_settings.php');
require_once('../../../inc/helpers.php');
require ('../../../models/User_roles.php');

$helpers = new Helpers();
define('PAGE_TITLE', 'Schools');

if(!$helpers->checkSession()) {
    $helpers->redirectLogin();
    return;
}

$userRoles = new User_roles();

$resUserRoles = $userRoles->getWhere("AND status = 'Y'");

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
                    <table class="table table-responsive" id="tbl-data">
                        <thead>
                            <tr> 
                                <th>Subject</th>
                                <th>Barangay</th>
                                <th>Status</th>
                                <th>Date/Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <!-- Modal for Adding Report -->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Add Report</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm-crud" action="submit_report.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Report Source</legend>
                        <div class="form-group mb-3">
                            <label for="sources" class="form-label">Source of Report <span class="text-danger">*</span></label>
                            <select class="form-control" id="sources" name="sources" required>
                                <option value="">Select source</option>
                                <option value="source1">LGU</option>
                                <option value="source2">BLGU</option>
                                <option value="source2">Police</option>
                                <option value="source3">Other LGUs</option>
                                <option value="source4">Supplier</option>
                            </select>
                            <small class="form-text text-muted">Please select the source of the report.</small>
                        </div>

                        <!-- LGU Details -->
                        <div id="lguDetails" style="display:none; border: 1px solid #ccc; padding: 15px; border-radius: 5px; margin-top: 15px;">
                            <h6 class="text-primary mb-3">LGU Details</h6>
                            <div class="form-group mb-3">
                                <label for="date" class="form-label">Date of Issuance <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Title of Issuance <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter the title of the issuance" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="file" class="form-label">Upload Scanned File (PDF/Image) <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file" id="file" name="file" accept="application/pdf, image/*" multiple>
                                <small class="form-text text-muted"><br>Upload the related scanned document (PDF or Image).</small>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn-save" class="btn btn-primary">Save Report</button>
            </div>
        </div>
    </div>
</div>
  
 
                             
<?php
    include_once '../../../templates/footer.php';
?>
<script>

    //Bind to edit
    $(document).on('click', 'a.btn-edit', function(){
        $('#frm-crud')[0].reset();
        // Reset the form to remove the validation error
        $('#frm-crud').parsley().reset();

        $('.modal-title').html('Edit <?php echo PAGE_TITLE ?>');
        $('#action_type').val('update');
        $('#id').val($(this).data('id'));
        $('#name').val($(this).data('name'));
        $('#school_type').val($(this).data('type'));
        // $('#barangay').val($(this).data('barangay-id'));
        // $('#barangay').val($(this).data('address'));

        var data = {
            id: $(this).data('barangay-id'),
            text: $(this).data('address')
        };

        var newOption = new Option(data.text, data.id, false, false);
        $('#barangay').append(newOption).trigger('change');

        $('#status').removeAttr('checked');
        // $('#status_no').attr('checked', false);
        if($(this).data('status') == 'Y'){
            $('#status').attr('checked', true);
        }
        $('.error-message').html('');

        //Show modal
        $('#modal-add').modal('show');
    });

    //for delete
    $(document).on('click', 'a.btn-delete', function(){
        var id = $(this).data('id');
        var name = $(this).data('name');

        if(confirm('Are you sure you want delete name: ' + name + '?'))
        {
            $.ajax({
                url : '<?php echo BASE_URL ?>/api/schools/dml.php',
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
    
</script>