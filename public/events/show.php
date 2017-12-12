<?php
require_once('../../private/initialize.php');


$event_id = $_GET['event_id'] ?? '1'; // PHP > 7.0
$event = find_event_by_id($event_id);

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
                    <dd><?php echo h($event['event_category_id']); ?></dd>
                </dl>
                <dl>
                    <dt>Hosted by:</dt>
                    <dd><?php echo h($event['host_user_id']); ?></dd>
                </dl>

                <!-- * * * * * * * * * * INSERT host rating * * * * * * * * * * -->
                <?php $rating = find_rating_by_event_id($event['event_id']) ?>
                <?php if (isset($rating)) { ?>
                    <dl> 
                        <dt>Host average rating:</dt>

                        <dd><?php echo 'YES there is at least one...............'; ?>
                            <?php echo 'testing function find_average_host_rating($event_id)'; ?>
                            <?php $average_rating = find_avg_host_rating($event['event_id']);
                            echo $average_rating ?> </dd>
                    </dl>
                <?php } ?>
                <dl>
                    <dt>Event Description:</dt>
                    <dd><?php echo h($event['event_description']); ?></dd>
                </dl>
                <dl>
                    <dt>Films showing:</dt>
                    <!-- * * * * * * * * * * INSERT films to be shown * * * * * * * * * * -->
                    <dd><?php //echo h($XXX['XXX']); ?></dd>
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
                </dl>
            </div>                  
        </div>
    </div>
</div>
</body>

<?php include(SHARED_PATH . '/footer.php'); ?>
