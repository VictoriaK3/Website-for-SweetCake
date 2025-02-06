<?php
// Настройки за базата данни
$servername = "localhost"; // Промени при нужда
$username = "root";        // Промени при нужда
$password = "";            // Промени при нужда
$dbname = "sweetshop";        // Име на твоята база данни
$port = 3300;

// Свързване с базата данни
$conn = new mysqli($servername, $username, $password, $dbname,$port);

// Проверка на връзката
if ($conn->connect_error) {
    die("Връзката с базата данни не беше успешна: " . $conn->connect_error);
}

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileUp"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Създаване на папка, ако не съществува
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}

// Проверка дали файлът вече съществува
if (file_exists($target_file)) {
    echo "Съжаляваме, файлът вече съществува.";
    $uploadOk = 0;
}

// Проверка на размер на файла
if ($_FILES["fileUp"]["size"] > 500000) {
    echo "Съжаляваме, файлът е твърде голям.";
    $uploadOk = 0;
}

// Проверка за правилни файлови формати
$allowed_types = ["jpg", "jpeg", "png", "gif"];
if (!in_array($imageFileType, $allowed_types)) {
    echo "Съжаляваме, разрешени са само JPG, JPEG, PNG и GIF файлове.";
    $uploadOk = 0;
}

// Ако всичко е наред, качване на файла и запис в базата данни
if ($uploadOk == 1 && move_uploaded_file($_FILES["fileUp"]["tmp_name"], $target_file)) {
    $name = $conn->real_escape_string($_POST['name']);
    $review = $conn->real_escape_string($_POST['review']);

    $sql = "INSERT INTO customer (name, review, image) VALUES ('$name', '$review', '$target_file')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Файлът " . htmlspecialchars(basename($_FILES["fileUp"]["name"])) . " беше успешно качен и информацията записана.";
    } else {
        echo "Грешка при запис в базата данни: " . $conn->error;
    }
} else {
    echo "Съжаляваме, възникна грешка при качването на вашия файл.";
}

$conn->close();
?>
