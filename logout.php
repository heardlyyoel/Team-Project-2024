<?php
// Mulai sesi
session_start();

// Delete All data sessiion
session_unset();

// Hancurkan sesi
session_destroy();

header("Location: login.php");
exit();
?>
