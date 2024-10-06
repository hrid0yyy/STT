<?php  
ob_start();
session_start();
include "backend/basicOperation.php";
include "backend/logout.php";
if (!empty($_SESSION['user_id'])) {
    $cart_items = cart_items($_SESSION['user_id']);
}


// Establish a database connection (update credentials as needed)
$db = new PDO("mysql:host=localhost;dbname=stt_db", 'root', '');

// Check if book_id and shop_owner_id are set in the URL
if (isset($_GET['book_id']) && isset($_GET['shop_owner_id'])) {
    // Sanitize and capture the book_id and shop_owner_id from the URL
    $book_id = htmlspecialchars($_GET['book_id']);
    $shop_owner_id = htmlspecialchars($_GET['shop_owner_id']);

    // Prepare the SQL query to fetch the book details
    $sql = "SELECT books.book_id,quality, books.title,genre, books.description, book_shopowners.price, books.bookcover, 
                   authors.name AS author_name, 
                   shopowners.shop_name, shopowners.city,shopowners.address,stock_quantity ,shopowners.shop_owner_id,shopowners.phone_number
            FROM books 
            JOIN authors ON books.author_id = authors.author_id 
            JOIN book_shopowners ON books.book_id = book_shopowners.book_id 
            JOIN shopowners ON book_shopowners.shop_owner_id = shopowners.shop_owner_id 
            WHERE books.book_id = :book_id AND shopowners.shop_owner_id = :shop_owner_id";

    // Prepare the SQL statement
    $stmt = $db->prepare($sql);

    // Bind the parameters to prevent SQL injection
    $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $stmt->bindParam(':shop_owner_id', $shop_owner_id, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch the book details from the database
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

}

function getReviewsByShopOwnerAndBook($db, $shop_owner_id, $book_id) {
    // SQL query to fetch reviews
    $query = "
        SELECT rd.reader_auto_id,r.ReviewID, rd.first_name, rd.profile_pic, r.ReviewText, r.ReviewDate, b.title, s.shop_name
        FROM Reviews r
        JOIN books b ON r.BookID = b.book_id
        JOIN shopowners s ON r.ShopOwnerID = s.shop_owner_id
        JOIN readers rd ON r.ReviewerID = rd.reader_auto_id
        WHERE r.ShopOwnerID = :shop_owner_id
        AND r.BookID = :book_id
    ";

    // Prepare and execute the SQL query
    $stmt = $db->prepare($query);
    $stmt->bindParam(':shop_owner_id', $shop_owner_id, PDO::PARAM_INT);
    $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the results
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get total number of rows (reviews)
    $total_reviews = $stmt->rowCount();

    // Return both the reviews and total count
    return [
        'reviews' => $reviews,
        'total_reviews' => $total_reviews
    ];
}
   
function doesPurchaseExist($db, $reader_id, $book_id, $shop_owner_id) {
    // SQL query to check if a purchase exists with the given parameters
    $query = "SELECT * FROM `purchase` WHERE reader_id = ? AND book_id = ? AND shop_owner_id = ?";
    
    // Prepare the SQL statement
    $stmt = $db->prepare($query);
    
    // Bind the parameters to prevent SQL injection
    $stmt->bindParam(1, $reader_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $book_id, PDO::PARAM_INT);
    $stmt->bindParam(3, $shop_owner_id, PDO::PARAM_INT);
    
    // Execute the query
    $stmt->execute();
    
    // Check if any row exists
    if ($stmt->rowCount() > 0) {
        // If at least one row exists, return true
        return true;
    } else {
        // If no row exists, return false
        return false;
    }
}
function getUserReaction($db, $review_id, $reader_id) {
    // SQL query to check if a user liked or disliked the review
    $query = "
        SELECT Reaction 
        FROM ReviewReactions 
        WHERE ReviewID = :review_id 
        AND ReaderID = :reader_id
    ";

    // Prepare the SQL statement
    $stmt = $db->prepare($query);

    // Bind the parameters to the query
    $stmt->bindParam(':review_id', $review_id, PDO::PARAM_INT);
    $stmt->bindParam(':reader_id', $reader_id, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch the result (reaction)
    $reaction = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return the reaction if found, otherwise return 'None'
    if ($reaction) {
        return $reaction['Reaction']; // 'Like' or 'Dislike'
    } else {
        return 'None'; // No reaction found
    }
}

// Example usage
if (isset($_POST['addcart'])) {
    $book_id = $_POST['book_id'];
    $reader_id = $_POST['reader_id']; // Get from session or form
    $shop_owner_id = $_POST['shop_owner_id']; // Get from form or database

    // Check if the item is already in the cart
$query = 'SELECT amount FROM cart WHERE book_id = :book_id AND reader_id = :reader_id AND shop_owner_id = :shop_owner_id';
$stmt = $db->prepare($query);
$stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
$stmt->bindParam(':reader_id', $reader_id, PDO::PARAM_INT);
$stmt->bindParam(':shop_owner_id', $shop_owner_id, PDO::PARAM_INT);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    // If the item is already in the cart, update the amount by adding 1
    $updateQuery = 'UPDATE cart SET amount = amount + 1 WHERE book_id = :book_id AND reader_id = :reader_id AND shop_owner_id = :shop_owner_id';
    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $updateStmt->bindParam(':reader_id', $reader_id, PDO::PARAM_INT);
    $updateStmt->bindParam(':shop_owner_id', $shop_owner_id, PDO::PARAM_INT);
    $updateStmt->execute();
} else {
    // If the item is not in the cart, insert it with amount = 1
    $insertQuery = 'INSERT INTO cart (book_id, reader_id, shop_owner_id, amount) VALUES (:book_id, :reader_id, :shop_owner_id, 1)';
    $insertStmt = $db->prepare($insertQuery);
    $insertStmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $insertStmt->bindParam(':reader_id', $reader_id, PDO::PARAM_INT);
    $insertStmt->bindParam(':shop_owner_id', $shop_owner_id, PDO::PARAM_INT);
    $insertStmt->execute();
}


    // Redirect to the same page to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF'] . "?book_id=$book_id&shop_owner_id=$shop_owner_id");
    exit();
}


function getBookRating($book_id, $shop_owner_id) {
    // Assuming $db is the existing PDO connection
    global $db;

    // Initialize the variables to store the result
    $average_rating = 0;
    $total_ratings = 0;
    $ratings_distribution = [
        '5_star' => 0,
        '4_star' => 0,
        '3_star' => 0,
        '2_star' => 0,
        '1_star' => 0
    ];

    try {
        // Prepare SQL query to calculate floored average rating, count total ratings, and count individual star ratings
        $sql = "
            SELECT 
                FLOOR(AVG(star_rating)) AS average_rating, 
                COUNT(star_rating) AS total_ratings,
                SUM(CASE WHEN star_rating = 5 THEN 1 ELSE 0 END) AS five_star_ratings,
                SUM(CASE WHEN star_rating = 4 THEN 1 ELSE 0 END) AS four_star_ratings,
                SUM(CASE WHEN star_rating = 3 THEN 1 ELSE 0 END) AS three_star_ratings,
                SUM(CASE WHEN star_rating = 2 THEN 1 ELSE 0 END) AS two_star_ratings,
                SUM(CASE WHEN star_rating = 1 THEN 1 ELSE 0 END) AS one_star_ratings
            FROM ratings 
            WHERE book_id = :book_id AND shop_owner_id = :shop_owner_id";
        
        // Prepare the statement
        $stmt = $db->prepare($sql);
        
        // Bind the parameters
        $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        $stmt->bindParam(':shop_owner_id', $shop_owner_id, PDO::PARAM_INT);
        
        // Execute the query
        $stmt->execute();
        
        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Set the results if there are ratings
        if ($result && $result['total_ratings'] > 0) {
            $average_rating = $result['average_rating'];  // Floored average rating
            $total_ratings = $result['total_ratings'];
            
            // Individual star ratings distribution
            $ratings_distribution['5_star'] = $result['five_star_ratings'];
            $ratings_distribution['4_star'] = $result['four_star_ratings'];
            $ratings_distribution['3_star'] = $result['three_star_ratings'];
            $ratings_distribution['2_star'] = $result['two_star_ratings'];
            $ratings_distribution['1_star'] = $result['one_star_ratings'];
        }
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Return the average rating, total number of ratings, and individual rating counts
    return [
        'average_rating' => $average_rating, 
        'total_ratings' => $total_ratings,
        'ratings_distribution' => $ratings_distribution
    ];
}



$rating_info = getBookRating($book_id, $shop_owner_id);

$average_rating = $rating_info['average_rating'];
$total_ratings = $rating_info['total_ratings'];
$ratings_distribution = $rating_info['ratings_distribution']; // An Array

if ($total_ratings == 0) {
    // Calculate the percentage for each star rating
    $percentage_5_star = 0;
    $percentage_4_star =  0;
    $percentage_3_star = 0;
    $percentage_2_star =  0;
    $percentage_1_star =  0;

}


if ($total_ratings > 0) {
    // Calculate the percentage for each star rating
    $percentage_5_star = ($ratings_distribution['5_star'] / $total_ratings) * 100;
    $percentage_4_star = ($ratings_distribution['4_star'] / $total_ratings) * 100;
    $percentage_3_star = ($ratings_distribution['3_star'] / $total_ratings) * 100;
    $percentage_2_star = ($ratings_distribution['2_star'] / $total_ratings) * 100;
    $percentage_1_star = ($ratings_distribution['1_star'] / $total_ratings) * 100;

    // Optionally, round the percentages to two decimal places
    $percentage_5_star = round($percentage_5_star, 2);
    $percentage_4_star = round($percentage_4_star, 2);
    $percentage_3_star = round($percentage_3_star, 2);
    $percentage_2_star = round($percentage_2_star, 2);
    $percentage_1_star = round($percentage_1_star, 2);
}
function getUserRating($book_id, $shop_owner_id, $user_id) {
    // Assuming $db is the existing PDO connection
    global $db;

    try {
        // Prepare SQL query to get the star rating for a specific user, book, and shop owner
        $sql = "SELECT star_rating FROM ratings 
                WHERE book_id = :book_id AND shop_owner_id = :shop_owner_id AND reader_id = :reader_id";
        
        // Prepare the statement
        $stmt = $db->prepare($sql);
        
        // Bind the parameters
        $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        $stmt->bindParam(':shop_owner_id', $shop_owner_id, PDO::PARAM_INT);
        $stmt->bindParam(':reader_id', $user_id, PDO::PARAM_INT);
        
        // Execute the query
        $stmt->execute();
        
        // Fetch the result (the star rating)
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // If a rating exists, return the star rating, otherwise return null or a message
        if ($result) {
            return $result['star_rating'];
        } else {
            return false;
        }
        
    } catch (PDOException $e) {
        return 'Error: ' . $e->getMessage();
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home | Shelf To Tales</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Minified CSS Plugins for faster loading -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/plugins.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico">

    <style>
        /* General Styles */
        .profile-pic {
            width: 50px;
            height: 50px;
        }

        .login-block {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .header-btn {
            background-color: white;
            color: #4e4e4c;
            margin-top: 20px;
            padding: 5px 10px;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .header-btn:hover {
            color: #62ab00;
        }

        /* Book Details Page */
        .product-details-page {
            padding: 50px 0;
        }

        .product-details-section {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            align-items: flex-start;
        }

        .product-image {
            flex: 1;
            max-width: 400px;
        }

        .product-image img {
            width: 100%;
            border-radius: 10px;
        }

        .product-details-info {
            flex: 2;
        }

        .product-details-info .price-block {
            font-size: 1.5rem;
            font-weight: bold;
            margin: 20px 0;
        }

        .rate-app {
            margin-top: 20px;
        }

     
    .gold-star {
            color: #FFD700; /* Gold color */
            font-size: 24px; /* Adjust size as needed */
        }
        .ash-star {
            color: #C0C0C0; /* Ash/Gray color */
            font-size: 24px; /* Adjust size as needed */
        }
        .star {
    font-size: 40px; /* Adjust the size as needed */
    color: lightgray; /* Default ash/gray star */
    cursor: pointer;
    transition: color 0.3s ease-in-out; /* Smooth transition */
}

.star.gold {
    color: #FFD700; /* Gold color for selected stars */
}


        .add-to-cart-row, .compare-wishlist-row {
            margin-top: 20px;
        }

        .add-cart-btn, .add-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #62ab00;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .add-cart-btn:hover, .add-link:hover {
            background-color: #4a8b00;
        }

        .review-section {
            margin-top: 40px;
        }

        .review-black {
            padding: 20px;
            background-color: #f8f8f8;
            border-radius: 10px;
        }

        .comment-form {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .comment-form input {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .comment-form button {
            background-color: #62ab00;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
        }

        .comment-form button:hover {
            background-color: #4a8b00;
        }
        .helpful-buttons {
    display: flex;
    align-items: center;
    gap: 10px;
}

.helpful-buttons button {
    border: none;
    cursor: pointer;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s ease;
    padding: 0;
}


/* Hover effect to increase the icon size */
.like-btn:hover .icon-image,
.dislike-btn:hover .icon-image {
    transform: scale(1.5); /* Increase the size of the icon on hover */
}


    </style>
</head>

<body>


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
    
 <?php include 'image-search.php' ?>
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
                                        <a href="index.php">Home</a>
                                        
                                    </li>
                                    <!-- Shop -->
                                    <li class="menu-item mega-menu">
                                        <a href="javascript:void(0)">shop </a>
                                        
                                        
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

                                <li class="menu-item">
    <a href="notification-page.php" class="notification-link">
        Notification 
        <span class="text-number notification-badge">
            <?php $newNotifications = totalnotification($_SESSION['user_id']); ?>
            <?php echo $newNotifications; ?>
        </span>
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

<!-- PRODUCT DETAILS SECTION -->
<section class="product-details-page">
    <div class="container">
        <div class="product-details-section">
            <div class="product-image">
                <img src="image/book-cover/<?php echo $book['bookcover'] ?>" alt="Book Cover">
            </div>
            <div class="product-details-info">
                <p class="tag-block">Genre: <?php echo $book['genre'] ?></p>
                <h4 class="product-title"><?php echo $book['title'] ?></h4>
                <div class="rating">
        <?php
        // Display gold stars for the average rating
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $average_rating) {
                echo '<span class="gold-star">&#9733;</span>';  // Gold star
            } else {
                echo '<span class="ash-star">&#9733;</span>';   // Ash star (Unicode: &#9733;)
            }
        }
        ?>
    </div>
                <ul class="list-unstyled">
                    <li>Author: <a href="#" class="list-value font-weight-bold"><?php echo $book['author_name'] ?></a></li>
                    <br>
                    <li><?php echo $book['description'] ?></li>
                    <br>
                    <li>Shop Name: <span class="list-value"><?php echo $book['shop_name'] ?></span></li>
                    <li>Location: <span class="list-value"><?php echo $book['address'] ?>, <?php echo $book['city'] ?></span></li>
                    <li>Contact: <span class="list-value"><?php echo $book['phone_number'] ?></span></li>
                    <br>
                    <li>Availability: 
                    <?php if($book['stock_quantity'] > 0){ ?>    
                    <span class="list-value"><strong>In Stock</strong></span></li> <?php } ?>
                    <?php if($book['stock_quantity'] == 0) { ?>
                        <span class="list-value"><strong style="color: red;">Out Of Stock</strong>
</span></li> <?php } ?>           
                    
                </ul>
                <div class="price-block">৳<?php echo $book['price'] ?></div>
                
                <article class="product-details-article">
                    <p><?php echo $book['quality'] ?></p>
                </article>
                <div class="add-to-cart-row">
                    <form method = "POST">
                    <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['book_id']); ?>">
                            <input type="hidden" name="shop_owner_id" value="<?php echo htmlspecialchars($book['shop_owner_id']); ?>">
                            <input type="hidden" name="reader_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                    <button type="submit" class="add-link" name="addcart"><i class="fas fa-shopping-cart"></i>  Add to cart</button>

                    </form>
                </div>
                <div class="compare-wishlist-row">
    <a href="#" class="add-link" data-bs-toggle="modal" data-bs-target="#priceComparisonModal"><i class="fas fa-random"></i> Compare Prices</a>
</div>

            </div>
        </div>

        <!-- Reviews Section -->
        <div class="review-section">
            <div class="review-black">
                <?php
                $reviewData = getReviewsByShopOwnerAndBook($db, $shop_owner_id, $book_id);
                $user_id = $_SESSION['user_id']; // User ID from the session
                // Access reviews and total count
                $reviews = $reviewData['reviews'];
                $total_reviews = $reviewData['total_reviews'];
                ?>
                <div class="rate-app">
                    <h5>Rate this Book</h5>
                    <div class="stars">
                        <span class="star" data-value="1">&#9734;</span>
                        <span class="star" data-value="2">&#9734;</span>
                        <span class="star" data-value="3">&#9734;</span>
                        <span class="star" data-value="4">&#9734;</span>
                        <span class="star" data-value="5">&#9734;</span>
                    </div>
                    <?php  $user_rating = getUserRating($book_id, $shop_owner_id, $user_id); ?>
                    <p style="font-size: small; color: #62ab00;">
                        <?php if($user_rating){ ?> 
                            You have already rated this <?php echo $user_rating; ?> star
                        <?php } ?>
                    </p>

                </div>
                <style>
                    .rating-summary {
            margin-bottom: 20px;
        }

        .average-rating {
            font-size: 24px;
        }

        .rating-distribution {
            margin-top: 10px;
        }

        .rating-bar {
            display: flex;
            align-items: center;
        }

        .rating-bar span {
            width: 20px;
        }

        .bar {
            background-color: #555;
            height: 10px;
            width: 200px;
            margin-left: 10px;
            position: relative;
        }

        .fill {
            background-color: #4CAF50;
            height: 100%;
        }

        .review-section {
    margin-top: 20px;
    border-top: 1px solid #444;
    padding-top: 10px;
    color: #000000;
    /* Removed max-height and overflow-y */
}
        .review {
            margin-bottom: 15px;
        }

        .review-black {
            color: #000;
        }

        .comment-form {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        input[type="text"] {
            width: 70%;
            padding: 10px;
            border-radius: 5px;
            border: none;
        }

        button {
            padding: 10px;
            border-radius: 5px;
        }

        .product-details-info {
            padding-left: 20px;
        }

        .price-block {
            margin: 10px 0;
        }

        .add-to-cart-row {
            margin-top: 20px;
        }

        .compare-wishlist-row {
            margin-top: 10px;
        }

        #reviewSection {
            color: black;
        }
                </style>
                <div class="rating-summary" style="display:flex; justify-content:space-between;">
                    <div class="average-rating">
                    <?php
        // Display gold stars for the average rating
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $average_rating) {
                echo '<span class="gold-star">&#9733;</span>';  // Gold star
            } else {
                echo '<span class="ash-star">&#9733;</span>';   // Ash star (Unicode: &#9733;)
            }
        }
        ?>
                        <span class="total-ratings"><?php echo $total_ratings; ?> Rating</span>
                    </div>
                    <div class="rating-distribution">
                        <div class="rating-bar">
                            <span>5</span>
                            <div class="bar">
                                <div class="fill" style="width: <?php echo $percentage_5_star; ?>%;"></div>
                            </div>
                        </div>
                        <div class="rating-bar">
                            <span>4</span>
                            <div class="bar">
                                <div class="fill" style="width: <?php echo $percentage_4_star; ?>%;"></div>
                            </div>
                        </div>
                        <div class="rating-bar">
                            <span>3</span>
                            <div class="bar">
                                <div class="fill" style="width: <?php echo $percentage_3_star; ?>%;"></div>
                            </div>
                        </div>
                        <div class="rating-bar">
                            <span>2</span>
                            <div class="bar">
                                <div class="fill" style="width: <?php echo $percentage_2_star; ?>%;"></div>
                            </div>
                        </div>
                        <div class="rating-bar">
                            <span>1</span>
                            <div class="bar">
                                <div class="fill" style="width: <?php echo $percentage_1_star; ?>%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5>Reviews (<?php echo $total_reviews; ?>)</h5>
                <hr>
                <?php if($reviews){ foreach($reviews as $review) {  ?>
                <div class="review">
                    <div class="review-details">
                    <div style="display: flex; align-items: center; gap: 10px;">
    <img src="image/dashboard/<?php echo $review['profile_pic'] ?>" alt="Author Avatar" class="review-avatar" style="width: 40px; height: 40px; border-radius: 50%;">
    <div>
        <h6 style="margin: 0;"><strong><?php echo $review['first_name'] ?></strong> <span><?php echo $review['ReviewDate'] ?></span></h6>
    </div>
</div>
                        <p> <strong style="color: #62ab00;"><?php if(doesPurchaseExist($db,$_SESSION['user_id'],$book_id,$shop_owner_id)){ echo "Verified Purchase"; }  ?></strong></p>
                        <p><?php echo $review['ReviewText'] ?></p>
                        <!-- <small>1,500 people found this helpful</small> -->
                    </div>
                    <?php  if($review['reader_auto_id']!=$_SESSION['user_id']){ ?>
                    <div class="helpful-buttons">
                        <!-- Like Button with Icon -->
                        <button class="like-btn" title="Like" onclick="handleReaction(<?php echo $review['ReviewID']; ?>, 'Like')">
                            <img src="image/like.png" alt="Like" class="icon-img">
                        </button>
                  
                        <!-- Dislike Button with Icon -->
                        <button class="dislike-btn" title="Dislike" onclick="handleReaction(<?php echo $review['ReviewID']; ?>, 'Dislike')">
                            <img src="image/dislike.png" alt="Dislike" class="icon-img">
                        </button>
                    </div>
                    <?php 
                        $reaction = getUserReaction($db, $review['ReviewID'], $_SESSION['user_id']); 
                        if ($reaction == 'Like') {
                            echo '<p style="font-size: 12px; color: green;">You liked this review</p>';
                        } elseif ($reaction == 'Dislike') {
                            echo '<p style="font-size: 12px; color: red;">You disliked this review</p>';
                        }
                        ?>
               <?php }?>

                </div>
                <hr>
                <?php }} ?>

                <!-- Add Review Form -->
                <?php
                if (isset($_POST['post_review'])) {
                    // Get the form data
                    $reviewText = $_POST['reviewText'];
                    $book_id = $_POST['book_id'];
                    $shop_owner_id = $_POST['shop_owner_id'];
                
                    // Check if the user is logged in
                    if (!isset($_SESSION['user_id'])) {
                        // If the user is not logged in, redirect to login page or display an error
                        echo "You must be logged in to submit a review.";
                        exit;
                    }
                
                    // Get the user's ID from the session
                    $user_id = $_SESSION['user_id'];
                
                    // Database connection
                    try {
                        // Insert the review into the database
                        $query = "
                            INSERT INTO Reviews (BookID, ShopOwnerID, ReviewerID, ReviewText, ReviewDate)
                            VALUES (:book_id, :shop_owner_id, :reviewer_id, :review_text, NOW())
                        ";
                
                        $stmt = $db->prepare($query);
                        $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
                        $stmt->bindParam(':shop_owner_id', $shop_owner_id, PDO::PARAM_INT);
                        $stmt->bindParam(':reviewer_id', $user_id, PDO::PARAM_INT);
                        $stmt->bindParam(':review_text', $reviewText, PDO::PARAM_STR);
                
                        // Execute the query
                        if ($stmt->execute()) {
                            // Success message
                            echo "Review submitted successfully!";
                            // Redirect back to avoid form resubmission
                            header("Location: " . $_SERVER['PHP_SELF'] . "?book_id=$book_id&shop_owner_id=$shop_owner_id");
                            exit;
                        } else {
                            // Error message
                            echo "Failed to submit the review. Please try again.";
                        }
                    } catch (PDOException $e) {
                        // Handle any errors
                        echo "Database error: " . $e->getMessage();
                    }
                }
                

                    ?>


                <div id="writeReviewSection" class="comment-form">
                    <form  method="POST">
                        <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book_id); ?>">
                        <input type="hidden" name="shop_owner_id" value="<?php echo htmlspecialchars($shop_owner_id); ?>">
                        <input type="text" name="reviewText" id="reviewInput" placeholder="Write your review..." required style="width: 100%; padding: 10px; margin-bottom: 10px;">

                        <button type="submit" name="post_review" id="postReviewBtn" style="padding: 10px;">Post</button>

                    </form>
                </div>


            </div>
        </div>
    </div>
</section>

< <!--=================================
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

  <!-- Price and Rating Comparison Modal -->
<div class="modal fade" id="priceComparisonModal" tabindex="-1" aria-labelledby="priceComparisonLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="priceComparisonLabel">Price and Rating Comparison</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Dynamic content will be loaded here -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Shop Name</th>
                            <th>Price</th>
                            <th>Stock Status</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody id="comparisonTableBody">
                        <!-- Dynamic content loaded with JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>

// Dynamically set book_id, shop_owner_id, and user_id from PHP
var book_id = <?php echo $book_id; ?>;
var shop_owner_id = <?php echo $shop_owner_id; ?>;
var user_id = <?php echo $user_id; ?>;

// JavaScript to handle star rating click and fill stars with gold
document.querySelectorAll('.star').forEach(function(star) {
    star.addEventListener('click', function() {
        var rating = this.getAttribute('data-value'); // Get the selected star value
        var stars = document.querySelectorAll('.star');

        // Reset all stars to default (light gray)
        stars.forEach(function(star) {
            star.classList.remove('gold'); // Remove the gold class
        });

        // Fill the selected star and all the stars before it
        for (var i = 0; i < rating; i++) {
            stars[i].classList.add('gold'); // Add the gold class to stars
        }

        // Send the selected rating to the server using AJAX (as previously discussed)
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'submit_rating.php', true); // Submit to your PHP script
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                alert('Rating submitted successfully!');
            }
        };

        // Send the POST request with book_id, shop_owner_id, user_id, and rating
        var book_id = <?php echo $book_id; ?>;
        var shop_owner_id = <?php echo $shop_owner_id; ?>;
        var user_id = <?php echo $user_id; ?>;
        xhr.send('book_id=' + book_id + '&shop_owner_id=' + shop_owner_id + '&user_id=' + user_id + '&rating=' + rating);
    });
});

    function handleReaction(reviewId, reaction) {
    fetch('handle_reaction.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ review_id: reviewId, reaction: reaction })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'prompt') {
            if (confirm(data.message)) {
                // User confirmed to change their reaction
                fetch('handle_reaction.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ review_id: reviewId, reaction: reaction, change: true })
                })
                .then(response => response.json())
                .then(data => alert(data.message));
            }
        } else {
            alert(data.message);
        }
    });
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('priceComparisonModal');
    modal.addEventListener('show.bs.modal', function(event) {
        var bookId = <?php echo $book_id; ?>; // Book ID from PHP

        // Perform AJAX request to fetch price and rating comparison data
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'fetch_comparison_data.php?book_id=' + bookId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Parse the JSON response from the server
                var response = JSON.parse(xhr.responseText);

                // Clear any previous content
                var tableBody = document.getElementById('comparisonTableBody');
                tableBody.innerHTML = '';

                // Loop through each shop that has this book and add rows to the table
                response.forEach(function(shop) {
                    var row = document.createElement('tr');

                    var shopNameCell = document.createElement('td');
                    shopNameCell.textContent = shop.shop_name;
                    row.appendChild(shopNameCell);

                    var priceCell = document.createElement('td');
                    priceCell.textContent = '৳' + shop.price;
                    row.appendChild(priceCell);

                    var stockStatusCell = document.createElement('td');
                    stockStatusCell.textContent = shop.stock_quantity > 0 ? 'In Stock' : 'Out of Stock';
                    row.appendChild(stockStatusCell);

                    var ratingCell = document.createElement('td');
                    ratingCell.textContent = shop.rating + ' ⭐';
                    row.appendChild(ratingCell);

                    tableBody.appendChild(row);
                });
            }
        };
        xhr.send();
    });
});

</script>

    <!-- Use Minified Plugins Version For Fast Page Load -->
    <script src="js/plugins.js"></script>
    <script src="js/ajax-mail.js"></script>
    <script src="js/custom.js"></script>
    



</body>

</html>
<?php ob_end_flush(); ?>