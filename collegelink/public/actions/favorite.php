<?php

require_once __DIR__ . '/../../boot/boot.php';

use Hotel\User;
use Hotel\Favorite;

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

//set room to favorites
$favorite = new Favorite();

//Add or remove room from favorites
$isFavorite = $_REQUEST['is_favorite'];
if(!$isFavorite){
  $favorite->addFavorite($roomId, User::getCurrentUserId());
} else {
  $favorite->removeFavorite($roomId, User::getCurrentUserId());
}


// Return to room page
header(sprintf('Location: /collegelink/public/hotel_page.php?room_id=%s', $roomId));
