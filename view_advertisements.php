<?php
// Include database connection
include 'backend/shopowner/dbconnection.php';

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Advertisements</title>
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
</head>
<body>
    <h2>Current Advertisements</h2>
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
</body>
</html>
