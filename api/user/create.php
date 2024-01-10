<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../database.php';
include_once '../../queries/user.php';

$database = new Database();
$db = $database->getConnection();
$item = new User($db);

$item->name = $_GET['name'];
$item->user = $_GET['user'];
$item->verify = $_GET['verify'];
$item->email = $_GET['email'];
$item->facebook = $_GET['facebook'];
$item->instagram = $_GET['instagram'];
$item->twitch = $_GET['twitch'];
$item->website = $_GET['website'];
$item->description = $_GET['description'];

if ($item->createUser()) {
    echo 'User created successfully.';
} else {
    echo 'User could not be created.';
}
