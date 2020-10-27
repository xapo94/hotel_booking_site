<?php

require_once __DIR__ . '/../../boot/boot.php';

use Hotel\User;

// Return to home page if not post request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
  header ('Location: /');

  return;
}

// If there is already logged in user return to main page
if (!empty(User::getCurrentUserId())){
  header('Location: /collegelink/public/index.php');

  return;
}

// Verify user
$user = new User();
try {
  if (!$user->verify($_REQUEST['email_login'], $_REQUEST['password_login'])){
    header('Location: /register.php?error=Could not verify user');

    return;
  }
} catch(InvalidArgumentException $ex) {
    header('Location: /register.php?error=No user exists with the given credentials');

    return;
}


// Create token for user
$userInfo = $user->getByEmail($_REQUEST['email_login']);
$token = $user->getUserToken($userInfo['user_id']);
setcookie('user_token', $token, time() + (30*24*60*60), '/');

// Return to home page
header('Location: /collegelink/public/index.php');
