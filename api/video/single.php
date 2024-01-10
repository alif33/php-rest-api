<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../database.php';
include_once '../../queries/video.php';
$database = new Database();
$db = $database->getConnection();
$item = new Video($db);
$item->id = isset($_GET['id']) ? $_GET['id'] : die();
$item->getSingleVideo();
if ($item->name != null) {
    
    // create array
    $emp_arr = array(
        "id" => $item->id,
        "name" => $item->name,
        "description" => $item->description,
        "code" => $item->code,
        "categories" => $item->categories,
        "date_publication" => $item->date_publication,
        "duration" => $item->duration,
        "views_number" => $item->views_number,
        "score" => $item->score,
        "subtitle" => $item->subtitle,
    );

    http_response_code(200);
    echo json_encode($emp_arr);
} else {
    http_response_code(404);
    echo json_encode("Employee not found.");
}
