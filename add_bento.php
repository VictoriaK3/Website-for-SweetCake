<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweetshop";

$conn = new mysqli("localhost", "root", "", "sweetshop", 3300);
if($conn -> connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$bentoCakes = [
    ['name' => 'Бенто Есен','price' => 35.00, 'description' => 'white, orange', 
    'quantity' => 10],
    ['name' => 'Любов','price' => 32.00, 'description' => 'white, heart,red', 
    'quantity' => 5],
    ['name' => 'Бенто Happy Birthday златно','price' => 35.00, 'description' => 'white, gold', 
    'quantity' => 5],
    ['name' => 'Бенто Коледа','price' => 38.00, 'description' => 'white,winter,christmas', 
    'quantity' => 8],
    ['name' => 'Бенто със снимка','price' => 40.00, 'description' => 'white/black, picture', 
    'quantity' => 9],
    ['name' => 'Бенто Горяща торта','price' => 47.00, 'description' => 'white/black, picture,fire', 
    'quantity' => 0],
];
foreach($bentoCakes as $cake){
    $stmt = $conn->prepare("INSERT INTO bento (name, description, price, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $cake['name'], $cake['description'], $cake['price'], $cake['quantity']);
    $stmt->execute();
}
echo "Тортите са добавени успешно!";
$conn->close();
?>