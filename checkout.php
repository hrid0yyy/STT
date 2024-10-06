<?php
  session_start();
include 'backend/purchase.php';
if(!empty($_SESSION['user_id'])){
  $cart_items  = cart_items($_SESSION['user_id']);
  }
// Initialize total
$total = 0;

// Calculate the total price from cart items
if (!empty($cart_items)) { 
	$total = 100;
    foreach ($cart_items as $item) {
        $total += $item['total_price'];
    }
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
</head>

<body>
	<div class="site-wrapper" id="top">
		<div class="site-header header-2 mb--20 d-none d-lg-block">
			<div class="header-middle pt--10 pb--10">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-3">
							<a href="index.php" class="site-brand">
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
									
								</div>
								<!-- @include('menu.htm') -->
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		
		<div class="sticky-init fixed-header common-sticky">
			<div class="container d-none d-lg-block">
				<div class="row align-items-center">
					<div class="col-lg-4">
						<a href="index.php" class="site-brand">
							<img src="image/logo6.png" alt="">
						</a>
					</div>
					<div class="col-lg-8">
						<div class="main-navigation flex-lg-right">
							<ul class="main-menu menu-right ">
								<li class="menu-item has-children">
									<a href="javascript:void(0)">Home <i
											class="fas fa-chevron-down dropdown-arrow"></i></a>
									<ul class="sub-menu">
										<li> <a href="index.html">Home One</a></li>
										<li> <a href="index-2.html">Home Two</a></li>
										<li> <a href="index-3.html">Home Three</a></li>
										<li> <a href="index-4.html">Home Four</a></li>
									</ul>
								</li>
								<!-- Shop -->
								<li class="menu-item has-children mega-menu">
									<a href="javascript:void(0)">shop <i
											class="fas fa-chevron-down dropdown-arrow"></i></a>
									<ul class="sub-menu four-column">
										<li class="cus-col-25">
											<h3 class="menu-title"><a href="javascript:void(0)">Shop Grid </a></h3>
											<ul class="mega-single-block">
												<li><a href="shop-grid.html">Fullwidth</a></li>
												<li><a href="shop-grid-left-sidebar.html">left Sidebar</a></li>
												<li><a href="shop-grid-right-sidebar.html">Right Sidebar</a></li>
											</ul>
										</li>
										<li class="cus-col-25">
											<h3 class="menu-title"> <a href="javascript:void(0)">Shop List</a></h3>
											<ul class="mega-single-block">
												<li><a href="shop-list.html">Fullwidth</a></li>
												<li><a href="shop-list-left-sidebar.html">left Sidebar</a></li>
												<li><a href="shop-list-right-sidebar.html">Right Sidebar</a></li>
											</ul>
										</li>
										<li class="cus-col-25">
											<h3 class="menu-title"> <a href="javascript:void(0)">Product Details 1</a>
											</h3>
											<ul class="mega-single-block">
												<li><a href="product-details.html">Product Details Page</a></li>
												<li><a href="product-details-affiliate.html">Product Details
														Affiliate</a></li>
												<li><a href="product-details-group.html">Product Details Group</a></li>
												<li><a href="product-details-variable.html">Product Details
														Variables</a></li>
											</ul>
										</li>
										<li class="cus-col-25">
											<h3 class="menu-title"><a href="javascript:void(0)">Product Details 2</a>
											</h3>
											<ul class="mega-single-block">
												<li><a href="product-details-left-thumbnail.html">left Thumbnail</a>
												</li>
												<li><a href="product-details-right-thumbnail.html">Right Thumbnail</a>
												</li>
												<li><a href="product-details-left-gallery.html">Left Gallery</a></li>
												<li><a href="product-details-right-gallery.html">Right Gallery</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<!-- Pages -->
								<li class="menu-item has-children">
									<a href="javascript:void(0)">Pages <i
											class="fas fa-chevron-down dropdown-arrow"></i></a>
									<ul class="sub-menu">
										<li><a href="cart.html">Cart</a></li>
										<li><a href="checkout.html">Checkout</a></li>
										<li><a href="compare.html">Compare</a></li>
										<li><a href="wishlist.html">Wishlist</a></li>
										<li><a href="login-register.html">Login Register</a></li>
										<li><a href="my-account.html">My Account</a></li>
										<li><a href="order-complete.html">Order Complete</a></li>
										<li><a href="faq.html">Faq</a></li>
										<li><a href="contact-2.html">contact 02</a></li>
									</ul>
								</li>
								<!-- Blog -->
								<li class="menu-item has-children mega-menu">
									<a href="javascript:void(0)">Blog <i
											class="fas fa-chevron-down dropdown-arrow"></i></a>
									<ul class="sub-menu three-column">
										<li class="cus-col-33">
											<h3 class="menu-title"><a href="javascript:void(0)">Blog Grid</a></h3>
											<ul class="mega-single-block">
												<li><a href="blog.html">Full Widh (Default)</a></li>
												<li><a href="blog-left-sidebar.html">left Sidebar</a></li>
												<li><a href="blog-right-sidebar.html">Right Sidebar</a></li>
											</ul>
										</li>
										<li class="cus-col-33">
											<h3 class="menu-title"><a href="javascript:void(0)">Blog List </a></h3>
											<ul class="mega-single-block">
												<!-- <li><a href="blog-list.html">Full Widh (Default)</a></li> -->
												<li><a href="blog-list-left-sidebar.html">left Sidebar</a></li>
												<li><a href="blog-list-right-sidebar.html">Right Sidebar</a></li>
											</ul>
										</li>
										<li class="cus-col-33">
											<h3 class="menu-title"><a href="javascript:void(0)">Blog Details</a></h3>
											<ul class="mega-single-block">
												<li><a href="blog-details.html">Image Format (Default)</a></li>
												<li><a href="blog-details-gallery.html">Gallery Format</a></li>
												<li><a href="blog-details-audio.html">Audio Format</a></li>
												<li><a href="blog-details-video.html">Video Format</a></li>
												<li><a href="blog-details-left-sidebar.html">left Sidebar</a></li>
											</ul>
										</li>
									</ul>
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
		<section class="breadcrumb-section">
			<h2 class="sr-only">Site Breadcrumb</h2>
			<div class="container">
				<div class="breadcrumb-contents">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="breadcrumb-item active">Checkout</li>
						</ol>
					</nav>
				</div>
			</div>
		</section>
		<main id="content" class="page-section inner-page-sec-padding-bottom space-db--20">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- Checkout Form s-->
						<div class="checkout-form">
							<div class="row row-40">
								<div class="col-12">
									<h1 class="quick-title">Checkout</h1>
									<!-- Slide Down Trigger  -->
									<div class="checkout-quick-box">
										<p><i class="far fa-sticky-note"></i>Returning customer? <a href="javascript:"
												class="slide-trigger" data-target="#quick-login">Click
												here to login</a></p>
									</div>
									<!-- Slide Down Blox ==> Login Box  -->
									<div class="checkout-slidedown-box" id="quick-login">
										<form action="./">
											<div class="quick-login-form">
												<p>If you have shopped with us before, please enter your details in the
													boxes below. If you are a new
													customer
													please
													proceed to the Billing & Shipping section.</p>
												<div class="form-group">
													<label for="quick-user">Username or email *</label>
													<input type="text" placeholder="" id="quick-user">
												</div>
												<div class="form-group">
													<label for="quick-pass">Password *</label>
													<input type="text" placeholder="" id="quick-pass">
												</div>
												<div class="form-group">
													<div class="d-flex align-items-center flex-wrap">
														<a href="#" class="btn btn-outlined   mr-3">Login</a>
														<div class="d-inline-flex align-items-center">
															<input type="checkbox" id="accept_terms" class="mb-0 mr-1">
															<label for="accept_terms" class="mb-0">I’ve read and accept
																the terms &amp; conditions</label>
														</div>
													</div>
													<p><a href="javascript:" class="pass-lost mt-3">Lost your
															password?</a></p>
												</div>
											</div>
										</form>
									</div>
									<!-- Slide Down Trigger  -->
									<div class="checkout-quick-box">
										<p><i class="far fa-sticky-note"></i>Have a coupon? <a href="javascript:"
												class="slide-trigger" data-target="#quick-cupon">
												Click here to enter your code</a></p>
									</div>
									<!-- Slide Down Blox ==> Cupon Box -->
									<div class="checkout-slidedown-box" id="quick-cupon">
										<form action="./">
											<div class="checkout_coupon">
												<input type="text" class="mb-0" placeholder="Coupon Code">
												<a href="" class="btn btn-outlined">Apply coupon</a>
											</div>
										</form>
									</div>
								</div>
							
									<!-- Shipping Address -->
									<div id="shipping-form" class="mb--40">
										<h4 class="checkout-title">Shipping Address</h4>
										<div class="row">
											<div class="col-md-6 col-12 mb--20">
												<label>First Name*</label>
												<input type="text" placeholder="First Name">
											</div>
											<div class="col-md-6 col-12 mb--20">
												<label>Last Name*</label>
												<input type="text" placeholder="Last Name">
											</div>
											<div class="col-md-6 col-12 mb--20">
												<label>Email Address*</label>
												<input type="email" placeholder="Email Address">
											</div>
											<div class="col-md-6 col-12 mb--20">
												<label>Phone no*</label>
												<input type="text" placeholder="Phone number">
											</div>
											<div class="col-12 mb--20">
												<label>Company Name</label>
												<input type="text" placeholder="Company Name">
											</div>
											<div class="col-12 mb--20">
												<label>Address*</label>
												<input type="text" placeholder="Address line 1">
												<input type="text" placeholder="Address line 2">
											</div>
											<div class="col-md-6 col-12 mb--20">
												<label>Country*</label>
												<select class="nice-select">
													<option>Bangladesh</option>
													<option>China</option>
													<option>country</option>
													<option>India</option>
													<option>Japan</option>
												</select>
											</div>
											<div class="col-md-6 col-12 mb--20">
												<label>Town/City*</label>
												<input type="text" placeholder="Town/City">
											</div>
											<div class="col-md-6 col-12 mb--20">
												<label>State*</label>
												<input type="text" placeholder="State">
											</div>
											<div class="col-md-6 col-12 mb--20">
												<label>Zip Code*</label>
												<input type="text" placeholder="Zip Code">
											</div>
										</div>
									</div>
									
								</div>
								<div class="col-lg-5">
									<div class="row">
										<!-- Cart Total -->
										<div class="col-12">
											<div class="checkout-cart-total">
												<h2 class="checkout-title">YOUR ORDER</h2>
												<h4>Product <span>Total</span></h4>
												<ul>
												<?php if (!empty($cart_items)) { ?>
													<?php foreach ($cart_items as $item) { ?>
														<li>
															<span class="left"><?php echo $item['title']; ?> X <?php echo $item['amount']; ?></span>
															<span class="right"><?php echo $item['total_price']; ?></span>
														</li>
													<?php } ?>
												<?php } ?>
											</ul>

												<p>Sub Total <span><?php echo $total - 100; ?></span></p>
												<p>Shipping Fee <span>100.00</span></p>
												<h4>Grand Total <span><?php  echo $total; ?></span></h4>
												
												<div class="method-notice mt--25">
													<article>
														<h3 class="d-none sr-only">blog-article</h3>
														Sorry, it seems that there are no available payment methods for
														your state. Please contact us if you
														require
														assistance
														or wish to make alternate arrangements.
													</article>
												</div>
												<div class="term-block">
													<input type="checkbox" id="accept_terms2">
													<label for="accept_terms2">I’ve read and accept the terms &
														conditions</label>
												</div>
											
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-7 mb--20">
									<!-- Billing Address -->
									<div id="billing-form" class="mb-40">
										<h4 class="checkout-title">Billing Address</h4>
										<form method="POST">
    <div class="row">
        <div class="col-md-6 col-12 mb--20">
            <label>First Name*</label>
            <input type="text" name="first_name" placeholder="First Name" required>
        </div>
        <div class="col-md-6 col-12 mb--20">
            <label>Last Name*</label>
            <input type="text" name="last_name" placeholder="Last Name" required>
        </div>
        <div class="col-md-6 col-12 mb--20">
            <label>Email Address*</label>
            <input type="email" name="email" placeholder="Email Address" required>
        </div>
        <div class="col-md-6 col-12 mb--20">
            <label>Phone no*</label>
            <input type="text" name="phone_number" placeholder="Phone number" required>
        </div>
        <div class="col-12 mb--20">
            <label>Address*</label>
            <input type="text" name="address" placeholder="Address">
        </div>
        <div class="col-md-6 col-12 mb--20">
            <label>Town/City*</label>
            <input type="text" name="town" placeholder="Town/City">
        </div>

        <button class="place-order w-100" name="order" onclick="submitAndRedirect(event, <?php echo $total + 100; ?>)">
            Place Order
        </button>
    </div>
</form>

									
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>

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
<form action="your_form_processing_script.php" method="POST">
    <button class="place-order w-100" name="order" onclick="submitAndRedirect(event, <?php echo $total + 100; ?>)">
        Place Order
    </button>
</form>

<script>
 function submitAndRedirect(event, totalPrice) {
    event.preventDefault();  // Prevent default form submission

    // Collect the form data
    const form = event.target.form;
    const firstName = form.querySelector('input[name="first_name"]').value;
    const lastName = form.querySelector('input[name="last_name"]').value;
    const email = form.querySelector('input[name="email"]').value;
    const phone = form.querySelector('input[name="phone_number"]').value;
    const address = form.querySelector('input[name="address"]').value;
    const town = form.querySelector('input[name="town"]').value;

    // Redirect to the payment page with form data in the query string
    window.location.href = `payment.php?price=${totalPrice}&first_name=${encodeURIComponent(firstName)}&last_name=${encodeURIComponent(lastName)}&email=${encodeURIComponent(email)}&phone=${encodeURIComponent(phone)}&address=${encodeURIComponent(address)}&town=${encodeURIComponent(town)}`;
}

</script>

</html>