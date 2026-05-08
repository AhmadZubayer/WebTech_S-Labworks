<?php
require_once '../model/bookModel.php';

header('Content-Type: application/json');

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

switch ($action) {
    case 'add':
        $title = $_POST['title'];
        $author = $_POST['author'];
        $category = $_POST['category'];
        $availability = $_POST['availability'];

        if (addBook($conn, $title, $author, $category, $availability)) {
            echo json_encode(['status' => 'success', 'message' => 'Book added successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add book.']);
        }
        break;

    case 'fetch_all':
        $books = getAllBooks($conn);
        echo json_encode(['status' => 'success', 'data' => $books]);
        break;

    case 'fetch_single':
        $id = $_GET['id'];
        $book = getBookById($conn, $id);
        if ($book) {
            echo json_encode(['status' => 'success', 'data' => $book]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Book not found.']);
        }
        break;

    case 'update':
        $id = $_POST['id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $category = $_POST['category'];
        $availability = $_POST['availability'];

        if (updateBook($conn, $id, $title, $author, $category, $availability)) {
            echo json_encode(['status' => 'success', 'message' => 'Book updated successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update book.']);
        }
        break;

    case 'delete':
        $id = $_POST['id'];
        if (deleteBook($conn, $id)) {
            echo json_encode(['status' => 'success', 'message' => 'Book deleted successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete book.']);
        }
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
        break;
}
?>
