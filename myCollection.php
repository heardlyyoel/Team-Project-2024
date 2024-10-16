<?php
session_start();

if (!isset($_SESSION['account_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'db_connection.php';

$db = new DBConnection();
$conn = $db->getConnection();

$query = "SELECT b.book_id, b.title, a.name AS author, c.name AS genre, b.description, b.image_path
          FROM collection col
          INNER JOIN book b ON col.book_id = b.book_id
          INNER JOIN author a ON b.author_id = a.author_id
          INNER JOIN category c ON b.category = c.category_id
          WHERE col.owner = :account_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':account_id', $_SESSION['account_id'], PDO::PARAM_INT);
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$books) {
    echo "No books found.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
    .card {
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .card img {
        width: 100%;
        height: auto;
            max-width: 150px; /* Mengatur lebar maksimal gambar */
    }
    .btn-edit {
        background-color: yellow;
        color: black;
    }
    .btn-delete {
        background-color: red;
        color: white;
    }
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
    <script>
        function toggleAddBookForm() {
            var addBookForm = document.getElementById("addBookFormWrapper");
            if (addBookForm.style.display === "none") {
                addBookForm.style.display = "block";
            } else {
                addBookForm.style.display = "none";
            }
        }
    </script>
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
                    <li><a class="li-a-nav" href="logout.php">logout</a></li>
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
    <main class="container mt-4">
    <div class="col text-center">
        <h1>My Collection</h1>
    </div>
    <div class="row">
        <!-- Book listing -->
        <?php foreach ($books as $book): ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo htmlspecialchars($book['image_path']); ?>" class="img-fluid rounded-start" alt="Book Image">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($book['title']); ?></h5>
                                <p class="card-text"><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                                <p class="card-text"><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre']); ?></p>
                                <p class="card-text"><strong>Description:</strong> <?php echo htmlspecialchars($book['description']); ?></p>
                                <div class="btn-group" role="group" aria-label="Book Actions">
                                    <a href="edit_book.php?book_id=<?php echo $book['book_id']; ?>" class="btn btn-primary btn-edit">EDIT</a>
                                    <a href="delete_book.php?book_id=<?php echo $book['book_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?');">DELETE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php
// Query SQL untuk mengambil semua kategori dari tabel category
$categoryQuery = "SELECT * FROM category";
$categoryStmt = $conn->prepare($categoryQuery);
$categoryStmt->execute();
$categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Start Formulir Add Book -->
<div id="addBookFormWrapper" class="position-fixed top-50 start-50 translate-middle" style="display: none; background-color: rgba(255, 255, 255, 0.9); width: 400px; height: 500px;">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Add Book</h5>
                <form action="add_book_process.php" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" id="title" name="title" class="form-control" style="width: 100%;" required>
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Author:</label>
                        <input type="text" id="author" name="author" class="form-control" style="width: 100%;" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea id="description" name="description" class="form-control" style="width: 100%;" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category:</label>
                        <select id="category" name="category" class="form-control" style="width: 100%;" required>
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Book</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Formulir Add Book -->

<a href="#" class="btn btn-add" onclick="toggleAddBookForm()">
    <i class="fas fa-plus"></i> Add Book
</a>

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