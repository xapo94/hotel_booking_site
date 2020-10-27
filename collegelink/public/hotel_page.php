<?php

require __DIR__.'/../boot/boot.php';

use Hotel\Room;
use Hotel\Favorite;
use Hotel\User;
use Hotel\Review;
use Hotel\Booking;

$room = new Room();
$favorite = new Favorite();

$roomId = $_REQUEST['room_id'];


if (empty($roomId)){
  header ('Location: index.php');
  die;
}

$roomInfo = $room->get($roomId);
if (empty($roomInfo)){
  header ('Location: index.php');
  die;
}

// Verify csrf
if (!User::verifyCsrf(User::getCsrf())){
  header ('Location: index.php');
  die;
}

// Get current user id
$userId = User::getCurrentUserId();

// Check if room is favorite for current user
$isFavorite = $favorite->isFavorite($roomId, $userId);

// load all from reviews
$review = new Review();
$allReviews = $review->getReviewsByRoom($roomId);

// Check for booking room
$checkInDate = $_REQUEST['check_in_date'];
$checkOutDate = $_REQUEST['check_out_date'];

$alreadyBooked = empty($checkInDate) || empty($checkOutDate);

if (!$alreadyBooked){
  // Look for bookings
  $booking = new Booking();
  $isBooked = $booking->isBooked($roomId, $checkInDate, $checkOutDate);
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex,nofollow">
        <title>Room Page</title>
        <script src="assets/jquery-3.5.1.min.js"></script>
        <script src="assets/js/ajax_hotel_page.js"></script>
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
          <div class="up-border">
            <p class="hotel-title"><?php echo sprintf('%s - %s, %s', $roomInfo['name'], $roomInfo['city'], $roomInfo['area']) ?></p>
            <p class="review-stars">Reviews:
            <?php
              $roomAvgReview = $roomInfo['avg_reviews'];
              for ($i = 1; $i <= 5; $i++){
                  if($roomAvgReview >= $i){
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
            </p>
            <form action="actions/favorite.php" method="post" class="favoriteForm">
              <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
              <input type="hidden" name="is_favorite" value="<?php echo $isFavorite? '1' : '0'; ?>">
              <button type="submit" class="fas fa-heart <?php echo $isFavorite ? 'favorite' : '' ?>"></button>
            </form>
            <p class="text-right">Per Night: <?php echo $roomInfo['price']; ?></p>
          </div>
          <div class="image-mid">
            <img src="assets/images/rooms/<?php echo $roomInfo['photo_url']; ?>" width="52%" height="auto">
          </div>
          <div class="bottom-border">
            <div class="count-guests">
              <i class="fa fa-user"> <?php echo $roomInfo['count_of_guests']; ?></i>
              <p>COUNT OF GUESTS</p>
            </div>
            <div class="type-room">
              <i class="fas fa-bed"> <?php echo $roomInfo['type_id']; ?></i>
              <p>TYPE OF ROOM</p>
            </div>
            <div class="parking">
              <i class="fas fa-parking"><span><?php echo $roomInfo['parking'] == 1 ? ' YES' : ' NO' ?></span></i>
              <p>PARKING</p>
            </div>
            <div class="wifi">
              <i class="fas fa-wifi"> <?php echo $roomInfo['wifi'] == 1 ? ' YES' : ' NO' ?></i>
              <p>WIFI</p>
            </div>
            <div class="pets">
              <p><?php echo $roomInfo['pet_friendly'] == 1 ? 'YES' : 'NO' ?></p>
              <p>PET FRIENDLY</p>
            </div>
          </div>
          <div class="description">
            <h2>Room Description</h2>
            <p><?php echo $roomInfo['description_long']; ?></p>
          </div>
          <div class="button-two-book">
            <?php
              if ($alreadyBooked) {
            ?>
            <span class="booked">Already booked</span>
            <?php
              } else {
            ?>
            <form action="actions/book.php" method="post">
              <input type="hidden" name="room_id" value="<?php echo $roomId ?>">
              <input type="hidden" name="csrf" value="<?php echo User::getCsrf(); ?>">
              <input type="hidden" name="check_in_date" value="<?php echo $checkInDate; ?>">
              <input type="hidden" name="check_out_date" value="<?php echo $checkOutDate; ?>">
              <button type="submit">Book now</button>
            </form>
            <?php
              }
            ?>
          </div>
          <div id="map" class="map"></div>
            <script>
                // Initialize and add the map
                function initMap() {
                // The location given
                var location = {lat: <?php echo $roomInfo['location_lat']; ?>, lng: <?php echo $roomInfo['location_long']; ?>};
                // The map, centered at given locations
                var map = new google.maps.Map(
                    document.getElementById('map'), {zoom: 18, center: location});
                // The marker positioning
                var marker = new google.maps.Marker({position: location, map: map});
                }
            </script>
          <div class="made-reviews">
            <h2>Reviews</h2>
            <div class="ajax-use" id="ajax-use">
            <?php
              foreach ($allReviews as $counter => $review) {
            ?>
            <p class="review-name"> <?php echo sprintf('%d. %s', $counter + 1, $review['user_name']); ?>
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
            </p>
            <p>Created at: <?php echo $review['created_time']; ?></p>
            <p><?php echo htmlentities($review['comment']); ?></p>
            <div class="dot-border"></div>
            <?php
              }
            ?>
            </div>
          </div>
          <div class="add-reviews">
            <h2>Add review</h2>
            <form action="actions/review.php" method="post" class="reviewForm">
              <input type="hidden" name="room_id" value="<?php echo $roomId ?>">
              <input type="hidden" name="csrf" value="<?php echo User::getCsrf(); ?>">
              <div class="rating">
                <input id="star5" name="rate" type="radio" value="5" class="radio-btn hide" />
                <label for="star5" class="fa fa-star"></label>
                <input id="star4" name="rate" type="radio" value="4" class="radio-btn hide" />
                <label for="star4" class="fa fa-star"></label>
                <input id="star3" name="rate" type="radio" value="3" class="radio-btn hide" />
                <label for="star3" class="fa fa-star"></label>
                <input id="star2" name="rate" type="radio" value="2" class="radio-btn hide" />
                <label for="star2" class="fa fa-star"></label>
                <input id="star1" name="rate" type="radio" value="1" class="radio-btn hide" />
                <label for="star1" class="fa fa-star"></label>
              </div>
              <input type="text" name="comment" class="review-text" placeholder="Add a review!">
              <button type="submit" class="btn-review">Submit</button>
            </form>
          </div>
        </div>
      </main>
      <footer class="footer"><p>(c) Copyright CollegeLink 2020</p></footer>
      <link rel="stylesheet" href="assets/css/fontawesome.min.css" />
      <link href="hotel_page.css" type="text/css" rel="stylesheet" />

      <script defer
        src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
      </script>
    </body>
</html>
