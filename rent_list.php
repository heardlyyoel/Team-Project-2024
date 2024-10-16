<?php
require_once 'db_connection.php';
session_start();
if (!isset($_SESSION['account_id'])) {
    header('Location: login.php');
    exit();
}

$account_id = $_SESSION['account_id'];

$db = new DBConnection();
$conn = $db->getConnection();

$query = "SELECT b.title AS book_title, a.username AS owner, r.rent_date, r.return_date
          FROM rent r
          INNER JOIN book b ON r.book_id = b.book_id
          INNER JOIN collection c ON c.book_id = b.book_id
          INNER JOIN account a ON a.account_id = c.owner
          WHERE r.id_account = :account_id";

$stmt = $conn->prepare($query);
$stmt->bindParam(':account_id', $account_id);
$stmt->execute();
$rentList = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BliblioBook - Presuniv</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="css/style.css">
        <script>
            function toggleAddBookForm() {
            var addBookForm = document.getElementById("addBookForm");
            if (addBookForm.style.display === "none") {
                addBookForm.style.display = "block";
            } else {
                addBookForm.style.display = "none";
            }
        }
    </script>
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
    <h1>Rent List</h1>
</div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Book Title</th>
                <th>Owner</th>
                <th>Rent Date</th>
                <th>Return Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rentList as $index => $rent): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo htmlspecialchars($rent['book_title']); ?></td>
                    <td><?php echo htmlspecialchars($rent['owner']); ?></td>
                    <td><?php echo htmlspecialchars($rent['rent_date']); ?></td>
                    <td><?php echo htmlspecialchars($rent['return_date']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
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