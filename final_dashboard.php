<?php
session_start();

$timeout = 60;

if (!isset($_SESSION['user'])) {
    header("Location: final_login.php");
    exit();
}

if (time() - $_SESSION['start_time'] > $timeout) {
    session_unset();
    session_destroy();
    header("Location: final_login.php");
    exit();
}

$user = $_SESSION['user'];
$remaining_time = $timeout - (time() - $_SESSION['start_time']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .dashboard-container {
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            color: #4CAF50;
        }
        .info {
            margin: 20px 0;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 3px;
        }
        .warning {
            color: #ff9800;
            font-weight: bold;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 3px;
        }
        a:hover {
            background-color: #da190b;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h2>Welcome, <?php echo htmlspecialchars($user); ?></h2>

    <div class="info">
        <p>You are successfully logged in.</p>
        <p class="warning">Session will expire in <?php echo $remaining_time; ?> seconds</p>
    </div>

    <a href="final_logout.php">Logout</a>
</div>

</body>
</html>
