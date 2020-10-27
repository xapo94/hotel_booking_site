<?php

require_once __DIR__ . '/../../boot/boot.php';

use Hotel\User;
use Hotel\Review;

// Return to home page if not post request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
  echo "This is a post script.";
  die;
}


// if there is no logged in user return to main page
if (empty(User::getCurrentUserId())){
  echo "No current user for this operation.";
  die;
}

// Check if room id is given
$roomId = $_REQUEST['room_id'];
if (empty($roomId)){
  echo "No room is given for this operation.";
  die;
}

// Verify csrf
$csrf = $_REQUEST['csrf'];
if (empty($csrf) || !User::verifyCsrf($csrf)) {
  echo "Invalid request";
  die;
}


// Add review
$review = new Review();
$review->insert($roomId, User::getCurrentUserId(), $_REQUEST['rate'], $_REQUEST['comment']);

// Get all reviews
$roomReviews = $review->getReviewsByRoom($roomId);
$counter = count($roomReviews);

$user = new User();
$userInfo = $user->getByUserId(User::getCurrentUserId());
?>


<p class="review-name"> <?php echo sprintf('%d. %s', $counter, $userInfo['name']); ?>
  <?php
    for ($i = 1; $i <= 5; $i++){
        if($_REQUEST['rate'] >= $i){
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
<p>Created at: <?php echo (new DateTime())->format('Y-m-d H:i:s'); ?></p>
<p><?php echo $_REQUEST['comment']; ?></p>
<div class="dot-border"></div>
