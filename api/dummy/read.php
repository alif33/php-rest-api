<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../database.php';
include_once '../../videos.php';
$database = new Database();

$db = $database->getConnection();
$items = new Video($db);
$records = $items->getVideos();
$itemCount = $records->num_rows;
echo json_encode($itemCount);
if ($itemCount > 0) {
    $employeeArr = array();
    $employeeArr["body"] = array();
    $employeeArr["itemCount"] = $itemCount;
    while ($row = $records->fetch_assoc()) {
        array_push($employeeArr["body"], $row);
    }
    http_response_code(200);
    echo json_encode($employeeArr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}
