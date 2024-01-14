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
$item->name = $_GET['name'];
$item->duration = $_GET['duration'];
$item->views_number = $_GET['views_number'];
$item->date_publication = $_GET['date_publication'];
$item->image = $_GET['image'];

if ($item->updateShort()) {
    echo json_encode("Short data updated.");
} else {
    echo json_encode("Data could not be updated");
}
