<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../database.php';
include_once '../../queries/comment.php';

$database = new Database();
$db = $database->getConnection();
$item = new Comment($db);

// echo $_GET['video_id'];


$item->video_id = $_GET['video_id'];
$item->user_id = $_GET['user_id'];
$item->comment_text = $_GET['comment_text'];

if ($item->createComment()) {
    echo 'Comment created successfully.';
} else {
    echo 'Comment could not be created.';
}
