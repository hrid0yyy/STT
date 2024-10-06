<?php  
session_start();
include "backend/basicOperation.php";
include "backend/logout.php";
include "genre-card.php";
if(!empty($_SESSION['user_id'])){
$cart_items  = cart_items($_SESSION['user_id']);
}
function displayAdvertisements() {
    global $conn; // Use the global connection

    // Fetch active advertisements
    $query = "SELECT b.title, ba.discount_percentage, ba.advertising_end_date, s.shop_name, b.bookcover, ba.book_id, ba.shop_owner_id
              FROM book_advertisements ba 
              JOIN books b ON ba.book_id = b.book_id 
              JOIN shopowners s ON ba.shop_owner_id = s.shop_owner_id 
              WHERE ba.status = 'active' AND ba.advertising_end_date > NOW()";
    
    $result = $conn->query($query);

    // Check if there are advertisements to display
    if ($result->num_rows > 0) {
        // Create the HTML structure for advertisements
        echo '<div class="swiper-container">';
        echo '<div class="swiper-wrapper">';

        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="swiper-slide">
                <!-- Book Card -->
                <div class="book-card">
                    <!-- Book Cover Image -->
                    <img class="book-image" src="image/book-cover/<?php echo htmlspecialchars($row['bookcover']); ?>" 
                         alt="Book cover image" 
                         onerror="this.onerror=null;this.src='image/book-cover/default.png';">

                    <!-- Book Details -->
                    <div class="book-details">
                        <h3 class="book-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p class="book-description">Enjoy <?php echo htmlspecialchars($row['discount_percentage']); ?>% discount!</p>
                        <div class="book-price">Discount: <?php echo htmlspecialchars($row['discount_percentage']); ?>%</div>
                        <div class="shop-name">
                            Shop Name: <?php echo htmlspecialchars($row['shop_name']); ?>
                        </div>
                        <div class="shop-name">
                            Ends on: <?php echo htmlspecialchars($row['advertising_end_date']); ?>
                        </div>
                    </div>

                    <!-- Action Buttons (Icons on hover) -->
                    <div class="action-buttons">
                        <!-- View Advertisement -->
                        <a href="book_details.php?book_id=<?php echo htmlspecialchars($row['book_id']); ?>&shop_owner_id=<?php echo htmlspecialchars($row['shop_owner_id']); ?>" class="openModalBtn">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }

        echo '</div>';
        echo '<div class="swiper-button-next"></div>';
        echo '<div class="swiper-button-prev"></div>';
        echo '<div class="swiper-pagination"></div>';
        echo '</div>';
    } else {
        echo "<p>No advertisements available.</p>";
    }
}
// Fetch top-rated books
$topRatedQuery = "
    SELECT b.book_id, b.title, b.bookcover, b.isbn, b.description,  AVG(r.star_rating) as average_rating
    FROM books b
    JOIN ratings r ON b.book_id = r.book_id
    GROUP BY b.book_id
    ORDER BY average_rating DESC
    LIMIT 5";
$topRatedResult = $conn->query($topRatedQuery);

// Fetch top seller books
$topSellerQuery = "
    SELECT b.book_id, b.title, b.bookcover, b.isbn, b.description, COUNT(p.purchase_id) AS total_sales
    FROM books b
    JOIN purchase p ON b.book_id = p.book_id
    GROUP BY b.book_id
    ORDER BY total_sales DESC
    LIMIT 5";
$topSellersResult = $conn->query($topSellerQuery);

// Fetch new arrivals based on created_at timestamp
$newArrivalQuery = "
    SELECT b.book_id, b.title, b.bookcover, b.isbn, b.description, b.created_at
    FROM books b
    ORDER BY b.created_at DESC
    LIMIT 5";
$newArrivalsResult = $conn->query($newArrivalQuery);

