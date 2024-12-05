<?php
include('../../../inc/app_settings.php');
require_once('../../../inc/helpers.php');
require ('../../../models/Sitrep_headers.php');
require ('../../../models/Schools.php');
require ('../../../models/Barangays.php');
require ('../../../models/Bridges.php');
require ('../../../models/Roads.php');
require ('../../../models/Facility_types.php');
require ('../../../models/Mechanism_of_injuries.php');
require ('../../../models/Age_brackets.php');
require ('../../../models/Telco.php');

$helpers = new Helpers();
$sitrepHeader = new Sitrep_headers();
$schools = new Schools();
$barangays = new Barangays();
$bridges = new Bridges();
$roads = new Roads();
$facilityTypes = new Facility_types();
$mechanismOfInjuries = new Mechanism_of_injuries();
$ageBrackets = new Age_brackets();
$telco = new Telco();

$id = isset($_GET['id']) ? $_GET['id'] : '';

$id = $helpers->encryptDecrypt($id, 'decrypt');

if(empty($id) || !is_numeric($id)) {
    echo json_encode(['code' => 5, 'message' => 'Invalid request.']);
    return;
}

$resSitTrepHeader = $sitrepHeader->getWhere(' AND id = ' . $id, 'name asc', 'assoc');

if(empty($resSitTrepHeader)) {    
    echo json_encode(['code' => 5, 'message' => 'Invalid request. No record found.']);
    return;
}

$sitrepName = $resSitTrepHeader['name'];

define('PAGE_TITLE', 'Situational Reports');

if(!$helpers->checkSession()) {
    $helpers->redirectLogin();
    return;
}

$resSchools = $schools->getSchools("AND s.status = 'Y'");

$resBarangays = $barangays->getWhere("AND cityMunCode=" . $_SESSION['SESS_CITY_MUN']);

$resBridges = $bridges->getBridges(" AND br.status = 'Y'");

$resRoads = $roads->getRoads(" AND r.status = 'Y'");

