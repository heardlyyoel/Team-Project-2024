<?php
require_once 'db_connection.php';

$db = new DBConnection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];

    $conn = $db->getConnection();


    $query = "INSERT INTO account (username, password, phone, location) VALUES (:username, :password, :phone, :location)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':location', $location);

    if ($stmt->execute()) {
        header('Location: login.php');
        exit();
    } else {
        echo "Registration failed.";
    }

    $db->closeConnection();
}
?>
