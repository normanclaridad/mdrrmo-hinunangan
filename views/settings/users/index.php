<?php
include('../../../inc/app_settings.php');
require_once('../../../inc/helpers.php');
require ('../../../models/User_roles.php');

$helpers = new Helpers();
define('PAGE_TITLE', 'Users');

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
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Role</th>
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
                        <h5 class="modal-title" id="add-user-title">Add User</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="frm-user" method="post" data-parsley-validate="">
                            <input type="hidden" name="action_type" id="action_type">
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            </div>
                            <div id="password-area">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" data-parsley-equalto="#password" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select name="user_role_id" id="user_role_id" class="form-control" data-parsley-required="">
                                    <option value="">Select</option>
                                    <?php foreach($resUserRoles as $userRole): ?>
                                        <option value="<?php echo $userRole['id'] ?>" class="">
                                            <?php echo $userRole['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
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
                url: '<?php echo BASE_URL ?>/api/users/get.php',
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
                "targets": [6],
                "orderable": false
            } ],
            "order": []
        });

        $('#btn-add').click(function(){

            // Reset the form to remove the validation error
            $('#frm-user').parsley().reset();

            $('#password-area').removeClass('password-area');
            $('#action_type').val('add');
            $('#modal-add').modal('show');
        })

        $('#btn-save').click(function(){

            if(!$('form#frm-user').parsley().validate()) {
                return;
            }

            var msg = $('.error-message');
            $.ajax({
                url : '<?php echo BASE_URL ?>/api/users/dml.php',
                type : 'post',
                data : $('#frm-user').serialize(),
                success : function(data) {
                    var json = $.parseJSON(data);

                    if(json['code'] == 0) {
                        msg.html('<div class="alert alert-success">'+ json['message'] +'</div>');
                        $('#modal-add').modal('hide');
                        
                    } else {
                        msg.html('<div class="alert alert-danger">'+ json['message'] +'</div>');
                    }
                }
            })
            return false;
        })
    });

    //Bind to edit
    $(document).on('click', 'a.btn-edit', function(){
        $('#frm-user')[0].reset();
        // Reset the form to remove the validation error
        $('#frm-user').parsley().reset();
        
        $('.modal-title').html('Edit User');
        $('#action_type').val('update');
        $('#id').val($(this).data('id'));
        $('#first_name').val($(this).data('first-name'));
        $('#last_name').val($(this).data('last-name'));
        $('#username').val($(this).data('username'));
        $('#user_role_id').val($(this).data('user-role-id'));
        
        $('#password-area').addClass('password-area');

        $('#password').removeAttr('data-parsley-required');
            $('#confirm_password').removeAttr('data-parsley-required');

        $('#status').removeAttr('checked');
        // $('#status_no').attr('checked', false);
        if($(this).data('status') == 'Y'){
            $('#status').attr('checked', true);
        }
        $('.error-message').html('');

        //Show modal
        $('#modal-add').modal('show');
    });

</script>