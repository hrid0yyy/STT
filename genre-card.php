<?php
function card($genre_type) {
    // Database connection
    $db = new PDO("mysql:host=localhost;dbname=stt_db", 'root', '');


  

   // MySQLi connection
            $db = new mysqli("localhost", "root", "", "stt_db");

         
            // If no search, get all items with pagination and filter by genre
            $query = "SELECT DISTINCT books.book_id, books.title, books.description, price, books.bookcover, city, authors.name,  
                    shop_name, book_shopowners.shop_owner_id 
                    FROM books 
                    JOIN authors ON books.author_id = authors.author_id 
                    JOIN book_shopowners ON books.book_id = book_shopowners.book_id
                    JOIN shopowners ON book_shopowners.shop_owner_id = shopowners.shop_owner_id
                    WHERE genre = ?";

            $stmt = $db->prepare($query);

            $stmt->bind_param("s", $genre_type); // Bind the genre type parameter

            $stmt->execute(); // Execute the statement

            $result = $stmt->get_result(); // Get the result

            $books = $result->fetch_all(MYSQLI_ASSOC); // Fetch all records as associative array

            // Don't forget to close the statement and the connection after use
            $stmt->close();
            $db->close();

 
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        .action-buttons a,
        .action-buttons form button {
            background-color: transparent;
            border: none;
            cursor: pointer;
            font-size: 1.8em;
            color: #fff;
            transition: color 0.3s ease;
        }

        .action-buttons a:hover,
        .action-buttons form button:hover {
            color: #62ab00;
        }
        h3, p {
            margin: 0;
            color: #ffffff;
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
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            padding: 20px;
            border-radius: 8px;
            width: 700px;
            max-height: 80vh;
            overflow-y: auto;
            color: #000;
        }

        .close {
            float: right;
            cursor: pointer;
            font-size: 20px;
            color: #000;
        }

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
            max-height: 300px;
            overflow-y: scroll;
            border-top: 1px solid #444;
            padding-top: 10px;
            color: #000000;
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
</head>
<body>
    <!-- Genre Title -->
    <div class="section-title section-title--bordered">
        <h2><?php echo htmlspecialchars($genre_type); ?> BOOKS</h2>
    </div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
        <?php if (!empty($books)): ?>
    <?php foreach ($books as $book): ?>
        <div class="swiper-slide">
            <!-- Book Card -->
            <div class="book-card">
                <!-- Book Cover Image -->
                <img class="book-image" src="image/book-cover/<?php echo htmlspecialchars($book['bookcover']); ?>" 
                     alt="Book cover image" 
                     onerror="this.onerror=null;this.src='image/book-cover/default.png';">

                <!-- Book Details -->
                <div class="book-details">
                    <h3 class="book-title"><?php echo htmlspecialchars($book['title']); ?></h3>
                    <p class="book-description"><?php echo htmlspecialchars(substr($book['description'], 0, 100)); ?>...</p>
                    <div class="book-price">$<?php echo htmlspecialchars($book['price']); ?></div>
                    <div class="shop-name">
                        Author: <?php echo htmlspecialchars($book['name']); ?> <br>
                        Shop Name: <?php echo htmlspecialchars($book['shop_name']); ?>, <?php echo htmlspecialchars($book['city']); ?>
                    </div>
                </div>

                <!-- Action Buttons (Icons on hover) -->
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <div class="action-buttons">
                        <form method="post">
                            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['book_id']); ?>">
                            <input type="hidden" name="shop_owner_id" value="<?php echo htmlspecialchars($book['shop_owner_id']); ?>">
                            <input type="hidden" name="reader_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                            <!-- Add to Cart Icon -->
                            <button type="submit" name="add_to_cart" style="margin-left:-1rem"><i class="fas fa-shopping-cart"></i></button>
                        </form>

                        <!-- Wishlist Icon -->
                        <a href="#" style="margin-top:0.65rem;margin-left:-1rem"><i class="fas fa-heart"></i></a>

                        <!-- View Icon with dynamic modal trigger -->
                        <a style="margin-top:0.55rem;margin-left:-0.5rem" href="book_details.php?book_id=<?php echo htmlspecialchars($book['book_id']); ?>&shop_owner_id=<?php echo htmlspecialchars($book['shop_owner_id']); ?>" class="openModalBtn">
    <i class="fas fa-eye"></i>
</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

   
    <?php endforeach; ?>
<?php else: ?>
    <p>No books found matching your search.</p>
<?php endif; ?>

        </div>

        <!-- Slider navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- Pagination (optional) -->
        <div class="swiper-pagination"></div>
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
</body>
</html>
<?php } ?>