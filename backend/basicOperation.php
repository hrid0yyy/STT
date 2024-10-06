<?php

      include 'dbconnection.php';

    function searchBooks($searchTerm) {


      global $conn;    

        $sql = "SELECT * from books B JOIN book_shopowners on B.book_id = book_shopowners.book_id
        JOIN shopowners on shopowners.shop_owner_id = book_shopowners.shop_owner_id
        WHERE B.title LIKE '%$searchTerm%' 
        OR B.genre LIKE '%$searchTerm%' 
        OR B.isbn LIKE '%$searchTerm%' 
        OR B.description LIKE '%$searchTerm%' 
        OR B.language LIKE '%$searchTerm%' 
        OR B.publication_date LIKE '%$searchTerm%';
        ";

        $result = $conn->query($sql);
    
  
        if ($result->num_rows > 0) {

            $books = [];
            while($row = $result->fetch_assoc()) {
                $books[] = $row;
            }
            return $books;
        } else {
            return null; 
        }
    
       
    }

  
     
    if (isset($_REQUEST['delete_cart'])) {
       
            $cart_id = $_GET['delete_cart_id']; // Retrieve the cart item ID
        
            $query = 'DELETE FROM cart WHERE cart_id = ?';

            // Initialize the prepared statement
            $stmt = $conn->prepare($query);
        
            // Bind the cart_id parameter
            $stmt->bind_param('i', $cart_id);
        
            // Execute the statement
            if ($stmt->execute()) {
                return 'Cart item with ID: $cart_id has been deleted successfully.';
            } else {
                echo 'Error deleting cart item: ' . $stmt->error;
            }
        
            $stmt->close();
       
    }

    function cart_items($reader_id) {
        global $conn;
    
        $query = '
        SELECT books.bookcover, books.title, c.book_id, c.shop_owner_id, c.amount, bs.price, (c.amount * bs.price) AS total_price,c.cart_id
        FROM cart c
        JOIN book_shopowners bs ON c.book_id = bs.book_id AND c.shop_owner_id = bs.shop_owner_id
        JOIN books ON books.book_id = c.book_id
        WHERE c.reader_id = ?
    ';

    // Initialize the prepared statement
    $stmt = $conn->prepare($query);
    
    // Bind the reader_id parameter
    $stmt->bind_param('i', $reader_id);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch all cart items
    $cart_items = $result->fetch_all(MYSQLI_ASSOC);

   
        return $cart_items; // Return the array of cart items
    

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    
    }



    function addToCart($conn, $book_id, $reader_id, $shop_owner_id) {
        // Check if the item is already in the cart
        $query = 'SELECT cart_id, amount FROM cart WHERE book_id = ? AND reader_id = ? AND shop_owner_id = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('iii', $book_id, $reader_id, $shop_owner_id);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // If the item is already in the cart, update the amount
            $stmt->bind_result($cart_id, $amount);
            $stmt->fetch();
            $updateQuery = 'UPDATE cart SET amount = amount + 1 WHERE cart_id = ?';
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param('i', $cart_id);
            $updateStmt->execute();
            $updateStmt->close();
        } else {
            // Insert a new item into the cart
            $insertQuery = 'INSERT INTO cart (book_id, reader_id, shop_owner_id, amount) VALUES (?, ?, ?, 1)';
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param('iii', $book_id, $reader_id, $shop_owner_id);
            $insertStmt->execute();
    
            // Retrieve the new cart_id
            $cart_id = $conn->insert_id;  // Get the last inserted cart_id
            $insertStmt->close();
        }
    
        // Store the cart_id in the session
        $_SESSION['cart_id'] = $cart_id;
    
        $stmt->close();
    }
    
    
    // Example usage
    if (isset($_POST['add_to_cart'])) {
        $book_id = $_POST['book_id'];
        $reader_id = $_POST['reader_id']; // Get from session or form
        $shop_owner_id = $_POST['shop_owner_id']; // Get from form or database
    
        // Add to cart logic
        addToCart($conn, $book_id, $reader_id, $shop_owner_id);
    
        // Redirect to the same page to prevent form resubmission
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
    


    function genre() {
        global $conn;
    
        $query = '
        SELECT distinct genre from books 
    ';

    // Initialize the prepared statement
    $stmt = $conn->prepare($query);
    
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch all cart items
    $g = $result->fetch_all(MYSQLI_ASSOC);

   
        return $g; // Return the array of cart items
    

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    
    } 

    function authors() {
        global $conn;
    
        $query = '
        SELECT name from authors 
    ';

    // Initialize the prepared statement
    $stmt = $conn->prepare($query);
    
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch all cart items
    $g = $result->fetch_all(MYSQLI_ASSOC);

   
        return $g; // Return the array of cart items
    

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    
    } 



    function cities() {
        global $conn;
    
        $query = '
        SELECT DISTINCT city from shopowners
    ';

    // Initialize the prepared statement
    $stmt = $conn->prepare($query);
    
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch all cart items
    $g = $result->fetch_all(MYSQLI_ASSOC);

   
        return $g; // Return the array of cart items
    

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    
    } 



    
   
    
?>