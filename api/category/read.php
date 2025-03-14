<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// include_once '../..config/Database.php';
include_once '../../config/Database.php';
include_once '../../models/Category.php';

 // Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instatiate Category obj
$category = new Category($db);
// Category query
$result = $category->read();
// Get row count
$num = $result->rowCount();

// Check if any category
if($num > 0) {
    // Category array
    $cat_arr = [];
    $cat_arr['data'] = [];

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $cat_item = [
            'id' => $id,
            'name' => $name
        ];

        // Push to "data"
        array_push($cat_arr['data'], $cat_item);
    }

    //Turn to JSON
    echo json_encode($cat_arr);

} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}

?>