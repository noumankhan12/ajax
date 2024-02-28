<?php
include('config.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $conn = new mysqli($DB_SERVER, $DB_USER, $DB_PASSWORD, $DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Product deleted successfully!";
    } else {
        $response['success'] = false;
        $response['message'] = "Error occurred while deleting product: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    echo json_encode($response);
}
