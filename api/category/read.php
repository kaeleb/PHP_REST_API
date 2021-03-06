<?php 
    // Headers
    header('Access-Control_Allow_Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Category object
    $category = new Category($db);

    // category read query
    $result = $category->read();
    // get row count
    $num = $result->rowCount();

    // Check to see if any categories
    if($num > 0) {
        // Category array
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $cat_item = array(
                'id' => $id,
                'name' => $name
            );

            // Push to "data"
            array_push($cat_arr['data'], $cat_item);
        }


        // Turn into JSON & output
        echo json_encode($cat_arr);

    }else {
        // No Categories
        echo json_encode(
            array('message' => 'No categories found')
        );
    }

?>