<?php
require ('../../models/Workshops_trainings.php');
require ('../../inc/Helpers.php');

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    echo json_encode(['code' => 4, 'message' => 'You are not authorized to access this page']);
    return;
}

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$workshopsTrainings = new Workshops_trainings();

//Helpers
$helpers = new Helpers();

// $tsag       = isset($_POST['tsag']) ? $_POST['tsag'] : ''; 

$btnAction  = isset($_POST['action']) ? $_POST['action'] : '';

$params = $columns = $totalRecords = $data = [];
 
$params = $_REQUEST;
$urlFormer = '';

if(in_array($btnAction, ['excel', 'print'])) {
    $_SESSION['SESS_GEN_TOKEN'] = rand(10000, 10000000);

    $urlFormer = 'token='. $_SESSION['SESS_GEN_TOKEN'];
}

$columns = [
        'name',
        'status', 
        'created_at'
    ];

$whereCondition = $sqlTot = $sqlRec = '';

$whereCondition = " AND wt.status != 'D' ";
if( !empty($params['search']['value']) ) {
    $whereCondition .= " AND ";
    $whereCondition .= " ( name LIKE '%". $params['search']['value'] ."%')";

    $urlFormer .= '&search_value=' . $params['search']['value'];
}
$sortBy = 'wt.id DESC';

if(isset($params['order'])) {
    $sortBy = $columns[$params['order'][0]['column']]."   ". $params['order'][0]['dir'];
    $urlFormer .= '&sort_by=' . $columns[$params['order'][0]['column']];
    $urlFormer .= '&sort_type=' . $params['order'][0]['dir'];
}

$start  = $params['start'];
$length = $params['length'];

//Get total
$totalRecords = $workshopsTrainings->getTotal($whereCondition, $sortBy);

//Get all tsag
$resResults = $workshopsTrainings->getJoinWhere($whereCondition, $sortBy, $start, $length);
$data = [];
foreach($resResults AS $row) {
    
    $imagePath = $protocol . $_SERVER['HTTP_HOST'] . '/' . $row['file'];

    $encryptedId = $helpers->encryptDecrypt($row['id']);
    $action = '<a class="btn btn-sm btn-edit" data-id="'. $row['id'] .'" data-title="'. $row['title'] .'" data-conducted-attended="'. $row['conducted_attended'] .'" data-barangay-id="'. $row['barangay_id'] .'" data-employees="'. $row['employees'] .'" data-workshop-training-type-id="' . $row['workshop_training_type_id'] . '" data-source-id="' . $row['source_id'] . '" data-date="' . $row['date'] . '" data-file="' . $imagePath . '" data-status="' . $row['status'] . '"><i class="fa fa-edit"></i></a>';
    $action .= '&nbsp; <a class="btn btn-sm btn-delete" data-id="'. $row['id'] .'" data-title="'. $row['title'] . '" data-status="' . $row['status'] . '"><i class="fa fa-trash"></i></a>';
    $status = '<i class = "fa fa-times"></i>';
    
    if ($row['status'] == 'Y'){
        $status = '<i class = "fa fa-check"></i>';
    }

    $file = '<a href="'. $imagePath .'" target="_blank">' . $row['file_name'] . '</a>';
    $data[] = [
        $row['conduct_attend'],
        $row['title'],
        $row['source_name'],
        date('m/d/Y', strtotime($row['date'])),
        $row['workshop_training_type_name'],
        $file,
        $status,
        date('m/d/y h:i a', strtotime($row['created_at'])),
        $action,
    ];
}

$json_data = [
    "draw"            => intval( $params['draw'] ),   
    "recordsTotal"    => intval( $totalRecords ),  
    "recordsFiltered" => intval($totalRecords),
    "data"            => $data
];

echo json_encode($json_data);