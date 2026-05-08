<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName = "library_management_db";

// Connect to MySQL (Procedural)
$conn = mysqli_connect($host, $user, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
if (mysqli_query($conn, $sql)) {
    mysqli_select_db($conn, $dbName);
} else {
    die("Error creating database: " . mysqli_error($conn));
}

// CREATE books TABLE
$booksTable = "CREATE TABLE IF NOT EXISTS books (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    category ENUM('Science', 'Fiction', 'History', 'Technology', 'Other') NOT NULL,
    availability ENUM('Available', 'Not Available') DEFAULT 'Available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!mysqli_query($conn, $booksTable)) {
    die("Error creating books table: " . mysqli_error($conn));
}
?>
