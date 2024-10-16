<?php
session_start();

require_once 'db_connection.php';


if (!isset($_SESSION['account_id'])) {
    header('Location: login.php');
    exit();
}
if (!isset($_SESSION['username'])) {
    echo "Error: Session username not set.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));


    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
 
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
            $db = new DBConnection();
            $conn = $db->getConnection();

            $authorId = insertAuthorIfNotExists($conn, $author);

            $categoryId = getCategoryID($conn, $category);

            $insertBookQuery = "INSERT INTO book (title, author_id, description, category, image_path) VALUES (:title, :author_id, :description, :category, :image_path)";
            $stmt = $conn->prepare($insertBookQuery);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':author_id', $authorId);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':category', $categoryId);
            $stmt->bindParam(':image_path', $targetFile); // Save image path to database
            $stmt->execute();

            $bookId = $conn->lastInsertId();

            $ownerId = getOwnerId($conn, $_SESSION['username']);

            if ($ownerId === false) {
                echo "Error: Owner not found.";
                exit();
            }
            insertBookIntoCollection($conn, $bookId, $ownerId);

            header('Location: index.php');
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

function insertAuthorIfNotExists($conn, $authorName) {
    $query = "SELECT author_id FROM author WHERE name = :author";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':author', $authorName);
    $stmt->execute();
    $authorResult = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$authorResult) {
        $insertAuthorQuery = "INSERT INTO author (name) VALUES (:author)";
        $insertAuthorStmt = $conn->prepare($insertAuthorQuery);
        $insertAuthorStmt->bindParam(':author', $authorName);
        $insertAuthorStmt->execute();
        return $conn->lastInsertId();
    } else {
        return $authorResult['author_id'];
    }
}

function getCategoryID($conn, $categoryName) {
    $query = "SELECT category_id FROM category WHERE name = :category";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':category', $categoryName);
    $stmt->execute();
    $categoryResult = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$categoryResult) {
        echo "<script>alert('Category not found.');</script>";
        exit();
    }

    return $categoryResult['category_id'];
}
function getOwnerId($conn, $username) {
    $query = "SELECT account_id FROM account WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $ownerResult = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ownerResult) {
        return false;
    }

    return $ownerResult['account_id'];
}

$ownerId = getOwnerId($conn, $_SESSION['username']);
if ($ownerId === false) {
    echo "Owner not found. Please contact support.";
    exit();
}

insertBookIntoCollection($conn, $bookId, $ownerId);

function insertBookIntoCollection($conn, $bookId, $ownerId) {
    $insertCollectionQuery = "INSERT INTO collection (book_id, owner, available) VALUES (:book_id, :owner, 1)";
    $insertCollectionStmt = $conn->prepare($insertCollectionQuery);
    $insertCollectionStmt->bindParam(':book_id', $bookId);
    $insertCollectionStmt->bindParam(':owner', $ownerId);
    $insertCollectionStmt->execute();
}
header('Location: index.php');
exit();
?>
