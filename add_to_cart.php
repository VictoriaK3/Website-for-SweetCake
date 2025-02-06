<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cart = json_decode(file_get_contents('php://input'), true);
    $conn = new mysqli("localhost", "root", "", "sweetshop", 3300);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    foreach($cart as $item) {
        $name = $conn->real_escape_string($item['name']);
        $price = $conn->real_escape_string($item['price']);
        $sql = "INSERT INTO cart (product_name, price) VALUES ('$name', '$price')";
        $conn->query($sql);
    }
    echo "Succes";
    $conn->close();
}