// Function to display books with price, description, etc.
function displayBooks($result) {
    if ($result && $result->num_rows > 0) {
        while ($book = $result->fetch_assoc()) {
            echo '<div class="book-card">';
            echo '<div class="book-cover">';
            echo '<img src="image/book-cover/' . htmlspecialchars($book['bookcover']) . '" alt="Book Cover">';
            echo '</div>';
            echo '<div class="book-info">';
            echo '<h3 class="book-title">' . htmlspecialchars($book['title']) . '</h3>';
            
            echo '<p class="book-isbn">ISBN: ' . htmlspecialchars($book['isbn']) . '</p>';
            echo '<p class="book-description">' . htmlspecialchars($book['description']) . '</p>';
            if (isset($book['average_rating'])) {
                echo '<p class="book-rating">Rating: ' . number_format($book['average_rating'], 2) . '/5</p>';
            }
            if (isset($book['total_sales'])) {
                echo '<p class="book-sales">Sold: ' . $book['total_sales'] . ' copies</p>';
            }
            if (isset($book['price'])) {
                echo '<p class="book-price">Price: $' . number_format($book['price'], 2) . '</p>';
            }
            echo '</div>'; // End of book-info
            echo '</div>'; // End of book-card
        }
    } else {
        echo '<p>No books available</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home | Shelf To Tales</title>
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
            /* border: 1px solid red; */
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap:1rem;
        }

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
                                    /* Basic styling for modal trigger button */
                                    h3, p {
            margin: 0;
        }

        .stars {
            display: flex;
            justify-content: flex-start;
        }

        .star {
            font-size: 30px;
            cursor: pointer;
            color: #888;
        }

        .star:hover, .star.selected {
            color: gold;
        }

        button {
            color: #62ab00;
            border: none;
            cursor: pointer;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            overflow: hidden;
        }

        .modal-content {
            background-color: #fff;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            max-height: 80vh;
            overflow-y: auto;
            border-radius: 10px;
            scroll-behavior: smooth;
        }

        /* Hide scrollbar in WebKit browsers (Chrome, Safari) */
        .modal-content::-webkit-scrollbar {
            display: none;
        }

        /* Optional scrollbar hiding for Firefox */
        .modal-content {
            scrollbar-width: none;
        }

        .modal-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .modal-close:hover, .modal-close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Review Section Styles */
        .comment-form {
            margin-top: 20px;
        }

        #writeReviewSection {
            margin-top: 50px;
        }





