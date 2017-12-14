<?php
require_once('../../private/initialize.php');

if (is_post_request()) {

    // Handle form values
    $booking = [];
    $booking['number_of_tickets'] = $_POST['number_of_tickets'] ?? '';

    $result = insert_booking($booking);
    if ($result === true) {
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/bookings/show.php?event_id=' . $new_id));
    } else {
        $errors = $result;
    }
} else {
    $booking = [];
    $booking['number_of_tickets'] = "";
}

$booking_set = find_all_bookings();
$booking_count = mysqli_num_rows($booking_set) + 1;
mysqli_free_result($booking_set);


// FOR DISPLAYING THE EVENT DETAILS
$event_id = $_GET['event_id'] ?? '1'; // PHP > 7.0
$event = find_event_by_id($event_id);
$films = find_films_by_event_id($event_id);
$host = find_host_by_event_id($event_id);
$category = find_category_by_event_id($event_id);
$room = find_room_by_event_id($event_id);
$address = find_address_by_room_id($event['room_id']);
$city = find_city_by_id($address['city_id']);
$country = find_country_by_id($city['country_id']);
?>

<?php $page_title = 'Make a booking'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div class="container">
    <div id="content">
        <a class="back-link" href="<?php echo url_for('/events/show.php?event_id=' . $event_id); ?>">&laquo; Back to Event</a>

        <div class="new_booking">
            <h1>Make a Booking for <?php echo $event['event_name'] ?></h1>
            <br>
            <?php echo display_errors($errors); ?>
            <!-- FOR ENTERING NUMBER OF TICKETS -->                    
            <form action="<?php echo url_for('/bookings/new.php'); ?>" method="post">
                <h3>Please enter number of tickets below</h3>
                <dl>
                    <dt>Number of tickets:</dt>
                    <dd><input type="text" name="number_of_tickets" value="" /></dd>
                </dl>
                <dl>
                    <dt>Ticket sales end:</dt>
                    <dd><?php echo h($event['ticket_sale_end']); ?></dd>
                    <?php
                    $diff = date_create()->diff(date_create($event['ticket_sale_end']));
                    echo $diff->format("%a days\n%h hours\n%i minutes\n"); //Walter Tross
                    //https://stackoverflow.com/questions/22597110/need-to-show-days-hours-minutes-and-seconds-between-two-dates-in-php
                    ?>  

                </dl>
                <dl>
                    <dt>User - to be got from session but this is just for testing for now</dt>
                    <dd>
                        <select name="user_id">
                            <?php
                            $user_set = find_all_users();
                            while ($user = mysqli_fetch_assoc($user_set)) {
                                echo "<option value=" . $user["user_id"] . ">"
                                . h($user["username"]) . " - " . h($user["first_name"])
                                . " " . h($user["last_name"]) . "</option>";
                            }
                            mysqli_free_result($user_set);
                            ?>
                        </select>
                    </dd>
                </dl>
                <div id="operations">
                <input type="submit" value="Confirm Booking" />
            </div>
            </form>

            

            <!-- THIS SECTION IS FROM EVENT SHOW CODE - UPDATE ONCE EVENT SHOW IS COMPLETE -->
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

            </div> 
        </div>
    </div> 
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
