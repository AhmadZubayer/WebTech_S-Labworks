<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <section>
            <?php include 'newBook.php';?>
            <?php include 'browseBook.php';?>
            <?php include 'updateBook.php';?>
        </section>
    </main>
    <?php include 'footer.php';?>

    <script src="script.js"></script>
</body>
</html>
