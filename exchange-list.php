<!DOCTYPE html>

<?php
   session_start(); // Make sure session is started
   include 'backend/exchange.php';
   include 'backend/basicOperation.php';
   if(!empty($_SESSION['user_id'])){
   $cart_items  = cart_items($_SESSION['user_id']);
   }
?>
<html lang="zxx">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Search List | Shelf Tales</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Use Minified Plugins Version For Fast Page Load -->
	<link rel="stylesheet" type="text/css" media="screen" href="css/plugins.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
	<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico">
	<style>
		 .profile-pic{
            width: 50px;
            height: 50px;
        }
        .login-block{
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap:1rem;
        }
        /* General styling for a beautiful book display */
        .book-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .book-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            transition: transform 0.2s;
        }
        .book-card:hover {
            transform: translateY(-10px);
        }
        .book-image {
            width: 100%;
            height: 400px;
            background-color: #eee;
            object-fit: cover;
        }
        .book-details {
            padding: 15px;
        }
        .book-title {
            font-size: 1.4em;
            margin: 0;
            color: #333;
        }
        .book-description {
            color: #777;
            margin: 10px 0;
        }
       
        .shop-name {
            color: #555;
            margin-top: 5px;
        }
        .action-buttons {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            gap: 10px;
        }
        .btn {

            background-color: #62ab00;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: white;
        }
        .wishlist-btn {
             margin-left: 0; /* Remove or reduce the left margin */
            background-color: transparent;
            color: #62ab00;
            border: 1px solid #62ab00;
        }
        .wishlist-btn:hover {
            background-color: #62ab00;
            color: white;
        }
        /* Pagination Styles */
        .pagination-block {
            text-align: center;
            padding-top: 20px;
        }
        .pagination-btns {
            list-style: none;
            display: inline-block;
            padding: 0;
            margin: 0;
        }
        .pagination-btns li {
            display: inline;
            margin-right: 5px;
        }
        .pagination-btns a {
            text-decoration: none;
            padding: 10px 15px;
            color: #62ab00;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .pagination-btns .active a {
            background-color: #62ab00;
            color: white;
        }
        /* Filter styles */
.filter-container {
    display: flex;
    justify-content: center; /* Aligns items to the left */
    margin: 10px 0; /* Reduces the top and bottom margin */
    flex-wrap: wrap; /* Allows wrapping for smaller screens */
    gap: 10px; /* Reduces the gap between elements */
}

.filter-container select,
.filter-container input {
    padding: 5px 10px; /* Reduces padding to make inputs smaller */
    border: 1px solid #ddd;
    border-radius: 5px;
    margin: 0; /* Ensure no extra margins around inputs */
}

.filter-btn {
    background-color: #62ab00;
    color: white;
    border: none;
    padding: 8px 15px; /* Reduced padding for a more compact button */
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.filter-btn:hover {
    background-color: #537b1d;
}
.dropdown-container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 100%;
    margin-bottom: 20px;
    transition: transform 0.2s;
}

.dropdown-container:hover {
    transform: translateY(-5px);
}

.dropdown-container label {
    font-size: 1.2em;
    margin-bottom: 10px;
    color: #333;
    display: block;
}

.dropdown-container select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1em;
    background-color: #f9f9f9;
}

.dropdown-container select:focus {
    outline: none;
    border-color: #62ab00;
}

.dropdown-container input[type="hidden"] {
    display: none; /* Keep hidden inputs out of view */
}
    </style>
</head>

<body>
    <!-- image search -->


<?php

use thiagoalessio\TesseractOCR\TesseractOCR;

require 'vendor/autoload.php';

