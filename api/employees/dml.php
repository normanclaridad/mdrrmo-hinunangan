<?php
session_start();

require ('../../models/Employees.php');

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    echo json_encode(['code' => 4, 'message' => 'You are not authorized to access this page']);
    return;
}

$employees = new Employees();

$id = isset($_POST['id']) ? $_POST['id'] : ''; 
$actionType = isset($_POST['action_type']) ? $_POST['action_type']: ''; 
$firstName = isset($_POST['first_name']) ? $_POST['first_name']: '';
$middleName = isset($_POST['middle_name']) ? $_POST['middle_name']: '';
$lastName = isset($_POST['last_name']) ? $_POST['last_name']: '';
$userName = isset($_POST['username']) ? $_POST['username']: '';
$positionId = isset($_POST['position_id']) ? $_POST['position_id']: '';
$status = isset($_POST['status']) ? 'Y': 'N';
$userId = $_SESSION['SESS_ID'];
$dateTime = date('Y-m-d H:i:s');

$data = [
    'first_name' => $firstName,
    'middle_name' => $middleName,
    'last_name' => $lastName,
    'position_id' => $positionId,
    'status' => $status,
    'updated_by' => $userId,
    'updated_at' => $dateTime
];

if($actionType == 'add') {
    $data = array_merge($data, [
            'created_at' => $dateTime, 
            'created_by' => $userId
        ]
    ); 
} else if($actionType == 'delete') {
    $data = [
        'status' => 'D',        
        'updated_by' => $userId,
        'updated_at' => $dateTime
    ];
}

if(in_array($actionType, ['add', 'update'])) {
    
    $where = "AND first_name = '$firstName' AND last_name = '$lastName'";
    
    if($actionType == 'update') {
        $where .= " AND id != $id";
    }

    $checkUser = $employees->getWhere($where);

    if(!empty($checkUser)) {
        echo json_encode(['code' => 2, 'message' => "$firstName $lastName already exist in our database."]);
        return;
    }
}

//Add data
if($actionType == 'add') {
    $resUser = $employees->insertData($data);
} else {
    $where = " id = $id";
    $resUser = $employees->updateData($data, $where);
}

if(!$resUser) {
    echo json_encode(['code' => 1, 'message' => 'Internal error. Please contact administrator.']);
    return;
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