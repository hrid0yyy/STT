<!DOCTYPE html>
<html lang="zxx">
<?php
  session_start();
  include 'backend/readers.php'; 
  include 'backend/logout.php';
  $reader = getReaderInfo($_SESSION['user_id']);
  include 'backend/basicOperation.php';
  $cart_items  = cart_items($_SESSION['user_id']); 
?>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Account | Shelf To Tales</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Use Minified Plugins Version For Fast Page Load -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/plugins.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico">
    <link rel="stylesheet" href="css/reader-dashboard-account.css">
    <link rel="stylesheet" href="css/book-shelf.css">
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

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 800px;
            position: relative;
        }

        .modal-content iframe {
            width: 100%;
            height: 500px;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 18px;
            cursor: pointer;
            padding: 2px;
            background-color: red;
            color: white;
            border-radius: 3px;
        }

        .bookshelf-container {
            display: flex;
            overflow-x: auto;
            white-space: nowrap; /* This will prevent the bookshelves from wrapping */
        }

        .shelf {
            margin-right: 20px; /* Add some spacing between bookshelves */
        }

        .book-list {
            display: flex;
            overflow-x: auto; /* Ensure that individual books within a shelf can scroll horizontally */
            white-space: nowrap;
        }
    </style>
</head>

<body>
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
                            <div class="header-phone ">
                                <!-- Image Search -->
                                <?php include 'image-search.php'; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="main-navigation flex-lg-right">
                                <ul class="main-menu menu-right ">
                                    <li class="menu-item"><a href="index.php">Home</a></li>
                                    <li class="menu-item mega-menu"><a href="javascript:void(0)">shop </a></li>
                                    <li class="menu-item has-children">
                                        <a href="javascript:void(0)">Book<i class="fas fa-chevron-down dropdown-arrow"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="book-list.php">Buy</a></li>
                                            <li><a href="borrow-list.php">Borrow</a></li>
                                            <li><a href="exchange-list.php">Exchange</a></li>
                                        </ul>
                                    </li>
                                    <form method="POST">
                                        <button type="submit" name="logout" class="logout-btn">LOGOUT</button>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reader Dashboard -->
        <section id="main-content">
            <section class="title-heading">Home > My Account</section>
            <section class="account-context">
                <div class="inner-account-context">
                    <div class="tablist">
                        <div class="profile">
                            <div class="dp"><img src="image/dashboard/<?php echo $reader['profile_pic']; ?>" alt=""></div>
                            <div class="name-and-location">
                                <p><?php echo $_SESSION['username']; ?></p>
                                <p>Dhaka, Bangladesh</p>
                            </div>
                        </div>

                        <!-- Filter Books by Writer and Genre -->
                        <form method="GET" action="book-shelf.php">
                            <div class="filter-bar">
                                <input type="text" name="filter_writer" placeholder="Filter by Writer" value="<?php echo isset($_GET['filter_writer']) ? $_GET['filter_writer'] : ''; ?>">
                                <select name="filter_genre">
                                    <option value="" disabled selected>Select Genre</option>
                                    <?php
                                    $genre_query = "SELECT genre_id, genre_name FROM genre";
                                    $genre_result = $conn->query($genre_query);
                                    if ($genre_result->num_rows > 0) {
                                        while ($genre_row = $genre_result->fetch_assoc()) {
                                            $selected = isset($_GET['filter_genre']) && $_GET['filter_genre'] == $genre_row['genre_id'] ? 'selected' : '';
                                            echo '<option value="' . $genre_row['genre_id'] . '" ' . $selected . '>' . $genre_row['genre_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="submit" value="Filter Books">
                            </div>
                        </form>

                        <!-- Add Book Form -->
                        <div class="bookshelf-container">
                            <div class="shelf">
                                <div class="row-header">
                                    <form action="upload.php" method="POST" enctype="multipart/form-data">
                                        <input type="text" name="book_title" placeholder="Book Title" required>
                                        <input type="text" name="writer" placeholder="Writer" required>
                                        <select name="genre_id" required>
                                            <option value="" disabled selected>Select Genre</option>
                                            <?php
                                            $genre_query = "SELECT genre_id, genre_name FROM genre";
                                            $genre_result = $conn->query($genre_query);
                                            if ($genre_result->num_rows > 0) {
                                                while ($genre_row = $genre_result->fetch_assoc()) {
                                                    echo '<option value="' . $genre_row['genre_id'] . '">' . $genre_row['genre_name'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="file" name="pdf_file" accept="application/pdf" required>
                                        <input type="file" name="image_file" accept="image/*" required>
                                        <input class="add-book-btn" type="submit" name="upload_book" value="Upload Book">
                                    </form>
                                </div>
                            </div>

                            <!-- Display Books -->
                            <div class="shelf">
                                <div class="book-list">
                                    <?php
                                    include 'backend/dbconnection.php';

                                    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session after login

                                    // Fetch the list of books from the database
                                    $sql = "SELECT book_title, pdf_path, image_path FROM bookshelf_pdfs WHERE user_id = ?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("i", $user_id);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<div class="book" onclick="openModal(\'' . $row['pdf_path'] . '\')">';
                                            echo '<img src="' . $row['image_path'] . '" alt="Book Image">';
                                            echo '</div>';
                                        }
                                    } else {
                                        echo "No books uploaded.";
                                    }

                                    $stmt->close();
                                    $conn->close();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>

        <!-- Modal for Viewing PDFs -->
        <div id="pdfModal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeModal()">Close</span>
                <iframe id="pdfViewer" src="" frameborder="0"></iframe>
            </div>
        </div>

        <!-- Button to Add New Bookshelf -->
        <button type="button" id="add-bookshelf-btn">Add New Bookshelf</button>

        <script>
            function openModal(pdfUrl) {
                document.getElementById('pdfViewer').src = pdfUrl;
                document.getElementById('pdfModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('pdfModal').style.display = 'none';
                document.getElementById('pdfViewer').src = ''; // Clear the PDF when modal is closed
            }

            document.getElementById('add-bookshelf-btn').addEventListener('click', function() {
                var bookshelfContainer = document.querySelector('.bookshelf-container');
                
                // Create a new bookshelf
                var newShelf = document.createElement('div');
                newShelf.classList.add('shelf');
                
                // Add an empty book-list div inside the new shelf
                var bookList = document.createElement('div');
                bookList.classList.add('book-list');
                newShelf.appendChild(bookList);
                
                // Append the new shelf to the bookshelf container
                bookshelfContainer.appendChild(newShelf);
            });
        </script>

        <script src="js/plugins.js"></script>
        <script src="js/ajax-mail.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/reader-dashboard-account.js"></script>
    </div>
</body>
</html>
