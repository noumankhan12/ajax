<?php



$SITE_TITLE = "Products";


$DB_SERVER = "localhost";
$DB_NAME = "ajax";
$DB_USER = "root";
$DB_PASSWORD = "";


$conn = new mysqli($DB_SERVER, $DB_USER, $DB_PASSWORD, $DB_NAME);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
