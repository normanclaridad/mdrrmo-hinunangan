<?php
session_start();

require ('../../models/Age_brackets.php');

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    echo json_encode(['code' => 4, 'message' => 'You are not authorized to access this page']);
    return;
}

$ageBrackets = new Age_brackets();

$id = isset($_POST['id']) ? $_POST['id'] : ''; 
$actionType = isset($_POST['action_type']) ? $_POST['action_type']: ''; 
$from = isset($_POST['from']) ? $_POST['from']: '';
$to = isset($_POST['to']) ? $_POST['to']: '';
$status = isset($_POST['status']) ? 'Y': 'N';
$userId = $_SESSION['SESS_ID'];
$dateTime = date('Y-m-d H:i:s');

$data = [
    'age_from' => $from,
    'age_to' => $to,
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
    $where = "AND age_from = '". $from ."'";
    $where .= "AND age_to = '". $to ."'";
    if($actionType == 'update') {
        $where .= " AND id != $id";
    }

    $checkModule = $ageBrackets->getWhere($where);

    if(!empty($checkModule)) {
        echo json_encode(['code' => 2, 'message' => "$from to $to already exist in our database."]);
        return;
    }
}

//Add data
if($actionType == 'add') {
    $resUser = $ageBrackets->insertData($data);
} else {
    $where = " id = $id";
    $resUser = $ageBrackets->updateData($data, $where);
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