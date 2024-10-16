<?php
require_once 'db_connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $id_account_own = $_POST['id_account_own'];
    $rentDate = $_POST['rentDate'];
    $returnDate = $_POST['returnDate'];
    $id_account = $_SESSION['account_id'];


    $conn = (new DBConnection())->getConnection();
    $query = "INSERT INTO rent (id_account_own, book_id, id_account, rent_date, return_date) 
              VALUES (:id_account_own, :book_id, :id_account, :rent_date, :return_date)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_account_own', $id_account_own);
    $stmt->bindParam(':book_id', $book_id);
    $stmt->bindParam(':id_account', $id_account);
    $stmt->bindParam(':rent_date', $rentDate);
    $stmt->bindParam(':return_date', $returnDate);
    $stmt->execute();

    $updateQuery = "UPDATE collection SET available = 'unavailable' WHERE book_id = :book_id";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(':book_id', $book_id);
    $updateStmt->execute();

    header("Location: book_detail.php?book_id=$book_id");
    exit();
}
?>