$fileRead = ''; // Initialize this variable to store the OCR result
$uploadedFilePath = ''; // Initialize this variable to store the uploaded image path

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $file_name = $_FILES['file']['name'];
        $tmp_file = $_FILES['file']['tmp_name'];

        if (!session_id()) {
            session_start();
            $unq = session_id();
        }

        $upload_dir = 'uploads/';
        $file_name = uniqid() . '_' . time() . '_' . str_replace(array('!', "@", '#', '$', '%', '^', '&', ' ', '*', '(', ')', ':', ';', ',', '?', '/' . '\\', '~', '`', '-'), '_', strtolower($file_name));

        if (move_uploaded_file($tmp_file, 'uploads/' . $file_name)) {
            $uploadedFilePath = 'uploads/' . $file_name; // Store the uploaded file path

            try {
                $fileRead = (new TesseractOCR($uploadedFilePath))
                    ->executable('C:/Program Files/Tesseract-OCR/tesseract.exe') // Full path to Tesseract
                    ->setLanguage('eng')
                    ->run();
            } catch (Exception $e) {
                 $e->getMessage();
            }
        } else {
            
        }
    }
}

function findMatchingBooks($ocrText) {
    // Establish the database connection (replace with your DB connection details)
    $db = new PDO("mysql:host=localhost;dbname=stt_db", 'root', '');

    // Break the OCR text into words or chunks
    // Split the OCR text by new lines and filter out empty lines
    $chunks = array_filter(preg_split('/\r\n|\r|\n/', $ocrText));

    // Prepare the base SQL query
    $sql = "SELECT * FROM books 
            JOIN authors ON books.author_id = authors.author_id 
            WHERE books.title LIKE :chunk 
            OR authors.name LIKE :chunk";

    $stmt = $db->prepare($sql);
    
    // Initialize an empty array to store the results
    $results = [];

    // Loop through each chunk to search in the database
    foreach ($chunks as $chunk) {
        $chunk = "%$chunk%"; // Use wildcards to match any part of the text
        $stmt->bindParam(':chunk', $chunk, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the results
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Add the results to the final result array if any book matches
        if ($books) {
            $results = array_merge($results, $books);
        }
    }

    // Return the results
    return $results;
}

?>

<style>
        .btn-success,
        .btn-success:hover {
            background-color: #62ab00;
            border-color: #62ab00;
        }



        .modal-header {
            background-color: #62ab00;
            color: white;
        }

        .modal-content {
            border-radius: 10px;
            border: none;
        }

        .form-group label {
            color: #333;
        }

        .modal-footer .btn-success {
            width: 100%;
        }
   
</style>



    <!-- Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Image Upload Form -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="filechoose">Choose File</label>
                            <input type="file" name="file" class="form-control-file" id="filechoose" required>
                            <button class="btn btn-success mt-3" type="submit" name="submit">Upload</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Modal -->
    <div class="modal fade" id="resultsModal" tabindex="-1" aria-labelledby="resultsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultsModalLabel">Results</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if ($_POST && $uploadedFilePath) : ?>
                        <h4>Uploaded Image:</h4>
                        <img src="<?= $uploadedFilePath ?>" width="200" height="200" alt="Uploaded Image" class="img-fluid" />
                        <hr>
                      
                        <h4>Matching Books:</h4>
                        <?php
                        // Example usage with the OCR text
                        $ocrText = $fileRead;
                        $matchedBooks = findMatchingBooks($ocrText);

                        // Output the results
                        if ($matchedBooks) {
                            foreach ($matchedBooks as $book) {
                                echo "Book Title: " . $book['title'] . "<br>";
                                echo "Author Name: " . $book['name'] . "<br><hr>";
                                break;
                            }
                        } else {
                            echo "No matching books found.";
                        }
                        ?>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <?php if ($_POST && $uploadedFilePath) : ?>
        <!-- Trigger results modal -->
        <script>
            var resultsModal = new bootstrap.Modal(document.getElementById('resultsModal'));
            resultsModal.show();
        </script>
    <?php endif; ?>




<!-- image search -->
    <div class="site-wrapper" id="top">
        <div class="site-header d-none d-lg-block">
            <div class="header-middle pt--10 pb--10">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <a href="index.html" class="site-brand">
                                <img src="image/logo6.png" alt="">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <div class="header-phone">
                                  <!-- image search -->
    <style>
    .camera-btn {
        background: none;
        border: none;
        font-size: 24px;
        color: #62ab00; /* Set the camera icon color */
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .camera-btn i {
        margin-right: 8px; /* Space between icon and text */
    }

    .icon-text {
        font-size: 16px;
        color: #333; /* Text color for the text beside the icon */
    }

    .camera-btn:hover i {
        color: #4a8b00; /* Darken the color on hover */
    }
</style>

    <div class="icon">
    <button type="button" class="camera-btn" data-bs-toggle="modal" data-bs-target="#uploadModal">
        <i class="fas fa-camera ml-3"></i>
        <span class="icon-text">Image Search</span>
    </button>
        </div>

<!-- image search -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="main-navigation flex-lg-right">
                                <ul class="main-menu menu-right">
                                    <li class="menu-item">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="shop.php">Shop</a>
                                    </li>
                                    <li class="menu-item has-children">
										<a href="javascript:void(0)">Book<i
												class="fas fa-chevron-down dropdown-arrow"></i></a>
										<ul class="sub-menu">
											<li> <a href="book-list.php">Buy</a></li>
											<li> <a href="borrow-list.php">Borrow</a></li>
											<li> <a href="exchange-list.php">Exchange</a></li>
								
										</ul>
									</li>
                                    <style>
                                            .header-btn {
                                        background-color: white;
                                        color: #4e4e4c;
                                        margin-top: 20px;
                                        margin-left: 2px;
                                        padding: 5px 10px;
                                        font-size: 16px;
                                        border-radius: 4px;
                                        transition: background-color 0.3s ease, color 0.3s ease;
                                    }
                                    
                                    .header-btn:hover {
                                    
                                        color: #62ab00;
                                    }
                                    </style>
                                    <?php if(!empty($_SESSION['username'])){  ?>

<form method="POST">
    <button type="submit" name="logout" class="header-btn">LOGOUT</button>
</form>
         <?php  } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom pb--10">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <nav class="category-nav">
                                <a href="javascript:void(0)" class="category-trigger"><i class="fa fa-bars"></i>Browse categories</a>
                            </nav>
                        </div>
                        <div class="col-lg-5">
                            <div class="header-search-block">
                                <form action="" method="POST">
                                    <input type="text" name="search_item" placeholder="Search" value="<?php echo isset($_POST['search_item']) ? htmlspecialchars($_POST['search_item']) : ''; ?>">
                                    <button type="submit" name="search" style="height:3.25rem;display:flex;justify-content:center;align-items:center">Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="main-navigation flex-lg-right">
                                <div class="cart-widget">
                                <?php if(empty($_SESSION['username'])){  ?>
                                    <div class="login-block">
                                        <a href="sign-in.php" class="font-weight-bold">Login</a>
                                        <span>or</span><a href="sign-up.php">Register</a>
                                    </div>
                                <?php } else { ?>
                                    <div class="profile">
                                        <div class="profile-pic">
                                            <img src="image/dashboard/dp1.png" alt="">
                                        </div>
                                        <div class="name-and-loation">
                                        <p><a href="account-reader.php">  <?php echo $_SESSION['username']; ?> </a> </p> 
                                       </div>    
                                    </div>
                                <?php } ?>
                                 
                                <?php  if(!empty($_SESSION['user_id'])) { ?>
                                    <div class="cart-block">
                                        <div class="cart-total">
                                        <?php 
                                                $total = 0; // Initialize total
                                                if (!empty($cart_items)) { 
                                                    foreach ($cart_items as $item) {
                                                        $total += $item['total_price']; // Add each item's total price to the total
                                                    }
                                                }
                                                ?>
                                            <span class="text-number">
                                            <?php echo count($cart_items); // Display the number of items in the cart ?>
                                    
                                            </span>
                                            <span class="text-item">
                                                Shopping Cart
                                            </span>
                                            <span class="price">
                                            <?php echo $total ; ?>
                                                <i class="fas fa-chevron-down"></i>
                                            </span>
                                        </div>
                                        <div class="cart-dropdown-block">
                                        <?php if (!empty($cart_items)) { ?>
                                 <?php $total = 100; foreach ($cart_items as $item) { $total +=  $item['total_price'];?>
                                            <div class=" single-cart-block ">
                                                <div class="cart-product">
                                                    <a href="#" class="image">
                                                    <img class="book-image" src="image/book-cover/<?php echo htmlspecialchars($item['bookcover']); ?>" 
                                                            alt="Book cover image" 
                                                            onerror="this.onerror=null;this.src='image/book-cover/default.png';">
                                                    </a>
                                                    <div class="content">
                                                        <h3 class="title"><a href="product-details.html"><?php echo $item['title']; ?></a>
                                                        </h3>
                                                        <p class="price"><span class="qty"> <?php echo $item['amount']; ?> ×</span> <?php echo $item['price']; ?></p>
                                                        <button class="cross-btn"><i class="fas fa-times"></i></button>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                 <?php } ?>
                                 <?php } ?>
                                   
                                    
                                                                                
                                            <div class=" single-cart-block ">
                                                <div class="btn-block">
                                                    <a href="cart.php" class="btn">View Cart <i
                                                            class="fas fa-chevron-right"></i></a>
                                                    <a href="checkout.php" class="btn btn--primary">Check Out <i
                                                            class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
// Start session and initialize PDO connection

$db = new PDO("mysql:host=localhost;dbname=stt_db", 'root', '');

// Pagination settings
$books_per_page = 8; // Number of books per page
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get current page number, default is 1
$offset = ($current_page - 1) * $books_per_page; // Calculate the offset

// Initialize the search term and filter variables
$searchTerm = isset($_POST['search']) ? $_POST['search_item'] : '';
$genreFilter = isset($_POST['genre']) ? $_POST['genre'] : '';
$authorFilter = isset($_POST['author']) ? $_POST['author'] : '';
$cityFilter = isset($_POST['city']) ? $_POST['city'] : '';

// Build the base query
$query = "SELECT exchange_id,title,preferred_genre,bookcover,condition_image,description,first_name as owner_name,name,country
FROM exchange_books
JOIN readers on exchange_books.reader_id = readers.reader_auto_id
JOIN books on exchange_books.book_id = books.book_id
JOIN authors on books.author_id = authors.author_id
LEFT JOIN exchange_req AS eq1 ON exchange_books.exchange_id = eq1.requestor_exchange_id
LEFT JOIN exchange_req AS eq2 ON exchange_books.exchange_id = eq2.requestee_exchange_id
WHERE (eq1.status != 'accepted' OR eq1.status IS NULL) 
AND (eq2.status != 'accepted' OR eq2.status IS NULL)";  // Base WHERE clause

// Initialize parameters array for prepared statements
$params = [];

// Append search filters
if (!empty($searchTerm)) {
    $query .= " AND books.title LIKE :searchTerm";
    $params[':searchTerm'] = '%' . $searchTerm . '%';
}

if (!empty($genreFilter)) {
    $query .= " AND books.genre = :genre";
    $params[':genre'] = $genreFilter;
}

if (!empty($authorFilter)) {
    $query .= " AND authors.name = :author";
    $params[':author'] = $authorFilter;
}

if (!empty($cityFilter)) {
    $query .= " AND readers.city = :city";
    $params[':city'] = $cityFilter;
}

// Exclude the user's own books if they are logged in
if (!empty($_SESSION['user_id'])) {
    $query .= " AND readers.reader_auto_id != :current_user_id";
    $params[':current_user_id'] = $_SESSION['user_id'];
}

// Add pagination to the query
$query .= " LIMIT :limit OFFSET :offset";

// Prepare the statement
$stmt = $db->prepare($query);

// Bind the parameters
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}

// Bind pagination parameters separately
$stmt->bindValue(':limit', (int)$books_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

// Execute the query
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Count total books for pagination
$count_query = "SELECT COUNT(*) FROM exchange_books";
$total_books = $db->query($count_query)->fetchColumn();
$total_pages = ceil($total_books / $books_per_page); // Total pages

?>



          <!-- Filter Section -->
          <div class="container">
            <form method="POST">
                <div class="filter-container">
                    <select name="genre" id="genreFilter">
                        <option value="">All Genres</option>
                        <?php
                        $genres = genre();
                        foreach ($genres as $genre) {
                            echo '<option value="' . $genre['genre'] . '"' . ($genreFilter === $genre['genre'] ? ' selected' : '') . '>' . $genre['genre'] . '</option>';
                        }
                        ?>
                    </select>

                    <select name="author" id="authorFilter">
                        <option value="">All Authors</option>
                        <?php
                        $authors = authors();
                        foreach ($authors as $author) {
                            echo '<option value="' . $author['name'] . '"' . ($authorFilter === $author['name'] ? ' selected' : '') . '>' . $author['name'] . '</option>';
                        }
                        ?>
                    </select>

                    <select name="city" id="cityFilter">
                        <option value="">All Cities</option>
                        <?php
                        $cities = cities();
                        foreach ($cities as $city) {
                            echo '<option value="' . $city['city'] . '"' . ($cityFilter === $city['city'] ? ' selected' : '') . '>' . $city['city'] . '</option>';
                        }
                        ?>
                    </select>

                    <button type="submit" name="filter" class="filter-btn">Apply Filters</button>
                </div>
            </form>
        </div>
        <br>
        <!-- Book display -->
        <div class="book-container">
            <?php if (!empty($books)): ?>
                <?php foreach ($books as $book): ?>
                    <div class="book-card">
                        <!-- Book Cover Image -->
                        <img class="book-image" src="image/book-cover/<?php echo htmlspecialchars($book['bookcover']); ?>" 
                            alt="Book cover image" 
                            onerror="this.onerror=null;this.src='image/book-cover/default.png';">

                        <!-- Book Details -->
                        <div class="book-details">
                            <h3 class="book-title"><?php echo htmlspecialchars($book['title']); ?></h3>
                            <p class="book-description"><?php echo htmlspecialchars(substr($book['description'], 0, 100)); ?>...</p>
                           
                            <div class="shop-name">
                                Author: <?php echo htmlspecialchars($book['name']); ?> <br>
                                Owner: <?php echo htmlspecialchars($book['owner_name']); ?>, <?php echo htmlspecialchars($book['country']); ?> 
                                <br><a href="<?php echo htmlspecialchars($book['condition_image']); ?>" style = "color: #62ab00;">Book Condition</a>
                            </div>
                        </div>
          
                        <!-- Action Buttons -->
                        <div class="action-buttons">
                        <form method='post'>
                            <div class='dropdown-container'>
                                <label for='options'>Choose the book you want to exchange with:</label>
                                <select id='options' name='requester_book_id'>
    <?php 
    // Call the myExchangeBooks function to populate the options dynamically
 
    
    $myBooks = getAvailableBooksForExchangeByUser($_SESSION['user_id']);
   
    if ($myBooks){ 
        foreach ($myBooks as $myBook){ ?>
            <option value='<?php echo htmlspecialchars($myBook['requester_book_id']); ?>'>
                <?php echo htmlspecialchars($myBook['title']); ?>
            </option>
        <?php }
    }else{ ?>
        <option value=''>No books available for exchange</option>
    <?php } ?>
</select>

<?php 
// Add the hidden input fields outside the <select> tag
if ($myBooks):
    foreach ($myBooks as $myBook): ?>
        <input type='hidden' name='requestor_exchange_id' value='<?php echo htmlspecialchars($myBook['exchange_id']); ?>'>
    <?php endforeach;
endif;
?>

                            </div>
                            <br>
                           
                            <input type='hidden' name='requestee_exchange_id' value='<?php echo htmlspecialchars($book['exchange_id']); ?>'>
                            <button type='submit' name='exchange_btn' class='btn'>Apply</button>
                        </form>
                            

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No books available for exchange.</p>
            <?php endif;  ?>
        </div>
   

        <!-- Pagination -->
        <div class="pagination-block">
            <ul class="pagination-btns flex-center">
                <?php if ($current_page > 1): ?>
                    <li><a href="?page=1" class="single-btn prev-btn ">|<i class="zmdi zmdi-chevron-left"></i> </a></li>
                    <li><a href="?page=<?php echo $current_page - 1; ?>" class="single-btn prev-btn "><i class="zmdi zmdi-chevron-left"></i> </a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="<?php echo $i === $current_page ? 'active' : ''; ?>"><a href="?page=<?php echo $i; ?>" class="single-btn"><?php echo $i; ?></a></li>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <li><a href="?page=<?php echo $current_page + 1; ?>" class="single-btn next-btn"><i class="zmdi zmdi-chevron-right"></i></a></li>
                    <li><a href="?page=<?php echo $total_pages; ?>" class="single-btn next-btn"><i class="zmdi zmdi-chevron-right"></i>|</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <br>

<!--=================================
    Footer Area
===================================== -->
<footer class="site-footer">
		<div class="container">
			<div class="row justify-content-between section-padding">
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<div class="single-footer pb--40">
						<div class="brand-footer footer-title">
							<img src="image/logo6.png" alt="">
						</div>
						<div class="footer-contact">
							<p><span class="label">Address:</span><span class="text">Example Street 98, HH2 BacHa, New York, USA</span></p>
							<p><span class="label">Phone:</span><span class="text">+18088 234 5678</span></p>
							<p><span class="label">Email:</span><span class="text">suport@hastech.com</span></p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-2 col-sm-6">
					<div class="single-footer pb--40">
						<div class="footer-title">
							<h3>Information</h3>
						</div>
						<ul class="footer-list normal-list">
							<li><a href="">Prices drop</a></li>
							<li><a href="">New products</a></li>
							<li><a href="">Best sales</a></li>
							<li><a href="">Contact us</a></li>
							<li><a href="">Sitemap</a></li>
						</ul>
					</div>
				</div>
				<div class="col-xl-3 col-lg-2 col-sm-6">
					<div class="single-footer pb--40">
						<div class="footer-title">
							<h3>Extras</h3>
						</div>
						<ul class="footer-list normal-list">
							<li><a href="">Delivery</a></li>
							<li><a href="">About Us</a></li>
							<li><a href="">Stores</a></li>
							<li><a href="">Contact us</a></li>
							<li><a href="">Sitemap</a></li>
						</ul>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<div class="footer-title">
						<h3>Newsletter Subscribe</h3>
					</div>
					<div class="newsletter-form mb--30">
						<form action="./php/mail.php">
							<input type="email" class="form-control" placeholder="Enter Your Email Address Here...">
							<button class="btn btn--primary w-100">Subscribe</button>
						</form>
					</div>
					<div class="social-block">
						<h3 class="title">STAY CONNECTED</h3>
						<ul class="social-list list-inline">
							<li class="single-social facebook"><a href=""><i class="ion ion-social-facebook"></i></a></li>
							<li class="single-social twitter"><a href=""><i class="ion ion-social-twitter"></i></a></li>
							<li class="single-social google"><a href=""><i class="ion ion-social-googleplus-outline"></i></a></li>
							<li class="single-social youtube"><a href=""><i class="ion ion-social-youtube"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<p class="copyright-heading">Suspendisse in auctor augue. Cras fermentum est ac fermentum tempor. Etiam vel magna volutpat, posuere eros</p>
				<a href="#" class="payment-block">
					<img src="image/icon/payment.png" alt="">
				</a>
				<p class="copyright-text">Copyright © 2019 <a href="#" class="author">Pustok</a>. All Right Reserved. <br> Design By Pustok</p>
			</div>
		</div>
	</footer>
    <!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/ajax-mail.js"></script>
<script src="js/custom.js"></script>
<script>
  function confirmBorrow() {
    return confirm("Are you sure you want to proceed?");
  }
</script>	
	
</body>

</html>
