<?php
// Връзка с базата данни
$host = "localhost";
$username = "root";
$password = "";
$dbname = "sweetshop";
$port = 3300;

$conn = new mysqli($host, $username, $password, $dbname, $port);

// Проверка за връзка
if ($conn->connect_error) {
    die("Грешка при връзката с базата данни: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Получени данни: ";
    print_r($_POST);
}

// Получаване на данни от POST заявката
$fname = $_POST['fname'] ?? null;
$lname = $_POST['lname'] ?? null;
$tel = $_POST['tel'] ?? null;
$email = $_POST['email'] ?? null;
$delivery_date = $_POST['delivery-date'] ?? null;
$note = $_POST['note'] ?? null;

// Получаване на данни от URL параметрите (за тортата)
$cake_name = $_GET['name'] ?? null;
$cake_price = $_GET['price'] ?? null;
$cake_image = $_GET['image'] ?? null;

// Проверка за празни полета
$missing_fields = [];

if (!$fname) $missing_fields[] = "Име";
if (!$lname) $missing_fields[] = "Фамилия";
if (!$tel) $missing_fields[] = "Телефон";
if (!$email) $missing_fields[] = "Имейл";
if (!$delivery_date) $missing_fields[] = "Дата за доставка";
if (!$cake_name) $missing_fields[] = "Име на тортата";
if (!$cake_price) $missing_fields[] = "Цена на тортата";

if (!empty($missing_fields)) {
    die("Моля, попълнете следните задължителни полета: " . implode(", ", $missing_fields));
}

// Подготовка на SQL заявката
$sql = "INSERT INTO orders 
        (first_name, last_name, phone, email, delivery_date, cake_name, cake_price, cake_image, note) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Грешка при подготовката на заявката: " . $conn->error);
}

$stmt->bind_param("sssssssss", $fname, $lname, $tel, $email, $delivery_date, $cake_name, $cake_price, $cake_image, $note);

// Изпълнение на заявката
if ($stmt->execute()) {
    echo "Поръчката е успешно записана!";
} else {
    echo "Грешка при записване на поръчката: " . $stmt->error;
}

// Затваряне на връзката
$stmt->close();
$conn->close();
?>
