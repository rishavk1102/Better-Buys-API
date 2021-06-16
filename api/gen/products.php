<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/Product.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($product->validate_params($_GET['seller_id'])) {
        $product->seller_id = $_GET['seller_id'];
    } else {
        echo json_encode(array('success' => 0, 'message' => 'Seller ID is required!'));
        die();
    }

    echo json_encode(array('success' => 1, 'products' => $product->get_products_per_seller()));
} else {
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
