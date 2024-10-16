    <?php
    require_once 'db_connection.php';

    if(isset($_GET['book_id'])) {
        $book_id = $_GET['book_id'];

        $db = new DBConnection();
        $conn = $db->getConnection();

    $query = "SELECT b.title, a.name AS author, c.name AS genre, b.description, vb.name AS available, acc.username
        FROM collection col
        INNER JOIN book b ON col.book_id = b.book_id
        INNER JOIN author a ON b.author_id = a.author_id
        INNER JOIN category c ON b.category = c.category_id
        INNER JOIN available vb ON col.available = vb.available_id
        INNER JOIN account acc ON col.owner = acc.account_id
        WHERE col.book_id = :book_id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':book_id', $book_id);
        $stmt->execute();
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$book) {
            echo "<script>alert('Book not Found.');</script>";
            exit();
        }
    } else {
        echo "<script>alert('Book ID is Missing.');</script>";
        exit();
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($book['title']); ?> - Book Detail</title>
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
    <main class="container mt-4">
        <h1><?php echo htmlspecialchars($book['title']); ?></h1>
        <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
        <p><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre']); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($book['description']); ?></p>
        <p><strong>Owner:</strong> <?php echo htmlspecialchars($book['username']); ?></p>
        <p><strong>Status:</strong> <?php echo htmlspecialchars($book['available']); ?></p>

        <!-- Button for bookmark -->
        <button class="btn btn-warning" id="bookmarkBtn" data-bookid="<?php echo $book_id; ?>">Bookmark</button>
        <script>
    document.getElementById("bookmarkBtn").addEventListener("click", function() {
        var bookId = this.getAttribute('data-bookid');
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "bookmark_process.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Handle response, jika perlu
                    alert("Book has been bookmarked!");
                } else {
                    alert("Error occurred while bookmarking the book.");
                }
            }
        };
        xhr.send("book_id=" + encodeURIComponent(bookId));
    });
</script>


        <!-- Button for rent -->
    <button class="btn btn-primary" id="rentBtn">Rent</button>
    <script>
        document.getElementById("rentBtn").addEventListener("click", function() {
        document.getElementById("rentForm").style.display = "block";
    });

    </script>
    <div id="rentForm" style="display: none;">
        <form action="rent_book_process.php" method="POST">
            <label for="rentDate">Rent Date:</label>
            <input type="date" id="rentDate" name="rentDate" required><br><br>
            <label for="returnDate">Return Date:</label>
            <input type="date" id="returnDate" name="returnDate" required><br><br>
            <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>



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