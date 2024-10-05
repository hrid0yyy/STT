<?php
// Include the database connection
$db = new PDO("mysql:host=localhost;dbname=stt_db", 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the values from the POST request
    $book_id = isset($_POST['book_id']) ? (int) $_POST['book_id'] : 0;
    $shop_owner_id = isset($_POST['shop_owner_id']) ? (int) $_POST['shop_owner_id'] : 0;
    $user_id = isset($_POST['user_id']) ? (int) $_POST['user_id'] : 0; // Get user ID from POST
    $rating = isset($_POST['rating']) ? (int) $_POST['rating'] : 0;

    if ($book_id > 0 && $shop_owner_id > 0 && $user_id > 0 && $rating > 0 && $rating <= 5) {
        try {
            // First, check if the row already exists
            $sql_check = "SELECT COUNT(*) FROM ratings WHERE book_id = :book_id AND shop_owner_id = :shop_owner_id AND reader_id = :reader_id";
            $stmt_check = $db->prepare($sql_check);
            
            // Bind the parameters
            $stmt_check->bindParam(':book_id', $book_id, PDO::PARAM_INT);
            $stmt_check->bindParam(':shop_owner_id', $shop_owner_id, PDO::PARAM_INT);
            $stmt_check->bindParam(':reader_id', $user_id, PDO::PARAM_INT);
            
            // Execute the query
            $stmt_check->execute();
            $row_exists = $stmt_check->fetchColumn();

            if ($row_exists) {
                // If a row exists, update the existing rating
                $sql_update = "UPDATE ratings SET star_rating = :rating WHERE book_id = :book_id AND shop_owner_id = :shop_owner_id AND reader_id = :reader_id";
                $stmt_update = $db->prepare($sql_update);
                
                // Bind the parameters
                $stmt_update->bindParam(':book_id', $book_id, PDO::PARAM_INT);
                $stmt_update->bindParam(':shop_owner_id', $shop_owner_id, PDO::PARAM_INT);
                $stmt_update->bindParam(':reader_id', $user_id, PDO::PARAM_INT);
                $stmt_update->bindParam(':rating', $rating, PDO::PARAM_INT);

                // Execute the update query
                if ($stmt_update->execute()) {
                    echo 'Rating updated successfully!';
                } else {
                    echo 'Error updating the rating.';
                }
            } else {
                // If no row exists, insert a new rating
                $sql_insert = "INSERT INTO ratings (book_id, shop_owner_id, reader_id, star_rating) 
                               VALUES (:book_id, :shop_owner_id, :reader_id, :rating)";
                
                $stmt_insert = $db->prepare($sql_insert);
                
                // Bind the parameters
                $stmt_insert->bindParam(':book_id', $book_id, PDO::PARAM_INT);
                $stmt_insert->bindParam(':shop_owner_id', $shop_owner_id, PDO::PARAM_INT);
                $stmt_insert->bindParam(':reader_id', $user_id, PDO::PARAM_INT);
                $stmt_insert->bindParam(':rating', $rating, PDO::PARAM_INT);
                
                // Execute the insert query
                if ($stmt_insert->execute()) {
                    echo 'Rating submitted successfully!';
                } else {
                    echo 'Error submitting the rating.';
                }
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'Invalid input.';
    }
}
?>
