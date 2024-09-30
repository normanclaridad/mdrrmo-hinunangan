<?php
require ('../../models/Schools.php');
require ('../../inc/Helpers.php');

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    echo json_encode(['code' => 4, 'message' => 'You are not authorized to access this page']);
    return;
}

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$schools = new Schools();

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

$whereCondition = " AND status != 'D' ";
if( !empty($params['search']['value']) ) {
    $whereCondition .= " AND ";
    $whereCondition .= " ( name LIKE '%". $params['search']['value'] ."%')";

    $urlFormer .= '&search_value=' . $params['search']['value'];
}
$sortBy = 's.id DESC';

if(isset($params['order'])) {
    $sortBy = $columns[$params['order'][0]['column']]."   ". $params['order'][0]['dir'];
    $urlFormer .= '&sort_by=' . $columns[$params['order'][0]['column']];
    $urlFormer .= '&sort_type=' . $params['order'][0]['dir'];
}

$start  = $params['start'];
$length = $params['length'];

//Get total
$totalRecords = $schools->getTotal($whereCondition, $sortBy);

//Get all tsag
$resResults = $schools->getJoinWhere($whereCondition, $sortBy, $start, $length);
$data = [];
foreach($resResults AS $row) {
    $encryptedId = $helpers->encryptDecrypt($row['id']);
    $addressName = $row['brgyDesc'] . ' ~ ' . ucwords(strtolower($row['citymunDesc'])) . ' ~ ' . ucwords(strtolower($row['provDesc']));
    $action = '<a class="btn btn-sm btn-edit" data-id="'. $row['id'] .'" data-name="'. $row['name'] .'" data-barangay-id="'. $row['barangay_id'] .'" data-address="' . $addressName .'" data-status="' . $row['status'] . '" data-type="' . $row['type'] . '"><i class="fa fa-edit"></i></a>';
    $action .= '&nbsp; <a class="btn btn-sm btn-delete" data-id="'. $row['id'] .'" data-name="'. $row['name'] . '" data-status="' . $row['status'] . '"><i class="fa fa-trash"></i></a>';
    $status = '<i class = "fa fa-times"></i>';
    if ($row['status'] == 'Y'){
        $status = '<i class = "fa fa-check"></i>';
    }
    $schoolType = ['P' => 'Primary', 'S' => 'Secondary', 'T' => 'Tertiary', 'I' => 'Integrated'];
    $data[] = [
        $row['name'],
        $row['brgyDesc'],
        ucwords(strtolower($row['citymunDesc'])),
        $schoolType[$row['type']],
        $status,
        date('M d, Y h:i a', strtotime($row['created_at'])),
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