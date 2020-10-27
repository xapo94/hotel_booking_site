<?php

require __DIR__.'/../boot/boot.php';

use Hotel\Favorite;
use Hotel\Review;
use Hotel\Booking;
use Hotel\User;

$userId = User::getCurrentUserId();
if (empty($userId)){
  header ('Location: index.php');
  die;
}

// Get all favorites
$favorite = new Favorite();
$userFavorites = $favorite->getListByUser($userId);

// Get all reviews
$review = new Review();
$userReviews = $review->getListByUser($userId);

// Get all user bookings
$booking = new Booking();
$userBookings = $booking->getListByUser($userId);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex,nofollow">
        <title>Profile page</title>
    </head>
    <body>
      <div class="container">
      <header class="header">
          <div class="topnav">
            <p class="main-logo">Hotels</p>
            <div class="topnav-right">
              <a href="http://localhost/collegelink/public/index.php" class="home-link"><i class="fas fa-home"></i>Home</a>
              <a href="http://localhost/collegelink/public/user_profile.php" class="profile"><i class="fa fa-user"></i>Profile</a>
            </div>
          </div>
          <div class="clear"></div>
      </header>
      </div>
      <main>
        <div class="container">
          <aside class="hotel-favorite box">
            <header class="left-half">
              <h2>FAVORITES</h2>
            </header>
            <?php
              if (count($userFavorites) > 0){
            ?>
              <?php
                foreach ($userFavorites as $counter => $favorite) {
              ?>
              <p class="fav-hotel"><a href="http://localhost/collegelink/public/hotel_page.php?room_id=<?php echo $favorite['room_id']; ?>" ><?php echo sprintf('%d. %s', $counter + 1, $favorite['name']); ?></a></p>
              <?php
                }
              ?>
            <?php
              } else {
            ?>
            <h1 style="color: #da0505; text-align: center; font-size: 20px;">You have no favorite hotels!!</h1>
            <?php
              }
            ?>
            <header class="second-left-half">
              <h2>REVIEWS</h2>
            </header>
            <?php
              if (count($userReviews) > 0){
            ?>
              <?php
                foreach ($userReviews as $counter => $review) {
              ?>
              <div>
                  <p><a href="http://localhost/collegelink/public/hotel_page.php?room_id=<?php echo $review['room_id']; ?>" ><?php echo sprintf('%d. %s', $counter + 1, $review['name']); ?></a></p>
                  <?php
                    for ($i = 1; $i <= 5; $i++){
                        if($review['rate'] >= $i){
                          ?>
                          <span class="fa fa-star checked"></span>
                          <?php
                        } else {
                          ?>
                          <span class="fa fa-star"></span>
                          <?php
                        }
                    }
                  ?>
              </div>
              <?php
                }
              ?>
            <?php
              } else {
            ?>
            <h1 style="color: #da0505; text-align: center; font-size: 20px;">You haven't made any reviews!!</h1>
            <?php
              }
            ?>
          </aside>
          <section class="hotel-list box">
            <header class="right-half">
              <h3>My bookings</h3>
            </header>
            <?php
              if (count($userBookings) > 0){
            ?>
              <?php
                foreach ($userBookings as $booking) {
              ?>
              <article class="hotel">
                <aside class="media">
                  <img src="assets/images/rooms/<?php echo $booking['photo_url']; ?>" width="100%" height="126px">
                </aside>
                <main class="info">
                    <h1><?php echo $booking['name']; ?></h1>
                    <h2><?php echo $booking['city'];?></h2>
                    <p><?php echo $booking['description_short']; ?></p>
                  <div class="text-right">
                    <button><a href="http://localhost/collegelink/public/hotel_page.php?room_id=<?php echo $booking['room_id']; ?>">Go to room page</a></button>
                  </div>
                </main>
                <div class="navbar">
                  <p class="left-navbar">Total price: <?php echo $booking['total_price']; ?></p>
                  <div class="right-navbar">
                    <p class="checkin-date">Check in date: <?php echo $booking['check_in_date']; ?></p>
                    <p class="checkout-date">Check out date: <?php echo $booking['check_out_date']; ?></p>
                    <p class="typeroom">Type of Room: <?php echo $booking['room_type']; ?></p>
                  </div>
                </div>
                <div class="clear"></div>
              </article>
              <?php
                }
              ?>
            <?php
              } else {
            ?>
            <h1 style="color: #da0505; text-align: center; font-size: 20px;">You don't have any booking!!</h1>
            <<?php
              }
            ?>
          </section>
        </div>
      </main>
      <footer class="footer"><p>(c) Copyright CollegeLink 2020</p></footer>
      <link rel="stylesheet" href="assets/css/fontawesome.min.css" />
      <link href="user_profile.css" type="text/css" rel="stylesheet" />
    </body>
</html>
