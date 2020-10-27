<?php

require __DIR__.'/../boot/boot.php';

use Hotel\Room;
use Hotel\RoomType;

// Get cities
$room = new Room();
$cities = $room->getCities();

//Get room types
$type = new RoomType();
$allTypes = $type->getAllTypes();
// print_r($allTypes); die;

?>

<html>
    <head>
        <meta name="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex,nofollow">
        <title>Index</title>
        <link rel="stylesheet" href="assets/jquery-ui-1.12.1/jquery-ui.css">
        <link rel="stylesheet" href="assets/jquery-ui-1.12.1/jquery-ui.theme.css">
        <script src="assets/jquery-3.5.1.min.js"></script>
        <script src="assets/js/scripts1.js"></script>
    </head>
    <body>
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
      <main class="main-page">
            <section class="main-border">
              <form name="searchForm" method="get" action="search_results.php" class="main-search">
              <div class="custom-select1">
                <select name="city" class="City" required>
                  <option value="" disabled selected>City</option>
                  <?php
                    foreach ($cities as $city) {
                  ?>
                      <option value="<?php echo $city; ?>"><p><?php echo $city; ?></p></option>
                  <?php
                    }
                  ?>
                </select>
                <select name="room_type" class="Room-type">
                  <option value="" disabled selected>Room Type</option>
                  <?php
                    foreach ($allTypes as $roomType) {
                  ?>
                      <option value="<?php echo $roomType['type_id']; ?>"><?php echo $roomType['title']; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </div>
              <div class="custom-select2">
                  <input type="text" id="datepicker1" class="Arrival" placeholder="Check-In Date" name="check_in_date" required>
                  <input type="text" id="datepicker2" class="Departure" placeholder="Check-Out Date" name="check_out_date" required>
              </div>
              <div class="search-button">
                <button class="button">Submit</button>
              </div>
              </form>
            </section>
      </main>
      <footer class="footer"><p>(c) Copyright CollegeLink 2020</p></footer>
      <link rel="stylesheet" href="assets/css/fontawesome.min.css" />
      <link rel="stylesheet" href="index.css" type="text/css" />

      <script src="assets/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
      <script src="assets/jquery-ui-1.12.1/jquery-ui.js"></script>
    </body>
</html>
