<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../database.php';
include_once '../../queries/short.php';

$database = new Database();
$db = $database->getConnection();

$item = new Short($db);
$item->id = isset($_GET['id']) ? $_GET['id'] : die();
$item->getSingleShort();

if ($item->name != null) {
    
    // create array
    $emp_arr = array(
        "id" => $item->id,
        "name" => $item->name,
        "duration" => $item->duration,
        "views_number" => $item->views_number,
        "date_publication" => $item->date_publication,
        "image" => $item->image
    );

    http_response_code(200);
    echo json_encode($emp_arr);
} else {
    http_response_code(404);
    echo json_encode("Short not found.");
}
