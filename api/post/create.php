<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
Access-Control-Allow-Methods, Authorization, X-Requested-With');

// include_once '../..config/Database.php';
include_once '../../config/Database.php';
include_once '../../models/Post.php';

 // Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instatiate blog post obj
$post = new Post($db);

// Get raw posted data
$data = json_decode((file_get_contents("php://input")));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

// Create post
if($post->create()) {
    echo json_encode(
        ['message' => 'Post Created']
    );
} else {
    echo json_encode(['message' => 'Post is not created']);
}

?>