<?php
// Database connection
$db = new PDO("mysql:host=localhost;dbname=stt_db", 'root', '');

// Get the book_id from the GET request
if (isset($_GET['book_id'])) {
    $book_id = htmlspecialchars($_GET['book_id']);

    // Fetch shop information for the book
    $query = "
        SELECT s.shop_name, bs.price, bs.stock_quantity, 
               IFNULL(AVG(r.star_rating), 0) AS rating
        FROM book_shopowners bs
        JOIN shopowners s ON bs.shop_owner_id = s.shop_owner_id
        LEFT JOIN ratings r ON bs.book_id = r.book_id AND bs.shop_owner_id = r.shop_owner_id
        WHERE bs.book_id = :book_id
        GROUP BY s.shop_owner_id
    ";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch all results as an associative array
    $shops = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the data as JSON
    echo json_encode($shops);
}
?>
