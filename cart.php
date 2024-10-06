<?php
session_start();
include 'backend/basicOperation.php';

$subtotal = 0; // Initialize subtotal
$grand_total = 0; // Initialize grand total

if (!empty($_SESSION['user_id'])) {
    $cart_items = cart_items($_SESSION['user_id']);

    // Calculate subtotal and grand total
    if (!empty($cart_items)) {
        foreach ($cart_items as $item) {
            $subtotal += $item['price'] * $item['amount']; // Add price * quantity for each item
        }
    }

    $grand_total = $subtotal; // You can add shipping, tax, or discounts here if applicable
}

?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pustok - Book Store HTML Template</title>
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
    </style>
</head>

<body>
    <div class="site-wrapper" id="top">
        <div class="site-header header-2 mb--20 d-none d-lg-block">
            <div class="header-middle pt--10 pb--10">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <a href="index.html" class="site-brand">
                                <img src="image/logo6.png" alt="">
                            </a>
                        </div>
                        <div class="col-lg-5">
                            <div class="header-search-block">
                                <input type="text" placeholder="Search entire store here">
                                <button>Search</button>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="main-navigation flex-lg-right">
                                <div class="cart-widget">
                                    <?php if(empty($_SESSION['username'])){ ?>
                                    <div class="login-block">
                                        <a href="sign-in.php" class="font-weight-bold">Login</a><br>
                                        <span>or</span><a href="sign-up.php">Register</a>
                                    </div>
                                    <?php } ?>

                                    <?php if(!empty($_SESSION['username'])) { ?>
                                    <div class="profile">
                                        <div class="profile-pic">
                                            <img src="image/dashboard/dp1.png" alt="">
                                        </div>
                                        <div class="name-and-location">
                                            <p><a href="account-reader.php">  <?php echo $_SESSION['username']; ?> </a></p>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="cart-block">
                                        <div class="cart-total">
                                            <span class="text-number">1</span>
                                            <span class="text-item">Shopping Cart</span>
                                            <span class="price">£0.00 <i class="fas fa-chevron-down"></i></span>
                                        </div>
                                        <div class="cart-dropdown-block">
                                            <div class="single-cart-block">
                                                <div class="cart-product">
                                                    <a href="product-details.html" class="image">
                                                        <img src="image/products/cart-product-1.jpg" alt="">
                                                    </a>
                                                    <div class="content">
                                                        <h3 class="title"><a href="product-details.html">Kodak PIXPRO Astro Zoom AZ421 16 MP</a></h3>
                                                        <p class="price"><span class="qty">1 ×</span> £87.34</p>
                                                        <button class="cross-btn"><i class="fas fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-cart-block">
                                                <div class="btn-block">
                                                    <a href="cart.html" class="btn">View Cart <i class="fas fa-chevron-right"></i></a>
                                                    <a href="checkout.html" class="btn btn--primary">Check Out <i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- @include('menu.htm') -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom bg-primary">
                <div class="container">
                    <!-- Menu and other elements -->
                </div>
            </div>
        </div>
        <div class="breadcrumb-section">
            <div class="container">
                <div class="breadcrumb-contents">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Cart Page Start -->
        <main class="cart-page-main-block inner-page-sec-padding-bottom">
            <div class="cart_area cart-area-padding">
                <div class="container">
                    <div class="page-section-title">
                        <h1>Shopping Cart</h1>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="#" class="">
                                <!-- Cart Table -->
                                <div class="cart-table table-responsive mb--40">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="pro-remove"></th>
                                                <th class="pro-thumbnail">Image</th>
                                                <th class="pro-title">Product</th>
                                                <th class="pro-price">Price</th>
                                                <th class="pro-quantity">Quantity</th>
                                                <th class="pro-subtotal">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($cart_items)) { ?>
                                            <?php foreach ($cart_items as $item) { ?>
                                            <tr>
                                                <td class="pro-remove">
                                                    <form method="GET">
                                                        <input type="hidden" name="delete_cart_id" value="<?php echo $item['cart_id']; ?>">
                                                        <button type="submit" name="delete_cart" class="delete-cart-button">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td class="pro-thumbnail"><a href="#"><img src="image/book-cover/<?php echo $item['bookcover']; ?>" alt="Product"></a></td>
                                                <td class="pro-title"><a href="#"><?php echo $item['title']; ?></a></td>
                                                <td class="pro-price"><span><?php echo $item['price'] . " TK"; ?></span></td>
                                                <td class="pro-quantity">
                                                    <div class="pro-qty">
                                                        <div class="count-input-block">
                                                            <input type="number" class="form-control text-center" value="<?php echo $item['amount']; ?>">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="pro-subtotal"><span><?php echo $item['price'] * $item['amount'] . " TK"; ?></span></td>
                                            </tr>
                                            <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cart-section-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-12 mb--30 mb-lg--0">
                            <!-- Any additional block or slider can go here -->
                        </div>
                        <div class="col-lg-6 col-12 d-flex">
                            <div class="cart-summary">
                                <div class="cart-summary-wrap">
                                    <h4><span>Cart Summary</span></h4>
                                    <p>Sub Total <span class="text-primary"><?php echo $subtotal; ?> TK</span></p>
                                    <p>Shipping Cost <span class="text-primary">FREE</span></p>
                                    <h2>Grand Total <span class="text-primary"><?php echo $grand_total; ?> TK</span></h2>
                                </div>
                                <div class="cart-summary-button">
								<form method="POST" action="bkash_payment.php">
    <input type="hidden" name="cart_id" value="<?php echo $_SESSION['cart_id']; ?>"> <!-- Pass cart_id from session -->
    <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
    <button type="submit">Pay with bKash</button>
</form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Cart Page End -->
    </div>
    <!-- Footer Area -->
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
    <script src="js/plugins.js"></script>
    <script src="js/ajax-mail.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
