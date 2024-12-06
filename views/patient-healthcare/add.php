<?php
include('../../inc/app_settings.php');
require_once('../../inc/helpers.php');
require ('../../models/Mechanism_of_injuries.php');
require ('../../models/Intervention_management.php');
require ('../../models/Nature_illness_medical.php');
require ('../../models/Nature_illness_trauma.php');


$helpers = new Helpers();
define('PAGE_TITLE', 'Patient Care Reports');

if(!$helpers->checkSession()) {
    $helpers->redirectLogin();
    return;
}

$moi = new Mechanism_of_injuries();
$interventionMgmnt = new Intervention_management();
$natureIllnessMedical = new Nature_illness_medical();
$natureIllnessTrauma = new Nature_illness_trauma();

$resMoi = $moi->getWhere("AND status = 'Y'");

$resInterventionMgmnt = $interventionMgmnt->getWhere("AND status = 'Y'");
$resNatureIllnessMedical = $natureIllnessMedical->getWhere("AND status = 'Y'");
$resNatureIllnessTrauma = $natureIllnessTrauma->getWhere("AND status = 'Y'");

include_once '../../templates/header.php';
include_once '../../templates/sidebar.php';
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
    table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
        }
        .title {
            text-align: center;
            font-weight: bold;
        }
        .section-title {
            font-weight: bold;
            background-color: #f0f0f0;
            margin-right: 90px;
        }
        .checkbox-inline {
            display: inline-block;
            margin-right: 10px;
        }
        .input-group {
            margin-bottom: 10px;
        }
        .input-group label {
            margin-right: 10px;
        }
        .intervention-mgmnt {
            display: block;
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
                    </h4>
                    <form method="post" id="frm-crud" data-parsley-validate="">
                        <table>
                            <!-- Section 1: Nature of Incident, Location, Date, etc. -->
                            <tr>
                                <td colspan="3" class="section-title">Nature of Incident</td>
                                <td colspan="2" class="section-title">Location</td>
                                <td colspan="2" class="section-title">Date</td>
                            </tr>
                            <tr>
                                <td colspan="2">Call Received</td>
                                <td colspan="1">
                                    <input type="checkbox" name="call_received" id="call_received" />
                                </td> 
                                <td colspan="2" rowspan="2">
                                    Patient Name: 
                                    <br>
                                    <input type="text" name="first_name" id="first_name" placeholder="First Name" style="width: 150px">
                                    <input type="text" name="middle_name" id="middle_name" placeholder="Middle Name" style="width: 110px">
                                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" style="width: 150px">
                                </td>        
                                <td colspan="1" rowspan="4" >
                                    Chief Complaint: <br>
                                    <textarea row="10" id="chief_complaint" name="chief_complaint" style="height: 150px; width: 100%;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Responded</td>
                                <td colspan="1" >
                                    <input type="checkbox" name="call_received" id="call_received">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Arrival at Scene</td>
                                <td>
                                    <input type="checkbox" name="arrival_scene" id="arrival_scene">
                                </td>
                                <td colspan="2" rowspan="2"> 
                                    <label for="barangay">Address: <small>(Type Atleast 4 characters)</small></label>
                                    <select name="barangay" id="barangay" style="width: 80%;" required>                                    
                                    </select>
                                    <br>
                                    Contact Number:
                                    <br>
                                    <input type="number" id="contact_number" name="contact_number" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Transported to Receiving Facility</td>
                                <td>
                                    <input type="checkbox" name="transported_receiving_faci" id="transported_receiving_faci">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Arrived at Receiving Facility</td>
                                <td>
                                    <input type="checkbox" name="arrived_receiving_faci" id="arrived_receiving_faci">
                                </td>
                                <td>Age : <input type="number" name="age" id="age" readonly style="width: 50px"></td>
                                <td>Religion : <br><input type="text" name="religion"></td>
                                <td> Sex : <br>
                                    <select name="sex">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">Back to Base</td>
                                <td><input type="checkbox" name="back_to_base"></td>
                                <td>Date of Birth : <br><input type="date" name="dob" id="dob"></td>
                                <td>Destination Hospital/Clinic : <input type="text" name="clinic" id="clinic"></td>
                                <td>Weight (kg) : <input type="text" name="weight" id="weight"></td>                                
                            </tr>
                            <tr>
                                <td colspan="2">In Quarters</td>
                                <td><input type="checkbox" name="in_quarters" id="in_quarters"></td>
                                <td colspan="4"></td>
                            </tr>
                        </table>

                        <!-- Section 2: Patient Assessment -->
                        <table>
                            <tr>
                                <th colspan="1"> TIME</th>
                                <th colspan="1"> NUERO </th>
                                <th colspan="1"> BP</th>
                                <th colspan="1"> PULSE</th>
                                <th colspan="1"> SPO2</t>
                                <th colspan="1"> RESPI</th>
                                <th colspan="1"> PATIENT ASSESSMENT</th>
                                <th colspan="1"> MECHANISM OF INJURY / MOI</th>
                            </tr>

                            <tr>
                            </tr>
                            <!-- Add fields for vital signs: BP, Pulse, SPO2, Respi, and Neuro -->
                            <tr>
                                <td ></td>
                                <th> <br><br>
                                    <strong>A</strong><br><br>
                                    <strong>V</strong><br><br>
                                    <strong>P</strong><br><br>
                                    <strong>U</strong><br>
                                </th>
                                <td></td>
                                <td><br><br>
                                    <label>
                                        <input type="radio" name="pulse" value="R"> Reg
                                    </label>
                                    <br><br><br>
                                    <label>
                                        <input type="radio" name="pulse" value="I"> Irreg
                                    </label>
                                    <br>
                                </td>
                                <td></td>
                                <td><br><br>
                                    <label>
                                        <input type="radio" name="respi" value="R"> Regular
                                    </label><br>
                                    <label>
                                        <input type="radio" name="respi" value="I"> Irregular
                                    </label><br>
                                    <label>
                                        <input type="radio" name="respi" value="L"> Labored
                                    </label>
                                </td>
                                <th><BR><br>
                                    <strong class="locba"> 
                                        LOSS OF CONCIOUSNESS
                                    </strong> 
                                    <br> 
                                    <strong class="locba"> 
                                        BEFORE ARRIVAL
                                    </strong>
                                    <br><br>
                                    <label>
                                        <input type="radio" name="loss_before_consciousness" value="R"> Reg 
                                    </label>
                                    <label>
                                        <input type="radio" name="loss_before_consciousness" value="I"> Irreg
                                    </label>
                                    <br><br><br>
                                    <p><strong>CONCIOUSNESS UPON ARRIVAL</strong></p>
                                    <label>
                                        <input type="checkbox" name="arrival_conciousness" value="Y" > Yes
                                    </label>
                                    <label>
                                        <input type="checkbox" name="arrival_conciousness" value="N"> No
                                    </label>
                                </th>
                                <td>
                                    <?php foreach($resMoi as $mo): ?>
                                        <label>
                                            <input type="checkbox" class="moi" name="moi[]" value="<?php echo $mo['id'] ?>">
                                            <?php echo $mo['name'] ?>
                                        </label><br>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                            
                        </table>

                        <!-- Section 3: Mechanism of Injury (MOI) -->
                        <table>
                            <tr>
                                <th> TYPES OF TRANSPORT</th>
                                <th> AID PRIOR TO ARRIVAL</th>
                                <th colspan="2"> NATURE OF ILLNESS</th>
                                <th> INTERVENTION/MANAGEMENT</th>
                            </tr>
                            <tr>
                                <td rowspan="2">
                                    <br>
                                    <label>
                                        <input type="radio" name="transport_type" value="E"> Emergency Call
                                    </label><br><br>
                                    <label>
                                        <input type="radio" name="transport_type" value="H"> Hospital Transfer
                                    </label>
                                </td>
                                <tr>
                                    <td colspan="1"><br>
                                        <label>
                                            <input type="radio" name="aid_prior_arrival" value="N"> None
                                        </label><br><br>
                                        <label>
                                            <input type="radio" name="aid_prior_arrival" value="Y">Yes, CPR Only
                                        </label><br><br>
                                        <label>
                                            <input type="radio" name="aid_prior_arrival" value="O"> Yes, Other 
                                        </label><br><br>
                                    </td>
                                    <td rowspan="1" style="text-align: center">
                                        <label>
                                            <input type="radio" name="nature_illness" value="M"> MEDICAL
                                        </label>
                                    </td>
                                    <td rowspan="1" style="text-align: center">
                                        <label>
                                            <input type="checkbox" name="nature_illness" value="T"> TRAUMA
                                        </label>
                                    </td>
                                    <td rowspan="2" colspan="3">
                                        <?php foreach($resInterventionMgmnt as $inter) : ?>
                                            <label class="intervention-mgmnt">
                                                <input type="checkbox" value="<?php echo $inter['id'] ?>" name="intervention_management[]">                                                
                                                <?php echo $inter['name'] ?>
                                            </label>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                                <tr>
                                <td><br>  &emsp; Passengers<br><br>
                                    <label>
                                        <input type="checkbox" name="passengers[]" value="M"> M.D
                                    </label>
                                    <br>
                                    <label>
                                        <input type="checkbox" name="passengers[]" value="R"> Responder
                                    </label>
                                    <br>
                                    <label>
                                        <input type="checkbox" name="passengers[]" value="L"> Relative
                                    </label>                                    
                                </td>
                                <td><br>  &emsp; Vehicular Extrication Required<br><br>
                                    <label>
                                        <input type="radio" name="vehicular_extrication" value="Y"> Yes
                                    </label>
                                    <br>
                                    <label>
                                        <input type="radio" name="vehicular_extrication"> No
                                    </label>
                                    <br>
                                </td>                                
                                <td rowspan="1"><br>
                                    <?php foreach($resNatureIllnessMedical as $natM): ?>
                                        <label>
                                            <input type="checkbox" name="natureIllnessMedical[]" value="<?php echo $natM ?>"> 
                                            <?php echo $natM['name'] ?>
                                        </label><br>
                                    <?php endforeach; ?>
                                </td>
                                <td rowspan="1"><br>
                                    <?php foreach($resNatureIllnessTrauma as $natT): ?>
                                        <label>
                                            <input type="checkbox" name="natureIllnessTrauma[]" value="<?php echo $natL ?>">
                                            <?php echo $natT['name'] ?>
                                        </label><br>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        </table>

                        <!-- Section 4: History Taking -->
                        <table>
                            <tr>
                                <th colspan="2" class="section-title">History Taking </th>
                                <td colspan="9" class="section-title"> Physical Examinations  &emsp;&emsp; &emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</td>
                            </tr>
                            <td colspan="1">
                                Signs/Symptoms <br><textarea rows="5" ></textarea><br><br>
                                Allergies <br><textarea rows="4" ></textarea> <br><br>
                                Medications <br><textarea rows="4" ></textarea> <br><br>
                                Past Medical History <br><textarea rows="4" ></textarea> <br><br>
                                Last Oral Intake <br><textarea rows="4" ></textarea> <br><br>
                                Event Leading to Injury<br> or Illness <br> <textarea rows="4" ></textarea> <br><br>
                            </td>
                            <td colspan="1">
                                Onset Pain <br><textarea rows="5" ></textarea><br><br>
                                Provoking Factor <br><textarea rows="4" ></textarea> <br><br>
                                Quality of Pain <br><textarea rows="4" ></textarea> <br><br>
                                Radiation of Pain <br><textarea rows="4" ></textarea> <br><br>
                                Severity of Pain <br><textarea rows="4" ></textarea> <br><br>
                                Time <br> <textarea rows="4" ></textarea> <br><br>
                            </td>

                            <td colspan="1"><br><br><br><br><br><br> LEGEND :<br><br>
                                <strong>D - </strong> Deformity<br>
                                <strong>C - </strong> Contusion<br>
                                <strong>A - </strong> Abrasion<br>
                                <strong>P - </strong> Puncture<br>
                                <strong>B - </strong> Burn<br>
                                <strong>T - </strong> Tenderness<br>
                                <strong>L - </strong> Laceration<br>
                                <strong>S - </strong> Swelling<br>
                            </td>
                        </table>

                        <!-- Section 5: Outcome -->
                        <table>
                            <tr>
                                <td name="remarks" colspan="6"><strong>Remarks:</strong><br><br><textarea rows="4"></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="6"><strong>Outcome: </strong><br><br>
                                <input type="checkbox" name="none">Admitted To 
                                <input type="text" name="admitted_to"><br><br>
                                <input type="checkbox" name="none">Transferred To 
                                <input type="text" name="admitted_to"><br><br>
                                <input type="checkbox" name="none">D.O.A 
                                </td>
                            </tr>

                        </table>
                    </form>
                </div>
            </div>
        </div>      
<?php
    include_once '../../templates/footer.php';
?>
<script>
    $(document).ready(function(){       

        $('#btn-save').click(function(){

            if(!$('form#frm-crud').parsley().validate()) {
                return;
            }

            var msg = $('.error-message');
            $.ajax({
                url : '<?php echo BASE_URL ?>/api/sitrep/dml.php',
                type : 'post',
                data : $('#frm-crud').serialize(),
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

        $('#barangay').select2({
            ajax: {
                url: '<?php echo BASE_URL ?>/api/barangays/get.php',
                dataType: 'json',
                data: function (params) {
                    var query = {
                        search: params.term,
                        type: 'public'
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.items
                    };
                }
            }
        });
    });
    
</script>