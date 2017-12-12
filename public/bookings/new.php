<?php
require_once('../../private/initialize.php');

if (is_post_request()) {

    // Handle form values

    $booking = [];
    $booking['number_of_tickets'] = $_POST['number_of_tickets'] ?? '';

    $result = insert_booking($booking);
    if ($result === true) {
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/bookings/show.php?id=' . $new_id));
    } else {
        $errors = $result;
    }
} else {
    // display the blank form
}

$booking_set = find_all_bookings();
$booking_count = mysqli_num_rows($booking_set) + 1;
mysqli_free_result($booking_set);


// FOR DISPLAYING THE EVENT DETAILS
$id = $_GET['event_id'] ?? '1'; // PHP > 7.0
        $event = find_event_by_id($id);

?>

<?php $page_title = 'Make a booking'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/events/show.php'); ?>">&laquo; Back to Event</a>

    <div class="new_booking">
        <h1>Make a Booking</h1>
        <?php echo display_errors($errors); ?>

        
        
        <!-- THIS SECTION IS FROM EVENT SHOW CODE - UPDATE ONCE EVENT SHOW IS COMPLETE -->
                    <div class="attributes"> 
                        <h2>Event Details</h2>
                        <dl>
                            <dt>Event name:</dt>
                            <dd><?php echo h($event['event_name']); ?></dd>
                        </dl>
                        <dl>
                            <dt>Event type:</dt>
                            <dd><?php echo h($event['event_category_id']); ?></dd>
                        </dl>
                        <dl>
                            <dt>Hosted by:</dt>
                            <dd><?php echo h($event['host_user_id']); ?></dd>
                        </dl>
                        <dl>
                            <dt>Host rating:</dt>
    <!-- * * * * * * * * * * INSERT host rating * * * * * * * * * * -->
                            <dd><?php echo h($XXX['XXX']); ?></dd>
                        </dl>
                        <!-- Not sure what this is for?
                        <dl>
                            <dt>Visible:</dt>
                            <dd><?php echo $event['visible'] == '1' ? 'true' : 'false'; ?></dd>
                        </dl>
                        -->
                        <dl>
                            <dt>Event Description:</dt>
                            <dd><?php echo h($event['event_description']); ?></dd>
                        </dl>
                        <dl>
                            <dt>Films showing:</dt>
    <!-- * * * * * * * * * * INSERT films to be shown * * * * * * * * * * -->
                            <dd><?php echo h($XXX['XXX']); ?></dd>
                        </dl>
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
                            <dd><?php echo h($event['room_id']); ?></dd>
                        </dl>
    <!-- * * * * * Include rest of address? - address id, postcode, city id, country id etc.? * * * * * -->       
                        <br>
                        <h2>More Information</h2>
                        <dl>
                            <dt>Room is wheelchair accessible:</dt>
    <!-- * * * * * * * * * * Include this here? Or show this on the locations page? * * * * * * * * * * -->                        
                            <dd><?php echo h($XXX['XXX']); ?></dd>
        
                            <br>
                            <br>
                            <br>                        
                            
                            
                            
                            
        <!-- FOR ENTERING NUMBER OF TICKETS -->                    
                            
        <form action="<?php echo url_for('/bookings/new.php'); ?>" method="post">
            <h2>Please enter number of tickets below</h2>
            <dl>
                <dt>Number of tickets:</dt>
                <dd><input type="text" name="number_of_tickets" value="" /></dd>
            </dl>
           
<?php include(SHARED_PATH . '/footer.php'); ?>
