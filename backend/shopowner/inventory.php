<?php

include 'dbconnection.php';

function getItems($shop_owner_id){
    global $conn; 
   $selectQuery = "SELECT * from books join book_shopowners on books.book_id=book_shopowners.book_id where shop_owner_id = ?";
   $selectStmt = $conn->prepare($selectQuery);
   $selectStmt->bind_param("i", $shop_owner_id);

   if ($selectStmt->execute()) {
        $result = $selectStmt->get_result();
        $items = $result->fetch_all(MYSQLI_ASSOC);
        return $items; 
   }
   return null;
}


if(isset($_POST['addItems'])){
    $title = $_POST['book_name'];
    $quality = $_POST['quality'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    addItems($title,$_SESSION['user_id'],$quantity,$price,$quality);
}



function addItems($title,$shop_owner_id,$quantity,$price,$quality){


    global $conn;
    $sql = "SELECT * from books where title LIKE '%$title%'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
       

        $book = $result->fetch_assoc();
        $book_id = $book['book_id'];
        $sql = "INSERT INTO book_shopowners (book_id,shop_owner_id,stock_quantity,price,quality) VALUES ($book_id, $shop_owner_id, $quantity, $price, '$quality')";
        $check = $conn->query($sql);

        if(!$check){
            $sql = "UPDATE book_shopowners set stock_quantity = stock_quantity + $quantity where book_id = $book_id and shop_owner_id = $shop_owner_id and quality = '$quality'";
            $updated = $conn->query($sql);
            if($updated){
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Successfull!</strong> Stock Updated
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
            }
        }
      
     
     

    } else {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Hiyaa!</strong> This books is not available in Shelf to tales database , Please contact with the Admin.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }

}


?>