<?php

error_reporting(E_ERROR);

spl_autoload_register(function ($class) {
	$class = str_replace("\\", "/", $class);
    require_once sprintf(__DIR__.'/../app/%s.php', $class);
});

use Hotel\User;
$user = new User();

// Check if there is a user in the request
$userToken = $_COOKIE['user_token'];

if ($userToken){
	// verify user
	if ($user->verifyToken($userToken)){
		// set user in memory
		$userInfo = $user->getTokenPayload($userToken);
		User::setCurrentUserId($userInfo['user_id']);
	}

}
