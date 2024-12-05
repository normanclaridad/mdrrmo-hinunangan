<?php
session_start();
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT']);
require ('../../models/Official_issuances.php');

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    echo json_encode(['code' => 4, 'message' => 'You are not authorized to access this page']);
    return;
}

$path = 'uploads/official-issuances/';

$officialIssuances = new Official_issuances();

$id = isset($_POST['id']) ? $_POST['id'] : ''; 
$actionType = isset($_POST['action_type']) ? $_POST['action_type']: ''; 
$title = isset($_POST['title']) ? $_POST['title']: '';
$source = isset($_POST['source']) ? $_POST['source']: '';
$date = isset($_POST['date']) ? $_POST['date']: '';
$issuanceType = isset($_POST['issuanceType']) ? $_POST['issuanceType']: '';
$status = isset($_POST['status']) ? 'Y': 'N';
$userId = $_SESSION['SESS_ID'];
$dateTime = date('Y-m-d H:i:s');
$validExtensions = array('jpeg', 'jpg', 'png', 'pdf', 'doc');

if(!empty($_FILES)) {
    $img = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    $finalImage = rand(1000,1000000).$img;
    
    // check's valid format
    if(!in_array($ext, $validExtensions)) { 
        echo json_encode(['code' => 3, 'message' => 'Invalid file extention. This system will accept jpeg, jpg, png, pdf and doc file extention']);
        return;
    }
    
    $path = $path.strtolower($finalImage); 
    
    if(!move_uploaded_file($tmp, SERVER_PATH . '/' .$path)) {
        echo json_encode(['code' => 2, 'message' => 'Unable to upload file. Please contact administrator.']);
        return;
    }
}

$data = [
    'source_id' => $source,
    'date' => date('Y-m-d', strtotime($date)),
    'title' => $title,
    'issuance_type_id' => $issuanceType,
    
    'status' => $status,
    'updated_by' => $userId,
    'updated_at' => $dateTime
];

if(!empty($_FILES)) {
    $data = array_merge($data, [
        'file' => $path,
        'file_name' => $img,
    ]);
}

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
    $where = "AND title = '". $title ."'";
    if($actionType == 'update') {
        $where .= " AND id != $id";
    }

    $checkModule = $officialIssuances->getWhere($where);

    if(!empty($checkModule)) {
        echo json_encode(['code' => 2, 'message' => "Module $name already exist in our database."]);
        return;
    }
}

//Add data
if($actionType == 'add') {
    $resUser = $officialIssuances->insertData($data);
} else {
    $where = " id = $id";
    $resUser = $officialIssuances->updateData($data, $where);
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