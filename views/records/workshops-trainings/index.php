<?php
include('../../../inc/app_settings.php');
require_once('../../../inc/helpers.php');
require ('../../../models/User_roles.php');
require ('../../../models/Sources.php');
require ('../../../models/Employees.php');
require ('../../../models/Workshop_training_types.php');
require ('../../../models/Barangays.php');

$helpers = new Helpers();
define('PAGE_TITLE', 'Workshops and Training Sessions');

if(!$helpers->checkSession()) {
    $helpers->redirectLogin();
    return;
}

$userRoles = new User_roles();
$employees = new Employees();
$sources = new Sources();
$workshopTrainingTypes = new Workshop_training_types();
$barangays = new Barangays();

$resUserRoles = $userRoles->getWhere("AND status = 'Y'");

$resEmployees = $employees->getWhere(" AND status = 'Y'");
$resSources = $sources->getWhere(" AND status = 'Y'");
$resWorkshopTrainingTypes = $workshopTrainingTypes->getWhere(" AND status = 'Y'");
$resBarangays = $barangays->getWhere("AND cityMunCode=" . $_SESSION['SESS_CITY_MUN']);

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
    
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        font-size: .80rem !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        padding-left: 10px !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        top:auto;
    }
    .blgu-area {
        display: none;
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
                                <th>Conducted<br>/Attended</th>
                                <th>Title</th>
                                <th>Source</th>
                                <th>Date</th>
                                <th>Workshop training type</th>
                                <th>File</th>
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
    
        <!-- MODAL 1 -->
        <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add-user-title">Add <?php echo PAGE_TITLE ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="frm-crud" method="post" data-parsley-validate="" enctype="multipart/form-data">
                            <input type="hidden" name="action_type" id="action_type">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="title">Conducted/Attended</label>
                                <select name="conducted_attend" id="conducted_attend" class="form-control">
                                    <option value="">Select</option>
                                    <option value="C">Conducted</option>
                                    <option value="A">Attended</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="source">Source</label>
                                <select name="source" id="source" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php foreach($resSources as $so) : ?>
                                        <option value="<?php echo $so['id'] ?>">
                                            <?php echo $so['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>                            
                            <div class="form-group blgu-area">
                                <label for="barangay">Barangay</label>
                                <select name="barangay" id="barangay" class="form-control" style="width: 100%;">
                                    <option value="">Select</option>
                                    <?php foreach($resBarangays as $br) : ?>
                                        <option value="<?php echo $br['id'] ?>">
                                            <?php echo $br['brgyDesc'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="employees">Employees</label>
                                <select name="employees" id="employees" class="form-control" multiple required style="width: 100%;">
                                    <option value="">Select</option>
                                    <?php foreach($resEmployees as $emp) : ?>
                                        <option value="<?php echo $emp['id'] ?>">
                                            <?php echo $emp['first_name'] . ' ' . $emp['last_name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="form-group">
                                <label for="workshop_training_type">Type Of Workshops and Trainings</label>
                                <select name="workshop_training_type" id="workshop_training_type" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php foreach($resWorkshopTrainingTypes as $wt) : ?>
                                        <option value="<?php echo $wt['id'] ?>">
                                            <?php echo $wt['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="scanned_file">Scanned File</label>
                                <input type="file" class="form-control" id="scanned_file" name="scanned_file" required>
                            </div>
                            <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="status" name="status"> Status </label>
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
                url: '<?php echo BASE_URL ?>/api/workshops-trainings/get.php',
                type: 'POST',
                data:   function ( d ) {
                    return $.extend( {}, d, {
                        //'action' : getAction()
                    } );
                },
                "dataSrc": function ( json ) {
                    
                    if($('#action').val() == 'excel') {
                        window.open(json.url, '_blank');
                    }

                    if($('#action').val() == 'print') {
                        // window.open(json.url);
                        //createPopupWin(json.url, 'Lots')
                    }
                    return json.data;
                }
            },
            "columnDefs": [ {
                "targets": [8],
                "orderable": false
            } ],
            "order": []
        });

        $('#btn-add').click(function(){

            // Reset the form to remove the validation error
            $('#frm-crud').parsley().reset();
            $('#frm-crud')[0].reset();
            $('#scanned_file').attr('required', '');
            $('#action_type').val('add');
            $('#modal-add').modal('show');
        })

        $('#btn-save').click(function(){

            if(!$('form#frm-crud').parsley().validate()) {
                return;
            }

            var formData = new FormData();
            formData.append('file', $('#scanned_file')[0].files[0]);
            formData.append('conducted_attend', $('#conducted_attend').val());
            formData.append('source', $('#source').val());
            formData.append('barangay', $('#barangay').val());
            formData.append('employees', $('#employees').val());
            formData.append('title', $('#title').val());
            formData.append('date', $('#date').val());
            formData.append('workshop_training_type', $('#workshop_training_type').val());            
            formData.append('status', $('#status').val());
            formData.append('id', $('#id').val());
            formData.append('action_type', $('#action_type').val());

            var msg = $('.error-message');
            $.ajax({
                url : '<?php echo BASE_URL ?>/api/workshops-trainings/dml.php',
                type : 'post',
                data : formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success : function(data) {
                    var json = $.parseJSON(data);

                    if(json['code'] == 0) {
                        msg.html('<div class="alert alert-success">'+ json['message'] +'</div>');
                        $('#tbl-data').DataTable().ajax.reload();
                        $('#modal-add').modal('hide');
                        
                    } else {
                        msg.html('<div class="alert alert-danger">'+ json['message'] +'</div>');
                    }
                }
            })
            return false;
        })

        $('#employees').select2({
            dropdownParent: $('#modal-add'),
            allowClear: true
        })

        $('#source').change(function(){
            $('.blgu-area').hide();
            $('#barangay').val('');
            $('#barangay').removeAttr('required');
            if($(this).val() == 2) {
                $('.blgu-area').show();
                $('#barangay').attr('required', '');
            }
        })
        
        $('#source').trigger('change');
    });

    //Bind to edit
    $(document).on('click', 'a.btn-edit', function(){
        $('#frm-crud')[0].reset();
        // Reset the form to remove the validation error
        $('#frm-crud').parsley().reset();

        $('.modal-title').html('Edit <?php echo PAGE_TITLE ?>');
        $('#action_type').val('update');
        $('#id').val($(this).data('id'));
        $('#conducted_attend').val($(this).data('conducted-attended'));
        $('#source').val($(this).data('source-id'));
        $('#barangay').val($(this).data('barangay-id'));
        var emp = $(this).data('employees').split(',');
        var selectedItems = [];
        for(e of emp){
            // console.log(e);
            selectedItems.push(e);
        }
        // console.log(selectedItems);
        $('#employees').val(selectedItems).trigger('change');
        $('#title').val($(this).data('title'));
        $('#date').val($(this).data('date'));
        $('#workshop_training_type').val($(this).data('workshop-training-type-id'));

        $('#scanned_file').removeAttr('required');
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
        var title = $(this).data('title');

        if(confirm('Are you sure you want this record: ' + title + '?'))
        {
            $.ajax({
                url : '<?php echo BASE_URL ?>/api/workshops-trainings/dml.php',
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