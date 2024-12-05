<?php
session_start();

require ('../../models/Sitrep_details.php');
require ('../../models/Suspensions.php');
require ('../../models/Landslides.php');
require ('../../models/Floods.php');
require ('../../models/Sitrep_bridges.php');
require ('../../models/Sitrep_roads.php');
require ('../../models/Damages.php');
require ('../../models/Casualties.php');
require ('../../models/Evacuees.php');
require ('../../models/Water_levels.php');
require ('../../models/Electricity.php');
require ('../../models/Stranded.php');
require ('../../models/Communication.php');
require ('../../models/Preparedness_measures.php');

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    echo json_encode(['code' => 4, 'message' => 'You are not authorized to access this page']);
    return;
}

$sitrepDetails = new Sitrep_details();
$dbSuspensions = new Suspensions();
$dbLandslides = new Landslides();
$dbFloods = new Floods();
$sitrepBridges = new Sitrep_bridges();
$sitrepRoads = new Sitrep_roads();
$dbDamages = new Damages();
$dbCasualties = new Casualties();
$dbEvacuees = new Evacuees();
$dbWaterLevels = new Water_levels();
$dbElectricity = new Electricity();
$dbStranded = new Stranded();
$dbCommunication = new Communication();
$dbPreparednessMeasures = new Preparedness_measures();

$id = isset($_POST['id']) ? $_POST['id'] : ''; 
$setripHeaderId = isset($_POST['setripHeaderId']) ? $_POST['setripHeaderId'] : '';
$actionType = isset($_POST['actionType']) ? $_POST['actionType']: 'add'; 
$date = isset($_POST['date']) ? $_POST['date']: '';
$time = isset($_POST['time']) ? $_POST['time']: '';
$suspensions = isset($_POST['suspensions']) ? $_POST['suspensions']: '';
$landslides = isset($_POST['landslides']) ? $_POST['landslides']: '';
$floods = isset($_POST['floods']) ? $_POST['floods']: '';
$bridges = isset($_POST['bridges']) ? $_POST['bridges']: '';
$roads = isset($_POST['roads']) ? $_POST['roads']: '';
$damages = isset($_POST['damages']) ? $_POST['damages']: '';
$casualties = isset($_POST['casualties']) ? $_POST['casualties']: '';
$evacuees = isset($_POST['evacuees']) ? $_POST['evacuees']: '';
$waterLevels = isset($_POST['waterLevels']) ? $_POST['waterLevels']: '';
$electricity = isset($_POST['electricity']) ? $_POST['electricity']: '';
$stranded = isset($_POST['stranded']) ? $_POST['stranded']: '';
$communications = isset($_POST['communications']) ? $_POST['communications']: '';
$preparednessMeasures = isset($_POST['preparedness_measures']) ? $_POST['preparedness_measures']: '';
$userId = $_SESSION['SESS_ID'];
$dateTime = date('Y-m-d H:i:s');

// Check which sitrep number
$sitrepNo = $sitrepDetails->getSitrepNo();

$data = [    
    'sitrep_datetime' => date("Y-m-d H:i:s", strtotime($date . ' ' . $time)),
    'updated_by' => $userId,
    'updated_at' => $dateTime,
];

if($actionType == 'add') {
    $data = array_merge($data, [
                            'sitrep_no' => $sitrepNo,
                            'sitrep_header_id' => $setripHeaderId,
                            'created_at' => $dateTime,
                            'created_by' => $userId
                        ]
                    );
    $resResult = $sitrepDetails->insertData($data);
    $sitrepDetailId = $resResult;
} else if($actionType == 'update') {
    $resResult = $sitrepDetails->updateData($data, " id = $id");
    $sitrepDetailId = $id;
} else if($actionType == 'delete') {
    $data = [    
        'status' => 'D',
        'updated_by' => $userId,
        'updated_at' => $dateTime,
    ];

    $resResult = $sitrepDetails->updateData($data, " id = $id");
    echo json_encode(['code' => 0, 'message' => 'Record has been successully deleted']);
    return;
}

// $resResult = 1;
if(!$resResult){
    echo json_encode(['code' => 1, 'message' => 'Internal error. Please contact administrator.']);
    return;
}

