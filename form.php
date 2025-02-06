<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $fname = trim($_POST['fname'] );
    $lname = trim($_POST['lname'] );
    $tel = trim($_POST['tel'] );
    $email = trim($_POST['email'] );
    $delivery_date = trim($_POST['delivery-date']);

   
    
    if ($fname && $lname && $tel && $email && $delivery_date) {
        $message = "<h1>Благодарим за поръчката, $fname $lname!</h1>";
    } else {
        $message = "<h1>Моля, попълнете всички полета във формуляра.</h1>";
    }
} else {
    $message = "<h1>Невалидна заявка!</h1>";
}
?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Резултат</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 50px;
        }
        h1 {
            color: #c45bff;
        }
        a {
            text-decoration: none;
            color: #8bc34a;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div>
        <?php echo $message; ?>
    </div>
    <br>
    <a href="Order.html">Върни се към формуляра</a>
</body>
</html>