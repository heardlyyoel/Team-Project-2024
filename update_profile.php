<?php
session_start();

require_once 'db_connection.php';

if (!isset($_SESSION['account_id'])) {
    header('Location: login.php');
    exit();
}

$db = new DBConnection();
$conn = $db->getConnection();

$account_id = $_SESSION['account_id'];
$query = "SELECT * FROM account WHERE account_id = :account_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':account_id', $account_id);
$stmt->execute();
$userAccount = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$userAccount) {
    echo "User account not found.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $location = $_POST['location'];

    $updateQuery = "UPDATE account SET phone = :phone, location = :location WHERE username = :username";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(':phone', $phone);
    $updateStmt->bindParam(':location', $location);
    $updateStmt->bindParam(':username', $username);

    if ($updateStmt->execute()) {
        header('Location: profile.php');
        exit();
    } else {
        echo "Failed to update profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Bibliotukar</a>
            <div class="tagline">Education - Peace - Freedom - Happiness For YOU and ME</div>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Exchange Book</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">BookMark</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Rent</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Menu
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="#">My Collection</a></li>
                                <li><a class="dropdown-item" href="#">About</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex ms-auto">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>  
    </header>
    <main class="container mt-4">
        <h1>Update Profile</h1>
        <form action="update_profile.php" method="POST">
            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($userAccount['phone']); ?>">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location:</label>
                <input type="text" id="location" name="location" class="form-control" value="<?php echo htmlspecialchars($userAccount['location']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </main>
    <footer class="footer mt-auto py-3 bg-light text-center">
        <div class="container">
            <span class="text-muted">Bibliotukar &copy; 2024</span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