//Insert suspension
if(!empty($suspensions)) {
    
    //Delete records first then add the new records
    $susPend = $dbSuspensions->deleteAll(" sitrep_detail_id = $sitrepDetailId AND sitrep_header_id = $setripHeaderId");

    foreach($suspensions as $suspension) {
        $suspensionData = [
            'school_id' => $suspension,
            'sitrep_detail_id' => $sitrepDetailId,
            'sitrep_header_id' => $setripHeaderId,
            'created_by' => $userId,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $resSuspensions = $dbSuspensions->insertData($suspensionData);
    }
}

// Landslides
if(!empty($landslides)) {
    
    //Delete records first then add the new records
    $dbLandslides->deleteAll(" sitrep_detail_id = $sitrepDetailId AND sitrep_header_id = $setripHeaderId");

    foreach($landslides as $landslide) {
        $landslideData = [
            'barangay_id' => $landslide,
            'sitrep_detail_id' => $sitrepDetailId,
            'sitrep_header_id' => $setripHeaderId,
            'created_by' => $userId,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $resLandslideData = $dbLandslides->insertData($landslideData);
    }
}

// Floods
if(!empty($floods)) {
    
    //Delete records first then add the new records
    $dbFloods->deleteAll(" sitrep_detail_id = $sitrepDetailId AND sitrep_header_id = $setripHeaderId");

    foreach($floods as $flood) {
        $floodData = [
            'barangay_id' => $flood,
            'sitrep_detail_id' => $sitrepDetailId,
            'sitrep_header_id' => $setripHeaderId,
            'created_by' => $userId,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $resFloods = $dbFloods->insertData($floodData);
    }
}

// Bridges
if(!empty($bridges)) {

    //Delete records first then add the new records
    $sitrepBridges->deleteAll(" sitrep_detail_id = $sitrepDetailId AND sitrep_header_id = $setripHeaderId");

    foreach($bridges as $bridge) {
        $bridgeData = [
            'bridge_id' => $bridge['bridge'],
            'remarks' => $bridge['remarks'],
            'sitrep_detail_id' => $sitrepDetailId,
            'sitrep_header_id' => $setripHeaderId,
            'created_by' => $userId,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $resSitrepBridges = $sitrepBridges->insertData($bridgeData);
    }
}

// Roads
if(!empty($roads)) {

    //Delete records first then add the new records
    $sitrepRoads->deleteAll(" sitrep_detail_id = $sitrepDetailId AND sitrep_header_id = $setripHeaderId");

    foreach($roads as $road) {
        $roadData = [
            'road_id' => $road['road'],
            'remarks' => $road['remarks'],
            'sitrep_detail_id' => $sitrepDetailId,
            'sitrep_header_id' => $setripHeaderId,
            'created_by' => $userId,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $resSitrepRoads = $sitrepRoads->insertData($roadData);
    }
}

//Damages
if(!empty($damages)) {
    //Delete records first then add the new records
    $dbDamages->deleteAll(" sitrep_detail_id = $sitrepDetailId AND sitrep_header_id = $setripHeaderId");

    foreach($damages as $damage) {
        $damageData = [
            'baragay_id' => $damage['barangay'],
            'facility_type_id' => $damage['facilityType'],
            'damage_count' => $damage['count'],
            'damage_type' => $damage['damageType'], 
            'sitrep_detail_id' => $sitrepDetailId,
            'sitrep_header_id' => $setripHeaderId,
            'created_by' => $userId,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $resDamage = $dbDamages->insertData($damageData);
    }
}

//Casualties
if(!empty($casualties)) {
    //Delete records first then add the new records
    $dbCasualties->deleteAll(" sitrep_detail_id = $sitrepDetailId AND sitrep_header_id = $setripHeaderId");

    foreach($casualties as $casualty) {
        $casualtyData = [
            'baragay_id' => $casualty['barangay'],
            'moi_id' => $casualty['moi'],
            'age_bracket_id' => $casualty['ageBracket'],
            'gender' => $casualty['gender'],
            'count' => $casualty['count'], 
            'sitrep_detail_id' => $sitrepDetailId,
            'sitrep_header_id' => $setripHeaderId,
            'created_by' => $userId,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $resCasualties = $dbCasualties->insertData($casualtyData);
    }
}

//EVACUEES
if(!empty($evacuees)) {

    //Delete records first then add the new records
    $dbEvacuees->deleteAll(" sitrep_detail_id = $sitrepDetailId AND sitrep_header_id = $setripHeaderId");

    foreach($evacuees as $evacue) {
        $evacueData = [
            'baragay_id' => $evacue['barangay'],
            'age_bracket_id' => $evacue['ageBracket'],
            'gender' => $evacue['gender'],
            'count' => $evacue['count'], 
            'sitrep_detail_id' => $sitrepDetailId,
            'sitrep_header_id' => $setripHeaderId,
            'created_by' => $userId,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $resEvacuees = $dbEvacuees->insertData($evacueData);
    }
}

//Water_levels
if(!empty($waterLevels)) {
    
    //Delete records first then add the new records
    $dbWaterLevels->deleteAll(" sitrep_detail_id = $sitrepDetailId AND sitrep_header_id = $setripHeaderId");

    foreach($waterLevels as $waterLevel) {
        $waterLevelData = [
            'baragay_id' => $waterLevel['barangay'],
            'level' => $waterLevel['level'],
            'sitrep_detail_id' => $sitrepDetailId,
            'sitrep_header_id' => $setripHeaderId,
            'created_by' => $userId,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $resWaterLevels = $dbWaterLevels->insertData($waterLevelData);
    }
}

//Electricity
if(!empty($electricity)) {
    //Delete records first then add the new records
    $dbElectricity->deleteAll(" sitrep_detail_id = $sitrepDetailId AND sitrep_header_id = $setripHeaderId");

    foreach($electricity as $electric) {
        $electricData = [
            'baragay_id' => $electric['barangay'],
            'status' => $electric['status'],
            'date' => date('Y-m-d', strtotime($electric['date'])),
            'time' => date('H:i:s', strtotime($electric['time'])),
            'sitrep_detail_id' => $sitrepDetailId,
            'sitrep_header_id' => $setripHeaderId,
            'created_by' => $userId,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $resElectricity = $dbElectricity->insertData($electricData);
    }
}

//Stranded
if(!empty($stranded)) {
    //Delete records first then add the new records
    $dbStranded->deleteAll(" sitrep_detail_id = $sitrepDetailId AND sitrep_header_id = $setripHeaderId");

    foreach($stranded as $strand) {
        $strandedData = [
            'location' => $strand['location'],
            'type' => $strand['strandedType'],
            'count' => $strand['count'],
            'sitrep_detail_id' => $sitrepDetailId,
            'sitrep_header_id' => $setripHeaderId,
            'created_by' => $userId,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $resStranded = $dbStranded->insertData($strandedData);
    }
}

//Communication
if(!empty($communications)) {
    
    //Delete records first then add the new records
    $dbCommunication->deleteAll(" sitrep_detail_id = $sitrepDetailId AND sitrep_header_id = $setripHeaderId");

    foreach($communications as $com) {
        $comData = [
            'telco_id' => $com['telco'],
            'status' => $com['status'],
            'date' => date('Y-m-d', strtotime($com['date'])),
            'time' => date('H:i:s', strtotime($com['time'])),
            'sitrep_detail_id' => $sitrepDetailId,
            'sitrep_header_id' => $setripHeaderId,
            'created_by' => $userId,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $resCommunication = $dbCommunication->insertData($comData);
    }
}

// Preparedness Measures
if(!empty($preparednessMeasures)) {

    //Delete records first then add the new records
    $dbPreparednessMeasures->deleteAll(" sitrep_detail_id = $sitrepDetailId AND sitrep_header_id = $setripHeaderId");

    $preMeasuresData = [
        'sitrep_header_id' => $setripHeaderId,
        'sitrep_detail_id' => $sitrepDetailId,
        'content' => htmlentities($preparednessMeasures),       
        'updated_at' => $dateTime,
        'created_at' => $dateTime, 
        'created_by' => $userId
    ];

    $dbPreparednessMeasures->insertData($preMeasuresData);
}


$actionMessage = 'added';
if($actionType == 'update') {
    $actionMessage = 'updated';
} else if($actionType == 'delete') {
    $actionMessage = 'deleted';
} else if($actionType == 'reset') {
    $actionMessage = 'reseted';
}

echo json_encode(['code' => 0, 'message' => 'Record has been successully ' . $actionMessage]);
return;