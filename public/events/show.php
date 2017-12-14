<?php
require_once('../../private/initialize.php');


$event_id = $_GET['event_id'] ?? '1'; // PHP > 7.0
$event = find_event_by_id($event_id);
$films = find_films_by_event_id($event_id);
$host = find_host_by_event_id($event_id);
$category = find_category_by_event_id($event_id);
$room = find_room_by_event_id($event_id);
$address = find_address_by_room_id($event['room_id']);
$city = find_city_by_id($address['city_id']);
$country = find_country_by_id($city['country_id']);


$page_title = $event['event_name'];
$page = 'show';
?>


<?php include(SHARED_PATH . '/header.php'); ?>
<div class="container">
    <div id="content">
        <div class="event show">
            <h1><?php echo h($event['event_name']); ?></h1>
            <div class="attributes"> 
                <h2>Event Details</h2>
                <dl>
                    <dt>Event type:</dt>
                    <dd><?php echo h($category['category_name']); ?></dd>
                </dl>
                <dl>
                    <dt>Hosted by:</dt>
                    <dd><?php
                        echo h($host['first_name']) . ' ' .
                        h($host['last_name']) . ' - ' . h($host['username']);
                        ?></dd>
                </dl>

                <?php $rating = find_rating_by_event_id($event['event_id']) ?>

                <?php if (isset($rating)) { ?>
                    <dl> 
                        <dt>Host average rating:</dt>
                        <?php $average_rating = find_avg_host_rating($event['host_user_id']); ?>
                        <dd><?php echo $average_rating ?> / 10</dd>
                    </dl>
                <?php } ?>
                <dl>
                    <dt>Event Description:</dt>
                    <dd><?php echo h($event['event_description']); ?></dd>
                </dl>
                <dl>
                    <?php $number_of_films = find_number_of_films_by_event_id($event_id) ?>
                    <dt>Films showing: <?php echo $number_of_films ?></dt>
                </dl>
                <?php echo display_event_films_details($films); ?>
                <br>
                <h2>Date and Time</h2>
                <dl>
                    <dt>Start:</dt>
                    <dd><?php echo h($event['event_start']); ?></dd>
                </dl>
                <dl>
                    <dt>End:</dt>
                    <dd><?php echo h($event['event_end']); ?></dd>
                </dl>
                <br>
                <h2>Location</h2>
                <dl>
                    <dt>Room:</dt>
                    <dd><?php echo h($room['room_name']); ?></dd>
                </dl>
                <dl>
                    <dt>Address:</dt>
                    <dd><?php echo h($address['address_line_1']); ?></dd>
                    <dd><?php echo h($address['postcode']); ?></dd>
                    <dd><?php echo h($city['city_name']); ?></dd>
                    <dd><?php echo h($country['country_name']); ?></dd>
                </dl>
                <dl>
                    <dt>Wheelchair Accessible:</dt>                       
                    <dd><?php echo h($room['wheelchair_accessible']); ?></dd>
                </dl>
                <h2>Booking</h2>
                <dl>
                    <dt>Ticket sales end:</dt>
                    <dd><?php echo h($event['ticket_sale_end']); ?></dd>
                    <dt><a href="<?php
                        echo url_for('/bookings/new.php?event_id='
                                . h(u($event['event_id'])));
                        ?>">Click to book</a></dt>
                </dl>
            </div>                  
        </div>
    </div>
</div>



</body>

<?php include(SHARED_PATH . '/footer.php'); ?>
