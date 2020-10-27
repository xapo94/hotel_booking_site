<?php

require_once __DIR__ . '/../../boot/boot.php';

use Hotel\User;
use Hotel\Review;

// Return to home page if not post request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
  header ('Location: /');

  return;
}


// if there is no logged in user return to register-login page
if (empty(User::getCurrentUserId())){
  header('Location: /collegelink/public/register.php');

  return;
}

// Check if room id is given
$roomId = $_REQUEST['room_id'];
if (empty($roomId)){
  header('Location: /collegelink/public/index.php');

  return;
}

// Verify csrf
$csrf = $_REQUEST['csrf'];
if (empty($csrf) || !User::verifyCsrf($csrf)) {
  header('Location: /');

  return;
}


// Add review
$review = new Review();
$review->insert($roomId, User::getCurrentUserId(), $_REQUEST['rate'], $_REQUEST['comment']);

// Return to room page
header(sprintf('Location: /collegelink/public/hotel_page.php?room_id=%s', $roomId));
