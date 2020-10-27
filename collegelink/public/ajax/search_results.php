<?php

require __DIR__.'/../../boot/boot.php';

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
$count_of_guests = $_REQUEST['count_of_guests'] ?? null;
$price = $_REQUEST['amount'] ?? null;

// break price in two parts cause the string i get is: "amount - amount"
// var_dump($price);
$arrayPrices = explode("-",$price);
// var_dump($arrayPrices);
$price_min_middlestep = $arrayPrices[0] ?? null;
$price_max_middlestep = $arrayPrices[1] ?? null;
// var_dump($price_min_middlestep);
// var_dump($price_max_middlestep); die;
$price_min = explode("$",$price_min_middlestep);
$price_max = explode("$",$price_max_middlestep);

$price_min = $price_min[1];
$price_max = $price_max[1];

// Search for room
$allAvailableRooms = $room->searchAdvanced(new DateTime($checkInDate), new DateTime($checkOutDate), $selectedcity, $selectedtypeId, $count_of_guests, $price_min, $price_max);

?>


<header class="right-half">
  <h3>New Search Results</h3>
</header>
<article class="hotel">
  <?php
    foreach ($allAvailableRooms as $availableRoom) {
  ?>
      <aside class="media">
        <img src="/../collegelink/public/assets/images/rooms/<?php echo $availableRoom['photo_url']; ?>"  width="100%" height="126px">
      </aside>
      <main class="info">
          <h1><?php echo $availableRoom['name']; ?></h1>
          <h2><?php echo $availableRoom['city']; ?></h2>
          <p><?php echo $availableRoom['description_short']; ?></p>
        <form method="get" action="/../collegelink/public/hotel_page.php" class="text-right">
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
