<?php
session_start();

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember_me']);

    $sql = "SELECT id, full_name, email, password FROM registrations WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['full_name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['login_time'] = date('Y-m-d H:i:s');

            if ($remember_me) {
                setcookie("user_email", $row['email'], time() + (30 * 24 * 60 * 60), "/");
            } else {
                setcookie("user_email", "", time() - 3600, "/");
            }

            setcookie("last_login", date('Y-m-d H:i:s'), time() + (30 * 24 * 60 * 60), "/");

            header("Location: dashboard.php");
            exit();
        }

        header("Location: login.html?error=invalid_password");
        exit();
    }

    header("Location: login.html?error=user_not_found");
    exit();
}

$conn->close();
?>
    header("Location: login.html");
    exit();
