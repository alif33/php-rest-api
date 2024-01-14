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
$item->name = $_GET['name'];
$item->description = $_GET['description'];
$item->code = $_GET['code'];
$item->categories = $_GET['categories'];
$item->date_publication = $_GET['date_publication'];
$item->duration = $_GET['duration'];
$item->views_number = $_GET['views_number'];
$item->score = $_GET['score'];
$item->subtitle = $_GET['subtitle'];

if ($item->updateVideo()) {
    echo json_encode("Video data updated.");
} else {
    echo json_encode("Data could not be updated");
}
