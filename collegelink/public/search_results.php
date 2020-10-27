<?php

require __DIR__.'/../boot/boot.php';

use Hotel\Room;
use Hotel\RoomType;

// get cities
$room = new Room();
$cities = $room->getCities();
// get count of guests
$guests = $room->getGuests();
// print_r($guests); die;

//Get room types
$type = new RoomType();
$allTypes = $type->getAllTypes();
// echo $allTypes[$x+1]['title']; die;


// Get page parameters
$selectedcity = $_REQUEST['city'] ?? null;
$selectedtypeId = $_REQUEST['room_type'] ?? null;
$checkInDate = $_REQUEST['check_in_date'];
$checkOutDate = $_REQUEST['check_out_date'];

// Search for room
$allAvailableRooms = $room->search(new DateTime($checkInDate), new DateTime($checkOutDate), $selectedcity, $selectedtypeId);
// print_r($allAvailableRooms); die;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex,nofollow">
        <title>Search Results</title>
        <link rel="stylesheet" href="assets/jquery-ui-1.12.1/jquery-ui.css">
        <link rel="stylesheet" href="assets/jquery-ui-1.12.1/jquery-ui.theme.css">
        <script src="assets/jquery-3.5.1.min.js"></script>
        <script src="assets/js/search_results.js"></script>
        <script src="assets/js/ajax_search.js"></script>
    </head>
    <body>
      <div class="container">
      <header class="header">
          <div class="topnav">
            <p class="main-logo">Hotels</p>
            <div class="topnav-right">
              <a href="http://localhost/collegelink/public/index.php" class="home-link"><i class="fas fa-home"></i>Home</a>
              <a href="http://localhost/collegelink/public/user_profile.php"><i class="fa fa-user"></i>Profile</a>
            </div>
          </div>
          <div class="clear"></div>
      </header>
      </div>
      <main>
          <div class="container">
            <aside class="hotel-search box">
              <header class="left-half">
                <h2>FIND THE PERFECT HOTEL</h2>
              </header>
              <form method="get" action="search_results.php" name="searchForm" class="searchForm">
                <div class="form-group guests">
                    <select name="count_of_guests" id="formGuests">
                        <option value="" disabled selected>Number of Guests</option>
                        <?php
                          foreach ($guests as $guest) {
                        ?>
                            <option value="<?php echo $guest; ?>"><p><?php echo $guest; ?></p></option>
                        <?php
                          }
                        ?>
                    </select>
                </div>
                <div class="form-group roomtype">
                    <select name="room_type" id="formRoomType">
                        <option value="" disabled selected>Room Type</option>
                        <?php
                          foreach ($allTypes as $roomType) {
                        ?>
                            <option <?php echo $selectedtypeId == $roomType['type_id']? 'selected="selected"' : '' ?> value="<?php echo $roomType['type_id']; ?>"><?php echo $roomType['title']; ?></option>
                        <?php
                          }
                        ?>
                    </select>
                </div>
                <div class="form-group city">
                    <select name="city" id="formCity">
                        <option value="" disabled selected>City</option>
                        <?php
                          foreach ($cities as $city) {
                        ?>
                            <option <?php echo $selectedcity == $city? 'selected="selected"' : '' ?>  value="<?php echo $city; ?>"><p><?php echo $city; ?></p></option>
                        <?php
                          }
                        ?>
                    </select>
                </div>
                <div class="slide-container">
                <fieldset>
                  <div class="money-range">
                    <p class="price-zero">0</p>
                    <p class="price-5000">500</p>
                    <div class="clear"></div>
                  </div>
                  <div id="slider-range"></div>
                  <p>
                    <label for="amount">Price range:</label>
                    <input type="text" id="amount" name="amount" class="amount" readonly style="border:0;  width: 88px; color:#f50; font-weight:bold;">
                  </p>
                </fieldset>
                </div>
                <div class="form-group-date">
                  <input type="text" id="datepicker1" class="Arrival" placeholder="Check-In Date" value="<?php echo $checkInDate; ?>" name="check_in_date">
                  <input type="text" id="datepicker2" class="Departure" placeholder="Check-Out Date" value="<?php echo $checkOutDate; ?>" name="check_out_date">
                </div>
                <div class="form-button">
                  <button type="submit" class="button">FIND HOTEL</button>
                </div>
              </form>
            </aside>
            <section class="hotel-list box" id="search-results-container">
              <header class="right-half">
                <h3>Search Results</h3>
              </header>
              <article class="hotel">
                <?php
                  foreach ($allAvailableRooms as $availableRoom) {
                ?>
                    <aside class="media">
                      <img src="assets/images/rooms/<?php echo $availableRoom['photo_url']; ?>"  width="100%" height="126px">
                    </aside>
                    <main class="info">
                        <h1><?php echo $availableRoom['name']; ?></h1>
                        <h2><?php echo $availableRoom['city']; ?></h2>
                        <p><?php echo $availableRoom['description_short']; ?></p>
                      <form method="get" action="hotel_page.php" class="text-right">
                        <input type="hidden" name="room_id" value="<?php echo $availableRoom['room_id'] ?>">
                        <input type="hidden" name="check_in_date" value="<?php echo $checkInDate; ?>">
                        <input type="hidden" name="check_out_date" value="<?php echo $checkOutDate; ?>">
                        <button type="submit">Go to room page</button>
                      </form>
                    </main>
                    <div class="navbar">
                      <p class="left-navbar">Price per Night: <?php echo $availableRoom['price']; ?></p>
                      <div class="right-navbar">
                        <p class="num-guests">Number of Guests: <?php echo $availableRoom['count_of_guests']; ?></p>
                        <p class="typeroom">Type of Room: <?php $x = ($availableRoom['type_id']-1); echo $allTypes[$x]['title']; ?></p>
                      </div>
                    </div>
                    <div class="clear"></div>
                <?php
                  }
                ?>
              </article>
              <<?php
                  if(count($allAvailableRooms) == 0){
              ?>
              <h1 style="color: #da0505; text-align: center;">There are no available rooms!!</h1>
              <?php
                  }
              ?>
            </section>
          </div>
      </main>
      <footer class="footer"><p>(c) Copyright CollegeLink 2020</p></footer>
      <link rel="stylesheet" href="assets/css/fontawesome.min.css" />
      <link href="search_results.css" type="text/css" rel="stylesheet" />

      <script src="assets/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
      <script src="assets/jquery-ui-1.12.1/jquery-ui.js"></script>
    </body>
</html>
