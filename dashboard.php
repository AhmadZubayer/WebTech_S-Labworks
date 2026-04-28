<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
$login_time = $_SESSION['login_time'];
$last_login = isset($_COOKIE['last_login']) ? $_COOKIE['last_login'] : 'First login';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - User Authentication System</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1 class="dashboard-title">Dashboard</h1>
            <div class="welcome-section">
                <h2 class="welcome-title">Welcome, <?php echo htmlspecialchars($user_name); ?></h2>
                <p class="welcome-subtitle">You are successfully logged in</p>
            </div>

            <div class="info-section">
                <div class="info-item">
                    <span class="info-label">Email:</span>
                    <span class="info-value"><?php echo htmlspecialchars($user_email); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Login Time:</span>
                    <span class="info-value"><?php echo $login_time; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Last Login:</span>
                    <span class="info-value"><?php echo $last_login; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Session ID:</span>
                    <span class="info-value"><?php echo htmlspecialchars(session_id()); ?></span>
                </div>
            </div>

            <div class="actions">
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
