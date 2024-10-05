<?php
 
  include 'dbconnection.php';

    if(isset($_POST['order']))
    {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $town = $_POST['town'];
     $cart_items = cart_items($_SESSION['user_id']);
     if(!empty($cart_items))
     {
        $buy = true;
        foreach ($cart_items as $item){
              if(isStockAvailable($item['book_id'],$item['shop_owner_id'],$item['amount']))
              {
                continue;
              }
              else{
                $buy = false;
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>".$item['title'] . " is not enough in the stock</strong> .
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
              break;
              }
        }
       if($buy){
         processPurchase($_SESSION['user_id'],$first_name,$last_name,$email,$phone_number,$address,$town);
       }
     }
     
    }

    function processPurchase($reader_id,$first_name,$last_name,$email,$phone_number,$address,$town) {
          global $conn;
        // Get all rows from the cart table for the given reader_id
        $query = "SELECT book_id, reader_id, shop_owner_id, amount FROM cart WHERE reader_id = ?";
        
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $reader_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Check if there are any items in the cart
            if ($result->num_rows > 0) {
                // Prepare the insert statement for the purchase table
                $insertQuery = "INSERT INTO purchase (reader_id, book_id, shop_owner_id, quantity) 
                                VALUES (?, ?, ?, ?)";
                $insertStmt = $conn->prepare($insertQuery);
                
                // Loop through each item in the cart and insert it into the purchase table
                while ($row = $result->fetch_assoc()) {
                    $book_id = $row['book_id'];
                    $shop_owner_id = $row['shop_owner_id'];
                    $quantity = $row['amount'];
                    
                    
                    // Bind the parameters for the insert statement
                    $insertStmt->bind_param("iiii", $reader_id, $book_id, $shop_owner_id, $quantity);
                      // Execute the insert query for each cart row
                      if (!$insertStmt->execute()) {
                        echo "Error inserting into purchase: " . $conn->error;
                        return false;
                    }
                    $purchase_id = $insertStmt->insert_id;
             
                    $sql = "INSERT INTO billing (first_name, last_name, email, phone, address,town, purchase_id) 
                    VALUES (?, ?, ?, ?,?, ?,?)";
                    $stmt = $conn ->prepare($sql);
                    $stmt->bind_param("ssssssi", $first_name,$last_name,$email,$phone_number,$address,$town,$purchase_id);
                    if (!$stmt->execute()) {
                        echo "Error inserting into biling: " . $conn->error;
                    }

                    // update stock limit
                    $updateQuery = "UPDATE `book_shopowners` SET `stock_quantity` = `stock_quantity` - ? WHERE `book_shopowners`.`book_id` = ? AND `book_shopowners`.`shop_owner_id` = ?;";
                    $updateStmt = $conn->prepare($updateQuery);
                    $updateStmt->bind_param("iii", $quantity, $book_id, $shop_owner_id);
                    if (!$updateStmt->execute()) {
                        echo "Error inserting into purchase: " . $conn->error;
                    }


                  
                }
                
                // After inserting all cart items into the purchase table, clear the cart
                $deleteQuery = "DELETE FROM cart WHERE reader_id = ?";
                if ($deleteStmt = $conn->prepare($deleteQuery)) {
                    $deleteStmt->bind_param("i", $reader_id);
                    $deleteStmt->execute();
                } else {
                    echo "Error clearing the cart: " . $conn->error;
                    return false;
                }
                
                // Close statements
                $insertStmt->close();
                $stmt->close();
                $deleteStmt->close();
                
                echo "Purchase processed successfully.";
                return true;
            } else {
                echo "No items found in the cart for the given reader.";
                return false;
            }
        } else {
            echo "Error fetching cart items: " . $conn->error;
            return false;
        }
    }


function isStockAvailable( $book_id, $shop_owner_id, $requested_quantity) {
    global $conn;
    // SQL query to get the available quantity for the given book_id and shop_owner_id
    $query = "SELECT stock_quantity FROM book_shopowners  WHERE book_id = ? AND shop_owner_id = ?";
    
    if ($stmt = $conn->prepare($query)) {
        // Bind the parameters (book_id and shop_owner_id) to the query
        $stmt->bind_param("ii", $book_id, $shop_owner_id);
        $stmt->execute();
        $stmt->bind_result($available_quantity);
        $stmt->fetch();
        
        // Close the statement
        $stmt->close();
        
        // Check if the available quantity is greater than or equal to the requested quantity
        if ($available_quantity >= $requested_quantity) {
            return true; // Enough stock available
        } else {
            return false; // Not enough stock
        }
    } else {
        echo "Error executing query: " . $conn->error;
        return false;
    }
}


function cart_items($reader_id) {
    global $conn;

    $query = "
    SELECT books.bookcover, books.title, c.book_id, c.shop_owner_id, c.amount, bs.price, (c.amount * bs.price) AS total_price,c.cart_id
    FROM cart c
    JOIN book_shopowners bs ON c.book_id = bs.book_id AND c.shop_owner_id = bs.shop_owner_id
    JOIN books ON books.book_id = c.book_id
    WHERE c.reader_id = ?
";

// Initialize the prepared statement
$stmt = $conn->prepare($query);

// Bind the reader_id parameter
$stmt->bind_param("i", $reader_id);

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
?>
   
