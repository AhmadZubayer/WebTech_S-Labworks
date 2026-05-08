<?php
require_once 'dbConfig.php';

// add a new book
function addBook($conn, $title, $author, $category, $availability) {
    $sql = "INSERT INTO books (title, author, category, availability) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $title, $author, $category, $availability);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

// retrieve all books
function getAllBooks($conn) {
    $sql = "SELECT * FROM books ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    $books = [];
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $books[] = $row;
        }
    }
    return $books;
}

//  get a  book by ID 
function getBookById($conn, $id) {
    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $book = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $book;
}

//  update book details
function updateBook($conn, $id, $title, $author, $category, $availability) {
    $sql = "UPDATE books SET title = ?, author = ?, category = ?, availability = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $title, $author, $category, $availability, $id);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

//  delete a book
function deleteBook($conn, $id) {
    $sql = "DELETE FROM books WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}
?>
