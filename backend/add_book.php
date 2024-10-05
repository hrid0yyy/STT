<?php
session_start();
include 'dbconnection.php';  // Your database connection

if (isset($_POST['addBook'])) {
    $title = $_POST['title'];
    $writer = $_POST['writer'];
    $publisher = $_POST['publisher'];
    $genre = $_POST['genre'];
    $pdfFile = $_FILES['pdf_file'];

    // Upload PDF
    $pdfFilePath = 'uploads/' . basename($pdfFile['name']);
    move_uploaded_file($pdfFile['tmp_name'], $pdfFilePath);

    // Insert book into the database
    $sql = "INSERT INTO bookshelf (user_id, title, writer, publisher, genre, pdf_url) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id'], $title, $writer, $publisher, $genre, $pdfFilePath]);

    // Redirect back to the bookshelf page
    header('Location: ../bookshelf-reader.php');
}
?>
