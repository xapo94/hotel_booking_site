<?php

namespace Hotel;

use PDO;
use DateTime;
use Hotel\BaseService;

class Room extends BaseService{

  public function get($roomId){
    $parameters = [
      ':room_id'=> $roomId,
    ];

    return $this->fetch('SELECT * FROM room WHERE room_id = :room_id', $parameters);
  }

  public function getCities(){
    // Get each different city from the $rows array
    $cities = [];
    $rows = $this->fetchAll('SELECT DISTINCT city FROM room');
    foreach ($rows as $row) {
      $cities[] = $row['city'];
    }
    return $cities;
  }

  public function getGuests(){
    $guests = [];
    $rows = $this->fetchAll('SELECT DISTINCT count_of_guests FROM room');
    foreach ($rows as $row) {
      $guests[] = $row['count_of_guests'];
    }
    return $guests;
  }

  public function search($checkInDate, $checkOutDate, $selectedcity = '', $selectedtypeId = ''){
    // Setup parameters
    $parameters = [
      ':check_in_date'=> $checkInDate->format(DateTime::ATOM),
      ':check_out_date'=> $checkOutDate->format(DateTime::ATOM),
    ];
    if(!empty($selectedcity)){
      $parameters[':city'] = $selectedcity;
    }
    if(!empty($selectedtypeId)){
      $parameters[':type_id'] = $selectedtypeId;
    }

    // Build query
    $sql = 'SELECT * FROM room WHERE ' ;
    if(!empty($selectedcity)){
      $sql .= 'city = :city AND ';
    }
    if(!empty($selectedtypeId)){
      $sql .= 'type_id = :type_id AND ';
    }
    $sql .= 'room_id NOT IN (
      SELECT room_id
      FROM booking
      WHERE check_in_date <= :check_out_date AND check_out_date >= :check_in_date
    )' ;
    // var_dump($sql); die;

    // Get results
    return $this->fetchAll($sql, $parameters);
  }

  public function searchAdvanced($checkInDate, $checkOutDate, $selectedcity = '', $selectedtypeId = '', $count_of_guests = '', $price_min = '', $price_max = ''){
    // Setup parameters
    $parameters = [
      ':check_in_date'=> $checkInDate->format(DateTime::ATOM),
      ':check_out_date'=> $checkOutDate->format(DateTime::ATOM),
    ];
    if(!empty($selectedcity)){
      $parameters[':city'] = $selectedcity;
    }
    if(!empty($selectedtypeId)){
      $parameters[':type_id'] = $selectedtypeId;
    }
    if(!empty($count_of_guests)){
      $parameters[':count_of_guests'] = $count_of_guests;
    }
    if(!empty($price_min)){
      $parameters[':price_min'] = $price_min;
    }
    if(!empty($price_max)){
      $parameters[':price_max'] = $price_max;
    }

    // Build query
    $sql = 'SELECT * FROM room WHERE ' ;
    if(!empty($selectedcity)){
      $sql .= 'city = :city AND ';
    }
    if(!empty($selectedtypeId)){
      $sql .= 'type_id = :type_id AND ';
    }
    if(!empty($count_of_guests)){
      $sql .= 'count_of_guests = :count_of_guests AND ';
    }
    if(!empty($price_min) AND !empty($price_max)){
      $sql .= 'price BETWEEN :price_min AND :price_max AND ';
    }
    $sql .= 'room_id NOT IN (
      SELECT room_id
      FROM booking
      WHERE check_in_date <= :check_out_date AND check_out_date >= :check_in_date
    )' ;
    // var_dump($sql); die;

    // Get results
    return $this->fetchAll($sql, $parameters);
  }
}
