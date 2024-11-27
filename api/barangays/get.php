<?php
require ('../../models/Barangays.php');
require ('../../inc/Helpers.php');

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    echo json_encode(['code' => 4, 'message' => 'You are not authorized to access this page']);
    return;
}

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$barangays = new Barangays();

//Helpers
$helpers = new Helpers();

$search = isset($_GET['search']) ? $_GET['search'] : '';

if(strlen($search) < 4) {
    echo json_encode(['items' => []]);
    return;
}

// $whereCondition = "(b.brgyDesc LIKE '%". $search ."%' OR cm.cityMunDesc LIKE '%". $search ."%' OR p.provDesc LIKE '%". $search ."%')";
// $whereCondition = "(b.brgyDesc LIKE '". $search ."%')";
$whereCondition = "CONCAT(b.brgyDesc, ' ', cm.citymunDesc, ' ', p.provDesc) LIKE '$search%'";
if(!empty($_SESSION['SESS_CITY_MUN'])) {
    $whereCondition .= " AND b.citymunCode = 086403";
}

$resResults = $barangays->getJoinWhere($whereCondition);

$data = [];
foreach($resResults AS $row) {
    $data[] = [
        'id' => $row['id'],
        'text' => $row['brgyDesc'] . ' ~ ' . ucwords(strtolower($row['citymunDesc']))  . ' ~ ' . ucwords(strtolower($row['provDesc']))
    ];
}

echo json_encode(['items' => $data]);
return;