$resFacilityTypes = $facilityTypes->getFacilityTypes("AND f.status = 'Y'");
$resMechanismOfInjuries = $mechanismOfInjuries->getMechanismOfInjuries("AND m.status = 'Y'");
$ageBrackets = $ageBrackets->getAgeBrackets("AND status = 'Y'");
$resTelco = $telco->getTelco(" AND status = 'Y'");

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
    
    fieldset {
        border: 1px solid #ccc;
        padding: 10px; 
    }

    fieldset>legend {
        font-size: 14px;
        float: none;
        width: auto;
        padding: 10px;
        font-weight: 700;
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
                        <?php echo $sitrepName ?>
                        <span class="float-end">
                            <button class="btn btn-outline-secondary btn-rounded btn-icon btn-sm" id="btn-add">
                                <i class="mdi mdi-plus-outline text-info"></i>
                            </button>
                        </span>
                    </h4>
                    <table class="table table-responsive" id="tbl-data">
                        <thead>
                            <tr> 
                                <th>Sitrep #</th>
                                <th>Sitrep <br />Date/Time</th>
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add-user-title">Add <?php echo PAGE_TITLE ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="frm-crud" method="post" data-parsley-validate="">
                            <input type="hidden" name="action_type" id="action_type">
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <!-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sit_no">Sitrep #</label>
                                        <input type="text" class="form-control" id="sit_no" name="sit_no" placeholder="Situation Report #" required>
                                    </div>
                                </div> -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" id="date" name="date" placeholder="" required>
                                    </div>
                                </div>                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="time">Time</label>
                                        <input type="time" class="form-control" id="time" name="time" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <fieldset>
                                <legend>SUSPENSION</legend>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="school">Schools</label>
                                        <select class="form-control" id="school" name="school">
                                            <option value="">Select</option>
                                            <?php foreach($resSchools as $school): ?>
                                                <option value="<?php echo $school['id'] ?>" data-brgy="<?php echo $school['brgyDesc'] ?>">
                                                    <?php echo $school['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="">
                                    <table id="schools" class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>School Name</th>
                                                <th>Barangay</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>LANDSLIDE</legend>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" id="landsline_no_reports" name="landsline_no_reports">
                                        <label for="landsline_no_reports">No reports</label>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="school">Barangay</label>
                                            <select class="form-control" id="landslide_barangay" name="landslide_barangay[]" multiple style="width: 100%;">
                                                <?php foreach($resBarangays as $barangay): ?>
                                                    <option value="<?php echo $barangay['id'] ?>">
                                                        <?php echo $barangay['brgyDesc'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>FLOOD</legend>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" id="flood_no_reports" name="flood_no_reports">
                                        <label for="flood_no_reports">No reports</label>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="school">Barangay</label>
                                            <select class="form-control" id="flood_barangay" name="flood_barangay[]" multiple style="width: 100%;">
                                                <?php foreach($resBarangays as $barangay): ?>
                                                    <option value="<?php echo $barangay['id'] ?>">
                                                        <?php echo $barangay['brgyDesc'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>BRIDGES</legend>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" id="bridge_no_reports" name="bridge_no_reports">
                                        <label for="bridge_no_reports">No reports</label>
                                    </div>
                                    <div class="col-md-10">
                                        <div>
                                            <span>
                                                <icon class="fa fa-plus-circle" onclick="addBridges()">Add</icon>
                                            </span>
                                            <table id="bridges" class="table table-grid table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Bridge</th>
                                                        <th>Barangay</th>
                                                        <th>Remarks</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>                            
                            <fieldset>
                                <legend>ROADS</legend>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" id="roads_no_reports" name="roads_no_reports">
                                        <label for="roads_no_reports">No reports</label>
                                    </div>
                                    <div class="col-md-10">
                                        <div>
                                            <span>
                                                <icon class="fa fa-plus-circle" onclick="addRoads()">Add</icon>
                                            </span>
                                            <table id="roads" class="table table-grid table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Road</th>
                                                        <th>Remarks</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>                                                        
                            <fieldset>
                                <legend>DAMAGES</legend>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" id="damage_no_reports" name="damage_no_reports">
                                        <label for="damage_no_reports">No reports</label>
                                    </div>
                                    <div class="col-md-10">
                                        <div>
                                            <span>
                                                <icon class="fa fa-plus-circle" onclick="addDamages()">Add</icon>
                                            </span>
                                            <table id="damages" class="table table-grid table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Barangay</th>
                                                        <th>Type Of Facility</th>
                                                        <th>Damage Count</th>
                                                        <th>Type of Damage</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>CASUALTIES</legend>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" id="casualties_no_reports" name="casualties_no_reports">
                                        <label for="casualties_no_reports">No reports</label>
                                    </div>
                                    <div class="col-md-10">
                                        <div>
                                            <span>
                                                <icon class="fa fa-plus-circle" onclick="addCasualties()">Add</icon>
                                            </span>
                                            <table id="casualties" class="table table-grid table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Location</th>
                                                        <th>Mechanism Of Injuries</th>
                                                        <th>Age Bracket</th>
                                                        <th>Gender</th>
                                                        <th>Count</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>EVACUEES</legend>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" id="evacuees_no_reports" name="evacuees_no_reports">
                                        <label for="evacuees_no_reports">No reports</label>
                                    </div>
                                    <div class="col-md-10">
                                        <div>
                                            <span>
                                                <icon class="fa fa-plus-circle" onclick="addEvacuees()">Add</icon>
                                            </span>
                                            <table id="evacuees" class="table table-grid table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Location</th>
                                                        <th>Age Bracket</th>
                                                        <th>Gender</th>
                                                        <th>Count</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>WATER LEVEL</legend>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" id="water_level_normal" name="water_level_normal">
                                        <label for="water_level_normal">Normal</label>
                                    </div>
                                    <div class="col-md-10">
                                        <div>
                                            <span>
                                                <icon class="fa fa-plus-circle" onclick="addWaterLevel()">Add</icon>
                                            </span>
                                            <table id="water_levels" class="table table-grid table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Location</th>
                                                        <th>Water Level (Meters)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>ELECTRICITY</legend>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" id="electricity_no_reports" name="electricity_no_reports">
                                        <label for="electricity_no_reports">No Interuptions</label>
                                    </div>
                                    <div class="col-md-10">
                                        <div>
                                            <span>
                                                <icon class="fa fa-plus-circle" onclick="addElectricity()">Add</icon>
                                            </span>
                                            <table id="electricity" class="table table-grid table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Location</th>
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
                            </fieldset>
                            <fieldset>
                                <legend>STRANDED</legend>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" id="stranded_no_reports" name="stranded_no_reports">
                                        <label for="stranded_no_reports">No Interuptions</label>
                                    </div>
                                    <div class="col-md-10">
                                        <div>
                                            <span>
                                                <icon class="fa fa-plus-circle" onclick="addStranded()">Add</icon>
                                            </span>
                                            <table id="stranded" class="table table-grid table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Location</th>
                                                        <th>Type</th>
                                                        <th>Stranded Count</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>COMMUNICATION</legend>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" id="communication_no_reports" name="communication_no_reports">
                                        <label for="communication_no_reports">No Interuptions</label>
                                    </div>
                                    <div class="col-md-10">
                                        <div>
                                            <span>
                                                <icon class="fa fa-plus-circle" onclick="addCommunication()">Add</icon>
                                            </span>
                                            <table id="communications" class="table table-grid table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>TELCO</th>
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
                            </fieldset>
                            <fieldset>
                                <legend>PREPAREDNESS MEASURES</legend>
                                <div class="row">                                    
                                    <div class="col-md-12">
                                        <textarea id="preparedness_measures" name="preparedness_measures" class="form-control"></textarea>
                                    </div>
                                </div>
                            </fieldset>
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
                url: '<?php echo BASE_URL ?>/api/sitrep/get-details.php',
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
                "targets": [4],
                "orderable": false
            } ],
            "order": []
        });

        $('#school').change(function() {            
            var schools = $('#schools');
            if($(this).val() != '') {
                var id = $(this).val();
                var validate = false;
                // Validate if school name already added on the table              
                $('#schools').find('tbody').find('tr').each(function(){
                    var schoolId = $(this).data('id');
                    if(parseInt(id) == parseInt(schoolId)) {
                        validate = true;
                    }
                })

                if(!validate) {                    
                    var tr = '<tr data-id="'+ id +'">';
                        tr += '<td style="display: none"><input type="hidden" class="school-id" name="school_id[]" value="'+ id +'" /> </td>';
                        tr += '<td>' + $(this).find(':selected').text() + '</td>';
                        tr += '<td>' + $(this).find(':selected').attr('data-brgy') + '</td>';
                        tr += '<td class="text-center"><icon role="button" onclick="removeSchool(this)">x</icon></td>';
                        tr += '</tr>';
                    schools.append(tr);
                }
            }
        })

        $('#btn-add').click(function(){

            // Reset the form to remove the validation error
            $('#frm-crud').parsley().reset();
            $('#frm-crud')[0].reset();
            $('#action_type').val('add');
            //Destroy and reinitialize
            // $("#barangay").select2("destroy").select2();
            $('#barangay').val(null).trigger('change');
            $('#modal-add').modal('show');
        })

        $('#btn-save').click(function(){

            if(!$('form#frm-crud').parsley().validate()) {
                return;
            }

            //School
            var schoolIds = [];
            $('.school-id').each(function(){
                schoolIds.push($(this).val());
            })

            //Bridges
            var bridges = [];
            $('#bridges').find('tbody').find('tr').each(function(){
                var bridge = $(this).find('td').eq(0).find('select').val();
                var remarks = $(this).find('td').eq(2).find('input').val();
                bridges.push({ bridge: bridge, remarks: remarks });
            })

            //Roads
            var roads = [];
            $('#roads').find('tbody').find('tr').each(function(){
                var road = $(this).find('td').eq(0).find('select').val();
                var remarks = $(this).find('td').eq(1).find('input').val();
                roads.push({ road: road, remarks: remarks });
            })

            // Damages
            var damages = [];
            $('#damages').find('tbody').find('tr').each(function(){
                var barangay = $(this).find('td').eq(0).find('select').val();
                var facilityType = $(this).find('td').eq(1).find('select').val();
                var count = $(this).find('td').eq(2).find('input').val();
                var damageType = $(this).find('td').eq(3).find('select').val();

                damages.push({ 
                    barangay: barangay, 
                    facilityType: facilityType,
                    count: count,
                    damageType: damageType
                });
            })

            // Casualties
            var casualties = [];
            $('#casualties').find('tbody').find('tr').each(function(){
                var barangay = $(this).find('td').eq(0).find('select').val();
                var moi = $(this).find('td').eq(1).find('select').val();
                var ageBracket = $(this).find('td').eq(2).find('select').val();
                var gender = $(this).find('td').eq(3).find('select').val();
                var count = $(this).find('td').eq(4).find('input').val();

                casualties.push({ 
                    barangay: barangay, 
                    moi: moi,
                    ageBracket: ageBracket,
                    gender: gender,
                    count: count,
                });
            })

            //EVACUEES            
            var evacuees = [];
            $('#evacuees').find('tbody').find('tr').each(function(){
                var barangay = $(this).find('td').eq(0).find('select').val();
                var ageBracket = $(this).find('td').eq(1).find('select').val();
                var gender = $(this).find('td').eq(2).find('select').val();
                var count = $(this).find('td').eq(3).find('input').val();

                evacuees.push({ 
                    barangay: barangay, 
                    ageBracket: ageBracket,
                    gender: gender,
                    count: count,
                });
            })

            //Water Levels
            var waterLevels = [];
            $('#water_levels').find('tbody').find('tr').each(function(){
                var barangay = $(this).find('td').eq(0).find('select').val();
                var level = $(this).find('td').eq(1).find('input').val();

                waterLevels.push({ 
                    barangay: barangay, 
                    level: level
                });
            })

            //Electricity
            var electricity = [];
            $('#electricity').find('tbody').find('tr').each(function(){
                var barangay = $(this).find('td').eq(0).find('select').val();
                var status = $(this).find('td').eq(1).find('select').val();
                var date = $(this).find('td').eq(2).find('input.status_date').val();
                var time = $(this).find('td').eq(2).find('input.status_time').val();

                electricity.push({ 
                    barangay: barangay, 
                    status: status,
                    date: date,
                    time: time,
                });
            })

            //STRANDED
            var stranded = [];
            $('#stranded').find('tbody').find('tr').each(function(){
                var location = $(this).find('td').eq(0).find('select').val();
                var strandedType = $(this).find('td').eq(1).find('select').val();
                var count = $(this).find('td').eq(2).find('input').val();

                stranded.push({ 
                    location: location, 
                    strandedType: strandedType,
                    count: count
                });
            })

            //COMMUNICATION
            var communications = [];
            $('#communications').find('tbody').find('tr').each(function(){
                var telco = $(this).find('td').eq(0).find('select').val();
                var status = $(this).find('td').eq(1).find('select').val();
                var date = $(this).find('td').eq(2).find('input.telco_status_date').val();
                var time = $(this).find('td').eq(2).find('input.telco_status_time').val();

                communications.push({ 
                    telco: telco, 
                    status: status,
                    date: date,
                    time: time,
                });
            })

            var data = {
                setripHeaderId : <?php echo $id ?>,
                actionType : $('#action_type').val(),
                date: $('#date').val(), // Sitrep date,
                time: $('#time').val(), // Sitrep date,
                suspensions: schoolIds,
                landslides : $('#landslide_barangay').val(),
                floods : $('#flood_barangay').val(),
                bridges : bridges,
                roads : roads,
                damages : damages,
                casualties : casualties,
                evacuees : evacuees,
                waterLevels: waterLevels,
                electricity: electricity,
                stranded : stranded,
                communications : communications,
                preparedness_measures: $('#preparedness_measures').val()
            };
            console.log(data);
            // return;

            var msg = $('.error-message');
            if(confirm('Are all data correct?')) {
                $.ajax({
                    url : '<?php echo BASE_URL ?>/api/sitrep/dml-details.php',
                    type : 'post',
                    data : data,
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
            }
            return false;
        })
        $('#landslide_barangay').select2({
            dropdownParent: $('#modal-add'),
            allowClear: true
        })
        $('#landsline_no_reports').click(function(){
            console.log('Here');
            if($(this).is(":checked")) {
                $('#landslide_barangay').val(null).trigger('change');
            }
        })

        $('#flood_barangay').select2({
            dropdownParent: $('#modal-add'),
            allowClear: true
        })
        $('#flood_no_reports').click(function(){
            console.log('Here');
            if($(this).is(":checked")) {
                $('#flood_barangay').val(null).trigger('change');
            }
        })

        $('#preparedness_measures').summernote();
    })
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
        var sitrepNo = $(this).data('sitrep-no');

        if(confirm('Are you sure you want sitrep #: ' + sitrepNo + '?'))
        {
            $.ajax({
                url : '<?php echo BASE_URL ?>/api/sitrep/dml-details.php',
                type : 'post',
                data : { actionType : 'delete', 'id' : id },
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

    $(document).on('click', 'input#bridge_no_reports', function(){
        if($(this).is(":checked")) {
            $('#bridges').find('tbody').html('');
        }
    })
    
    $(document).on('change', 'select#bridge', function(){
        var brgyName = $(this).find(':selected').attr('data-brgy-name');
        $(this).parent().parent().find('td').eq(1).text(brgyName);
    })

    $(document).on('click', 'input#roads_no_reports', function(){
        if($(this).is(":checked")) {
            $('#roads').find('tbody').html('');
        }
    })

    $(document).on('click', 'input#damage_no_reports', function(){
        if($(this).is(":checked")) {
            $('#damages').find('tbody').html('');
        }
    })

    $(document).on('click', 'input#casualties_no_reports', function(){
        if($(this).is(":checked")) {
            $('#casualties').find('tbody').html('');
        }
    })

    $(document).on('click', 'input#evacuees_no_reports', function(){
        if($(this).is(":checked")) {
            $('#evacuees').find('tbody').html('');
        }
    })

    $(document).on('click', 'input#water_level_normal', function(){
        if($(this).is(":checked")) {
            $('#water_levels').find('tbody').html('');
        }
    })

    $(document).on('click', 'input#communication_no_reports', function(){
        if($(this).is(":checked")) {
            $('#communications').find('tbody').html('');
        }
    })

    $(document).on('click', 'input#stranded_no_reports', function(){
        if($(this).is(":checked")) {
            $('#stranded').find('tbody').html('');
        }
    })

    $(document).on('click', 'input#electricity_no_reports', function(){
        if($(this).is(":checked")) {
            $('#electricity').find('tbody').html('');
        }
    })
    

    function removeSchool(t) {
        $(t).parent().parent().remove();
    }

    function addBridges() {
        
        if($('#bridge_no_reports').is(":checked")) {
            return;
        }

        var table = $('#bridges');
        var select = '<select  id="bridge" name="bridge[]">';
            select += '<option value="">Select</option>';
            <?php foreach($resBridges as $bridge): ?>
                select += '<option value="<?php echo $bridge['id'] ?>" data-brgy-name="<?php echo $bridge['brgyDesc'] ?>">';
                select += '<?php echo $bridge['name'] ?>';
                select += '</option>'
            <?php endforeach; ?>
            select += '</select>';

        var tr = '<tr>';
            tr += '<td>' + select + '</td>';
            tr += '<td></td>';
            tr += '<td>' + '<input type="text" class="remarks[]" /></td>';
            tr += '<td class="text-center"><icon role="button" onclick="removeSchool(this)">x</icon></td>';
            tr += '</tr>';

        table.append(tr);
    }

    function addRoads() {
        
        if($('#roads_no_reports').is(":checked")) {
            return;
        }

        var table = $('#roads');
        var select = '<select  id="road" name="road[]">';
            select += '<option value="">Select</option>';
            <?php foreach($resRoads as $road): ?>
                select += '<option value="<?php echo $road['id'] ?>">';
                select += '<?php echo $road['name'] ?>';
                select += '</option>';
            <?php endforeach; ?>
            select += '</select>';

        var tr = '<tr>';
            tr += '<td>' + select + '</td>';
            tr += '<td>' + '<input type="text" class="road_remarks[]" /></td>';
            tr += '<td class="text-center"><icon role="button" onclick="removeSchool(this)">x</icon></td>';
            tr += '</tr>';

        table.append(tr);
    }

    function addDamages() {
        
        if($('#damage_no_reports').is(":checked")) {
            return;
        }

        var table = $('#damages');
        var select = '<select  id="damages_barangay" name="damages_barangay[]">';
            select += '<option value="">Select</option>';
            <?php foreach($resBarangays as $barangay): ?>
                select += '<option value="<?php echo $barangay['id'] ?>">';
                select += '<?php echo $barangay['brgyDesc'] ?>';
                select += '</option>';
            <?php endforeach; ?>
            select += '</select>';

        var faciTypes = '<select  id="facility_types" name="facility_types[]">';
            faciTypes += '<option value="">Select</option>';
            <?php foreach($resFacilityTypes as $faciType): ?>
                faciTypes += '<option value="<?php echo $faciType['id'] ?>">';
                faciTypes += '<?php echo $faciType['name'] ?>';
                faciTypes += '</option>';
            <?php endforeach; ?>
            faciTypes += '</select>';
        
        
        var damageTypes = '<select  id="damage_type" name="damage_type[]">';
            damageTypes += '<option value="">Select</option>';
            damageTypes += '<option value="P">Partially</option>';
            damageTypes += '<option value="T">Totally</option>';
            damageTypes += '</select>';
        
        var tr = '<tr>';
            tr += '<td>' + select + '</td>';
            tr += '<td>' + faciTypes + '</td>';
            tr += '<td>' + '<input type="number" class="damage_count" /></td>';
            tr += '<td>' + damageTypes +'</td>';
            tr += '<td class="text-center"><icon role="button" onclick="removeSchool(this)">x</icon></td>';
            tr += '</tr>';

        table.append(tr);
    }

    function addCasualties() {
        
        if($('#casualties_no_reports').is(":checked")) {
            return;
        }

        var table = $('#casualties');
        var select = '<select  id="casualties_barangay" name="casualties_barangay">';
            select += '<option value="">Select</option>';
            <?php foreach($resBarangays as $barangay): ?>
                select += '<option value="<?php echo $barangay['id'] ?>">';
                select += '<?php echo $barangay['brgyDesc'] ?>';
                select += '</option>';
            <?php endforeach; ?>
            select += '</select>';

        var moi = '<select  id="moi" name="moi">';
            moi += '<option value="">Select</option>';
            <?php foreach($resMechanismOfInjuries as $moi): ?>
                moi += '<option value="<?php echo $moi['id'] ?>">';
                moi += '<?php echo $moi['name'] ?>';
                moi += '</option>';
            <?php endforeach; ?>
            moi += '</select>';
        
        var ageBrackets = '<select  id="age_bracket" name="age_bracket">';
            ageBrackets += '<option value="">Select</option>';
            <?php foreach($ageBrackets as $ageBracket): ?>
                ageBrackets += '<option value="<?php echo $ageBracket['id'] ?>">';
                ageBrackets += '<?php echo $ageBracket['age_from'] . ' - ' . $ageBracket['age_to'] ?>';
                ageBrackets += '</option>';
            <?php endforeach; ?>
            ageBrackets += '</select>';
            
        
        var gender = '<select  id="gender" name="gender">';
            gender += '<option value="">Select</option>';
            gender += '<option value="M">Male</option>';
            gender += '<option value="F">Female</option>';
            gender += '<option value="L">LGBTQIA+</option>';
            gender += '</select>';
        
        var tr = '<tr>';
            tr += '<td>' + select + '</td>';
            tr += '<td>' + moi + '</td>';
            tr += '<td>' + ageBrackets + '</td>';
            tr += '<td>' + gender +'</td>';
            tr += '<td>' + '<input type="number" class="casualty_count" /></td>';
            tr += '<td class="text-center"><icon role="button" onclick="removeSchool(this)">x</icon></td>';
            tr += '</tr>';

        table.append(tr);
    }

    function addEvacuees() {
        
        if($('#evacuees_no_reports').is(":checked")) {
            return;
        }

        var table = $('#evacuees');
        var select = '<select  id="evacuees_barangay" name="evacuees_barangay">';
            select += '<option value="">Select</option>';
            <?php foreach($resBarangays as $barangay): ?>
                select += '<option value="<?php echo $barangay['id'] ?>">';
                select += '<?php echo $barangay['brgyDesc'] ?>';
                select += '</option>';
            <?php endforeach; ?>
            select += '</select>';
        
        var ageBrackets = '<select  id="moi" name="moi">';
            ageBrackets += '<option value="">Select</option>';
            <?php foreach($ageBrackets as $ageBracket): ?>
                ageBrackets += '<option value="<?php echo $ageBracket['id'] ?>">';
                ageBrackets += '<?php echo $ageBracket['age_from'] . ' - ' . $ageBracket['age_to'] ?>';
                ageBrackets += '</option>';
            <?php endforeach; ?>
            ageBrackets += '</select>';
            
        
        var gender = '<select  id="gender" name="gender">';
            gender += '<option value="">Select</option>';
            gender += '<option value="M">Male</option>';
            gender += '<option value="F">Female</option>';
            gender += '<option value="L">LGBTQIA+</option>';
            gender += '</select>';
        
        var tr = '<tr>';
            tr += '<td>' + select + '</td>';
            tr += '<td>' + ageBrackets + '</td>';
            tr += '<td>' + gender +'</td>';
            tr += '<td>' + '<input type="number" class="evacuees_count" /></td>';
            tr += '<td class="text-center"><icon role="button" onclick="removeSchool(this)">x</icon></td>';
            tr += '</tr>';

        table.append(tr);
    }

    function addWaterLevel() {
        
        if($('#water_level_normal').is(":checked")) {
            return;
        }

        var table = $('#water_levels');
        var select = '<select  id="water_level_barangay" name="water_level_barangay">';
            select += '<option value="">Select</option>';
            <?php foreach($resBarangays as $barangay): ?>
                select += '<option value="<?php echo $barangay['id'] ?>">';
                select += '<?php echo $barangay['brgyDesc'] ?>';
                select += '</option>';
            <?php endforeach; ?>
            select += '</select>';
        
        var tr = '<tr>';
            tr += '<td>' + select + '</td>';
            tr += '<td>' + '<input type="number" class="water_level_count" /></td>';
            tr += '<td class="text-center"><icon role="button" onclick="removeSchool(this)">x</icon></td>';
            tr += '</tr>';

        table.append(tr);
    }

    function addCommunication() {
        
        if($('#communication_no_reports').is(":checked")) {
            return;
        }

        var table = $('#communications');
        var select = '<select  id="telco" name="telco">';
            select += '<option value="">Select</option>';
            <?php foreach($resTelco as $tel): ?>
                select += '<option value="<?php echo $tel['id'] ?>">';
                select += '<?php echo $tel['name'] ?>';
                select += '</option>';
            <?php endforeach; ?>
            select += '</select>';

        var telcoStatus = '<select  id="gender" name="gender">';
            telcoStatus += '<option value="">Select</option>';
            telcoStatus += '<option value="N">No Service</option>';
            telcoStatus += '<option value="R">Restored</option>';
            telcoStatus += '</select>';
        
        var tr = '<tr>';
            tr += '<td>' + select + '</td>';
            tr += '<td>' + telcoStatus + '</td>';
            tr += '<td>' + '<input type="date" class="telco_status_date" /><input type="time" class="telco_status_time" /></td>';
            tr += '<td class="text-center"><icon role="button" onclick="removeSchool(this)">x</icon></td>';
            tr += '</tr>';

        table.append(tr);
    }

    function addStranded() {
        
        if($('#stranded_no_reports').is(":checked")) {
            return;
        }

        var table = $('#stranded');
        var select = '<select  id="stranded_location" name="stranded_location">';
            select += '<option value="">Select</option>';
            select += '<option value="T">Bus Terminal</option>';
            select += '<option value="W">WHARF</option>';
            select += '</select>';

        var strandedType = '<select  id="stranded_type" name="stranded_type">';
            strandedType += '<option value="">Select</option>';
            strandedType += '<option value="T">Tourist</option>';
            strandedType += '<option value="L">Local</option>';
            strandedType += '</select>';
        
        var tr = '<tr>';
            tr += '<td>' + select + '</td>';
            tr += '<td>' + strandedType + '</td>';
            tr += '<td>' + '<input type="number" class="stranded_count" /></td>';
            tr += '<td class="text-center"><icon role="button" onclick="removeSchool(this)">x</icon></td>';
            tr += '</tr>';

        table.append(tr);
    }

    function addElectricity() {
        
        if($('#electricity_no_reports').is(":checked")) {
            return;
        }

        var table = $('#electricity');
        var select = '<select  id="electricity_barangay" name="electricity_barangay">';
            select += '<option value="">Select</option>';
            <?php foreach($resBarangays as $barangay): ?>
                select += '<option value="<?php echo $barangay['id'] ?>">';
                select += '<?php echo $barangay['brgyDesc'] ?>';
                select += '</option>';
            <?php endforeach; ?>
            select += '</select>';

        var status = '<select  id="electricity_status" name="electricity_status">';
            status += '<option value="">Select</option>';
            status += '<option value="O">Power Outage</option>';
            status += '<option value="R">Restored</option>';
            status += '</select>';
        
        var tr = '<tr>';
            tr += '<td>' + select + '</td>';
            tr += '<td>' + status + '</td>';
            tr += '<td>' + '<input type="date" class="status_date" /><input type="time" class="status_time" /></td>';
            tr += '<td class="text-center"><icon role="button" onclick="removeSchool(this)">x</icon></td>';
            tr += '</tr>';

        table.append(tr);
    }
    
</script>