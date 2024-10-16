<?php
session_start();
if (!isset($_SESSION['account_id'])) {
    header('Location: login.php');
    exit();
}
require_once 'db_connection.php';

$db = new DBConnection();
$conn = $db->getConnection();

if (isset($_GET['book_id']) && is_numeric($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    $query = "SELECT b.book_id, b.title, b.description, b.author_id, a.name AS author_name
              FROM book b
              INNER JOIN author a ON b.author_id = a.author_id
              WHERE b.book_id = :book_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':book_id', $book_id);
    $stmt->execute();
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book) {
        echo "Book not found.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $updateQuery = "UPDATE book
                    SET title = :title, description = :description
                    WHERE book_id = :book_id";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':book_id', $book_id);
    $stmt->execute();

    $updateCollectionQuery = "UPDATE collection
                              SET available = 1
                              WHERE book_id = :book_id";
    $stmtCollection = $conn->prepare($updateCollectionQuery);
    $stmtCollection->bindParam(':book_id', $book_id);
    $stmtCollection->execute();

    header('Location: myCollection.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
    .footer {
        background-color: #062D52;
        color: #EFF2F9;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-weight: bold;
        height: 150px;
        margin: 0;
        left: 0;
        right: 0;
    }
    </style>
</head>
<body>
    
<nav id="navbar">
        <div class="container-logo">
            <a href="home.php">
                <img class="logo-a-img" src="Images/logo-nav.svg">
            </a>
            <div class="container-logo-a-nav">
                <a href="home.php" class="logo-a-nav">
                    Blibliobook
                </a>
            </div>
        </div>
        <div>
            <div id="vertical-line">
            </div>
            <div class="container-li-a-nav">
                <ul class="ul-a-nav";>
                    <li><a class="li-a-nav" href="index.php">Library</a></li>
                    <li><a class="li-a-nav" href="rent_list.php">Rent</a></li>
                    <li><a class="li-a-nav" href="profile.php">Profile</a></li>
                    <li><a class="li-a-nav" href="myCollection.php">Mycollection</a></li>
                    <li><a class="li-a-nav" href="about.php">About</a></li>
                    <li><a class="li-a-nav" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header>
        <div class="container-logo-a-header">
            <a href="home.php" class="logo-a-header">
                Blibliobook
            </a>
        </div>
    </header>
    <div class="container mt-4">
    <div class="col text-center">
        <h1>Edit Book</h1>
    </div>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($book['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author:</label>
                <input type="text" id="author" name="author" class="form-control" value="<?php echo htmlspecialchars($book['author_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($book['description']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <div class="footer">
        <p style="font-size: xx-large; margin-top: 0; margin-bottom: 0; margin-left: 200px;">Blibliobook</p>
        <hr style="margin-left: 200px; margin-right: 200px;">
        <p style="font-size: large; margin-top: 30px; margin-bottom: 0; margin-left: 200px;">Powered by President University Information System</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    
    <script src="script.js"></script>
</body>
<script>  
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
            if (document.documentElement.scrollTop > 67.5 ) {
                document.getElementById("navbar").style.top = "0";
            } else {
                document.getElementById("navbar").style.top = "";
            }
        }
    </script>
</html>
