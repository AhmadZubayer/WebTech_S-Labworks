<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName = "BasicRegistrationDB";

$conn = mysqli_connect($host, $user, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

mysqli_select_db($conn, $dbName);

$registrationTable = "CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'parent', 'teacher', 'professional') NOT NULL,
    track ENUM('creative-coding', 'ui-ux', 'ai-fundamentals', 'foundations') NOT NULL,
    start_date DATE NOT NULL,
    notes TEXT,
    terms_accepted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($registrationTable) !== TRUE) {
    die("Error creating registrations table: " . $conn->error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];
    $track = 'foundations';
    $start_date = date('Y-m-d');
    $notes = '';
    $terms_accepted = isset($_POST['terms_accepted']) ? 1 : 0;

    $errors = [];

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    $email_check = "SELECT id FROM registrations WHERE email = '$email'";
    $result = $conn->query($email_check);
    if ($result->num_rows > 0) {
        $errors[] = "Email already registered. Please use a different email or log in.";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: register.html");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $insert_sql = "INSERT INTO registrations (full_name, email, phone, password, role, track, start_date, notes, terms_accepted)
                   VALUES ('$full_name', '$email', '$phone', '$hashed_password', '$role', '$track', '$start_date', '$notes', $terms_accepted)";

    if ($conn->query($insert_sql) === TRUE) {
        header("Location: login.html?success=saved");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
