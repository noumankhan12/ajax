<?php
include('config.php');

$conn = new mysqli($DB_SERVER, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $sellPrice = $_POST['sell_price'];
    $purchasePrice = $_POST['purchase_price'];

    $stmt = $conn->prepare("INSERT INTO products (title, PPrice, SPrice) VALUES (?, ?, ?)");
    $stmt->bind_param("sdd", $title, $purchasePrice, $sellPrice);

    $response = array();

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Data inserted successfully!";
    } else {
        $response['success'] = false;
        $response['message'] = "Error occurred while inserting data: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    echo json_encode($response);
}
