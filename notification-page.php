<!DOCTYPE html>

<?php

   include 'backend/borrow.php';
   include 'backend/basicOperation.php';
   session_start();
   $cart_items  = cart_items($_SESSION['user_id']);

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
        .card-image img{
            width: 50px;
            height: 129.77px;
        }
        .login-block{
            /* border: 1px solid red; */
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap:1rem;
        }
        /* Modal background */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4); /* Black background with opacity */
            transition: opacity 0.3s ease;
        }

        /* Modal content */
        .modal-content {
            background-color: #fff;
            margin: 10% auto; /* 10% from the top and centered */
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        /* Modal header (Close button) */
        .close {
            color: #aaa;
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #333;
            text-decoration: none;
        }

        /* Modal title */
        .modal-content h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        /* Form styling */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="number"],
        input[type="text"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        button[type="submit"] {
            background-color:#62ab00;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #537b1d;
        }
        .btn-block{
            /* border:1px solid red; */
            display:flex;
            justify-content:center;
            align-items:center;
            gap:1rem;
            margin-left:6rem;
            margin-top:2rem;
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
                            <div class="header-phone ">
                                <div class="icon">
                                    <i class="fas fa-headphones-alt"></i>
                                </div>
                                <div class="text">
                                    <p>Free Support 24/7</p>
                                    <p class="font-weight-bold number">+880164-5194-634</p>
                                </div>
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
                                    <!-- Blog -->
                                    <li class="menu-item mega-menu">
                                        <a href="javascript:void(0)">Blog </a>
                                        
                                    </li>
                                    <li class="menu-item">
                                        <a href="contact.html">Contact</a>
                                    </li>
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
                                    <a href="javascript:void(0)" class="category-trigger"><i
                                            class="fa fa-bars"></i>Browse
                                        categories</a>
                                    <ul class="category-menu">
                                        <li class="cat-item has-children">
                                            <a href="#">Arts & Photography</a>
                                            <ul class="sub-menu">
                                                <li><a href="#">Bags & Cases</a></li>
                                                <li><a href="#">Binoculars & Scopes</a></li>
                                                <li><a href="#">Digital Cameras</a></li>
                                                <li><a href="#">Film Photography</a></li>
                                                <li><a href="#">Lighting & Studio</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item has-children mega-menu"><a href="#">Biographies</a>
                                            <ul class="sub-menu">
                                                <li class="single-block">
                                                    <h3 class="title">WHEEL SIMULATORS</h3>
                                                    <ul>
                                                        <li><a href="#">Bags & Cases</a></li>
                                                        <li><a href="#">Binoculars & Scopes</a></li>
                                                        <li><a href="#">Digital Cameras</a></li>
                                                        <li><a href="#">Film Photography</a></li>
                                                        <li><a href="#">Lighting & Studio</a></li>
                                                    </ul>
                                                </li>
                                                <li class="single-block">
                                                    <h3 class="title">WHEEL SIMULATORS</h3>
                                                    <ul>
                                                        <li><a href="#">Bags & Cases</a></li>
                                                        <li><a href="#">Binoculars & Scopes</a></li>
                                                        <li><a href="#">Digital Cameras</a></li>
                                                        <li><a href="#">Film Photography</a></li>
                                                        <li><a href="#">Lighting & Studio</a></li>
                                                    </ul>
                                                </li>
                                                <li class="single-block">
                                                    <h3 class="title">WHEEL SIMULATORS</h3>
                                                    <ul>
                                                        <li><a href="#">Bags & Cases</a></li>
                                                        <li><a href="#">Binoculars & Scopes</a></li>
                                                        <li><a href="#">Digital Cameras</a></li>
                                                        <li><a href="#">Film Photography</a></li>
                                                        <li><a href="#">Lighting & Studio</a></li>
                                                    </ul>
                                                </li>
                                                <li class="single-block">
                                                    <h3 class="title">WHEEL SIMULATORS</h3>
                                                    <ul>
                                                        <li><a href="#">Bags & Cases</a></li>
                                                        <li><a href="#">Binoculars & Scopes</a></li>
                                                        <li><a href="#">Digital Cameras</a></li>
                                                        <li><a href="#">Film Photography</a></li>
                                                        <li><a href="#">Lighting & Studio</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="cat-item has-children"><a href="#">Business & Money</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item has-children"><a href="#">Calendars</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item has-children"><a href="#">Children's Books</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item has-children"><a href="#">Comics</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item"><a href="#">Perfomance Filters</a></li>
                                        <li class="cat-item has-children"><a href="#">Cookbooks</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item "><a href="#">Accessories</a></li>
                                        <li class="cat-item "><a href="#">Education</a></li>
                                        <li class="cat-item hidden-menu-item"><a href="#">Indoor Living</a></li>
                                        <li class="cat-item"><a href="#" class="js-expand-hidden-menu">More
                                                Categories</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="col-lg-5">
                            <div class="header-search-block">
                            <form action="#" method="POST" style="">
            <input type="text" name="search_item" placeholder="Search" >
                    <button type="submit" name="search" style="height:3.25rem;display:flex;justify-content:center;align-items:center">
                    
                    Search</button>
        </form>
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
                                        <p><a href="account-reader.php">  <?php echo $_SESSION['username']; ?> </a> </p> 
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
        <div class="site-mobile-menu">
            <header class="mobile-header d-block d-lg-none pt--10 pb-md--10">
                <div class="container">
                    <div class="row align-items-sm-end align-items-center">
                        <div class="col-md-4 col-7">
                            <a href="index.html" class="site-brand">
                                <img src="image/logo6.png" alt="">
                            </a>
                        </div>
                        <div class="col-md-5 order-3 order-md-2">
                            <nav class="category-nav   ">
                                <div>
                                    <a href="javascript:void(0)" class="category-trigger"><i
                                            class="fa fa-bars"></i>Browse
                                        categories</a>
                                    <ul class="category-menu">
                                        <li class="cat-item has-children">
                                            <a href="#">Arts & Photography</a>
                                            <ul class="sub-menu">
                                                <li><a href="#">Bags & Cases</a></li>
                                                <li><a href="#">Binoculars & Scopes</a></li>
                                                <li><a href="#">Digital Cameras</a></li>
                                                <li><a href="#">Film Photography</a></li>
                                                <li><a href="#">Lighting & Studio</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item has-children mega-menu"><a href="#">Biographies</a>
                                            <ul class="sub-menu">
                                                <li class="single-block">
                                                    <h3 class="title">WHEEL SIMULATORS</h3>
                                                    <ul>
                                                        <li><a href="#">Bags & Cases</a></li>
                                                        <li><a href="#">Binoculars & Scopes</a></li>
                                                        <li><a href="#">Digital Cameras</a></li>
                                                        <li><a href="#">Film Photography</a></li>
                                                        <li><a href="#">Lighting & Studio</a></li>
                                                    </ul>
                                                </li>
                                                <li class="single-block">
                                                    <h3 class="title">WHEEL SIMULATORS</h3>
                                                    <ul>
                                                        <li><a href="#">Bags & Cases</a></li>
                                                        <li><a href="#">Binoculars & Scopes</a></li>
                                                        <li><a href="#">Digital Cameras</a></li>
                                                        <li><a href="#">Film Photography</a></li>
                                                        <li><a href="#">Lighting & Studio</a></li>
                                                    </ul>
                                                </li>
                                                <li class="single-block">
                                                    <h3 class="title">WHEEL SIMULATORS</h3>
                                                    <ul>
                                                        <li><a href="#">Bags & Cases</a></li>
                                                        <li><a href="#">Binoculars & Scopes</a></li>
                                                        <li><a href="#">Digital Cameras</a></li>
                                                        <li><a href="#">Film Photography</a></li>
                                                        <li><a href="#">Lighting & Studio</a></li>
                                                    </ul>
                                                </li>
                                                <li class="single-block">
                                                    <h3 class="title">WHEEL SIMULATORS</h3>
                                                    <ul>
                                                        <li><a href="#">Bags & Cases</a></li>
                                                        <li><a href="#">Binoculars & Scopes</a></li>
                                                        <li><a href="#">Digital Cameras</a></li>
                                                        <li><a href="#">Film Photography</a></li>
                                                        <li><a href="#">Lighting & Studio</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="cat-item has-children"><a href="#">Business & Money</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item has-children"><a href="#">Calendars</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item has-children"><a href="#">Children's Books</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item has-children"><a href="#">Comics</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item"><a href="#">Perfomance Filters</a></li>
                                        <li class="cat-item has-children"><a href="#">Cookbooks</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Brake Tools</a></li>
                                                <li><a href="">Driveshafts</a></li>
                                                <li><a href="">Emergency Brake</a></li>
                                                <li><a href="">Spools</a></li>
                                            </ul>
                                        </li>
                                        <li class="cat-item "><a href="#">Accessories</a></li>
                                        <li class="cat-item "><a href="#">Education</a></li>
                                        <li class="cat-item hidden-menu-item"><a href="#">Indoor Living</a></li>
                                        <li class="cat-item"><a href="#" class="js-expand-hidden-menu">More
                                                Categories</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="col-md-3 col-5  order-md-3 text-right">
                            <div class="mobile-header-btns header-top-widget">
                                <ul class="header-links">
                                    <li class="sin-link">
                                        <a href="cart.html" class="cart-link link-icon"><i class="ion-bag"></i></a>
                                    </li>
                                    <li class="sin-link">
                                        <a href="javascript:" class="link-icon hamburgur-icon off-canvas-btn"><i
                                                class="ion-navicon"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!--Off Canvas Navigation Start-->
            <aside class="off-canvas-wrapper">
                <div class="btn-close-off-canvas">
                    <i class="ion-android-close"></i>
                </div>
                <div class="off-canvas-inner">
                    <!-- search box start -->
                    <div class="search-box offcanvas">
                        <form>
                            <input type="text" placeholder="Search Here">
                            <button class="search-btn"><i class="ion-ios-search-strong"></i></button>
                        </form>
                    </div>
                    <!-- search box end -->
                    <!-- mobile menu start -->
                    <div class="mobile-navigation">
                        <!-- mobile menu navigation start -->
                        <nav class="off-canvas-nav">
                            <ul class="mobile-menu main-mobile-menu">
                                <li class="menu-item-">
                                    <a href="index.php">Home</a>
                                    
                                </li>
                                <li class="menu-item-">
                                    <a href="#">Blog</a>
                                    
                                </li>
                                <li class="menu-item">
                                    <a href="#">Shop</a>
                                    
                                </li>
                                <li class="menu-item-">
                                    <a href="#">Pages</a>
                                    
                                </li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </nav>
                        <!-- mobile menu navigation end -->
                    </div>
                    <!-- mobile menu end -->
                    <nav class="off-canvas-nav">
                        <ul class="mobile-menu menu-block-2">
                            <li class="menu-item-has-children">
                                <a href="#">Currency - USD $ <i class="fas fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li> <a href="cart.html">USD $</a></li>
                                    <li> <a href="checkout.html">EUR €</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Lang - Eng<i class="fas fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li>Eng</li>
                                    <li>Ban</li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">My Account <i class="fas fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="">My Account</a></li>
                                    <li><a href="">Order History</a></li>
                                    <li><a href="">Transactions</a></li>
                                    <li><a href="">Downloads</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <div class="off-canvas-bottom">
                        <div class="contact-list mb--10">
                            <a href="" class="sin-contact"><i class="fas fa-mobile-alt"></i>(12345) 78790220</a>
                            <a href="" class="sin-contact"><i class="fas fa-envelope"></i>examle@handart.com</a>
                        </div>
                        <div class="off-canvas-social">
                            <a href="#" class="single-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="single-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="single-icon"><i class="fas fa-rss"></i></a>
                            <a href="#" class="single-icon"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="single-icon"><i class="fab fa-google-plus-g"></i></a>
                            <a href="#" class="single-icon"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </aside>
            <!--Off Canvas Navigation End-->
        </div>
        <div class="sticky-init fixed-header common-sticky">
            <div class="container d-none d-lg-block">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <a href="index.html" class="site-brand">
                            <img src="image/logo6.png" alt="">
                        </a>
                    </div>
                    <div class="col-lg-8">
                        <div class="main-navigation flex-lg-right">
                            <ul class="main-menu menu-right ">
                                <li class="menu-item ">
                                    <a href="index.php">Home </a>
                                    
                                </li>
                                <!-- Shop -->
                                <li class="menu-item  mega-menu">
                                    <a href="javascript:void(0)">shop</a>
                                    
                                </li>
                                <!-- Pages -->
                                <li class="menu-item ">
                                    <a href="javascript:void(0)">Faqs </a>
                                    
                                </li>
                                <!-- Blog -->
                                <li class="menu-item mega-menu">
                                    <a href="javascript:void(0)">Blog </a>
                                    
                                </li>
                                <li class="menu-item">
                                    <a href="contact.html">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		<!-- notification -->
       <style>
           .notification-container {
            width: 90%;
            max-width: 700px;
            margin: 20px auto;
            padding: 15px;
            background-color: #fff;
            border-left: 5px solid #62ab00;
            border-radius: 5px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .notification-container:hover {
            background-color: #f1f9eb;
        }

        .notification-icon {
            flex-shrink: 0;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #62ab00;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 20px;
            margin-right: 15px;
        }

        .notification-details {
            flex-grow: 1;
        }

        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .notification-time {
            font-size: 12px;
            color: #999;
        }

        .notification-content {
            margin-top: 5px;
            line-height: 1.6;
            color: #555;
        }

        .notification-content p {
            margin: 0;
        }
       </style>
                       <?php
function timeAgo($time_ago) {
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed;
    $minutes    = round($seconds / 60);
    $hours      = round($seconds / 3600);
    $days       = round($seconds / 86400);
    $weeks      = round($seconds / 604800);
    $months     = round($seconds / 2600640);
    $years      = round($seconds / 31207680);
    
    // Seconds ago
    if ($seconds <= 60) {
        return "just now";
    }
    // Minutes ago
    else if ($minutes <= 60) {
        return "$minutes mins ago";
    }
    // Hours ago
    else if ($hours <= 24) {
        return "$hours hours ago";
    }
    // Days ago
    else if ($days <= 7) {
        return "$days days ago";
    }
    // Weeks ago
    else if ($weeks <= 4.3) { // 4.3 weeks = 1 month
        return "$weeks weeks ago";
    }
    // Months ago
    else if ($months <= 12) {
        return "$months months ago";
    }
    // Years ago
    else {
        return "$years years ago";
    }
}
?>
 <?php 
include 'backend/notification.php';

// Handle the selection input (default to "requests")
$filter = isset($_POST['filter']) ? $_POST['filter'] : 'requests';
?>

<!-- Filter Form -->
<style>
    /* Style for the form container */
    .filter-form {
        display: flex;
        flex-direction: column;
        max-width: 300px;
        margin: 20px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Style for the label */
    .filter-form label {
        font-family: 'Arial', sans-serif;
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 8px;
        color: #333;
    }

    /* Style for the select dropdown */
    .filter-form select {
        padding: 10px;
        font-size: 16px;
        font-family: 'Arial', sans-serif;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        color: #333;
        outline: none;
        transition: border-color 0.3s;
    }

    /* Change border color on focus */
    .filter-form select:focus {
        border-color: #62ab00;
    }

    /* Style the entire form when the select is submitted */
    .filter-form select:hover {
        border-color: #62ab00;
        cursor: pointer;
    }

    /* Style for centering the form */
    .filter-form-container {
        text-align: center;
    }

    /* Style for submit button (if you plan to add one) */
    .filter-form button {
        margin-top: 15px;
        padding: 10px 20px;
        background-color: #62ab00;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    /* Change button color on hover */
    .filter-form button:hover {
        background-color: #558a00;
    }
</style>

<!-- Form Container -->
<div class="filter-form-container">
    <form method="POST" action="" class="filter-form">
        <label for="filter">Select Notification Type:</label>
        <select name="filter" id="filter" onchange="this.form.submit()">
            <option value="requests" <?php if ($filter == 'requests') echo 'selected'; ?>>Exchange Requests</option>
            <option value="responses" <?php if ($filter == 'responses') echo 'selected'; ?>>Responses</option>
        </select>
    </form>
</div>


<?php
// Display notifications based on the selected filter
if ($filter == 'requests') {
    $res = getExchangeRequests($_SESSION['user_id']);
    if($res){
        foreach($res as $r){ 
            updateNotificationStatusToSeen($r['notification_id'], "Requestee");
?>
    <div class="notification-container">
        <div class="notification-icon">🔔</div>
        <div class="notification-details">
            <div class="notification-header">
                <span class="notification-title">Book Exchange Request</span>
                <span class="notification-time"><?php echo timeAgo($r['request_date']); ?></span>
            </div>
            <div class="notification-content">
                <p><strong>Requestor:</strong> <?php echo $r['requestor_name']; ?>, <?php echo $r['requestor_phone_number']; ?></p>
                <p><strong>Book:</strong> <?php echo $r['requestor_book']; ?></p>
                <p><?php echo $r['requestor_name']; ?> wants to exchange his <?php echo $r['requestor_book']; ?> with your <?php echo $r['requestee_book']; ?>.
                <br>Go to your <a href="exchange-books-reader.php" style="color: #62ab00">dashboard</a> to give a response.</p>
            </div>
        </div>
    </div>
<?php
        }
    } else {
        echo "<p>No exchange requests found.</p>";
    }
} elseif ($filter == 'responses') {
    $res = getResponse($_SESSION['user_id']);
    if($res){
        foreach($res as $r){ 
            updateNotificationStatusToSeen($r['notification_id'], "Requestor");
?>
    <div class="notification-container">
        <div class="notification-icon">🔔</div>
        <div class="notification-details">
            <div class="notification-header">
                <span class="notification-title">Update of Book Exchange Request</span>
                <span class="notification-time"><?php echo timeAgo($r['response_date']); ?></span>
            </div>
            <div class="notification-content">
                <p><strong>Owner:</strong> <?php echo $r['requestee_name']; ?>, <?php echo $r['requestee_phone_number']; ?></p>
                <p><strong>Book:</strong> <?php echo $r['requestee_book']; ?></p>
                <p><?php echo $r['requestor_name']; ?> <?php echo $r['status']; ?> to exchange his <?php echo $r['requestor_book']; ?> with your <?php echo $r['requestee_book']; ?>.</p>
            </div>
        </div>
    </div>
<?php
        }
    } else {
        echo "<p>No responses found.</p>";
    }
}
?>

         


<!-- 
        <div class="notification-container">
        <div class="notification-icon">
            🔔
        </div>
        <div class="notification-details">
            <div class="notification-header">
                <span class="notification-title">New Book Exchange Request</span>
                <span class="notification-time">10 mins ago</span>
            </div>
            <div class="notification-content">
                <p><strong>Requester:</strong> John Doe</p>
                <p><strong>Book:</strong> "The Great Gatsby" - in good condition</p>
                <p><strong>Status:</strong> Pending</p>
                <p>John Doe is requesting to exchange your book "1984". Would you like to proceed?</p>
            </div>
        </div>
    </div> -->

        <!-- notification -->
			
	<br><br>
    
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
				<p class="copyright-text">Copyright © 2019 <a href="#" class="author">Pustok</a>. All Right Reserved.
					<br>
					Design By Pustok</p>
			</div>
		</div>
	</footer>
	<!-- Use Minified Plugins Version For Fast Page Load -->
	<script src="js/plugins.js"></script>
	<script src="js/ajax-mail.js"></script>
	<script src="js/custom.js"></script>

	
</body>

</html>