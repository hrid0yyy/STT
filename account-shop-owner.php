<!DOCTYPE html>
<html lang="zxx">
<?php
            session_start();
     include "backend/shopowner/myaccount.php";
     include "backend/logout.php";
     $details = account_details($_SESSION['user_id']);

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
    <link rel="stylesheet" href="css/account-shop-owner.css">
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
        .shop-details-container{
    margin-top: 3.5rem;;
    width:75%;
    /* border:1px solid red; */
}
.flex{
    /* border: 1px solid red; */
    width: 70%;
    display: flex;
    justify-content: space-between;
    
}
.flex input{
    width: 70%;
    height:3rem;
    font-size:1.5rem;
}
.flex-text{
    font-weight: bolder;
}
.save-btn{
    /* border: 1px solid red; */
    padding:10px 25px;
    color:#ffffff;
    background-color: #62ab00;
    border-radius:3px;
}
.btn-div{
    width: 70%;
    /* border:1px solid green; */
    display: flex;
    justify-content: flex-end;
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
                                        <a href="javascript:void(0)">Home</a>
                                        
                                    </li>
                                    <!-- Shop -->
                                    <li class="menu-item mega-menu">
                                        <a href="javascript:void(0)">shop </a>
                                        
                                        
                                    </li>
                                    <!-- Pages -->
                                    <li class="menu-item ">
                                        <a href="javascript:void(0)">Faqs</a>
                                        
                                    </li>
                                    <!-- Blog -->
                                    <li class="menu-item mega-menu">
                                        <a href="javascript:void(0)">Blog </a>
                                        
                                    </li>
                                    <style>
                                    .logout-btn {
                                        background-color: white;
                                        color: #4e4e4c;
                                        margin-top: 20px;
                                        margin-left: 2px;
                                        padding: 5px 10px;
                                        font-size: 16px;
                                        border-radius: 4px;
                                        transition: background-color 0.3s ease, color 0.3s ease;
                                    }
                                    
                                    .logout-btn:hover {
                                    
                                        color: #62ab00;
                                    }
                                </style>

                                <form method="POST">
                                    <button type="submit" name="logout" class="logout-btn">LOGOUT</button>
                                </form>
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
                                <input type="text" placeholder="Search">
                                <button>Search</button>
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
                                    <a href="#">Home</a>
                                    
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
                                    <a href="javascript:void(0)">Home </a>
                                    
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
        <!-- shop-owner dashboard -->
         <section id="main-content">
            <section class="title-heading">
                Home > My Account
            </section>
            <section class="account-context">
                <div class="inner-account-context">
                    <div class="tablist" style="border:none;">
                        <div class="profile">
                            <div class="dp">
                                <img src="image/dashboard/dp1.png" alt="">
                            </div>
                            <div class="name-and-loation">
                                <p><?php echo $_SESSION['username']; ?></p>
                                <p><?php echo $details['city']; ?>,Bangladesh</p>
                            </div>
                            
                        </div>
                        <div class="tabs">
                            <div class="tab-divs active">
                                <a href="account-shop-owner.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M16 7.992C16 3.58 12.416 0 8 0C3.584 0 0 3.58 0 7.992C0 10.422 1.104 12.612 2.832 14.082C2.848 14.098 2.864 14.098 2.864 14.114C3.008 14.226 3.152 14.338 3.312 14.45C3.392 14.498 3.456 14.561 3.536 14.625C4.8586 15.5202 6.41889 15.9991 8.016 16C9.61311 15.9991 11.1734 15.5202 12.496 14.625C12.576 14.577 12.64 14.514 12.72 14.465C12.864 14.354 13.024 14.242 13.168 14.13C13.184 14.114 13.2 14.114 13.2 14.098C14.896 12.611 16 10.422 16 7.992ZM8 14.993C6.496 14.993 5.12 14.513 3.984 13.714C4 13.586 4.032 13.459 4.064 13.331C4.15965 12.9842 4.29947 12.6512 4.48 12.34C4.656 12.036 4.864 11.764 5.12 11.524C5.36 11.284 5.648 11.061 5.936 10.885C6.24 10.709 6.56 10.581 6.912 10.485C7.26685 10.39 7.63264 10.3419 8 10.342C9.09075 10.3337 10.1415 10.7522 10.928 11.508C11.296 11.876 11.584 12.3077 11.792 12.803C11.904 13.091 11.984 13.3947 12.032 13.714C10.8512 14.5442 9.44343 14.9907 8 14.993ZM5.552 7.593C5.41131 7.27013 5.34043 6.92117 5.344 6.569C5.344 6.218 5.408 5.866 5.552 5.546C5.696 5.226 5.888 4.939 6.128 4.699C6.368 4.459 6.656 4.268 6.976 4.124C7.296 3.98 7.648 3.916 8 3.916C8.368 3.916 8.704 3.98 9.024 4.124C9.344 4.268 9.632 4.46 9.872 4.699C10.112 4.939 10.304 5.227 10.448 5.546C10.592 5.866 10.656 6.218 10.656 6.569C10.656 6.937 10.592 7.273 10.448 7.592C10.3098 7.9077 10.1145 8.19519 9.872 8.44C9.6271 8.68219 9.33963 8.87712 9.024 9.015C8.36272 9.28617 7.62128 9.28617 6.96 9.015C6.64437 8.87712 6.3569 8.68219 6.112 8.44C5.86925 8.19865 5.67864 7.91102 5.552 7.593ZM12.976 12.899C12.976 12.867 12.96 12.851 12.96 12.819C12.8029 12.3183 12.571 11.8443 12.272 11.413C11.9728 10.9786 11.6054 10.5953 11.184 10.278C10.8621 10.0357 10.5131 9.83169 10.144 9.67C10.3111 9.5582 10.4666 9.42989 10.608 9.287C10.8465 9.0515 11.056 8.7883 11.232 8.503C11.5876 7.92133 11.7707 7.25066 11.76 6.569C11.7652 6.06449 11.6672 5.56424 11.472 5.099C11.2795 4.65065 11.0025 4.24357 10.656 3.9C10.3092 3.56105 9.90226 3.28974 9.456 3.1C8.99007 2.90485 8.48911 2.80718 7.984 2.813C7.47882 2.8075 6.97786 2.90551 6.512 3.101C6.06084 3.28843 5.65256 3.56572 5.312 3.916C4.97128 4.26097 4.69973 4.66795 4.512 5.115C4.31678 5.58024 4.21877 6.08049 4.224 6.585C4.224 6.937 4.272 7.27267 4.368 7.592C4.464 7.928 4.592 8.232 4.768 8.519C4.928 8.807 5.152 9.063 5.392 9.303C5.536 9.447 5.696 9.57467 5.872 9.686C5.5013 9.85103 5.15206 10.0606 4.832 10.31C4.416 10.63 4.048 11.013 3.744 11.429C3.44227 11.8586 3.2101 12.3331 3.056 12.835C3.04 12.867 3.04 12.899 3.04 12.915C1.776 11.636 0.992 9.91 0.992 7.992C0.992 4.14 4.144 0.991 8 0.991C11.856 0.991 15.008 4.14 15.008 7.992C15.0059 9.83196 14.2753 11.5962 12.976 12.899Z" fill="white"/>
                                  </svg> <span class="tab-title">My Account</span> </a>
                            </div>
                            <div class="tab-divs ">
                                <a href="inventory.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <g clip-path="url(#clip0_171_10393)">
                                      <path d="M14.2657 5.0545L14.523 4.63C14.523 4.63 14.7495 4.2545 14.7495 3.75025C14.7495 2.52875 13.584 2.561 13.584 2.561L11.0448 1.86975L9.6595 0.5L7.83675 0.99625L7.239 0.8335L6.78475 1.28275L4.1605 1.99725C4.1605 1.99725 3.1505 1.9695 3.1505 3.028C3.1505 3.465 3.347 3.7905 3.347 3.7905L3.68475 4.348L3.388 4.641L1.923 5.04C1.923 5.04 0.7575 5.00775 0.7575 6.22925C0.759831 6.51384 0.826403 6.79423 0.95225 7.0495L0.5 7.49675L0.73725 7.59075C0.7425 7.6035 0.7445 7.61775 0.75475 7.628C1.2135 8.08775 1.17575 8.70525 1.11025 9.03875L0.833 9.3165L2.93325 10.3262L5.81775 15.0875C6.28 15.814 7.26125 15.3595 7.26125 15.3595L14.6735 11.7955L14.3962 11.5177C14.3307 11.1842 14.293 10.5667 14.7517 10.1067C14.762 10.0965 14.764 10.0822 14.7692 10.0697L15.0065 9.9755L13.6283 8.613L15.2107 7.85225L14.9705 7.6115C14.9137 7.3225 14.881 6.78725 15.2788 6.38875C15.2875 6.37975 15.289 6.36775 15.2937 6.3565L15.5 6.27475L14.2657 5.0545ZM12.8445 2.84575L12.532 3.34025L11.7235 2.54075L12.8445 2.84575ZM9.794 1.786L10.9548 3.02675L6.7575 4.5435L5.76625 3.0045L9.794 1.786ZM3.936 4.763L6.80025 9.49075L1.3435 7.32625L3.936 4.763ZM2.74225 5.27975L2.406 5.61225L2.2715 5.406L2.74225 5.27975ZM1.6805 5.53825L1.9935 6.02L1.31525 6.6905C1.26195 6.54249 1.23397 6.38656 1.2325 6.22925C1.2325 5.77275 1.459 5.599 1.6805 5.53825ZM1.2885 9.2565L1.29225 9.242L7.579 11.9937L1.3415 9.02025C1.34725 8.9865 1.35175 8.94925 1.3565 8.91175L6.23975 10.9567L1.3735 8.67775C1.37445 8.5736 1.36726 8.46953 1.352 8.3665L5.87175 10.2277L1.29125 8.1C1.26193 8.00147 1.22255 7.90622 1.17375 7.81575L7.3945 10.472L7.536 10.7055C7.82775 11.164 8.357 11.0792 8.62375 10.9997C8.9925 11.1817 9.6535 11.6027 9.48425 12.223C9.395 12.551 9.19875 12.71 8.8845 12.71C8.56625 12.71 8.2485 12.5435 8.24525 12.5412L1.2885 9.2565ZM7.55 12.5462L7.0585 12.7497L6.641 12.109L7.55 12.5462ZM5.6465 13.8915L3.71425 10.7017L5.63475 11.625L6.543 13.023C6.17675 13.1795 5.7675 13.5367 5.6465 13.8915ZM14.1547 10.8455C14.1395 10.9485 14.1323 11.0526 14.1333 11.1567L9.267 13.4357L14.1503 11.3907C14.155 11.428 14.1593 11.4655 14.1652 11.4992L7.92775 14.473L14.2145 11.7212L14.2183 11.7357L7.2615 15.02C7.25825 15.0222 6.941 15.1887 6.62225 15.1887C6.30775 15.1887 6.11175 15.0295 6.0225 14.7017C5.793 13.86 7.098 13.3827 7.1175 13.3755L8.26125 12.8875C8.384 12.9397 9.25975 13.2835 9.689 12.6087L9.95975 12.1622L14.3333 10.2947C14.2844 10.3852 14.2449 10.4805 14.2155 10.579L9.635 12.7067L14.1547 10.8455ZM14.1632 9.80525L10.457 11.3412L11.4855 9.6435L13.1772 8.83025L14.1632 9.80525ZM14.7615 7.0285C14.7483 7.1178 14.742 7.20798 14.7428 7.29825L10.5258 9.27325L14.7577 7.501C14.762 7.53325 14.7655 7.566 14.7708 7.595L9.36475 10.172L14.8132 7.78725L14.8165 7.79975L8.78725 10.6465C8.7845 10.6482 8.50925 10.7927 8.23325 10.7927C7.9605 10.7927 7.79075 10.6545 7.7135 10.3705C7.5145 9.641 8.6455 9.2275 8.6625 9.22125L14.916 6.55125C14.8739 6.62979 14.8398 6.71237 14.8142 6.79775L10.8442 8.64175L14.7615 7.0285Z" fill="black"/>
                                    </g>
                                    <defs>
                                      <clipPath id="clip0_171_10393">
                                        <rect width="16" height="16" fill="white"/>
                                      </clipPath>
                                    </defs>
                                  </svg><span class="tab-title"><a href="inventory.php">Inventory</a></span> </a>
                            </div>
                            <div class="tab-divs">
                                    <a href="sales.php">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="M8 0.666667C4.318 0.666667 1.33333 3.65133 1.33333 7.33333C1.33333 11.0153 4.318 14 8 14C11.682 14 14.6667 11.0153 14.6667 7.33333C14.6667 3.65133 11.682 0.666667 8 0.666667ZM8 12.6667C5.05467 12.6667 2.66667 10.2787 2.66667 7.33333C2.66667 4.388 5.05467 2 8 2C10.9453 2 13.3333 4.388 13.3333 7.33333C13.3333 10.2787 10.9453 12.6667 8 12.6667ZM8.66667 4.66667H7.33333V6H6V7.33333H7.33333V8.66667H8.66667V7.33333H10V6H8.66667V4.66667Z" fill="black"/>
                                        </svg>
                                        <span class="tab-title">Sales</span>
                                    </a>
                                </div>
                            <div class="tab-divs ">
                                <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M5.01997 4.35356C5.10829 4.25877 5.15637 4.13341 5.15408 4.00387C5.1518 3.87434 5.09932 3.75075 5.00771 3.65914C4.91611 3.56753 4.79252 3.51506 4.66298 3.51277C4.53345 3.51049 4.40808 3.55857 4.3133 3.64689L2.97997 4.98022C2.88633 5.07397 2.83374 5.20106 2.83374 5.33356C2.83374 5.46606 2.88633 5.59314 2.97997 5.68689L4.3133 7.02022C4.35907 7.06935 4.41428 7.10875 4.47561 7.13608C4.53694 7.16341 4.60315 7.1781 4.67029 7.17928C4.73742 7.18047 4.80411 7.16812 4.86637 7.14297C4.92862 7.11782 4.98518 7.08039 5.03266 7.03292C5.08014 6.98544 5.11757 6.92888 5.14272 6.86662C5.16786 6.80436 5.18021 6.73768 5.17903 6.67054C5.17784 6.60341 5.16315 6.5372 5.13582 6.47586C5.10849 6.41453 5.06909 6.35933 5.01997 6.31356L4.53997 5.83356H11.3333C11.4659 5.83356 11.5931 5.78088 11.6869 5.68711C11.7806 5.59334 11.8333 5.46616 11.8333 5.33356C11.8333 5.20095 11.7806 5.07377 11.6869 4.98C11.5931 4.88623 11.4659 4.83356 11.3333 4.83356H4.53997L5.01997 4.35356ZM10.98 8.98022C10.8863 9.07397 10.8337 9.20106 10.8337 9.33356C10.8337 9.46606 10.8863 9.59314 10.98 9.68689L11.46 10.1669H4.66663C4.53403 10.1669 4.40685 10.2196 4.31308 10.3133C4.21931 10.4071 4.16663 10.5343 4.16663 10.6669C4.16663 10.7995 4.21931 10.9267 4.31308 11.0204C4.40685 11.1142 4.53403 11.1669 4.66663 11.1669H11.46L10.98 11.6469C10.9308 11.6927 10.8914 11.7479 10.8641 11.8092C10.8368 11.8705 10.8221 11.9367 10.8209 12.0039C10.8197 12.071 10.8321 12.1377 10.8572 12.2C10.8824 12.2622 10.9198 12.3188 10.9673 12.3662C11.0148 12.4137 11.0713 12.4512 11.1336 12.4763C11.1958 12.5015 11.2625 12.5138 11.3296 12.5126C11.3968 12.5114 11.463 12.4967 11.5243 12.4694C11.5857 12.4421 11.6409 12.4027 11.6866 12.3536L13.02 11.0202C13.1136 10.9265 13.1662 10.7994 13.1662 10.6669C13.1662 10.5344 13.1136 10.4073 13.02 10.3136L11.6866 8.98022C11.5929 8.88659 11.4658 8.834 11.3333 8.834C11.2008 8.834 11.0737 8.88659 10.98 8.98022Z" fill="black"/>
                                  </svg><span class="tab-title"><a href="shop-borrow.php">Borrow Request</a></span> </a>
                            </div>
                            <div class="tab-divs ">
                                <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M5.01997 4.35356C5.10829 4.25877 5.15637 4.13341 5.15408 4.00387C5.1518 3.87434 5.09932 3.75075 5.00771 3.65914C4.91611 3.56753 4.79252 3.51506 4.66298 3.51277C4.53345 3.51049 4.40808 3.55857 4.3133 3.64689L2.97997 4.98022C2.88633 5.07397 2.83374 5.20106 2.83374 5.33356C2.83374 5.46606 2.88633 5.59314 2.97997 5.68689L4.3133 7.02022C4.35907 7.06935 4.41428 7.10875 4.47561 7.13608C4.53694 7.16341 4.60315 7.1781 4.67029 7.17928C4.73742 7.18047 4.80411 7.16812 4.86637 7.14297C4.92862 7.11782 4.98518 7.08039 5.03266 7.03292C5.08014 6.98544 5.11757 6.92888 5.14272 6.86662C5.16786 6.80436 5.18021 6.73768 5.17903 6.67054C5.17784 6.60341 5.16315 6.5372 5.13582 6.47586C5.10849 6.41453 5.06909 6.35933 5.01997 6.31356L4.53997 5.83356H11.3333C11.4659 5.83356 11.5931 5.78088 11.6869 5.68711C11.7806 5.59334 11.8333 5.46616 11.8333 5.33356C11.8333 5.20095 11.7806 5.07377 11.6869 4.98C11.5931 4.88623 11.4659 4.83356 11.3333 4.83356H4.53997L5.01997 4.35356ZM10.98 8.98022C10.8863 9.07397 10.8337 9.20106 10.8337 9.33356C10.8337 9.46606 10.8863 9.59314 10.98 9.68689L11.46 10.1669H4.66663C4.53403 10.1669 4.40685 10.2196 4.31308 10.3133C4.21931 10.4071 4.16663 10.5343 4.16663 10.6669C4.16663 10.7995 4.21931 10.9267 4.31308 11.0204C4.40685 11.1142 4.53403 11.1669 4.66663 11.1669H11.46L10.98 11.6469C10.9308 11.6927 10.8914 11.7479 10.8641 11.8092C10.8368 11.8705 10.8221 11.9367 10.8209 12.0039C10.8197 12.071 10.8321 12.1377 10.8572 12.2C10.8824 12.2622 10.9198 12.3188 10.9673 12.3662C11.0148 12.4137 11.0713 12.4512 11.1336 12.4763C11.1958 12.5015 11.2625 12.5138 11.3296 12.5126C11.3968 12.5114 11.463 12.4967 11.5243 12.4694C11.5857 12.4421 11.6409 12.4027 11.6866 12.3536L13.02 11.0202C13.1136 10.9265 13.1662 10.7994 13.1662 10.6669C13.1662 10.5344 13.1136 10.4073 13.02 10.3136L11.6866 8.98022C11.5929 8.88659 11.4658 8.834 11.3333 8.834C11.2008 8.834 11.0737 8.88659 10.98 8.98022Z" fill="black"/>
                                  </svg><span class="tab-title"><a href="create_advertisement.php">Create Ad</a></span> </a>
                            </div>
                            <div class="tab-divs ">
                                <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M5.01997 4.35356C5.10829 4.25877 5.15637 4.13341 5.15408 4.00387C5.1518 3.87434 5.09932 3.75075 5.00771 3.65914C4.91611 3.56753 4.79252 3.51506 4.66298 3.51277C4.53345 3.51049 4.40808 3.55857 4.3133 3.64689L2.97997 4.98022C2.88633 5.07397 2.83374 5.20106 2.83374 5.33356C2.83374 5.46606 2.88633 5.59314 2.97997 5.68689L4.3133 7.02022C4.35907 7.06935 4.41428 7.10875 4.47561 7.13608C4.53694 7.16341 4.60315 7.1781 4.67029 7.17928C4.73742 7.18047 4.80411 7.16812 4.86637 7.14297C4.92862 7.11782 4.98518 7.08039 5.03266 7.03292C5.08014 6.98544 5.11757 6.92888 5.14272 6.86662C5.16786 6.80436 5.18021 6.73768 5.17903 6.67054C5.17784 6.60341 5.16315 6.5372 5.13582 6.47586C5.10849 6.41453 5.06909 6.35933 5.01997 6.31356L4.53997 5.83356H11.3333C11.4659 5.83356 11.5931 5.78088 11.6869 5.68711C11.7806 5.59334 11.8333 5.46616 11.8333 5.33356C11.8333 5.20095 11.7806 5.07377 11.6869 4.98C11.5931 4.88623 11.4659 4.83356 11.3333 4.83356H4.53997L5.01997 4.35356ZM10.98 8.98022C10.8863 9.07397 10.8337 9.20106 10.8337 9.33356C10.8337 9.46606 10.8863 9.59314 10.98 9.68689L11.46 10.1669H4.66663C4.53403 10.1669 4.40685 10.2196 4.31308 10.3133C4.21931 10.4071 4.16663 10.5343 4.16663 10.6669C4.16663 10.7995 4.21931 10.9267 4.31308 11.0204C4.40685 11.1142 4.53403 11.1669 4.66663 11.1669H11.46L10.98 11.6469C10.9308 11.6927 10.8914 11.7479 10.8641 11.8092C10.8368 11.8705 10.8221 11.9367 10.8209 12.0039C10.8197 12.071 10.8321 12.1377 10.8572 12.2C10.8824 12.2622 10.9198 12.3188 10.9673 12.3662C11.0148 12.4137 11.0713 12.4512 11.1336 12.4763C11.1958 12.5015 11.2625 12.5138 11.3296 12.5126C11.3968 12.5114 11.463 12.4967 11.5243 12.4694C11.5857 12.4421 11.6409 12.4027 11.6866 12.3536L13.02 11.0202C13.1136 10.9265 13.1662 10.7994 13.1662 10.6669C13.1662 10.5344 13.1136 10.4073 13.02 10.3136L11.6866 8.98022C11.5929 8.88659 11.4658 8.834 11.3333 8.834C11.2008 8.834 11.0737 8.88659 10.98 8.98022Z" fill="black"/>
                                  </svg><span class="tab-title"><a href="manage_advertisements.php">Manage Ad</a></span> </a>
                            </div>
                            
                           
                           
                            
                        </div>
                    </div>
                    <!-- ending tablist  -->
                    <!-- my account settings start  -->

                    <section class="shop-details-container">
                        <div class="form-container">
                            <h1>SHOP DETAILS</h1>
                            <form id="shop-details-form" method="POST">
                                <div class="form-group flex">
                                    <label for="shop-name"> <span class="flex-text"> SHOP NAME:</span><br><span style=" font-size: 12px;">Enter your Shop name</span></label>
                                    <input type="text" id="shop-name" name="shop_name" placeholder="<?php echo $details['shop_name']; ?>" required>
                                </div>
                                <div class="form-group flex">
                                    <label for="email"><span class="flex-text"> EMAIL:</span><br><span style=" font-size: 12px;">Enter your email address</span></label>
                                    <input type="email" id="email" name="email" placeholder="<?php echo $details['email']; ?>" required>
                                </div>
                                <div class="form-group flex">
                                    <label for="contact-number"><span class="flex-text" >CONTACT NUMBER:</span><br><span style=" font-size: 12px;">Enter your contact number</span></label>
                                    <input type="tel" id="contact-number" name="phone_number" placeholder="<?php echo $details['phone_number']; ?>" required>
                                </div>
                                <div class="form-group flex">
                                    <label for="contact-number"><span class="flex-text" >OWNER NAME:</span><br><span style=" font-size: 12px;">Enter your contact number</span></label>
                                    <input type="tel" id="contact-number" name="owner_name" placeholder="<?php echo $details['owner_name']; ?>" required>
                                </div>
                                <div class="form-group flex">
                                    <label for="contact-number"><span class="flex-text" >ADDRESS:</span><br><span style=" font-size: 12px;">Enter your contact number</span></label>
                                    <input type="tel" id="contact-number" name="address" placeholder="<?php echo $details['address']; ?>" required>
                                </div>
                                <div class="form-group flex">
                                    <label for="contact-number"><span class="flex-text" >CITY:</span><br><span style=" font-size: 12px;">Enter your contact number</span></label>
                                    <input type="tel" id="contact-number" name="city" placeholder="<?php echo $details['city']; ?>" required>
                                </div>
                                <div class="form-group flex">
                                    <label for="contact-number"><span class="flex-text" >POSTAL CODE:</span><br><span style=" font-size: 12px;">Enter your contact number</span></label>
                                    <input type="tel" id="contact-number" name="postal_code" placeholder="<?php echo $details['postal_code']; ?>" required>
                                </div>
                                <div class="btn-div">
                                    <button type="submit" name="account_details" class="save-btn">SAVE</button>
                                </div>
                                
                            </form>
                        </div>
                    </section>
   
                 <!-- my account settings end  -->
                </div>
                
                     
            </section>
         </section>
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
                                    York,
                                    USA</span></p>
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
                    vel
                    magna volutpat, posuere eros</p>
                <a href="#" class="payment-block">
                    <img src="image/icon/payment.png" alt="">
                </a>
                <p class="copyright-text">Copyright © 2019 <a href="#" class="author">Team Cipher Pol</a>. All Right Reserved.
                    <br>
                    Design By Team Cipher Pol</p>
            </div>
        </div>
    </footer>
    <!-- Use Minified Plugins Version For Fast Page Load -->
    <script src="js/plugins.js"></script>
    <script src="js/ajax-mail.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/reader-dashboard-account.js"></script>
</body>

</html>