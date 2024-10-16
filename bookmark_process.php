<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['account_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $account_id = $_SESSION['account_id'];
    $book_id = isset($_POST['book_id']) ? intval($_POST['book_id']) : 0;

    if ($book_id > 0) {
        $db = new DBConnection();
        $conn = $db->getConnection();

        $check_query = "SELECT COUNT(*) FROM bookmark WHERE account_id = :account_id AND book_id = :book_id";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bindParam(':account_id', $account_id, PDO::PARAM_INT);
        $check_stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        $check_stmt->execute();

        if ($check_stmt->fetchColumn() > 0) {
            echo "This book is already bookmarked.";
        } else {

            $current_date = date('Y-m-d H:i:s');
            $insert_query = "INSERT INTO bookmark (account_id, book_id, date_added) VALUES (:account_id, :book_id, :date_added)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bindParam(':account_id', $account_id, PDO::PARAM_INT);
            $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
            $stmt->bindParam(':date_added', $current_date, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "Book has been bookmarked!";
            } else {
                echo "Failed to bookmark the book. Please try again.";
            }
        }


        $db->closeConnection();
    } else {
        echo "Invalid book ID.";
    }
} else {
    echo "Invalid request.";
}
?>