.modal-pricing-open-btn {
    padding: 10px 20px;
    background-color: #f3c300;
    color: white;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.modal-pricing-open-btn:hover {
    background-color: #d4af37;
}

/* Modal Styles */
.modal-pricing {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    justify-content: center;
    align-items: center;
}

.modal-pricing-content {
    background-color: #333;
    padding: 20px;
    border-radius: 10px;
    max-width: 1000px;
    width: 90%;
    text-align: center;
}

.modal-pricing-close {
    color: white;
    font-size: 30px;
    font-weight: bold;
    position: absolute;
    top: 20px;
    right: 20px;
    cursor: pointer;
}

/* Pricing section */
.modal-pricing-section {
    text-align: center;
}

.modal-pricing-section h1 {
    font-size: 2.5rem;
    margin-bottom: 50px;
}

.modal-pricing-plans {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.modal-pricing-plan {
    background-color: #444;
    padding: 20px;
    border-radius: 10px;
    transition: transform 0.3s;
}

.modal-pricing-plan:hover {
    transform: translateY(-10px);
}

.modal-pricing-plan h2 {
    font-size: 3rem;
    margin-bottom: 10px;
    color: #f3c300;
}

.modal-pricing-plan h3 {
    font-size: 1.5rem;
    margin-bottom: 20px;
    color: #d4af37;
}

.modal-pricing-plan p {
    margin-bottom: 10px;
    color: #ccc;
}

.modal-pricing-button {
    display: inline-block;
    padding: 10px 20px;
    color: white;
    background-color: #f3c300;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
}

.modal-pricing-button:hover {
    background-color: #e5b000;
}

@media (min-width: 768px) {
    .modal-pricing-plans {
        flex-direction: row;
        justify-content: center;
    }

    .modal-pricing-plan {
        flex: 1;
        max-width: 300px;
        margin: 0 10px;
    }
}
/* Section Styling */
header h1 {
    text-align: center;
    padding: 20px;
}

/* Tab Navigation */
.tabs {
    display: flex;
    justify-content: center;
    margin: 20px 0;
}

.tab-button {
    padding: 10px 20px;
    margin: 0 10px;
    border: none;
    background-color: #eee;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.tab-button.active {
    background-color: #8bc34a;
    color: white;
    font-weight: bold;
}

.tab-button:hover {
    background-color: #8bc34a;
    color: white;
}

.tab-content {
    display: none;
    text-align: center;
}

.tab-content.active {
    display: block;
}

/* Book Section Styling */
.book-section {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    padding: 20px;
}

/* Book Card Styling */
.book-card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    width: 200px;
    margin: 15px;
    padding: 15px;
    text-align: center;
}

.book-cover img {
    width: 100%;
    border-radius: 5px;
    margin-bottom: 10px;
}

.book-info h3 {
    font-size: 1.1em;
    color: #333;
}

.book-info p {
    margin: 5px 0;
}

.book-info .book-rating {
    color: #ff9800;
}

.book-info .book-sales {
    color: #2196f3;
}

.book-info .price {
    font-weight: bold;
    color: green;
    margin-top: 5px;
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
                        <div class="col-lg-3 ">
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
                                <ul class="main-menu menu-right ">
                                    <li class="menu-item ">
                                        <a href="javascript:void(0)">Home</a>
                                        
                                    </li>
                                    <!-- Shop -->
                                    <li class="menu-item mega-menu">
                                        <a href="book-list.php">shop </a>
                                        
                                        
                                    </li>
                                    
                                    <!-- Pages -->
                                    <li class="menu-item has-children">
										<a href="javascript:void(0)">Book<i
												class="fas fa-chevron-down dropdown-arrow"></i></a>
										<ul class="sub-menu">
											<li> <a href="book-list.php">Buy</a></li>
											<li> <a href="borrow-list.php">Borrow</a></li>
											<li> <a href="exchange-list.php">Exchange</a></li>
								
										</ul>
									</li>
                                    
                                 

                                     <!-- NOTIFICATION SYSTEM -->
                                     <?php if(!empty($_SESSION['user_id'])){?>
                                    <style>
                                       .menu-item {
                                                position: relative;
                                                display: inline-block;
                                            }

                                            .menu-item .hover-text {
                                                visibility: hidden;
                                                opacity: 0;
                                                background-color: #f0f0f0; /* Light background for contrast */
                                                color: #333; /* Darker text for readability */
                                                text-align: center;
                                                padding: 8px 12px;
                                                border-radius: 8px; /* Rounded corners */
                                                position: absolute;
                                                top: 120%; /* Slightly lower than the link */
                                                left: 50%;
                                                transform: translateX(-50%);
                                                white-space: nowrap;
                                                z-index: 1;
                                                transition: all 0.3s ease; /* Smooth transition */
                                                border: 1px solid #ddd; /* Subtle border */
                                                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Light shadow */
                                                font-size: 14px; /* Adjust font size */
                                            }

                                            .menu-item:hover .hover-text {
                                                visibility: visible;
                                                opacity: 1;
                                                top: 100%; /* Move up slightly when shown */
                                            }

                                            .menu-item .hover-text:before {
                                                content: '';
                                                position: absolute;
                                                bottom: 100%; /* Position above the hover text */
                                                left: 50%;
                                                transform: translateX(-50%);
                                                border-width: 8px;
                                                border-style: solid;
                                                border-color: transparent transparent #f0f0f0 transparent; /* Triangle pointing down */
                                            }

                                            .menu-item:hover a {
                                                color: #007bff; /* Change link color on hover */
                                            }


                               

                                    </style>

                                <?php include 'backend/notification.php'  ?>
                                <?php $newNotifications = totalnotification($_SESSION['user_id']); ?>
                                <li class="menu-item">
    <a href="notification-page.php" class="notification-link">
        Notification 
        <?php if ($newNotifications != 0){ ?>
        <span class="text-number notification-badge">
            <?php echo $newNotifications; ?>
        </span>
        <?php } ?>
    </a>

    <?php if($newNotifications > 0): ?>
        <span class="hover-text blink">
            <?php echo $newNotifications; ?> New Notifications
        </span>
    <?php else: ?>
        <span class="hover-text">
            No New Notifications
        </span>
    <?php endif; ?>
</li>

<style>
    .notification-badge {
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 3px 8px;
        font-weight: bold;
        font-size: 12px;
        position: relative;
        top: -2px;
    }

    /* Add blinking effect for hover-text when there are new notifications */
    .blink {
        animation: blink-animation 1s steps(5, start) infinite;
        color: red;
        font-weight: bold;
    }

    @keyframes blink-animation {
        to {
            visibility: hidden;
        }
    }

    /* Add some styling to the notification link to make it more noticeable */
    .notification-link {
        font-weight: bold;
        color: #333;
        text-decoration: none;
    }

    .notification-link:hover {
        color: #ff6347; /* Tomato color on hover */
    }
</style>
                                        <?php } ?>
                                     <!-- NOTIFICATION SYSTEM -->
                                 


                                   <!-- Log-Out -->
                                  
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
                            <nav class="category-nav   ">
                                <div>
                                    <button id="modal-pricing-open" class="category-trigger"><i
                                            class="fa fa-bars"></i>Pricing</button>
                                    
                                </div>
                            </nav>
                        </div>
                        <div class="col-lg-5">
                            <div class="header-search-block">
                                <input type="text" placeholder="Search">
                                <button>Search</button>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="main-navigation flex-lg-right">
                                <div class="cart-widget">

                                 <?php if(empty($_SESSION['username'])){  ?>
                                    <div class="login-block">
                                        <div class="login-block">
                                            <a href="sign-in.php" class="font-weight-bold">Login</a> <br>
                                        <span>or</span><a href="sign-up.php">Register</a>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if(!empty($_SESSION['username'])) { ?>
                                       
                                    
                                 
                                    

                                    <!-- username and user profile picture div -->

                                    <div class="profile">
                                        <div class="profile-pic">
                                            <img src="image/dashboard/dp1.png" alt="">
                                        </div>
                                        <div class="name-and-loation">
                                        <p style="color:black"><a href="account-reader.php">  <?php echo $_SESSION['username']; ?> </a> </p> 
                                       </div>    
                                    </div>
                            
                                    <!-- username and user profile picture div -->
                                     
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
                                                        <img src="image/book-cover/<?php echo $item['bookcover']; ?>" alt="">
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
            </div>
        </div>
    <br>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <style>
    /* General Swiper Styling */
        .swiper-container {
            width: 100%;
            padding: 20px 0;
            margin: 0 auto;
            position: relative;
        }

        .swiper-wrapper {
            display: flex;
        }

        .swiper-slide {
            flex: 0 0 calc(100% / 6 - 20px); /* 6 slides per view, with spacing */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Book Card Styling */
        .book-card {
            position: relative;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 180px;
            height: 500px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .book-card:hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .book-image {
            width: 100%;
            height: 220px;
            background-color: #eee;
            object-fit: cover;
        }

        .book-details {
            padding: 10px;
            text-align: left;
        }

        .book-title {
            font-size: 1.1em;
            margin: 0;
            color: #333;
            font-weight: bold;
        }

        .book-description {
            color: #777;
            margin: 8px 0;
            font-size: 0.9em;
            display: -webkit-box; /* Display as a webkit box for multi-line truncation */
            -webkit-line-clamp: 3; /* Limit to 3 lines */
            -webkit-box-orient: vertical; /* Set the box orientation to vertical */
            overflow: hidden; /* Hide the overflow text */
            text-overflow: ellipsis; /* Add ellipsis (...) to indicate overflow */

        }

        .book-price {
            font-size: 1.1em;
            color: #333;
            font-weight: bold;
        }

        .shop-name {
            color: #555;
            margin-top: 5px;
            font-size: 0.9em;
        }

        .action-buttons {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            z-index: 2;
            flex-direction: row;
            gap: 15px;
        }

        .book-card:hover .action-buttons {
            display: flex;
        }

        .action-buttons a {
            background-color: transparent;
            border: none;
            cursor: pointer;
            font-size: 1.8em;
            color: #fff;
            transition: color 0.3s ease;
        }

        .action-buttons a:hover {
            color: #62ab00;
        }
    </style>
<div class="section-title section-title--bordered">
        <h2>Book Recommendations</h2>
    </div>
    
    <!-- Tab Navigation -->
    <div class="tabs">
        <button class="tab-button active" onclick="openTab(event, 'topRated')">Top Rated</button>
        <button class="tab-button" onclick="openTab(event, 'topSellers')">Top Sellers</button>
        <button class="tab-button" onclick="openTab(event, 'newArrivals')">New Arrivals</button>
    </div>

    <!-- Tab Content Sections -->
    <div id="topRated" class="tab-content active">
        <h2>Top Rated</h2>
        <div class="book-section">
            <?php displayBooks($topRatedResult); ?>
            
        </div>
    </div>

    <div id="topSellers" class="tab-content">
        <h2>Top Sellers</h2>
        <div class="book-section">
            <?php displayBooks($topSellersResult); ?>
        </div>
    </div>

    <div id="newArrivals" class="tab-content">
        <h2>New Arrivals</h2>
        <div class="book-section">
            <?php displayBooks($newArrivalsResult); ?>
        </div>
    </div>
<br>
<?php card("Novel"); ?>
<br>
<?php card("Crime"); ?>




    <div class="section-title section-title--bordered">
        <h2>Discount Offer</h2>
    </div>
    <div class="ads-container">
        <?php displayAdvertisements(); ?>
    </div>
     <!-- Include Swiper.js JavaScript -->
     <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Swiper initialization script -->
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 6,
        spaceBetween: 20,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        loop: false,  // Looping is disabled for now
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 15,
            },
            1024: {
                slidesPerView: 6,
                spaceBetween: 20,
            }
        }
    });
</script>
        <br>
    <!--=================================
    Footer Area
===================================== -->
    <footer class="site-footer">
        <div class="container">
            <div class="row justify-content-between  section-padding">
                <div class=" col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-footer pb--40">
                        <div class="brand-footer footer-title">
                            <img src="image/logo6.png" alt="">
                        </div>
                        <div class="footer-contact">
                            <p><span class="label">Address:</span><span class="text">Example Street 98, HH2 BacHa, New
                                    York, USA</span></p>
                            <p><span class="label">Phone:</span><span class="text">+18088 234 5678</span></p>
                            <p><span class="label">Email:</span><span class="text">suport@hastech.com</span></p>
                        </div>
                    </div>
                </div>
                <div class=" col-xl-3 col-lg-2 col-sm-6">
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
                <div class=" col-xl-3 col-lg-2 col-sm-6">
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
                <div class=" col-xl-3 col-lg-4 col-sm-6">
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
                            <li class="single-social facebook"><a href=""><i class="ion ion-social-facebook"></i></a>
                            </li>
                            <li class="single-social twitter"><a href=""><i class="ion ion-social-twitter"></i></a></li>
                            <li class="single-social google"><a href=""><i
                                        class="ion ion-social-googleplus-outline"></i></a></li>
                            <li class="single-social youtube"><a href=""><i class="ion ion-social-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p class="copyright-heading">Suspendisse in auctor augue. Cras fermentum est ac fermentum tempor. Etiam
                    vel magna volutpat, posuere eros</p>
                <a href="#" class="payment-block">
                    <img src="image/icon/payment.png" alt="">
                </a>
                <p class="copyright-text">Copyright © 2019 <a href="#" class="author">Team Cipher Pol</a>. All Right Reserved.
                    <br>
                    Design By Team Cipher Pol</p>
            </div>
        </div>
    </footer>

    <!-- all modals  -->
    <!-- Product Modal -->

  


<!-- Button to open modal -->
<button id="openModalBtn">Open Product Modal</button>

<!-- Review Modal -->
<div id="productModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModalBtn">&times;</span>

        <!-- Product Details -->
        <div class="container">
            <div class="row mb--60">
                <div class="col-lg-5 mb--30">
                    <div>
                        <div class="single-slide">
                            <img src="image/products/product-details-1.jpg" alt="" style="width: 100%; border-radius: 8px;">
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 product-details-info">
                    <p class="tag-block">Genre: Romance</p>
                    <h4 class="product-title">Tare Ami Chuye Dekhi ni</h4>
                    <ul class="list-unstyled">
                        <li>Author: <a href="#" class="list-value font-weight-bold"> Mahbuba</a></li>
                        <li>Shop Name: <span class="list-value">মাহবুবের দুধের চা</span></li>
                        <li>Genre: <span class="list-value"> Romance</span></li>
                        <li>Availability: <span class="list-value"> In Stock</span></li>
                    </ul>
                    <div class="price-block">
                        <span class="price-new">£73.79</span>
                        <del class="price-old">£91.86</del>
                    </div>
                    <div class="rate-app">
                        <h5>Rate this Book</h5>
                        <p style="color:black;">Tell others what you think</p>
                        
                        <!-- Star Rating -->
                        <div class="stars">
                            <span class="star" data-value="1">&#9734;</span>
                            <span class="star" data-value="2">&#9734;</span>
                            <span class="star" data-value="3">&#9734;</span>
                            <span class="star" data-value="4">&#9734;</span>
                            <span class="star" data-value="5">&#9734;</span>
                        </div>

                        <button id="writeReviewBtn">Write a review</button>
                    </div>
                    <article class="product-details-article">
                        <h4 class="sr-only">Product Summary</h4>
                        <p style="color:black">Long printed dress with thin adjustable straps. V-neckline and wiring under the dust with ruffles at the bottom of the dress.</p>
                    </article>
                    <div class="add-to-cart-row">
                        <div class="add-cart-btn">
                            <a href="#" class="btn btn-outlined--primary"><span class="plus-icon">+</span>Add to Cart</a>
                        </div>
                    </div>
                    <div class="compare-wishlist-row">
                        <a href="#" class="add-link"><i class="fas fa-heart"></i>Add to Wish List</a>
                        <a href="#" class="add-link"><i class="fas fa-random"></i>See PDF</a>
                    </div>
                </div>
            </div>

            <!-- Ratings and Reviews -->
            <div class="sb-custom-tab review-tab">
                <ul class="nav nav-tabs nav-style-2">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-2" role="tab">
                            REVIEWS (1)
                        </a>
                    </li>
                </ul>
                <div class="rating-summary" style="display:flex; justify-content:space-between;">
                    <div class="average-rating">
                        <span class="rating-value">4.4</span>
                        <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                        <span class="total-ratings">152,316,990 ratings</span>
                    </div>
                    <div class="rating-distribution">
                        <div class="rating-bar">
                            <span>5</span>
                            <div class="bar">
                                <div class="fill" style="width: 80%;"></div>
                            </div>
                        </div>
                        <div class="rating-bar">
                            <span>4</span>
                            <div class="bar">
                                <div class="fill" style="width: 10%;"></div>
                            </div>
                        </div>
                        <div class="rating-bar">
                            <span>3</span>
                            <div class="bar">
                                <div class="fill" style="width: 5%;"></div>
                            </div>
                        </div>
                        <div class="rating-bar">
                            <span>2</span>
                            <div class="bar">
                                <div class="fill" style="width: 3%;"></div>
                            </div>
                        </div>
                        <div class="rating-bar">
                            <span>1</span>
                            <div class="bar">
                                <div class="fill" style="width: 2%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div id="reviewSection" class="review-section">
                <div class="review-black">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tab-2" role="tabpanel">
                            <article class="review-article">
                                <div class="avatar" style="display: flex; gap: 1rem;">
                                    <img src="image/icon/author-logo.png" alt="Author Avatar" style="width: 25px; height: 25px; border-radius: 50%;">
                                    <h6><strong>Humayun Ahmed </strong></h6> <span> (22/09/2024)</span>
                                </div>
                                <p style="margin-left: 2rem;color:#000000;">**** likhsen vai shei hoise</p>
                                <p style="color:#000000;"><small>1,500 people found this helpful</small></p>
                            </article>
                        </div>
                    </div>
                    <div class="helpful">
                        <button>Yes</button>
                        <button>No</button>
                    </div>
                </div>
            </div>

            <!-- Add Review Form -->
            <div id="writeReviewSection" class="comment-form">
                <input type="text" id="reviewInput" placeholder="Write your review..." />
                <button id="postReviewBtn">Post</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-pricing" class="modal-pricing">
        <div class="modal-pricing-content">
            <span class="modal-pricing-close">&times;</span>
            <section class="modal-pricing-section">
                <h1>Pick your plan</h1>
                <div class="modal-pricing-plans">
                    <!-- Single License Plan -->
                    <div class="modal-pricing-plan">
                        <h2>$59</h2>
                        <h3>Single License</h3>
                        <p>1 theme included</p>
                        <p>1 year of theme updates & support</p>
                        <p>20% off future purchases</p>
                        <a href="#" class="modal-pricing-button">View</a>
                    </div>

                    <!-- 1 Year Membership Plan -->
                    <div class="modal-pricing-plan">
                        <h2>$199</h2>
                        <h3>1 Year Membership</h3>
                        <p>All themes included</p>
                        <p>1 year of theme updates & support</p>
                        <p>Access all new themes</p>
                        <a href="#" class="modal-pricing-button">Sign up today</a>
                    </div>

                    <!-- Forever Membership Plan -->
                    <div class="modal-pricing-plan">
                        <h2>$399</h2>
                        <h3>Forever Membership</h3>
                        <p>1 theme included</p>
                        <p>Unlimited theme updates & support</p>
                        <p>20% off future purchases</p>
                        <a href="#" class="modal-pricing-button">Sign up today</a>
                    </div>
                </div>
            </section>
        </div>
    </div>



    <!-- Use Minified Plugins Version For Fast Page Load -->
    <script src="js/plugins.js"></script>
    <script src="js/ajax-mail.js"></script>
    <script src="js/custom.js"></script>
    
<!-- JavaScript for Tab Navigation -->
<script>
        function openTab(evt, tabName) {
            var i, tabcontent, tabbuttons;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tabbuttons = document.getElementsByClassName("tab-button");
            for (i = 0; i < tabbuttons.length; i++) {
                tabbuttons[i].classList.remove("active");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.classList.add("active");
        }

        // Show default tab
        document.getElementById("topRated").style.display = "block";
    </script>


</body>

</html>