<?php

namespace Hotel;

use PDO;
use Hotel\BaseService;

class User extends BaseService{

  const TOKEN_KEY = 'asfdhkgjlr;ofijhgbfdklfsadf';

  private static $currentUserId;

  public function getByEmail($email){
    $parameters = [
      ':email'=> $email,
    ];

    return $this->fetch('SELECT * FROM user WHERE email = :email', $parameters);
  }

  public function getByUserId($userId){
    $parameters = [
      ':user_id'=> $userId,
    ];

    return $this->fetch('SELECT * FROM user WHERE user_id = :user_id', $parameters);
  }

  public function getList(){
    return $this->fetchAll('SELECT * FROM user');
  }

  public function insert($name, $email, $password){
    $statement = $this->getPdo()->prepare('INSERT INTO user (name, email, password) VALUES (:name, :email, :password)');

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $passwordHash, PDO::PARAM_STR);

    $rows = $statement->execute();
    return $rows == 1;
  }

  public function verify($email, $password){
    //Retrieve User
    $user = $this->getByEmail($email);

    // Verify password
    return password_verify($password, $user['password']);
  }

  // public function generateToken($userId){
  // 	// Create token payload
  // 	$payload = [
  // 	    'user_id' => $userId,
  // 	];
  // 	$payloadEncoded = base64_encode(json_encode($payload));
  // 	$signature = hash_hmac('sha256', $payloadEncoded, self::TOKEN_KEY);
  //
  // 	return sprintf('%s.%s', $payloadEncoded, $signature);
  // }

  public function getUserToken($userId, $csrf =''){
  	// Create token payload
  	$payload = [
  	    'user_id' => $userId,
        'csrf' => $csrf ?: md5(time()),
  	];
  	$payloadEncoded = base64_encode(json_encode($payload));
  	$signature = hash_hmac('sha256', $payloadEncoded, self::TOKEN_KEY);

  	return sprintf('%s.%s', $payloadEncoded, $signature);
  }

  public function getTokenPayload($token)
  {
      // Get payload and signature
      [$payloadEncoded] = explode('.', $token);

      // Get payload
      return json_decode(base64_decode($payloadEncoded), true);
  }

  public function verifyToken($token)
  {
      // Get payload
      $payload = $this->getTokenPayload($token);
      $userId = $payload['user_id'];
      $csrf = $payload['csrf'];

      // Generate signature and verify
      return $this->getUserToken($userId, $csrf) == $token;
  }

  public static function verifyCsrf($csrf){
    return self::getCsrf() == $csrf;
  }

  public static function getCsrf(){
    $token = $_COOKIE['user_token'];

    $payload = self::getTokenPayload($token);

    return $payload['csrf'];
  }

  public static function getCurrentUserId(){
      return self::$currentUserId;
  }

  public static function setCurrentUserId($userId){
      self::$currentUserId = $userId;
  }

}
