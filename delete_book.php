<?php
session_start();

if (!isset($_SESSION['account_id'])) {
    header('Location: login.php');
    exit();
}

$db = new DBConnection();
$conn = $db->getConnection();

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    $deleteBookQuery = "DELETE FROM book WHERE book_id = :book_id";
    $stmtBook = $conn->prepare($deleteBookQuery);
    $stmtBook->bindParam(':book_id', $book_id);
    $stmtBook->execute();
    $deleteCollectionQuery = "DELETE FROM collection WHERE book_id = :book_id";
    $stmt = $conn->prepare($deleteCollectionQuery);
    $stmt->bindParam(':book_id', $book_id);
    $stmt->execute();


    header('Location: myCollection.php');
    exit();
} else {
    echo "Invalid request.";
    exit();
}
?>
